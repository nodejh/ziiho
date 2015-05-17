<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

$ruleid = get_int_param ( 'ruleid', 0 );
if (check_nums ( $ruleid ) < 1) {
	showmsg ( lang ( 'common_adm:param_id_fail' ), $callback_url );
}
/* 是否存在 */
$creditObj = loader ( 'class:class_common_credit_admin', $module, true, true );
$creditrule = $creditObj->credit_rule_query ( 'ruleid', $ruleid );
if (check_is_array ( $creditrule ) < 1) {
	showmsg ( lang ( 'common_adm:param_id_notexist' ), $callback_url );
}
/* 周期时间 */
if ($creditrule ['cycletype'] == common_value_get ( 'credit_cycletype', 'everyday', 'field' )) {
	$creditrule ['cycletime'] = de_serialize ( $creditrule ['cycletime'] );
}
/* 提交url */
$submiturl = url ( 'index', 'mod/common/ac/admin/op/credit/ao/policy_editdo' );

include modtemplate ( $module . '/admin/template/credit_policy_edit' );
?>