<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$sortid = _get('sortid');
if(!_g('validate')->pnum($sortid)){
	smsg ( lang ( 'job:500000' ) );
	return null;
}
$sortData = $sort->cpos($sortid);
$pageNow = '<a href="' . _g('cp')->uri('mod/job/ac/question/sortid/' . my_array_value('sortid', $sortData[1])) . '">';
$pageNow .= '[' . my_array_value('sname', $sortData[0]) . ']';
$pageNow .= my_array_value('sname', $sortData[1]) . '</a>';
unset($sortData);

$questionid = _get('questionid');
if(!_g('validate')->pnum($questionid)){
	smsg ( lang ( 'job:500003' ) );
	return null;
}
$questionRs = $JQuestion->find('questionid', $questionid);
if(!my_is_array($questionRs)){
	smsg ( lang ( 'job:500004' ) );
	return null;
}

$pageNow .= ' - ' . $questionRs['qname'];

switch (_get ( 'f' )) {
	case 'write' :
		$qSubjectRs = array ('stype' => $JMODEL->qsType('radio', 'v'), 'option' => array());
		$qsid = null;
		if (_g ( 'validate' )->hasget ( 'qsid' )) {
			$qsid = _get ( 'qsid' );
			if (! _g ( 'validate' )->pnum ( $qsid )) {
				smsg ( lang ( '200014' ), $gobackUrl );
				return null;
			}
			$qSubjectRs = $JQS->find ( 'qsid', $qsid );
			if (! is_array ( $qSubjectRs )) {
				smsg ( lang ( 'job:600003' ), $gobackUrl );
				return null;
			}
			
			$qSubjectRs['option'] = $JMODEL->qsOptionDe($qSubjectRs['option']);
		}
		_g ( 'cp' )->set_template ( 'job', 'qsubject_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$qsid = _post ( 'qsid' );
		$listorder = _post ( 'listorder' );
		$title = _post ( 'title' );
		$stype = _post ( 'stype' );
		$option = _post ( 'option' );
		$answer = _post ( 'answer' );
		$status = _post ( 'status' );
		
		$optionData = array();
		$answerData = array();
		
		if (! _g ( 'validate' )->num ( $qsid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		if (strlen ( $title ) < 1) {
			smsg ( lang ( 'job:600000' ) );
			return null;
		}
		
		if(my_in_array($stype, array('radio', 'checkbox'))){
			if(!my_is_array( $option )){
				smsg ( lang ( 'job:600001' ) );
				return null;
			}
			if (!my_is_array( $answer )) {
				smsg ( lang ( 'job:600011' ) );
				return null;
			}
			
			/* option */
			$optIndex = 0;
			foreach ($option as $optKey => $optVal){
				if(strlen($optVal) < 1){
					$optVal = 'undefined';
				}
				/* option id key */
				$optIdStr = $JMODEL->qsOptionId($optKey);
				/* answer */
				if (my_in_array($optKey, $answer)) {
					my_array_push( $answerData, $optIdStr );
				}
				
				$optionData[$optIdStr] = array(
						'flag' => $JMODEL->qsOptionOrder ( $optIndex ),
						'name' => my_stripslashes($optVal)
					);
				$optIndex = $optIndex + 1;
			}
		}
		
		/* set data */
		$listorder = (_g ( 'validate' )->num ( $listorder ) ? $listorder : 0);
		$data = array(
				'listorder'=>$listorder,
				'title'=>$title,
				'stype'=>$stype,
				'option'=>my_addslashes(array2str($optionData)),
				'answer'=>my_addslashes(array2str($answerData)),
				'ctime'=>_g('cfg>time'),
				'status'=>_g('value')->sb($status),
				'questionid'=>$questionid,
				'sortid'=>$sortid,
		);
		
		$JQS->writeSave ( $data, $qsid );
		break;
	case 'update':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$_qsid = _post ( 'qsid' );
		$status = _post ( 'status' );
		
		if (! my_is_array( $_qsid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($_qsid as $qsid){
			$data = array ();
			$data['status'] = _g('value')->sb($status[$qsid]);
			if(!$JQS->updateValue (array('qsid'=>$qsid), $data )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'move':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$_new_questionid = _post ( 'new_questionid' );
		$_qsid = _post ( 'qsid' );
		
		if (! my_is_array( $_qsid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		if (! _g ( 'validate' )->pnum ( $_new_questionid )) {
			smsg ( lang ( 'job:500003' ) );
			return null;
		}
		$newQuestionRs = $JQuestion->find('questionid', $_new_questionid);
		if(!my_is_array($newQuestionRs)){
			smsg ( lang ( 'job:500004' ) );
			return null;
		}
		
		foreach ($_qsid as $qsid){
			if(!$JQS->updateValue ( array('qsid' => $qsid), array('questionid'=>$_new_questionid) )){
				smsg ( lang ( '200013' ) );
				break;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$_qsid = _post ( 'qsid' );
		if (! my_is_array( $_qsid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($_qsid as $qsid){
			if(!$JQS->delete ( $qsid )){
				break;
			}
		}
		break;
	default :
		_g('uri')->referer(true);
		
		$pageData = null;
		$dataResult = null;
		
		$JQS->db->from($JQS->t_job_question_subject);
		$JQS->db->where('sortid', $sortid);
		$JQS->db->where('questionid', $questionid);
		$pageData = _g('page')->c($JQS->db->count(), 15, 10, _get('page'));
		$JQS->db->limit($pageData['start'], $pageData['size']);
		$JQS->db->order_by('listorder');
		$JQS->db->select();
		$dataResult = $JQS->db->get_list();
		
		$pageData['uri'] = 'mod/job/ac/question/op/qsubject/sortid/' . $sortid . '/questionid/' . $questionid . '/page/';
		$subjectWriteUrl = 'mod/job/ac/question/op/qsubject/f/write/sortid/' . $sortid . '/questionid/' . $questionid;
		
		$questionResult = $JQuestion->moveResult($sortid, $questionid);
		_g ( 'cp' )->set_template ( 'job', 'qsubject' );
		break;
}
?>