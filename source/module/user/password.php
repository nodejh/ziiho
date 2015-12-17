<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'do':
		$uid = $UModel->suser('uid');
		$password = _post('password');
		$new_password = _post('new_password');
		$new_password2 = _post('new_password2');
		
		/* 原密码 */
		if(strlen($password) < 1){
			smsg ( lang ( 'user:100017') );
			return null;
		}
		if(!_g('validate')->vm(strlen($password), 6, 30)){
			smsg ( lang ( 'user:100018') );
			return null;
		}
		/* 新密码 */
		if(!_g('validate')->vm(strlen($new_password), 6, 30)){
			smsg ( lang ( 'user:100019', array(6, 30)) );
			return null;
		}
		if(strlen($new_password2) < 1){
			smsg ( lang ( 'user:100003') );
			return null;
		}
		if(!_g('validate')->v2eq(my_md5($new_password, 2), my_md5($new_password2, 2), true)){
			smsg ( lang ( 'user:100003') );
			return null;
		}
		$USER->resetPassword($uid, my_md5($password, 2), my_md5($new_password, 2));
		break;
	default :
		include _g ( 'template' )->name ( 'user', 'password', true );
		break;
}
?>