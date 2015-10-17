<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'do' :
		
		break;
		
	case 'company' :
		
		break;
		
	default :
		include _g ( 'template' )->name ( 'job', 'login', true );
		break;
}
?>