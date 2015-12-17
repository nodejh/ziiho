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
$goBack = _g('uri')->su('user/ac/job');

$db = _g('db');
switch (_get ( 'op' )) {
	case 'delete':
		$jobrecid = _post ( 'delid' );
		if(!_g ( 'validate' )->num ( $jobrecid )){
			smsg(lang('200010'));
			return null;
		}
		$db->from ( 'job_apply_record' );
		$db->where ( 'jobrecid', $jobrecid );
		$db->set ( 'status', -1 );
		$db->update ();
		if(!$db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	
	default :
		_g('uri')->referer(true);
		
		include _g ( 'module' )->helper ( 'cuser', 'jobrec-search' );
		include _g ( 'template' )->name ( 'cuser', 'jobrec', true );
		break;
}
?>