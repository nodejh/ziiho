<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

/*
 * 企业工作申请录过滤筛选
 */
$__where = array ();
if (_g('validate')->hasget('sortid')) {
	$__sortid = _get( 'sortid' );
	if (_g('validate')->pnum ($__sortid)) {
		$__where['sortid'] = $__sortid;
	}
}
/* 工作年限 */
if (_g('validate')->hasget('workyear')) {
	$__workyear = _get( 'workyear' );
	if (preg_match("/^(-)?\d+$/", $__workyear)) { 
		$__where['workyear'] = $__workyear;
	}
}

/* 工作年限 */
if (_g('validate')->hasget('score')) {
	$__score = _get( 'score' );
	if (preg_match("/^(\d+)_(\d+)$/", $__score, $scoreMatchs)) {
		$__where['score'] = array ( $scoreMatchs[1], $scoreMatchs[2] );
	}
}

$db->join('job_apply_record', 'a.uid', 'resume_profile', 'rb.uid', 'LEFT JOIN');
$db->where('a.cuid', $cuid);
if (array_key_exists('sortid', $__where)) {
	$db->where ('a.sortid', $__where['sortid']);
}
if (array_key_exists('workyear', $__where)) {
	$db->where ('rb.workyear', $JMODEL->workyearFlag($__workyear));
}
$db->where ( 'a.status', 1 );
$db->order_by ( 'a.ctime', 'desc' );
$jobRecordData = _g('page')->c($db->count(), 15, 10, _get('page'));
$db->limit($jobRecordData['start'], $jobRecordData['size']);
$db->select($JJOB->apply_field . ',rb.chname');
$jobRecordData['result'] = $db->get_list();
$jobRecordData['uri'] = 'user/ac/jobrec/page/';


?>