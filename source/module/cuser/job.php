<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JJOB = _g('module')->trigger('job', 'job');
$JSKILL = _g('module')->trigger('job', 'skill');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');

$_QUESTION = _g('module')->trigger('job', 'question');
$_QUESTION_SUB = _g('module')->trigger('job', 'question_subject');

$_PROVIDE = _g('module')->trigger('job', 'provide');

$_USER = _g('module')->trigger('user');

$cuid = $UModel->suser('cuid');
$goBack = _g('uri')->su('user/ac/job');

switch (_get ( 'op' )) {
	case 'write':
		$jobSub = null;
		$zplxData = null;
		if(_g('validate')->hasget('jobid')){
			$jobid = _get('jobid');
			if(!_g('validate')->pnum($jobid)){
				smsg(lang('200010'), _g('uri')->referer());
				return null;
			}
			$jobSub = $JJOB->find('jobid', $jobid);
			if(!my_is_array($jobSub)){
				smsg(lang('job:job>100000'), _g('uri')->referer());
				return null;
			}
			$zplxData = $CZPLX->de($jobSub['zplxid']);
		}
		
		$CZPLX->db->from($CZPLX->t_job_zplx);
		$CZPLX->db->where('cuid', $cuid);
		$zplxPageData = _g('page')->c($CZPLX->db->count(), 20, 10, _get('page'));
		$CZPLX->db->limit($zplxPageData['start'], $zplxPageData['size']);
		$CZPLX->db->order_by('ctime');
		$CZPLX->db->select();
		$zplxResult = $CZPLX->db->get_list();
		
		include _g ( 'template' )->name ( 'cuser', 'job_write', true );
		break;
	case 'write_save':
		$zplxid = _post('zplxid');		
		$jobid = _post('jobid');
		$sortid = _post('sortid');
		$jname = _post('jname');
		$pnum = _post('pnum');
		$examtime = _post('examtime');
		$content = _post('content');
		$status = _post ( 'status' );
		$isauth = _post ( 'isauth' );
		
		$isUpdate = _g('validate')->pnum($jobid);
		
		if(!_g('validate')->num($jobid)){
			smsg(lang('200010'));
			return null;
		}
		
		if(!_g('validate')->pnum($sortid)){
			smsg(lang('job:job>100003'));
			return null;
		}
		
		if(!_g('validate')->vm(strlen($jname), 1, 50)){
			smsg ( lang ( 'job:job>100001', array(1, 50)) );
			return null;
		}
		
		if(strlen($content) < 1){
			smsg ( lang ( 'job:job>100002') );
			return null;
		}
		
		if(!my_is_array($zplxid)){
			smsg ( lang ( 'cuser:100018') );
			return null;
		}
		$zplxResult = $CZPLX->findin($cuid, $zplxid);
		if($zplxResult[0] < 1){
			smsg ( lang ( 'cuser:100019') );
			return null;
		}
		
		$cUserRs = $CUSER->find ( 'cuid', $cuid );
		if(!my_is_array( $cUserRs )){
			smsg ( lang ( 'cuser:300001') );
			return null;
		}
		
		$examtime = (_g('validate')->pnum($examtime) ? $examtime : 30);
		$isauth = _g('value')->sb($isauth);
		$status = _g('value')->sb($status);
		$ctime = _g('cfg>time');
		$data = array(
			'jname'=>$jname,
			'pnum'=>$pnum,
			'content'=>$content,
			'examtime'=>$examtime,
			'ctime'=>$ctime,
			'isauth'=>$isauth,
			'status'=>$status,
			'zplxid'=>_g( 'value' )->s2pnsplit ( $zplxid ),
			'cuid'=>$cuid,
			'sortid'=>$sortid
		);
		$jobRs = array ();
		if($isUpdate){
			$jobRs = $JJOB->find('jobid', $jobid);
			if (! $JJOB->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($jobRs)){
				smsg ( lang ( 'job:job>100000' ) );
				return null;
			}
		}
		/* execute */
		$JJOB->db->from( $JJOB->t_job_job );
		if($isUpdate){
			unset ( $data['ctime'] );
			unset ( $data['cuid'] );
			$JJOB->db->where( 'jobid', $jobid );
			$JJOB->db->set( $data );
			$JJOB->db->update ();
		}else{
			$JJOB->db->set( $data );
			$JJOB->db->insert ();
		}
		if (! $JJOB->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (!$isUpdate) {
			$jobid = $JJOB->db->insert_id ();
		}
		/* input test */
		if (my_array_value ( 'sortid', $jobRs ) != $sortid) {
			/* 仅删除系统自动添加的 */
			if ($isUpdate) {
				$JEXAMS->db->from ( $JEXAMS->t_job_examsubject );
				$JEXAMS->db->where ( 'isdefine', 2 );
				$JEXAMS->db->where ( 'jobid', $jobid );
				$JEXAMS->db->delete ();
				if (! $JEXAMS->db->is_success ()) {
					smsg ( lang ( '200013' ) );
					return null;
				}
				
				$JEXAMSA->db->from ( $JEXAMSA->t_job_examsubject_answer );
				$JEXAMSA->db->where ( 'isdefine', 2 );
				$JEXAMSA->db->where ( 'jobid', $jobid );
				$JEXAMSA->db->delete ();
				if (! $JEXAMSA->db->is_success ()) {
					smsg ( lang ( '200013' ) );
					return null;
				}
				
				/* skill */
				$JSKILL->db->from ( $JSKILL->t_job_skill );
				$JSKILL->db->where ( 'isdefine', 2 );
				$JSKILL->db->where ( 'jobid', $jobid );
				$JSKILL->db->delete ();
				if (! $JSKILL->db->is_success ()) {
					smsg ( lang ( '200013' ) );
					return null;
				}
			}
			
			$qs = $_QUESTION->finds ('sortid', $sortid);
			if (!$_QUESTION->db->is_success ( $qs[1] )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			while ($__q = $_QUESTION_SUB->db->fetch_array ( $qs[1] )) {
				$_QUESTION_SUB->db->from ( $_QUESTION_SUB->t_job_question_subject );
				$_QUESTION_SUB->db->where ( 'status', 1 );
				$_QUESTION_SUB->db->where ( 'questionid', $__q['questionid'] );
				$_QUESTION_SUB->db->rand_limit ( 10 );
				$_QUESTION_SUB->db->select ();
				if (!$_QUESTION_SUB->db->is_success ()) {
					smsg ( lang ( '200013' ) );
					return null;
				}
				$__qsResult = $_QUESTION_SUB->db->get_list ();
				/* insert */
				while ($__qs = $_QUESTION_SUB->db->fetch_array ( $__qsResult )) {
					$qDatas = array (
							'estitle' => $__qs['title'],
							'estype' => $__qs['stype'],
							'esoption' => my_addslashes($__qs['option']),
							'esanswer' => my_addslashes($__qs['answer']),
							'ctime' => $ctime,
							'isdefine' => 2,
							'cuid' => $cuid,
							'jobid' => $jobid,
							'qsid' => $__qs['qsid']
					);
					$JEXAMS->db->from ( $JEXAMS->t_job_examsubject );
					$JEXAMS->db->set ( $qDatas );
					$JEXAMS->db->insert ();
					if (!$JEXAMS->db->is_success ()) {
						smsg ( lang ( '200013' ) );
						return null;
					}
				}
			}
			/* skill */
			$_PROVIDE->db->from ( $_PROVIDE->t_job_provide_item );
			$_PROVIDE->db->where ( 'status', 1 );
			$_PROVIDE->db->where ( 'sortid', $sortid );
			$_PROVIDE->db->order_by ( 'listorder' );
			$_PROVIDE->db->limit ( 0, 10 );
			$_PROVIDE->db->select ();
			if (!$_PROVIDE->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			$provideItemResult = $_PROVIDE->db->get_list ();
			while ($piRs = $_PROVIDE->db->fetch_array ( $provideItemResult )) {
				$piData = array (
						'listorder' => $piRs['listorder'],
						'sname' => my_addslashes( $piRs['title'] ),
						'content' => my_addslashes( $piRs['content'] ),
						'ctime' => $ctime,
						'isdefine' => 2,
						'status' => 1,
						'cuid' => $cuid,
						'sortid' => $sortid,
						'jobid' => $jobid,
						'provideid' => $piRs['provideid'],
						'itemid' => $piRs['itemid']
				);
				$JSKILL->db->from ( $JSKILL->t_job_skill );
				$JSKILL->db->set ( $piData );
				$JSKILL->db->insert ();
				if (!$JSKILL->db->is_success ()) {
					smsg ( lang ( '200013' ) );
					return null;
				}
			}
		}
		
		smsg ( lang ( '100061' ), null, 1 );
		break;

	case 'delete':
		$jobid = _post('jobid');
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'));
			return null;
		}
		$JJOB->delete($jobid);
		break;
	/* 学习方案 */
	case 'skill':
		_g('uri')->referer(true);
		
		$jobid = _get('jobid');
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $goBack);
			return null;
		}
		
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $goBack);
			return null;
		}
		
		$JSKILL->db->from($JSKILL->t_job_skill);
		$JSKILL->db->where('status', _g('value')->sb(true));
		$JSKILL->db->where('cuid', $cuid);
		$JSKILL->db->where('jobid', $jobid);
		$pageData = _g('page')->c($JSKILL->db->count(), 10, 10, _get('page'));
		$JSKILL->db->limit($pageData['start'], $pageData['size']);
		$JSKILL->db->select();
		$skillResult = $JSKILL->db->get_list();
		
		$pageData['uri'] = 'user/ac/job/op/skill/jobid/' . $jobid . '/page/';
		
		include _g ( 'template' )->name ( 'cuser', 'job_skill', true );
		break;
	
	case 'skill_write':
		$jobid = _get('jobid');
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $goBack);
			return null;
		}
		
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $goBack);
			return null;
		}
		
		$skillsub = null;
		if(_g('validate')->hasget('skillid')){
			$skillid = _get('skillid');
			if(!_g('validate')->pnum($skillid)){
				smsg(lang('200010'), _g('uri')->referer());
				return null;
			}
			$skillsub = $JSKILL->find('skillid', $skillid);
			if(!my_is_array($skillsub)){
				smsg(lang('job:job>200000'), _g('uri')->referer());
				return null;
			}
		}
		
		include _g ( 'template' )->name ( 'cuser', 'job_skill_write', true );
		break;
		
	case 'skill_write_save':
		$jobid = _post('jobid');
		$skillid = _post('skillid');
		$sname = _post('sname');
		$content = _post('content');
		
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'));
			return null;
		}
		
		if(!_g('validate')->num($skillid)){
			smsg(lang('200010'));
			return null;
		}
		$skillid = (_g('validate')->pnum($skillid) ? $skillid : 0);
		
		if(!_g('validate')->vm(strlen($sname), 1, 150)){
			smsg ( lang ( 'job:job>200001', array(1, 50)) );
			return null;
		}
		
		if(strlen($content) < 1){
			smsg ( lang ( 'job:job>200002') );
			return null;
		}
		
		$cUserRs = $CUSER->find('cuid', $cuid);
		if(!my_is_array($cUserRs)){
			smsg ( lang ( 'cuser:300001') );
			return null;
		}
		
		/* 职位分类是否存在 */
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg ( lang ( 'job:job>100000') );
			return null;
		}
		
		$data = array(
				'sname'=>$sname,
				'content'=>$content,
				'ctime'=>_g('cfg>time'),
				'status'=>_g('value')->sb(true),
				'cuid'=>$cuid,
				'sortid'=>$jobData['sortid'],
				'jobid'=>$jobid
		);
		$JSKILL->writeSave($skillid, $data);
		break;
	case 'skill_delete':
		$skillid = _post('skillid');
		if(!_g('validate')->pnum($skillid)){
			smsg(lang('200010'));
			return null;
		}
		$JSKILL->delete($skillid);
		break;
		
	/* 测试题目 */
	case 'jexams':
		_g('uri')->referer(true);
		
		$jobid = _get('jobid');
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'));
			return null;
		}
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg ( lang ( 'job:job>100000') );
			return null;
		}
		
		$JEXAMS->db->from($JEXAMS->t_job_examsubject);
		$JEXAMS->db->where('cuid', $cuid);
		$JEXAMS->db->where('jobid', $jobid);
		$pageData = _g('page')->c($JEXAMS->db->count(), 15, 10, _get('page'));
		$JEXAMS->db->limit($pageData['start'], $pageData['size']);
		$JEXAMS->db->select();
		$examsubjectResult = $JEXAMS->db->get_list();
		
		$pageData['uri'] = 'user/ac/job/op/jexams/jobid/' . $jobid . '/page/';
		
		include _g ( 'template' )->name ( 'cuser', 'job_jexams', true );
		break;
	case 'jexams_write':
		$jobid = _get('jobid');
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $goBack);
			return null;
		}
		
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $goBack);
			return null;
		}
		
		$examSub = null;
		$examSub = array ('estype' => $JModel->qsType('radio', 'v'), 'esoption' => array());
		if(_g('validate')->hasget('esid')){
			$esid = _get('esid');
			if(!_g('validate')->pnum($esid)){
				smsg(lang('200010'), _g('uri')->referer());
				return null;
			}
			$examSub = $JEXAMS->find('esid', $esid);
			if(!my_is_array($examSub)){
				smsg(lang('job:600000'), _g('uri')->referer());
				return null;
			}
			$examSub['esoption'] = $JModel->qsOptionDe($examSub['esoption']);
			$examSub['esanswer'] = $JModel->qsOptionDe($examSub['esanswer']);
		}
		
		include _g ( 'template' )->name ( 'cuser', 'job_jexams_write', true );
		break;
	case 'jexams_write_save':
		$jobid = _post('jobid');
		$esid = _post('esid');
		$estitle = _post('estitle');
		$estype = _post('estype');
		$esoption = _post('esoption');
		$answer_flag = _post('answer_flag');
		
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'));
			return null;
		}
		
		if(!_g('validate')->num($esid)){
			smsg(lang('200010'));
			return null;
		}
		
		if(strlen($estitle) < 1){
			smsg ( lang ( 'job:600000') );
			return null;
		}
		if(!_g('validate')->vm(strlen($estitle), 1, 600)){
			smsg ( lang ( 'job:600002', array(1, 200)) );
			return null;
		}
		
		/* 该企业是否存在 */
		$cUserRs = $CUSER->find('cuid', $cuid);
		if(!my_is_array($cUserRs)){
			smsg ( lang ( 'cuser:300001') );
			return null;
		}
		
		/* 职位分类是否存在 */
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg ( lang ( 'job:job>100000') );
			return null;
		}
		
		/* 解析选项 */
		$esoptionData = array();
		$answerData = array();
		if(my_in_array($estype, array('radio', 'checkbox'))){
			if(!my_is_array($esoption)){
				smsg ( lang ( 'job:600001' ) );
				return null;
			}
			if (!my_is_array( $answer_flag )) {
				smsg ( lang ( 'job:600011' ) );
				return null;
			}
			foreach ($esoption as $optKey => $optVal){
				if(strlen($optVal) < 1){
					$optVal = 'undefined';
				}
				$__optKey = $JModel->qsOptionId($optKey);
				/* answer */
				if(my_in_array($optKey, $answer_flag)){
					my_array_push( $answerData, $__optKey );
				}
				
				$esoptionData[$__optKey] = array(
						'flag' => $JModel->qsOptionOrder ( $__optIndex ),
						'name' => my_stripslashes($optVal)
				);
				$__optIndex = $__optIndex + 1;
			}
		}
		
		$data = array(
				'estitle'=>$estitle,
				'estype'=>$estype,
				'esoption'=>my_addslashes(array2str($esoptionData)),
				'esanswer'=>my_addslashes(array2str($answerData)),
				'ctime'=>_g('cfg>time'),
				'cuid'=>$cuid,
				'jobid'=>$jobid
		);
		$JEXAMS->writeSave($data, $esid);
		break;
	case 'jexams_delete':
		$esid = _post('esid');
		if(!_g('validate')->num($esid)){
			smsg(lang('200010'));
			return null;
		}
		$JEXAMS->delete($esid);
		break;
	case 'esanswer':
		_g('uri')->referer(true);
		
		$jobid = _get('jobid');
		if(!_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $goBack);
			return null;
		}
		
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $goBack);
			return null;
		}
		
		/* 获取答卷人 */
		$JEXAMSA->db->from($JEXAMSA->t_job_examsubject_answer);
		$JEXAMSA->db->where('cuid', $cuid);
		$JEXAMSA->db->where('jobid', $jobid);
		$JEXAMSA->db->distinct('defgroupid');
		$pageData = _g('page')->c($JEXAMSA->db->count(), 10, 10, _get('page'));
		$JEXAMSA->db->limit($pageData['start'], $pageData['size']);
		$JEXAMSA->db->select();
		$JAnswerResult = $JEXAMSA->db->get_list();
		
		include _g ( 'template' )->name ( 'cuser', 'job_esanswer', true );
		break;
	case 'esanswer_read':
		$__getUid = _get('uid');
		$jobid = _get('jobid');
		if(!_g('validate')->pnum($jobid) || !_g('validate')->pnum($__getUid)){
			smsg(lang('200010'), _g('uri')->referer());
			return null;
		}
		
		$jobData = $JJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), _g('uri')->referer());
			return null;
		}
		
		/* 测试题 */
		$JEXAMS->db->from($JEXAMS->t_job_examsubject);
		$JEXAMS->db->where('cuid', $cuid);
		$JEXAMS->db->where('jobid', $jobid);
		$pageData['total'] = $JEXAMS->db->count();
		$JEXAMS->db->order_by('ctime');
		$JEXAMS->db->select();
		$examsubjectResult = $JEXAMS->db->get_list();
		
		include _g ( 'template' )->name ( 'cuser', 'job_esanswer_read', true );
		break;
	default :
		_g('uri')->referer(true);
		
		$JJOB->db->from($JJOB->t_job_job);
		/* $JJOB->db->where('status', _g('value')->sb(true)); */
		$JJOB->db->where('cuid', $cuid);
		$pageData = _g('page')->c($JJOB->db->count(), 10, 10, _get('page'));
		$JJOB->db->limit($pageData['start'], $pageData['size']);
		$JJOB->db->select();
		$JJResult = $JJOB->db->get_list();
		
		$pageData['uri'] = 'user/ac/job/page/';
		
		include _g ( 'template' )->name ( 'cuser', 'job', true );
		break;
}
?>