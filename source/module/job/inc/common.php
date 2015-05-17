<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$acts = array (
		'index',
		'home',
		'learn',
		'practical',
		'material',
		'company',
		'companys',
		'profession',
		'work',
		'search',
		'jianligonglue',
		'mianshizhinan',
		'zhichangdaren',
		'news'
);
$ac = strtolower ( _get ( 'ac' ) );

$_GET ['ac'] = (in_array ( $ac, $acts ) ? $ac : 'index');

include _g ( 'module' )->filename ( 'job', $_GET ['ac'] );
?>