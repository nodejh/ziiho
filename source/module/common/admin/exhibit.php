<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$EXHIBIT = _g ( 'module' )->trigger ( '@', 'exhibit' );

$selectData = array(
		1 => array( 'uri'=> 'mod/common/ac/exhibit/op/g/i/1', 'name' =>  '分组管理' ),
		2 => array( 'uri'=> 'mod/common/ac/exhibit/i/2', 'name' =>  '幻灯管理' ),
);
$selectInd = 2;
if(_g('validate')->hasget('i')){
	$selectInd = _get('i');
}


_g('uri')->referer(true);

switch (_get ( 'op' )) {
	case 'write':
		$exhibitSub = array();
		if(_g('validate')->hasget('eid')){
			$eid = _get('eid');
			if(!_g('validate')->pnum($eid)){
				smsg ( lang ( '200014' ), _g('uri')->referer() );
				return null;
			}
			$exhibitSub = $EXHIBIT->find('eid', $eid);
			if(!my_is_array($exhibitSub)){
				smsg ( lang ( '@:400000' ), _g('uri')->referer() );
				return null;
			}
		}
		$groupResult = $EXHIBIT->gGet();
		_g ( 'cp' )->set_template ( '@', 'exhibit_write' );
		break;
	case 'write_save':
		$eid = _post('eid');
		$listorder = _post('listorder');
		$title = _post('title');
		$url = _post('url');
		$gid = _post('gid');
		$target = _post('target');
		$description = _post('description');
		$status = _post('status');
		$ctime = _g('cfg>time');
		
		$isUpdate = false;
		$exhibitSub = array();
		if(!_g('validate')->num($eid)){
			smsg(lang(200010));
			return null;
		}
		
		if(!_g('validate')->pnum($gid)){
			smsg(lang('@:400001'));
			return null;
		}
		
		if(strlen($title) < 1){
			smsg(lang('@:400002'));
			return null;
		}
		
		/* if eid exist */
		if(_g('validate')->pnum($eid)){
			$exhibitSub = $EXHIBIT->find('eid', $eid);
			if(!my_is_array($exhibitSub)){
				smsg(lang('@:400000'));
				return null;
			}
			$isUpdate = true;
		}
		
		$data = array(
			'listorder'=>$listorder,
			'title'=>$title,
			'url'=>$url,
			'target'=>$target,
			'description'=>$description,
			'ctime'=>$ctime,
			'status'=>_g('value')->sb($status),
			'gid'=>$gid
		);
		if($isUpdate){
			unset($data['ctime']);
		}
		
		if($isUpdate){
			$result = $EXHIBIT->update($data, 'eid', $eid);
		}else{
			$result = $EXHIBIT->insert ( $data );
			$eid = $result;
		}
		if(!$result){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* upload */
		$srcFile = _ifile('src');
		if($srcFile['size'] >= 1){
			$extMsg = my_join(';', _g('module')->dv('@', 200000));
			$info = getimagesize($srcFile['tmp_name']);
			if(!_g('validate')->imagetype($srcFile['tmp_name'])){
				smsg(lang(300005, $extMsg));
				return null;
			}
			if(_g('validate')->fsover($srcFile['size'], 4)){
				smsg(lang(300006, 4));
				return null;
			}
			if($info[0] < 1 || $info[1] < 1){
				smsg(lang(300008));
				return null;
			}
		
			/* 保存目录 */
			$rootDir = sdir(':uploadfile');
			$saveDir = 'common/exhibit/' . date('Y/m', $ctime);
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($srcFile['name']);
				
			/* delete old file */
			if($isUpdate){
				if(!_g('file')->delete($rootDir . '/' . $exhibitSub['src'])){
					smsg(lang('@:400004'));
					return null;
				}
			}
			if(!$EXHIBIT->update(array('src'=>$sfname), 'eid', $eid)){
				smsg ( lang ( '200013' ) );
				return null;
			}
			/* up  */
			if(!move_uploaded_file($srcFile['tmp_name'], ($rootDir . '/' . $sfname))){
				smsg(lang('300002'));
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'update':
		$eid = _post('eid');
		$listorder = _post('listorder');
		$status = _post('status');
		
		if(my_count($eid) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($eid as $id){
			$data = array();
			if(_g('validate')->num($listorder[$id])){
				$data['listorder'] = $listorder[$id];
			}
			$data['status'] = _g('value')->sb($status[$id]);
			if(!$EXHIBIT->update ( $data, 'eid', $id )){
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
		$eid = _post('eid');
		if (! my_is_array( $eid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($eid as $id){
			if(!$EXHIBIT->delete ( 'eid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	/* --------------- */
	case 'gadd':
		$listorder = _post('_listorder');
		$gname = _post('_gname');
		$ctime = _g('cfg>time');
		if(_g('validate')->num(!$listorder)){
			$listorder = 0;
		}
		if(strlen($gname) < 1){
			smsg(lang('@:400003'));
			return null;
		}
		
		$data = array(
				'listorder' => $listorder,
				'gname' => $gname,
				'ctime' => $ctime
		);
		if(!$EXHIBIT->ginsert ( $data )){
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'gupdate':
		$gid = _post('gid');
		$listorder = _post('listorder');
		$gname = _post('gname');
	
		if(my_count($gid) < 1){
			smsg ( lang ( '200014' ) );
			return null;
		}
	
		foreach ($gid as $id){
			$data = array();
			if(_g('validate')->num($listorder[$id])){
				$data['listorder'] = $listorder[$id];
			}
			if(strlen($gname[$id]) >= 1){
				$data['gname'] = $gname[$id];
			}
			if(!$EXHIBIT->gupdate ( $data, 'gid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'gdelete':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$gid = _post('gid');
		if (! my_is_array( $gid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($gid as $id){
			if(!$EXHIBIT->gdelete ( 'gid', $id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'g':
		$EXHIBIT->db->from($EXHIBIT->t_common_exhibitg);
		$pageData = _g('page')->c($EXHIBIT->db->count(), 15, 10, _get('page'));
		$EXHIBIT->db->limit($pageData['start'], $pageData['size']);
		$EXHIBIT->db->order_by('listorder');
		$EXHIBIT->db->select();
		$dataResult = $EXHIBIT->db->get_list();
		
		$subjectUrl = 'mod/common/ac/exhibit/op/g/i/1/page';
		_g ( 'cp' )->set_template ( '@', 'exhibit_group' );
		break;
	default :
		$EXHIBIT->db->from($EXHIBIT->t_common_exhibit);
		$pageData = _g('page')->c($EXHIBIT->db->count(), 15, 10, _get('page'));
		$EXHIBIT->db->limit($pageData['start'], $pageData['size']);
		$EXHIBIT->db->order_by('listorder');
		$EXHIBIT->db->select();
		$dataResult = $EXHIBIT->db->get_list();
		
		$subjectUrl = 'mod/common/ac/exhibit/i/2/page';
		_g ( 'cp' )->set_template ( '@', 'exhibit' );
		break;
}
?>