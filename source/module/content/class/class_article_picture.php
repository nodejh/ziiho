<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_article', 'article', true );
class class_article_picture extends class_article {
	public $table_article_picture = 'article_picture';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_picture() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function picture_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_picture );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 图片数量 */
	function picture_count($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_picture );
		$this->db->where ( $_key, $_val );
		$result = $this->db->count_num ();
		$this->db->clear_sql ();
		return $result;
	}
	/* 更新封面和重新统计图片 */
	function picture_coverupdate($aid) {
		if (check_is_array ( $aid ) < 1) {
			if (check_nums ( $aid ) < 1) {
				return NULL;
			}
		}
		/* 查找主题是否存在 */
		$this->db->from ( $this->table_article );
		$this->db->where_in ( 'aid', $aid );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		while ( $rs = $this->db->fetch_array ( $result ) ) {
			/* 统计图片 */
			$pictures = $this->picture_count ( 'aid', $rs ['aid'] );
			/* 初始化参数 */
			$data_arr = array ();
			/* 获取封面 */
			if ($pictures >= 1 && check_is_file ( show_uf ( $result ['imgsrc'], true ) ) < 1) {
				$picrs = $this->picture_query ( 'aid', $rs ['aid'] );
				if ($picrs == $this->db->cw) {
					return $picrs;
				}
				$data_arr ['imgsrc'] = array_key_val ( 'file_name', $picrs );
			}
			$data_arr ['pictures'] = $pictures;
			$result = $this->db->db_update ( $this->table_article, $data_arr, 'aid', $rs ['aid'] );
			if ($result == $this->db->cw) {
				return $result;
			}
		}
		return $this->db->zq;
	}
}
?>