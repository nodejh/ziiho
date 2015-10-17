<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$JMODEL = _g('module')->trigger('job', 'model');
$CJOB = _g('module')->trigger('job', 'job');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');
$RESUME = _g('module')->trigger('resume');
$_USER = _g('module')->trigger('user');

$uid = $UModel->suser('uid');

$db = _g('db');

switch (_get ( 'op' )) {
	default :
		_g('uri')->referer(true);
		
		/* query */
		$db->from( 'job_apply_record' );
		$db->where('uid', $uid);
		$db->where_op ( 'ctime', '-', _g('cfg>time'), '<', (60*86400) );
		$pageData = _g('page')->c($db->count(), 15, 10, _get('page'));
		$db->order_by( 'ctime', 'desc' );
		$db->limit($pageData['start'], $pageData['size']);
		$db->select();
		$pageData['result'] = $db->get_list();
		$pageData['uri'] = 'user/ac/examrec/page/';
		
		include _g ( 'template' )->name ( 'user', 'jobrec', true );
		break;
}
?>