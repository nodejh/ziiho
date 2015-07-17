<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JJOB = _g('module')->trigger('job', 'job');
$JSKILL = _g('module')->trigger('job', 'skill');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');

$_USER = _g('module')->trigger('user');

$cuid = $UModel->suser('cuid');
$goBack = _g('uri')->su('user/t/c_job');

switch (_get ( 'op' )) {
	case 'write':
		$jobSub = null;
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
		}
		
		include _g ( 'template' )->name ( 'user', 'c_job_write', true );
		break;
	case 'write_save':
		$jobid = _post('jobid');
		$sortid = _post('sortid');
		$jname = _post('jname');
		$pnum = _post('pnum');
		$examtime = _post('examtime');
		$content = _post('content');
		
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
		
		$cUserRs = $CUSER->find('cuid', $cuid);
		if(!my_is_array($cUserRs)){
			smsg ( lang ( 'user:cuser>300001') );
			return null;
		}
		
		$examtime = (_g('validate')->pnum($examtime) ? $examtime : 30);
		$data = array(
			'jname'=>$jname,
			'pnum'=>$pnum,
			'content'=>$content,
			'examtime'=>$examtime,
			'ctime'=>_g('cfg>time'),
			'status'=>_g('value')->sb(true),
			'cuid'=>$cuid,
			'sortid'=>$sortid
		);
		$JJOB->writeSave($jobid, $data);
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
		
		$pageData['uri'] = 'user/t/c_job/op/skill/jobid/' . $jobid . '/page/';
		
		include _g ( 'template' )->name ( 'user', 'c_job_skill', true );
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
		
		include _g ( 'template' )->name ( 'user', 'c_job_skill_write', true );
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
			smsg ( lang ( 'user:cuser>300001') );
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
		
		$pageData['uri'] = 'user/t/c_job/op/jexams/jobid/' . $jobid . '/page/';
		
		include _g ( 'template' )->name ( 'user', 'c_job_jexams', true );
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
		
		include _g ( 'template' )->name ( 'user', 'c_job_jexams_write', true );
		break;
	case 'jexams_write_save':
		$jobid = _post('jobid');
		$esid = _post('esid');
		$estitle = _post('estitle');
		$estype = _post('estype');
		$esoption = _post('esoption');
		$answerData = my_array_filp(_post('answer_flag'));
		
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
			smsg ( lang ( 'user:cuser>300001') );
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
		$__optKey = null;
		if($JModel->qsTypeGroup($estype) == 100){
			if(!my_is_array($esoption)){
				smsg ( lang ( 'job:600001' ) );
				return null;
			}
			foreach ($esoption as $optKey => $optVal){
				if(strlen($optVal) < 1){
					$optVal = 'undefined';
				}
				$__optKey = $JModel->qsOptionId($optKey);
				$esoptionData[$__optKey] = $optVal;
				
				/* answer */
				if(my_array_key_exist($optKey, $answerData)){
					my_unset($answerData, $optKey);
					$answerData[] = $__optKey;
				}
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
		
		include _g ( 'template' )->name ( 'user', 'c_job_esanswer', true );
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
		
		include _g ( 'template' )->name ( 'user', 'c_job_esanswer_read', true );
		break;
	default :
		_g('uri')->referer(true);
		
		$JJOB->db->from($JJOB->t_job_job);
		$JJOB->db->where('status', _g('value')->sb(true));
		$JJOB->db->where('cuid', $cuid);
		$pageData = _g('page')->c($JJOB->db->count(), 10, 10, _get('page'));
		$JJOB->db->limit($pageData['start'], $pageData['size']);
		$JJOB->db->select();
		$JJResult = $JJOB->db->get_list();
		
		$pageData['uri'] = 'user/t/c_job/page/';
		
		include _g ( 'template' )->name ( 'user', 'c_job', true );
		break;
}
?>