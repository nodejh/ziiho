<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">注册设置</a>
</div>

<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<form method="post" onsubmit="return false;">
	<ul class="ubox">
        
        <li class="clearfix is">
            <div class="clearfix tit">验证码:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="checkcode"><input type="radio" name="checkcode" value="<?php prt($k); ?>" <?php if($v['v'] == _g('value')->sb(my_array_value('checkcode', $options, true))){ ?> checked="checked"<?php } ?> /><?php prt($v['status']); ?></span>
                <?php } ?>
            </div>
            <div class="clearfix des">用户注册时，是否需要输入正确的验证码进行效验，默认为“开启”。<em class="tc-c">为了避免站点恶意的会员注册，建议开启此功能。</em></div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">邀请码注册:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="invitecode"><input type="radio" name="invitecode" value="<?php prt($k); ?>" <?php if($v['v'] == _g('value')->sb(my_array_value('invitecode', $options, false))){ ?> checked="checked"<?php } ?> /><?php prt($v['status']); ?></span>
                <?php } ?>
            </div>
            <div class="clearfix des">邀请码注册，默认为“关闭”，若开启时，将会提示输入正确的“邀请码”即可注册，<em class="tc-c">此功能用作测试阶段用</em></div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">注册方式:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('module')->dv('user', 100003) as $k=>$v){ ?>
                <p><span class="ck-mr" checkbox="registermodel" <?php if(my_in_array($v['v'], $options['registermodel'])){ ?>checkbox-status="true"<?php } ?>><input type="checkbox" name="registermodel[]" value="<?php prt($k); ?>" <?php if(my_in_array($v['v'], $options['registermodel'])){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span></p>
                <?php } ?>
            </div>
            <div class="clearfix des">选择注册方式，默认均可注册</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">邮箱认证:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="email_auth"><input type="radio" name="email_auth" value="<?php prt($k); ?>" <?php if($v['v'] == _g('value')->sb(my_array_value('email_auth', $options, true))){ ?> checked="checked"<?php } ?> /><?php prt($v['status']); ?></span>
                <?php } ?>
            </div>
            <div class="clearfix des">当为“邮箱注册”时，是否需要对该邮箱进行验证。</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">发送消息方式:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('module')->dv('user', 100004) as $k=>$v){ ?>
                <p><span class="ck-mr" checkbox="messagemodel" <?php if(my_in_array($v['v'], $options['messagemodel'])){ ?>checkbox-status="true"<?php } ?>><input type="checkbox" name="messagemodel[]" value="<?php prt($k); ?>" <?php if(my_in_array($v['v'], $options['messagemodel'])){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span></p>
                <?php } ?>
            </div>
            <div class="clearfix des">选择发送消息方式，默认为“站内消息”由系统自动发送。“邮件消息”需要对站点的发送邮箱账户进行配置。选项-邮箱设置</div>
        </li>
        
        <li class="clearfix is bg-a">
        	<div class="clearfix tit">发送消息</div>
        </li>
        <li class="clearfix is">
            <div class="clearfix tit">标题</div>
            <div class="clearfix inp">
            	<input type="text" class="fs-ts-200" name="message_title" value="<?php prt(my_array_value('message_title', $options)); ?>" />
            </div>
            <div class="clearfix des">消息标题</div>
        </li>
        <li class="clearfix is">
            <div class="clearfix tit">内容</div>
            <div class="clearfix inp">
                <textarea class="fs-tt" name="message_data"><?php prt(my_array_value('message_data', $options)); ?></textarea>
            </div>
            <div class="clearfix des">消息内容，支持HTML内容</div>
        </li>
        
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
        </li>
	</ul>
    </form>
    
</div>
<!-- tabs// -->

<!-- //javascript -->
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });
_GESHAI.radio({ radioItem: 'span[radio="checkcode"]', name: "checkcode" });
_GESHAI.radio({ radioItem: 'span[radio="invitecode"]', name: "invitecode" });
_GESHAI.checkbox({ checkboxItem: 'span[checkbox="registermodel"]', name: "registermodel[]" });
_GESHAI.radio({ radioItem: 'span[radio="email_auth"]', name: "email_auth" });
_GESHAI.checkbox({ checkboxItem: 'span[checkbox="messagemodel"]', name: "messagemodel[]" });

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/registercfg/op/do')); ?>", {
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