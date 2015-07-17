<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_task_admin extends class_model {
	public $table_member_task_base = 'member_task_base';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_task_admin() {
		$this->__construct ();
	}
	
	/* 基本任务_查询 */
	function task_base_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_task_base );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 基本任务列表_查询 */
	function task_base_list($page_size = 20, $page_nums = 7, $page = 1, $orderby = 'ASC') {
		$this->db->from ( $this->table_member_task_base );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'tb_listorder', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		return array (
				$pg,
				$result 
		);
	}
	/* 基本任务_添加 */
	function task_base_add($tb_listorder, $tb_name, $tb_content, $tb_disabled, $tb_type) {
		if (check_num ( $tb_listorder ) < 1) {
			domsg ( lang ( 'member_adm:task_base_add_tb_listorder_fail' ), NULL, 'myalert' );
			return NULL;
		}
		if (str_len ( $tb_name ) < 1) {
			domsg ( lang ( 'member_adm:task_base_add_tb_name_null' ), NULL, 'myalert' );
			return NULL;
		}
		$tb_disabled = (check_num ( $tb_disabled ) < 1) ? 0 : $tb_disabled;
		if (str_len ( $tb_type ) < 1) {
			domsg ( lang ( 'member_adm:task_base_add_tb_type_fail' ), NULL, 'myalert' );
			return NULL;
		}
		/* 检查任务类型 */
		$task_base_type = dc_value ( 'task_base_type' );
		unset ( $task_base_type [0] );
		if (check_is_array ( $task_base_type ) < 1) {
			domsg ( lang ( 'member_adm:task_base_add_tb_type_fail' ), NULL, 'myalert' );
			return NULL;
		}
		$task_type_arr = array ();
		foreach ( $task_base_type as $v ) {
			$task_type_arr [] = $v ['v_val'];
		}
		unset ( $task_base_type );
		if (str_in_array ( $tb_type, $task_type_arr ) < 1) {
			domsg ( lang ( 'member_adm:task_base_add_tb_type_fail' ), NULL, 'myalert' );
			return NULL;
		}
		unset ( $task_type_arr );
		
		/* 初始化任务主题 */
		$data_arr = array (
				'tb_listorder' => $tb_listorder,
				'tb_name' => $tb_name,
				'tb_content' => $tb_content,
				'tb_time' => $this->sys_time,
				'tb_type' => $tb_type,
				'tb_disabled' => $tb_disabled 
		);
		$this->db->from ( $this->table_member_task_base );
		$this->db->set ( $data_arr );
		$tb_result = $this->db->insert ();
		if ($tb_result == $this->db->cw) {
			domsg ( lang ( 'member_adm:task_base_add_exception' ), NULL, 'myalert' );
			return NULL;
		}
		domsg ( lang ( 'member_adm:task_base_add_success' ), modelurl ( 185 ), 'alertgo' );
		return NULL;
	}
	/* 基本任务_列表编辑 */
	function task_base_list_edit($tb_id, $tb_disabled) {
		if (check_is_array ( $tb_id ) < 1) {
			domsg ( lang ( 'member_adm:task_base_list_edit_tb_id_null' ), NULL, 'myalert' );
			return NULL;
		}
		for($i = 0; $i < array_number ( $tb_id ); $i ++) {
			$tb_id [$i] = trim_addslashes ( $tb_id [$i] );
			if (check_nums ( $tb_id [$i] ) < 1) {
				domsg ( lang ( 'member_adm:task_base_list_edit_tb_id_fail' ), modelurl ( 185 ), 'alertgo' );
				return NULL;
			}
			$tb_disabled [$i] = (check_num ( $tb_disabled [$i] ) < 1) ? 0 : $tb_disabled [$i];
			$this->db->from ( $this->table_member_task_base );
			$this->db->where ( 'tb_id', $tb_id [$i] );
			$this->db->set ( 'tb_disabled', $tb_disabled [$i] );
			$tb_result = $this->db->update ();
			if ($tb_result == $this->db->cw) {
				domsg ( lang ( 'member_adm:task_base_list_edit_exception' ), modelurl ( 185 ), 'alertgo' );
				return NULL;
			}
		}
		domsg ( lang ( 'member_adm:task_base_list_edit_success' ), modelurl ( 185 ), 'alertgo' );
		return NULL;
	}
	/* 基本任务_编辑 */
	function task_base_edit($tb_id, $tb_listorder, $tb_name, $tb_content, $tb_disabled, $tb_type) {
		if (check_nums ( $tb_id ) < 1) {
			domsg ( lang ( 'member_adm:task_base_edit_tb_id_fail' ), NULL, 'myalert' );
			return NULL;
		}
		if (check_num ( $tb_listorder ) < 1) {
			domsg ( lang ( 'member_adm:task_base_edit_tb_listorder_fail' ), NULL, 'myalert' );
			return NULL;
		}
		if (str_len ( $tb_name ) < 1) {
			domsg ( lang ( 'member_adm:task_base_edit_tb_name_null' ), NULL, 'myalert' );
			return NULL;
		}
		$tb_disabled = (check_num ( $tb_disabled ) < 1) ? 0 : $tb_disabled;
		/* 检查任务类型 */
		$task_base_type = dc_value ( 'task_base_type' );
		unset ( $task_base_type [0] );
		if (check_is_array ( $task_base_type ) < 1) {
			domsg ( lang ( 'member_adm:task_base_edit_tb_type_fail' ), NULL, 'myalert' );
			return NULL;
		}
		$task_type_arr = array ();
		foreach ( $task_base_type as $v ) {
			$task_type_arr [] = $v ['v_val'];
		}
		unset ( $task_base_type );
		if (str_in_array ( $tb_type, $task_type_arr ) < 1) {
			domsg ( lang ( 'member_adm:task_base_edit_tb_type_fail' ), NULL, 'myalert' );
			return NULL;
		}
		unset ( $task_type_arr );
		
		/* 初始化任务主题 */
		$data_arr = array (
				'tb_listorder' => $tb_listorder,
				'tb_name' => $tb_name,
				'tb_content' => $tb_content,
				'tb_type' => $tb_type,
				'tb_disabled' => $tb_disabled 
		);
		$this->db->from ( $this->table_member_task_base );
		$this->db->where ( 'tb_id', $tb_id );
		$this->db->set ( $data_arr );
		$tb_result = $this->db->update ();
		if ($tb_result == $this->db->cw) {
			domsg ( lang ( 'member_adm:task_base_edit_exception' ), NULL, 'myalert' );
			return NULL;
		}
		domsg ( lang ( 'member_adm:task_base_edit_success' ), modelurl ( 185 ), 'alertgo' );
		return NULL;
	}
}
?>