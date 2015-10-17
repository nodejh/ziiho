<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g ( 'module' )->trigger ( 'user' );
$UGROUP = _g ( 'module' )->trigger ( 'user', 'group' );

/* 组类型 */
$uGroupData = _g('module')->dv('user', 100002);
$ugtype = null;
$ugtypeYN = true;
if(_g('validate')->hasget('ugtype')){
	$ugtype = _get('ugtype');
	$ugtypeYN = _g('validate')->pnum($ugtype);
}else{
	if(_g('validate')->haspost('ugtype')){
		$ugtype = _post('ugtype');
		$ugtypeYN = _g('validate')->pnum($ugtype);
	}else{
		$ugtype = my_array_value('v', my_fisrt($uGroupData));
	}
}
if(!$ugtypeYN){
	smsg(lang('user:400000'), _g('cp')->uri('mod/user/ac/usergroup'));
	return null;
}

$curUrl = _g('cp')->uri('mod/user/ac/usergroup/ugtype/' . $ugtype);

/* setting url */
$mSettingUri = 'mod/user/ac/usergroup/op/msetting';
$settingUri = 'mod/user/ac/usergroup/op/setting';

switch (_get ( 'op' )) {
	case 'add':
		$gname = _post('_gname');
		$sexp = _post('_sexp');
		$eexp = _post('_eexp');
		$ranksrc = _post('_ranksrc');
		$ctime = _g('cfg>time');
		
		if(strlen($gname) < 1){
			smsg(lang('user:400002'));
			return null;
		}
		if(!_g('validate')->pnum($sexp)){
			$sexp = 0;
		}
		if(!_g('validate')->pnum($eexp)){
			$eexp = 0;
		}
		
		$data = array(
				'gname' => $gname,
				'sexp' => $sexp,
				'eexp' => $eexp,
				'ranksrc' => $ranksrc,
				'ctime' => $ctime,
				'ugtype' => $ugtype
		);
		if(!$UGROUP->insert($data)){
			smsg(lang('200013'));
		}else{
			smsg(lang('100061'), null, 1);
		}
		break;
	case 'update':
		$ugid = _post('ugid');
		$gname = _post('gname');
		$sexp = _post('sexp');
		$eexp = _post('eexp');
		$ranksrc = _post('ranksrc');
		
		if(!my_is_array($ugid)){
			smsg(lang(200010));
			return null;
		}
		foreach ($ugid as $id){
			$data = array();
			if(strlen($gname[$id]) >= 1){
				$data['gname'] = $gname[$id];
			}
			if(_g('validate')->num($sexp[$id])){
				$data['sexp'] = $sexp[$id];
			}
			if(_g('validate')->num($eexp[$id])){
				$data['eexp'] = $eexp[$id];
			}
			$data['ranksrc'] = $ranksrc[$id];
			if(!$UGROUP->update($data, 'ugid', $id)){
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	case 'delete':
		$ugid = _post('id');
		
		if(!_g('validate')->pnum($ugid)){
			smsg(lang(200010));
			return null;
		}
		if(!$UGROUP->delete('ugid', $ugid)){
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	case 'msetting':
		$ugid = _get('ugid');
		$usergroupSub = $UGROUP->find('ugid', $ugid);
		if(!my_is_array($usergroupSub)){
			smsg(lang('user:400001'), $curUrl);
			return null;
		}
		$mgrData = str2array($usergroupSub['mgr']);
		_g ( 'cp' )->set_template ( 'user', 'usergroup_msetting' );
		break;
	case 'msettingdo':
		$ugid = _post('ugid');
		$usergroupSub = $UGROUP->find('ugid', $ugid);
		if(!my_is_array($usergroupSub)){
			smsg(lang('user:400001'));
			return null;
		}
		$menuid = _post('menuid');
		
		/* mgr data */
		$data = array(
				'menuid' => $menuid
		);
		$data = array2str($data);
		
		/* update data */
		$updates = array(
				'mgr' => my_addslashes($data)
		);
		
		if(!$UGROUP->update($updates, 'ugid', $ugid)){
			smsg(lang('200013'));
		}else{
			smsg(lang('100061'), null, 1);
		}
		break;
	case 'setting':
		$ugid = _get('ugid');
		$usergroupSub = $UGROUP->find('ugid', $ugid);
		if(!my_is_array($usergroupSub)){
			smsg(lang('user:400001'), $curUrl);
			return null;
		}
		$allowData = str2array($usergroupSub['allow']);
		
		_g ( 'cp' )->set_template ( 'user', 'usergroup_setting' );
		break;
	case 'settingdo':
		$ugid = _post('ugid');
		$usergroupSub = $UGROUP->find('ugid', $ugid);
		if(!my_is_array($usergroupSub)){
			smsg(lang('user:400001'));
			return null;
		}
		
		$follows = my_less0value( _post('follows'), 0 );
		
		/* allow data */
		$data = array(
				'follows' => $follows
		);
		$data = array2str($data);
		
		/* update data */
		$updates = array(
				'allow' => my_addslashes($data)
		);
		if(!$UGROUP->update($updates, 'ugid', $ugid)){
			smsg(lang('200013'));
		}else{
			smsg(lang('100061'), null, 1);
		}
		break;
	default :
		_g('uri')->referer(true);
		
		$UGROUP->db->from($UGROUP->t_user_group);
		$UGROUP->db->where('ugtype', $ugtype);
		$UGROUP->db->select();
		$uGroupResult = $UGROUP->db->get_list();
		
		_g ( 'cp' )->set_template ( 'user', 'usergroup' );
		break;
}
?>