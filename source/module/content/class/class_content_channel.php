<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_content_channel extends geshai_model {
	public $t_content_channel = 'content_channel';
	function __construct() {
		parent::__construct ();
	}
	function class_content_channel() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_content_channel );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$this->db->from ( $this->t_content_channel );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_list ();
	}
	function child($channelid, $isOnlyIds = false, $isFindCur = true, &$data = array(), $index = 0) {
		if (! _g ( 'validate' )->pnum ( $channelid )) {
			return $data;
		}
		$this->db->from ( $this->t_content_channel );
		$this->db->where ( ($isFindCur === true ? 'channelid' : 'parentid'), $channelid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return $data;
		}
		
		/* 当前 */
		if ($isFindCur === true) {
			$v = $this->db->get_one ();
			$v ['index'] = $index;
			
			my_array_push ( $data, ($isOnlyIds === true ? $v ['channelid'] : $v) );
			
			$this->child ( $v ['channelid'], $isOnlyIds, false, $data, ($index + 1) );
		} else {
			/* 获取子级 */
			$result = $this->db->get_list ();
			while ( $v = $this->db->fetch_array ( $result ) ) {
				$v ['index'] = $index;
				
				my_array_push ( $data, ($isOnlyIds === true ? $v ['channelid'] : $v) );
				
				$this->child ( $v ['channelid'], $isOnlyIds, false, $data, ($index + 1) );
				$index = 1;
			}
		}
		return $data;
	}
	
	/* 管理 - 操作 */
	function include_list($parentid = 0, $index = 0) {
		if (! _g ( 'validate' )->num ( $parentid )) {
			return null;
		}
		$dataResult = $this->finds ( 'parentid', $parentid );
		$writeUrlStr = 'mod/content/ac/channel/op/write';
		
		include (_g ( 'cp' )->get_template ( 'content', 'channel_list' ));
	}
	
	/* 编辑页面 - option */
	function option($channelSub, $parentid, $index = 0) {
		$this->db->from ( $this->t_content_channel );
		$this->db->where ( 'parentid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return null;
		}
		$result = $this->db->get_list ();
		include _g ( 'cp' )->get_template ( 'content', 'channel_option' );
	}
	
	/* 页面位置 - position */
	function cpos($parentid, &$data = array()) {
		$this->db->from ( $this->t_content_channel );
		$this->db->where ( 'channelid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return $data;
		}
		$result = $this->db->get_one ();
		if (is_array ( $result )) {
			$data = my_array_unshift ( $data, $result );
			$this->cpos ( $result ['parentid'], $data );
		}
		return $data;
	}
	/* 页面位置 - 显示 */
	function include_cpos($parentid) {
		$data = array ();
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$data = $this->cpos ( $parentid );
			$data = (! is_array ( $data ) ? array () : $data);
		}
		$urlb = _g ( 'cp' )->uri ( 'mod/content/ac/channel/parentid/' );
		
		include _g ( 'cp' )->get_template ( 'content', 'channel_pos' );
	}
	
	/* 编辑 */
	function update($channelid, $listorder, $cname, $status) {
		foreach ( $channelid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$rs = $this->find ( 'channelid', $id );
			if (! $this->db->is_success ( $rs )) {
				smsg ( lang ( '110013' ) );
				return null;
			}
			if (! is_array ( $rs )) {
				continue;
			}
			
			/* doing */
			$data = array ();
			if (_g ( 'validate' )->num ( my_array_value ( $id, $listorder ) )) {
				$data ['listorder'] = $listorder [$id];
			}
			if (strlen ( my_array_value ( $id, $cname ) ) >= 1) {
				$data ['cname'] = $cname [$id];
			}
			$data['status'] = _g('value')->sb( my_array_value ( $id, $status ) );
			
			$this->db->from ( $this->t_content_channel );
			$this->db->where ( 'channelid', $id );
			$this->db->set ( $data );
			$this->db->update ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '110013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	
	/* 添加 or 编辑 */
	function write_save($channelid, $parentid, $listorder, $cname, $dir, $status, $isnav, $target, $seo_title, $seo_keywords, $seo_description) {
		$isEdit = _g ( 'validate' )->pnum ( $channelid );
		if ($isEdit) {
			$channelSub = $this->find ( 'channelid', $channelid );
			if (! $this->db->is_success ( $channelSub )) {
				smsg ( lang ( '110013' ) );
				return null;
			}
			if (! is_array ( $channelSub )) {
				smsg ( lang ( 'content:100000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$channelParentSub = $this->find ( 'channelid', $parentid );
			if (! $this->db->is_success ( $channelParentSub )) {
				smsg ( lang ( '110013' ) );
				return null;
			}
			if (! is_array ( $channelParentSub )) {
				smsg ( lang ( '110015' ) );
				return null;
			}
		}
		/* execute */
		$data = array (
				'parentid' => $parentid,
				'listorder' => $listorder,
				'cname' => $cname,
				'dir' => $dir,
				'ctime' => _g ( 'cfg>time' ),
				'status'=> $status,
				'isnav'=> $isnav,
				'target' => $target,
				'seo_title'=>$seo_title,
				'seo_keywords'=>$seo_keywords,
				'seo_description'=>$seo_description
		);
		
		$this->db->from ( $this->t_content_channel );
		if ($isEdit) {
			my_unset ( $data, 'ctime' );
			$this->db->where ( 'channelid', $channelid );
		}
		$this->db->set ( $data );
		if ($isEdit) {
			$this->db->update ();
		} else {
			$this->db->insert ();
		}
		if (! $this->db->is_success ()) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	/* 删除 */
	function delete($channelid) {
		if (! _g ( 'validate' )->pnum ( $channelid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$rs = $this->find ( 'channelid', $channelid );
		if (! $this->db->is_success ( $rs )) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		if (! is_array ( $rs )) {
			continue;
		}
		
		$values = $this->child ( $channelid, true );
		
		/* execute */
		$this->db->from ( $this->t_content_channel );
		$this->db->where_in ( 'channelid', $values );
		$this->db->delete ();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
}
?>