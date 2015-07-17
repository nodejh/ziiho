<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$smodule = post_param ( 'subject_module' );
$status = post_param ( 'subject_status' );
$day = post_int_param ( 'subject_day' );
$order = post_int_param ( 'subject_order' );
$data_num = post_int_param ( 'subject_num' );
$id = post_int_param ( 'subject_id' );

/* 当前url */
$urlValue = NULL;
if (str_len ( $smodule ) >= 1) {
	$urlValue .= '/smodule/' . $smodule;
}
if (str_len ( $status ) >= 1) {
	$urlValue .= '/s/' . $status;
}
if (str_len ( $day ) >= 1) {
	$urlValue .= '/sday/' . $day;
}
if (str_len ( $order ) >= 1) {
	$urlValue .= '/sorder/' . $order;
}
if (str_len ( $data_num ) >= 1) {
	$urlValue .= '/dnum/' . $data_num;
}
if (str_len ( $id ) >= 1) {
	$urlValue .= '/id/' . $id;
}
$url = url ( 'index', 'mod/comment/ac/admin/op/content/ao/content' . $urlValue );
showmsg ( NULL, $url, 'redirectUrl' );
?>