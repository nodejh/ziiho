<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$aid = post_int_param ( 'aid', 0 );
if (check_num ( $aid ) < 1) {
	showmsg ( lang ( 'common:param_id_fail' ) );
}
$uid = get_user ( 'uid' );
/* 页码 */
$page = get_page ();
/* 显示个数 */
$page_size = 50;
/* 分页导航 */
$page_nums = 5;
/* 排序 */
$orderby = order_val ( 2 );
if (check_nums ( $aid ) == 1) {
	$P = loader ( 'class:class_article_picture_member', $module, true, true );
	$db_table = $P->table_article_picture;
	$qwhere = array (
			'aid' => $aid 
	);
} else {
	$P = loader ( 'class:class_common_temp_attachment', 'common', true, true );
	$db_table = $P->table_common_temp_attachment;
	$qwhere = array (
			'module' => $module,
			'idtype' => 'aid',
			'uid' => $uid 
	);
}
$db = $P->db;
$db->from ( $db_table );
$db->where ( $qwhere );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$ppg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $ppg ['first_count'], $ppg ['page_size'] );
$db->order_by ( 'ctime', $orderby );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$plists = $db->get_list ();

include subtemplate ( $module . '/content_picture_upload_list' );
?>