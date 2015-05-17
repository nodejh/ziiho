<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
 	/* 100000 */
 	'100000'=>array(
			'2' => array ('v' => '2','name' => '男' ),
			'1' => array ('v' => '1','name' => '女' ),
 			'0' => array ('v' => '0','name' => '保密' )
	),
	'100001'=>array(
			'1' => array ('v' => 1, 'name' => '单身' ),
			'2' => array ('v' => 2, 'name' => '恋爱中' ),
			'3' => array ('v' => 3, 'name' => '已订婚' ),
			'4' => array ('v' => 4, 'name' => '已婚' ),
			'5' => array ('v' => 5, 'name' => '分居' ),
			'6' => array ('v' => 6, 'name' => '离异' ),
			'0' => array ('v' => 0, 'name' => '保密' )
	)
);
?>