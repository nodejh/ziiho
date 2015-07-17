<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($uGroupData as $k=>$v){ ?>
	<a href="javascript:;" class="ml2 <?php prt($v['v'] == $ugtype ? 'on' : null); ?>" onclick="urlRedirect('<?php prt(_g('cp')->uri('mod/user/ac/usergroup/ugtype/' . $v['v'])); ?>');"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<div class="clearfix ul-box">
    <ul class="ubox">
        <li class="clearfix is">
			<span class="tc-a fw">当前正在对“<?php prt(my_array_value('gname', $usergroupSub)); ?>”设置</span>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="ugid" value="<?php prt(my_array_value('ugid', $usergroupSub)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">添加关注好友上线个数:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="follows" value="<?php prt(my_array_value('follows', $allowData, 0)); ?>" />
            </div>
            <div class="clearfix des">
            	只会本用户组的会员允许“关注好友”的最大上限数
            </div>
        </li>

        <!--<li class="clearfix is">
            <div class="clearfix tit">启用:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $usergroupSub, -1)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>-->
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt($curUrl); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });
	
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/usergroup/op/settingdo')); ?>", {
		"goback": "<?php prt($curUrl); ?>",
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