<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$OPT = _g ( 'module' )->trigger ( '@', 'option' );

switch (_get ( 'op' )) {
	case 'do':
		$checkcode = _post('checkcode');
		$invitecode = _post('invitecode');
		$registermodel = _post('registermodel');
		$email_auth = _post('email_auth');
		$messagemodel = _post('messagemodel');
		$message_title = _post('message_title');
		$message_data = _post('message_data');
		
		$registermodel = my_addslashes(array2str($registermodel));
		$messagemodel = my_addslashes(array2str($messagemodel));
		$settings = array();
		$settings[] = array('common', 'register', 'checkcode', $checkcode);
		$settings[] = array('common', 'register', 'invitecode', $invitecode);
		$settings[] = array('common', 'register', 'registermodel', $registermodel, 1);
		$settings[] = array('common', 'register', 'email_auth', $email_auth);
		$settings[] = array('common', 'register', 'messagemodel', $messagemodel, 1);
		$settings[] = array('common', 'register', 'message_title', $message_title);
		$settings[] = array('common', 'register', 'message_data', $message_data);
		
		if(!$OPT->save($settings)){
			smsg ( lang ( '200013' ) );
		}else{
			smsg ( lang ( '100061' ), null, 1 );
		}
		break;
	default :
		$options = $OPT->finds(array('module'=>'common', 'stype'=>'register'));
		$options['registermodel'] = my_array_value('registermodel', $options);
		$options['messagemodel'] = my_array_value('messagemodel', $options);
		
		_g ( 'cp' )->set_template ( '@', 'registercfg' );
		break;
}
?>