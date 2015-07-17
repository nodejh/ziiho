<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_set', 'common', true );
class class_article_set_admin extends class_common_set {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_set_admin() {
		$this->__construct ();
	}
	
	/* 上传图片设置 */
	function picture_upload_set($dir, $extension, $size, $quality, $allow_width, $allow_height, $thumb_width, $thumb_height) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		/* 设置类型 */
		$_m = _M ();
		$_t = article_value_get ( 'set_field', 'picture_upload', 'field' );
		
		/* 检查目录是否合法 */
		$dir_len = str_len ( $dir );
		for($i = 0; $i < $dir_len; $i ++) {
			if (str_in_array ( sub_str ( $dir, $i, 1 ), check_dirname_str () ) < 1) {
				showmsg ( lang ( 'global:setting_dir_fail' ), NULL, $callFunc );
			}
		}
		if (check_nums ( $dir_len ) >= 1) {
			list ( , $arr_num ) = explode_str ( $dir, '//', true );
			if ($arr_num > 1) {
				showmsg ( lang ( 'global:setting_dir_fail' ), NULL, $callFunc );
			}
		}
		
		/* 上传图片大小 */
		if (check_num ( $size ) < 1) {
			$size = 4;
		}
		/* 缩略图质量 */
		if (check_num ( $quality ) < 1 || $quality > 100) {
			$quality = 80;
		}
		/* 上传图片尺寸 */
		if (check_num ( $allow_width ) < 1) {
			$allow_width = 640;
		}
		if (check_num ( $allow_height ) < 1) {
			$allow_height = 480;
		}
		/* 缩略图尺寸 */
		if (check_num ( $thumb_width ) < 1) {
			$thumb_width = 640;
		}
		if (check_num ( $thumb_height ) < 1) {
			$thumb_height = 480;
		}
		if (check_is_array ( $extension ) < 1) {
			$extension = '';
		} else {
			$extension = en_serialize ( $extension );
		}
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
		
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 图片水印设置 */
	function picture_water_set($iswater, $position, $allow_width, $allow_height, $x, $y, $fusenum, $quality, $type, $image, $ttf, $text, $fontsize, $fontcolor, $angle) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		/* 设置类型 */
		$_m = _M ();
		$_t = article_value_get ( 'set_field', 'picture_water', 'field' );
		
		if (check_num ( $position ) < 1) {
			$position = config_value_get ( 'imagewaterpostion', 9, 'val' );
		}
		if (check_num ( $allow_width ) < 1) {
			$allow_width = 480;
		}
		if (check_num ( $allow_height ) < 1) {
			$allow_width = 320;
		}
		if (check_num ( $x ) < 1) {
			$x = 0;
		}
		if (check_num ( $y ) < 1) {
			$y = 0;
		}
		if ((check_num ( $fusenum ) < 1) || ($fusenum > 100)) {
			$fusenum = 80;
		}
		if ((check_num ( $quality ) < 1) || ($quality > 100)) {
			$quality = 80;
		}
		if (str_in_array ( $type, config_value_field ( 'imgagewatertype', NULL, true ) ) < 1) {
			showmsg ( lang ( 'global:setting_water_type_fail' ), NULL, $callFunc );
		}
		if ($type != 'text') {
			/* 检查水印图片是否合法 */
			if (check_fn ( $image, $type ) < 1) {
				showmsg ( lang ( 'global:setting_water_image_fail' ), NULL, $callFunc );
			}
		} else {
			/* 检查文本类型参数 */
			if (check_fn ( $ttf, 'ttf' ) < 1) {
				showmsg ( lang ( 'global:setting_water_ttf_null' ), NULL, $callFunc );
			}
			$text = sub_str ( $text, 0, 200 );
			
			if (check_num ( $fontsize ) < 1) {
				$fontsize = 14;
			}
			if (check_color ( $fontcolor ) < 1) {
				$fontcolor = '#000000';
			}
			if (check_num ( $angle ) < 1) {
				$angle = 0;
			}
		}
		/* 字段初始 */
		$dataArr [] = array (
				$_m,
				$_t,
				'position',
				$position 
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
				'x',
				$x 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'y',
				$y 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'fusenum',
				$fusenum 
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
				'type',
				$type 
		);
		
		if ($type != 'text') {
			$dataArr [] = array (
					$_m,
					$_t,
					'image',
					$image 
			);
		} else {
			$dataArr [] = array (
					$_m,
					$_t,
					'ttf',
					$ttf 
			);
			$dataArr [] = array (
					$_m,
					$_t,
					'text',
					$text 
			);
			$dataArr [] = array (
					$_m,
					$_t,
					'fontsize',
					$fontsize 
			);
			$dataArr [] = array (
					$_m,
					$_t,
					'fontcolor',
					$fontcolor 
			);
			$dataArr [] = array (
					$_m,
					$_t,
					'angle',
					$angle 
			);
		}
		
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* seo保存 */
	function seo_set($index_title, $index_keywords, $index_description, $list_title, $list_keywords, $list_description, $content_title, $content_keywords, $content_description) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		/* 设置类型 */
		$_m = _M ();
		$_t = article_value_get ( 'set_field', 'seo', 'field' );
		
		/* 字段初始 */
		$dataArr [] = array (
				$_m,
				$_t,
				'index_title',
				$index_title 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'index_keywords',
				$index_keywords 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'index_description',
				$index_description 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'list_title',
				$list_title 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'list_keywords',
				$list_keywords 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'list_description',
				$list_description 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'content_title',
				$content_title 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'content_keywords',
				$content_keywords 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'content_description',
				$content_description 
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