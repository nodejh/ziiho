<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CUSER = _g('module')->trigger('cuser');
$UModel = _g('module')->trigger('user', 'model');

switch (_get ( 'op' )) {
	case 'status':
		$cuserData = $CUSER->find_jion( 'a.cuid', $UModel->suser ( 'cuid' ) );
		
		include _g ( 'template' )->name ( 'user', 'loginstatus', true );
		break;
	default :
		break;
}
?>