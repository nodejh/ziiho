<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g('module')->trigger('user');
$UModel = _g('module')->trigger('user', 'model');

switch (_get ( 'op' )) {
	case 'email_do':
		$email = _post('email');
		
		if(!_g('validate')->email($email, 1)){
			smsg ( lang ( 'user:100000') );
			return null;
		}
		$uRs = $USER->find('username', $email);
		if(!my_is_array($uRs)){
			smsg ( lang ( 'user:100011') );
			return null;
		}
		$uRs['flag_forget_email'] = 1;
		if(!$USER->email_send($uRs)){
			smsg(_g('mail')->message());
			return null;
		}
		my_session('forget_user', $uRs);
		
		smsg ( lang ( 'user:100005', $email) , null, 1);
		break;
	case 'email_pw':
		$forgetUser = $UModel->forgetUser();
		$email = urldecode(base64_decode(base64_decode(_get('e'))));
		
		$chkStatus = false;
		if(my_is_array($forgetUser)){
			if(_g('validate')->v2eq($forgetUser['username'], $email, true)){
				$chkStatus = true;
			}
		}
		if($chkStatus){
			include _g ( 'template' )->name ( 'user', 'forget_email_password', true );
		}else{
			$authStatus = false;
			include _g ( 'template' )->name ( 'user', 'register_email_auth_status', true );
		}
		break;
	case 'email_pw_do':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$forgetUser = $UModel->forgetUser();
		$uid = _post('uid');
		$password = _post('password');
		$password2 = _post('password2');
		
		if(!my_is_array($forgetUser)){
			smsg ( lang ( 'user:100008') );
			return null;
		}
		
		/* 密码检查 */
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
		
		if(!_g('validate')->pnum($uid)){
			smsg ( lang ( '200010') );
			return null;
		}
		if(!_g('validate')->v2eq($forgetUser['uid'], $uid)){
			smsg ( lang ( '200010') );
			return null;
		}
		
		$uRs = $USER->find('uid', $uid);
		if(!my_is_array($uRs)){
			smsg ( lang ( 'user:100009') );
			return null;
		}
		
		if(!$USER->updatePassword($uid, $password)){
			smsg(lang('100062'));
		}else{
			smsg(lang('100061'), null, 1);
		}
		break;
	case 'email_pw_success':
		$forgetUser = $UModel->forgetUser();
		$status = my_is_array($forgetUser);
		
		if($status){
			my_session('suser', $forgetUser);
			my_session_delete('forget_user');
		}
		include _g ( 'template' )->name ( 'user', 'forget_email_password_status', true );
		break;
	default :
		include _g ( 'template' )->name ( 'user', 'forget', true );
		break;
}
?>