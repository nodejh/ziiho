<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_menu extends geshai_model {
	public $t_admin_menu = 'admin_menu';
	public $t_admin_menuof = 'admin_menuof';
	public $of_relete_field = 'a.menuid,a.parentid,a.module,a.listorder,a.title,a.urlfile,a.keys,a.vals,a.url,a.target';
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
			$result = $this->of_finds ( $menuid, _g ( 'cp' )->admin->uid );
		}
		return $result;
	}
	/* 是否存在下级 */
	function my_find($parentid) {
		if (_g ( 'cp' )->admin->isAdmin) {
			$result = $this->find ( 'parentid', $parentid );
		} else {
			$this->db->join ( $this->t_admin_menuof, 'a.menuid', $this->t_admin_menu, 'b.menuid' );
			$this->db->where ( 'a.parentid', $parentid );
			$this->db->where ( 'b.menuid', $parentid );
			$this->db->where ( 'b.uid', _g ( 'cp' )->admin->uid );
			$result = $this->db->select ( $this->of_relete_field );
		}
		if (! $this->db->is_success ( $result )) {
			return null;
		}
		return $this->db->get_one ();
	}
	/* 列出遍历菜单 */
	function my_include_find($parentid, $index = 0) {
		if (_g ( 'cp' )->admin->isAdmin) {
			$this->db->from ( $this->t_admin_menu );
			$this->db->where ( 'parentid', $parentid );
			$this->db->order_by ( 'listorder' );
			$count = $this->db->count ();
			$this->db->select ();
		} else {
			$this->db->join ( $this->t_admin_menuof, 'a.menuid', $this->t_admin_menu, 'b.menuid' );
			$this->db->where ( 'a.parentid', $parentid );
			$this->db->where ( 'b.menuid', $parentid );
			$this->db->where ( 'b.uid', _g ( 'cp' )->admin->uid );
			$this->db->order_by ( 'a.listorder' );
			$count = $this->db->count ();
			$this->db->select ( $this->of_relete_field );
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
			$this->db->join ( $this->t_admin_menuof, 'a.menuid', $this->t_admin_menu, 'b.menuid' );
			$this->db->where ( 'a.menuid', $parentid );
			$this->db->where ( 'b.menuid', $parentid );
			$this->db->where ( 'b.uid', _g ( 'cp' )->admin->uid );
			$this->db->order_by ( 'a.listorder' );
			$count = $this->db->count ();
			$this->db->select ( $this->of_relete_field );
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
	/* 列表 */
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
	/* 条件查询 */
	function find($k, $v = null) {
		$this->db->from ( $this->t_admin_menu );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	/* 检查设置参数是否存在 */
	function menu_getval_query($_key, $_val = NULL, $menu_id = NULL) {
		$this->db->from ( $this->table_admin_menu );
		if (! empty ( $menu_id )) {
			$this->db->where_more ( 'menu_id', $menu_id, '!=' );
		}
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
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
	/**
	 * 管理菜单
	 */
	function of_find($k, $v = null) {
		$this->db->from ( $this->t_admin_menuof );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	/* 获取用户关联的 */
	function of_finds($menuid, $uid) {
		if (! _g ( 'validate' )->pnum ( $uid )) {
			return null;
		}
		if (! _g ( 'validate' )->num ( $menuid )) {
			return null;
		}
		$this->db->join ( $this->t_admin_menuof, 'a.menuid', $this->t_admin_menu, 'b.menuid', 'LEFT JOIN' );
		$this->db->where ( 'b.uid', $uid );
		$this->db->order_by ( 'a.listorder' );
		$this->db->select ( $this->of_relete_field );
		if (! $this->db->is_success ()) {
			return null;
		}
		return $this->db->get_list ();
	}
	/* 增加用户关联的 */
	function of_add($key, $v = null) {
		$this->db->from ( $this->t_admin_menuof );
		$this->db->set ( $k, $v );
		return $this->db->insert ();
	}
}
?>