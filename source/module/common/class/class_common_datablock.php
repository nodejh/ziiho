<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_datablock extends class_model {
	public $table_common_datacall = 'common_datacall';
	public $table_common_datastyle = 'common_datastyle';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_datablock() {
		$this->__construct ();
	}
	
	/* 数据调用查询 */
	function datacall_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_datacall );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 模块模板查询 */
	function datastyle_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_datastyle );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 模块数据显示 */
	function datablock_show($dcid) {
		/* 检查数据调用是否存在 */
		$datacall = $this->datacall_query ( 'dcid', $dcid );
		if (check_is_array ( $datacall ) < 1) {
			return NULL;
		}
		/* 解析数据调用配置参数 */
		$values = de_serialize ( array_key_val ( 'values', $datacall ) );
		$datacall = (check_is_array ( $values ) == 1) ? array_merge ( $datacall, $values ) : $datacall;
		unset ( $datacall ['values'], $values );
		
		/* 检查缓存时间 */
		/*检查数据模板是否存在*/
		$datastyle = $this->datastyle_query ( 'dsid', $datacall ['dsid'] );
		if (check_is_array ( $datastyle ) < 1) {
			return NULL;
		}
		/* 解析内容 */
		$datastyle ['content'] = common_datablock_parse ( $datacall ['module'], $dcid, str_stripslashes ( $datastyle ['content'] ) );
		$num = array_number ( $datastyle ['content'] );
		$overstr = array_key_val ( 0, $datastyle ['content'] );
		$mr = array_key_val ( 2, $datastyle ['content'] );
		$datastyle ['content'] = array_key_val ( 1, $datastyle ['content'] );
		
		/* 检查模块是否存在 */
		$module = get_module ( $datacall ['module'], 'module' );
		if (str_len ( $module ) < 1) {
			return NULL;
		}
		/* 调用模块 */
		$func = $module . '_datablock';
		/*
		 * $func=$module.'_datablock'; if(check_is_fun($func)<1){ return lang('datablockundefined'); }
		 */
		$d = loader ( 'class:class_' . $module . '_datablock', $module, true, true );
		ob_start ();
		$d->$func ( $datacall, $datastyle );
		$result = ob_get_contents ();
		ob_end_clean ();
		if ($num >= 1) {
			$result = replace_str ( $overstr, $mr, $result );
		}
		return $result;
	}
}
?>