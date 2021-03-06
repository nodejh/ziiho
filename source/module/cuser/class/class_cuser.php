<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_cuser extends geshai_model {
	public $t_cuser = 'cuser';
	public $t_cuser_profile = 'cuser_profile';
	
	public $t_field = 'a.cuid,a.username,a.password,a.email,a.regtime,a.regip,a.lasttime,a.lastip,a.curtime,a.curip,a.status,a.online,a.cname,a.area,a.area_detail,a.contacts,a.telephone,a.mobilephone,a.cemail,b.professionid,b.cnatureid,b.csize,b.cdescription,b.authlicence,b.licence,b.logo';
	
	function __construct() {
		parent::__construct ();
	}
	function class_cuser() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_cuser );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function profile_find($k = null, $v = null) {
		$this->db->from ( $this->t_cuser_profile );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function find_jion($k = null, $v = null){
		$this->db->join($this->t_cuser, 'a.cuid', $this->t_cuser_profile, 'b.cuid', 'LEFT JOIN');
		$this->db->where($k, $v);
		$this->db->select($this->t_field);
		return $this->db->get_one();
	}
	
	function csortCount($v){
		$this->db->from ( $this->t_cuser_profile );
		$this->db->where_like ( 'csortid', $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	
	function sess_cuser($k = null){
		$cuser = my_serialize(my_session('cuser'), true);
		if(func_num_args() < 1){
			return _g('value')->ra($cuser);
		}
		return my_array_value($k, $cuser);
	}
	function getFisrt(){
		$this->db->from ( $this->t_cuser_profile );
		$this->db->order_by('cuid');
		$this->db->select ();
		if(!$this->db->is_success()){
			return null;
		}
		$rs = $this->db->get_one ();
		
		$data = $this->find_jion('a.cuid', $rs['cuid']);
		return $data;
	}
	
	function isUsername($v) {
		if (strlen ( $v ) < 1) {
			return false;
		} else {
			return true;
		}
	}
	
	function telephone($value, $k){
		$value = str2array($value);
		return my_array_value($k, $value);
	}
	function csort($value){
		$value = str2array($value);
		return my_join(',', $value);
	}
	function isf($value){
		if(strlen($value) < 1){
			return false;
		}
		return true;
	}
	function logo($v = null){
		$def = _g('template')->dir('job') . '/image/def/no-logo.jpg';
		if(strlen($v) < 1){
			return $def;
		}
		return sdir('uploadfile') . '/' . $v;
	}
	function getLogo($cuid) {
		$rs = $this->profile_find('cuid', $cuid);
		return $this->logo ( my_array_value( 'logo', $rs ) );
	}
	
	function getList(){
		$this->db->join($this->t_cuser, 'a.cuid', $this->t_cuser_profile, 'b.cuid', 'LEFT JOIN');
		$pageData = _g('page')->c($this->db->count(), 15, 10, _get('page'));
		$this->db->order_by('a.cuid');
		$this->db->limit($pageData['start'], $pageData['size']);
		$this->db->select($this->t_field);
		$result = $this->db->get_list();
		
		$pageData['uri'] = 'job/ac/company/page/';
		return array($pageData, $result);
	}
	
	/* ----------------------------------------------------------- */
	/* 企业用户注册 */
	function register($data, $step){
		switch ($step){
			case 1:
				/* 是否已被注册 */
				$qrs = $this->find('email', $data['email']);
				if(!$this->db->is_success($qrs)){
					smsg(lang('200013'));
					return null;
				}
				if(is_array($qrs)){
					smsg(lang('cuser:100010', $data['email']));
					return null;
				}
				
				/* 插入数据 */
				$this->db->from($this->t_cuser);
				$this->db->set($data);
				$this->db->insert();
				if(!$this->db->is_success()){
					smsg(lang('200013'));
					return null;
				}
				$data['cuid'] = $this->db->insert_id();
				$data['login_type'] = 2;
				$data['flag'] = 'register';
				
				my_session('cuser', my_stripslashes($data));
				$redirectUrl = _g('uri')->su('user/ac/register/op/company2');
				break;
			case 2:
				$rs = $this->profile_find('cuid', $data['cuid']);
				if(!$this->db->is_success($rs)){
					smsg(lang('200013'));
					return null;
				}
				/* 更新与编辑 */
				$this->db->from($this->t_cuser_profile);
				if(!my_is_array($rs)){
					$this->db->set($data);
					$this->db->insert();
				}else{
					$this->db->where('cuid', $data['cuid']);
					my_unset($data, 'cuid');
					$this->db->set($data);
					$this->db->update();
				}
				if(!$this->db->is_success()){
					smsg(lang('200013'));
					return null;
				}
				$redirectUrl = _g('uri')->su('user/ac/register/op/company3');
				break;
		}
		smsg(lang('100061'), $redirectUrl, 1);
	}
	/* updateSet */
	function updateSet($data, $k, $v = null){
		$this->db->from($this->t_cuser);
		$this->db->where($k, $v);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	/* update */
	function update($cuid, $data1, $data2 = null){
		$this->db->from($this->t_cuser);
		$this->db->where('cuid', $cuid);
		$this->db->set($data1);
		$this->db->update();
		if(!$this->db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		if(my_is_array($data2)){
			if(!$this->profileUpdate($cuid, $data2)){
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
	}
	
	/* profile update */
	function profileUpdate($cuid, $data){
		$profileRs = $this->profile_find('cuid', $cuid);
		if(!$this->db->is_success($profileRs)){
			return false;
		}
		$this->db->from($this->t_cuser_profile);
		if(my_is_array($profileRs)){
			my_unset($data, 'cuid');
			$this->db->where('cuid', $cuid);
			$this->db->set($data);
			$this->db->update();
		}else{
			$this->db->set($data);
			$this->db->insert();
		}
		return $this->db->is_success();
	}
	
	/* update password */
	function updatePassword($cuid, $password, $new_password){
		$uRs = $this->find('cuid', $cuid);
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('cuser:300001'));
			return null;
		}
		if(!_g('validate')->v2eq($uRs['password'], $password, true)){
			smsg(lang('cuser:300004'));
			return null;
		}
		
		$this->db->from($this->t_cuser);
		$this->db->where('cuid', $cuid);
		$this->db->set('password', $new_password);
		$this->db->update();
		if(!$this->db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		my_session_destroy();
		smsg(lang('100061'), _g('uri')->su('user/ac/login'), 1);
	}
	/* update cuser */
	function updateCUser($cuid, $data){
		$uRs = $this->find('cuid', $cuid);
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('cuser>300001'));
			return null;
		}
		
		/* cuser table */
		if(my_array_key_exist('cuser', $data)){
			/* check username */
			if(my_array_key_exist('username', $data['cuser'])){
				$this->db->from ( $this->t_cuser );
				$this->db->where ( 'cuid', $cuid, '!=' );
				$this->db->where ( 'username', $data['cuser']['username'] );
				$this->db->select ();
				$usernameRs = $this->db->get_one ();
				if(!$this->db->is_success($usernameRs)){
					smsg(lang('200013'));
					return null;
				}
				if (my_is_array( $usernameRs )) {
					smsg(lang('cuser:100023'));
					return null;
				}
			}
			
			/* execute */
			$this->db->from($this->t_cuser);
			$this->db->where('cuid', $cuid);
			$this->db->set($data['cuser']);
			$this->db->update();
			if(!$this->db->is_success()){
				smsg(lang('200013'));
				return null;
			}
		}
		
		/* profilr table */
		if(my_array_key_exist('profile', $data)){
			$pRs = $this->profile_find('cuid', $cuid);
			if(!$this->db->is_success($pRs)){
				smsg(lang('200013'));
				return null;
			}
			
			$this->db->from($this->t_cuser_profile);
			if(my_is_array($pRs)){
				$this->db->where('cuid', $cuid);
				$this->db->set($data['profile']);
				$this->db->update();
			}else{
				$this->db->set('cuid', $cuid);
				$this->db->set($data['profile']);
				$this->db->insert();
			}
			if(!$this->db->is_success()){
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		return true;
	}
	/* login */
	function login($loginData, $password){
		$findData = array ();
		$findData['a.' . $loginData[0]] = $loginData[1];
		$findData['a.status'] = _g('value')->sb(true);
		
		/* execute find */
		$uRs = $this->find_jion ( $findData );
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('cuser:' . my_array_value($loginData[0], array('username'=>100013, 'email'=>100022))));
			return null;
		}
		if(!_g('validate')->v2eq($uRs['password'], my_md5($password, 2), true)){
			smsg(lang('cuser:100014'));
			return null;
		}
	
		$uRs['login_type'] = 2;
		my_session('suser', $uRs);
	
		$toUrl = _g('uri')->su('user');
		smsg(lang('cuser:100015'), $toUrl, 1);
	}
}
?>