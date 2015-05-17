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
	<div class="step step-3 clearfix">
    	<div class="acc a1 clearfix"><strong>第一步：填写注册信息</strong></div>
        <div class="acc a2 clearfix"><strong>第二步：完善公司信息</strong></div>
        <div class="acc a3 clearfix"><strong>第三步：注册成功</strong></div>
    </div>
	<!-- steps// -->
    
    <!-- //register-iarea-success -->
    <div class="z succ clearfix">
    	<div class="icon"><img src="<?php prt(_g('template')->dir('job')); ?>/image/success.png" width="68" /></div>
        <div class="st">恭喜您，注册成功。</div>
        <div class="ss clearfix">
        	<p class="sc">您的网站账号：<em class="lf">E24747604</em></p>
            <p class="sc">请记住您的卡号，便于您电话预订时使用。</p>
            <p class="sc">您的邮箱为：<em class="lf">hr@huawei.com</em></p>
            <p class="sc">您可以使用此邮箱/网站账号直接登录本网站，随时随地享受我们竭诚为您提供的各项优质服务。</p>
        </div>
    </div>
    <!-- register-iarea-success// -->
    
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
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('job/ac/register/op/company')); ?>"});
		}
    });
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>