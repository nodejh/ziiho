<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'home_nav2_login', true); ?>
	<link rel="stylesheet" type="text/css"
		  href="<?php prt(_g('template')->dir('job')); ?>/css/login_register.css" />

	<!-- //wrap-bg -->
	<div class="wrap-bg clearfix">
		<div class="box clearfix">
			<div class="s clearfix"></div>
			<img src="<?php prt(_g('template')->dir('job')); ?>/image/f/index-header-bg3.jpg" width="100%" height="100%" />

		</div>
	</div>
	<!-- wrap-bg// -->

    <!-- //c-area -->
    <div class="c-area clearfix register-iarea register-iarea-mt clearfix" id="register_s1">
        <!-- //m -->
        <div class="m clearfix">

            <div class="f1 clearfix">
                <div class="sp pp2 color-grey">▲</div>
                <div class="tt" id="register-user"><a href="javascript:;" flag="1">个人注册</a></div>
                <div class="tt"><a href="javascript:;" flag="2">企业注册</a></div>
            </div>

            <form method="post" id="form-register" onsubmit="return false;">
                <input type="hidden" name="flag" value="1" />

                <div class="z ib clearfix">

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">邮箱：</div>
                        <div class=" t2 inp-area clearfix"><input type="text" class="inp itext" name="email" /></div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">密码</div>
                        <div class="t2 inp-area clearfix"><input type="password" class="inp itext" name="password" id="password" /></div>
                        <div class="pws clearfix">
                            <div class="ss"><p class="tf">弱</p><p class="ts ts-c0"></p></div>
                            <div class="ss"><p class="tf">中</p><p class="ts ts-c0"></p></div>
                            <div class="ss"><p class="tf">强</p><p class="ts ts-c0"></p></div>
                        </div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">确认密码</div>
                        <div class="t2 inp-area clearfix"><input type="password" class="inp itext" name="password2" /></div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">公司名称</div>
                        <div class="t2 inp-area clearfix"><input type="text" class="inp itext" name="cname" /></div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix"><input type="hidden" name="area" />公司地址</div>
                        <div class="t2 z clearfix" id="select-area"></div>
                    </div>
                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">详细地址</div>
                        <div class="t2 inp-area clearfix"><input type="text" class="inp itext" name="area_detail" placeholder="详细地址" /></div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">联系人</div>
                        <div class="t2 inp-area clearfix"><input type="text" class="inp itext" name="contacts" /></div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">联系电话</div>
                        <div class="t2 ii clearfix o-register-ipt-1"><input type="text" class="inp text" name="telephone[]" placeholder="区号" /></div>
                        <div class="t2 ii2 ml5 clearfix o-register-ipt-1"><input type="text" class="inp text2" name="telephone[]" placeholder="固定电话" /></div>
                        <div class="t2 ii ml5 clearfix o-register-ipt-1"><input type="text" class="inp text" name="telephone[]" placeholder="分机号" /></div>
                    </div>

                    <div class="ibs f2 clearfix">
                        <div class="t1 nt clearfix">手机号码</div>
                        <div class="t2 inp-area clearfix"><input type="text" class="inp itext" name="mobilephone" /></div>
                    </div>

                    <div class="f3 ibs clearfix">
                        <div class="z t1 nt clearfix" id="register-button"><button type="button" class="reg" name="disabled-buttons" onclick="cRegister_s1(this, '<?php prt(_g('uri')->su('user/ac/register/op/company_do')); ?>');">同意服务条款并注册</button></div>
                        <div class="z t2"><a href="<?php prt(_g('uri')->su('user/ac/login')); ?>">登陆</a></div>
                    </div>

                </div>
            </form>
        </div>
        <!-- m// -->
    </div>
    <!-- c-area// -->



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
    $('#register-user').click(function() {
       window.location.href = '<?php prt(_g('uri')->su('user/ac/register')); ?>';
    });

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