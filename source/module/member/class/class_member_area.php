<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_area extends class_model {
	public $table_member_area = 'member_area';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_area() {
		$this->__construct ();
	}
	
	/* 区域查询 */
	function area_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_area );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* id下的子id */
	function area_child_id($aid) {
		if (check_nums ( $aid ) < 1) {
			return $aid;
		}
		$this->db->from ( $this->table_member_area );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		$ids = NULL;
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$ids [$val ['aids']] [] = $val ['aid'];
		}
		$ids = get_child_id ( $aid, $ids );
		return $ids;
	}
	/* 分类导航 */
	function area_nav($aid) {
		if (check_nums ( $aid ) < 1) {
			return NULL;
		}
		$this->db->from ( $this->table_member_area );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$aids [$val ['aid']] = $val ['aids'];
			$_aid [$val ['aid']] = $val ['aid'];
			$_title [$val ['aid']] = $val ['title'];
		}
		/* 当前菜单 */
		$aid_arr [] = $_aid [$aid];
		$title_arr [$_aid [$aid]] = $_title [$aid];
		/* 上级菜单 */
		while ( check_nums ( $aids [$aid] ) == 1 ) {
			if ($aids [$aid] == $aid) {
				break;
			}
			$aid = $aids [$aid];
			$aid_arr [] = $_aid [$aid];
			$title_arr [$_aid [$aid]] = $_title [$aid];
		}
		$title_arr = array_reverse ( $title_arr, true );
		$aid_arr = array_reverse ( $aid_arr );
		$title = end ( $title_arr );
		$aid = end ( $aid_arr );
		$arr_len = array_number ( $aid_arr );
		/* 上一级的id */
		$pre_aid = 0;
		if ($arr_len > 1) {
			$pre_aid = $aid_arr [($arr_len - 2)];
		}
		$m_arr = array (
				'title_arr' => $title_arr,
				'aid_arr' => $aid_arr,
				'title' => $title,
				'aid' => $aid,
				'pre_aid' => $pre_aid,
				'len' => $arr_len 
		);
		return $m_arr;
	}
	/* 分类列表 */
	function area_option($template, $new_aid = NULL, $is_move = false) {
		if (check_num ( $new_aid ) < 1) {
			$new_aid = 0;
		}
		$this->db->from ( $this->table_member_area );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$aids [$val ['aids']] [] = $val ['aid'];
			$aid [$val ['aid']] = $val ['aid'];
			$aids_arr [$val ['aid']] = $val ['aids'];
			$listorder [$val ['aid']] = $val ['listorder'];
			$title [$val ['aid']] = $val ['title'];
		}
		$content = $this->_area_option ( $aids [0], $aids, $aid, $aids_arr, $listorder, $title, $new_aid, $is_move, $template );
		return $content;
	}
	/* 分类归类 */
	function _area_option($parents, $aids, $aid, $aids_arr, $listorder, $title, $new_aid, $is_move, $template, $indent = 0) {
		if (is_array ( $parents )) {
			foreach ( $parents as $parent ) {
				$arr = "array('indent'=>'{$indent}','aid'=>'{$aid[$parent]}','aids'=>'{$aids_arr[$parent]}','listorder'=>'{$listorder[$parent]}','title'=>'{$title[$parent]}','new_aid'=>'{$new_aid}');";
				$content .= get_fetch ( $template, array (
						'arr' => $arr 
				) );
				/* 遍历父id下的子id */
				if ($is_move == true) {
					if ($parent != $new_aid) {
						if (array_key_exists ( $parent, $aids )) {
							$content .= $this->_area_option ( $aids [$parent], $aids, $aid, $aids_arr, $listorder, $title, $new_aid, $is_move, $template, ($indent + 1) );
						}
					}
				} else {
					if (array_key_exists ( $parent, $aids )) {
						$content .= $this->_area_option ( $aids [$parent], $aids, $aid, $aids_arr, $listorder, $title, $new_aid, $is_move, $template, ($indent + 1) );
					}
				}
			}
		}
		return $content;
	}
}
?>