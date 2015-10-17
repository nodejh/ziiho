<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">发送邮件</a>
</div>

<form method="post" onsubmit="return false;">
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">SMTP 服务器:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="host" value="<?php prt(my_array_value('host', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">端口:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="port" value="<?php prt(my_array_value('port', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">邮箱地址:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="email" value="<?php prt(my_array_value('email', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">邮箱密码:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="password" value="<?php prt(my_array_value('password', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">发件人:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="sname" value="<?php prt(my_array_value('sname', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">是否验证:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="auth"><input type="radio" name="auth" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('auth', $options, _g('value')->sb(true))){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
        
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });
_GESHAI.radio({ radioItem: 'span[radio="auth"]', name: "auth" });

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/emailcfg/op/do')); ?>", {
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