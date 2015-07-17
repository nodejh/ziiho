<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$nature = _g ( 'module' )->trigger ( 'job', 'nature' );

switch (_get ( 'op' )) {
	case 'add' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$listorder = _post ( '_listorder' );
		$nname = _post ( '_nname' );
		$status = _g('value')->sb( _post ( '_status' ) );
		
		if (strlen ( $nname ) < 1) {
			smsg ( lang ( 'job:300001' ) );
			return null;
		}
		$nature->add ($listorder, $nname, $status );
		break;
	case 'update' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$natureid = _post ( 'natureid' );
		if (! my_is_array ( $natureid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$nature->update ( $natureid, _post ( 'listorder' ), _post ( 'nname' ), _post ( 'status' ) );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$natureid = _post ( 'id' );
		if (! _g ( 'validate' )->pnum ( $natureid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$nature->delete ( $natureid );
		break;
	default :
		$natureResult = $nature->finds(null);
		_g ( 'cp' )->set_template ( 'job', 'nature' );
		break;
}
?>