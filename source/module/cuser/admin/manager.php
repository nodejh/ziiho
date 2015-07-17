<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CSort = _g ( 'module' )->trigger ( 'job', 'sort' );
$CArea = _g ( 'module' )->trigger ( 'job', 'area' );
$CNature = _g ( 'module' )->trigger ( 'job', 'nature' );
$CZPLX = _g ( 'module' )->trigger ( 'job', 'zplx' );

$CUser = _g ( 'module' )->trigger ( 'cuser' );
$CR = _g ( 'module' )->trigger ( 'cuser', 'recommend' );

$CUri = _g('cp')->uri('mod/cuser/ac/manager');

switch (_get ( 'op' )) {
	case 'detail':
		$cuid = _get('cuid');
		if(!_g('validate')->pnum($cuid)){
			smsg(lang('cuser:300000'));
			return null;
		}
		$CUserRs = $CUser->find_jion('a.cuid', $cuid);
		if(!my_is_array($CUserRs)){
			smsg(lang('cuser:300001'));
			return null;
		}
		
		/* 联系人 */
		$CZPLX->db->from($CZPLX->t_job_zplx);
		$CZPLX->db->where('cuid', $cuid);
		$zplxPageData = _g('page')->c($CZPLX->db->count(), 10, 10, _get('page'));
		$CZPLX->db->limit($zplxPageData['start'], $zplxPageData['size']);
		$CZPLX->db->order_by('ctime');
		$CZPLX->db->select($CZPLX->t_field);
		$zplxResult = $CZPLX->db->get_list();
		
		$zplxPageData['uri'] = 'mod/cuser/ac/manager/op/detail/cuid/' . $cuid . '/tab/3/page/';
		
		_g ( 'cp' )->set_template ( 'cuser', 'manager_detail' );
		break;
		
	case 'detail_update':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$cuid = _post('cuid');
		$cuser_act = _post('cuser_act');
		
		if(!_g('validate')->pnum($cuid)){
			smsg(lang('cuser:300000'));
			return null;
		}
		if(!my_is_array($CUser->find('cuid', $cuid))){
			smsg(lang('cuser:300001'));
			return null;
		}
		
		if($cuser_act == 'base'){
			$cname = _post('cname');
			$area = _post('area');
			$area_detail = _post('area_detail');
			$contacts = _post('contacts');
			$telephone = _post('telephone');
			$mobilephone = _post('mobilephone');
			$cemail = _post('cemail');
			
			$csortid = _post('csortid');
			$cnatureid = _post('cnatureid');
			$csize = _post('csize');
			
			$data1 = array(
					'cname'=>$cname,
					'area'=>my_join(',', $area),
					'area_detail'=>$area_detail,
					'contacts'=>$contacts,
					'telephone'=>my_addslashes(array2str($telephone)),
					'mobilephone'=>$mobilephone,
					'cemail'=>$cemail
			);
			/* profile */
			$__csortid = null;
			foreach ($csortid as $__v){
				$__csortid .= ',' . $__v . ',';
			}
			
			$data2 = array(
					'cuid'=>$cuid,
					'csortid'=>$__csortid,
					'cnatureid'=>$cnatureid,
					'csize'=>$csize
			);
			$CUser->update($cuid, $data1, $data2);
		}else if ($cuser_act == 'des'){
			$cdescription = _post('cdescription');
			if(!$CUser->profileUpdate($cuid, array('cdescription'=>$cdescription))){
				smsg(lang('200013'));
			}else{
				smsg(lang('100061'), null, 1);
			}
			return null;
		} else if ($cuser_act == 'logo'){
			$act_type = _post('act_type');
			
			$profileRs = $CUser->profile_find('cuid', $cuid);
			if(!$CUser->db->is_success($profileRs)){
				smsg(lang('200013'));
				return null;
			}
			
			/* root dir */
			$rootDir = sdir(':uploadfile');
			
			if($act_type == 'del_logo'){
				/* 删除logo */
				if(my_is_array($profileRs)){
					if(!_g('file')->delete($rootDir . '/' . $profileRs['logo'])){
						smsg ( lang ( 'cuser:400000' ) );
						return null;
					}
				}
				if(!$CUser->profileUpdate($cuid, array('logo'=>null))){
					smsg ( lang ( '200013' ) );
					return null;
				}
			} else {
				$fileData = _ifile('logofile');
				$extMsg = my_join(';', _g('module')->dv('@', 200000));
				
				if($fileData['size'] < 1){
					smsg(lang(300010));
					return null;
				}
				
				$info = getimagesize($fileData['tmp_name']);
				if(!_g('validate')->imagetype($fileData['tmp_name'])){
					smsg(lang(300005, $extMsg));
					return null;
				}
				if(_g('validate')->fsover($fileData['size'], 4)){
					smsg(lang(300006, 4));
					return null;
				}
				if($info[0] < 1 || $info[1] < 1){
					smsg(lang(300007, array(1, 1)));
					return null;
				}
				
				/* 保存目录 */
				$saveDir = 'job/logo/' . date('Ym');
				if(!_g('file')->create_dir($rootDir, $saveDir)){
					smsg(lang('300003'));
					return null;
				}
				/* 文件名 */
				$sfname = $saveDir . '/' . _g('file')->nname($fileData['name']);
				
				/* 删除logo */
				if(my_is_array($profileRs)){
					if(!_g('file')->delete($rootDir . '/' . $profileRs['logo'])){
						smsg ( lang ( 'cuser:400000' ) );
						return null;
					}
				}
				if(!$CUser->profileUpdate($cuid, array('logo'=>$sfname))){
					smsg ( lang ( '200013' ) );
					return null;
				}
				
				/* 上传文件 */
				if(!move_uploaded_file($fileData['tmp_name'], ($rootDir . '/' . $sfname))){
					smsg(lang('300002'));
					return null;
				}
			}
		} else if ($cuser_act == 'licence'){
			$act_type = _post('act_type');
			
			$profileRs = $CUser->profile_find('cuid', $cuid);
			if(!$CUser->db->is_success($profileRs)){
				smsg(lang('200013'));
				return null;
			}
			
			/* root dir */
			$rootDir = sdir(':uploadfile');
			
			if($act_type == 'del_licence'){
				/* 删除licence */
				if(my_is_array($profileRs)){
					if(!_g('file')->delete($rootDir . '/' . $profileRs['licence'])){
						smsg ( lang ( 'cuser:400000' ) );
						return null;
					}
				}
				if(!$CUser->profileUpdate($cuid, array('authlicence'=>_g('value')->sb(false), 'licence'=>null))){
					smsg ( lang ( '200013' ) );
					return null;
				}
			} else if($act_type == 'status'){
				$authlicence = _g('value')->sb(_post('authlicence'));
				if(!$CUser->profileUpdate($cuid, array('authlicence'=>$authlicence))){
					smsg ( lang ( '200013' ) );
					return null;
				}
			} else {
				$fileData = _ifile('licencefile');
				$extMsg = my_join(';', _g('module')->dv('@', 200000));
				
				if($fileData['size'] < 1){
					smsg(lang(300010));
					return null;
				}
				
				$info = getimagesize($fileData['tmp_name']);
				if(!_g('validate')->imagetype($fileData['tmp_name'])){
					smsg(lang(300005, $extMsg));
					return null;
				}
				if(_g('validate')->fsover($fileData['size'], 4)){
					smsg(lang(300006, 4));
					return null;
				}
				if($info[0] < 1 || $info[1] < 1){
					smsg(lang(300007, array(1, 1)));
					return null;
				}
				
				/* 保存目录 */
				$saveDir = 'job/licence/' . date('Ym');
				if(!_g('file')->create_dir($rootDir, $saveDir)){
					smsg(lang('300003'));
					return null;
				}
				/* 文件名 */
				$sfname = $saveDir . '/' . _g('file')->nname($fileData['name']);
				
				/* 删除licence */
				if(my_is_array($profileRs)){
					if(!_g('file')->delete($rootDir . '/' . $profileRs['licence'])){
						smsg ( lang ( 'cuser:400000' ) );
						return null;
					}
				}
				if(!$CUser->profileUpdate($cuid, array('licence'=>$sfname))){
					smsg ( lang ( '200013' ) );
					return null;
				}
				
				/* 上传文件 */
				if(!move_uploaded_file($fileData['tmp_name'], ($rootDir . '/' . $sfname))){
					smsg(lang('300002'));
					return null;
				}
			}
		} else if ($cuser_act == 'zplx'){
			$act_type = _post('act_type');
			
			if($act_type == 'delete'){
				$zplxid = _post('del_zplxid');
				if(!_g('validate')->pnum($zplxid)){
					smsg(lang(200010));
					return null;
				}
				if(!$CZPLX->delete($zplxid)){
					smsg(lang(200013));
					return null;
				}
			} else if ($act_type == 'add'){
				$zname = _post('_zname');
				$mp0 = _post('_mp0');
				$mp1 = _post('_mp1');
				$mp2 = _post('_mp2');
				$tp = _post('_tp');
				$email = _post('_email');
				$ctime = _g('cfg>time');
				
				if(strlen($zname) < 1){
					smsg(lang('cuser:500000'));
					return null;
				}
				
				if(strlen($mp1) < 1 && strlen($tp) < 1){
					smsg(lang('cuser:500001'));
					return null;
				}
				
				$data = array(
						'zname'=>$zname,
						'mp0'=>$mp0,
						'mp1'=>$mp1,
						'mp2'=>$mp2,
						'tp'=>$tp,
						'email'=>$email,
						'ctime'=>$ctime,
						'cuid'=>$cuid
				);
				if(!$CZPLX->insert($data)){
					smsg(lang('200013'));
					return null;
				}
			} else {
				$zplxid = _post('zplxid');
				$zname = _post('zname');
				$mp0 = _post('mp0');
				$mp1 = _post('mp1');
				$mp2 = _post('mp2');
				$tp = _post('tp');
				$email = _post('email');
				
				if(!my_is_array($zplxid)){
					smsg ( lang ( '200014' ) );
					return null;
				}
				
				foreach ($zplxid as $__zplxID){
					$data = array();
					if(strlen($zname[$__zplxID]) >= 1){
						$data['zname'] = $zname[$__zplxID];
					}
					if(strlen($mp0[$__zplxID]) >= 1){
						$data['mp0'] = $mp0[$__zplxID];
					}
					if(strlen($mp1[$__zplxID]) >= 1){
						$data['mp1'] = $mp1[$__zplxID];
					}
					if(strlen($mp2[$__zplxID]) >= 1){
						$data['mp2'] = $mp2[$__zplxID];
					}
					if(strlen($tp[$__zplxID]) >= 1){
						$data['tp'] = $tp[$__zplxID];
					}
					if(strlen($email[$__zplxID]) >= 1){
						$data['email'] = $email[$__zplxID];
					}
					if(!$CZPLX->update($__zplxID, $data)){
						smsg(lang('200013'));
						return null;
					}
				}
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	case 'set':
		$cuid = _get('cuid');
		if(!_g('validate')->pnum($cuid)){
			smsg(lang('cuser:300000'));
			return null;
		}
		$CUserRs = $CUser->find_jion('a.cuid', $cuid);
		if(!my_is_array($CUserRs)){
			smsg(lang('cuser:300001'));
			return null;
		}
		$recommentRs = $CR->find('cuid', $cuid);
		if(!$CR->db->is_success($recommentRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($recommentRs)){
			$recommentRs = array(
					'stime'=>date('Y-m-d H:i:s', _g('cfg>time')),
					'etime'=>date('Y-m-d H:i:s', _g('cfg>time'))
			);
		}else{
			$recommentRs['stime'] = date('Y-m-d H:i:s', $recommentRs['stime']);
			$recommentRs['etime'] = date('Y-m-d H:i:s', $recommentRs['etime']);
		}
		_g ( 'cp' )->set_template ( 'cuser', 'manager_set' );
		break;
	case 'set_do':
		$acts = array('recommend', 'account', 'password');
		$actflag = _post('act');
		$doflag = _post('doflag');
		
		if(!my_in_array($actflag, $acts)){
			smsg(lang(200001));
			return null;
		}
		
		$cuid = _post('cuid');
		if(!_g('validate')->pnum($cuid)){
			smsg(lang(200010));
			return null;
		}
		$CUserRs = $CUser->find('cuid', $cuid);
		if(!$CUser->db->is_success($CUserRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($CUserRs)){
			smsg(lang('cuser:100017'));
			return null;
		}
		
		if($actflag == 'recommend'){
			$level = _post('level');
			$stime = _post('stime');
			$etime = _post('etime');
			$ctime = _g('cfg>time');
			
			$recommentRs = $CR->find('cuid', $cuid);
			if(!$CR->db->is_success($recommentRs)){
				smsg(lang('200013'));
				return null;
			}
			
			if(_g('validate')->pnum($level)){
				$data = array(
						'level' => $level,
						'stime' => strtotime($stime),
						'etime' => strtotime($etime),
						'ctime' => $ctime,
						'cuid' => $cuid
				);
				if(!(!my_is_array($recommentRs) ? $CR->insert($data) : $CR->update($data, 'cuid', $cuid))){
					smsg(lang('200013'));
					return null;
				}
			}else{
				if(my_is_array($recommentRs)){
					if(!$CR->delete('cuid', $cuid)){
						smsg(lang('200013'));
						return null;
					}
				}
			}
		}else if ($actflag == 'account'){
			$doflags = array('status');
			if(!my_in_array($doflag, $doflags)){
				smsg(lang(200001));
				return null;
			}
			if($doflag = 'status'){
				$status = _post('status');
				$data = array(
						'status' => _g('value')->sb($status)
				);
				if(!$CUser->updateSet($data, 'cuid', $cuid)){
					smsg(lang('200013'));
					return null;
				}
			}
		}else if($actflag == 'password'){
			$password = _post('password');
			if(strlen($password) < 6){
				smsg(lang('cuser:300005', array(6, 30)));
				return null;
			}
			$data = array(
					'password' => my_md5($password, 2)
			);
			if(!$CUser->updateSet($data, 'cuid', $cuid)){
				smsg(lang('200013'));
				return null;				
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	default :
		_g('uri')->referer(true);
		
		$q_csortid = _get('q_csortid');
		$q_cuid = urldecode(_get('q_cuid'));
		$q_username = urldecode(_get('q_username'));
		$q_cname= urldecode(_get('q_cname'));
		$q_status = _get('q_status');
		$q_authlicence = _get('q_authlicence');
		$q_recommend = _get('q_recommend');
		
		$qWhere = array();
		if(_g('validate')->hasget('q_csortid')){
			if(_g('validate')->pnum($q_csortid)){
				$qWhere['csortid'] = $q_csortid;
			}
		}
		
		if(_g('validate')->hasget('q_cuid')){
			if(_g('validate')->pnum($q_cuid)){
				$qWhere['cuid'] = $q_cuid;
			}
		}
		
		if(_g('validate')->hasget('q_username')){
			if(strlen($q_username) >= 1){
				$qWhere['username'] = $q_username;
			}
		}
		
		if(_g('validate')->hasget('q_cname')){
			if(strlen($q_cname) >= 1){
				$qWhere['cname'] = $q_cname;
			}
		}
		
		if(_g('validate')->hasget('q_status')){
			if(_g('validate')->sb2in($q_status)){
				$qWhere['status'] = _g('value')->sb($q_status);
			}
		}
		
		if(_g('validate')->hasget('q_authlicence')){
			if(_g('validate')->sb2in($q_authlicence)){
				$qWhere['authlicence'] = _g('value')->sb($q_authlicence);
			}
		}
		
		
		if(_g('validate')->sb2eq($q_recommend)){
			
		}
		
		/* query list */
		$CUser->db->join($CUser->t_cuser, 'a.cuid', $CUser->t_cuser_profile, 'b.cuid', 'LEFT JOIN');
		
		if(array_key_exists('cuid', $qWhere)){
			$CUser->db->where('a.cuid', $qWhere['cuid']);
		}
		if(array_key_exists('username', $qWhere)){
			$CUser->db->where_regexp('a.username', ($qWhere['username']));
		}
		if(array_key_exists('status', $qWhere)){
			$CUser->db->where('a.status', $qWhere['status']);
		}
		if(array_key_exists('cname', $qWhere)){
			$CUser->db->where_regexp('a.cname', ($qWhere['cname']));
		}
		if(array_key_exists('csortid', $qWhere)){
			$CUser->db->where_regexp('b.csortid', (',' . $qWhere['csortid'] . ','));
		}
		if(array_key_exists('authlicence', $qWhere)){
			$CUser->db->where('b.authlicence', $qWhere['authlicence']);
		}
		$pageData = _g('page')->c($CUser->db->count(), 15, 10, _get('page'));
		$CUser->db->limit($pageData['start'], $pageData['size']);
		$CUser->db->order_by('a.regtime', 'DESC');
		$CUser->db->select($CUser->t_field);
		$dataResult = $CUser->db->get_list();
		
		$pageData['uri'] = 'mod/cuser/ac/manager';
		foreach ($qWhere as $qk=>$qw){
			$pageData['uri'] .= '/q_' . $qk . '/' . urlencode($qw);
		}
		$pageData['uri'] .= '/page/';
		
		_g ( 'cp' )->set_template ( 'cuser', 'manager' );
		break;
}
?>