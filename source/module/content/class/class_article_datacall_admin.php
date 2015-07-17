<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_datacall_admin extends class_common_datacall {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_datacall_admin() {
		$this->__construct ();
	}
	
	/* 添加 */
	function add($catid, $did, $avatarwidth, $avatarheight, $isthumb, $thumbtype, $thumbdefaultshow, $thumbdefaultsrc, $thumbwidth, $thumbheight, $ordertype, $isrand, $startnum, $offsetnum, $titlelen, $descriptionlen) {
		
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_c = msg_func ( 'msg_call_c' );
		$msg_call_param = msg_callback_param ();
		
		/* 分类 */
		if (check_num ( $catid ) < 1) {
			$catid = 0;
		}
		/* 时间调用 */
		if (check_num ( $did ) < 1) {
			$did = 0;
		}
		
		/* 会员头像尺寸宽 */
		if (check_num ( $avatarwidth ) < 1) {
			$avatarwidth = 0;
		}
		/* 会员头像尺寸高 */
		if (check_num ( $avatarheight ) < 1) {
			$avatarheight = 0;
		}
		
		/* 是否显示缩略图 */
		if (check_num ( $isthumb ) < 1) {
			$isthumb = 0;
		}
		/* 缩略图方式 */
		if (check_num ( $thumbtype ) < 1) {
			$thumbtype = 0;
		}
		/* 缩略图宽 */
		if (check_num ( $thumbwidth ) < 1) {
			$thumbwidth = 0;
		}
		/* 缩略图高 */
		if (check_num ( $thumbheight ) < 1) {
			$thumbheight = 0;
		}
		/* 是否显示默认图 */
		if (check_is_en ( $thumbdefaultshow ) < 1) {
			$thumbdefaultshow = yesno_val ( 'normal', 'val2' );
		}
		
		/* 排序 */
		if (check_num ( $ordertype ) < 1) {
			$ordertype = 0;
		}
		/* 是否随机 */
		if (check_num ( $isrand ) < 1) {
			$isrand = yesno_val ( 'normal' );
		}
		/* 起始行 */
		if (check_num ( $startnum ) < 1) {
			$startnum = 0;
		}
		/* 显示条数 */
		if (check_num ( $offsetnum ) < 1) {
			$offsetnum = 10;
		}
		
		/* 初始化参数 */
		$data = array (
				'catid' => $catid,
				'did' => $did,
				'avatarwidth' => $avatarwidth,
				'avatarheight' => $avatarheight,
				'isthumb' => $isthumb,
				'thumbtype' => $thumbtype,
				'thumbwidth' => $thumbwidth,
				'thumbheight' => $thumbheight,
				'thumbdefaultshow' => $thumbdefaultshow,
				'thumbdefaultsrc' => $thumbdefaultsrc,
				'ordertype' => $ordertype,
				'isrand' => $isrand,
				'startnum' => $startnum,
				'offsetnum' => $offsetnum,
				'titlelen' => $titlelen,
				'descriptionlen' => $descriptionlen 
		);
		/* 如果为随机 */
		if ($isrand != yesno_val ( 'check' )) {
			unset ( $data ['startnum'] );
		}
		$this->datacall_add ( _M (), $data, $msg_call, $msg_call_url, $msg_call_c, array (
				'dourl' => modelurl ( 214 ) 
		) );
		return NULL;
	}
	/* 编辑 */
	function edit($catid, $did, $avatarwidth, $avatarheight, $isthumb, $thumbtype, $thumbdefaultshow, $thumbdefaultsrc, $thumbwidth, $thumbheight, $ordertype, $isrand, $startnum, $offsetnum, $titlelen, $descriptionlen) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		/* 分类 */
		if (check_num ( $catid ) < 1) {
			$catid = 0;
		}
		/* 时间调用 */
		if (check_num ( $did ) < 1) {
			$did = 0;
		}
		
		/* 会员头像尺寸宽 */
		if (check_num ( $avatarwidth ) < 1) {
			$avatarwidth = 0;
		}
		/* 会员头像尺寸高 */
		if (check_num ( $avatarheight ) < 1) {
			$avatarheight = 0;
		}
		
		/* 是否显示缩略图 */
		if (check_num ( $isthumb ) < 1) {
			$isthumb = 0;
		}
		/* 缩略图方式 */
		if (check_num ( $thumbtype ) < 1) {
			$thumbtype = 0;
		}
		/* 缩略图宽 */
		if (check_num ( $thumbwidth ) < 1) {
			$thumbwidth = 0;
		}
		/* 缩略图高 */
		if (check_num ( $thumbheight ) < 1) {
			$thumbheight = 0;
		}
		/* 是否显示默认图 */
		if (check_is_en ( $thumbdefaultshow ) < 1) {
			$thumbdefaultshow = yesno_val ( 'normal', 'val2' );
		}
		
		/* 排序 */
		if (check_num ( $ordertype ) < 1) {
			$ordertype = 0;
		}
		/* 是否随机 */
		if (check_num ( $isrand ) < 1) {
			$isrand = yesno_val ( 'check' );
		}
		/* 起始行 */
		if (check_num ( $startnum ) < 1) {
			$startnum = 0;
		}
		/* 显示条数 */
		if (check_num ( $offsetnum ) < 1) {
			$offsetnum = 10;
		}
		
		/* 初始化参数 */
		$data = array (
				'catid' => $catid,
				'did' => $did,
				'avatarwidth' => $avatarwidth,
				'avatarheight' => $avatarheight,
				'isthumb' => $isthumb,
				'thumbtype' => $thumbtype,
				'thumbwidth' => $thumbwidth,
				'thumbheight' => $thumbheight,
				'thumbdefaultshow' => $thumbdefaultshow,
				'thumbdefaultsrc' => $thumbdefaultsrc,
				'ordertype' => $ordertype,
				'isrand' => $isrand,
				'startnum' => $startnum,
				'offsetnum' => $offsetnum,
				'titlelen' => $titlelen,
				'descriptionlen' => $descriptionlen 
		);
		/* 如果为随机 */
		if ($isrand != yesno_val ( 'check' )) {
			unset ( $data ['startnum'] );
		}
		$this->datacall_edit ( $data, $msg_call, $msg_call_url, $msg_call_b, $param = NULL );
		return NULL;
	}
}
?>