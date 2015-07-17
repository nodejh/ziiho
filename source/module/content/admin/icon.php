<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 操作会员 */
$uid = get_user ( 'uid' );
/* 获取页码 */
$page = get_page ();
/* 主题图标 */
$ai = loader ( 'class:class_article_icon_admin', $module, true, true );
list ( $pg, $result ) = $ai->lists ( 20, 7, $page );
/* 查询当前会员是否上传过 */
$no = yesno_val ( 'check' );
$iconrs = $ai->icon_query ( array (
		'uid' => $uid,
		'status' => $no 
) );
$isadded = 0;
if (check_is_array ( $iconrs ) == 1) {
	$isadded = 1;
	$iconsrc = $iconrs ['filename'];
}
unset ( $iconrs );
/* 图标文件目录 */
$iconpathdir = article_value_get ( 'iconpath', 'path', 'val' );
/* 分页url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/admin/op/icon/ao/icon';
/* 回调url */
$callback_url = set_current_url ();

include modtemplate ( $module . '/admin/template/icon' );
?>