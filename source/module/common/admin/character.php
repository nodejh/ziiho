<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$CHARACTER = _g ( 'module' )->trigger ( '@', 'character' );
$db = $CHARACTER->db;

switch (_get ( 'op' )) {
	case 'write':
		$characterid = _get('id');
		if (!_g('validate')->pnum ( $characterid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		$characterRs = $CHARACTER->find ( 'characterid', $characterid );
		if (!my_is_array ( $characterRs )) {
			smsg ( lang ( '@:500001' ) );
			return null;
		}
		_g ( 'cp' )->set_template ( '@', 'character_write' );
		break;
	case 'write_save':
		$characterid = _post('characterid');
		$listorder = _post('listorder');
		$tname = _post('tname');
		$charflag = _post('charflag');
		$content = _post('content');
		
		if (!_g('validate')->pnum ( $characterid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		if (strlen ($tname) < 1) {
			smsg (lang ( '@:500000' ));
			return null;
		}
		
		$characterRs = $CHARACTER->find ( 'characterid', $characterid );
		if (!my_is_array ( $characterRs )) {
			smsg ( lang ( '@:500001' ) );
			return null;
		}
		
		/* set data */
		$data = array (
				'listorder' => $listorder,
				'tname' => $tname,
				'content' => $content,
				'charflag' => $charflag
		);
		if(!$CHARACTER->update ( $data, 'characterid', $characterid )){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		$CHARACTER->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	case 'add':
		$listorder = intval ( _post ( '_listorder' ) );
		$tname = _post ( '_tname' );
		$charflag = _post('charflag');
		
		if (strlen ($tname) < 1) {
			smsg (lang ( '@:500000' ));
			return null;
		}
		
		/* set data */
		$data = array (
				'listorder' => $listorder,
				'tname' => $tname,
				'ctime' => _g ( 'cfg>time' ),
				'charflag' => $charflag
		);
		if (!$CHARACTER->insert ( $data )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		$CHARACTER->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	case 'update':
		$characterid = _post('characterid');
		$listorder = _post('listorder');
		$tname = _post('tname');
		$charflag = _post('charflag');
		
		if(my_count ( $characterid ) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($characterid as $id) {
			$data = array();
			if(_g('validate')->num ( $listorder[$id] )){
				$data['listorder'] = $listorder[$id];
			}
			if(strlen ( $tname[$id] ) >= 1){
				$data['tname'] = $tname[$id];
			}
			if(strlen ( $charflag[$id] ) >= 1){
				$data['charflag'] = $charflag[$id];
			}
			if (!my_is_array ( $data )) {
				continue;
			}
			/* execute */
			if(!$CHARACTER->update ( $data, 'characterid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		
		$CHARACTER->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$characterid = _post ( 'characterid' );
		if (! my_is_array( $characterid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($characterid as $id){
			if(!$CHARACTER->delete ( 'characterid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		
		$CHARACTER->cacheWrite ();
		smsg ( lang ( '100061' ), null, 1 );
		return null;
		break;
	default :
		_g('uri')->referer ( true );
		
		$db->from ( $CHARACTER->t_common_character );
		$pageData = _g ( 'page' )->c ( $db->count(), 15, 10, _get ( 'page' ) );
		$db->limit ( $pageData['start'], $pageData['size'] );
		$db->order_by ( 'listorder' );
		$db->select ();
		$dataResult = $db->get_list ();
		
		$subjectUrl = 'mod/common/ac/character/page';
		_g ( 'cp' )->set_template ( '@', 'character' );
		break;
}
?>