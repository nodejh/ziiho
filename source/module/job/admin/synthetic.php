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
		$anyanswer = max (_g('value')->sb(_post ( 'anyanswer' )), -1);
		
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
			if ($anyanswer < 1) {
				if (!my_is_array( $answer )) {
					smsg ( lang ( 'job:800002' ) );
					return null;
				}
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
						'name' => my_htmlspecialchars( my_stripslashes( $optVal ) )
					);
				$optIndex = $optIndex + 1;
			}
		}
		
		/* is exist */
		$qRs = array ();
		$isUpdate = _g ( 'validate' )->pnum ( $syntheticid );
		if ($isUpdate) {
			$qRs = $SYNTHETIC->find ( 'syntheticid', $syntheticid );
			if (!my_is_array( $qRs )) {
				smsg ( lang ( 'job:800003' ));
				return null;
			}
		}
		
		/* set data */
		$listorder = (_g ( 'validate' )->num ( $listorder ) ? $listorder : 0);
		$data = array(
				'listorder'=>$listorder,
				'title'=>my_htmlspecialchars( $title ),
				'stype'=>$stype,
				'option'=>my_addslashes(array2str($optionData)),
				'answer'=>my_addslashes(array2str($answerData)),
				'ctime'=>_g('cfg>time'),
				'anyanswer'=>$anyanswer,
				'status'=>_g('value')->sb($status),
				'typeid'=>$typeid,
		);
		$s = null;
		if ($isUpdate) {
			$s = $SYNTHETIC->update ($data, null, 'syntheticid', $syntheticid);
		} else {
			$s = $SYNTHETIC->insert ($data);
			$syntheticid = $SYNTHETIC->db->insert_id ();
		}
		if (!$s){
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
			$saveDir = 'job/synthetic';
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($srcFile['name']);
				
			/* delete old file */
			if($isUpdate){
				if (strlen( $qRs['src'] ) >= 1) {
					if(!_g('file')->delete($rootDir . '/' . $qRs['src'])){
						smsg(lang('job:800004'));
						return null;
					}
				}
			}
			$s = $SYNTHETIC->update ('src', $sfname, 'syntheticid', $syntheticid);
			if(!$s){
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
		
		/* uploadfile dir */
		$rootDir = sdir(':uploadfile');
		
		foreach ($_syntheticid as $syntheticid){
			$qRs = $SYNTHETIC->find ( 'syntheticid', $syntheticid );
			if (!$SYNTHETIC->db->is_success ( $qRs )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (!my_is_array( $qRs )) {
				continue;
			}
			
			/* delete file */
			if (strlen( $qRs['src'] ) >= 1) {
				if(!_g('file')->delete($rootDir . '/' . $qRs['src'])){
					smsg(lang('job:800005'));
					return null;
				}
			}
			if(!$SYNTHETIC->delete ('syntheticid', $syntheticid )){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	
	case 'delsrc':
		$syntheticid = _post( 'syntheticid' );
		$qRs = $SYNTHETIC->find ( 'syntheticid', $syntheticid );
		if (!my_is_array( $qRs )) {
			smsg ( lang ( 'job:800003' ));
			return null;
		}
		/* delete file */
		if (strlen( $qRs['src'] ) >= 1) {
			if(!_g('file')->delete(sdir(':uploadfile') . '/' . $qRs['src'])){
				smsg(lang('job:800005'));
				return null;
			}
			if(!$SYNTHETIC->update ('src', null, 'syntheticid', $syntheticid )){
				smsg ( lang ( '200013' ) );
				return null;
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