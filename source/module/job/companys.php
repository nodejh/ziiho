<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$JTYPE = _g('module')->trigger('job', 'jtype');
$CJOB = _g('module')->trigger('job', 'job');
$CJSKILL = _g('module')->trigger('job', 'skill');

switch (_get ( 'op' )) {
	default :
		$__professionid = null;
		$professionid = 'a';
		if(_g('validate')->hasget('proid')){
			$professionid = _get('proid');
			if($professionid != 'a' && !_g('validate')->pnum($professionid)){
				smsg(lang('200010'));
				return null;
			}
			$__professionid = ($professionid != 'a' ? $professionid : null);
		}
		
		/* 获取职位 */
		$CUSER->db->join($CUSER->t_cuser, 'a.cuid', $CUSER->t_cuser_profile, 'b.cuid', 'LEFT JOIN');
		if(!empty($__professionid)){
			$CUSER->db->where_regexp('b.professionid', ',' . $__professionid . ',');
		}
		$pageData = _g('page')->c($CUSER->db->count(), 15, 10, _get('page'));
		$CUSER->db->order_by('a.regtime', 'DESC');
		$CUSER->db->limit($pageData['start'], $pageData['size']);
		$CUSER->db->select($CUSER->t_field);
		$compayResult = $CUSER->db->get_list();
		
		$pageData['uri'] = 'job/ac/companys/proid/' . $professionid . '/page/';
		
		include _g ( 'template' )->name ( 'job', 'company-list', true );
		break;
}
?>