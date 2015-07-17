<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g('module')->trigger('user');
$CUSER = _g('module')->trigger('user', 'cuser');
$UModel = _g('module')->trigger('user', 'model');
$JModel = _g('module')->trigger('job', 'model');
$JSort = _g('module')->trigger('job', 'sort');
$CZPLX = _g('module')->trigger('job', 'zplx');

if(!my_is_array($UModel->suser())){
	smsg(lang('user:100013'), _g('uri')->su('user/ac/login'));
	return null;
}


switch ($UModel->suser('login_type')) {
	case 2:
		$ts = array('c_password', 'c_setting', 'c_job', 'c_company', 'c_jskill');
		_get('t', (in_array(_get('t'), $ts) ? _get('t') : 'c_center'));
		
		include _g ( 'module' )->filename ( 'user', _get('t') );
		break;
	default :
		$ts = array('profile', 'password', 'setting', 'avatar', 'answer', 'myauth');
		_get('t', (in_array(_get('t'), $ts) ? _get('t') : 'center'));
		
		include _g ( 'module' )->filename ( 'user', _get('t') );
		break;
}
?>