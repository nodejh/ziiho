<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$UModel = _g('module')->trigger('user', 'model');

switch (_get ( 'op' )) {
	default :
		my_session_destroy();
		header('Location:' . _g('uri')->su('index'));
		break;
}
?>