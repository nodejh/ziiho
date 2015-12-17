<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );

switch (_get ( 'op' )) {
	case 'basedo':
		$username_min = _post('username_min');
		$username_max = _post('username_max');
		
		$password_min = _post('password_min');
		$password_max = _post('password_max');
		
		$loginmodel = _post('loginmodel');
		
		$nickname_min = _post('nickname_min');
		$nickname_max = _post('nickname_max');
		
		$sign_max = _post('sign_max');
		
		$loginmodel = my_addslashes( array2str( $loginmodel ) );
		/* setting */
		$settings = array ();
		$settings[] = array( 'user', 'setting', 'username_min', $username_min );
		$settings[] = array( 'user', 'setting', 'username_max', $username_max );
		
		$settings[] = array( 'user', 'setting', 'password_min', $password_min );
		$settings[] = array( 'user', 'setting', 'password_max', $password_max );
		
		$settings[] = array( 'user', 'setting', 'loginmodel', $loginmodel, 1 );
		
		$settings[] = array( 'user', 'setting', 'nickname_min', $nickname_min );
		$settings[] = array( 'user', 'setting', 'nickname_max', $nickname_max );
		
		$settings[] = array( 'user', 'setting', 'sign_max', $sign_max );
		
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	
	case 'avatardo':
		$dir = _post('dir');
		$size = _post('size');
		
		$width = _post('width');
		$height = _post('height');
		
		/* setting */
		$settings = array ();
		$settings[] = array( 'user', 'avatar', 'dir', $dir );
		$settings[] = array( 'user', 'avatar', 'size', $size );
		
		$settings[] = array( 'user', 'avatar', 'width', $width );
		$settings[] = array( 'user', 'avatar', 'height', $height );
		
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	default :
		$options = $OPT->finds(array('module'=>'user', 'stype'=>'setting'));
		$avatarOptions = $OPT->finds(array('module'=>'user', 'stype'=>'avatar'));
		_g ( 'cp' )->set_template ( 'user', 'setting' );
		break;
}
?>