<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_datastyle', 'common', true );
class class_article_datastyle_admin extends class_common_datastyle {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_datastyle_admin() {
		$this->__construct ();
	}
	
	/* 添加 */
	function add() {
		$this->datastyle_add ( _M (), NULL, array (
				'dourl' => modelurl ( 217 ) 
		) );
		return NULL;
	}
	/* 编辑 */
	function edit() {
		$this->datastyle_edit ();
		return NULL;
	}
}
?>