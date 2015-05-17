<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
 	/* 100000 */
 	'100001'=>array(
			'self' => array ('v' => '_self','name' => '默认' ),
			'blank' => array ('v' => '_blank','name' => '新窗口' ) 
	),
	'100002'=>array(
			'true' => array ('v' => 1, 'name' => '是' ),
			'false' => array ('v' => -1, 'name' => '否' )
	),
	/* 200000 */
	'200000'=>array('*.gif', '*.png', '*.jpg'),
	'200001'=>array('image/gif', 'image/png', 'image/x-png', 'image/jpeg', 'image/pjpeg')
);
?>