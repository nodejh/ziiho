<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提示信息</title>
<style type="text/css">
body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, dl, dt, dd, ul, ol, li,
	pre, form, fieldset, legend, button, input, textarea, th, td {
	margin: 0;
	padding: 0;
	color: #262626;
}

body, button, input, select, textarea {
	font: 12px/1.5 tahoma, arial, \333\333;
}

h1, h2, h3, h4, h5, h6 {
	font-size: 100%;
}

address, cite, dfn, em, var {
	font-style: normal;
}

code, kbd, pre, samp {
	font-family: courier new, courier, monospace;
}

small {
	font-size: 12px;
}

ul, ol {
	list-style: none;
}

a {
	color: #0060BF;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
	color: #FF6C26;
}

sup {
	vertical-align: text-top;
}

sub {
	vertical-align: text-bottom;
}

legend {
	color: #000;
}

fieldset, img {
	border: 0;
}

button, input, select, textarea {
	font-size: 100%;
}

table {
	border-collapse: collapse;
	border-spacing: 0;
}

.clr {
	clear: both;
	height: 0;
	overflow: hidden;
}

body {
	font: 12px/1.5;
	font-family: verdana, arial, sans-serif;
	-webkit-text-size-adjust: none;
	background: #fff;
	word-wrap: break-word;
	word-break: break-all;
}

* {
	word-wrap: break-word;
	word-break: break-all;
}

.fs14px {
	font-size: 14px;
}

.msg_main {
	width: 100%;
	margin-top: 150px;
}

.msg_box {
	width: 530px;
	margin: auto;
	border: 1px solid #318ace;
	background: #F9F9F9;
}

.msg_label {
	width: 520px;
	margin: auto;
	padding: 5px;
	color: #FFFFFF;
	background: #318ace;
}

.msg_show {
	width: 500px;
	margin: auto;
	padding: 15px;
	text-align: center;
}

.msg_href {
	width: 500px;
	margin: auto;
	padding: 15px;
	text-align: center;
}

.msg_space {
	width: 100%;
	padding-top: 20px;
}
</style>
</head>

<body>
	<div class="msg_main">
		<div class="msg_box">
			<div class="msg_label fs14px">
				<strong>提示信息</strong>
			</div>
			<div class="clr"></div>
			<div class="msg_show fs14px"><?php echo array_key_val('data',$msg_arr); ?></div>
			<div class="clr"></div>
        <?php if(check_is_key('url',$msg_arr)==1){ ?>
        <div class="msg_href alc">
				<a href="<?php echo array_key_val('url',$msg_arr); ?>"
					<?php if(check_is_key('urlTarget',$msg_arr)==1){ ?>
					target="<?php echo array_key_val('urlTarget',$msg_arr); ?>"
					<?php } ?>>如果需要返回，请点击此链接跳转</a>
			</div>
			<div class="clr"></div>
        <?php } ?>
        <div class="msg_space"></div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
</body>
</html>