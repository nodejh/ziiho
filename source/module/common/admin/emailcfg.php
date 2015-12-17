<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );

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
		$settings = array();
		foreach ($data as $k=>$v){
			$settings[] = array('common', 'email', $k, $v);
		}
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	default :
		$options = $OPT->finds(array('module'=>'common', 'stype'=>'email'));
		_g ( 'cp' )->set_template ( '@', 'emailcfg' );
		break;
}
?>