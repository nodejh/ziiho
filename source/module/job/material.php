<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('user', 'cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$JJOB = _g('module')->trigger('job', 'job');
$JMaterial = _g('module')->trigger('job', 'material');
$JMFile = _g('module')->trigger('job', 'material_file');

/* 返回url */
$goBack = $_SERVER['HTTP_REFERER'];

switch (_get ( 'op' )) {
	case 'view':
		$materialid = _get('id');
		if(!_g('validate')->pnum($materialid)){
			smsg(lang(200010), $goBack);
			return null;
		}
		$materialData = $JMaterial->find('materialid', $materialid);
		if(!my_is_array($materialData)){
			smsg(lang('job:400000'), $goBack);
			return null;
		}
		
		$sortData = $JMODEL->sortValue($materialData['sortid']);
		$sortParentData = $JMODEL->sortValue($sortData['parentid']);
		
		/* relate result */
		$relateResult = $JMaterial->relate($materialData['sortid'], $materialData['materialid']);
		
		include _g ( 'template' )->name ( 'job', 'material-view', true );
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
		$JMaterial->db->from($JMaterial->t_job_material);
		$JMaterial->db->where_in('sortid', $__scidArr);
		$pageData = _g('page')->c($JMaterial->db->count(), 15, 10, _get('page'));
		$JMaterial->db->order_by('ctime', 'DESC');
		$JMaterial->db->limit($pageData['start'], $pageData['size']);
		$JMaterial->db->select();
		$dataResult = $JMaterial->db->get_list();
		
		$pageData['uri'] = 'job/ac/learn/spid/' . $spid . '/scid/' . $scid . '/page/';
		
		include _g ( 'template' )->name ( 'job', 'material', true );
		break;
}
?>