<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_image {
	public $dst_img;
	public $h_src;
	public $h_dst;
	public $img_display_quality = 90;
	public $src_w = 0;
	public $src_h = 0;
	public $dst_w = 0;
	public $dst_h = 0;
	public $fill_w;
	public $fill_h;
	public $copy_w;
	public $copy_h;
	public $src_x = 0;
	public $src_y = 0;
	public $start_x;
	public $start_y;
	public $img_type;
	public $all_type = array (
			'jpg' => array (
					'output' => 'imagejpeg' 
			),
			'gif' => array (
					'output' => 'imagegif' 
			),
			'png' => array (
					'output' => 'imagepng' 
			),
			'bmp' => array (
					'output' => 'imagebmp' 
			),
			'wbmp' => array (
					'output' => 'image2wbmp' 
			),
			'jpeg' => array (
					'output' => 'imagejpeg' 
			) 
	);
	public function getimage_w($src) {
		return imagesx ( $src );
	}
	public function getimage_h($src) {
		return imagesy ( $src );
	}
	public function srcimage($src_img, $img_type = null) {
		if (! is_file ( $src_img )) {
			echo '图片不存在';
			exit ();
		}
		$this->img_type = $this->_imagetype ( $src_img );
		$this->_check_image_type ( $this->img_type );
		
		$src = '';
		if (function_exists ( 'file_get_contents' )) {
			$src = file_get_contents ( $src_img );
		} else {
			$handle = fopen ( $src_img, "r" );
			while ( ! feof ( $handle ) ) {
				$src .= fgets ( $fd, 4096 );
			}
			fclose ( $handle );
		}
		$this->h_src = imagecreatefromstring ( $src );
		$this->src_w = $this->getimage_w ( $this->h_src );
		$this->src_h = $this->getimage_h ( $this->h_src );
	}
	public function dstimage($dst_img) {
		$this->dst_img = $dst_img;
	}
	public function createimage($w, $h = NULL) {
		$this->_newimgsize ( $w, $h );
		$this->_createimage ();
		$this->_output ();
		
		if (imagedestroy ( $this->h_src ) && imagedestroy ( $this->h_dst )) {
			return true;
		} else {
			return false;
		}
	}
	public function _createimage() {
		$this->h_dst = imagecreatetruecolor ( $this->dst_w, $this->dst_h );
		$white = imagecolorallocate ( $this->h_dst, 255, 255, 255 );
		imagefilledrectangle ( $this->h_dst, 0, 0, $this->dst_w, $this->dst_h, $white );
		imagecopyresampled ( $this->h_dst, $this->h_src, $this->start_x, $this->start_y, $this->src_x, $this->src_y, $this->fill_w, $this->fill_h, $this->copy_w, $this->copy_h );
	}
	public function _output() {
		$img_type = $this->img_type;
		$func_name = $this->all_type [$img_type] ['output'];
		if (function_exists ( $func_name )) {
			
			if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
				$ua = strtoupper ( $_SERVER ['HTTP_USER_AGENT'] );
				if (! preg_match ( '/^.*MSIE.*\)$/i', $ua )) {
					// header("Content-type:$img_type");
				}
			}
			$img_type_str = strtolower ( $this->img_type );
			if ($img_type_str == 'jpg' || $img_type_str == 'jpeg') {
				if (! preg_match ( "/^(1|[1-9][0-9]*)$/", $this->img_display_quality ) || $this->img_display_quality > 100) {
					$this->img_display_quality = 90;
				}
				$func_name ( $this->h_dst, $this->dst_img, $this->img_display_quality );
			} else {
				$func_name ( $this->h_dst, $this->dst_img );
			}
			return true;
		} else {
			return false;
		}
	}
	public function _newimgsize($img_w, $img_h = NULL) {
		$fill_w = ( int ) $img_w;
		$fill_h = ( int ) $img_h;
		$rate_w = $this->src_w / $fill_w;
		$rate_h = $this->src_h / $fill_h;
		
		if ($rate_w < 1 && $rate_h < 1) {
			$this->fill_w = ( int ) $this->src_w;
			$this->fill_h = ( int ) $this->src_h;
		} else {
			if ($rate_w >= $rate_h) {
				$this->fill_w = ( int ) $fill_w;
				$this->fill_h = round ( $this->src_h / $rate_w );
			} else {
				$this->fill_w = round ( $this->src_w / $rate_h );
				$this->fill_h = ( int ) $fill_h;
			}
		}
		$this->src_x = 0;
		$this->src_y = 0;
		$this->copy_w = $this->src_w;
		$this->copy_h = $this->src_h;
		
		$this->dst_w = $this->fill_w;
		$this->dst_h = $this->fill_h;
	}
	function _imagetype($file_path) {
		$type_list = array (
				'1' => 'gif',
				'2' => 'jpg',
				'3' => 'png',
				'4' => 'swf',
				'5' => 'psd',
				'6' => 'bmp',
				'15' => 'wbmp' 
		);
		$img_info = getimagesize ( $file_path );
		if (isset ( $type_list [$img_info [2]] )) {
			return $type_list [$img_info [2]];
		}
	}
	function _check_image_type($img_type) {
		if (! array_key_exists ( $img_type, $this->all_type )) {
			return false;
		}
	}
}
class geshai_imagetxtwater {
	public $image;
	public $des_img;
	public $img_create;
	public $img_info;
	public $img_width;
	public $img_height;
	public $img_im;
	public $img_text;
	public $img_ttf;
	public $img_text_size;
	public $img_jd;
	public $img_postion_type;
	public $img_txt_color;
	public $ox;
	public $oy;
	public $display_quality = 90;
	function geshai_imagetxtwater($img = '', $des_img = '', $ttf = '', $txt = '', $size = '', $position = '', $color = '', $jiaodu = 0, $display_quality = 90, $ox = 0, $oy = 0) {
		if (! is_file ( $img )) {
			return NULL;
		}
		if (! is_file ( $ttf )) {
			return NULL;
		}
		$this->image = $img;
		$this->des_img = $des_img;
		$this->img_ttf = $ttf;
		$this->img_text = $txt;
		$this->img_text_size = $size;
		$this->img_jd = $jiaodu;
		$this->img_postion_type = $position;
		$this->img_txt_color = $color;
		$this->ox = $ox;
		$this->oy = $oy;
		$this->display_quality = $display_quality;
		$this->imgyesno ();
	}
	function imgyesno() {
		$this->img_info = getimagesize ( $this->image );
		
		$this->img_width = $this->img_info [0];
		
		$this->img_height = $this->img_info [1];
		
		switch ($this->img_info [2]) {
			case 1 :
				$funext = 'gif';
				break;
			case 2 :
				$funext = 'jpeg';
				break;
			case 3 :
				$funext = 'png';
				break;
		}
		$funext = 'imagecreatefrom' . $funext;
		$this->img_im = imagecreatetruecolor ( $this->img_width, $this->img_height );
		$this->img_create = $funext ( $this->image );
		
		$this->img_text ();
	}
	function img_text() {
		imagealphablending ( $this->img_im, true );
		$txt_height = $this->img_text_size;
		$txt_jiaodu = $this->img_jd;
		$ttf_im = imagettfbbox ( $txt_height, $txt_jiaodu, $this->img_ttf, $this->img_text );
		$w = $ttf_im [2] - $ttf_im [6];
		$h = $ttf_im [3] - $ttf_im [7];
		unset ( $ttf_im );
		
		$_pos = $this->txt_position ( $w, $h );
		
		$color_rgb = hexcolor_rgb ( $this->img_txt_color );
		
		$this->img_txt_color = imagecolorallocate ( $this->img_im, $color_rgb ['r'], $color_rgb ['g'], $color_rgb ['b'] );
		imagecopyresampled ( $this->img_im, $this->img_create, 0, 0, 0, 0, $this->img_width, $this->img_height, $this->img_width, $this->img_height );
		
		imagettftext ( $this->img_im, $txt_height, $txt_jiaodu, $_pos [0], $_pos [1], $this->img_txt_color, $this->img_ttf, $this->img_text );
		unset ( $_pos );
		if (! preg_match ( "/^(1|[1-9][0-9]*)$/", $this->display_quality ) || $this->display_quality > 100) {
			$this->display_quality = 90;
		}
		
		$_g_result = NULL;
		switch ($this->img_info [2]) {
			case 1 :
				$_g_result = imagegif ( $this->img_im, $this->des_img );
				break;
			case 2 :
				$_g_result = imagejpeg ( $this->img_im, $this->des_img, $this->display_quality );
				break;
			case 3 :
				$_g_result = imagepng ( $this->img_im, $this->des_img );
				break;
		}
		$this->img_nothing ();
	}
	function txt_position($width, $height) {
		switch ($this->img_postion_type) {
			case 1 :
				$txt_x = 0 + ($this->ox);
				$txt_y = ($this->img_height - ($this->img_height - $height)) + ($this->oy);
				break;
			case 2 :
				$txt_x = (($this->img_width - $width) / 2) + ($this->ox);
				$txt_y = ($this->img_height - ($this->img_height - $height)) + ($this->oy);
				break;
			case 3 :
				$txt_x = ($this->img_width - $width) + ($this->ox);
				$txt_y = ($this->img_height - ($this->img_height - $height)) + ($this->oy);
				break;
			case 4 :
				$txt_x = 0 + ($this->ox);
				$txt_y = (($this->img_height - $height) / 2) + ($this->oy);
				break;
			case 5 :
				$txt_x = (($this->img_width - $width) / 2) + ($this->ox);
				$txt_y = (($this->img_height - $height) / 2) + ($this->oy);
				break;
			case 6 :
				$txt_x = ($this->img_width - $width) + ($this->ox);
				$txt_y = (($this->img_height - $height) / 2) + ($this->oy);
				break;
			case 7 :
				$txt_x = 0 + ($this->ox);
				$txt_y = ($this->img_height - $height) + ($this->oy);
				break;
			case 8 :
				$txt_x = (($this->img_width - $width) / 2) + ($this->ox);
				$txt_y = ($this->img_height - $height) + ($this->oy);
				break;
			case 9 :
				$txt_x = ($this->img_width - $width) + ($this->ox);
				$txt_y = ($this->img_height - $height) + ($this->oy);
				break;
			default :
				$txt_x = (rand ( 0, $this->img_width - $width )) + ($this->ox);
				$txt_y = (rand ( 0, $this->img_height - $height )) + ($this->oy);
				break;
		}
		return array (
				$txt_x,
				$txt_y 
		);
	}
	function img_nothing() {
		unset ( $this->img_info );
		imagedestroy ( $this->img_im );
		imagedestroy ( $this->img_create );
	}
}
class geshai_imagecutwater {
	public $imgsrc;
	public $types;
	public $imgtype;
	public $water_imgtype;
	public $water_image;
	public $image;
	public $width;
	public $height;
	public $value1;
	public $value2;
	public $des_img;
	public $ox;
	public $oy;
	public $merge_quality = 90;
	public $display_quality = 90;
	function __construct($src_img, $des_img, $types, $value1 = '', $value2 = '', $display_quality = 90, $merge_quality = 90, $ox = 0, $oy = 0) {
		$this->imgsrc = $src_img;
		$this->types = $types;
		$this->image = $this->imagesources ( $src_img );
		$this->width = $this->imagesizex ();
		$this->height = $this->imagesizey ();
		$this->value1 = $value1;
		$this->value2 = $value2;
		$this->des_img = $des_img;
		$this->ox = $ox;
		$this->oy = $oy;
		$this->display_quality = $display_quality;
		$this->merge_quality = $merge_quality;
		self::outimage ();
	}
	function outimage() {
		switch ($this->types) {
			case 1 :
				$this->imagewater ();
				break;
			case 2 :
				$this->clipping ();
				break;
		}
	}
	function imagewater() {
		$imagearrs = $this->getimagearr ( $this->value1 );
		
		$_pos = $this->_position ( $this->value2, $imagearrs [0], $imagearrs [1] );
		
		/*
		 * $this->water_imgagesources($this->value1); $this->water_image=imagerotate($this->water_image,100,-1);
		 */
		
		if (! preg_match ( "/^(1|[1-9][0-9]*)$/", $this->display_quality ) || $this->display_quality > 100) {
			imagecopy ( $this->image, $this->imagesources ( $this->value1 ), $_pos [0], $_pos [1], 0, 0, $imagearrs [0], $imagearrs [1] );
		} else {
			imagecopymerge ( $this->image, $this->imagesources ( $this->value1 ), $_pos [0], $_pos [1], 0, 0, $imagearrs [0], $imagearrs [1], $this->merge_quality );
		}
		
		$this->output ( $this->image );
	}
	function clipping() {
		list ( $src_x, $src_y ) = $this->value1;
		list ( $dst_w, $dst_h ) = $this->value2;
		
		if ($dst_w < 1) {
			$dst_w = $this->width;
		}
		if ($dst_h < 1) {
			$dst_h = $this->height;
		}
		
		if ($this->width < $src_x + $dst_w || $this->height < $src_y + $dst_h) {
			return NULL;
		}
		
		$newimg = imagecreatetruecolor ( $dst_w, $dst_h );
		
		imagecopyresampled ( $newimg, $this->image, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $dst_w, $dst_h );
		$this->output ( $newimg );
	}
	function imagesources($imgad) {
		$imagearray = $this->getimagearr ( $imgad );
		$this->imgtype = $imagearray [2];
		$img = NULL;
		switch ($imagearray [2]) {
			case 1 :
				$img = imagecreatefromgif ( $imgad );
				break;
			case 2 :
				$img = imagecreatefromjpeg ( $imgad );
				break;
			case 3 :
				$img = imagecreatefrompng ( $imgad );
				break;
		}
		return $img;
	}
	function water_imgagesources($imgad) {
		$imagearray = $this->getimagearr ( $imgad );
		$this->water_imgtype = $imagearray [2];
		switch ($imagearray [2]) {
			case 1 :
				$this->water_image = imagecreatefromgif ( $imgad );
				break;
			case 2 :
				$this->water_image = imagecreatefromjpeg ( $imgad );
				break;
			case 3 :
				$this->water_image = imagecreatefrompng ( $imgad );
				break;
		}
	}
	function imagesizex() {
		return imagesx ( $this->image );
	}
	function imagesizey() {
		return imagesy ( $this->image );
	}
	function output($image) {
		if (! preg_match ( "/^(1|[1-9][0-9]*)$/", $this->display_quality ) || $this->display_quality > 100) {
			$this->display_quality = 90;
		}
		$rtn = NULL;
		switch ($this->imgtype) {
			case 1 :
				$rtn = imagegif ( $image, $this->des_img );
				break;
			case 2 :
				$rtn = imagejpeg ( $image, $this->des_img, $this->display_quality );
				break;
			case 3 :
				$rtn = imagepng ( $image, $this->des_img );
				break;
		}
		return $rtn;
	}
	function getimagearr($imagesou) {
		return getimagesize ( $imagesou );
	}
	function _position($num, $width, $height) {
		switch ($num) {
			case 1 :
				$img_x = 0 + ($this->ox);
				$img_y = 0 + ($this->oy);
				break;
			case 2 :
				$img_x = (($this->width - $width) / 2) + ($this->ox);
				$img_y = 0 + ($this->oy);
				break;
			case 3 :
				$img_x = ($this->width - $width) + ($this->ox);
				$img_y = 0 + ($this->oy);
				break;
			case 4 :
				$img_x = 0 + ($this->ox);
				$img_y = (($this->height - $height) / 2) + ($this->oy);
				break;
			case 5 :
				$img_x = (($this->width - $width) / 2) + ($this->ox);
				$img_y = (($this->height - $height) / 2) + ($this->oy);
				break;
			case 6 :
				$img_x = ($this->width - $width) + ($this->ox);
				$img_y = (($this->height - $height) / 2) + ($this->oy);
				break;
			case 7 :
				$img_x = 0 + ($this->ox);
				$img_y = ($this->height - $height) + ($this->oy);
				break;
			case 8 :
				$img_x = (($this->width - $width) / 2) + ($this->ox);
				$img_y = ($this->height - $height) + ($this->oy);
				break;
			case 9 :
				$img_x = ($this->width - $width) + ($this->ox);
				$img_y = ($this->height - $height) + ($this->oy);
				break;
			default :
				$img_x = (rand ( 0, $this->width - $width )) + ($this->ox);
				$img_y = (rand ( 0, $this->height - $height )) + ($this->oy);
				break;
		}
		return array (
				$img_x,
				$img_y 
		);
	}
	function __destruct() {
		if (is_resource ( $this->image )) {
			imagedestroy ( $this->image );
		}
		if ($this->types == 1 && is_resource ( $this->water_image )) {
			imagedestroy ( $this->water_image );
		}
	}
}
?>