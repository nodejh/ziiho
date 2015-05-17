<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callbackurl = get_current_url ( false, adm_cookieurlkey () );

/* 获取父级菜单id */
$new_menu_id = get_int_param ( 'new_menu_id' );
/* 菜单类 */
$m = loader ( 'class:class_admin_menu', $module, true, true );
$move_list = $m->menu_all ( 'menu_option', $new_menu_id );
/* 初始化参数 */
$menusub = NULL;
/* 保存url */
$saveurl = url ( 'index', 'mod/admin/ac/menu/op/menu_adds' );

include modtemplate ( $module . '/template/menu_edit' );
?>