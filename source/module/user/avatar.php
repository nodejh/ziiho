<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$uid = $UModel->suser('uid');

switch (_get ( 'op' )) {
	default :
		$cUserData = $USER->find_jion('a.uid', $uid);
		
		if(!my_is_array($cUserData)){
			smsg(lang('user:cuser>300001'));
			return null;
		}
		include _g ( 'template' )->name ( 'user', 'avatar', true );
		break;
}
?>