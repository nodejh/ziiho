<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_nav extends class_model {
	public $table_common_nav = 'common_nav';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_nav() {
		$this->__construct ();
	}
	
	/* 导航查询 */
	function nav_query($_key = NULL, $_val = NULL) {
		$this->db->from ( $this->table_common_nav );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 导航列表 */
	function nav_list($_key = NULL, $_val = NULL) {
		$this->db->from ( $this->table_common_nav );
		$this->db->where ( $_key, $_val );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		return $result;
	}
	/* id下的子id */
	function nav_child_id($navtype, $navid) {
		if (check_nums ( $navid ) < 1) {
			return $navid;
		}
		/* 检查是否存在 */
		$result = $this->nav_query ( 'navid', $navid );
		if ($result == $this->db->cw) {
			return $result;
		}
		if (check_is_array ( $result ) < 1) {
			return $navid;
		}
		unset ( $result );
		
		$this->db->from ( $this->table_common_nav );
		$this->db->where ( 'navtype', $navtype );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		$ids = NULL;
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$ids [$val ['navids']] [] = $val ['navid'];
		}
		$ids = get_child_id ( $navid, $ids );
		return $ids;
	}
	/* 获取导航位置 */
	function lead_nav($navtype = NULL, $navid) {
		if (check_nums ( $navid ) < 1) {
			return NULL;
		}
		/* 是否存在 */
		$qrs = $this->nav_query ( 'navid', $navid );
		if (check_is_array ( $qrs ) < 1) {
			return NULL;
		}
		unset ( $qrs );
		/* 列表查询 */
		$this->db->from ( $this->table_common_nav );
		$this->db->where ( 'navtype', $navtype );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$navids [$val ['navid']] = $val ['navids'];
			$_navid [$val ['navid']] = $val ['navid'];
			$_title [$val ['navid']] = $val ['title'];
		}
		/* 当前菜单 */
		$navid_arr [] = $_navid [$navid];
		$title_arr [$_navid [$navid]] = $_title [$navid];
		/* 上级菜单 */
		while ( (check_nums ( $navids [$navid] ) == 1) ) {
			if ($navids [$navid] == $navid) {
				break;
			}
			$navid = $navids [$navid];
			$navid_arr [] = $_navid [$navid];
			$title_arr [$_navid [$navid]] = $_title [$navid];
		}
		$title_arr = array_reverse ( $title_arr, true );
		$navid_arr = array_reverse ( $navid_arr );
		/* 上一级的id */
		$arr_len = array_number ( $navid_arr );
		$pre_navid = 0;
		if ($arr_len > 1) {
			$pre_navid = $navid_arr [($arr_len - 2)];
		}
		/* 当前菜单名称 */
		$_title = $title_arr [end ( $navid_arr )];
		/* 当前菜单id */
		$_navid = $pre_navid;
		
		$m_arr = array (
				'title_arr' => $title_arr,
				'navid_arr' => $navid_arr,
				'title' => $_title,
				'navid' => $_navid,
				'pre_navid' => $pre_navid,
				'len' => $arr_len 
		);
		return $m_arr;
	}
	/* 导航获取 */
	function nav_show($template, $navtype = NULL, $old_navid = NULL, $is_move = false) {
		if (check_num ( $old_navid ) < 1) {
			$old_navid = 0;
		}
		$_normal = yesno_val ( 'normal' );
		$this->db->from ( $this->table_common_nav );
		$this->db->where ( 'navtype', $navtype );
		$this->db->where ( 'disabled', $_normal );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$navids [$val ['navids']] [] = $val ['navid'];
			$navid [$val ['navid']] = $val ['navid'];
			$navids_arr [$val ['navid']] = $val ['navids'];
			$listorder [$val ['navid']] = $val ['listorder'];
			$title [$val ['navid']] = $val ['title'];
			$navurl [$val ['navid']] = $val ['navurl'];
			$disabled [$val ['navid']] = $val ['disabled'];
		}
		$content = $this->_nav_show ( $navids [0], $navids, $navid, $navids_arr, $listorder, $title, $navurl, $disabled, $template, $old_navid, $is_move );
		return $content;
	}
	/* 导航获取显示 */
	function _nav_show($parents, $navids, $navid, $navids_arr, $listorder, $title, $navurl, $disabled, $template, $old_navid, $is_move, $indent = 0) {
		if (is_array ( $parents )) {
			foreach ( $parents as $parent ) {
				$arr = "array('indent'=>'{$indent}','navid'=>'{$navid[$parent]}','navids'=>'{$navids_arr[$parent]}','listorder'=>'{$listorder[$parent]}','title'=>'{$title[$parent]}','navurl'=>'{$navurl[$parent]}','disabled'=>'{$disabled[$parent]}','description'=>'{$description[$parent]}','disabled'=>'{$disabled[$parent]}','old_navid'=>'{$old_navid}');";
				$content .= get_fetch ( $template, array (
						'arr' => $arr 
				) );
				/* 遍历父id下的子id */
				
				if (array_key_exists ( $parent, $navids )) {
					$content .= $this->_nav_show ( $navids [$parent], $navids, $navid, $navids_arr, $listorder, $title, $navurl, $disabled, $template, $old_navid, $is_move, ($indent + 1) );
				}
			}
		}
		return $content;
	}
	/* 删除导航分类 */
	function _categoryNavDel($key, $val = NULL) {
		$this->db->from ( $this->table_common_nav );
		if (! is_array ( $key )) {
			$this->db->where ( $key, $val );
		} else {
			foreach ( $key as $k => $v ) {
				if (! is_array ( $v )) {
					$this->db->where ( $k, $v );
				} else {
					$this->db->where_in ( $k, $v );
				}
			}
		}
		$result = $this->db->delete ();
		return $result;
	}
	/* 将分类添加为导航 */
	function _categoryAppendToNav($data, $key = NULL, $val = NULL) {
		$this->db->from ( $this->table_common_nav );
		if (! empty ( $key )) {
			$this->db->where ( $key, $val );
		}
		$this->db->set ( $data );
		if (empty ( $key )) {
			$result = $this->db->insert ();
		} else {
			$result = $this->db->update ();
		}
		return $result;
	}
}
?>