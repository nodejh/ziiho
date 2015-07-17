<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );
$UGROUP = _g ( 'module' )->trigger ( 'user', 'group' );

$uGroupData = _g('module')->dv('user', 100002);

switch (_get ( 'op' )) {
	case 'do':
		$status = _post('status');
		$usergroup = _post('usergroup');
		$userable = _g('value')->nl2arr(_post('userable'));
		$ipable = _g('value')->nl2arr(_post('ipable'));
		
		$settings = array();
		$settings[] = array('common', 'visitable', 'status', $status);
		$settings[] = array('common', 'visitable', 'usergroup', my_addslashes(array2str($usergroup)), 1);
		$settings[] = array('common', 'visitable', 'userable', my_addslashes(array2str($userable)), 1);
		$settings[] = array('common', 'visitable', 'ipable', my_addslashes(array2str($ipable)), 1);
		
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	default :
		$options = $OPT->finds(array('module'=>'common', 'stype'=>'visitable'));
		$options['usergroup'] = my_array_value('usergroup', $options);
		$options['userable'] = _g('value')->arr2nl(my_array_value('userable', $options));
		$options['ipable'] = _g('value')->arr2nl(my_array_value('ipable', $options));
		
		$ugOptions = my_array_value('usergroup', $options);
		
		_g ( 'cp' )->set_template ( '@', 'visitablecfg' );
		break;
}
?>