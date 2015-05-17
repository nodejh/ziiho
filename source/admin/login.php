<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'do' :
		_g ( 'cp' )->admin->login ( _post ( 'username' ), _post ( 'password' ), _post ( 'checkcode' ) );
		break;
	
	case 'out' :
		
		break;
	
	default :
		_g ( 'cp' )->set_template ( ':', 'login' );
		
		/* 已登录会员名 */
		$username = _g ( 'value' )->user ( 'username' );
		break;
}
?>