<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php prt(_g('cfg>charset'));?>" />
<title>提示信息 - <?php prt(_g('value')->geshai('powered')); ?></title>
<style type="text/css">
html, body, div, span, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, code, del, dfn, em, img, q,	dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption,	tbody, tfoot, thead, tr, th, td { margin: 0; padding: 0; border: 0; font-weight: inherit; font-style: inherit; font-size: 100%; font-family: inherit; vertical-align: baseline; }
table { border-collapse: collapse; border-spacing: 0; }
p { word-wrap: break-word; }
em, i { font-style: normal; }
li { list-style: none; }
img { border: 0; vertical-align: middle; }
h1, h2, h3, h4, h5, h6 { font-family: "microsoft yahei", "SimHei"; font-weight: normal; }
.clearfix:before, .clearfix:after { content: ""; display: table; }
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }
.clear { height: 0; clear: both; overflow: hidden; }
body { color: #333; font: 14px/26px "microsoft yahei", "SimHei", "SimSun"; -webkit-text-size-adjust: 100%; }
a { text-decoration: none; color: #333; }
a:hover { color: #F00; text-decoration: none; }
.c { color: #0263ad; }

/* message */
.message { width: 500px; margin: auto; margin-top: 120px; background: #fff; border: 1px solid #0263ad; letter-spacing: 1px; }
	.message .tit { height: 40px; line-height: 40px; padding-left: 16px; background: #0263ad; color: #fff; font-size: 16px; }
	.message .text { padding: 10px 10px 10px 16px; text-indent: 28px; font-size: 14px; }
	.message .gb { width: 100%; padding: 10px 0px; text-align: center; font-size: 12px; }
		.message .gb a { color: #0263ad; }
		.message .gb a:hover { color: #F00; text-decoration: underline; }
</style>
</head>
<body>

<?php
/*
 * 状态 -1. 失败, 1. 成功, 非 -1 或 1, 表示其他...
 */
if (! is_array ( $param )) {
	$param = array (
			'status' => $param 
	);
} else {
	$param ['status'] = my_array_value ( 'status', $param );
}
$param ['status'] = (_g ( 'validate' )->em ( $param ['status'] ) ? - 1 : $param ['status']);

/* form 提交方式 */
$sb_is_post = _g ( 'validate' )->fmflag ();

/* 跳转的url */
if (strlen ( trim ( $redirectUrl ) ) < 1) {
	if ($sb_is_post != 'post') {
		$redirectUrl = _get ( 'fsubmit_goback' );
	} else {
		$redirectUrl = _post ( 'fsubmit_goback' );
	}
}
?>

<?php if($sb_is_post != 'post'){ ?>
    <div class="clearfix message">
		<div class="tit">
			<strong>提示信息</strong>
		</div>
		<div class="text"><?php prt($message); ?></div>
		<div class="gb">
			<a href="<?php prt($redirectUrl); ?>" target="<?php prt(my_array_value('target', $param)); ?>">如果需要返回，请点击此链接跳转</a>
		</div>

	</div>
<?php
} else {
	/* 设置参数 */
	$param ['complete'] = 'ok';
	$param ['data'] = '';
	$param ['url'] = $redirectUrl;
	?>
	<textarea><?php prt(htmlspecialchars($message));?></textarea>

	<script language="javascript">
		window.onload = function(){
			var _value = <?php prt(array2json($param));?>;
				_value.data = document.getElementsByTagName("textarea").item(0).value;
			var _callback = window.parent._GESHAI.cur("fsubmit")[window.self.name].success;
			if(window.parent._GESHAI.is_function(_callback)){
				_callback(_value);
			}
		}
	</script>
<?php } ?>

</body>
</html>