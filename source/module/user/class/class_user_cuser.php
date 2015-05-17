<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user_cuser extends geshai_model {
	public $t_user_cuser = 'user_cuser';
	public $t_user_cuser_profile = 'user_cuser_profile';
	
	public $t_field = 'a.cuid,a.username,a.password,a.email,a.regtime,a.regip,a.lasttime,a.lastip,a.curtime,a.curip,a.status,a.online,a.cname,a.area,a.area_detail,a.contacts,a.telephone,a.mobilephone,a.cemail,b.csortid,b.cnatureid,b.csize,b.cdescription,b.authenticate,b.licence,b.recruitment,b.rtelephone,b.rmobilephone,b.remail,b.logo';
	
	function __construct() {
		parent::__construct ();
	}
	function class_user_cuser() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_user_cuser );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function profile_find($k = null, $v = null) {
		$this->db->from ( $this->t_user_cuser_profile );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function find_jion($k = null, $v = null){
		$this->db->join($this->t_user_cuser, 'a.cuid', $this->t_user_cuser_profile, 'b.cuid', 'LEFT JOIN');
		$this->db->where($k, $v);
		$this->db->select($this->t_field);
		return $this->db->get_one();
	}
	
	function csortCount($v){
		$this->db->from ( $this->t_user_cuser_profile );
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
		$this->db->from ( $this->t_user_cuser_profile );
		$this->db->order_by('cuid');
		$this->db->select ();
		if(!$this->db->is_success()){
			return null;
		}
		$rs = $this->db->get_one ();
		
		$data = $this->find_jion('a.cuid', $rs['cuid']);
		return $data;
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
	
	
	function getList(){
		$this->db->join($this->t_user_cuser, 'a.cuid', $this->t_user_cuser_profile, 'b.cuid', 'LEFT JOIN');
		$pageData = _g('page')->c($this->db->count(), 15, 10, _get('page'));
		$this->db->limit($pageData['start'], $pageData['size']);
		$this->db->order_by('a.cuid');
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
				$qrs = $this->find('username', $data['username']);
				if(!$this->db->is_success($qrs)){
					smsg(lang('200013'));
					return null;
				}
				if(is_array($qrs)){
					smsg(lang('user:cuser>100010', $data['username']));
					return null;
				}
				
				/* 插入数据 */
				$this->db->from($this->t_user_cuser);
				$this->db->set($data);
				$this->db->insert();
				if(!$this->db->is_success()){
					smsg(lang('200013'));
					return null;
				}
				$data['cuid'] = $this->db->insert_id();
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
				$this->db->from($this->t_user_cuser_profile);
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
	/* update */
	function update($cuid, $data1, $data2){
		/* 主表 */
		$this->db->from($this->t_user_cuser);
		$this->db->where('cuid', $cuid);
		$this->db->set($data1);
		$this->db->update();
		if(!$this->db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		/* 资料 */
		$profileRs = $this->profile_find('cuid', $cuid);
		if(!$this->db->is_success($profileRs)){
			smsg(lang('200013'));
			return null;
		}
		$this->db->from($this->t_user_cuser_profile);
		if(my_is_array($profileRs)){
			my_unset($data2, 'cuid');
			$this->db->where('cuid', $cuid);
			$this->db->set($data2);
			$this->db->update();
		}else{
			$this->db->set($data2);
			$this->db->insert();
		}
		if(!$this->db->is_success()){
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
	}
	
	/* login */
	function login($username, $password){
		$uRs = $this->find_jion(array('a.username'=>$username, 'a.status'=>_g('value')->sb(true)));
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('user:cuser>100013'));
			return null;
		}
		if(!_g('validate')->v2eq($uRs['password'], my_md5($password, 2), true)){
			smsg(lang('user:cuser>100014'));
			return null;
		}
		
		$uRs['login_type'] = 2;
		my_session('suser', $uRs);
		
		$toUrl = _g('uri')->su('user');
		smsg(lang('user:cuser>100015'), $toUrl, 1);
	}
	
	/* update password */
	function updatePassword($cuid, $password, $new_password){
		$uRs = $this->find('cuid', $cuid);
		if(!$this->db->is_success($uRs)){
			smsg(lang('200013'));
			return null;
		}
		if(!my_is_array($uRs)){
			smsg(lang('user:cuser>300001'));
			return null;
		}
		if(!_g('validate')->v2eq($uRs['password'], $password, true)){
			smsg(lang('user:cuser>300004'));
			return null;
		}
		
		$this->db->from($this->t_user_cuser);
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
			smsg(lang('user:cuser>300001'));
			return null;
		}
		
		/* cuser table */
		if(my_array_key_exist('cuser', $data)){
			$this->db->from($this->t_user_cuser);
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
			
			$this->db->from($this->t_user_cuser_profile);
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
}
?>