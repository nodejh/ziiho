<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_captcha {
	function __construct() {
	}
	function geshai_captcha() {
		$this->__construct ();
	}
	function create() {
		$font = sdir ( ':static' ) . '/font/ArialRoundedMTBold.ttf';
		if (! is_file ( $font )) {
			return NULL;
		}
		
		header ( "content-type:image/png" );
		
		$checkWord = '';
		
		$checkChar = 'ABCDEFKLPRSTUVXY234567890';
		
		for($num = 0; $num < 4; $num ++) {
			$char = rand ( 0, strlen ( $checkChar ) - 1 );
			$checkWord .= $checkChar [$char];
		}
		
		_g ( 'value' )->checkcode ( null, strtolower ( $checkWord ) );
		
		$image = imagecreate ( 80, 30 );
		
		$red = imagecolorallocate ( $image, 0xf3, 0x61, 0x61 );
		$blue = imagecolorallocate ( $image, 0x53, 0x68, 0xbd );
		$green = imagecolorallocate ( $image, 0x6b, 0xc1, 0x46 );
		
		$c1 = imagecolorallocate ( $image, 27, 32, 239 );
		$c2 = imagecolorallocate ( $image, 0, 0, 0 );
		$c3 = imagecolorallocate ( $image, 186, 118, 22 );
		$c4 = imagecolorallocate ( $image, 222, 27, 206 );
		$c5 = imagecolorallocate ( $image, 232, 12, 53 );
		$c6 = imagecolorallocate ( $image, 60, 47, 20 );
		$c7 = imagecolorallocate ( $image, 14, 131, 36 );
		$c8 = imagecolorallocate ( $image, 114, 121, 116 );
		
		$colors = array (
				$red,
				$blue,
				$green,
				$c1,
				$c2,
				$c3,
				$c4,
				$c5,
				$c6,
				$c7,
				$c8 
		);
		$colorsnum = (count ( $colors ) - 1);
		
		$bg1 = imagecolorallocate ( $image, 203, 254, 136 );
		$bg2 = imagecolorallocate ( $image, 242, 254, 176 );
		$bg3 = imagecolorallocate ( $image, 255, 255, 255 );
		$bg4 = imagecolorallocate ( $image, 191, 244, 254 );
		$bg5 = imagecolorallocate ( $image, 166, 255, 218 );
		$bg6 = imagecolorallocate ( $image, 176, 249, 169 );
		$bgs = array (
				$bg1,
				$bg2,
				$bg3,
				$bg4,
				$bg5,
				$bg6 
		);
		$bgsnum = (count ( $bgs ) - 1);
		
		imagefill ( $image, 0, 0, $bgs [rand ( 0, $bgsnum )] );
		
		imageline ( $image, rand ( 0, 30 ), rand ( 6, 21 ), rand ( 65, 40 ), rand ( 6, 21 ), $colors [rand ( 0, $colorsnum )] );
		
		for($i = 0; $i < 100; $i ++) {
			imagesetpixel ( $image, rand () % 90, rand () % 90, $colors [rand ( 0, $colorsnum )] );
		}
		
		for($num = 0; $num < 4; $num ++) {
			imagettftext ( $image, rand ( 18, 18 ), (rand ( 0, 20 ) + 330) % 360, 18 * $num + rand ( 0, 4 ), 18 + rand ( 0, 4 ), $colors [rand ( 0, $colorsnum )], $font, $checkWord [$num] );
		}
		
		imagepng ( $image );
		imagedestroy ( $image );
	}
}
?>