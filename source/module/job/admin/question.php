<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g ( 'module' )->trigger ( 'job', 'model' );
$sort = _g ( 'module' )->trigger ( 'job', 'sort' );
$JQuestion = _g ( 'module' )->trigger ( 'job', 'question' );
$JQS = _g ( 'module' )->trigger ( 'job', 'question_subject' );

$gobackUrl = _g('uri')->referer();

switch (_get ( 'op' )) {
	case 'add':
		$sortid = _post('sortid');
		$listorder = _post('_listorder');
		$qname = _post('_qname');
		
		if(!_g('validate')->pnum($sortid)){
			smsg ( lang ( 'job:500000' ) );
			return null;
		}
		if(strlen($qname) < 1){
			smsg ( lang ( 'job:500002' ) );
			return null;
		}
		
		$listorder = (_g('validate')->num($listorder) ? $listorder : 0);
		
		$sortRs = $sort->find('sortid', $sortid);
		if(!my_is_array($sortRs)){
			smsg ( lang ( 'job:500001' ) );
			return null;
		}
		$data = array(
			'listorder'=>$listorder,
			'qname'=>$qname,
			'ctime'=>_g('cfg>time'),
			'sortid'=>$sortid
		);
		if(!$JQuestion->writeSave ( $data, null )){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	case 'update':
		$questionid = _post('questionid');
		$listorder = _post('listorder');
		$qname = _post('qname');
		
		if(my_count($questionid) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		$_qname = null;
		foreach ($questionid as $id){
			if(strlen($qname[$id]) < 1){
				continue;
			}
			$data = array();
			if(_g('validate')->num($listorder[$id])){
				$data['listorder'] = $listorder[$id];
			}
			$data['qname'] = $qname[$id];
			if(!$JQuestion->writeSave ( $data, $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$_questionid = _post ( 'questionid' );
		if (! my_is_array( $_questionid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($_questionid as $id){
			if(!$JQuestion->delete ( $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'qsubject':
		include _g ( 'cp' )->ac ( 'job', 'qsubject' );
		break;
	default :
		_g('uri')->referer(true);
		
		$pageData = null;
		$dataResult = null;
		
		$sortid = _get('sortid');
		if(_g('validate')->pnum($sortid)){
			$JQuestion->db->from($JQuestion->t_job_question);
			$JQuestion->db->where('sortid', $sortid);
			$pageData = _g('page')->c($JQuestion->db->count(), 15, 10, _get('page'));
			$JQuestion->db->limit($pageData['start'], $pageData['size']);
			$JQuestion->db->order_by('listorder');
			$JQuestion->db->select();
			$dataResult = $JQuestion->db->get_list();
		}
		
		$subjectUrl = 'mod/job/ac/question/op/qsubject';
		_g ( 'cp' )->set_template ( 'job', 'question' );
		break;
}
?>