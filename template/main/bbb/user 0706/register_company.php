<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/register.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/register-index-bg2.png"
			width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //register-iarea -->
<div class="register-iarea register-iarea-mt clearfix" id="register_s1">
	<!-- //steps -->
	<div class="step step-1 clearfix">
    	<div class="acc a1 clearfix"><strong>第一步：填写注册信息</strong></div>
        <div class="acc a2 clearfix">第二步：完善公司信息</div>
        <div class="acc a3 clearfix">第三步：注册成功</div>
    </div>
	<!-- steps// -->
    
    <!-- //ib -->
    <form method="post" onsubmit="return false;">
    <div class="z ib clearfix">
    	<div class="ibs clearfix">
            <div class="nt clearfix">用户名</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="username" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">电子邮箱</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="email" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">密码</div>
            <div class="inp-area clearfix"><input type="password" class="itext" name="password" id="password" /></div>
            <div class="pws clearfix">
            	<div class="ss"><p class="tf">弱</p><p class="ts ts-c0"></p></div>
                <div class="ss"><p class="tf">中</p><p class="ts ts-c0"></p></div>
                <div class="ss"><p class="tf">强</p><p class="ts ts-c0"></p></div>
            </div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">确认密码</div>
            <div class="inp-area clearfix"><input type="password" class="itext" name="password2" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">公司名称</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="cname" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix"><input type="hidden" name="area" />公司地址</div>
            <div class="z clearfix" id="select-area"></div>
        </div>
        <div class="ibs clearfix">
            <div class="nt clearfix">&nbsp;</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="area_detail" placeholder="详细地址" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">联系人</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="contacts" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">联系电话</div>
            <div class="ii clearfix"><input type="text" class="text" name="telephone[]" placeholder="区号" /></div>
            <div class="ii2 ml5 clearfix"><input type="text" class="text2" name="telephone[]" placeholder="固定电话" /></div>
            <div class="ii ml5 clearfix"><input type="text" class="text" name="telephone[]" placeholder="分机号" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">手机号码</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="mobilephone" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">公司邮箱</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="cemail" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">&nbsp;</div>
            <div class="ibtn clearfix"><button type="button" class="reg" name="disabled-buttons" onclick="cRegister_s1(this, '<?php prt(_g('uri')->su('user/ac/register/op/company_do')); ?>');">同意服务条款并注册</button></div>
        </div>
    </div>
    </form>
    <!-- ib// -->
    
    <!-- //iser -->
    <div class="y iser clearfix">
    	<div class="shadow clearfix"></div>
        <div class="t clearfix">
        	<div class="tit"><<诺一网站服务条款>></div>
            <p>1、服务条款的确认和接纳</p>
            <p>诺一网站由上海携程商务有限公司运营，涉及具体产品服务的将由有资质的服务商提供。用户通过完成注册程序并点击一下“递交”的按钮，这表示用户明确知晓以上事实，并与上海携程商务有限公司达成协议并接受所有的服务条款。</p>
            <p>2、服务简介</p>
            <p>诺一网站运用自己的操作系统通过国际互联网络为用户提供网络会员服务。用户必须： ⑴提供设备，包括个人电脑一台、调制解调器一个及配备上网装置。 ⑵个人上网和支付与此服务有关的电话费用。 考虑到携程网络会员服务的重要性，用户同意： ⑴提供及时、详尽及准确的个人资料。 ⑵不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。 另外，用户可授权上海携程商务有限公司向第三方透露其基本资料，但上海携程商务有限公司不能公开用户的补充资料。除非： ⑴用户要求世纪游网站或授权某人通过电子邮件服务透露这些信息。 ⑵相应的法律要求及程序要求上海携程商务有限公司提供用户的个人资料。 如果用户提供的资料不准确，上海携程商务有限公司保留结束用户使用携程网络会员服务的权利。 用户在享用携程网络会员服务的同时，同意接受携程网络会员服务提供的各类信息服务。</p>
            <p>3、服务条款的修改</p>
            <p>上海携程商务有限公司会在必要时修改服务条款，携程网络会员服务条款一旦发生变动，公司将会在用户进入下一步使用前的页面提示修改内容。如果你同意改动，则按“我同意”按钮。如果你不接受，则及时取消你的用户使用服务资格。 用户要继续使用携程网络会员服务需要两方面的确认： ⑴首先确认携程网络会员服务条款及其</p>
		</div>
    </div>
    <!-- iser// -->
</div>
<!-- register-iarea// -->

<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#register_s1");
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
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('user/ac/register/op/company')); ?>"});
		}
    });
});

/* 密码状态 */
window.onload = function(){
	var _levers = $("#register_s1 .ib .ibs .pws .ss .ts");
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
	
	_GESHAI.levelselect({ 
		data: _CACHE_job_area, 
		container: "#select-area", 
		name: "select-area[]", 
		selectClass: "sel mr8", 
		optionFunc: function(d){
			return {"id": d.id, "parentid": d.parentid, "text": d.aname};
		},
		callback: function(_selObj){
			var _selData = [];
			_selObj.each(function(_i, _e) {
				var _vv = parseInt($(this).find("option:selected").val());
                if(_vv >= 1){
					_selData.push(_vv);
				}
            });
			
			var _setAreaData = "";
			if(_selData.length == 2){
				_setAreaData = _selData.join(",");
			}
			document.getElementsByName("area").item(0).value = _setAreaData;
		}
	});
};
</script>

<?php include _g('template')->name('@', 'footer', true); ?>