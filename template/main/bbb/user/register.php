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
    <div class="c-area clearfix" id="c-area">
        <!-- //m -->
        <div class="m clearfix">
            <div class="f1 clearfix">
                <div class="sp pp1 color-grey">▲</div>
                <div class="tt"><a href="javascript:;" flag="1">个人注册</a></div>
                <div class="tt"><a href="javascript:;" flag="2">企业注册</a></div>
            </div>
            <form method="post" id="form-register" onsubmit="return false;">
                <input type="hidden" name="flag" value="1" />

                <div class="f2 clearfix">
                    <div class="t1">邮箱：</div>
                    <div class="t2"><input type="text" class="inp" name="email" /></div>
                </div>
                <div class="f2 clearfix" id="pws-div">
                    <div class="t1">密码：</div>
                    <div class="t2"><input type="password" class="inp" name="password" id="password" /></div>
                    <div class="pws clearfix">
                        <div class="ss"><p class="tf">弱</p><p class="ts ts-c0"></p></div>
                        <div class="ss"><p class="tf">中</p><p class="ts ts-c0"></p></div>
                        <div class="ss"><p class="tf">强</p><p class="ts ts-c0"></p></div>
                    </div>
                </div>
                <div class="f2 clearfix">
                    <div class="t1">确认密码：</div>
                    <div class="t2"><input type="password" class="inp" name="password2" id="password2" /></div>
                </div>
                <div class="f2 clearfix">
                    <div class="t1">验证码：</div>
                    <div class="t2"><input type="text" class="inp" name="checkcode" value="" /></div>
                    <div class="ccode clearfix">
                        <span id="captcha-box"></span><a href="javascript:;" id="captcha-click"></a>
                    </div>
                </div>
                <div class="f3 clearfix">
                    <div class="z t1" id="register-button"><button type="button" class="reg" id="r-button" name="disabled-buttons" onclick="register_email(this, '<?php prt(_g('uri')->su('user/ac/register/op/email_do')); ?>');">同意服务条款并注册</button></div>
                    <div class="z t2"><a href="<?php prt(_g('uri')->su('user/ac/login')); ?>">登陆</a></div>
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
                document.getElementById("form-register").flag.value = _flagValue;
                if (_flagValue == 2) {
                    //企业注册
                    $('#r-button').remove();
                    $('#register-button').append("<button type=\"button\" class=\"reg\" id=\"r-button\" name=\"disabled-buttons\" onclick=\"register_email(this, '<?php prt(_g('uri')->su('user/ac/register/op/company2_do')); ?>');\">同意服务条款并注册</button>");
                } else {
                    //个人注册
                    $('#r-button').remove();
                    $('#register-button').append("<button type=\"button\" class=\"reg\" id=\"r-button\" name=\"disabled-buttons\" onclick=\"register_email(this, '<?php prt(_g('uri')->su('user/ac/register/op/email_do')); ?>');\">同意服务条款并注册</button>");
                }

            });

            /* captcha */
            _GESHAI.captcha({ captcha: "captcha-box", click: "captcha-click" });

            /* password status */
            var _levers = $("#form-register #pws-div .pws .ss .ts");
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