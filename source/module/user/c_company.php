<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$cuid = $UModel->suser('cuid');

switch (_get ( 'op' )) {
	case 'do':
		$tabTypeArr = array('base', 'cdescription', 'recruit', 'file');
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
		}elseif ($tabtype == 'cdescription'){
			$cdescription = _post('cdescription');
			$data['profile'] = array('cdescription'=>$cdescription);
		}elseif ($tabtype == 'recruit'){
			$recruitment = _post('recruitment');
			$rtelephone = _post('rtelephone');
			$rmobilephone = _post('rmobilephone');
			$remail = _post('remail');
			
			/* 联系人 */
			if(!_g('validate')->vm(strlen($recruitment), 1, 20)){
				smsg ( lang ( 'user:cuser>100007', array(1, 20)) );
				return null;
			}
			/* 手机号 */
			if(!_g('validate')->pnum($rmobilephone) || !_g('validate')->vm(strlen($rmobilephone), 8, 11)){
				smsg ( lang ( 'user:cuser>100008') );
				return null;
			}
			/* 公司邮箱 */
			if(!_g('validate')->email($remail, 1)){
				smsg ( lang ( 'user:cuser>100016') );
				return null;
			}
			
			/* 座机 */
			$rtelephone[0] = substr(my_array_value(0, $rtelephone), 0, 6);
			$rtelephone[1] = substr(my_array_value(1, $rtelephone), 0, 10);
			$rtelephone[2] = substr(my_array_value(2, $rtelephone), 0, 6);
			$rtelephone = array2str($rtelephone);
			
			$data['profile'] = array(
					'recruitment'=>$recruitment,
					'rtelephone'=>my_addslashes($rtelephone),
					'rmobilephone'=>$rmobilephone,
					'remail'=>$remail
				);
		}else{
			$fileTypeArr = array('logo', 'licence');
			$filetype = _post('filetype');
			$extMsg = my_join(';', _g('module')->dv('@', 200000));
			
			if(!my_in_array($filetype, $fileTypeArr)){
				smsg ( lang ( 200001) );
				return null;
			}
			
			$cUserData = $CUSER->find_jion('a.cuid', $cuid);
			if(!my_is_array($cUserData)){
				smsg(lang('user:cuser>300001'));
				return null;
			}
			
			/* 上传文件处理 */
			$fileDataArr = ($filetype == 'logo' ? _ifile('logo') : _ifile('licence'));
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
			$rootDir = sdir(':uploadfile');
			$saveDir = 'job/cuser/company/' . date('Ym');
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($fileDataArr['name']);
			
			/* 更新原文件 */
			if($filetype == 'logo'){
				if(!_g('file')->delete($rootDir . '/' . my_array_value('logo', $cUserData))){
					smsg(lang('user:cuser>400000'));
					return null;
				}
				$data['profile'] = array('logo'=>$sfname);
			}else{
				if(!_g('file')->delete($rootDir . '/' . my_array_value('licence', $cUserData))){
					smsg(lang('user:cuser>400001'));
					return null;
				}
				$data['profile'] = array('licence'=>$sfname);
			}
			if(!$CUSER->updateCUser($cuid, $data)){
				return null;
			}
			if(!move_uploaded_file($fileDataArr['tmp_name'], ($rootDir . '/' . $sfname))){
				smsg(lang('300002'));
				return null;
			}
			smsg(lang('100063'), null, array('status'=>1, 'filename'=>$sfname));
			return null;
		}
		$CUSER->updateCUser($cuid, $data);
		break;
	case 'fdel':
		$fileTypeArr = array('logo', 'licence');
		$filetype = _post('filetype');
			
		if(!my_in_array($filetype, $fileTypeArr)){
			smsg ( lang ( 200001) );
			return null;
		}
			
		$cUserData = $CUSER->find_jion('a.cuid', $cuid);
		if(!my_is_array($cUserData)){
			smsg(lang('user:cuser>300001'));
			return null;
		}
		
		if(!_g('file')->delete(sdir(':uploadfile') . '/' . my_array_value($filetype, $cUserData))){
			smsg(lang('user:cuser>400000'));
			return null;
		}
		$data = array();
		$data['profile'][$filetype] = null;
		
		$CUSER->updateCUser($cuid, $data);
		break;
	default :
		$cUserData = $CUSER->find_jion('a.cuid', $cuid);
		
		if(!my_is_array($cUserData)){
			smsg(lang('user:cuser>300001'));
			return null;
		}
		include _g ( 'template' )->name ( 'user', 'c_company', true );
		break;
}
?>