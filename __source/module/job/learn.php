<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$JJOB = _g('module')->trigger('job', 'job');
$JSKILL = _g('module')->trigger('job', 'skill');

/* 返回url */
$goBack = $_SERVER['HTTP_REFERER'];

switch (_get ( 'op' )) {
	case 'view':
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
		
		$sortData = $JMODEL->sortValue($jobData['sortid']);
		$sortParentData = $JMODEL->sortValue($sortData['parentid']);

		$JSKILL->db->from ( $JSKILL->t_job_skill );
		$JSKILL->db->where ( 'jobid', $jobid );
		$JSKILL->db->order_by ( 'listorder' );
		$JSKILL->db->limit ( 0, 20 );
		$JSKILL->db->select ();
		$skillResult = $JSKILL->db->get_list ();
		
		include _g ( 'template' )->name ( 'job', 'learn-view', true );
		break;
	case 'assess':
        $parentResult = $JMODEL->readSort();

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
        $JJOB->db->from($JJOB->t_job_job);
        $JJOB->db->where_in('sortid', $__scidArr);
        $pageData = _g('page')->c($JJOB->db->count(), 15, 10, _get('page'));
        $JJOB->db->order_by('ctime', 'DESC');
        $JJOB->db->limit($pageData['start'], $pageData['size']);
        $JJOB->db->select();
        $dataResult = $JJOB->db->get_list();

        $pageData['uri'] = 'job/ac/learn/spid/' . $spid . '/scid/' . $scid . '/page/';

        include _g ( 'template' )->name ( 'job', 'assess', true );
        break;
	default :
		$parentResult = $JMODEL->readSort();
		
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
		$JJOB->db->from($JJOB->t_job_job);
		$JJOB->db->where_in('sortid', $__scidArr);
		$pageData = _g('page')->c($JJOB->db->count(), 15, 10, _get('page'));
		$JJOB->db->order_by('ctime', 'DESC');
		$JJOB->db->limit($pageData['start'], $pageData['size']);
		$JJOB->db->select();
		$dataResult = $JJOB->db->get_list();
		
		$pageData['uri'] = 'job/ac/learn/spid/' . $spid . '/scid/' . $scid . '/page/';
		
		include _g ( 'template' )->name ( 'job', 'learn', true );
		break;
}
?>