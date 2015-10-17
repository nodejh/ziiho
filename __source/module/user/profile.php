<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$uid = $UModel->suser('uid');

switch (_get ( 'op' )) {
	case 'do':
		$nickname = _post('nickname');
		$gender = _post('gender');
		$birthday = _post('birthday');
		$emotion = _post('emotion');
		$residence = _post('residence');
		$hometown = _post('hometown');
		$sign = _post('sign');
		
		if(!_g('validate')->vm(strlen($nickname), 1, 30)){
			smsg ( lang ( 'user:100021', array(1, 30)) );
			return null;
		}
		
		if(strlen($sign) > 600){
			smsg ( lang ( 'user:100022', 200) );
			return null;
		}
		
		$data = array(
				'nickname'=>$nickname,
				'gender'=>$gender,
				'birthday'=>strtotime($birthday),
				'emotion'=>$emotion,
				'residence'=>$residence,
				'hometown'=>$hometown,
				'sign'=>$sign
		);
		$USER->updateProfile($uid, $data);
		break;
	default :
		$userData = $USER->find_jion('a.uid', $uid);
		
		if(!my_is_array($userData)){
			smsg(lang('user:100020'));
			return null;
		}
		include _g ( 'template' )->name ( 'user', 'profile', true );
		break;
}
?>