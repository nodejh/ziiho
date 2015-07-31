<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$CJOB = _g('module')->trigger('job', 'job');
$CJSKILL = _g('module')->trigger('job', 'skill');
$JEXAMS = _g('module')->trigger('job', 'examsubject');
$JEXAMSA = _g('module')->trigger('job', 'examsubject_answer');
$JEXAMAUTH = _g('module')->trigger('job', 'examsubject_auth');
$MYAUTH = _g('module')->trigger('job', 'myauth');

switch (_get ( 'op' )) {
	case 'detail' :
		$getCuid = _get('id');
		$detailData = $CUSER->find_jion('a.cuid', $getCuid);
		if(!my_is_array($detailData)){
			smsg(lang('user:cuser>100017'), _g('uri')->su('job/ac/company'));
			return null;
		}
		/* 获取招聘内容 */
		$CJOB->db->from($CJOB->t_job_job);
		$CJOB->db->where('cuid', $detailData['cuid']);
		$jobCount = $CJOB->db->count();
		$CJOB->db->order_by('jobid');
		$CJOB->db->select();
		$jobResult = $CJOB->db->get_list();
		
		include _g ( 'template' )->name ( 'job', 'company-view', true );
		break;
	case 'job' :
		$id = _get('id');
		$jobid = _get('jobid');
		
		$backUrl = _g('uri')->su('job/ac/company/id/' . $id);
		if(!_g('validate')->pnum($id) || !_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $backUrl);
			return null;
		}
		/* 职位是否存在 */
		$jobData = $CJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $backUrl);
			return null;
		}
		$jsortData = $JMODEL->sortValue($jobData['sortid']);
		
		$cUserData = $CUSER->find_jion('a.cuid', $id);
		
		include _g ( 'template' )->name ( 'job', 'company_job', true );
		break;
	case 'jobstep' :
		
		$id = _get('id');
		$jobid = _get('jobid');
		
		$backUrl = _g('uri')->su('job/ac/company/id/' . $id);
		if(!_g('validate')->pnum($id) || !_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $backUrl);
			return null;
		}
		/* 职位是否存在 */
		$jobData = $CJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $backUrl);
			return null;
		}
		$cUserData = $CUSER->find_jion('a.cuid', $id);
		
		/* 导航列表 */
		$cUserArr = $CUSER->getList();
		$cUserPage = $cUserArr[0];
		$cUserResult = $cUserArr[1];
		
		/* 技能项 */
		$skillResult = $CJSKILL->finds('jobid', $jobid);
		
		include _g ( 'template' )->name ( 'job', 'company_jobstep', true );
		break;
	case 'jobrz' :
		$id = _get('id');
		$jobid = _get('jobid');
		
		include _g ( 'template' )->name ( 'job', 'company_jobrz', true );
		break;
	case 'exam':
		$id = _get('id');
		$jobid = _get('jobid');
		$uid = $CUMODEL->suser('uid');
		
		$backUrl = _g('uri')->su('job/ac/company/op/job/id/' . $id . '/jobid/' . $jobid);
		if(!_g('validate')->pnum($id) || !_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $backUrl);
			return null;
		}
		
		/* 用户类型 */
		if(!$CUMODEL->is_suser() || $CUMODEL->suser('login_type') != 1){
			smsg(lang('job:600004'), $backUrl);
			return null;
		}
		
		/* 职位是否存在 */
		$jobData = $CJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $backUrl);
			return null;
		}
		$cUserData = $CUSER->find_jion('a.cuid', $id);
		
		/* 如果已答卷 */
		$answerResult = $JEXAMSA->find(array('cuid'=>$id, 'jobid'=>$jobid, 'uid'=>$uid));
		if(!$JEXAMSA->db->is_success($answerResult)){
			smsg ( lang ( '200013' ), $backUrl);
			return null;
		}
		if(my_is_array($answerResult)){
			if((_g('cfg>time') - $answerResult['ctime']) < 86400){
				smsg(lang('job:600007'), $backUrl);
				return null;
			}
		}
		
		/* 测试题 */
		$JEXAMS->db->from($JEXAMS->t_job_examsubject);
		$JEXAMS->db->where('cuid', $id);
		$JEXAMS->db->where('jobid', $jobid);
		$pageData['total'] = $JEXAMS->db->count();
		$JEXAMS->db->order_by('ctime');
		$JEXAMS->db->select();
		$examsubjectResult = $JEXAMS->db->get_list();
		
		if($pageData['total'] < 1){
			smsg(lang('job:600010'), $backUrl);
			return null;
		}
		
		include _g ( 'template' )->name ( 'job', 'company_exam', true );
		break;
	case 'exam_do':
		$id = _get('id');
		$jobid = _get('jobid');
		$uid = $CUMODEL->suser('uid');
		
		$isauto = _post('isauto');
		
		$estype = _post('estype');
		$esoption = _post('esoption');
		
		$emptyData = array();
		/* 提交值检查 */
		if(!my_is_array($estype)){
			smsg(lang('job:600006'), $backUrl);
			return null;
		}
		foreach ($estype as $k => $v){
			if($v == 'radio' || $v == 'checkbox'){
				if(!my_is_array(my_array_value($k, $esoption))){
					$emptyData[] = $k;
				}
			}else if($v == 'input' || $v == 'textarea'){
				if(strlen(my_array_value($k, $esoption)) < 1){
					$emptyData[] = $k;
				}
			}else{
				$emptyData[] = $k;
			}
		}
		
		$isEmptyData = (my_count($emptyData) == my_count($estype));
		
		if($isauto != 'true'){
			if($isEmptyData){
				smsg(lang('job:600005'), $backUrl, array('emptyData'=>$emptyData));
				return null;
			}
			
			if(my_is_array($emptyData)){
				smsg(lang('job:600005'), $backUrl, array('emptyData'=>$emptyData));
				return null;
			}
		}
		
		/* 企业id和职位id参数 */
		$backUrl = _g('uri')->su('job/ac/company/op/job/id/' . $id . '/jobid/' . $jobid);
		if(!_g('validate')->pnum($id) || !_g('validate')->pnum($jobid)){
			smsg(lang('200010'), $backUrl);
			return null;
		}
		/* 用户类型 */
		if(!$CUMODEL->is_suser() || $CUMODEL->suser('login_type') != 1){
			smsg(lang('job:600004'));
			return null;
		}
		/* 职位是否存在 */
		$jobData = $CJOB->find('jobid', $jobid);
		if(!my_is_array($jobData)){
			smsg(lang('job:job>100000'), $backUrl);
			return null;
		}
		
		$cUserData = $CUSER->find_jion('a.cuid', $id);
		if(!my_is_array($cUserData)){
			smsg(lang('user:cuser>100017'), $backUrl);
			return null;
		}
		
		/* 如果已答卷 */
		$answerResult = $JEXAMSA->find(array('cuid'=>$id, 'jobid'=>$jobid, 'uid'=>$uid));
		if(!$JEXAMSA->db->is_success($answerResult)){
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(my_is_array($answerResult)){
			if((_g('cfg>time') - $answerResult['ctime']) < 86400){
				smsg(lang('job:600007'));
				return null;
			}
		}
		
		/* 总共多少道题 */
		$esCount = $JEXAMS->count(array('cuid'=>$id, 'jobid'=>$jobid));
		if(!$esCount[0]){
			smsg ( lang ( '200013' ) );
			return null;
		}
		if($esCount[1] < 1){
			smsg(lang('job:600009'));
			return null;
		}
		
		/* 计算平均分 */
		$average = ($esCount[1] < 1 ? 0 : (100 / $esCount[1]));
		$myEsCount = 0;
		$myScore = 0;
		
		/* doing*/
		$defGroupid = $JMODEL->qsOptionId();
		$ip = getip();
		$ctime = _g('cfg>time');
		$data = array();
		
		if(!$isEmptyData){
			foreach ($estype as $esid => $v){
				$esQrs = $JEXAMS->find('esid', $esid);
				if(!$JEXAMS->db->is_success($esQrs)){
					smsg ( lang ( '200013' ) );
					return null;
				}
				if(!my_is_array($esQrs)){
					continue;
				}
				if(!$JMODEL->qsHasType($v)){
					continue;
				}
				$data = array('defgroupid' => $defGroupid);
				$data['ip'] = $ip;
				$data['ctime'] = $ctime;
				$data['esid'] = $esid;
				$data['cuid'] = $id;
				$data['jobid'] = $jobid;
				$data['uid'] = $uid;
				
				if($v == 'radio' || $v == 'checkbox'){
					if(!my_is_array($esoption[$esid])){
						continue;
					}
					$data['esoptionid'] = my_addslashes(array2str($esoption[$esid]));
					if(!$JEXAMSA->insertValue($data)){
						smsg ( lang ( '200013' ) );
						return null;
					}
					/* 阅题 */
					if(my_join('', $esoption[$esid]) == my_join('', $JMODEL->qsOptionDe($esQrs['esanswer']))){
						$myScore = ($myScore + $average);
						$myEsCount = $myEsCount + 1;
					}
				}else if($v == 'input' || $v == 'textarea'){
					if(strlen($esoption[$esid]) < 1){
						continue;
					}
					$data['input'] = $esoption[$esid];
					if(!$JEXAMSA->insertValue($data)){
						smsg ( lang ( '200013' ) );
						return null;
					}
				}
			}
			/* 记录该会员的答题分数 */
			$authData = array(
					'jname' => my_addslashes($jobData['jname']),
					'ctime' => $ctime,
					'score' => $myScore,
					'ispass' => ($myScore < 60 ? -1 : 1),
					'sortid' => $jobData['sortid'],
					'cuid' => $id,
					'jobid' => $jobid,
					'uid' => $uid
			);
			if(!$JEXAMAUTH->insertValue($authData)){
				smsg ( lang ( '200013' ) );
				return null;
			}
			
			/* 如果大于满60分, 则记录认证合格信息 */
			if($myScore >= 60){
				$myAuthRs = $MYAUTH->find(array('jobid'=>$jobid, 'uid'=>$uid));
				if(!$MYAUTH->db->is_success($myAuthRs)){
					smsg ( lang ( '200013' ) );
					return null;
				}
				if(!my_is_array($myAuthRs)){
					$myAuthData = array(
							'score' => $myScore,
							'ctime' => $ctime,
							'sortid' => $jobData['sortid'],
							'cname'=> my_addslashes($cUserData['cname']),
							'cuid' => $id,
							'jname'=> my_addslashes($jobData['jname']),
							'jobid' => $jobid,
							'uid' => $uid
					);
					if(!$MYAUTH->insertValue($myAuthData)){
						smsg ( lang ( '200013' ) );
						return null;
					}
				}
			}
		}
		
		$EmptyParam = ($isEmptyData ? '/empty/yes' : '');
		$redirectUrl = _g('uri')->su('job/ac/company/op/exam_s/id/' . $id . '/jobid/' . $jobid . $EmptyParam);
		smsg ( lang ( '100061' ), $redirectUrl, 1 );
		break;
	case 'exam_s':
		$id = _get('id');
		$isEmpty = (_get('empty') == 'yes');
		
		$companyData = null;
		$backUrl = null;
		
		if(_g('validate')->pnum($id)){
			$companyData = $CUSER->find_jion('a.cuid', $id);
			if(my_is_array($companyData)){
				$backUrl = _g('uri')->su('job/ac/company/op/detail/id/' . $id);
			}
		}
		include _g ( 'template' )->name ( 'job', 'company_exam_status', true );
		break;
	default :
		$cUserArr = $CUSER->getList();
		$cUserPage = $cUserArr[0];
		$cUserResult = $cUserArr[1];
		
		include _g ( 'template' )->name ( 'job', 'company', true );
		break;
}
?>