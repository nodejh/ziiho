<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置seo */
$_SEO = get_seo ( $module, config_name_val ( 'seo' ), 'index' );

include subtemplate ( 'common/c_index' );
?>