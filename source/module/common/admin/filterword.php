<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$FILTERWORD = _g ( 'module' )->trigger ( '@', 'filterword' );

switch (_get ( 'op' )) {
	case 'add':
		$fword = _post('_fword');
		$rword = _post('_rword');
		$status = _post('_status');
		
		if(strlen($fword) < 1){
			smsg ( lang ( '@:300000' ) );
			return null;
		}
		
		$data = array(
			'fword'=>$fword,
			'rword'=>$rword,
			'ctime'=>_g('cfg>time'),
			'status'=>_g('value')->sb($status)
		);
		if(!$FILTERWORD->insert ( $data, null )){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
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
			if(!$FILTERWORD->update ( $data, 'fwid', $id )){
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
			if(!$FILTERWORD->delete ( 'fwid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		
		$FILTERWORD->db->from($FILTERWORD->t_common_filterword);
		$pageData = _g('page')->c($FILTERWORD->db->count(), 15, 10, _get('page'));
		$FILTERWORD->db->limit($pageData['start'], $pageData['size']);
		$FILTERWORD->db->order_by('fwid', 'desc');
		$FILTERWORD->db->select();
		$dataResult = $FILTERWORD->db->get_list();
		
		$subjectUrl = 'mod/common/ac/filterword/page';
		_g ( 'cp' )->set_template ( '@', 'filterword' );
		break;
}
?>