<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_admin extends geshai_model {
	public $t_admin = 'admin';
	public $data = array();
	
	/* 默认有效时间(单位:分钟) */
	public $minutes = 60000;
	public $uid = 0;
	public $isAdmin = false;
	
	function __construct() {
		parent::__construct ();
		$this->_isAdmin ();
	}
	function class_admin() {
		$this->__construct ();
	}
	function _isAdmin() {
		$this->uid = $this->get_uid ();
		$this->isAdmin = ($this->getIsAdmin ( $this->uid ) ? true : false);
	}
	function getIsAdmin($uid) {
		return (preg_match ( "/^1{1,1}$/", $uid ) ? true : false);
	}
	function get_uid() {
		$uid = _g ( 'value' )->user ( 'uid' );
		return (_g ( 'validate' )->pnum ( $uid ) ? intval ( $uid ) : null);
	}
	function isInvalidOpr($uid) {
		if (! $this->isAdmin) {
			return ($this->getIsAdmin ( $uid ) ? false : true);
		} else {
			return true;
		}
	}
	/* --- */
	function find($k, $v = null){
		$this->db->from($this->t_admin);
		$this->db->where($k, $v);
		$this->db->select();
		return $this->db->get_one();
	}
	function insert($data){
		$this->db->from($this->t_admin);
		$this->db->set($data);
		$this->db->insert();
		return $this->db->is_success();
	}
	function update($data, $k, $v = null){
		$this->db->from($this->t_admin);
		$this->db->where($k, $v);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from($this->t_admin);
		$this->db->where($k, $v);
		$this->db->delete();
		return $this->db->is_success();
	}
	function findAdmin($uid){
		$rs = $this->find('uid', $uid);
		if(!$this->db->is_success( $rs )){
			return false;
		}
		if(!my_is_array($rs)){
			return false;
		}
		$userGroupCla = _g ( 'module' )->trigger ( 'user', 'group');
		$usergroupRs = $userGroupCla->find('ugid', $rs['ugid']);
		if(!$this->db->is_success( $usergroupRs )){
			return false;
		}
		if(!my_is_array($usergroupRs)){
			return false;
		}
		$usergroupRs['mgr'] = str2array($usergroupRs['mgr']);
		return $usergroupRs;
	}
	/* 保留的,不需要验证操作权限 */
	function exceptFind($v) {
		$data = array (
				'login',
				'login,do',
				'login,out',
				'lockscreen',
				'lockscreen,en',
				'lockscreen,de',
				'main',
				'mcenter',
				'menu,load',
				'menu,pos'
		);
		return my_in_array ( $v, $data );
	}
	function setOnline($k, $v = null){
		$data = array( 'online' => _g( 'cfg>time' ) );
		return $this->update( $data, $k, $v );
	}
	function superGroupData(){
		$data = array(
				'gname' => '超级管理员',
				'ranksrc' => 'sm.png',
		);
		return $data;
	}
	function ranksrc(){
		$src = $this->getData('group>ranksrc');
		$v = null;
		if($this->isAdmin){
			$v = _g('module')->path(':', 'template/image/' . $src);
		} else {
			$v = uploadfile( $src );
		}
		return $v;
	}
	function getData($k = null){
		$data = _g('cp')->admin->data;
		return my_array_value($k, $data);
	}
	/* set */
	function setUser($uid, $ugid){
		if(!_g('validate')->pnum( $uid ) || !_g('validate')->num( $ugid )){
			return -1;
		}
		$rs = $this->find( 'uid', $uid );
		if(!$this->db->is_success( $rs )){
			return false;
		}
		
		$isSet = _g('validate')->pnum( $ugid );
		$isStatus = true;
		
		$data = array(
				'uid' => $uid,
				'ugid' => $ugid,
				'ctime' => _g('cfg>time')
		);
		
		if(my_is_array( $rs )){
			if( $isSet ){
				if($rs['ugid'] != $ugid){
					$isStatus = $this->update( $data, 'uid', $uid );
				}
			} else {
				$isStatus = $this->delete( 'uid', $uid );
			}
		} else {
			if($isSet){
				$isStatus = $this->insert( $data );
			}
		}
		return $isStatus;
	}
	/* check */
	function check() {
		$uid = $this->uid;
		if (! _g ( 'validate' )->pnum ( $uid )) {
			return false;
		}
	
		$menuCla = _g ( 'cp' )->menu;
		$userCla = _g ( 'module' )->trigger ( 'user');
	
		$adminRs = null;
		if (! $this->isAdmin) {
			$adminRs = $this->findAdmin( $uid );
			if(!my_is_array($adminRs)){
				return false;
			}
		}
	
		$userRs = $userCla->find ( 'uid', $uid );
		if (! $this->db->is_success ( $userRs )) {
			return false;
		}
		if (! my_is_array ( $userRs )) {
			return false;
		}
	
		$this->data['user'] = $userRs;
		if($this->isAdmin){
			$this->data['group'] = $this->superGroupData();
		} else {
			$this->data['group'] = $adminRs;
		}
	
		/* 有效会话时间 */
		$expire = _g ( 'value' )->v2second ( $this->minutes );
	
		/* 会话是否过期 */
		if (_g ( 'validate' )->expire ( $userRs ['online'], $expire )) {
			return false;
		}
		/* 获取检查值 */
		$__isAction = false;
		$__chkData = array ();
		$__chkDoKey = NULL;
		/* 模块 */
		if (_g ( 'validate' )->hasget ( 'mod' )) {
			$__chkData [] = _get ( 'mod' );
		}
		/* 动作 */
		if (_g ( 'validate' )->hasget ( 'ac' )) {
			$__chkData [] = _get ( 'ac' );
		}
		/* 指向 */
		if (_g ( 'validate' )->hasget ( 'op' )) {
			$__isAction = true;
			$__chkDoKey = _get ( 'op' );
		}
		$__chkData = trim ( my_join ( ',', $__chkData ) );
	
		/* 为空时 */
		if (strlen ( $__chkData ) < 1) {
			return $this->setOnline ( 'uid', $uid );
		}
	
		/* 排除已保留的 */
		if ($this->exceptFind ( $__isAction ? ($__chkData . ',' . $__chkDoKey) : $__chkData )) {
			return $this->setOnline ( 'uid', $uid );
		}
		$menuRs = $menuCla->find ( 'keys', $__chkData );
		if (! $this->isAdmin) {
			if (! my_is_array ( $menuRs )) {
				return false;
			}
			if (! my_in_array ( $menuRs ['menuid'], my_array_value( 'menuid', $adminRs['mgr'] ) )) {
				return false;
			}
			/* 允许的动作 */
			if ($__isAction) {
				if (! my_in_array ( $__chkDoKey, my_explode ( ',', $menuRs ['vals'] ) )) {
					return false;
				}
			}
		}
		$this->data['menu'] = $menuRs;
		return $this->setOnline ( 'uid', $uid );
	}
}
?>