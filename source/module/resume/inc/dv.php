<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
	 	/* 100000 */
	 	'100000'=>array(
				'2' => array ( 'v' => 2, 'name' => '男' ),
				'1' => array ( 'v' => 1, 'name' => '女' )
		),
		'100001'=>array(
				'1' => array ( 'v' => 1, 'name' => '公开' ),
				'-1' => array ( 'v' => -1, 'name' => '不公开' ),
		)
);
?>