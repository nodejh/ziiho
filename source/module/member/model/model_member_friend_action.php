<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_friend_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_friend_action() {
		$this->__construct ();
	}
	
	/* 找朋友 */
	function search() {
		loader ( 'assign:friend_search', _M () );
	}
	/* ---------------------关注的人---------------------- */
	/*添加关注的人*/
	function follow_add() {
		$this->mo ()->follow_add ( post_param ( 'follow_uid' ) );
	}
	/* 取消关注 */
	function follow_del() {
		$this->mo ()->follow_del ( post_param ( 'follow_uid' ) );
	}
	/* ---------------------粉丝---------------------- */
	/*移除粉丝*/
	function fans_del() {
		$this->mo ()->fans_del ( post_param ( 'friendid' ) );
	}
	/* ---------------------朋友---------------------- */
	/*朋友添加*/
	function firend_add() {
		$this->mo ()->firend_add ( post_param ( 'uid' ) );
	}
	/* 朋友删除 */
	function firend_del() {
		$this->mo ()->firend_del ( post_param ( 'friendid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_friend', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'ao', new self () );
	}
}
?>