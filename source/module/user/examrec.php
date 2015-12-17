<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$JMODEL = _g('module')->trigger('job', 'model');
$CJOB = _g('module')->trigger('job', 'job');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');

$_USER = _g('module')->trigger('user');

$uid = $UModel->suser('uid');

$db = _g('db');

switch (_get ( 'op' )) {
	case 'delete':
		$authid_arr = _post('authid');
		if(!my_is_array($authid_arr)){
			smsg(lang('100055'));
			return null;
		}
		foreach ($authid_arr as $authid){
			if(!$JEXAMAUTH->updateValue(array('authid'=>$authid), array('status'=>-1))){
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	case 'hide':
		$recordid = _post ( 'recordid' );
		if (!_g('validate')->pnum ( $recordid )) {
			smsg(lang('200010'));
			return null;
		}
		if (!$JEXAMSA->updateValue ( array('recordid' => $recordid), array('uhide' => -1) )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		
		/* query */
		$db->from( 'job_examsubject_record' );
		$db->where ('uhide', 1);
		$db->where('uid', $uid);
		$pageData = _g('page')->c($db->count(), 10, 10, _get('page'));
		$db->order_by( 'ctime', 'desc' );
		$db->limit($pageData['start'], $pageData['size']);
		$db->select();
		$examRecordResult = $db->get_list();
		$pageData['uri'] = 'user/ac/examrec/page/';
		
		include _g ( 'template' )->name ( 'user', 'examrec', true );
		break;
}
?>