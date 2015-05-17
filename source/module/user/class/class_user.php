<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user extends geshai_model {
	public $t_user = 'user';
	public $t_user_profile = 'user_profile';
	
	public $t_field = 'a.uid,a.username,a.password,a.regtime,a.regip,a.lasttime,a.lastip,a.curtime,a.curip,a.email_auth,a.online,a.status,b.nickname,b.gender,b.birthday,b.emotion,b.residence,b.hometown,b.sign';
	
	function __construct() {
		parent::__construct ();
	}
	function class_user() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_user );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function profile_find($k, $v = null) {
		$this->db->from ( $this->t_user_profile );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function find_jion($k, $v = null){
		$this->db->join($this->t_user, 'a.uid', $this->t_user_profile, 'b.uid', 'LEFT JOIN');
		$this->db->where($k, $v);
		$this->db->select($this->t_field);
		return $this->db->get_one();
	}
	
	/* 邮箱注册 */
	function emailRegister($data){
		$uRs = $this->find('username', $data['username']);
		if(!$this->db->is_success($uRs)){
			smsg(lang('110013'));
			return null;
		}
		if(my_is_array($uRs)){
			smsg(lang('user:100004'));
			return null;
		}
		
		$this->db->from($this->t_user);
		$this->db->set($data);
		$this->db->insert();
		if(!$this->db->is_success()){
			smsg(lang('110013'));
			return null;
		}
		$data['uid'] = $this->db->insert_id();
		$data['flag'] = 'register';
		my_session('suser', my_stripslashes($data));
		
		if(!$this->email_send($data)){
			smsg(_g('mail')->message());
			return null;
		}
		
		/* 跳转值验证提示页 */
		$redirectUrl = _g('uri')->su('user/ac/register/op/email_auth');
		smsg(lang('user:100006'), $redirectUrl, 1);
	}
	function email_auth($k, $v = null){
		$this->db->from($this->t_user);
		$this->db->where($k, $v);
		$this->db->set('email_auth', _g('value')->sb(true));
		$this->db->update();
		return $this->db->is_success();
	}
	
	function email_send($data){
		/* 验证回调地址 */
		$authCallbackUrl = _g('uri')->ser();
		if(my_array_value('flag_forget_email', $data) == 1){
			$authCallbackUrl .= _g('uri')->su('user/ac/forget/op/email_pw/e/');
		}else{
			$authCallbackUrl .= _g('uri')->su('user/ac/register/op/email_auth_do/e/');
		}
		$authCallbackUrl .= urlencode(base64_encode(base64_encode($data['username'])));
		
		$sData = array(
				'to'=>$data['username'],
				'subject'=>'邮箱验证',
				'body'=>'<a href="' . $authCallbackUrl . '">' . $authCallbackUrl . '-点击此链接，进行邮箱验证，在24小时内有效。</a>'
		);
		return _g('mail')->send($sData);
	}
	
	function updatePassword($uid, $password){
		$this->db->from($this->t_user);
		$this->db->where('uid', $uid);
		$this->db->set('password', my_md5($password, 2));
		$this->db->update();
		return $this->db->is_success();
	}
	
	function resetPassword($uid, $password, $new_password){
		$uRs = $this->find('uid', $uid);
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('user:100020'));
			return null;
		}
		if(!_g('validate')->v2eq($uRs['password'], $password, true)){
			smsg(lang('user:100018'));
			return null;
		}
	
		$this->db->from($this->t_user);
		$this->db->where('uid', $uid);
		$this->db->set('password', $new_password);
		$this->db->update();
		if(!$this->db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		my_session_destroy();
		smsg(lang('100061'), _g('uri')->su('user/ac/login'), 1);
	}
	
	/* login */
	function login($username, $password){
		$uRs = $this->find_jion(array('a.username'=>$username, 'a.status'=>_g('value')->sb(true)));
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('user:100020'));
			return null;
		}
		if(!_g('validate')->v2eq($uRs['password'], my_md5($password, 2), true)){
			smsg(lang('user:100015'));
			return null;
		}
	
		$uRs['login_type'] = 1;
		my_session('suser', $uRs);
	
		$toUrl = _g('uri')->su('user');
		smsg(lang('user:100016'), $toUrl, 1);
	}
	
	function updateProfile($uid, $data){
		$uRs = $this->find(array('uid'=>$uid, 'status'=>_g('value')->sb(true)));
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('user:100020'));
			return null;
		}
		/* if exist */
		$pRs = $this->profile_find('uid', $uid);
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		$this->db->from($this->t_user_profile);
		if(my_is_array($pRs)){
			$this->db->where('uid', $uid);
			$this->db->set($data);
			$this->db->update();
		}else{
			$this->db->set($data);
			$this->db->insert();
		}
		if(!$this->db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
	}
}
?>