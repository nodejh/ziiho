<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$AVATAR = _g('module')->trigger('user', 'avatar');
$uid = $UModel->suser('uid');

switch (_get ( 'op' )) {
	case 'upload':
		$fileData = _ifile('avatarfile');
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
		if($info[0] < 200 || $info[1] < 200){
			smsg(lang(300007, array(200, 200)));
			return null;
		}
		
		/* 保存目录 */
		$rootDir = sdir(':uploadfile');
		$saveDir = 'user/avatar_tmp/' . date('Ym');
		if(!_g('file')->create_dir($rootDir, $saveDir)){
			smsg(lang('300003'));
			return null;
		}
		/* 文件名 */
		$sfname = $saveDir . '/' . _g('file')->nname($fileData['name']);
		
		/* 更新原文件 */
		$qRs = $AVATAR->tmpFind('uid', $uid);
		if(!$AVATAR->db->is_success($qRs)){
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(my_is_array($qRs)){
			if(!_g('file')->delete($rootDir . '/' . $qRs['src'])){
				smsg ( lang ( 'user:300000' ) );
				return null;
			}
			if(!$AVATAR->tmpUpdate(array('src'=>$sfname, 'ctime'=>_g('cfg>time')), 'uid', $uid)){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}else{
			if(!$AVATAR->tmpInsert(array('src'=>$sfname, 'ctime'=>_g('cfg>time'), 'uid'=>$uid))){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		
		/* 上传文件 */
		if(!move_uploaded_file($fileData['tmp_name'], ($rootDir . '/' . $sfname))){
			smsg(lang('300002'));
			return null;
		}
		$viewSrc = (sdir('uploadfile') . '/' . $sfname);
		$srcInfo = getimagesize(($rootDir . '/' . $sfname));
		smsg(lang('100063'), null, array('status'=>1, 'src'=>$viewSrc, 'w'=>$srcInfo[0], 'h'=>$srcInfo[1]));
		break;
	case 'save':
		/* user data */
		$userRs = $USER->find('uid', $uid);
		if(!my_is_array($userRs)){
			smsg ( lang ( 'user:100020' ) );
			return null;
		}
		
		/* tmp file */
		$qRs = $AVATAR->tmpFind('uid', $uid);
		if(!$AVATAR->db->is_success($qRs)){
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($qRs)){
			smsg ( lang ( 'user:300001' ) );
			return null;
		}
		$srcName = (sdir(':uploadfile') . '/' . $qRs['src']);
		if(!_g('file')->isfile($srcName)){
			smsg ( lang ( 'user:300002' ) );
			return null;
		}
		/* 保存目录 */
		$rootDir = sdir(':uploadfile');
		$saveDir = 'user/avatar/' . date('Ym');
		if(!_g('file')->create_dir($rootDir, $saveDir)){
			smsg(lang('300003'));
			return null;
		}
		$sfname = $saveDir . '/' . _g('file')->nname($srcName);
		
		/* delete avatar */
		$__avatarRs = $AVATAR->find('uid', $uid);
		if(!$AVATAR->db->is_success($__avatarRs)){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* update avatar */
		$__avatarUpdateStatus = null;
		$__avatarUpdateData = array(
				'src'=>$sfname,
				'ctime'=>_g('cfg>time'),
				'uid'=>$uid
		);
		if(my_is_array($__avatarRs)){
			if(!_g('file')->delete($rootDir . '/' . $__avatarRs['src'])){
				smsg ( lang ( 'user:300003' ) );
				return null;
			}
			$__avatarUpdateStatus = $AVATAR->update($__avatarUpdateData, 'uid', $uid);
		}else{
			$__avatarUpdateStatus = $AVATAR->insert($__avatarUpdateData);
		}
		if(!$__avatarUpdateStatus){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		include (_g('module')->helper('user', 'avatar_save'));
		
		/* delete origin */
		if(!_g('file')->delete($srcName)){
			smsg ( lang ( 'user:300004' ) );
			return null;
		}
		if(!$AVATAR->tmpDelete('uid', $uid)){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		smsg(lang('100065'), null, 1);
		break;
	default :
		$cUserData = $USER->find_jion('a.uid', $uid);
		if(!my_is_array($cUserData)){
			smsg(lang('user:100020'));
			return null;
		}
		/* tmp */
		$tmpRs = $AVATAR->tmpFind('uid', $uid);
		$tmpData = array();
		if(my_is_array($tmpRs)){
			$__tmpSrc = (sdir(':uploadfile') . '/' . my_array_value('src', $tmpRs));
			if(_g('file')->isfile($__tmpSrc)){
				$srcInfo = getimagesize($__tmpSrc);
				$tmpData['src'] = (sdir('uploadfile') . '/' . my_array_value('src', $tmpRs));
				$tmpData['w'] = $srcInfo[0];
				$tmpData['h'] = $srcInfo[1];
				
				$tmpData = array2json($tmpData);
			}
		}
		
		/* avatar */
		$__avatarSrc=  (_g('template')->dir('user') . '/image/gender_2.png');
		$__avatarRsData = $AVATAR->find('uid', $uid);
		if(my_is_array($__avatarRsData)){
			$__avatarSrc = sdir('uploadfile') . '/' . $__avatarRsData['src'];
		}
		
		include _g ( 'template' )->name ( 'user', 'avatar', true );
		break;
}
?>