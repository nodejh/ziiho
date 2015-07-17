<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$cuid = $UModel->suser('cuid');

switch (_get ( 'op' )) {
	case 'do':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$zplxid = _post('zplxid');
		$zname = _post('zname');
		$mp0 = _post('mp0');
		$mp1 = _post('mp1');
		$mp2 = _post('mp2');
		$tp = _post('tp');
		$email = _post('email');
		$ctime = _g('cfg>time');
		
		if(!_g('validate')->num($zplxid)){
			smsg(lang(200010));
			return null;
		}
		
		if(strlen($zname) < 1){
			smsg(lang('cuser:500000'));
			return null;
		}
		
		if(strlen($mp1) < 1 && strlen($tp) < 1){
			smsg(lang('cuser:500001'));
			return null;
		}
		
		$zplxRs = null;
		if(_g('validate')->pnum($zplxid)){
			$zplxRs = $CZPLX->find('zplxid', $zplxid);
			if(!$CZPLX->db->is_success($zplxRs)){
				smsg(lang('200013'));
				return null;
			}
			if(!my_is_array($zplxRs)){
				smsg(lang('100061'), null, array('type'=>'n'));
				return null;
			}
		}
		
		$data = array(
				'zname'=>$zname,
				'mp0'=>$mp0,
				'mp1'=>$mp1,
				'mp2'=>$mp2,
				'tp'=>$tp,
				'email'=>$email,
				'ctime'=>$ctime,
				'cuid'=>$cuid
		);
		if(!(!$zplxRs ? $CZPLX->insert($data) : $CZPLX->update($zplxid, $data))){
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	case 'delete':
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$zplxid = _post('zplxid');
		if(!_g('validate')->pnum($zplxid)){
			smsg(lang(200010));
			return null;
		}
		$zplxRs = $CZPLX->find('zplxid', $zplxid);
		if(!$CZPLX->db->is_success($zplxRs)){
			smsg(lang('200013'));
			return null;
		}
		if(my_is_array($zplxRs)){
			if(!$CZPLX->delete($zplxid)){
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	default :
		$cUserData = $CUSER->find_jion('a.cuid', $cuid);
		if(!my_is_array($cUserData)){
			smsg(lang('cuser:300001'));
			return null;
		}
		
		/* 联系人 */
		$CZPLX->db->from($CZPLX->t_job_zplx);
		$CZPLX->db->where('cuid', $cuid);
		$zplxPageData = _g('page')->c($CZPLX->db->count(), 10, 10, _get('page'));
		$CZPLX->db->limit($zplxPageData['start'], $zplxPageData['size']);
		$CZPLX->db->order_by('ctime');
		$CZPLX->db->select();
		$zplxResult = $CZPLX->db->get_list();
		$zplxPageData['uri'] = 'user/ac/company/tab/4/page/';
		
		include _g ( 'template' )->name ( 'cuser', 'zplx', true );
		break;
}
?>