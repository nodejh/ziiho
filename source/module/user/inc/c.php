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
	$acts = array('login', 'register', 'forget');
	if(in_array(_get('ac'), $acts)){
		include _g ( 'module' )->filename ( 'user', _get('ac') );
		return null;
	}else{
		header ( 'location:' . (sdir() . '/') );
		return null;
	}
}


switch ($UModel->suser('login_type')) {
	case 2:
		include _g ( 'module' )->inc ( 'cuser', 'common' );
		break;
	default :
		$acts = array( 'login', 'register', 'forget', 'profile', 'password', 'setting', 'avatar', 'examrec', 'jobrec', 'resume' );
		_get('ac', (in_array(_get('ac'), $acts) ? _get('ac') : 'center'));
		
		include _g ( 'module' )->filename ( 'user', _get('ac') );
		break;
}
?>