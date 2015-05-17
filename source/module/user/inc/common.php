<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$acts = array (
		'register',
		'login',
		'logout',
		'forget'
);
$ac = strtolower ( _get ( 'ac' ) );
$_GET ['ac'] = (in_array ( $ac, $acts ) ? $ac : 'c');

include _g ( 'module' )->filename ( 'user', $_GET ['ac'] );
?>