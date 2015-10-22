<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JJOB = _g('module')->trigger('job', 'job');
$JSKILL = _g('module')->trigger('job', 'skill');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');

$_USER = _g('module')->trigger('user');

$cuid = $UModel->suser('cuid');
$goBack = _g('uri')->su('user/ac/job');

switch (_get ( 'op' )) {
	default :
		_g('uri')->referer(true);
		
		$JJOB->db->from($JJOB->t_job_job);
		$JJOB->db->where('status', _g('value')->sb(true));
		$JJOB->db->where('cuid', $cuid);
		$pageData = _g('page')->c($JJOB->db->count(), 10, 10, _get('page'));
		$JJOB->db->limit($pageData['start'], $pageData['size']);
		$JJOB->db->select();
		$JJResult = $JJOB->db->get_list();
		
		$pageData['uri'] = 'user/ac/job/page/';
		
		include _g ( 'template' )->name ( 'cuser', 'interested', true );
		break;
}
?>