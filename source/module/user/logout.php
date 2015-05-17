<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$UModel = _g('module')->trigger('user', 'model');

switch (_get ( 'op' )) {
	default :
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(), NULL, _g('cfg>time') - 42000, (sdir(':data') . '/session'));
		}
		session_unset();
		session_destroy();
		
		header('Location:' . sdir());
		break;
}
?>