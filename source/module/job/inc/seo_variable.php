<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

return array (
		'page'=>array('description' => '页码(职位列表页)'),
		'jname'=>array('description' => '职位信息名称(职位详细页)'),
		'sort'=>array('description' => '职位分类(职位详细页)'),
		'company_name'=>array('description' => '公司名称(职位详细页)')
);
?>