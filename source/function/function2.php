<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

/**
 * 读取seo配置
 * @param unknown $module
 * @param unknown $ks
 */
function seo($module, $ks) {
	$module = _g('module')->flag($module);
	_g('option>' . $module . '>' . $ks);
}

/**
 * 行业分类
 * @param string $k
 * @param string $k2
 * @param string $def
 * @return NULL
 */
function ms_profession($k = null, $k2 = null, $def = 'undefined') {
	$f = _g('loader')->lib('find', null, true);
	$v = null;
	switch (func_num_args()) {
		case 1:
			$v = $f->profession ($k);
			break;
		case 2:
			$v = $f->profession ($k, 'pname');
			break;
		case 3:
			$v = $f->profession ($k, 'pname', $def);
			break;
		default:
			$v = $f->profession ();
			break;
	}
	return $v;
}
/**
 * 指定获取职位分类
 * @param string $ids 指定id，多个以都好分割
 * @return array
 */
function ms_jobSortSpecify($ids = null) {
	$JM = _g('module')->trigger('job', 'model');
	$d = my_explode(',', $ids);
	
	$rtnData = array ();
	foreach ($d as $v) {
		$rtnData[] = $JM->sortValue($v);
	}
	return $rtnData;
}
/**
 * 获取指定条数的职位
 * @param string $sortid 职位分类id
 * @param number $offset 允许显示条数
 */
function ms_JobList($sortid=null, $offset = 10) {
	$data = array ();
	$offset = (!_g ('validate')->pnum ($offset) ? 10 : $offset);
	
	$rntData = array ();
	
	$CU = _g('module')->trigger('cuser');
	$JM = _g('module')->trigger('job', 'model');
	$J = _g('module')->trigger ('job', 'job');
	
	$J->db->from ($J->t_job_job);
	
	if (_g ('validate')->pnum ($sortid)) {
		$J->db->where ('sortid', $sortid);
	}
	
	$J->db->limit (0, $offset);
	$J->db->order_by('ctime', 'DESC');
	$J->db->select ();
	$result = $J->db->get_list ();
	while ($rs = $J->db->result ($result)) {
		$jobData = array ();
		$cData = array ();
		
		$jobData['detailUrl'] = _g('uri')->su('job/ac/company/op/job/id/' . $rs['cuid'] . '/jobid/' . $rs['jobid']);
		$jobData['jname'] = $rs['jname'];
		$jobData['area'] = $JM->areaPos($rs['area'], $rs['area_detail']);
		$jobData['mtime'] = person_time($rs['mtime']);
		$jobData['pnum'] = $rs['pnum'];
		$jobData['workyear'] = $JM->workyear($rs['workyear'], 'sname');
		$jobData['degree'] = _g('cache')->selectitem('111>'.$rs['degree'].'>sname');
		$jobData['wages'] = (_g('cache')->selectitem('116>'.$rsData['wage'].'>sname') . '/' . $JM->wagetypeName(_g('cache')->selectitem('108>'.$rs['wagetype'].'>flag')));
		$jobData['benefit'] = array();
		foreach(_g('value')->s2pnsplit2($rs['benefit']) as $v){
			$jobData['benefit'][] = _g('cache')->selectitem('121>'.$v.'>sname');
		}
		
		/* setting value of job */
		$rntData[$rs['jobid']] = $jobData;
		 
		/* setting value of cuser */
		$cRs = $CU->find_jion('a.cuid', $rs['cuid']);
		if (my_is_array($cRs)) {
			$cData['detailUrl'] = _g('uri')->su('job/ac/company/op/detail/id/' . $cRs['cuid']);
			$cData['cname'] = $cRs['cname'];
			$cData['logo'] = $CU->logo($cRs['logo']);
			$cData['profession'] = null;
			foreach(_g('value')->s2pnsplit2($cUserData['professionid']) as $v){
				$cData['profession'] .= (ms_profession($v, 'pname') . '&nbsp;&nbsp;');
			}
			$cData['nature'] = _g('cache')->selectitem('119>'.$cRs['cnatureid'].'>sname');
			$cData['size'] = _g('cache')->selectitem('114>'.$cRs['csize'].'>sname');
		}
		
		$rntData[$rs['jobid']]['cuser'] = $cData;
	}
	return $rntData;
}
?>