<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

/* 获取参数 */
$commentid = get_int_param ( 'id' );
if (check_nums ( $commentid ) < 1) {
	showmsg ( lang ( 'comment:commentid_fail' ), $callback_url );
}
$CMT = loader ( 'class:class_comment', $module, true, true );
$commentSub = $CMT->comment_query ( 'commentid', $commentid );
if (check_is_array ( $commentSub ) < 1) {
	showmsg ( lang ( 'comment:commentid_noexist' ), $callback_url );
}
$commentSub ['content'] = str_stripslashes ( $commentSub ['content'] );
/* 评论者 */
$member = member_query ( $commentSub ['uid'] );

include modtemplate ( $module . '/admin/template/content_edit' );
?>