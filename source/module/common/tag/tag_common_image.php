<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( '_hook_tag_common_image' )) {
	function _hook_tag_common_image($module, $tagfunc, $matchs, $old_content = NULL) {
		/* 默认值 */
		$defaultVal = array (
				'return' => 'img' 
		);
		/* 标签参数 */
		$tagAttr = array (
				'src' => '',
				'type' => 0,
				'width' => 0,
				'height' => 0,
				'defaultsrc' => '',
				'defaultshow' => 'yes',
				'return' => $defaultVal ['return'] 
		);
		/* 设置参数 */
		foreach ( $matchs as $val ) {
			$val [1] = trim ( $val [1] );
			$val [2] = trim ( $val [2] );
			$k = strtolower ( $val [1] );
			if (check_is_key ( $k, $tagAttr ) == 1) {
				$tagAttr [$k] = $val [2];
				continue;
			}
			$tagAttr [$val [1]] = $val [2];
		}
		unset ( $matchs );
		/* 变量符号 */
		$s = '$';
		/* 返回参数名 */
		$return = $tagAttr ['return'];
		if (check_enl_el ( $return ) < 1) {
			$return = $defaultVal ['return'];
		}
		/* 清除不需要的值 */
		unset ( $defaultVal, $tagAttr ['function'], $tagAttr ['return'] );
		/* ----------------------------------------------- */
		$_unTagContent = "<?php " . $s . $return . " = tag_common_image(" . arraytostr ( $tagAttr ) . "); ?>";
		return $_unTagContent;
	}
	/* 标签生成会员缩略图解析 */
	function tag_common_image($data) {
		/* 缩略图方式 */
		$typearr = array (
				yesno_val ( 'normal' ),
				yesno_val ( 'check' ) 
		);
		/* 默认尺寸 */
		$sizearr = array (
				0,
				0 
		);
		/* 显示默认图 */
		$isdefualtarr = array (
				yesno_val ( 'normal', 'val2' ),
				yesno_val ( 'check', 'val2' ) 
		);
		/* 默认返回值 */
		$arr = NULL;
		/* 生成缩略图方式 */
		if (str_in_array ( $data ['type'], $typearr ) < 1) {
			$data ['type'] = $typearr [0];
		}
		/* 检查尺寸 */
		if (check_num ( $data ['width'] ) < 1) {
			$data ['width'] = $sizearr [0];
		}
		if (check_num ( $data ['height'] ) < 1) {
			$data ['height'] = $sizearr [1];
		}
		unset ( $sizearr );
		/* 如果原图不存在,是否显示默认图 */
		if (str_in_array ( $data ['defaultshow'], $isdefualtarr ) < 1) {
			$data ['defaultshow'] = $isdefualtarr [0];
		}
		if ($data ['defaultshow'] == $isdefualtarr [0]) {
			if (str_len ( $data ['defaultsrc'] ) < 1) {
				$data ['defaultsrc'] = current_url ( 'static/image/nopic.jpg' );
			}
		}
		/* 原图为空,则返回 */
		if (str_len ( $data ['src'] ) < 1) {
			/* 是否显示默认图 */
			if ($data ['defaultshow'] == $isdefualtarr [0]) {
				$arr = array (
						'filename' => $data ['defaultsrc'],
						'width' => $data ['width'],
						'height' => $data ['height'] 
				);
			}
			return $arr;
		}
		/* 原图地址 */
		$imgsrc = show_uf ( $data ['src'], true );
		/* 原图信息 */
		$attr = image_size ( $imgsrc );
		
		/* 原图不存在,则返回 */
		if (check_is_file ( $imgsrc ) < 1) {
			if ($data ['defaultshow'] == $isdefualtarr [0]) {
				$arr = array (
						'filename' => $data ['defaultsrc'],
						'width' => $data ['width'],
						'height' => $data ['height'] 
				);
			}
			return $arr;
		}
		/* 如果宽高同时为0时,则忽略生成 */
		if ($data ['width'] < 1 && $data ['height'] < 1) {
			$arr = array (
					'filename' => show_uf ( $data ['src'] ),
					'width' => $attr [0],
					'height' => $attr [1] 
			);
			return $arr;
		}
		/* 如果宽高等于指定宽高,则返回原图 */
		if ($data ['width'] == $attr [0] && $data ['height'] == $attr [1]) {
			$arr = array (
					'filename' => show_uf ( $data ['src'] ),
					'width' => $attr [0],
					'height' => $attr [1] 
			);
			return $arr;
		}
		
		/* 如果为按比例,则计算尺寸 */
		if ($data ['type'] != $typearr [1]) {
			/* 计算缩略图尺寸 */
			list ( $newwidth, $newheight ) = imagenewseize ( $imgsrc, $data ['width'], $data ['height'] );
		} else {
			/* 如果宽为0时,则为原图宽 */
			$newwidth = ($data ['width'] < 1) ? $attr [0] : $data ['width'];
			/* 如果高为0时,则为原图高 */
			$newheight = ($data ['height'] < 1) ? $attr [1] : $data ['height'];
		}
		/* 缩略图名称 */
		$newname = tagimagecreatename ( $data ['src'], $newwidth, $newheight, $data ['type'] );
		/* 缩略图地址 */
		$imgname = show_uf ( $newname, true );
		/* 如果缩略图存在,则返回 */
		if (check_is_file ( $imgname ) == 1) {
			$arr = array (
					'filename' => show_uf ( $newname ),
					'width' => $newwidth,
					'height' => $newheight 
			);
			return $arr;
		}
		
		/* 将生成的图名 */
		$newname = tagimagecreatename ( $data ['src'], $newwidth, $newheight, $data ['type'] );
		/* 将生成的图 */
		$newimg = show_uf ( $newname, true );
		/* 生成方式 */
		if ($data ['type'] != $typearr [1]) {
			imagethumb ( $imgsrc, $newimg, $newwidth, $newheight );
		} else {
			imagecut ( $imgsrc, $newimg, '0,0', ($newwidth . ',' . $newheight) );
		}
		/* 检查是否存在 */
		if (check_is_file ( $newimg ) == 1) {
			/* 获取图信息 */
			$attr = image_size ( $newimg );
			$arr = array (
					'filename' => show_uf ( $newname ),
					'width' => $attr [0],
					'height' => $attr [1] 
			);
		}
		return $arr;
	}
}
?>