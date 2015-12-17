<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix ul-box">
    <ul class="ubox">
        <li class="clearfix is">
			<span class="tc-a fw">创建新用户</span>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="do_uid" value="<?php prt($rUserRs['uid']); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">用户名:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="username" value="" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">密码:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="password" value="" />
            </div>
        </li>
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="urlRedirect('<?php prt(_g('uri')->referer()); ?>');">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/manager/op/createdo')); ?>", {
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
			}else{
				d.title = "操作成功";
				_GESHAI.redirect(d);
			}
			window.top._GESHAI.dialog(d);
		}
	});
};
</script>
<!-- javascript// -->