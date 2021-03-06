<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/login.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img src="<?php prt(_g('template')->dir('job')); ?>/image/f/register-index-bg2.png" width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //c-area -->
<div class="c-area clearfix" id="c-area">
	<div class="shadow clearfix"></div>
    <div class="bl clearfix"></div>
    <!-- //m -->
    <div class="forget clearfix">
        <!-- //form-email -->
        <form method="post" id="form-email" onsubmit="return false;">
        
        <input type="hidden" name="uid" value="<?php prt($forgetUser['uid']); ?>" />
        <div class="f2 clearfix">
        	<div class="t1">新密码：</div>
            <div class="t2"><input type="password" class="inp" name="password" /></div>
        </div>
        <div class="f2 clearfix">
        	<div class="t1">确认密码：</div>
            <div class="t2"><input type="password" class="inp" name="password2" /></div>
        </div>
        <div class="f2 clearfix">
            <button type="button" class="btn" name="disabled-buttons" onclick="forgetUpdatePassword(this, '<?php prt(_g('uri')->su('user/ac/forget/op/email_pw_do')); ?>', '<?php prt(_g('uri')->su('user/ac/forget/op/email_pw_success')); ?>');">提&nbsp;交</button>
        </div>
        </form>
        <!-- form-email// -->
        
    </div>
    <!-- m// -->
</div>
<!-- c-area// -->

<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/user.js"></script>
<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#c-area");
	var _flagValue = 1;
	/* btn */
	var _navs = _mObj.find(".forget .f1 .tt a");
	_navs.click(function(e){
       if($(this).attr("flag") == _flagValue){
		   return false;
	   }
	   _navs.removeClass("on");
	   
	   var _os = $(this).parent().parent().find(".sp");
	   if($(this).attr("flag") == 2){
		   _os.removeClass("pp1");
		   _os.addClass("pp2");
		   $("#form-email").hide();
		   $("#form-tel").show();
	   }else{
		   _os.removeClass("pp2");
		   _os.addClass("pp1");
		   $("#form-email").show();
		   $("#form-tel").hide();
	   }
	   _flagValue = $(this).attr("flag");
	   $(this).addClass("on");
    });
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>