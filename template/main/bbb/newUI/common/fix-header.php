<link rel="stylesheet" type="text/css" href="<?php prt(sfullurl(_g('template')->dir('@'))); ?>/css/ooo.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(sfullurl(_g('template')->dir('@'))); ?>/css/style.css" />
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