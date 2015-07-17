<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callbackurl = get_current_url ( false, adm_cookieurlkey () );

/* 获取操作菜单 */
$edit_menu_id = get_int_param ( 'edit_menu_id' );
if (check_nums ( $edit_menu_id ) < 1) {
	showmsg ( lang ( 'admin:param_id_fail' ), $returnurl );
}
$m = loader ( 'class:class_admin_menu', $module, true, true );
/* 检查菜单是否存在 */
$menusub = $m->menu_query ( 'menu_id', $edit_menu_id );
if (check_is_array ( $menusub ) < 1) {
	showmsg ( lang ( 'admin:menu_notexist' ), $returnurl );
}
$move_list = $m->menu_all ( 'menu_option', $edit_menu_id );

/* 保存url */
$saveurl = url ( 'index', 'mod/admin/ac/menu/op/menu_edits' );

include modtemplate ( $module . '/template/menu_edit' );
?>