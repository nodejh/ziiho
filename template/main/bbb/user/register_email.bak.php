<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/register.css" />
    <link rel="stylesheet" type="text/css"
          href="<?php prt(_g('template')->dir('job')); ?>/css/login.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img src="<?php prt(_g('template')->dir('job')); ?>/image/f/login-bg.jpg" width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //register-nav -->
<!--<div class="register-nav">-->
<!--	<div class="f1 clearfix">-->
<!--        <div class="sp pp1">▲</div>-->
<!--        <div class="tn"></div>-->
<!--        <div class="tt"><a href="javascript:;" flag="1" class="on">邮箱注册</a></div>-->
<!--        <div class="tt"><a href="javascript:;" flag="2">手机注册</a></div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="clear"></div>-->
<!-- register-nav// -->

<!-- //register-iarea -->
<div class="register-iarea clearfix" id="register_index">
	<!-- //steps -->
<!--	<div class="step step-1 clearfix">-->
<!--    	<div class="acc a1 clearfix"><strong>第一步：填写注册信息</strong></div>-->
<!--        <div class="acc a2 clearfix">第二步：进入邮箱验证</div>-->
<!--        <div class="acc a3 clearfix">第三步：注册成功</div>-->
<!--    </div>-->
	<!-- steps// -->
    
    <!-- //ib -->
<!--    <form method="post" onsubmit="return false;">-->
<!--    <div class="z ib clearfix">-->
<!--        <div class="ibs clearfix">-->
<!--            <div class="nl clearfix">注册邮箱</div>-->
<!--            <div class="clear"></div>-->
<!--            <div class="inp-area clearfix"><input type="text" class="itext" name="email" value="" /></div>-->
<!--        </div>-->
<!--        -->
<!--        <div class="ibs clearfix">-->
<!--            <div class="nl clearfix">密码</div>-->
<!--            <div class="clear"></div>-->
<!--            <div class="inp-area clearfix"><input type="password" class="itext" name="password" id="password" value="" /></div>-->
<!--            <div class="pws clearfix">-->
<!--            	<div class="ss"><p class="tf">弱</p><p class="ts ts-c0"></p></div>-->
<!--                <div class="ss"><p class="tf">中</p><p class="ts ts-c0"></p></div>-->
<!--                <div class="ss"><p class="tf">强</p><p class="ts ts-c0"></p></div>-->
<!--            </div>-->
<!--        </div>-->
<!--        -->
<!--        <div class="ibs clearfix">-->
<!--            <div class="nl clearfix">确认密码</div>-->
<!--            <div class="clear"></div>-->
<!--            <div class="inp-area clearfix"><input type="password" class="itext" name="password2" value="" /></div>-->
<!--        </div>-->
<!--        -->
<!--        <div class="ibs clearfix">-->
<!--            <div class="nl clearfix">验证码</div>-->
<!--            <div class="clear"></div>-->
<!--            <div class="is-area clearfix"><input type="text" class="itext" name="checkcode" value="" /></div>-->
<!--            <div class="ccode clearfix">-->
<!--                <span id="captcha-box"></span><a href="javascript:;" id="captcha-click"></a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="clear"></div>-->
<!--        -->
<!--        <div class="ibs clearfix">-->
            <div class="ibtn clearfix"><button type="button" class="reg" name="disabled-buttons" onclick="register_email(this, '<?php prt(_g('uri')->su('user/ac/register/op/email_do')); ?>');">同意服务条款并注册</button></div>
        </div>

    </div>
    </form>
    <!-- ib// -->
    
    <!-- //iser -->
<!--    <div class="y iser clearfix">-->
<!--    	<div class="shadow clearfix"></div>-->
<!--        <div class="t clearfix">-->
<!--        	<div class="tit"><<诺一网站服务条款>></div>-->
<!--            <p>1、服务条款的确认和接纳</p>-->
<!--            <p>诺一网站由上海携程商务有限公司运营，涉及具体产品服务的将由有资质的服务商提供。用户通过完成注册程序并点击一下“递交”的按钮，这表示用户明确知晓以上事实，并与上海携程商务有限公司达成协议并接受所有的服务条款。</p>-->
<!--            <p>2、服务简介</p>-->
<!--            <p>诺一网站运用自己的操作系统通过国际互联网络为用户提供网络会员服务。用户必须： ⑴提供设备，包括个人电脑一台、调制解调器一个及配备上网装置。 ⑵个人上网和支付与此服务有关的电话费用。 考虑到携程网络会员服务的重要性，用户同意： ⑴提供及时、详尽及准确的个人资料。 ⑵不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。 另外，用户可授权上海携程商务有限公司向第三方透露其基本资料，但上海携程商务有限公司不能公开用户的补充资料。除非： ⑴用户要求世纪游网站或授权某人通过电子邮件服务透露这些信息。 ⑵相应的法律要求及程序要求上海携程商务有限公司提供用户的个人资料。 如果用户提供的资料不准确，上海携程商务有限公司保留结束用户使用携程网络会员服务的权利。 用户在享用携程网络会员服务的同时，同意接受携程网络会员服务提供的各类信息服务。</p>-->
<!--            <p>3、服务条款的修改</p>-->
<!--            <p>上海携程商务有限公司会在必要时修改服务条款，携程网络会员服务条款一旦发生变动，公司将会在用户进入下一步使用前的页面提示修改内容。如果你同意改动，则按“我同意”按钮。如果你不接受，则及时取消你的用户使用服务资格。 用户要继续使用携程网络会员服务需要两方面的确认： ⑴首先确认携程网络会员服务条款及其</p>-->
<!--		</div>-->
<!--    </div>-->
    <!-- iser// -->
</div>
<!-- register-iarea// -->




    <!-- //c-area -->
    <div class="c-area clearfix" id="register_index">
        <!-- //m -->
        <div class="m clearfix">
            <div class="f1 clearfix">
                <div class="sp pp1 color-grey">▲</div>
                <div class="tt"><a href="javascript:;" flag="1">个人注册</a></div>
                <div class="tt"><a href="javascript:;" flag="2">企业注册</a></div>
            </div>
            <form method="post" id="form-register" onsubmit="return false;">
<!--                <input type="hidden" name="flag" value="1" />-->

                <div class="f2 clearfix">
                    <div class="t1">邮箱：</div>
                    <div class="t2"><input type="text" class="inp" name="email" placeholder="请输入您的邮箱"/></div>
                </div>
                <div class="f2 clearfix">
                    <div class="t1">密码：</div>
                    <div class="t2"><input type="password" class="inp" name="password" id="password" placeholder="请设置您的密码"/></div>
                    <div class="pws clearfix">
                        <div class="ss"><p class="tf">弱</p><p class="ts ts-c0"></p></div>
                        <div class="ss"><p class="tf">中</p><p class="ts ts-c0"></p></div>
                        <div class="ss"><p class="tf">强</p><p class="ts ts-c0"></p></div>
                    </div>
                </div>

                <div class="f2 clearfix">
                    <div class="t1">确认密码：</div>
                    <div class="t2"><input type="password" class="inp" name="password2" placeholder="请再次输入密码" /></div>
                </div>

                <div class="ibs clearfix">
                    <div class="nl clearfix">验证码</div>
                    <div class="clear"></div>
                    <div class="is-area clearfix"><input type="text" class="itext" name="checkcode" value="" /></div>
                    <div class="ccode clearfix">
                        <span id="captcha-box"></span><a href="javascript:;" id="captcha-click"></a>
                    </div>
                </div>
                <div class="clear"></div>

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
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('job/ac/register/op/register_auth')); ?>"});
		}
    });
	
	/* captcha */
	_GESHAI.captcha({ captcha: "captcha-box", click: "captcha-click" });
	
	/* password status */
	//var _levers = $("#register_index .ib .ibs .pws .ss .ts");
    var _levers = $("#register_index #form-register .pws .ss .ts");
	var _styles = ["ts-c0", "ts-c1", "ts-c2", "ts-c3"];
	_GESHAI.password_status({
			"length": 6,
			"input": "password",
			"callback": function(_level){
				switch(_level){
					case 1:
					_levers.eq(0).addClass(_styles[1]).removeClass(_styles[0]);
					_levers.eq(1).addClass(_styles[0]).removeClass(_styles[2]);
					_levers.eq(2).addClass(_styles[0]).removeClass(_styles[3]);
					break;
					case 2:
					_levers.eq(0).addClass(_styles[1]).removeClass(_styles[0]);
					_levers.eq(1).addClass(_styles[2]).removeClass(_styles[0]);
					_levers.eq(2).addClass(_styles[0]).removeClass(_styles[3]);
					break;
					case 3:
					_levers.eq(0).addClass(_styles[1]).removeClass(_styles[0]);
					_levers.eq(1).addClass(_styles[2]).removeClass(_styles[0]);
					_levers.eq(2).addClass(_styles[3]).removeClass(_styles[0]);
					break;
					default:
					_levers.eq(0).addClass(_styles[0]).removeClass(_styles[1]);
					_levers.eq(1).addClass(_styles[0]).removeClass(_styles[2]);
					_levers.eq(2).addClass(_styles[0]).removeClass(_styles[3]);
					break;
				}
			}
	});
});
</script>

<?php include _g('template')->name('@', 'footer', true); ?>