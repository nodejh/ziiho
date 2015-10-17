<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_set', 'common', true );
class class_member_set_admin extends class_common_set {
	public $common_set = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_set_admin() {
		$this->__construct ();
	}
	
	/* 会员初始化 */
	function memberinit($member_groupid, $credit) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前模块 */
		$_m = _M ();
		/* 类型 */
		$_t = member_value_get ( 'set_field', 'memberinit', 'field' );
		
		$creditArr = NULL;
		/* 已启用的积分字段 */
		$creditFieldArr = common_creditfield ( NULL );
		if (is_array ( $creditFieldArr )) {
			if (is_array ( $credit )) {
				foreach ( $credit as $cV ) {
					$cVal = array_key_val ( 0, $cV );
					$cKey = array_key_val ( 1, $cV, 0 );
					if (! array_key_exists ( $cVal, $creditFieldArr )) {
						continue;
					}
					$creditArr [$cVal] = $cKey;
				}
			}
		}
		
		/* 字段初始 */
		$dataArr [] = array (
				$_m,
				$_t,
				'groupid',
				$member_groupid 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'credit',
				en_serialize ( $creditArr ) 
		);
		
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 基本设置 */
	function baseset($allowlogin, $logincheckcode, $username_min, $username_max, $password_min, $password_max) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前模块 */
		$_m = _M ();
		/* 类型 */
		$_t = member_value_get ( 'set_field', 'baseset', 'field' );
		/* 字段初始 */
		$dataArr [] = array (
				$_m,
				$_t,
				'allowlogin',
				$allowlogin 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'logincheckcode',
				$logincheckcode 
		);
		
		$dataArr [] = array (
				$_m,
				$_t,
				'username_min',
				$username_min 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'username_max',
				$username_max 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'password_min',
				$password_min 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'password_max',
				$password_max 
		);
		
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 头像设置 */
	function avatarset($dir, $extension, $size, $quality, $allow_width, $allow_height, $thumb_width, $thumb_height, $crop_minwidth, $crop_minheight) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 检查目录是否合法 */
		$dir_len = str_len ( $dir );
		for($i = 0; $i < $dir_len; $i ++) {
			if (! in_array ( sub_str ( $dir, $i, 1 ), check_dirname_str () )) {
				showmsg ( lang ( 'member_adm:hu_dir_fail' ), NULL, $callFunc );
			}
		}
		if (check_nums ( $dir_len ) >= 1) {
			list ( , $arr_num ) = explode_str ( $dir, '//', true );
			if ($arr_num > 1) {
				showmsg ( lang ( 'member_adm:hu_dir_fail' ), NULL, $callFunc );
			}
		}
		
		/* 上传图片大小 */
		if (check_num ( $size ) < 1) {
			showmsg ( lang ( 'member_adm:hu_size_fail' ), NULL, $callFunc );
		}
		/* 缩略图质量 */
		if (check_num ( $quality ) < 1 || $quality > 100) {
			showmsg ( lang ( 'member_adm:hu_quality_fail' ), NULL, $callFunc );
		}
		/* 上传图片尺寸 */
		if (check_num ( $allow_width ) < 1) {
			showmsg ( lang ( 'member_adm:hu_allow_width_fail' ), NULL, $callFunc );
		}
		if (check_num ( $allow_height ) < 1) {
			showmsg ( lang ( 'member_adm:hu_allow_height_fail' ), NULL, $callFunc );
		}
		/* 缩略图尺寸 */
		if (check_num ( $thumb_width ) < 1) {
			showmsg ( lang ( 'member_adm:hu_thumb_width_fail' ), NULL, $callFunc );
		}
		if (check_num ( $thumb_height ) < 1) {
			showmsg ( lang ( 'member_adm:hu_thumb_height_fail' ), NULL, $callFunc );
		}
		if (! is_array ( $extension )) {
			$extension = '';
		} else {
			$extension = en_serialize ( $extension );
		}
		/* 当前模块 */
		$_m = _M ();
		/* 类型 */
		$_t = member_value_get ( 'set_field', 'avatar_set', 'field' );
		/* 字段初始 */
		$dataArr [] = array (
				$_m,
				$_t,
				'dir',
				$dir 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'extension',
				$extension 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'size',
				$size 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'quality',
				$quality 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'allow_width',
				$allow_width 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'allow_height',
				$allow_height 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'thumb_width',
				$thumb_width 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'thumb_height',
				$thumb_height 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'crop_minwidth',
				$crop_minwidth 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'crop_minheight',
				$crop_minheight 
		);
		
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
}
?>