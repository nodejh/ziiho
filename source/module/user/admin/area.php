<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$area = _g ( 'module' )->trigger ( 'user', 'area' );

switch (_get ( 'op' )) {
	case 'write' :
		$areaSub = array (
				'parentid' => 0 
		);
		if (_g ( 'validate' )->hasget ( 'areaid' )) {
			$areaid = _get ( 'areaid' );
			if (! _g ( 'validate' )->pnum ( $areaid )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$areaSub = $area->find ( 'areaid', $areaid );
			if (! is_array ( $areaSub )) {
				smsg ( lang ( 'user:200000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->hasget ( 'parentid' )) {
			if (! _g ( 'validate' )->pnum ( _get ( 'parentid' ) )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$areaSub ['parentid'] = _get ( 'parentid' );
		}
		$gobackUrl = _g ( 'cp' )->uri ( 'mod/user/ac/area' . (_g ( 'validate' )->pnum ( $areaSub ['parentid'] ) ? ('/parentid/' . $areaSub ['parentid']) : '') );
		_g ( 'cp' )->set_template ( 'user', 'area_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$areaid = _post ( 'areaid' );
		$parentid = _post ( 'parentid' );
		
		$listorder = _post ( 'listorder' );
		$aname = _post ( 'aname' );
		$status = _g('value')->sb( _post ( 'status' ) );
		
		if (! _g ( 'validate' )->num ( $areaid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		if (! _g ( 'validate' )->num ( $parentid )) {
			smsg ( lang ( '110015' ) );
			return null;
		}
		
		if (strlen ( $aname ) < 1) {
			smsg ( lang ( 'user:200001' ) );
			return null;
		}
		
		$area->write_save ( $areaid, $parentid, $listorder, $aname, $status );
		break;
	case 'update' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$areaid = _post ( 'areaid' );
		if (! my_is_array ( $areaid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$area->update ( $areaid, _post ( 'listorder' ), _post ( 'aname' ), _post ( 'status' ) );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$areaid = _post ( 'id' );
		if (! _g ( 'validate' )->pnum ( $areaid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$area->delete ( $areaid );
		break;
	default :
		$writeUrlStr = 'mod/user/ac/area/op/write';
		
		_g ( 'cp' )->set_template ( 'user', 'area' );
		break;
}
?>