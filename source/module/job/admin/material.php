<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g ( 'module' )->trigger ( 'job', 'model' );
$sort = _g ( 'module' )->trigger ( 'job', 'sort' );

$materialWriteUrl = 'mod/job/ac/provide/op/item/f/material/d/write/sortid/' . $sortid . '/provideid/' . $provideid . '/itemid/' . $itemid;

switch (_get ( 'd' )) {
	case 'write' :
		$materialSub = array ();
		$materialid = null;
		if (_g ( 'validate' )->hasget ( 'materialid' )) {
			$materialid = _get ( 'materialid' );
			if (! _g ( 'validate' )->pnum ( $materialid )) {
				smsg ( lang ( '110014' ), $gobackUrl );
				return null;
			}
			$materialSub = $JMaterial->find ( 'materialid', $materialid );
			if (! is_array ( $materialSub )) {
				smsg ( lang ( 'job:400000' ), $gobackUrl );
				return null;
			}
		}
		_g ( 'cp' )->set_template ( 'job', 'material_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$materialid = _post ( 'materialid' );
		$title = _post ( 'title' );
		$subtitle = _post ( 'subtitle' );
		$author = _post ( 'author' );
		$publish = _post ( 'publish' );
		$publishdate = _post ( 'publishdate' );
		$viewurl = _post ( 'viewurl' );
		$description = _post ( 'description' );
		$status = _g('value')->sb( true );
		$sortid = _post ( 'sortid' );
		
		if (! _g ( 'validate' )->num ( $materialid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		
		if (strlen ( $title ) < 1) {
			smsg ( lang ( 'job:400001' ) );
			return null;
		}
		
		$data = array(
				'title'=>$title,
				'subtitle'=>$subtitle,
				'author'=>$author,
				'publish'=>$publish,
				'publishdate'=>$publishdate,
				'viewurl'=>$viewurl,
				'description'=>$description,
				'ctime'=>_g('cfg>time'),
				'status'=>$status,
				'sortid'=>$proItemSub['sortid'],
				'provideid'=>$proItemSub['provideid'],
				'itemid'=>$proItemSub['itemid']
		);
		
		$JMaterial->writeSave ( $materialid, $data );
		break;
	case 'delete' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$_materialid = _post ( 'materialid' );
		if (! my_is_array( $_materialid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($_materialid as $materialid){
			if(!$JMaterial->delete ( $materialid )){
				break;
			}
		}
		break;
	default :
		_g('uri')->referer(true);
		$JMaterial->db->from($JMaterial->t_job_material);
		$JMaterial->db->where('sortid', $proItemSub['sortid']);
		$JMaterial->db->where('provideid', $proItemSub['provideid']);
		$JMaterial->db->where('itemid', $proItemSub['itemid']);
		$pageData = _g('page')->c($JMaterial->db->count(), 15, 10, _get('page'));
		$JMaterial->db->limit($pageData['start'], $pageData['size']);
		$JMaterial->db->order_by('ctime', 'DESC');
		$JMaterial->db->select();
		$dataResult = $JMaterial->db->get_list();
		
		$pageData['uri'] = 'mod/job/ac/provide/op/item/f/material/sortid/' . $sortid . '/provideid/' . $provideid . '/itemid/' . $itemid . '/page/';
		_g ( 'cp' )->set_template ( 'job', 'material' );
		break;
}
?>