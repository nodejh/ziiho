<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g('module')->trigger('user');
$CUSER = _g('module')->trigger('cuser');
$UModel = _g('module')->trigger('user', 'model');
$JModel = _g('module')->trigger('job', 'model');
$JSort = _g('module')->trigger('job', 'sort');
$CZPLX = _g('module')->trigger('job', 'zplx');

if(strtolower(_get('ac')) == 'logout'){
	my_session_destroy();
	header ( 'location:' . (sdir() . '/') );
	return null;
}

if(!my_is_array($UModel->suser())){
	header ( 'location:' . (sdir() . '/') );
	return null;
}

$uid = $UModel->suser('uid');

switch ($UModel->suser('login_type')) {
	case 2:
		smsg('error!');
		break;
	default :
		$acts = array( 'resume', 'view' );
		_get('ac', (in_array(_get('ac'), $acts) ? _get('ac') : 'manager'));
		
		include _g ( 'module' )->filename ( 'resume', _get('ac') );
		break;
}
?>