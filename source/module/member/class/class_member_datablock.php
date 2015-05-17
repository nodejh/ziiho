<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_datablock', 'common', true );
class class_member_datablock extends class_common_datablock {
	public $table_member = 'member';
	public $table_member_head = 'member_head';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_datablock() {
		$this->__construct ();
	}
	
	/* 数据调用 */
	function member_datablock($datacall, $datastyle) {
		/* 状态 */
		$status = member_status_val ( 'normal' );
		/* 调用id */
		$dcid = array_key_val ( 'dcid', $datacall );
		/* 时间调用 */
		$did = array_key_val ( 'did', $datacall, 0 );
		
		/* 头像调用 */
		$avatarparam = array (
				'action' => imageaction_val ( 'avatar' ),
				'src' => '',
				'type' => 1,
				'width' => array_key_val ( 'avatarwidth', $datacall ),
				'height' => array_key_val ( 'avatarheight', $datacall ) 
		);
		
		/* 排序 */
		$orderby = order_val ( array_key_val ( 'ordertype', $datacall ) );
		/* 标题截取长度 */
		$usernamelen = array_key_val ( 'usernamelen', $datacall, 0 );
		/* 简介截取长度 */
		$informlen = array_key_val ( 'informlen', $datacall, 0 );
		/* 是否随机 */
		$not = yesno_val ( 'check' );
		$isrand = array_key_val ( 'isrand', $datacall, $not );
		/* 起始行 */
		$startnum = array_key_val ( 'startnum', $datacall, 0 );
		/* 显示条数 */
		$offsetnum = array_key_val ( 'offsetnum', $datacall, 10 );
		
		/**
		 * *******************************
		 */
		/* 会员资料 */
		$profile = $this->_loader->model ( 'class:class_member_profile', 'member', false );
		/* 索引号 */
		$indenx = 0;
		/* 记录数据id */
		$uid_arr = NULL;
		/* 会员空间地址 */
		$spaceurl = modelurl ( 251 );
		/**
		 * *******************************
		 */
		
		/* 获取数据 */
		$this->db->from ( $this->table_member );
		$this->db->where ( 'status', $status );
		$result_num = $this->db->count_num ();
		/* 是随机显示 */
		if ($isrand != $not) {
			$this->db->rand_limit ( $offsetnum );
		} else {
			$this->db->limit ( $startnum, $offsetnum );
			$this->db->order_by ( 'register_time', $orderby );
		}
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			lang ( 'dbexception', true );
			return NULL;
		}
		if (check_nums ( $result_num ) == 1) {
			$result = $this->db->get_list ();
			while ( $val = $this->db->fetch_array ( $result ) ) {
				/* 索引号 */
				$indenx ++;
				/* 记录数据id */
				$uid_arr .= ($uid_arr != NULL) ? (',' . $val ['uid']) : $val ['uid'];
				
				/* 数据所在行 */
				$val ['rownum'] = $indenx;
				/* 会员名 */
				$val ['username'] = sub_str ( $val ['username'], 0, $usernamelen );
				/* 昵称 */
				$val ['nickname'] = sub_str ( $val ['nickname'], 0, $usernamelen );
				/* 注册时间 */
				$val ['register_time'] = datecall_format ( $did, $val ['register_time'] );
				/* 上次登录时间 */
				$val ['before_time'] = datecall_format ( $did, $val ['before_time'] );
				/* 最后登录时间 */
				$val ['last_time'] = datecall_format ( $did, $val ['last_time'] );
				/* 会员空间链接 */
				$val ['spaceurl'] = modelurl ( $spaceurl, array (
						'uid' => $val ['uid'] 
				) );
				
				/* 获取资料 */
				$mp = $profile->profile_base_query ( 'uid', $val ['uid'] );
				/* 性别 */
				$val ['gender'] = gender_val ( array_key_val ( 'gender', $mp ), 'v_name' );
				/* 生日 */
				$val ['birthday'] = array_key_val ( 'birthday', $mp );
				/* 家乡 */
				$val ['hometown'] = member_de_area ( array_key_val ( 'hometown', $mp ), '-' );
				/* 居住地 */
				$val ['address'] = member_de_area ( array_key_val ( 'address', $mp ), '-' );
				/* 签名 */
				$val ['inform'] = sub_str ( array_key_val ( 'inform', $mp ), 0, $informlen );
				unset ( $mp );
				
				/* 粉丝 */
				$val ['fansnum'] = member_fans_count ( $val ['uid'] );
				/* 关注 */
				$val ['follownum'] = member_follow_count ( $val ['uid'] );
				
				/* 初始化会员头像值 */
				$avatarparam ['src'] = $val ['uid'];
				$avatararr = tagavatarcreate ( $avatarparam );
				$val ['avatar'] = array_key_val ( 'filename', $avatararr );
				$val ['avatarwidth'] = array_key_val ( 'width', $avatararr );
				$val ['avatarheight'] = array_key_val ( 'height', $avatararr );
				unset ( $avatararr );
				
				/* 初始化值 */
				common_datablock_db ( $datacall ['dcid'], $val, $datastyle ['content'], $indenx );
				/* 清理值 */
				unset ( $val );
			}
		}
		return $content = NULL;
	}
}
?>