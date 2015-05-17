<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('user', 'cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$JTYPE = _g('module')->trigger('job', 'jtype');
$CJOB = _g('module')->trigger('job', 'job');
$CJSKILL = _g('module')->trigger('job', 'skill');

switch (_get ( 'op' )) {
	default :
		$__spid = null;
		$spid = 'a';
		if(_g('validate')->hasget('spid')){
			$spid = _get('spid');
			if($spid != 'a' && !_g('validate')->pnum($spid)){
				smsg(lang('200010'));
				return null;
			}
			$__spid = ($spid != 'a' ? $spid : null);
		}
		$parentResult = $JMODEL->readSort();
		
		/* 获取职位 */
		$CUSER->db->join($CUSER->t_user_cuser, 'a.cuid', $CUSER->t_user_cuser_profile, 'b.cuid', 'LEFT JOIN');
		if(!empty($__spid)){
			$CUSER->db->where_regexp('b.csortid', ',' . $__spid . ',');
		}
		$pageData = _g('page')->c($CUSER->db->count(), 15, 10, _get('page'));
		$CUSER->db->order_by('a.regtime', 'DESC');
		$CUSER->db->limit($pageData['start'], $pageData['size']);
		$CUSER->db->select($CUSER->t_field);
		$compayResult = $CUSER->db->get_list();
		
		$pageData['uri'] = 'job/ac/companys/spid/' . $spid . '/page/';
		
		include _g ( 'template' )->name ( 'job', 'company-list', true );
		break;
}
?>