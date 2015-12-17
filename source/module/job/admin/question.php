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
			'sortid'=>_g('value')->s2pnsplit( $sortid )
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
	case 'sortset':
		$gobackUrlStr = urldecode(base64_decode(_get('url')));
		
		$questionid = _get('questionid');
		if (! _g ( 'validate' )->pnum ( $questionid )) {
			smsg ( lang ( '200010' ), $gobackUrlStr);
			return null;
		}
		$questionSub = $JQuestion->find ( 'questionid', $questionid );
		if (!my_is_array($questionSub)) {
			smsg ( lang ( 'job:500004' ), $gobackUrlStr);
			return null;
		}
		$sortidData = _g ( 'value' )->s2pnsplit2 ( $questionSub['sortid'] );
		
		_g ( 'cp' )->set_template ( 'job', 'question_sortset' );
		break;
	case 'sortsetdo':
		$questionid = _post( 'questionid' );
		$sortid = _post( 'sortid' );
		
		if (!_g('validate')->pnum ($questionid)) {
			smsg ( lang ( 200010 ) );
			return null;
		}
		
		if (!my_is_array($sortid)) {
			smsg ( lang ( 200014 ) );
			return null;
		}
		
		$questionSub = $JQuestion->find ( 'questionid', $questionid );
		if (!$JQuestion->db->is_success($questionSub)) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (!my_is_array($questionSub)) {
			smsg ( lang ( 'job:500004' ) );
			return null;
		}
		
		$sortidData = _g('value')->s2pnsplit ( $sortid );
		
		$JQuestion->db->from ( $JQuestion->t_job_question );
		$JQuestion->db->where ( 'questionid', $questionid );
		$JQuestion->db->set ( 'sortid', $sortidData );
		$JQuestion->db->update ();
		if (!$JQuestion->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
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
		$backUrlStr = null;
		
		$sortid = _get('sortid');
		if(_g('validate')->pnum($sortid)){
			$JQuestion->db->from($JQuestion->t_job_question);
			$JQuestion->db->where_regexp('sortid', ','. $sortid . ',');
			$pageData = _g('page')->c($JQuestion->db->count(), 15, 10, _get('page'));
			$JQuestion->db->limit($pageData['start'], $pageData['size']);
			$JQuestion->db->order_by('listorder');
			$JQuestion->db->select();
			$dataResult = $JQuestion->db->get_list();
			
			$pageData['uri'] = 'mod/job/ac/question/sortid/' . $sortid . '/page/';
			$backUrlStr = urlencode(base64_encode(_g('cp')->uri($pageData['uri'])));
		}
		
		$subjectUrl = 'mod/job/ac/question/op/qsubject';
		_g ( 'cp' )->set_template ( 'job', 'question' );
		break;
}
?>