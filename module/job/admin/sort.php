<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g ( 'module' )->trigger ( 'job', 'model' );
$sort = _g ( 'module' )->trigger ( 'job', 'sort' );

switch (_get ( 'op' )) {
	case 'write' :
		$sortSub = array (
				'parentid' => 0 
		);
		if (_g ( 'validate' )->hasget ( 'sortid' )) {
			$sortid = _get ( 'sortid' );
			if (! _g ( 'validate' )->pnum ( $sortid )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$sortSub = $sort->find ( 'sortid', $sortid );
			if (! is_array ( $sortSub )) {
				smsg ( lang ( 'job:100000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->hasget ( 'parentid' )) {
			if (! _g ( 'validate' )->pnum ( _get ( 'parentid' ) )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$sortSub ['parentid'] = _get ( 'parentid' );
		}
		$gobackUrl = _g ( 'cp' )->uri ( 'mod/job/ac/sort' . (_g ( 'validate' )->pnum ( $sortSub ['parentid'] ) ? ('/parentid/' . $sortSub ['parentid']) : '') );
		_g ( 'cp' )->set_template ( 'job', 'sort_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$sortid = _post ( 'sortid' );
		$parentid = _post ( 'parentid' );
		
		$listorder = _post ( 'listorder' );
		$sname = _post ( 'sname' );
		$sdescription = _post ( 'sdescription' );
		$status = _g('value')->sb( _post ( 'status' ) );
		
		if (! _g ( 'validate' )->num ( $sortid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		if (! _g ( 'validate' )->num ( $parentid )) {
			smsg ( lang ( '110015' ) );
			return null;
		}
		
		if (strlen ( $sname ) < 1) {
			smsg ( lang ( 'job:100001' ) );
			return null;
		}
		
		$sort->write_save ( $sortid, $parentid, $listorder, $sname, $sdescription, $status );
		break;
	case 'multi_write':
		$sortSub = array (
				'parentid' => 0
		);
		$gobackUrl = _g ( 'cp' )->uri ( 'mod/job/ac/sort');
		_g ( 'cp' )->set_template ( 'job', 'sort_multi_write' );
		break;
	case 'multi_write_save':
		$parentid = _post('parentid');
		$status = _g('value')->sb( _post ( 'status' ) );
		$sname = _post('sname');
		
		if (! _g ( 'validate' )->num ( $parentid )) {
			smsg ( lang ( '110015' ) );
			return null;
		}
		if (strlen ( $sname ) < 1) {
			smsg ( lang ( 'job:100001' ) );
			return null;
		}
		$sort->multi_write_save ( $parentid, $sname, $status );
		break;
	case 'update' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$sortid = _post ( 'sortid' );
		if (! my_is_array ( $sortid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$sort->update ( $sortid, _post ( 'listorder' ), _post ( 'sname' ), _post ( 'status' ) );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$sortid = _post ( 'id' );
		if (! _g ( 'validate' )->pnum ( $sortid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$sort->delete ( $sortid );
		break;
	default :
		$writeUrlStr = 'mod/job/ac/sort/op/write';
		_g ( 'cp' )->set_template ( 'job', 'sort' );
		break;
}
?>