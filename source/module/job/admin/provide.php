<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g ( 'module' )->trigger ( 'job', 'model' );
$SORT = _g ( 'module' )->trigger ( 'job', 'sort' );
$PROVIDE = _g ( 'module' )->trigger ( 'job', 'provide' );

$gobackUrl = _g('uri')->referer();

$writeUrlStr = 'mod/job/ac/provide/op/write';

switch (_get ( 'op' )) {
	case 'add':
		$listorder = _post('_listorder');
		$pname = _post('_pname');
		$status = _post('_status');
		
		$sortid = _post('sortid');
		
		if (strlen($pname) < 1) {
			smsg(lang('job:700000'));
			return null;
		}
		if (!_g( 'validate' )->num ($listorder)) {
			$listorder = 0;
		}
		$status = _g ( 'value' )->sb ($status);
		
		$sortRs = $SORT->find('sortid', $sortid);
		if(!my_is_array($sortRs)){
			smsg ( lang ( 'job:500001' ) );
			return null;
		}
		
		$data = array (
				'listorder' => $listorder,
				'pname' => $pname,
				'ctime' => _g ( 'cfg>time' ),
				'status' => $status,
				'sortid' => $sortid
		);
		
		if(!$PROVIDE->insert ( $PROVIDE->t_job_provide, $data )){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		
		break;	
	case 'update':
		$provideid = _post('provideid');
		$listorder = _post('listorder');
		$pname = _post('pname');
		$status = _post('status');
		
		if (my_is_array($provideid) < 1) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($provideid as $_id) {
			$data = array();
			if(_g('validate')->num($listorder[$_id])){
				$data['listorder'] = $listorder[$_id];
			}
			if(strlen($pname[$_id]) >= 1){
				$data['pname'] = $pname[$_id];
			}
			$data['status'] = _g ( 'value' )->sb ($status[$_id]);
			
			if(!$PROVIDE->update ( $PROVIDE->t_job_provide, $data, null, 'provideid', $_id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'delete':
		$provideid = _post('provideid');
		
		if (my_is_array($provideid) < 1) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($provideid as $_id) {
			if(!$PROVIDE->delete ( $PROVIDE->t_job_provide, 'provideid', $_id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'item':
		include _g ( 'cp' )->ac ( 'job', 'provide_item' );
		break;
	default :
		_g('uri')->referer(true);
		
		$pageData = null;
		$dataResult = null;
		
		$sortid = _get('sortid');
		
		$getPars = array ();
		if (strlen($sortid) != 0) {
			$getPars['sortid'] = $sortid;
		}
		
		if (!empty($getPars)) {
			$PROVIDE->db->from($PROVIDE->t_job_provide);
			
			if (my_array_key_exist ('sortid', $getPars)) { 
				$PROVIDE->db->where ( 'sortid', $getPars['sortid'] );
			}
			
			$pageData = _g('page')->c($PROVIDE->db->count(), 15, 10, _get('page'));
			$PROVIDE->db->limit($pageData['start'], $pageData['size']);
			$PROVIDE->db->order_by('listorder');
			$PROVIDE->db->select();
			$dataResult = $PROVIDE->db->get_list();
			
			$pageData['uri'] = 'mod/job/ac/provide/sortid/' . $sortid;
			$pageData['uri'] .= '/page/';
		}
		
		$itemsUrl = 'mod/job/ac/provide/op/item/sortid/' . $sortid;
		_g ( 'cp' )->set_template ( 'job', 'provide' );
		break;
}
?>