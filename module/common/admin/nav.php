<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$nav = _g ( 'module' )->trigger ( 'common', 'nav' );

switch (_get ( 'op' )) {
	case 'write' :
		$navSub = array (
				'parentid' => 0 
		);
		if (_g ( 'validate' )->hasget ( 'navid' )) {
			$navid = _get ( 'navid' );
			if (! _g ( 'validate' )->pnum ( $navid )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$navSub = $nav->find ( 'navid', $navid );
			if (! is_array ( $navSub )) {
				smsg ( lang ( 'common:100000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->hasget ( 'parentid' )) {
			if (! _g ( 'validate' )->pnum ( _get ( 'parentid' ) )) {
				smsg ( lang ( '200014' ) );
				return null;
			}
			$navSub ['parentid'] = _get ( 'parentid' );
		}
		$gobackUrl = _g ( 'cp' )->uri ( 'mod/common/ac/nav' . (_g ( 'validate' )->pnum ( $navSub ['parentid'] ) ? ('/parentid/' . $navSub ['parentid']) : '') );
		_g ( 'cp' )->set_template ( 'common', 'nav_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$navid = _post ( 'navid' );
		$parentid = _post ( 'parentid' );
		
		$listorder = _post ( 'listorder' );
		$nname = _post ( 'nname' );
		$url = _post ( 'url' );
		$target = _post ( 'target' );
		$classname = _post ( 'classname' );
		$status = _g('value')->sb( _post ( 'status' ) );
		
		$ctime = _g('cfg>time');
		
		if (! _g ( 'validate' )->num ( $navid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		if (! _g ( 'validate' )->num ( $parentid )) {
			smsg ( lang ( '110015' ) );
			return null;
		}
		
		if (strlen ( $nname ) < 1) {
			smsg ( lang ( 'common:100001' ) );
			return null;
		}
		
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$navParentSub = $nav->find ( 'navid', $parentid );
			if (! $nav->db->is_success ( $navParentSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $navParentSub )) {
				smsg ( lang ( '110015' ) );
				return null;
			}
		}
		
		$data = array (
				'parentid' => $parentid,
				'listorder' => $listorder,
				'nname' => $nname,
				'url' => $url,
				'target' => $target,
				'classname' => $classname,
				'ctime' => $ctime,
				'status'=> $status
		);
		
		if(!$nav->write_save ( $navid, $data )){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	case 'update' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$navid = _post ( 'navid' );
		if (! my_is_array ( $navid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		$nav->update ( $navid, _post ( 'listorder' ), _post ( 'nname' ), _post ( 'status' ) );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$navid = _post ( 'id' );
		if (! _g ( 'validate' )->pnum ( $navid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		$nav->delete ( $navid );
		break;
	default :
		$writeUrlStr = 'mod/common/ac/nav/op/write';
		
		_g ( 'cp' )->set_template ( 'common', 'nav' );
		break;
}
?>