<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

list($width, $height) = getimagesize($srcName);
$viewPortW = $_POST["viewPortW"];
$viewPortH = $_POST["viewPortH"];
$pWidth = $_POST["imageW"];
$pHeight = $_POST["imageH"];
$ext = my_end(my_explode(".", $srcName));
$function = returnCorrectFunction($ext);
$image = $function($srcName);
$width = imagesx($image);
$height = imagesy($image);
/* Resample */
$image_p = imagecreatetruecolor($pWidth, $pHeight);
setTransparency($image, $image_p, $ext);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $pWidth, $pHeight, $width, $height);
imagedestroy($image);
$widthR = imagesx($image_p);
$hegihtR = imagesy($image_p);

$selectorX = $_POST["selectorX"];
$selectorY = $_POST["selectorY"];

if (_post('imageRotate'))
{
	$angle = 360 - _post('imageRotate');
	$image_p = imagerotate($image_p, $angle, 0);

	$pWidth = imagesx($image_p);
	$pHeight = imagesy($image_p);

	$diffW = abs($pWidth - $widthR) / 2;
	$diffH = abs($pHeight - $hegihtR) / 2;

	$_POST["imageX"] = ($pWidth > $widthR ? $_POST["imageX"] - $diffW: $_POST["imageX"] + $diffW);
	$_POST["imageY"] = ($pHeight > $hegihtR ? $_POST["imageY"] - $diffH: $_POST["imageY"] + $diffH);
}

$dst_x = $src_x = $dst_y = $src_y = 0;

if ($_POST["imageX"] > 0)
{
	$dst_x = abs($_POST["imageX"]);
} else {
	$src_x = abs($_POST["imageX"]);
}

if ($_POST["imageY"] > 0)
{
	$dst_y = abs($_POST["imageY"]);
} else {
	$src_y = abs($_POST["imageY"]);
}

$viewport = imagecreatetruecolor($_POST["viewPortW"], $_POST["viewPortH"]);
setTransparency($image_p, $viewport, $ext);

imagecopy($viewport, $image_p, $dst_x, $dst_y, $src_x, $src_y, $pWidth, $pHeight);
imagedestroy($image_p);

$selector = imagecreatetruecolor($_POST["selectorW"], $_POST["selectorH"]);
setTransparency($viewport, $selector, $ext);
imagecopy($selector, $viewport, 0, 0, $selectorX, $selectorY, $_POST["viewPortW"], $_POST["viewPortH"]);

$file = ($rootDir . '/' . $sfname);
parseImage($ext, $selector, $file);
imagedestroy($viewport);

imagethumb($file, $file, 200, 200);

/* Functions */
function determineImageScale($sourceWidth, $sourceHeight, $targetWidth, $targetHeight)
{
	$scalex = $targetWidth / $sourceWidth;
	$scaley = $targetHeight / $sourceHeight;
	return min($scalex, $scaley);
}

function returnCorrectFunction($ext)
{
	$function = "";
	switch ($ext)
	{
		case "png":
			$function = "imagecreatefrompng";
			break;
		case "jpeg":
			$function = "imagecreatefromjpeg";
			break;
		case "jpg":
			$function = "imagecreatefromjpeg";
			break;
		case "gif":
			$function = "imagecreatefromgif";
			break;
	}
	return $function;
}

function parseImage($ext, $img, $file = null)
{
	switch ($ext)
	{
		case "png":
			imagepng($img, ($file != null ? $file : ''));
			break;
		case "jpeg":
			imagejpeg($img, ($file ? $file : ''), 90);
			break;
		case "jpg":
			imagejpeg($img, ($file ? $file : ''), 90);
			break;
		case "gif":
			imagegif($img, ($file ? $file : ''));
			break;
	}
}

function setTransparency($imgSrc, $imgDest, $ext)
{
	if ($ext == "png" || $ext == "gif")
	{
		$trnprt_indx = imagecolortransparent($imgSrc);
		if ($trnprt_indx >= 0)
		{
			$trnprt_color = imagecolorsforindex($imgSrc, $trnprt_indx);
			$trnprt_indx = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
			imagefill($imgDest, 0, 0, $trnprt_indx);
			imagecolortransparent($imgDest, $trnprt_indx);
		} elseif ($ext == "png") {
			imagealphablending($imgDest, true);
			$color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
			imagefill($imgDest, 0, 0, $color);
			imagesavealpha($imgDest, true);
		}

	}
}
?>