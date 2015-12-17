<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'load' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$parentid = _post ( 'menuid' );
		ob_start ();
		_g ( 'cp' )->menu->my_include_find ( $parentid, 1 );
		$data = ob_get_clean ();
		smsg ( $data );
		break;
	case 'pos' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		
		$menuid = _post ( 'menuid' );
		$positionData = _g ( 'cp' )->menu->my_pos ( $menuid );
		$positionLen = my_count ( $positionData );
		
		ob_start ();
		_g ( 'module' )->dv ( ':', 100001 );
		include _g ( 'cp' )->get_template ( ':', 'menu_my_pos' );
		$data = ob_get_clean ();
		smsg ( $data );
		break;
	
	/* ---- */
	case 'write' :
		$menuSub = array (
				'parentid' => 0 
		);
		if (_g ( 'validate' )->hasget ( 'menuid' )) {
			$menuid = _get ( 'menuid' );
			if (! _g ( 'validate' )->pnum ( $menuid )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$menuSub = _g ( 'cp' )->menu->find ( 'menuid', $menuid );
			if (! is_array ( $menuSub )) {
				smsg ( lang ( ':110001' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->hasget ( 'parentid' )) {
			if (! _g ( 'validate' )->pnum ( _get ( 'parentid' ) )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$menuSub ['parentid'] = _get ( 'parentid' );
		}
		$gobackUrl = _g ( 'cp' )->uri ( 'ac/menu' . (_g ( 'validate' )->pnum ( $menuSub ['parentid'] ) ? ('/parentid/' . $menuSub ['parentid']) : '') );
		_g ( 'cp' )->set_template ( ':', 'menu_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$menuid = _post ( 'menuid' );
		$parentid = _post ( 'parentid' );
		
		$listorder = _post ( 'listorder' );
		$title = _post ( 'title' );
		$url = _post ( 'url' );
		
		$keys = _post ( 'keys' );
		$vals = _post ( 'vals' );
		
		$urltype = _post ( 'urltype' );
		$target = _post ( 'target' );
		
		$module = _post ( 'module' );
		
		if (! _g ( 'validate' )->num ( $menuid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		if (! _g ( 'validate' )->num ( $parentid )) {
			smsg ( lang ( '110015' ) );
			return null;
		}
		
		if (strlen ( $title ) < 1) {
			smsg ( lang ( ':110002' ) );
			return null;
		}
		
		if (strlen ( $module ) < 1) {
			smsg ( lang ( '110016' ) );
			return null;
		}
		
		_g ( 'cp' )->menu->write_save ( $menuid, $parentid, $listorder, $title, $url, $keys, $vals, $urltype, $target, $module );
		break;
	case 'update' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$menuid = _post ( 'menuid' );
		if (! my_is_array ( $menuid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		_g ( 'cp' )->menu->update ( $menuid, _post ( 'listorder' ), _post ( 'title' ), _post ( 'url' ) );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$menuid = _post ( 'menuid' );
		if (! my_is_array ( $menuid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		_g ( 'cp' )->menu->delete ( $menuid );
		break;
	default :
		$isGetParent = false;
		$parentid = 0;
		if (_g ( 'validate' )->hasget ( 'parentid' )) {
			$parentid = _get ( 'parentid' );
			if (! _g ( 'validate' )->pnum ( $parentid )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$isGetParent = true;
		}
		$dataResult = _g ( 'cp' )->menu->finds ( $parentid );
		
		$writeUrlStr = 'ac/menu/op/write';
		$writeUrl = _g ( 'cp' )->uri ( $writeUrlStr . ($isGetParent ? ('/parentid/' . $parentid) : '') );
		
		_g ( 'cp' )->set_template ( ':', 'menu' );
		break;
}
?>