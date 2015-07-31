<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$SELECTITEM = _g ( 'module' )->trigger ( '@', 'selectitem' );

$backUrl = _g('uri')->referer();

$selectid = 0;
if (_g('validate')->hasget('selectid')) {
	$selectid = _get('selectid');
	if (!_g('validate')->num($selectid)) {
		smsg(lang('@:300002'), $backUrl);
		return null;
	}
}

switch (_get ( 'op' )) {
	case 'add':
		$listorder = _post('_listorder');
		$flag = _post('_flag');
		$sname = _post('_sname');
		$status = _post('_status');
		
		if(strlen($sname) < 1){
			smsg ( lang ( '@:300001' ) );
			return null;
		}
		
		$data = array(
			'listorder'=>$listorder,
			'flag'=>$flag,
			'sname'=>$sname,
			'ctime'=>_g('cfg>time'),
			'status'=>_g('value')->sb($status),
			'selectid'=>$selectid
		);
		if(!$SELECTITEM->insert ( $data )){
			smsg ( lang ( '200013' ) );
			return null;
		}
		$SELECTITEM->cacheWrite();
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'update':
		$siid = _post('siid');
		$listorder = _post('listorder');
		$flag = _post('flag');
		$sname = _post('sname');
		$status = _post('status');
		
		if(my_count($siid) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($siid as $id){
			$data = array();
			if (_g('validate')->num($listorder[$id])) {
				$data['listorder'] = $listorder[$id];
			}
			$data['flag'] = $flag[$id];
			if (strlen($sname[$id]) >= 1) {
				$data['sname'] = $sname[$id];
			}
			$data['status'] = _g('value')->sb($status[$id]);
			if(!$SELECTITEM->update ( $data, 'siid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		$SELECTITEM->cacheWrite();
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$siid = _post('siid');
		if (! my_is_array( $siid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($siid as $id){
			if(!$SELECTITEM->delete ( 'siid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		$SELECTITEM->cacheWrite();
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		
		$SELECTITEM->db->from($SELECTITEM->t_common_selectitem);
		$SELECTITEM->db->where('selectid', $selectid);
		$pageData = _g('page')->c($SELECTITEM->db->count(), 20, 10, _get('page'));
		$SELECTITEM->db->limit($pageData['start'], $pageData['size']);
		$SELECTITEM->db->order_by('listorder');
		$SELECTITEM->db->select();
		$dataResult = $SELECTITEM->db->get_list();
		
		$subjectUrl = 'mod/common/ac/selectitem/selectid/' . $selectid . '/page';
		_g ( 'cp' )->set_template ( '@', 'selectitem' );
		break;
}
?>