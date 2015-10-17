<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$acts = array ('password', 'job', 'company', 'jskill', 'zplx', 'find', 'examrecord', 'jobrec', 'g');
$ac = strtolower ( _get ( 'ac' ) );
$_GET ['ac'] = (in_array ( $ac, $acts ) ? $ac : 'center');

include _g ( 'module' )->filename ( 'cuser', $_GET ['ac'] );
?>