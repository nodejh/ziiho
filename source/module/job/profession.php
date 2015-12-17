<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$CUMODEL = _g('module')->trigger('user', 'model');
$JMODEL = _g('module')->trigger('job', 'model');
$JSORT = _g('module')->trigger('job', 'sort');
$JTYPE = _g('module')->trigger('job', 'jtype');
$JJOB = _g('module')->trigger('job', 'job');

switch (_get ( 'op' )) {
	case 'c':
		include _g ( 'template' )->name ( 'job', 'profession-job', true );
		break;
	default :
		$JSORT->db->from($JSORT->t_job_sort);
		$JSORT->db->where('parentid', 0);
		$JSORT->db->order_by('listorder');
		$JSORT->db->select();
		$sortResult = $JSORT->db->get_list();
		
		/* 指定行业 */
		$q_isSortid = false;
		$__q_sortids = array();
		$sortid = _get('sortid');
		if(_g('validate')->hasget('sortid')){
			if(_g('validate')->pnum($sortid)){
				$sortCRs = $JSORT->finds(array('parentid'=> $sortid, 'status'=>_g('value')->sb(true)));
				while ($rs = $JSORT->db->fetch_array($sortCRs)){
					$__q_sortids[] = $rs['sortid'];
				}
				$q_isSortid = true;
			}
		}
		
		
		/* 所有职位招聘 */
		$CUSER->db->join($CUSER->t_cuser, 'a.cuid', $CUSER->t_cuser_profile, 'b.cuid', 'LEFT JOIN');
		if($q_isSortid && !empty($__q_sortids)){
			foreach ($__q_sortids as $__sortid){
				$CUSER->db->where_like('b.csortid', ',' . $__sortid . ',', 'OR');
			}
		}
		$CUSER->db->select($CUSER->t_field);
		$userResult = $CUSER->db->get_list();
		
		include _g ( 'template' )->name ( 'job', 'profession', true );
		break;
}
?>