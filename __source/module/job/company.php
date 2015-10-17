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
$JZPLX = _g('module')->trigger('job', 'zplx');

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
		
		/* get question */
		$questionDatas = array ();
		$questionCount = 0;
		/* 题库获取 */
		$db = $JEXAMSA->db;
		$db->from ( 'job_question' );
		$db->where_regexp('sortid', (',' . $jobData['sortid'] . ','));
		$db->select ();
		$__result = $db->get_list ();
		while ($rs = $db->fetch_array ($__result)) {
			$db->from ( 'job_question_subject' );
			$db->where ( 'questionid',  $rs['questionid'] );
			$db->where ( 'status',  1 );
			$__total = $db->count ();
			$db->rand_limit ( 10 );
			$db->select ();
			$__result2 = $db->get_list ();
			$questionDatas['sys'][] = array( 'total'=>$__total, 'result'=>$__result2 );
			
			if ($__total < 10) {
				$questionCount = $questionCount + $__total;
			} else {
				$questionCount = $questionCount + 10;
			}
		}
		/* 自定义测试题 */
		$JEXAMS->db->from($JEXAMS->t_job_examsubject);
		$JEXAMS->db->where('cuid', $id);
		$JEXAMS->db->where('jobid', $jobid);
		$__total = $JEXAMS->db->count();
		$JEXAMS->db->order_by('ctime');
		$JEXAMS->db->select();
		$__result = $JEXAMS->db->get_list();
		if ($__total >= 1) {
			$questionDatas ['my'][] = array ('total'=>$__total, 'result'=>$__result);
			
			$questionCount = $questionCount + $__total;
		}
		/* 综合测试 */
		foreach(_g('cache')->selectitem(120) as $k=>$v) {
			$db->from ( 'job_synthetic' );
			$db->where ( 'typeid', $k );
			$db->where ( 'status',  1 );
			$__total = $db->count ();
			$db->rand_limit ( 10 );
			$db->select ();
			$__result = $db->get_list ();
			$questionDatas[$k][] = array ('name'=>$v['sname'], 'total'=>$__total, 'result'=>$__result);
			
			if ($__total < 10) {
				$questionCount = $questionCount + $__total;
			} else {
				$questionCount = $questionCount + 10;
			}
		}
		if ($questionCount < 1) {
			smsg('job:600012', $backUrl);
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
			smsg( lang( 'user:cuser>100017' ), $backUrl );
			return null;
		}
		
		$db = $JEXAMSA->db;
		/* 如果已答卷 */
		$answerResult = $JEXAMSA->find(array('cuid'=>$id, 'jobid'=>$jobid, 'uid'=>$uid));
		if(!$JEXAMSA->db->is_success ( $answerResult )){
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(my_is_array($answerResult)){
			if((_g('cfg>time') - $answerResult['ctime']) < 86400){
				smsg(lang('job:600007'));
				return null;
			}
		}
		
		/* 统计题数 */
		$__examCount = 0;
		$examCountData = array( 'sys' => 0, 'my' => 0 );
		
		/* 系统题数 */
		$db->from ( 'job_question' );
		$db->where_regexp ( 'sortid',  ',' . $jobData['sortid'] . ',');
		$db->select ();
		if(!$db->is_success ()){
			smsg ( lang ( '200013' ) );
			return null;
		}
		$__result = $db->get_list ();
		while ($rs = $db->fetch_array ( $__result )) {
			$db->from ( 'job_question_subject' );
			$db->where ( 'questionid',  $rs['questionid'] );
			$db->where ( 'status',  1 );
			$__total = $db->count ();
			$db->select ();
			if(!$db->is_success ()){
				smsg ( lang ( '200013' ) );
				return null;
			}
			if ($__total < 10) {
				$examCountData['sys'] = $examCountData['sys'] + $__total;
			} else {
				$examCountData['sys'] = $examCountData['sys'] + 10;
			}
		}
		$__examCount = $examCountData['sys'];
		
		/* 自定义题数 */
		$esCount = $JEXAMS->count(array('cuid'=>$id, 'jobid'=>$jobid));
		if(!$esCount[0]){
			smsg ( lang ( '200013' ) );
			return null;
		}
		$examCountData['my'] = $esCount[0];
		$__examCount = $__examCount + $esCount[0];
		
		/* 综合测题数 */
		foreach(_g('cache')->selectitem(120) as $k=>$v) {
			$db->from ( 'job_synthetic' );
			$db->where ( 'typeid', $k );
			$db->where ( 'status',  1 );
			$__total = $db->count ();
			$db->select ();
			if(!$db->is_success ()){
				smsg ( lang ( '200013' ) );
				return null;
			}	
			if ($__total < 10) {
				$examCountData[$v['flag']] = my_array_value( $v['flag'], $examCountData, 0 ) + $__total;
			} else {
				$examCountData[$v['flag']] = my_array_value( $v['flag'], $examCountData, 0 ) + 10;
			}
			
			$__examCount = $__examCount + ($__total < 10 ? $__total : 10);
		}
		/* 如果累计为0,则不作提交,给予提示 */
		if ($__examCount < 1) {
			smsg('job:600012');
			return null;
		}
		
		/* 自动阅卷正确分数变量 */
		$myScoreData = array ();
		/* doing*/
		$defGroupid = $JMODEL->qsOptionId();
		$ip = getip();
		$ctime = _g('cfg>time');
		$data = array();
		
		if(!$isEmptyData){
			$__authAnswerData = array ();
			foreach ($estype as $esid => $v){
				if (!$JMODEL->qsHasType ( $v )){
					continue;
				}
				$idModelData = $JMODEL->examIdDe ( $esid );
				$esQrs = null;
				if ($idModelData[0] == 'my') {
					$esQrs = $JEXAMS->find ('esid', $idModelData[1]);
					if(!$JEXAMS->db->is_success ( $esQrs )){
						smsg ( lang ( '200013' ) );
						return null;
					}
				} else {
					$db->from ( $idModelData[0] == 'sys' ? 'job_question_subject' : 'job_synthetic' );
					$db->where ( $idModelData[0] == 'sys' ? 'qsid' : 'syntheticid', $idModelData[1] );
					$db->select ();
					if(!$db->is_success ()){
						smsg ( lang ( '200013' ) );
						return null;
					}
					$esQrs = $db->get_one ();
				}
				if(!my_is_array( $esQrs )){
					continue;
				}
				$esQrs = $JMODEL->toExam ( $idModelData[0], $esQrs );
				
				/* set data */
				if($v == 'radio' || $v == 'checkbox'){
					$__authAnswerData[$idModelData[0]][$idModelData[1]][$v] = my_join(',', $esoption[$esid]);
					/* 阅题 */
					if(my_join('', $esoption[$esid]) == my_join('', $JMODEL->qsOptionDe($esQrs['esanswer']))){
						$myScoreData[$idModelData[0]] += 1;
					}
				}else if($v == 'input' || $v == 'textarea'){
					$__authAnswerData[$idModelData[0]][$idModelData[1]][$v] = my_stripslashes($esoption[$esid]);
				}
			}
			/* 答题记录 */
			if (my_is_array( $__authAnswerData )) {
				$data = array(
						'defgroupid' => $defGroupid,
						'jname' => my_addslashes( $jobData['jname'] ),
						'records' => my_addslashes( array2str( $__authAnswerData ) ),
						'ip' => $ip,
						'ctime' => $ctime,
						'cuid' => $id,
						'sortid' => $jobData['sortid'],
						'jobid' => $jobid,
						'uid' => $uid,
						'fields' => my_addslashes( array2str( $examCountData ) )
				);
				/* add field */
				foreach ($examCountData as $key => $val) {
					$data[$key] = intval(my_array_key_exist($key, $myScoreData) ? $myScoreData[$key] : 0);
				}
				
				/* record */
				$db->from ( 'job_examsubject_record' );
				$db->set ( $data );
				$db->insert ();
				if(!$db->is_success ()){
					smsg ( lang ( '200013' ) );
					return null;
				}
				
				/* 企业看到的答题记录 */
				$s = false;
				if (my_is_array( $answerResult )) {
					$s = $JEXAMSA->updateValue ( array('answerid'=>$answerResult['answerid']), $data );
				} else {
					$s = $JEXAMSA->insertValue( $data );
				}
				if(!$s){
					smsg ( lang ( '200013' ) );
					return null;
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