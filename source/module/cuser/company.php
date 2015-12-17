<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$cuid = $UModel->suser('cuid');

switch (_get ( 'op' )) {
	case 'do':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		
		$tabTypeArr = array('base', 'des', 'logo', 'licence');
		$tabtype = _post('tabtype');
		if(!my_in_array($tabtype, $tabTypeArr)){
			smsg(lang(200001));
			return null;
		}
		
		$data = array();
		
		if($tabtype == 'base'){
			$username = _post('username');
			$cname = _post('cname');
			$professionid = _post('professionid');
			$cnatureid = _post('cnatureid');
			$csize = _post('csize');
			$area = _post('area');
			$area_detail = _post('area_detail');
			$contacts = _post('contacts');
			$telephone = _post('telephone');
			$mobilephone = _post('mobilephone');
			
			/* username */
			if ($CUSER->isUsername ( $username )) {
				if (!_g ( 'validate' )->en_len ( $username, 1, 20 )) {
					smsg ( lang ( 'cuser:100000', array(1, 20)) );
					return null;
				}
			}
			/* 公司名称 */
			if(!_g('validate')->vm(strlen($cname), 1, 90)){
				smsg ( lang ( 'cuser:100005', array(1, 30)) );
				return null;
			}
			/* 行业类别 */
			if(!my_is_array($professionid)){
				smsg ( lang ( 'cuser:100011') );
				return null;
			}
			/* 公司性质 */
			if(!_g('validate')->pnum($cnatureid)){
				smsg ( lang ( 'cuser:100012') );
				return null;
			}
			
			/* 联系人 */
			if(!_g('validate')->vm(strlen($contacts), 1, 20)){
				smsg ( lang ( 'cuser:100007', array(1, 20)) );
				return null;
			}
			/* 手机号 */
			if(!_g('validate')->pnum($mobilephone) || !_g('validate')->vm(strlen($mobilephone), 8, 11)){
				smsg ( lang ( 'cuser:100008') );
				return null;
			}
			
			/* 座机 */
			$telephone[0] = substr(my_array_value(0, $telephone), 0, 6);
			$telephone[1] = substr(my_array_value(1, $telephone), 0, 10);
			$telephone[2] = substr(my_array_value(2, $telephone), 0, 6);
			$telephone = array2str($telephone);
			
			/* -- */
			$data['cuser'] = array ();
			if ($CUSER->isUsername ( $username )) {
				$data['cuser']['username'] = $username;
			}
			$data['cuser']['cname'] = $cname;
			$data['cuser']['area'] = $area;
			$data['cuser']['area_detail'] = $area_detail;
			$data['cuser']['contacts'] = $contacts;
			$data['cuser']['telephone'] = my_addslashes($telephone);
			$data['cuser']['mobilephone'] = $mobilephone;
			
			/* 资料 */
			$data['profile'] = array(
					'professionid'=>_g('value')->s2pnsplit( $professionid ),
					'cnatureid'=>$cnatureid,
					'csize'=>$csize
				);
			
			$CUSER->updateCUser($cuid, $data);
			
		}elseif ($tabtype == 'des'){
			$cdescription = _post('cdescription');
			
			$data['profile'] = array('cdescription'=>$cdescription);
			
			$CUSER->updateCUser($cuid, $data);
			
		}elseif ($tabtype == 'logo'){
			$act_type = _post('act_type');
			
			$profileRs = $CUSER->profile_find('cuid', $cuid);
			if(!$CUSER->db->is_success($profileRs)){
				smsg(lang('200013'));
				return null;
			}
			$rootDir = sdir(':uploadfile');
			$old_logoSrc = my_array_value('logo', $profileRs);
			
			/* data */
			$data = array('logo'=>null);
			
			if($act_type == 'del'){
				if(strlen($old_logoSrc) >= 1){
					if(!_g('file')->delete($rootDir . '/' . $old_logoSrc)){
						smsg(lang('cuser:400000'));
						return null;
					}
					if(!$CUSER->profileUpdate($cuid, array('logo'=>null))){
						smsg(lang('200013'));
						return null;
					}
				}
			}else{
				$extMsg = my_join(';', _g('module')->dv('@', 200000));
				/* 上传文件处理 */
				$fileDataArr = _ifile('ufile');
				if($fileDataArr['size'] < 1){
					smsg(lang(300001));
					return null;
				}
				$info = getimagesize($fileDataArr['tmp_name']);
				if(!_g('validate')->imagetype($fileDataArr['tmp_name'])){
					smsg(lang(300005, $extMsg));
					return null;
				}
				if(_g('validate')->fsover($fileDataArr['size'], 4)){
					smsg(lang(300006, 4));
					return null;
				}
				if($info[0] < 1 || $info[1] < 1){
					smsg(lang(300008));
					return null;
				}
				/* 保存目录 */
				$saveDir = 'job/logo/' . date('Ym');
				if(!_g('file')->create_dir($rootDir, $saveDir)){
					smsg(lang('300003'));
					return null;
				}
				/* 文件名 */
				$sfname = $saveDir . '/' . _g('file')->nname($fileDataArr['name']);
				
				/* 更新原文件 */
				if(strlen($old_logoSrc) >= 1){
					if(!_g('file')->delete($rootDir . '/' . $old_logoSrc)){
						smsg(lang('cuser:400000'));
						return null;
					}
				}
				$data['logo'] = $sfname;
				if(!$CUSER->profileUpdate($cuid, $data)){
					smsg(lang('200013'));
					return null;
				}
				if(!move_uploaded_file($fileDataArr['tmp_name'], ($rootDir . '/' . $sfname))){
					smsg(lang('300002'));
					return null;
				}
			}
			
		}elseif ($tabtype == 'licence'){
			$act_type = _post('act_type');
				
			$profileRs = $CUSER->profile_find('cuid', $cuid);
			if(!$CUSER->db->is_success($profileRs)){
				smsg(lang('200013'));
				return null;
			}
				
			$rootDir = sdir(':uploadfile');
			$old_licenceSrc = my_array_value('licence', $profileRs);
			/* data */
			$data = array(
					'authlicence'=>_g('value')->sb(false),
					'licence'=>null
			);
			
			if($act_type == 'del'){
				if(strlen($old_licenceSrc) >= 1){
					if(!_g('file')->delete($rootDir . '/' . $old_licenceSrc)){
						smsg(lang('cuser:400000'));
						return null;
					}
					if(!$CUSER->profileUpdate($cuid, $data)){
						smsg(lang('200013'));
						return null;
					}
				}
			}else{
				$extMsg = my_join(';', _g('module')->dv('@', 200000));
			
				/* 上传文件处理 */
				$fileDataArr = _ifile('ufile');
				if($fileDataArr['size'] < 1){
					smsg(lang(300001));
					return null;
				}
				$info = getimagesize($fileDataArr['tmp_name']);
				if(!_g('validate')->imagetype($fileDataArr['tmp_name'])){
					smsg(lang(300005, $extMsg));
					return null;
				}
				if(_g('validate')->fsover($fileDataArr['size'], 4)){
					smsg(lang(300006, 4));
					return null;
				}
				if($info[0] < 1 || $info[1] < 1){
					smsg(lang(300008));
					return null;
				}
				/* 保存目录 */
				$saveDir = 'job/licence/' . date('Ym');
				if(!_g('file')->create_dir($rootDir, $saveDir)){
					smsg(lang('300003'));
					return null;
				}
				/* 文件名 */
				$sfname = $saveDir . '/' . _g('file')->nname($fileDataArr['name']);
			
				/* 更新原文件 */
				if(strlen($old_licenceSrc) >= 1){
					if(!_g('file')->delete($rootDir . '/' . $old_licenceSrc)){
						smsg(lang('cuser:400000'));
						return null;
					}
				}
				
				$data['licence'] = $sfname;
				if(!$CUSER->profileUpdate($cuid, $data)){
					smsg(lang('200013'));
					return null;
				}
				if(!move_uploaded_file($fileDataArr['tmp_name'], ($rootDir . '/' . $sfname))){
					smsg(lang('300002'));
					return null;
				}
			}
		}
		smsg(lang('100061'), null, 1);
		break;
		break;
	default :
		$cUserData = $CUSER->find_jion('a.cuid', $cuid);
		if(!my_is_array($cUserData)){
			smsg(lang('cuser:300001'));
			return null;
		}
		
		include _g ( 'template' )->name ( 'cuser', 'company', true );
		break;
}
?>