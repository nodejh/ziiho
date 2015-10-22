<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g('module')->trigger('job', 'model');
$JJOB = _g('module')->trigger('job', 'job');
$JSKILL = _g('module')->trigger('job', 'skill');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');
$JEXAMSAAUTH = _g('module')->trigger('job', 'examsubject_auth');

$RMODEL = _g('module')->trigger('resume', 'model');

$_USER = _g('module')->trigger('user');

$cuid = $UModel->suser('cuid');
$goBack = _g('uri')->su('user/ac/job');

switch (_get ( 'op' )) {
	case 'hide':
		$recordid = _post ( 'recordid' );
		if (!_g('validate')->pnum ( $recordid )) {
			smsg(lang('200010'));
			return null;
		}
		if (!$JEXAMSA->updateValue ( array('recordid' => $recordid), array('chide' => -1) )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		$db = $JJOB->db;
		
		$authFields = array ('sys', 'my');
		foreach (_g('cache')->selectitem(120) as $k=>$v) {
			$authFields[] = $v['flag'];
		}
		
		/* where */
		$__qw = array ();
		if (_g( 'validate' )->hasget ( 'sortid' )) {
			$__sortid = _get( 'sortid' );
			if (_g('validate')->pnum ($__sortid)) {
				$__qw['sortid'] = $__sortid;
			}
		}
		
		/* 排序 */
		if (_g( 'validate' )->hasget ( 'mt' )){
			$__mts = my_explode( '_' , _get ( 'mt' ));
			if (my_count( $__mts ) > 1 ) {
				if ( my_in_array( $__mts[0], $authFields) ) {
					$__qw['mt'] = array( $__mts[0], my_array_value(1, $__mts));
				}
			}
		}
		
		/* query */
		$db->from( 'job_examsubject_record' );
		$db->where ( 'chide', 1 );
		if (array_key_exists( 'sortid' , $__qw)) {
			$db->where ( 'sortid', $__qw['sortid'] );
		}
		$db->where('cuid', $cuid);
		$pageData = _g('page')->c($db->count(), 10, 10, _get('page'));
		
		if (array_key_exists( 'mt' , $__qw)) {
			$db->order_by( $__qw['mt'][0], ($__qw['mt'][1] !=2 ? 'asc' : 'desc') );
		} else {
			$db->order_by( 'ctime', 'desc' );
		}
		$db->limit($pageData['start'], $pageData['size']);
		$db->select();
		$examRecordResult = $db->get_list();
		
		/* url params */
		$pageUrl = 'user/ac/examrecord';
		if (array_key_exists( 'sortid' , $__qw)) {
			$pageUrl .= '/sortid/' . $__qw['sortid'];
		}
		$pageData['uri'] .= $pageUrl . '/page/';
		
		$mtOrderUrl = _g ( 'uri' )->su ( $pageUrl . '/mt/' );
		
		include _g ( 'template' )->name ( 'cuser', 'examrecord', true );
		break;
}
?>