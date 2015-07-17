<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$JTYPE = _g('module')->trigger('job', 'jtype');
$JJOB = _g('module')->trigger('job', 'job');

switch (_get ( 'op' )) {
	case 'list-c':
		include _g ( 'template' )->name ( 'job', 'work-list', true );
		break;
	case 'list-a':
		$jtypeid = _get('jtypeid');
		if(!_g('validate')->pnum($jtypeid)){
			smsg(lang('200010'));
			return null;
		}
		
		$JJOB->db->join($JJOB->t_job_job, 'a.cuid', $CUSER->t_cuser, 'b.cuid', 'LEFT JOIN');
		$JJOB->db->where('jtypeid', $jtypeid);
		$JJOB->db->select('a.jobid,a.jname,a.pnum,a.ctime,a.jtypeid,a.cuid,b.cname,b.area,b.area_detail');
		$JJOBResult = $JJOB->db->get_list();
		
		include _g ( 'template' )->name ( 'job', 'work_list', true );
		break;
	default :
		$parentResult = $JMODEL->readSort();
		
		$qType = _get('t');
		$qType = (in_array($qType, array('a', 'new')) ? $qType : 'a');
		
		$spid = null;
		if(!_g('validate')->hasget('spid')){
			$spid = my_array_value('sortid', $parentResult[0]);
		}else{
			$spid = _get('spid');
			if(!_g('validate')->pnum($spid)){
				smsg(lang('200010'));
				return null;
			}
		}
		$childResult = array();
		if(_g('validate')->pnum($spid)){
			$childResult = $JMODEL->readSort($spid);
			$childResult = (!is_array($childResult) ? array() : $childResult);
		}
		
		/* 职位条件id */
		$scid = 'a';
		if(_g('validate')->hasget('scid')){
			$scid = _get('scid');
			if($scid != 'a' && !_g('validate')->pnum($scid)){
				smsg(lang('200010'));
				return null;
			}
		}
		
		$__scidArr = array();
		if($scid == 'a'){
			foreach ($childResult as $cvalue){
				$__scidArr[] = $cvalue['sortid'];
			}
		}else{
			$__scidArr[] = $scid;
		}
		/* 获取职位 */
		$JJOB->db->join($JJOB->t_job_job, 'a.cuid', $CUSER->t_cuser, 'b.cuid', 'LEFT JOIN');
		$JJOB->db->where_in('a.sortid', $__scidArr);
		$pageData = _g('page')->c($JJOB->db->count(), 15, 10, _get('page'));
		$JJOB->db->order_by('a.ctime', 'DESC');
		$JJOB->db->limit($pageData['start'], $pageData['size']);
		$JJOB->db->select('a.jobid,a.jname,a.pnum,a.ctime,a.sortid,a.cuid,b.cname,b.area,b.area_detail');
		$JJOBResult = $JJOB->db->get_list();
		
		
		$pageData['uri'] = 'job/ac/work/spid/' . $spid . '/scid/' . $scid . '/page/';
		
		
		
		include _g ( 'template' )->name ( 'job', 'work', true );
		break;
}
?>