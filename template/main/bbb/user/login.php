<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/login_register.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
        <img src="<?php prt(_g('template')->dir('job')); ?>/image/f/index-header-bg3.jpg" width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //c-area -->
<div class="c-area clearfix" id="c-area">
    <!-- //m -->
    <div class="m clearfix">
        <div class="f1 clearfix">
        	<div class="sp pp1">▲</div>
        	<div class="tt"><a href="javascript:;" flag="1">个人登陆</a></div>
            <div class="tt"><a href="javascript:;" flag="2">企业登陆</a></div>
        </div>
        <form method="post" id="form-login" onsubmit="return false;">
        <input type="hidden" name="flag" value="1" />

        <div class="f2 clearfix">
        	<div class="t1">用户名：</div>
            <div class="t2"><input type="text" class="inp" name="username" /></div>
        </div>
        <div class="f2 clearfix">
        	<div class="t1">密码：</div>
            <div class="t2"><input type="password" class="inp" name="password" /></div>
        </div>
        <div class="f3 clearfix">
        	<div class="z t1"><button type="button" class="btn" name="disabled-buttons" onclick="userLogin(this, '<?php prt(_g('uri')->su('user/ac/login/op/ordinary')); ?>', '<?php prt(_g('uri')->su('user/ac/login/op/company')); ?>');">登&nbsp;陆</button></div>
            <div class="z t2"><a href="<?php prt(_g('uri')->su('user/ac/register')); ?>">注册</a><em>|</em><a href="<?php prt(_g('uri')->su('user/ac/forget')); ?>">忘记密码</a></div>
        </div>
        </form>
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
	_mObj.find(".m .f1 .tt a").click(function(e){
       if($(this).attr("flag") == _flagValue){
		   return false;
	   }
	   var _os = $(this).parent().parent().find(".sp");
	   if($(this).attr("flag") == 2){
		   _os.removeClass("pp1");
		   _os.addClass("pp2");
	   }else{
		   _os.removeClass("pp2");
		   _os.addClass("pp1");
	   }
	   _flagValue = $(this).attr("flag");
	   document.getElementById("form-login").flag.value = _flagValue;
	   document.getElementById("form-login").username.value = "";
	   document.getElementById("form-login").password.value = "";
    });
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>