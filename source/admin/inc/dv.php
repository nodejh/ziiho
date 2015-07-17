<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
 	/* menu - urltype */
 	'100001' => array (
				'none' => array (
						'v' => 'none',
						'name' => '无' 
				),
				'inside' => array (
						'v' => 'inside',
						'name' => '内部链接' 
				),
				'outer' => array (
						'v' => 'outer',
						'name' => '外部链接' 
				) 
		) 
);
?>