<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USetting = _g ( 'module' )->trigger ( 'user', 'setting' );

switch (_get ( 'op' )) {
	case 'do':
		$host = _post('host');
		$port = _post('port');
		$email = _post('email');
		$password = _post('password');
		$sname = _post('sname');
		$auth = _post('auth');
		
		$data = array(
				'host'=>$host,
				'port'=>$port,
				'email'=>$email,
				'password'=>$password,
				'sname'=>$sname,
				'auth'=>_g('value')->sb($auth)
		);
		if(!$USetting->email($data)){
			smsg(lang('100066'));
		}else{
			smsg(lang('100065'), null, 1);
		}
		break;
	default :
		$emailSetting = _g ( 'module' )->trigger ( '@', 'setting', null, 'finds', array('module'=>'user', 'stype'=>'emailSetting') );

		_g ( 'cp' )->set_template ( 'user', 'setting' );
		break;
}
?>