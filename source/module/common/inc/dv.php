<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
 	/* 100000 */
 	'100001'=>array(
			1 => array ('v' => '_self','name' => '默认' ),
			2 => array ('v' => '_blank','name' => '新窗口' ) 
	),
	'100002'=>array(
			'true' => array ('v' => 1, 'name' => '是', 'auth' => '已认证', 'startuse' => '已启用', 'status' => '开启' ),
			'false' => array ('v' => -1, 'name' => '否', 'auth' => '未认证', 'startuse' => '已停用', 'status' => '关闭' )
	),
	/* 200000 */
	'200000'=>array('*.gif', '*.png', '*.jpg'),
	'200001'=>array('image/gif', 'image/png', 'image/x-png', 'image/jpeg', 'image/pjpeg')
);
?>