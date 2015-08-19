<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">基本设置</a><a href="javascript:;" class="ml1">上传头像</a>
</div>

<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	
    <!-- //基本设置 -->
	<form method="post" onsubmit="return false;">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">用户登录名长度:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-50" name="username_min" value="<?php prt($options['username_min']); ?>" /> - <input type="text" class="fs-ts-50" name="username_max" value="<?php prt($options['username_max']); ?>" />
            </div>
            <div class="clearfix des">用户登录名长度（最小-最大）长度，最小长度为1</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">用户登录密码长度:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-50" name="password_min" value="<?php prt($options['password_min']); ?>" /> - <input type="text" class="fs-ts-50" name="password_max" value="<?php prt($options['password_max']); ?>" />
            </div>
            <div class="clearfix des">用户登录密码（最小-最大）长度，最小长度为1</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">登录方式:</div>
            <div class="clearfix inp">
                <?php foreach(_g('module')->dv('user', 100003) as $k=>$v){ ?>
                <p><span class="ck-mr" checkbox="loginmodel" <?php if(my_in_array($v['v'], $options['loginmodel'])){ ?>checkbox-status="true"<?php } ?>><input type="checkbox" name="loginmodel[]" value="<?php prt($k); ?>" <?php if(my_in_array($v['v'], $options['loginmodel'])){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span></p>
                <?php } ?>
            </div>
            <div class="clearfix des">用户登录方式，可选择多个登录方式</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">昵称长度:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-50" name="nickname_min" value="<?php prt($options['nickname_min']); ?>" /> - <input type="text" class="fs-ts-50" name="nickname_max" value="<?php prt($options['nickname_max']); ?>" />
            </div>
            <div class="clearfix des">昵称（最小-最大）长度</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">签名最大长度:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="sign_max" value="<?php prt(my_array_value('sign_max', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="setting_base(this);">提交</button>
        </li>
	</ul>
    </form>
    <!-- 基本设置// -->
    
    <!-- //头像上传 -->
    <form method="post" onsubmit="return false;">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">保存目录:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="dir" value="<?php prt(my_array_value('dir', $avatarOptions)); ?>" />
            </div>
            <div class="clearfix des">
            	设置会员上传头像后保存的目录，如：{y}/{d}。<em class="fw">可用变量：</em><em class="tc-c">{y}年，{m}月，{d}日</em>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">上传大小:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="size" value="<?php prt(my_array_value('size', $avatarOptions)); ?>" />
            </div>
            <div class="clearfix des">单位：MB，设置会员上传头像文件的大小。<em class="tc-c">默认为4MB</em></div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">上传尺寸:</div>
            <div class="clearfix inp">
                W:<input type="text" class="fs-ts-50" name="width" value="<?php prt($avatarOptions['width']); ?>" /> × H:<input type="text" class="fs-ts-50" name="height" value="<?php prt($avatarOptions['height']); ?>" />
            </div>
            <div class="clearfix des">设置会员上传头像文件的最小尺寸，W:宽 × H:高。<em class="tc-c">默认为W:200 × H:200</em></div>
        </li>
        
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="setting_avatar(this);">提交</button>
        </li>
	</ul>
    </form>
    <!-- 头像上传// -->
    
</div>
<!-- tabs// -->

<!-- //javascript -->
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });
_GESHAI.checkbox({ checkboxItem: 'span[checkbox="loginmodel"]', name: "loginmodel[]" });

/* doing */
function setting_base(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/setting/op/basedo')); ?>", {
		"goback": "<?php prt(_g('uri')->referer()); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			d.clickBgClose = true;
			
			if(d.status != 1){
				d.title = "操作失败";
			}
			window.top._GESHAI.dialog(d);
		}
	});
};

/* doing */
function setting_avatar(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/setting/op/avatardo')); ?>", {
		"goback": "<?php prt(_g('uri')->referer()); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			d.clickBgClose = true;
			
			if(d.status != 1){
				d.title = "操作失败";
			}
			window.top._GESHAI.dialog(d);
		}
	});
};
</script>
<!-- javascript// -->