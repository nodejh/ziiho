<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );
$INVITE = _g ( 'module' )->trigger ( '@', 'invitecode' );

$navData = array(
		'1' => array('uri'=>'mod/common/ac/invitecode/ni/1', 'name'=>'邀请码设置'),
		'2' => array('uri'=>'mod/common/ac/invitecode/op/codes/ni/2', 'name'=>'邀请码管理')
);

$ni = 1;
if(_g('validate')->hasget('ni')){
	$ni = _get('ni');
}

switch (_get ( 'op' )) {
	case 'cfgdo':
		$stime = _post('stime');
		$etime = _post('etime');
		
		$stime = strtotime($stime);
		$etime = strtotime($etime);
		$data = array(
				'stime'=>$stime,
				'etime'=>$etime
		);
		$settings = array();
		foreach ($data as $k=>$v){
			$settings[] = array('common', 'invitecode', $k, $v);
		}
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	case 'codes':
		$INVITE->db->from($INVITE->t_common_invitecode);
		//$INVITE->db->where();
		$pageData = _g('page')->c($INVITE->db->count(), 15, 10, _get('page'));
		$INVITE->db->order_by('icid');
		$INVITE->db->limit($pageData['start'], $pageData['size']);
		$INVITE->db->select();
		$invitecodeResult = $INVITE->db->get_list();
		$pageData['uri'] = 'mod/common/ac/invitecode/op/codes/ni/' . $ni . '/page/';
		
		_g ( 'cp' )->set_template ( '@', 'invitecode_codes' );
		break;
	case 'createdo':
		$num = _post('num');
		if(!_g('validate')->pnum($num)){
			smsg(lang('@:200000'));
			return null;
		}
		if($num > 20){
			smsg(lang('@:200001'));
			return null;
		}
		
		$ctime = _g('cfg>time');
		$isfree = _g('value')->sb(false);
		
		for ($i = 0; $i < $num; $i++){
			$data = array(
					'code'=>_g('value')->randchar(10),
					'ctime'=>$ctime,
					'isfree'=>$isfree
			);
			if(!$INVITE->insert($data)){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'delete':
		$icid = _post('icid');
		if(!my_is_array($icid)){
			smsg ( lang ( '200014' ) );
			return null;
		}
		foreach ($icid as $id){
			if(!$INVITE->delete('icid', $id)){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	case 'awarddo':
		$icid = _post('icid');
		if(!my_is_array($icid)){
			smsg ( lang ( '200014' ) );
			return null;
		}
		$isfree = _g('value')->sb(true);
		foreach ($icid as $id){
			if(!$INVITE->update(array('isfree'=>$isfree), 'icid', $id)){
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		break;
	default :
		$options = $OPT->finds(array('module'=>'common', 'stype'=>'invitecode'));
		$options['stime'] = date('Y-m-d H:i:s', my_array_value('stime', $options, _g('cfg>time')));
		$options['etime'] = date('Y-m-d H:i:s', my_array_value('etime', $options, _g('cfg>time')));
		
		_g ( 'cp' )->set_template ( '@', 'invitecode_cfg' );
		break;
}
?>