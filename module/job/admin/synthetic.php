<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g ( 'module' )->trigger ( 'job', 'model' );
$SYNTHETIC = _g ( 'module' )->trigger ( 'job', 'synthetic' );

$gobackUrl = _g('uri')->referer();

switch (_get ( 'op' )) {
	case 'write' :
		$syntheticRs = array ('stype' => $JMODEL->qsType('radio', 'v'), 'option' => array(), 'typeid' => _get('typeid'));
		$syntheticid = null;
		if (_g ( 'validate' )->hasget ( 'syntheticid' )) {
			$syntheticid = _get ( 'syntheticid' );
			if (! _g ( 'validate' )->pnum ( $syntheticid )) {
				smsg ( lang ( '200014' ), $gobackUrl );
				return null;
			}
			$syntheticRs = $SYNTHETIC->find ( 'syntheticid', $syntheticid );
			if (! is_array ( $syntheticRs )) {
				smsg ( lang ( 'job:800003' ), $gobackUrl );
				return null;
			}
			
			$syntheticRs['option'] = $JMODEL->qsOptionDe($syntheticRs['option']);
		}
		_g ( 'cp' )->set_template ( 'job', 'synthetic_write' );
		break;
	case 'write_save' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$typeid = _post ( 'typeid' );
		$syntheticid = _post ( 'syntheticid' );
		$listorder = _post ( 'listorder' );
		$title = _post ( 'title' );
		$stype = _post ( 'stype' );
		$option = _post ( 'option' );
		$answer = _post ( 'answer' );
		$status = _post ( 'status' );
		
		$optionData = array();
		$answerData = array();
		
		if (! _g ( 'validate' )->num ( $syntheticid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		if (strlen ( $title ) < 1) {
			smsg ( lang ( 'job:800000' ) );
			return null;
		}
		
		if(my_in_array($stype, array('radio', 'checkbox'))){
			if(!my_is_array( $option )){
				smsg ( lang ( 'job:800001' ) );
				return null;
			}
			if (!my_is_array( $answer )) {
				smsg ( lang ( 'job:800002' ) );
				return null;
			}
			
			/* option */
			$optIndex = 0;
			foreach ($option as $optKey => $optVal){
				if(strlen($optVal) < 1){
					$optVal = 'undefined';
				}
				/* option id key */
				$optIdStr = $JMODEL->qsOptionId($optKey);
				/* answer */
				if (my_in_array($optKey, $answer)) {
					my_array_push( $answerData, $optIdStr );
				}
				
				$optionData[$optIdStr] = array(
						'flag' => $JMODEL->qsOptionOrder ( $optIndex ),
						'name' => my_stripslashes($optVal)
					);
				$optIndex = $optIndex + 1;
			}
		}
		
		/* set data */
		$listorder = (_g ( 'validate' )->num ( $listorder ) ? $listorder : 0);
		$data = array(
				'listorder'=>$listorder,
				'title'=>$title,
				'stype'=>$stype,
				'option'=>my_addslashes(array2str($optionData)),
				'answer'=>my_addslashes(array2str($answerData)),
				'ctime'=>_g('cfg>time'),
				'status'=>_g('value')->sb($status),
				'typeid'=>$typeid,
		);
		$isUpdate = _g ( 'validate' )->pnum ( $syntheticid );
		$s = null;
		if ($isUpdate) {
			$s = $SYNTHETIC->update ($data, null, 'syntheticid', $syntheticid);
		} else {
			$s = $SYNTHETIC->insert ($data);
		}
		if (!$s){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	case 'update':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$_syntheticid = _post ( 'syntheticid' );
		$status = _post ( 'status' );
		
		if (! my_is_array( $_syntheticid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($_syntheticid as $syntheticid){
			$data = array ();
			$data['status'] = _g('value')->sb($status[$syntheticid]);
			if(!$SYNTHETIC->update ($data, null, 'syntheticid', $syntheticid )){
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
		$_syntheticid = _post ( 'syntheticid' );
		if (! my_is_array( $_syntheticid )) {
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($_syntheticid as $syntheticid){
			if(!$SYNTHETIC->delete ('syntheticid', $syntheticid )){
				smsg ( lang ( '200013' ) );
				break;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		_g('uri')->referer(true);
		
		$pageData = null;
		$dataResult = null;
		
		$typeid = 0;
		if (_g ( 'validate' )->hasget ( 'q_typeid' )) {
			$typeid = _get( 'q_typeid' );
		}
		
		/* query */
		$SYNTHETIC->db->from($SYNTHETIC->t_job_synthetic);
		$SYNTHETIC->db->where('typeid', $typeid);
		$pageData = _g('page')->c($SYNTHETIC->db->count(), 15, 10, _get('page'));
		$SYNTHETIC->db->limit($pageData['start'], $pageData['size']);
		$SYNTHETIC->db->order_by('listorder');
		$SYNTHETIC->db->select();
		$dataResult = $SYNTHETIC->db->get_list();
		
		$pageData['uri'] = 'mod/job/ac/synthetic/sortid/typeid/' . $typeid . '/page/';
		$writeUrl = 'mod/job/ac/synthetic/op/write/typeid/' . $typeid;
		_g ( 'cp' )->set_template ( 'job', 'synthetic' );
		break;
}
?>