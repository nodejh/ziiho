<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );

switch (_get ( 'op' )) {
	case 'do':
		$sitename = _post('sitename');
		$subname = _post('subname');
		$url = _post('url');
		$keywords = _post('keywords');
		$description = _post('description');
		$icp = _post('icp');
		$siteskin = _post('siteskin');
		
		$data = array(
				'sitename'=>$sitename,
				'subname'=>$subname,
				'url'=>$url,
				'keywords'=>$keywords,
				'description'=>$description,
				'icp'=>$icp,
				'siteskin'=>$siteskin
		);
		$settings = array();
		foreach ($data as $k=>$v){
			$settings[] = array('common', 'setting', $k, $v);
		}
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	default :
		$options = $OPT->finds(array('module'=>'common', 'stype'=>'setting'));
		_g ( 'cp' )->set_template ( '@', 'setting' );
		break;
}
?>