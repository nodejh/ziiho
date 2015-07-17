<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g ( 'module' )->trigger ( 'user' );
$USERGROUP = _g ( 'module' )->trigger ( 'user', 'group' );
$UAVATAR = _g ( 'module' )->trigger ( 'user', 'avatar' );

$hUri = _g('cp')->uri('mod/user/ac/manager');
$lsUri = _g('uri')->referer();

switch (_get ( 'op' )) {
	case 'do':
		$act_flag_name = _post('act_flag_name');
		$do_uid = _post('do_uid');
		
		if(!_g('validate')->pnum($do_uid)){
			smsg(lang(200014));
			return null;
		}
		if($act_flag_name == 'info'){
			$nickname = _post('nickname');
			$gender = _post('gender');
			$birthday = _post('birthday');
			$emotion = _post('emotion');
			$hometown = _post('hometown');
			$residence = _post('residence');
			$sign = _post('sign');
			
			$data = array(
					'nickname'=>$nickname,
					'gender'=>$gender,
					'birthday'=>strtotime($birthday),
					'emotion'=>$emotion,
					'hometown'=>$hometown,
					'residence'=>$residence,
					'sign'=>$sign
			);
			
			$USER->updateProfile($do_uid, $data);
			
		}else if ($act_flag_name == 'password'){
			$password = _post('password');
			$password2 = _post('password2');
			
			if(!_g('validate')->vm(strlen($password), 6, 30)){
				smsg ( lang ( 'user:100001', array(6, 30)) );
				return null;
			}
			if(strlen($password2) < 1){
				smsg ( lang ( 'user:100002') );
				return null;
			}
			
			if(!_g('validate')->v2eq(my_md5($password, 2), my_md5($password2, 2), true)){
				smsg ( lang ( 'user:100003') );
				return null;
			}
			
			if(!$USER->updatePassword($do_uid, $password)){
				smsg(lang('200013'));
			}else{
				smsg(lang('100061'), null, 1);
			}
			return null;
		}else if($act_flag_name == 'avatar'){
			$del = _post('del');
			
			$avatarRs = $UAVATAR->find('uid', $do_uid);
			if(!$UAVATAR->db->is_success($avatarRs)){
				smsg(lang('200013'));
				return null;
			}
			
			if($del === 'true'){
				if(my_is_array($avatarRs)){
					if(!_g('file')->delete(sdir(':uploadfile') . '/' . $avatarRs['src'])){
						smsg(lang('user:300005'));
						return null;
					}
					if(!$UAVATAR->delete('uid', $do_uid)){
						smsg(lang('200013'));
						return null;
					}
				}
			}else{
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
				$saveDir = 'user/avatar/' . date('Ym');
				if(!_g('file')->create_dir($rootDir, $saveDir)){
					smsg(lang('300003'));
					return null;
				}
				/* 文件名 */
				$sfname = $saveDir . '/' . _g('file')->nname($fileData['name']);
				
				/* 删除原头像 */
				if(my_is_array($avatarRs)){
					if(!_g('file')->delete($rootDir . '/' . $avatarRs['src'])){
						smsg ( lang ( 'user:300000' ) );
						return null;
					}
					if(!$UAVATAR->update(array('src'=>$sfname, 'ctime'=>_g('cfg>time')), 'uid', $do_uid)){
						smsg ( lang ( '200013' ) );
						return null;
					}
				}else{
					if(!$UAVATAR->insert(array('src'=>$sfname, 'ctime'=>_g('cfg>time'), 'uid'=>$do_uid))){
						smsg ( lang ( '200013' ) );
						return null;
					}
				}
				
				/* 上传文件 */
				if(!move_uploaded_file($fileData['tmp_name'], ($rootDir . '/' . $sfname))){
					smsg(lang('300002'));
					return null;
				}
			}
			smsg(lang('100061'), null, 1);
			return null;
		}
		break;
	case 'detail':
		$_r_uid = _get('r_uid');
		if(!_g('validate')->pnum($_r_uid)){
			smsg(lang(200014), $lsUri);
			return null;
		}
		$rUserRs = $USER->find('uid', $_r_uid);
		if(!my_is_array($rUserRs)){
			smsg(lang('user:100009'), $lsUri);
			return null;
		}
		
		$rUserProfile = $USER->profile_find('uid', $_r_uid);
		if(my_is_array($rUserProfile)){
			foreach ($rUserProfile as $k => $v){
				if(_g('validate')->num($k)){
					continue;
				}
				$rUserRs[$k] = $v;
			}
		}
		unset($rUserProfile);
		
		$userAvatar = $UAVATAR->find('uid', $_r_uid);
		
		_g ( 'cp' )->set_template ( 'user', 'detail' );
		break;
	case 'setting':
		$_r_uid = _get('r_uid');
		if(!_g('validate')->pnum($_r_uid)){
			smsg(lang(200014), $lsUri);
			return null;
		}
		$rUserRs = $USER->find('uid', $_r_uid);
		if(!my_is_array($rUserRs)){
			smsg(lang('user:100009'), $lsUri);
			return null;
		}
		$rUserProfile = $USER->profile_find('uid', $_r_uid);
		if(my_is_array($rUserProfile)){
			foreach ($rUserProfile as $k => $v){
				if(_g('validate')->num($k)){
					continue;
				}
				$rUserRs[$k] = $v;
			}
		}
		unset($rUserProfile);
		
		/* find admin */
		$adminUid = my_array_value('ugid', _g('cp')->admin->find('uid', $rUserRs['uid']));
		/* get usergroup */
		$userGroupResult = $USERGROUP->getList(1);
		
		_g ( 'cp' )->set_template ( 'user', 'setting' );
		break;
	case 'settingdo':
		$do_uid = _post('do_uid');
		if(!_g('validate')->pnum($do_uid)){
			smsg(lang(200014));
			return null;
		}
		$rUserRs = $USER->find('uid', $do_uid);
		if(!my_is_array($rUserRs)){
			smsg(lang('user:100009'));
			return null;
		}
		
		$ugid = _post('ugid');
		if(!_g('cp')->admin->setUser($do_uid, $ugid)){
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	default :
		_g('uri')->referer(true);
		
		$isWhere = false;
		$qWhere = array();
		
		$dataResult = null;
		$pageData = array('total'=>0);
		$pageWhere = null;
		
		/* where */
		$_q_uid = _get('q_uid');
		$_q_username = _get('q_username');
		$_q_nickname = _get('q_nickname');
		
		if(_g('validate')->pnum($_q_uid)){
			$qWhere[] = array(
					'pw' => ('/q_uid/' . $_q_uid),
					'func' => 'where',
					'key' => 'a.uid',
					'value'=> $_q_uid
			);
		}
		
		if(strlen($_q_username) >= 1){
			$qWhere[] = array(
					'pw' => ('/q_username/' . $_q_username),
					'func' => 'where_regexp',
					'key' => 'a.username',
					'value'=> $_q_username
			);
		}
		
		if(strlen($_q_nickname) >= 1){
			$_q_nickname = urldecode($_q_nickname);
			
			$qWhere[] = array(
					'pw' => ('/q_nickname/' . urlencode($_q_nickname)),
					'func' => 'where_regexp',
					'key' => 'a.nickname',
					'value'=> $_q_nickname
			);
		}
		
		if(!empty($qWhere)){
			$isWhere = true;
			
			$USER->db->join($USER->t_user, 'a.uid', $USER->t_user_profile, 'b.uid', 'LEFT JOIN');
			foreach ($qWhere as $qW){
				$pageWhere .= $qW['pw'];
				
				$USER->db->$qW['func']($qW['key'], $qW['value']);
			}
			$USER->db->where('a.uid', 1, '!=');
			$pageData = _g('page')->c($USER->db->count(), 10, 10, _get('page'));
			$USER->db->limit($pageData['start'], $pageData['size']);
			$USER->db->order_by('a.regtime', 'DESC');
			$USER->db->select($USER->t_field);
			$dataResult = $USER->db->get_list();
			
			$pageData['uri'] = 'mod/user/ac/manager' . $pageWhere . '/page/';
		}
		
		_g ( 'cp' )->set_template ( 'user', 'manager' );
		break;
}
?>