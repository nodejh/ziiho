<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_nav extends geshai_model {
	public $t_common_nav = 'common_nav';
	function __construct() {
		parent::__construct ();
	}
	function class_common_nav() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_common_nav );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$this->db->from ( $this->t_common_nav );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_list ();
	}
	function child($navid, $isOnlyIds = false, $isFindCur = true, &$data = array(), $index = 0) {
		if (! _g ( 'validate' )->pnum ( $navid )) {
			return $data;
		}
		$this->db->from ( $this->t_common_nav );
		$this->db->where ( ($isFindCur === true ? 'navid' : 'parentid'), $navid );
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
			
			my_array_push ( $data, ($isOnlyIds === true ? $v ['navid'] : $v) );
			
			$this->child ( $v ['navid'], $isOnlyIds, false, $data, ($index + 1) );
		} else {
			/* 获取子级 */
			$result = $this->db->get_list ();
			while ( $v = $this->db->fetch_array ( $result ) ) {
				$v ['index'] = $index;
				
				my_array_push ( $data, ($isOnlyIds === true ? $v ['navid'] : $v) );
				
				$this->child ( $v ['navid'], $isOnlyIds, false, $data, ($index + 1) );
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
		$writeUrlStr = 'mod/common/ac/nav/op/write';
		
		include (_g ( 'cp' )->get_template ( 'common', 'nav_list' ));
	}
	
	/* 编辑页面 - option */
	function option($navSub, $parentid, $index = 0) {
		$this->db->from ( $this->t_common_nav );
		$this->db->where ( 'parentid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return null;
		}
		$result = $this->db->get_list ();
		include _g ( 'cp' )->get_template ( 'common', 'nav_option' );
	}
	
	/* 页面位置 - position */
	function cpos($parentid, &$data = array()) {
		$this->db->from ( $this->t_common_nav );
		$this->db->where ( 'navid', $parentid );
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
		$urlb = _g ( 'cp' )->uri ( 'mod/common/ac/nav/parentid/' );
		
		include _g ( 'cp' )->get_template ( 'common', 'nav_pos' );
	}
	
	/* 编辑 */
	function update($navid, $listorder, $nname, $status) {
		foreach ( $navid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$rs = $this->find ( 'navid', $id );
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
			if (strlen ( my_array_value ( $id, $nname ) ) >= 1) {
				$data ['nname'] = $nname [$id];
			}
			$data['status'] = _g('value')->sb( my_array_value ( $id, $status ) );
			
			$this->db->from ( $this->t_common_nav );
			$this->db->where ( 'navid', $id );
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
	function write_save($navid, $data) {
		$isEdit = _g ( 'validate' )->pnum ( $navid );
		if ($isEdit) {
			$navSub = $this->find ( 'navid', $navid );
			if (! $this->db->is_success ( $navSub )) {
				smsg ( lang ( '110013' ) );
				return null;
			}
			if (! is_array ( $navSub )) {
				smsg ( lang ( 'common:100000' ) );
				return null;
			}
		}
		/* execute */
		$this->db->from ( $this->t_common_nav );
		if ($isEdit) {
			my_unset ( $data, 'ctime' );
			$this->db->where ( 'navid', $navid );
		}
		$this->db->set ( $data );
		if ($isEdit) {
			$this->db->update ();
		} else {
			$this->db->insert ();
		}
		return $this->db->is_success ();
	}
	/* 删除 */
	function delete($navid) {
		if (! _g ( 'validate' )->pnum ( $navid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$rs = $this->find ( 'navid', $navid );
		if (! $this->db->is_success ( $rs )) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		if (! is_array ( $rs )) {
			continue;
		}
		
		$values = $this->child ( $navid, true );
		
		/* execute */
		$this->db->from ( $this->t_common_nav );
		$this->db->where_in ( 'navid', $values );
		$this->db->delete ();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
}
?>