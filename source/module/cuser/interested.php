<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g('module')->trigger('job', 'model');
$JJOB = _g('module')->trigger('job', 'job');
$JSKILL = _g('module')->trigger('job', 'skill');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');

$RMODEL = _g('module')->trigger('resume', 'model');
$_USER = _g('module')->trigger('user');

$cuid = $UModel->suser('cuid');
$goBack = _g('uri')->su('user/ac/interested');

$db = $JJOB->db;

switch (_get ( 'op' )) {
	default :
		$db->from ( $JJOB->t_apply_record );
		$db->where_op ( 'ctime', '-', _g('cfg>time'), '<', (7 * 86400) );
		$db->group_by ( 'uid' );
		$db->order_by ( 'ctime', 'desc' );
		$db->limit ( 0, 15 );
		$db->select ();
		$pageData['result'] = $db->get_list ();
		
		$pageData['uri'] = 'user/ac/interested/';
		
		include _g ( 'template' )->name ( 'cuser', 'interested', true );
		break;
}
?>