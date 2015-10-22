<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$NATURE = _g ( 'module' )->trigger ( '@', 'nature' );
$db = $NATURE->db;

switch (_get ( 'op' )) {
	case 'write':
		
		break;
	case 'writedo':
		
		break;
	case 'update':
		$fwid = _post('fwid');
		$fword = _post('fword');
		$rword = _post('rword');
		$status = _post('status');
		
		if(my_count($fwid) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($fwid as $id){
			if(strlen($fword[$id]) < 1){
				continue;
			}
			$data = array();
			$data['fword'] = $fword[$id];
			$data['rword'] = $rword[$id];
			$data['status'] = _g('value')->sb($status[$id]);
			if(!$NATURE->update ( $data, 'fwid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$fwid = _post('fwid');
		if (! my_is_array( $fwid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($fwid as $id){
			if(!$NATURE->delete ( 'fwid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		
		$db->from($NATURE->t_common_nature);
		$pageData = _g('page')->c($db->count(), 15, 10, _get('page'));
		$db->limit($pageData['start'], $pageData['size']);
		$db->order_by('fwid', 'desc');
		$db->select();
		$dataResult = $db->get_list();
		
		$subjectUrl = 'mod/common/ac/nature/page';
		_g ( 'cp' )->set_template ( '@', 'nature' );
		break;
}
?>