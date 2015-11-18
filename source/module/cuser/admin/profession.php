<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$PRO = _g ( 'module' )->trigger ( 'cuser', 'profession' );
$db = $PRO->db;

switch (_get ( 'op' )) {
	case 'write':
		$professionid = _get('id');
		if (!_g('validate')->pnum ( $professionid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		$professionRs = $PRO->find ( 'professionid', $professionid );
		if (!my_is_array ( $professionRs )) {
			smsg ( lang ( 'cuser:ms>100001' ) );
			return null;
		}
		_g ( 'cp' )->set_template ( 'cuser', 'profession_write' );
		break;
	case 'write_save':
		$professionid = _post('professionid');
		$listorder = _post('listorder');
		$pname = _post('pname');
		$status = _post('status');
		
		if (!_g('validate')->pnum ( $professionid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		if (strlen ($pname) < 1) {
			smsg (lang ( 'cuser:ms>100000' ));
			return null;
		}
		
		$professionRs = $PRO->find ( 'professionid', $professionid );
		if (!my_is_array ( $professionRs )) {
			smsg ( lang ( 'cuser:ms>100001' ) );
			return null;
		}
		
		if (!_g('validate')->num($listorder)) {
			$listorder = 0;
		}
		/* set data */
		$data = array (
				'listorder' => $listorder,
				'pname' => $pname,
				'status' => _g('value')->sb($status)
		);
		if(!$PRO->update ( $data, 'professionid', $professionid )){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		$PRO->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	case 'add':
		$listorder = intval ( _post ( '_listorder' ) );
		$pname = _post ( '_pname' );
		$status = _post('_status');
		
		if (strlen ($pname) < 1) {
			smsg (lang ( 'cuser:ms>100000' ));
			return null;
		}
		
		if (!_g('validate')->num($listorder)) {
			$listorder = 0;
		}
		/* set data */
		$data = array (
				'listorder' => $listorder,
				'pname' => $pname,
				'ctime' => _g ( 'cfg>time' ),
				'status'=>_g('value')->sb($status)
		);
		if (!$PRO->insert ( $data )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		$PRO->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	case 'update':
		$professionid = _post('professionid');
		$listorder = _post('listorder');
		$pname = _post('pname');
		$status = _post('status');
		
		if(my_count ( $professionid ) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($professionid as $id) {
			$data = array();
			if(_g('validate')->num ( $listorder[$id] )){
				$data['listorder'] = $listorder[$id];
			}
			if(strlen ( $pname[$id] ) >= 1){
				$data['pname'] = $pname[$id];
			}
			$data['status'] = _g('value')->sb($status[$id]);
			if (!my_is_array ( $data )) {
				continue;
			}
			/* execute */
			if(!$PRO->update ( $data, 'professionid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		
		$PRO->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$professionid = _post ( 'professionid' );
		if (! my_is_array( $professionid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($professionid as $id){
			if(!$PRO->delete ( 'professionid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		
		$PRO->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	default :
		_g('uri')->referer ( true );
		
		$db->from ( $PRO->t_cuser_profession );
		$pageData = _g ( 'page' )->c ( $db->count(), 15, 10, _get ( 'page' ) );
		$db->limit ( $pageData['start'], $pageData['size'] );
		$db->order_by ( 'listorder' );
		$db->select ();
		$dataResult = $db->get_list ();
		
		$pageData['uri'] = 'mod/cuser/ac/profession/page/';
		_g ( 'cp' )->set_template ( 'cuser', 'profession' );
		break;
}
?>