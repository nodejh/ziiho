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
        <div class="sp pp2">▲</div>
        <div class="tn"></div>
        <div class="tt"><a href="<?php prt(_g('uri')->su('job/ac/register/op/email')); ?>" flag="1" class="on">邮箱注册</a></div>
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
        <div class="acc a2 clearfix"><strong>第二步：输入手机验证码</strong></div>
        <div class="acc a3 clearfix">第三步：注册成功</div>
    </div>
	<!-- steps// -->
    
    <!-- //rc-area -->
    <div class="rc-area clearfix">
    	<div class="tt4">网站已经向您的手机发送了验证码短信,请查看您的手机！请您在24小时内验证激活账户，否则注册信息将不被保留。</div>
        <div class="tt5 clearfix">
        	<div class="z a1"><strong>手机号码：</strong></div>
            <div class="z a2">15237527732</div>
            <!--<div class="z a3"><input type="text" class="itext" /></div>-->
            <div class="z a4"><a href="javascript:;">修改号码</a></div>
        </div>
        
        <div class="tt6 clearfix">
        	<div class="z a1"><strong>验证码：</strong></div>
            <div class="z a2"><input type="text" class="itext" /></div>
            <div class="z a3">请输入6位数验证码</div>
        </div>
        
        <div class="tt7 clearfix">
            <button type="button" class="sbtn" onclick="_GESHAI.redirect({'url': '<?php prt(_g('uri')->su('job/ac/register/op/tel3')); ?>'});">提交验证码</button>
        </div>
        
        <div class="tt8 clearfix">
        	<p class="t">验证遇到问题？</p>
            <p class="t">1.为什么要进行手机验证？</p>
            <p class="t">答:如您完成手机验证，今后在您密码遗忘时，可更方便的找回密码；网上登录及电话预订时也会更加便捷。</p>
            <p class="t">2.如果多次长时间没有收到手机验证码怎么办？</p>
            <p class="t">答:请您尝试重新发送，如您愿意，也可改为邮箱注册。</p>
            <p class="t">3.验证过的手机今后是否可以修改？</p>
            <p class="t">答:会员可使用手机号码注册成为用户，用户名自动生成将不能进行修改，但是会员可登录携程网站修改绑定手机，不影响客人预订和查询。</p>
        </div>
        
    </div>
    <!-- rc-area// -->
    
</div>
<!-- register-iarea// -->

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