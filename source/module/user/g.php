<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g('module')->trigger('user');
$UModel = _g('module')->trigger('user', 'model');

switch (_get ( 'op' )) {
	case 'status':
		$userData = $USER->find_jion( 'a.uid', $UModel->suser ( 'uid' ) );
		
		include _g ( 'template' )->name ( 'user', 'loginstatus', true );
		break;
	default :
		break;
}
?>