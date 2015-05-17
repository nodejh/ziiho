<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUser = _g ( 'module' )->trigger ( 'user', 'cuser' );
$CSort = _g ( 'module' )->trigger ( 'job', 'sort' );
$CArea = _g ( 'module' )->trigger ( 'job', 'area' );
$CNature = _g ( 'module' )->trigger ( 'job', 'nature' );

$CUri = _g('cp')->uri('mod/user/ac/cuser');

switch (_get ( 'op' )) {
	case 'detail':
		$cuid = _get('cuid');
		if(!_g('validate')->pnum($cuid)){
			smsg(lang('user:cuser>300000'));
			return null;
		}
		$CUserRs = $CUser->find_jion('a.cuid', $cuid);
		if(!my_is_array($CUserRs)){
			smsg(lang('user:cuser>300001'));
			return null;
		}
		_g ( 'cp' )->set_template ( 'user', 'cuser_detail' );
		break;
		
	case 'detail_update':
		$cuid = _post('cuid');
		/* 步骤一 */
		$cname = _post('cname');
		$area = _post('area');
		$area_detail = _post('area_detail');
		$contacts = _post('contacts');
		$telephone = _post('telephone');
		$mobilephone = _post('mobilephone');
		$cemail = _post('cemail');
		
		/* 步骤二 */
		$csortid = _post('csortid');
		$cnatureid = _post('cnatureid');
		$csize = _post('csize');
		$cdescription = _post('cdescription');
		$recruitment = _post('recruitment');
		$rtelephone = _post('rtelephone');
		$rmobilephone = _post('rmobilephone');
		
		if(!_g('validate')->pnum($cuid)){
			smsg(lang('user:cuser>300000'));
			return null;
		}
		if(!my_is_array($CUser->find('cuid', $cuid))){
			smsg(lang('user:cuser>300001'));
			return null;
		}
		
		/* 主表 */
		$data1 = array(
				'cname'=>$cname,
				'area'=>my_join(',', $area),
				'area_detail'=>$area_detail,
				'contacts'=>$contacts,
				'telephone'=>my_addslashes(array2str($telephone)),
				'mobilephone'=>$mobilephone,
				'cemail'=>$cemail
		);
		/* 资料 */
		$__csortid = null;
		foreach ($csortid as $__v){
			$__csortid .= ',' . $__v . ',';
		}
		$data2 = array(
				'cuid'=>$cuid,
				'csortid'=>$__csortid,
				'cnatureid'=>$cnatureid,
				'csize'=>$csize,
				'cdescription'=>$cdescription,
				'recruitment'=>$recruitment,
				'rtelephone'=>my_addslashes(array2str($rtelephone)),
				'rmobilephone'=>$rmobilephone
		);
		$CUser->update($cuid, $data1, $data2);
		break;
	default :
		_g('uri')->referer(true);
		
		$CUser->db->join($CUser->t_user_cuser, 'a.cuid', $CUser->t_user_cuser_profile, 'b.cuid', 'LEFT JOIN');
		$pageData = _g('page')->c($CUser->db->count(), 15, 10, _get('page'));
		$CUser->db->limit($pageData['start'], $pageData['size']);
		$CUser->db->order_by('a.regtime', 'DESC');
		$CUser->db->select($CUser->t_field);
		$dataResult = $CUser->db->get_list();
		
		_g ( 'cp' )->set_template ( 'user', 'cuser' );
		break;
}
?>