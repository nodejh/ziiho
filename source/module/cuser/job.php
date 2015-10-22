<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g('module')->trigger('job', 'model');
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
		$languageData = null;
		$benefitData = null;
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
			$zplxData = _g('value')->s2pnsplit2($jobSub['zplxid']);
			$languageData = _g('value')->s2pnsplit2($jobSub['language']);
			$benefitData = _g('value')->s2pnsplit2($jobSub['benefit']);
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
		
		$areaid = _post ( 'areaid' );
		$area_detail = _post ( 'area_detail' );
		$workyear = _post ( 'workyear' );
		$degree = _post ( 'degree' );
		$language = _post ( 'language' );
		$wagetype = _post('wagetype');
		$wage = _post('wage');
		$benefit = _post('benefit');
		
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
		
		if (strlen( $areaid ) < 1) {
			smsg(lang('job:job>100004'));
			return null;
		}
		if (my_count( my_explode(',', $areaid) ) < 2){
			smsg(lang('job:job>100005'));
			return null;
		}
		if(!_g('validate')->vm(strlen($area_detail), 0, 180)){
			smsg ( lang ( 'job:job>100006', 60) );
			return null;
		}
		
		if(!_g('validate')->pnum($sortid)){
			smsg(lang('job:job>100003'));
			return null;
		}
		
		if(!_g('validate')->vm(strlen($jname), 1, 150)){
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
			'areaid'=>_g( 'value' )->s2pnsplit ( $areaid ),
			'area_detail'=>$area_detail,
			'workyear'=>$JMODEL->workyearFlag($workyear),
			'degree'=>$degree,
			'wagetype'=>$wagetype,
			'wage'=>$wage,
			'language'=>_g( 'value' )->s2pnsplit ( $language ),
			'benefit'=>_g( 'value' )->s2pnsplit ( $benefit ),
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
			$__optIndex = 0;
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
		$JEXAMSA->db->from($JEXAMSA->t_job_examsubject_record);
		$JEXAMSA->db->where('cuid', $cuid);
		$JEXAMSA->db->where('jobid', $jobid);
		$pageData = _g('page')->c($JEXAMSA->db->count(), 10, 10, _get('page'));
		$JEXAMSA->db->order_by('ctime', 'DESC');
		$JEXAMSA->db->limit($pageData['start'], $pageData['size']);
		$JEXAMSA->db->select();
		$JAnswerResult = $JEXAMSA->db->get_list();
		
		include _g ( 'template' )->name ( 'cuser', 'job_esanswer', true );
		break;
	case 'esanswer_read':
		$answerid = _get('answerid');
		if(!_g('validate')->pnum($answerid)){
			smsg(lang('200010'), _g('uri')->referer());
			return null;
		}
		
		$answerRs = $JEXAMSA->find ( 'answerid', $answerid );
		if (!my_is_array( $answerRs )) {
			smsg(lang('job:600013'), _g('uri')->referer());
			return null;
		}
		$jobData = $JJOB->find('jobid', $answerRs['jobid']);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $goBack);
			return null;
		}
		
		/* 测试题 */
		$JEXAMS->db->from($JEXAMS->t_job_examsubject);
		$JEXAMS->db->where('jobid', $answerRs['jobid']);
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