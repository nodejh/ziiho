<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取页码 */
$page = get_page ();
/* 属性类 */
$al = loader ( 'class:class_common_attribute', $module, true, true );
list ( $pg, $result ) = $al->lists ( 20, 7, $page );

/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/attr/ao/attr';
/* 回调url */
$callback_url = set_current_url ();

include modtemplate ( $module . '/admin/template/attr' );
?>