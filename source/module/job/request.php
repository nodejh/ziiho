<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$UMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$CJOB = _g('module')->trigger('job', 'job');
$RMODEL = _g('module')->trigger('resume', 'model');
$EXAMANSWER = _g('module')->trigger('job', 'examsubject_answer');

/* check user */
$logintype = $UMODEL->suser('login_type');
if ($logintype == 2 || $logintype != 1) {
	return smsg ( lang ( 'job:600004' ) );
}
$uid = $UMODEL->suser ( 'uid' );
if (!_g ( 'validate' )->pnum ( $uid )) {
	return smsg ( lang ( 'user:100024' ) );
}

$db = _g ( 'db' );

switch (_get ( 'op' )) {
	case 'ready':
		$jobid = _post ( 'jobid' );
		if (!_g ( 'validate' )->pnum ( $jobid )) {
			smsg ( lang ( 200010 ) );
			return null;
		}
		$rdata = $JMODEL->chkRequestJob ( $jobid );
		if (!my_is_array( $rdata )) {
			smsg ( $rdata );
			return null;
		}
		$params = array ( 
				'status' => 1,
				'selurl'=> _g('uri')->su('job/ac/request/op/sel/jobid/' . $jobid)
		);
		smsg( null, null, $params );
		break;
	case 'sel':
		$jobid = _get ( 'jobid' );
		if (!_g ( 'validate' )->pnum ( $jobid )) {
			smsg ( lang ( 200010 ) );
			return null;
		}
		$jobData = $CJOB->find ( array ( 'jobid' => $jobid, 'status' => 1 ) );
		if (!my_is_array( $jobData )) {
			smsg( lang ( 'job:900000' ) );
			return null;
		}
		
		/* resume */
		$db->from ( 'resume' );
		$db->where ( 'uid', $uid );
		$resumeResData = _g('page')->c($db->count(), 10, 10, 1);
		$db->select ();
		$resumeResult = $db->get_list ();
		
		/* record */
		$db->from ( 'job_examsubject_record' );
		$db->where ( 'uid', $uid );
		$db->where ( 'sortid', $jobData['sortid'] );
		$examRecData = _g('page')->c($db->count(), 10, 10, _get('page'));
		$db->limit ( $examRecData['start'], $examRecData['size'] );
		$db->select ();
		$examRecResult = $db->get_list ();
		$examRecData['uri'] = 'job/ac/request/op/sel/jobid/' . $jobid . '/page/';
		
		include _g ( 'template' )->name ( 'job', 'job_request_sel', true );
		break;
	case 'do':
		$jobid = _post ( 'jobid' );
		$resumeid = _post ( 'resumeid' );
		$recordid = _post ( 'recordid' );
		
		if (!_g ( 'validate' )->pnum ( $jobid )) {
			smsg ( lang ( 200010 ) );
			return null;
		}
		if (!_g ( 'validate' )->pnum ( $resumeid )) {
			smsg(lang('resume:100043'));
			return null;
		}
		if (!_g ( 'validate' )->pnum ( $recordid )) {
			smsg(lang('job:900004'));
			return null;
		}
		
		/* check resume valid */
		if (!$RMODEL->isValid ( $uid, $resumeid )) {
			smsg(lang('resume:100056'));
			return null;
		}
		
		/* 检查 */
		$examRecRs = array ();
		$rdata = $JMODEL->chkRequestJob ( $jobid, $recordid, $examRecRs );
		if (!my_is_array( $rdata )) {
			smsg ( $rdata );
			return null;
		}
		
		/* execute */
		$data = array (
				'ctime' => _g ( 'cfg>time' ),
				'status' => 1,
				'state' => 1,
				'jobid' => $jobid,
				'cuid' => $rdata['cuid'],
				'sortid' => $rdata['sortid'],
				'recordid' => $recordid,
				'resumeid' => $resumeid,
				'uid' => $uid,
				'score' => intval(my_array_value( 'score', $examRecRs ))
		);
		$db->from ( 'job_apply_record' );
		$db->set ( $data );
		$db->insert ();
		if (!$db->is_success ()) {
			smsg(lang('200013'));
			return null;
		}
		
		smsg ( lang ( 'job:900003' ), null, 1 );
		break;
	default :
		echo lang( '200010' );
		break;
}
?>