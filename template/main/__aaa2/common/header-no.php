<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php prt(_g('cfg>charset')); ?>" />
<title>网站首页 - <?php prt(_g('value')->geshai('powered')); ?></title>
<meta name="generator" content="cloud,jolly" />
<link rel="stylesheet" type="text/css" href="<?php prt(sfullurl(_g('template')->dir('@'))); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(sfullurl(_g('template')->dir('@'))); ?>/css/ooo.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(sfullurl(sdir('static'))); ?>/dialog/default/default.css" />

<script type="text/javascript" src="<?php prt(sfullurl(sdir('static'))); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php prt(sfullurl(sdir('static'))); ?>/js/geshai.common.min.js"></script>
<script type="text/javascript" src="<?php prt(sfullurl(sdir('static'))); ?>/js/jquery.cjslip-v1.0.3.min.js"></script>

<script type="text/javascript">
_GESHAI.setting("path", "<?php prt(sfullurl(sdir())); ?>");
_GESHAI.setting("fsubmitKey_get", "<?php prt(_g('cfg>fmkey>get')); ?>");
_GESHAI.setting("fsubmitKey_post", "<?php prt(_g('cfg>fmkey>post')); ?>");
_GESHAI.setting("fsubmitKey_ajax", "<?php prt(_g('cfg>fmkey>ajax')); ?>");
_GESHAI.setting("fsubmitKey_onlybody", "<?php prt(_g('cfg>fmkey>onlybody')); ?>");
</script>

<script type="text/javascript" src="<?php prt(sfullurl(_g('template')->dir('@'))); ?>/js/g.js"></script>

</head>

<body id="body">