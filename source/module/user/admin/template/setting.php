<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix ul-box">
    <ul class="ubox">
        <li class="clearfix is">
			<span class="tc-a fw">当前正在操作（<?php prt(my_array_value('username', $rUserRs)); ?>）<?php prt($rUserRs['nickname']); ?></span>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="do_uid" value="<?php prt($rUserRs['uid']); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">管理组:</div>
            <div class="clearfix inp">
                <select name="ugid" class="fs-ts-200">
                	<option value="0">===无权限==</option>
                	<?php while ($ugRs = _g('db')->result($userGroupResult)){ ?>
                	<option value="<?php prt($ugRs['ugid']); ?>" <?php prt(than2eq($adminUid, $ugRs['ugid'], 'selected="selected"')); ?> ><?php prt($ugRs['gname']); ?></option>
                	<?php } ?>
                </select>
            </div>
            <div class="clearfix des">
            	该用户管理组，<em class="tc-c">注意：请对应“用户管理组”的设置关联</em>
            </div>
        </li>
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="urlRedirect('<?php prt($lsUri); ?>');">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });
	
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/manager/op/settingdo')); ?>", {
		"goback": "<?php prt($lsUri); ?>",
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
			}
			window.top._GESHAI.dialog(d);
		}
	});
};
</script>
<!-- javascript// -->