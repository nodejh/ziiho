<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/register.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img src="<?php prt(_g('template')->dir('job')); ?>/image/f/register-index-bg2.png" width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //register-nav -->
<div class="register-nav">
	<div class="f1 clearfix">
        <div class="sp pp1">▲</div>
        <div class="tn"></div>
        <div class="tt"><a href="javascript:;" flag="1" class="on">邮箱注册</a></div>
        <div class="tt"><a href="javascript:;" flag="2">手机注册</a></div>
    </div>
</div>
<div class="clear"></div>
<!-- register-nav// -->

<!-- //register-iarea -->
<div class="register-iarea clearfix" id="register_index">
	<!-- //steps -->
	<div class="step step-2 clearfix">
    	<div class="acc a1 clearfix"><strong>第一步：填写注册信息</strong></div>
        <div class="acc a2 clearfix"><strong>第二步：进入邮箱验证</strong></div>
        <div class="acc a3 clearfix">第三步：注册成功</div>
    </div>
	<!-- steps// -->
    
    <!-- //rc-area -->
    <div class="rc-area clearfix">
    	<form id="form-emailAuthSend" method="post" onsubmit="return false;"></form>
    	<div class="tt1">系统已经向您的邮箱发送了一封邮件,请立即查收！请在24小时内验证激活账户。</div>
        <div class="btn1"><a href="<?php prt($targetMailUrl); ?>" target="_blank">去邮箱激活</a></div>
        <div class="tt2">接收邮箱：<?php prt($UModel->suser('username')); ?></div>
        <div class="tt3">如果没有收到邮件<a href="javascript:;" onclick="emailAuthSend('<?php prt(_g('uri')->su('user/ac/register/op/email_auth_send')); ?>');">重新发送邮件</a></div>
    </div>
    <!-- rc-area// -->
</div>
<!-- register-iarea// -->

<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/user.js"></script>
<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#register_index");
		_mObj.height(_ss.h - 66);
	
	/* select */
	var _selectValue = "";
	var _selectObjItems = _mObj.find(".box .n .c");
	_selectObjItems.click(function(e){
		var _index = _selectObjItems.index(this);
        if($(this).find(".icon-checkbox").attr("flag") != "true"){
			_selectValue = parseInt($(this).find(".icon-checkbox").attr("data"));
			_selectObjItems.not(":eq(" + _index + ")").find(".icon-checkbox").removeClass("icon-checkboxed").attr("flag", "");
			$(this).find(".icon-checkbox").addClass("icon-checkboxed").attr("flag", "true");
		}
    });
	/* btn */
	_mObj.find(".box .btn").click(function(e){
        if(_selectValue < 1){
			alert("对不起，请先选择注册类型！");
			return false;
		}
		if(_selectValue == 1){
			alert("页面制作中...");
			return false;
		}else{
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('job/ac/register/op/email2')); ?>"});
		}
    });
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>