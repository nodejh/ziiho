<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user_area extends geshai_model {
	public $t_user_area = 'user_area';
	function __construct() {
		parent::__construct ();
	}
	function class_user_area() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_user_area );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$this->db->from ( $this->t_user_area );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_list ();
	}
	function child($areaid, $isOnlyIds = false, $isFindCur = true, &$data = array(), $index = 0) {
		if (! _g ( 'validate' )->pnum ( $areaid )) {
			return $data;
		}
		$this->db->from ( $this->t_user_area );
		$this->db->where ( ($isFindCur === true ? 'areaid' : 'parentid'), $areaid );
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
			
			my_array_push ( $data, ($isOnlyIds === true ? $v ['areaid'] : $v) );
			
			$this->child ( $v ['areaid'], $isOnlyIds, false, $data, ($index + 1) );
		} else {
			/* 获取子级 */
			$result = $this->db->get_list ();
			while ( $v = $this->db->fetch_array ( $result ) ) {
				$v ['index'] = $index;
				
				my_array_push ( $data, ($isOnlyIds === true ? $v ['areaid'] : $v) );
				
				$this->child ( $v ['areaid'], $isOnlyIds, false, $data, ($index + 1) );
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
		$writeUrlStr = 'mod/user/ac/area/op/write';
		
		include (_g ( 'cp' )->get_template ( 'user', 'area_list' ));
	}
	
	/* 编辑页面 - option */
	function option($areaSub, $parentid, $index = 0) {
		$this->db->from ( $this->t_user_area );
		$this->db->where ( 'parentid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return null;
		}
		$result = $this->db->get_list ();
		include _g ( 'cp' )->get_template ( 'user', 'area_option' );
	}
	
	/* 页面位置 - position */
	function cpos($parentid, &$data = array()) {
		$this->db->from ( $this->t_user_area );
		$this->db->where ( 'areaid', $parentid );
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
		$urlb = _g ( 'cp' )->uri ( 'mod/user/ac/area/parentid/' );
		
		include _g ( 'cp' )->get_template ( 'user', 'area_pos' );
	}
	
	/* 编辑 */
	function update($areaid, $listorder, $aname, $status) {
		foreach ( $areaid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$rs = $this->find ( 'areaid', $id );
			if (! $this->db->is_success ( $rs )) {
				smsg ( lang ( '200013' ) );
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
			if (strlen ( my_array_value ( $id, $aname ) ) >= 1) {
				$data ['aname'] = $aname [$id];
			}
			$data['status'] = _g('value')->sb( my_array_value ( $id, $status ) );
			
			$this->db->from ( $this->t_user_area );
			$this->db->where ( 'areaid', $id );
			$this->db->set ( $data );
			$this->db->update ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		
		$this->cache();
	}
	
	/* 添加 or 编辑 */
	function write_save($areaid, $parentid, $listorder, $aname, $status) {
		$isEdit = _g ( 'validate' )->pnum ( $areaid );
		if ($isEdit) {
			$areaSub = $this->find ( 'areaid', $areaid );
			if (! $this->db->is_success ( $areaSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $areaSub )) {
				smsg ( lang ( 'user:200000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$areaParentSub = $this->find ( 'areaid', $parentid );
			if (! $this->db->is_success ( $areaParentSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $areaParentSub )) {
				smsg ( lang ( '110015' ) );
				return null;
			}
		}
		/* execute */
		$data = array (
				'parentid' => $parentid,
				'listorder' => $listorder,
				'aname' => $aname,
				'ctime' => _g ( 'cfg>time' ),
				'status'=> $status
		);
		
		$this->db->from ( $this->t_user_area );
		if ($isEdit) {
			my_unset ( $data, 'ctime' );
			$this->db->where ( 'areaid', $areaid );
		}
		$this->db->set ( $data );
		if ($isEdit) {
			$this->db->update ();
		} else {
			$this->db->insert ();
		}
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	/* 删除 */
	function delete($areaid) {
		if (! _g ( 'validate' )->pnum ( $areaid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$rs = $this->find ( 'areaid', $areaid );
		if (! $this->db->is_success ( $rs )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (! is_array ( $rs )) {
			continue;
		}
		
		$values = $this->child ( $areaid, true );
		
		/* execute */
		$this->db->from ( $this->t_user_area );
		$this->db->where_in ( 'areaid', $values );
		$this->db->delete ();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	
	function cache(){
		$result = $this->finds('status', _g('value')->sb(true));
	
		$flag = false;
		$data = null;
		while($rs = $this->db->fetch_array($result)){
			if($flag){
				$data .= ',';
			}
			$data .= '{"id": ' . $rs['areaid'];
			$data .= ',"parentid": ' . $rs['parentid'];
			$data .= ',"aname": "' . my_addslashes($rs['aname']) . '"';
			$data .= '}';
				
			$flag = true;
		}
		$data = 'var _CACHE_user_area = [' . $data . '];';
		_g('cache')->write('user', null, 'area.js', $data);
	}
}
?>