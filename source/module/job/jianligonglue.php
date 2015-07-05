<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'muban':
		include _g ( 'template' )->name ( 'job', 'jianli_muban', true );
		break;
	case 'muban_detail':
		include _g ( 'template' )->name ( 'job', 'jianli_muban_detail', true );
		break;
	default :
		include _g ( 'template' )->name ( 'job', 'jianligonglue', true );
		break;
}
?>