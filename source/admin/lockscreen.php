<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

if (! _g ( 'cp' )->admin->check ()) {
	_g ( 'cp' )->goindex();
	exit();
}

$LS = _g ( 'module' )->trigger ( ':', 'lockscreen' );
$USER = _g ( 'module' )->trigger ( 'user' );
switch (_get ( 'op' )) {
	case 'en':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		
		$lcRs = $LS->find ( 'uid', _g ( 'cp' )->admin->uid );
		if (!$LS->db->is_success ($lcRs)) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (!my_is_array($lcRs)) {
			$data = array ('uid' => _g ( 'cp' )->admin->uid, 'ctime' => _g( 'cfg>time' ));
			if (!$LS->insert( $data )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( ':100006' ), null, 1 );
		break;
	case 'de':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$password = _post ( 'password' );
		if(strlen($password) < 1) {
			smsg ( lang ( ':100009' ) );
			return null;
		}
		
		$userRs = $USER->find('uid', _g ( 'cp' )->admin->uid);
		if (!$LS->db->is_success ($lcRs)) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (!my_is_array($userRs)) {
			smsg ( lang ( ':100011' ) );
			return null;
		}
		if ($USER->enpwd ( $password ) !== $userRs['password']) {
			smsg ( lang ( ':100010' ) );
			return null;
		}
		
		if (!$LS->delete ('uid', _g ( 'cp' )->admin->uid)) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		smsg ( lang ( ':100006' ), null, 1 );
		break;
		
	default :
		
		break;
}
?>