<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_menu extends geshai_model {
	public $t_admin_menu = 'admin_menu';
	
	function __construct() {
		parent::__construct ();
	}
	function class_admin_menu() {
		$this->__construct ();
	}
	
	/* 列出菜单 */
	function my_list($menuid) {
		if (_g ( 'cp' )->admin->isAdmin) {
			$result = $this->finds ( $menuid );
		} else {
			$result = $this->my_finds ( $menuid );
		}
		return $result;
	}
	/* 单个 */
	function my_find($parentid) {
		if (_g ( 'cp' )->admin->isAdmin) {
			$result = $this->find ( 'parentid', $parentid );
		} else {
			$this->db->from ( $this->t_admin_menu );
			$this->db->where_in ( 'menuid', _g('cp')->admin->getData('group>mgr>menuid') );
			$this->db->where ( 'parentid', $parentid );
			$result = $this->db->select ();
		}
		if (! $this->db->is_success ( $result )) {
			return null;
		}
		return $this->db->get_one ();
	}
	/* 多个*/
	function my_finds($menuid) {
		if (! _g ( 'validate' )->num ( $menuid )) {
			return null;
		}
		$this->db->from ( $this->t_admin_menu );
		$this->db->where_in ( 'menuid', _g('cp')->admin->getData('group>mgr>menuid') );
		$this->db->where ( 'parentid', $menuid );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		if (! $this->db->is_success ()) {
			return null;
		}
		return $this->db->get_list ();
	}
	/* 载入 */
	function my_include_find($parentid, $index = 0) {
		if (_g ( 'cp' )->admin->isAdmin) {
			$this->db->from ( $this->t_admin_menu );
			$this->db->where ( 'parentid', $parentid );
			$this->db->order_by ( 'listorder' );
			$count = $this->db->count ();
			$this->db->select ();
		} else {
			$this->db->from ( $this->t_admin_menu );
			$this->db->where_in ( 'menuid', _g('cp')->admin->getData('group>mgr>menuid') );
			$this->db->where ( 'parentid', $parentid );
			$this->db->order_by ( 'listorder' );
			$count = $this->db->count ();
			$this->db->select ();
		}
		if (! $this->db->is_success () || $count < 1) {
			return null;
		}
		$result = $this->db->get_list ();
		include _g ( 'cp' )->get_template ( ':', 'menu_my_load' );
	}
	/* 位置 */
	function my_pos($parentid, &$data = array()) {
		if (_g ( 'cp' )->admin->isAdmin) {
			$this->db->from ( $this->t_admin_menu );
			$this->db->where ( 'menuid', $parentid );
			$this->db->order_by ( 'listorder' );
			$count = $this->db->count ();
			$this->db->select ();
		} else {
			$this->db->from ( $this->t_admin_menu );
			$this->db->where ( 'menuid', $parentid );
			$this->db->where_in ( 'menuid', _g('cp')->admin->getData('group>mgr>menuid') );
			$this->db->order_by ( 'listorder' );
			$count = $this->db->count ();
			$this->db->select ();
		}
		if (! $this->db->is_success () || $count < 1) {
			return $data;
		}
		$result = $this->db->get_one ();
		if (is_array ( $result )) {
			$data = my_array_unshift ( $data, $result );
			$this->my_pos ( $result ['parentid'], $data );
		}
		return $data;
	}
	
	/* --------- */
	function selectHtml($mgrData, $parentid = 0, $index = 0) {
		if (! _g ( 'validate' )->num ( $parentid )) {
			return null;
		}
		$dataResult = $this->finds ( $parentid );
	
		include (_g ( 'cp' )->get_template ( ':', 'menu_select_list' ));
	}
	
	/* 单个 */
	function find($k, $v = null) {
		$this->db->from ( $this->t_admin_menu );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	/* 多个 */
	function finds($menuid) {
		if (! _g ( 'validate' )->num ( $menuid )) {
			return null;
		}
		$this->db->from ( $this->t_admin_menu );
		$this->db->where ( 'parentid', $menuid );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		if (! $this->db->is_success ()) {
			return null;
		}
		return $this->db->get_list ();
	}
	/* 获取 - 子级 */
	function childs($parentid, $isOnlyIds = false, &$data = array(), $isFindCur = true, $index = 0) {
		if (! _g ( 'validate' )->pnum ( $parentid )) {
			return $data;
		}
		$this->db->from ( $this->t_admin_menu );
		$this->db->where ( ($isFindCur === true ? 'menuid' : 'parentid'), $parentid );
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
			
			my_array_push ( $data, ($isOnlyIds === true ? $v ['menuid'] : $v) );
			
			$this->childs ( $v ['menuid'], $isOnlyIds, $data, false, ($index + 1) );
		} else {
			/* 获取子级 */
			$result = $this->db->get_list ();
			while ( $v = $this->db->fetch_array ( $result ) ) {
				$v ['index'] = $index;
				
				my_array_push ( $data, ($isOnlyIds === true ? $v ['menuid'] : $v) );
				
				$this->childs ( $v ['menuid'], $isOnlyIds, $data, false, ($index + 1) );
				$index = 1;
			}
		}
		return $data;
	}
	/* 页面位置 - position */
	function cpos($parentid, &$data = array()) {
		$this->db->from ( $this->t_admin_menu );
		$this->db->where ( 'menuid', $parentid );
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
		$urla = _g ( 'cp' )->uri ( 'ac/menu' );
		$urlb = _g ( 'cp' )->uri ( 'ac/menu/parentid/' );
		
		$isHomeUrl = true;
		if (! _g ( 'validate' )->hasget ( 'op' )) {
			if (my_count ( $data ) < 1) {
				$isHomeUrl = false;
			}
		}
		include _g ( 'cp' )->get_template ( ':', 'menu_pos' );
	}
	/* 编辑页面 - option */
	function option($menuSub, $parentid, $index = 0) {
		$this->db->from ( $this->t_admin_menu );
		$this->db->where ( 'parentid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return null;
		}
		$result = $this->db->get_list ();
		include _g ( 'cp' )->get_template ( ':', 'menu_option' );
	}
	/**
	 * 列表 - 更新
	 */
	function update($menuid, $listorder, $title, $url) {
		foreach ( $menuid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$rs = $this->find ( 'menuid', $id );
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
			if (strlen ( my_array_value ( $id, $title ) ) >= 1) {
				$data ['title'] = $title [$id];
			}
			if (strlen ( my_array_value ( $id, $url ) ) >= 1) {
				$data ['url'] = $url [$id];
			}
			$this->db->from ( $this->t_admin_menu );
			$this->db->where ( 'menuid', $id );
			$this->db->set ( $data );
			$this->db->update ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	/**
	 * 添加 or 编辑
	 */
	function write_save($menuid, $parentid, $listorder, $title, $url, $keys, $vals, $urltype, $target, $module) {
		$isEdit = _g ( 'validate' )->pnum ( $menuid );
		if ($isEdit) {
			$menuSub = $this->find ( 'menuid', $menuid );
			if (! $this->db->is_success ( $menuSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $menuSub )) {
				smsg ( lang ( ':110001' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$menuParentSub = $this->find ( 'menuid', $parentid );
			if (! $this->db->is_success ( $menuParentSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $menuParentSub )) {
				smsg ( lang ( '200015' ) );
				return null;
			}
		}
		/* execute */
		$data = array (
				'parentid' => $parentid,
				'listorder' => $listorder,
				'title' => $title,
				'url' => $url,
				'keys' => $keys,
				'vals' => $vals,
				'urltype' => $urltype,
				'target' => $target,
				'ctime' => _g ( 'cfg>time' ),
				'module' => $module 
		);
		
		$this->db->from ( $this->t_admin_menu );
		if ($isEdit) {
			my_unset ( $data, 'ctime' );
			$this->db->where ( 'menuid', $menuid );
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
	/**
	 * 删除
	 */
	function delete($menuid) {
		foreach ( $menuid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$rs = $this->find ( 'menuid', $id );
			if (! $this->db->is_success ( $rs )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $rs )) {
				continue;
			}
			
			/* execute */
			$values = $this->childs ( $id, true );
			$this->db->from ( $this->t_admin_menu );
			$this->db->where_in ( 'menuid', $values );
			$this->db->delete ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
}
?>