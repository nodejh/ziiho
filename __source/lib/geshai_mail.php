<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_mail {
	public $phpmailer_isload = false;
	public $_message = null;
	function __construct() {
	}
	function geshai_mail() {
		$this->__construct ();
	}
	function send(&$data) {
		$settings = _g ( 'module' )->trigger ( '@', 'setting', null, 'finds', array (
				'module' => 'user',
				'stype' => 'emailSetting' 
		) );
		
		if ($this->phpmailer_isload !== true) {
			$filename = _g ( 'loader' )->api ( 'phpmailer', 'class.phpmailer' );
			if ($filename === false) {
				return false;
			}
			include ($filename);
		}
		$this->phpmailer_isload = true;
		
		try {
			$mail = new PHPMailer ( true );
			
			$mail->CharSet = _g ( 'cfg>charset' );
			$mail->Encoding = _g ( 'cfg>encode' );
			
			$mail->IsSMTP ();
			$mail->SMTPAuth = true;
			$mail->Port = my_array_value ( 'port', $settings );
			$mail->Host = my_array_value ( 'host', $settings );
			$mail->Username = my_array_value ( 'email', $settings );
			$mail->Password = my_array_value ( 'password', $settings );
			
			/* $mail->IsSendmail(); */
			/* $mail->AddReplyTo("2832422522@qq.com","千里眼"); */
			
			$mail->From = my_array_value ( 'email', $settings );
			$mail->FromName = my_array_value ( 'sname', $settings );
			
			$mail->AddAddress ( my_array_value ( 'to', $data ) );
			
			$mail->Subject = my_array_value ( 'subject', $data );
			$mail->AltBody = 'Sorry, loss of content.';
			$mail->WordWrap = 80;
			
			$mail->MsgHTML ( my_array_value ( 'body', $data ) );
			$mail->IsHTML ( true );
			$mail->Send ();
			
			$this->_message = null;
			return true;
		} catch ( phpmailerException $e ) {
			$this->_message = $e->errorMessage ();
			return false;
		}
	}
	function message() {
		return $this->_message;
	}
}
?>