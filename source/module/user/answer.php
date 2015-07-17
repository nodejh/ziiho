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

$uid = $UModel->suser('uid');

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
	default :
		$JEXAMAUTH->db->from($JEXAMAUTH->t_job_examsubject_auth);
		$JEXAMAUTH->db->where('status', 0);
		$JEXAMAUTH->db->where('uid', $uid);
		$pageData = _g('page')->c($JEXAMAUTH->db->count(), 15, 10, _get('page'));
		$JEXAMAUTH->db->order_by('ctime');
		$JEXAMAUTH->db->limit($pageData['start'], $pageData['size']);
		$JEXAMAUTH->db->select();
		$dataResult = $JEXAMAUTH->db->get_list();
		
		$pageData['uri'] = 'user/ac/answer/page/';
		
		include _g ( 'template' )->name ( 'user', 'answer', true );
		break;
}
?>