<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );

switch (_get ( 'op' )) {
	case 'do':
		$seoData = my_array_value('data', $OPT->finds(array('module'=>'common', 'stype'=>'seo')));
		
		$flag = _post('flag');
		$seoData[$flag] = my_stripslashes(_post($flag));
		 
		$data = my_addslashes(array2str($seoData));
		$seos = array(
				array('common', 'seo', 'data', $data, 1)
		);
		if(!$OPT->save($seos)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	default :
		$seoData = my_array_value('data', $OPT->finds(array('module'=>'common', 'stype'=>'seo')));
		
		_g ( 'cp' )->set_template ( '@', 'seo' );
		break;
}
?>