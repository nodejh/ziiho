<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$qday = post_int_param ( 'qday' );
$qorder = post_int_param ( 'qorder' );
$qnum = post_int_param ( 'qnum' );
$qaid = post_int_param ( 'qaid' );

$urlParam = NULL;
if (str_len ( $qday ) >= 1) {
	$urlParam .= '/qday/' . $qday;
}
if (str_len ( $qorder ) >= 1) {
	$urlParam .= '/qorder/' . $qorder;
}
if (str_len ( $qnum ) >= 1) {
	$urlParam .= '/qnum/' . $qnum;
}
if (str_len ( $qaid ) >= 1) {
	$urlParam .= '/qaid/' . $qaid;
}

$url = url ( 'index', 'mod/article/ac/admin/op/picture/ao/picture' . $urlParam );
showmsg ( NULL, $url, 'redirectUrl' );
?>