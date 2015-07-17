<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'do':
		$cuid = $UModel->suser('cuid');
		$password = _post('password');
		$new_password = _post('new_password');
		$new_password2 = _post('new_password2');
		
		/* 原密码 */
		if(strlen($password) < 1){
			smsg ( lang ( 'cuser:300003') );
			return null;
		}
		if(!_g('validate')->vm(strlen($password), 6, 30)){
			smsg ( lang ( 'cuser:300004') );
			return null;
		}
		/* 新密码 */
		if(!_g('validate')->vm(strlen($new_password), 6, 30)){
			smsg ( lang ( 'cuser:300005', array(6, 30)) );
			return null;
		}
		if(strlen($new_password2) < 1){
			smsg ( lang ( 'cuser:100003') );
			return null;
		}
		if(!_g('validate')->v2eq(my_md5($new_password, 2), my_md5($new_password2, 2), true)){
			smsg ( lang ( 'cuser:100004') );
			return null;
		}
		$CUSER->updatePassword($cuid, my_md5($password, 2), my_md5($new_password, 2));
		break;
	default :
		include _g ( 'template' )->name ( 'cuser', 'password', true );
		break;
}
?>