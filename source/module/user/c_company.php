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
		
		$tabTypeArr = array('base', 'des', 'logo', 'licence', 'zplx');
		$tabtype = _post('tabtype');
		if(!my_in_array($tabtype, $tabTypeArr)){
			smsg(lang(200001));
			return null;
		}
		
		$data = array();
		
		if($tabtype == 'base'){
			$cname = _post('cname');
			$csortid = _post('csortid');
			$cnatureid = _post('cnatureid');
			$csize = _post('csize');
			$area = _post('area');
			$area_detail = _post('area_detail');
			$contacts = _post('contacts');
			$telephone = _post('telephone');
			$mobilephone = _post('mobilephone');
			
			/* 公司名称 */
			if(!_g('validate')->vm(strlen($cname), 1, 90)){
				smsg ( lang ( 'user:cuser>100005', array(1, 30)) );
				return null;
			}
			/* 行业类别 */
			if(!my_is_array($csortid)){
				smsg ( lang ( 'user:cuser>100011') );
				return null;
			}
			/* 公司性质 */
			if(!_g('validate')->pnum($cnatureid)){
				smsg ( lang ( 'user:cuser>100012') );
				return null;
			}
			
			/* 联系人 */
			if(!_g('validate')->vm(strlen($contacts), 1, 20)){
				smsg ( lang ( 'user:cuser>100007', array(1, 20)) );
				return null;
			}
			/* 手机号 */
			if(!_g('validate')->pnum($mobilephone) || !_g('validate')->vm(strlen($mobilephone), 8, 11)){
				smsg ( lang ( 'user:cuser>100008') );
				return null;
			}
			
			/* 座机 */
			$telephone[0] = substr(my_array_value(0, $telephone), 0, 6);
			$telephone[1] = substr(my_array_value(1, $telephone), 0, 10);
			$telephone[2] = substr(my_array_value(2, $telephone), 0, 6);
			$telephone = array2str($telephone);
			
			$data['cuser'] = array(
					'cname'=>$cname,
					'area'=>$area,
					'area_detail'=>$area_detail,
					'contacts'=>$contacts,
					'telephone'=>my_addslashes($telephone),
					'mobilephone'=>$mobilephone
				);
			/* 资料 */
			$__csortid = null;
			foreach ($csortid as $__v){
				$__csortid .= ',' . $__v . ',';
			}
			$data['profile'] = array(
					'csortid'=>$__csortid,
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
						smsg(lang('user:cuser>400000'));
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
						smsg(lang('user:cuser>400000'));
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
						smsg(lang('user:cuser>400000'));
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
						smsg(lang('user:cuser>400000'));
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
		}else if ($tabtype == 'zplx'){
			$act_type = _post('act_type');
			if($act_type == 'write'){
				$zplxid = _post('zplxid');
				$zname = _post('zname');
				$mp0 = _post('mp0');
				$mp1 = _post('mp1');
				$mp2 = _post('mp2');
				$tp = _post('tp');
				$email = _post('email');
				$ctime = _g('cfg>time');
				
				if(!_g('validate')->num($zplxid)){
					smsg(lang(200010));
					return null;
				}
				
				if(strlen($zname) < 1){
					smsg(lang('user:cuser>500000'));
					return null;
				}
				
				if(strlen($mp1) < 1 && strlen($tp) < 1){
					smsg(lang('user:cuser>500001'));
					return null;
				}
				
				$zplxRs = null;
				if(_g('validate')->pnum($zplxid)){
					$zplxRs = $CZPLX->find('zplxid', $zplxid);
					if(!$CZPLX->db->is_success($zplxRs)){
						smsg(lang('200013'));
						return null;
					}
					if(!my_is_array($zplxRs)){
						smsg(lang('100061'), null, array('type'=>'n'));
						return null;
					}
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
				if(!(!$zplxRs ? $CZPLX->insert($data) : $CZPLX->update($zplxid, $data))){
					smsg(lang('200013'));
					return null;
				}
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	case 'delete':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$zplxid = _post('zplxid');
		if(!_g('validate')->pnum($zplxid)){
			smsg(lang(200010));
			return null;
		}
		$zplxRs = $CZPLX->find('zplxid', $zplxid);
		if(!$CZPLX->db->is_success($zplxRs)){
			smsg(lang('200013'));
			return null;
		}
		if(my_is_array($zplxRs)){
			if(!$CZPLX->delete($zplxid)){
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	default :
		$cUserData = $CUSER->find_jion('a.cuid', $cuid);
		
		if(!my_is_array($cUserData)){
			smsg(lang('user:cuser>300001'));
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
		$zplxPageData['uri'] = 'user/t/c_company/tab/3/page/';
		
		include _g ( 'template' )->name ( 'user', 'c_company', true );
		break;
}
?>