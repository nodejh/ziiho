<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

return array (
		'page'=>array('description' => '页码(用户列表页)'),
		'nickname'=>array('description' => '用户昵称(用户详细页)'),
		'gender'=>array('description' => '用户性别(用户详细页)'),
		'area'=>array('description' => '用户地区(用户详细页)')
);
?>