<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMaterial = _g ( 'module' )->trigger ( 'job', 'material' );

$backUrl = _g('uri')->referer();

$sortid = _get('sortid');
if(!_g('validate')->pnum($sortid)){
	smsg ( lang ( 'job:500000' ), $backUrl );
	return null;
}
$sortData = $SORT->cpos($sortid);
$pageNow = '<a href="' . _g('cp')->uri('mod/job/ac/provide/sortid/' . my_array_value('sortid', $sortData[1])) . '">';
$pageNow .= '[' . my_array_value('sname', $sortData[0]) . ']';
$pageNow .= my_array_value('sname', $sortData[1]) . '</a>';
unset($sortData);

$provideid = _get('provideid');
if(!_g('validate')->pnum($provideid)){
	smsg ( lang ( 'job:700001' ),  $backUrl );
	return null;
}
$provideRs = $PROVIDE->find($PROVIDE->t_job_provide, 'provideid', $provideid);
if(!my_is_array($provideRs)){
	smsg ( lang ( 'job:700002' ), $backUrl );
	return null;
}

$pageNow .= ('&nbsp;&raquo;&nbsp;<a href="' . _g('cp')->uri('mod/job/ac/provide/op/item/sortid/' . $sortid . '/provideid/' . $provideid) . '">' . $provideRs['pname'] . '</a>');

/* switch */
switch (_get ( 'f' )) {
	case 'material':
		$itemid = _get ( 'itemid' );
		$proItemSub = $PROVIDE->find ( $PROVIDE->t_job_provide_item, 'itemid', $itemid );
		if (!my_is_array($proItemSub)) {
			smsg ( lang ( 'job:700003' ) );
			return null;
		}
		$materialUrl = 'mod/job/ac/provide/op/item/f/material/sortid/' . $sortid . '/provideid/' . $provideid. '/itemid/' . $itemid;
		$pageNow .= ('&nbsp;&raquo;&nbsp;<a href="' . _g('cp')->uri($materialUrl) . '">' . $proItemSub['title'] . '</a>');
		
		include _g ( 'cp' )->ac ( 'job', 'material' );
		break;
	case 'write':
		$itemid = null;
		$proItemSub = array ( 'provideid' => $provideid );
		if (_g ( 'validate' )->hasget ( 'itemid' )) {
			$itemid = _get ( 'itemid' );
			if (! _g ( 'validate' )->pnum ( $itemid )) {
				smsg ( lang ( '200014' ), $backUrl );
				return null;
			}
			$proItemSub = $PROVIDE->find ($PROVIDE->t_job_provide_item,  'itemid', $itemid );
			if (! is_array ( $proItemSub )) {
				smsg ( lang ( 'job:700003' ), $backUrl );
				return null;
			}
		}
		
		/* 方案分类 */
		$PROVIDE->db->from($PROVIDE->t_job_provide);
		$PROVIDE->db->where('status', _g('value')->sb( true ));
		$PROVIDE->db->where('sortid', $sortid);
		$PROVIDE->db->order_by('listorder');
		$PROVIDE->db->select();
		$provideResult = $PROVIDE->db->get_list();
		
		_g ( 'cp' )->set_template ( 'job', 'provide_item_write' );
		break;
	case 'write_save':
		$_post_provideid = _post('post_provideid');
		$itemid = _post('itemid');
		
		$listorder = _post('listorder');
		$title = _post('title');
		$content = _post('content');
		$status = _g('value')->sb ( _post('status') );
		$ctime = _g ( 'cfg>time' );
		
		if (!_g('validate')->num($itemid)) {
			smsg (lang ( '200014' ) );
			return null;
		}
		if (!_g('validate')->pnum($_post_provideid)) {
			smsg (lang ( 'job:700001' ) );
			return null;
		}
		if (strlen($title) < 1) {
			smsg ( lang ( 'job:700004' ) );
			return null;
		}
		
		$isUpdate = _g('validate')->pnum($itemid);
		if ($isUpdate) {
			$proItemSub = $PROVIDE->find ( $PROVIDE->t_job_provide_item, 'itemid', $itemid );
			if (!my_is_array($proItemSub)) {
				smsg ( lang ( 'job:700003' ) );
				return null;
			}
		}
		
		$post_provideSub = $PROVIDE->find ( $PROVIDE->t_job_provide, 'provideid', $_post_provideid );
		if (!my_is_array( $post_provideSub )) {
			smsg ( lang ( 'job:700002' ) );
			return null;
		}
		
		/* data */
		$listorder = (_g('validate')->num($listorder) ? $listorder : 0);
		$data = array (
				'listorder' => $listorder,
				'title' => $title,
				'content' => $content,
				'ctime' => $ctime,
				'status' => $status,
				'sortid' => $post_provideSub['sortid'],
				'provideid' => $_post_provideid
		);
		if ($isUpdate) {
			unset ($data['ctime']);
			$success = $PROVIDE->update ($PROVIDE->t_job_provide_item, $data, null, 'itemid', $itemid);
		} else {
			$success = $PROVIDE->insert ($PROVIDE->t_job_provide_item, $data);
		}
		if (!$success){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	case 'update':
		$itemid = _post('itemid');
		$listorder = _post('listorder');
		$status = _post('status');
		
		if (!my_is_array($itemid)) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		foreach ($itemid as $_id) {
			$data = array();
			if(_g('validate')->num($listorder[$_id])){
				$data['listorder'] = $listorder[$_id];
			}
			$data['status'] = _g ( 'value' )->sb ($status[$_id]);
				
			if(!$PROVIDE->update ( $PROVIDE->t_job_provide_item, $data, null, 'itemid', $_id )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'move':
		$itemid = _post('itemid');
		$new_provideid = _post('new_provideid');
		
		if (!my_is_array($itemid)) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		if (!_g('validate')->pnum( $new_provideid )) {
			smsg (lang ( 'job:700001' ) );
			return null;
		}
		$new_provideSub = $PROVIDE->find ( $PROVIDE->t_job_provide, 'provideid', $new_provideid );
		if (!my_is_array($new_provideSub)) {
			smsg ( lang ( 'job:700002' ) );
			return null;
		}
		
		/* update */
		$PROVIDE->db->from ( $PROVIDE->t_job_provide_item );
		$PROVIDE->db->where_in ( 'itemid', $itemid );
		$PROVIDE->db->set ( 'provideid', $new_provideid );
		$PROVIDE->db->update ();
		if ( !$PROVIDE->db->is_success () ) {
			smsg ( lang ( '200013' ) );
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		
		$pageData = null;
		$dataResult = null;
		
		/* move */
		$PROVIDE->db->from($PROVIDE->t_job_provide);
		$PROVIDE->db->where('status', _g ( 'value' )->sb (true));
		$PROVIDE->db->where('sortid', $sortid);
		$PROVIDE->db->where('provideid', $provideid, '!=');
		$PROVIDE->db->order_by('listorder');
		$PROVIDE->db->select();
		$provideResult = $PROVIDE->db->get_list();
		
		/* result */
		$PROVIDE->db->from($PROVIDE->t_job_provide_item);
		$PROVIDE->db->where('sortid', $sortid);
		$PROVIDE->db->where('provideid', $provideid);
		$pageData = _g('page')->c($PROVIDE->db->count(), 15, 10, _get('page'));
		$PROVIDE->db->limit($pageData['start'], $pageData['size']);
		$PROVIDE->db->order_by('listorder');
		$PROVIDE->db->select();
		$dataResult = $PROVIDE->db->get_list();
		
		$pageData['uri'] = 'mod/job/ac/provide/op/item/sortid/' . $sortid . '/provideid/' . $provideid . '/page/';
		$writeUrl = 'mod/job/ac/provide/op/item/f/write/sortid/' . $sortid . '/provideid/' . $provideid;
		$materialUrl = 'mod/job/ac/provide/op/item/f/material/sortid/' . $sortid . '/provideid/' . $provideid;
		
		_g ( 'cp' )->set_template ( 'job', 'provide_item' );
		break;
}
?>