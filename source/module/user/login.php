<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g('module')->trigger('user');
$CUSER = _g('module')->trigger('cuser');
$UModel = _g('module')->trigger('user', 'model');

if(my_is_array($UModel->suser())){
	header('location:' . _g('uri')->su('user'));
	return null;
}

switch (_get ( 'op' )) {
	case 'ordinary':
		$username = _post('username');
		$password = _post('password');
		
		if(!_g('validate')->email($username, 1)){
			smsg ( lang ( 'user:100014') );
			return null;
		}
		if(!_g('validate')->vm(strlen($password), 6, 30)){
			smsg ( lang ( 'user:100015') );
			return null;
		}
		$USER->login($username, $password);
		break;
	case 'company':
		$username = _post('username');
		$password = _post('password');
		
		if(!_g('validate')->en_e($username, 3, 30) || !_g('validate')->vm(strlen($username), 3, 30)){
			smsg ( lang ( 'cuser:100013') );
			return null;
		}
		if(!_g('validate')->vm(strlen($password), 6, 30)){
			smsg ( lang ( 'cuser:100014') );
			return null;
		}
		$CUSER->login($username, $password);
		break;
	default :
		include _g ( 'template' )->name ( 'user', 'login', true );
		break;
}
?>