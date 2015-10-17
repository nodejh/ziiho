<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$JMODEL = _g('module')->trigger('job', 'model');
$CJOB = _g('module')->trigger('job', 'job');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');
$JEXAMAUTH = _g('module')->trigger('job', 'examsubject_auth');
$MYAUTH = _g('module')->trigger('job', 'myauth');

$uid = $UModel->suser('uid');

switch (_get ( 'op' )) {
	default :
		$MYAUTH->db->from($MYAUTH->t_job_myauth);
		$MYAUTH->db->where('uid', $uid);
		$pageData = _g('page')->c($MYAUTH->db->count(), 15, 10, _get('page'));
		$MYAUTH->db->order_by('ctime');
		$MYAUTH->db->limit($pageData['start'], $pageData['size']);
		$MYAUTH->db->select();
		$dataResult = $MYAUTH->db->get_list();
		
		$pageData['uri'] = 'user/ac/myauth/page/';
		
		include _g ( 'template' )->name ( 'user', 'myauth', true );
		break;
}
?>