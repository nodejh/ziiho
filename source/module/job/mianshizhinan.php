<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	default :
		include _g ( 'template' )->name ( 'job', 'mianshizhinan', true );
		break;
}
?>