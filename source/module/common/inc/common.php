<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$acts = array (
		'home'
);
$ac = strtolower ( _get ( 'ac' ) );

$_GET ['ac'] = (in_array ( $ac, $acts ) ? $ac : 'home');

include _g ( 'module' )->filename ( '@', $_GET ['ac'] );
?>