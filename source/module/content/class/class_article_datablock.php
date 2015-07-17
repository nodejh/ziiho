<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_datablock extends class_common_datablock {
	public $table_article = 'article';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_datablock() {
		$this->__construct ();
	}
	
	/* 数据调用显示 */
	function article_datablock($datacall, $datastyle) {
		/* 状态 */
		$status = article_status ( 'normal' );
		/* 调用id */
		$dcid = array_key_val ( 'dcid', $datacall );
		/* 分类id */
		$catid = array_key_val ( 'catid', $datacall, 0 );
		/* 时间调用 */
		$did = array_key_val ( 'did', $datacall, 0 );
		/* 头像调用 */
		$hcid = array_key_val ( 'hcid', $datacall, 0 );
		/* 排序 */
		$orderby = order_val ( array_key_val ( 'ordertype', $datacall ) );
		/* 标题截取长度 */
		$titlelen = array_key_val ( 'titlelen', $datacall, 0 );
		/* 简介截取长度 */
		$descriptionlen = array_key_val ( 'descriptionlen', $datacall, 0 );
		/* 是否随机 */
		$not = yesno_val ( 'check' );
		$isrand = array_key_val ( 'isrand', $datacall, $not );
		/* 起始行 */
		$startnum = array_key_val ( 'startnum', $datacall, 0 );
		/* 显示条数 */
		$offsetnum = array_key_val ( 'offsetnum', $datacall, 10 );
		
		/* 是否显示缩略图 */
		$default_isthumb = yesno_val ( 'check' );
		$isthumb = array_key_val ( 'isthumb', $datacall, $default_isthumb );
		if ($isthumb != $default_isthumb) {
			$thumbparam = array (
					'src' => '',
					'width' => array_key_val ( 'thumbwidth', $datacall ),
					'height' => array_key_val ( 'thumbheight', $datacall ),
					'type' => array_key_val ( 'thumbtype', $datacall ),
					'defaultshow' => array_key_val ( 'thumbdefaultshow', $datacall ),
					'defaultsrc' => array_key_val ( 'thumbdefaultsrc', $datacall ) 
			);
		}
		/* 会员头像 */
		$avatarparam = array (
				'action' => imageaction_val ( 'avatar' ),
				'src' => '',
				'type' => 1,
				'width' => array_key_val ( 'avatarwidth', $datacall ),
				'height' => array_key_val ( 'avatarheight', $datacall ) 
		);
		/**
		 * *******************************
		 */
		/* 图标 */
		$ai = $this->_loader->model ( 'class:class_article_icon', 'article', false );
		/* 会员头像 */
		$mh = $this->_loader->model ( 'class:class_member_head', 'member', false );
		/* 索引号 */
		$indenx = 0;
		/* 记录数据id */
		$aid_arr = NULL;
		/* 文章链接地址 */
		$articleurl = modelurl ( 66 );
		/* 会员空间地址 */
		$spaceurl = modelurl ( 251 );
		/**
		 * *******************************
		 */
		
		/* 获取数据 */
		$this->db->from ( $this->table_article );
		if (check_nums ( $catid ) == 1) {
			$this->db->where ( 'cat_id', $catid );
		}
		$this->db->where ( 'status', $status );
		$result_num = $this->db->count_num ();
		/* 是随机显示 */
		if ($isrand != $not) {
			$this->db->rand_limit ( $offsetnum );
		} else {
			$this->db->limit ( $startnum, $offsetnum );
			$this->db->order_by ( 'ctime', $orderby );
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
				$aid_arr .= ($aid_arr != NULL) ? (',' . $val ['aid']) : $val ['aid'];
				
				/* 数据所在行 */
				$val ['rownum'] = $indenx;
				/* 链接 */
				$val ['url'] = modelurl ( $articleurl, array (
						'id' => $val ['aid'] 
				) );
				/* 标题 */
				$val ['title'] = sub_str ( $val ['title'], 0, $titlelen );
				/* 简介 */
				$val ['description'] = sub_str ( $val ['description'], 0, $descriptionlen );
				/* 时间 */
				$val ['ctime'] = datecall_format ( $did, $val ['ctime'] );
				/* 查询图标 */
				$iconrs = NULL;
				if (check_nums ( $val ['iconid'] ) == 1) {
					$iconrs = $ai->icon_query ( 'iconid', $val ['iconid'] );
					/* 图标标识名 */
					$val ['iconident'] = array_key_val ( 'iconident', $iconrs );
					/* 图标 */
					$val ['icon'] = show_uf ( array_key_val ( 'filename', $iconrs ) );
				}
				/* 获取会员信息 */
				$member = member_query ( $val ['uid'] );
				/* 会员名 */
				$val ['username'] = $member ['username'];
				/* 昵称 */
				$val ['nickname'] = $member ['nickname'];
				unset ( $member );
				/* 会员空间链接 */
				$val ['spaceurl'] = modelurl ( $spaceurl, array (
						'uid' => $val ['uid'] 
				) );
				
				/* 获取会员头像 */
				$headrs = $mh->head_query ( 'uid', $val ['uid'] );
				/* 初始化会员头像值 */
				$avatarparam ['src'] = array_key_val ( 'file_name', $headrs );
				$avatararr = tagimagecreate ( $avatarparam );
				unset ( $headrs );
				$val ['avatar'] = array_key_val ( 'filename', $avatararr );
				$val ['avatarwidth'] = array_key_val ( 'width', $avatararr );
				$val ['avatarheight'] = array_key_val ( 'height', $avatararr );
				unset ( $avatararr );
				
				/* 缩略图处理 */
				if ($isthumb != $default_isthumb) {
					$thumbparam ['src'] = $val ['imgsrc'];
					$thumbarr = tagimagecreate ( $thumbparam );
					$val ['thumb'] = array_key_val ( 'filename', $thumbarr );
					$val ['thumbwidth'] = array_key_val ( 'width', $thumbarr );
					$val ['thumbheight'] = array_key_val ( 'height', $thumbarr );
					unset ( $thumbarr );
				}
				
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