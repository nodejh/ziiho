<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_timetask extends class_model {
	public $table_common_timetask = 'common_timetask';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_timetask() {
		$this->__construct ();
	}
	
	/* 查询 */
	function timetask_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_timetask );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 上传文件缩略图 */
	function uploadfilethumbclear($page_size = 50, $page = 1) {
		/* 初始化模块 */
		$modulearr = array (
				'website',
				'article',
				'show',
				'study',
				'useful' 
		);
		foreach ( $modulearr as $module ) {
			/* 检查模块是否已安装 */
			if (get_module ( $module ) == NULL) {
				continue;
			}
			/* 获取图片 */
			$this->db->from ( $module . '_picture' );
			/* 获取总数 */
			$total_num = $this->db->count_num ();
			/* 计算分页 */
			$pg = pagephow ( $total_num, $page_size, 7, $page );
			$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
			$this->db->select ();
			$result = $this->db->get_list ();
			/* 如果不存在则进入下一个模块 */
			if (check_nums ( $total_num ) < 1) {
				continue;
			}
			/* 开始清理 */
			while ( $rs = $this->db->fetch_array ( $result ) ) {
				$pic_src = show_uf ( $rs ['file_name'], true );
				if (check_is_file ( $pic_src ) == 1) {
					/* 清理缩略图 */
					serachfile_del ( $pic_src . '*' );
				}
			}
			if ($pg ['last_page'] != $pg ['page']) {
				$this->uploadfilethumbclear ( $pg ['page_size'], $page + 1 );
			}
		}
		return NULL;
	}
}
?>