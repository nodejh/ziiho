<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix ul-box">
	
    <ul class="ubox">
        <li class="clearfix is">
			<?php $area->include_cpos(my_array_value('parentid', $areaSub)); ?>
			<?php if(my_array_key_exist('areaid', $areaSub)){ ?><span class="pos-sp">-</span><span class="tc-a fw"><?php prt(my_array_value('aname', $areaSub)); ?></span><?php } ?>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="areaid" value="<?php prt(my_array_value('areaid', $areaSub, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">排序:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="listorder" value="<?php prt(my_array_value('listorder', $areaSub, 0)); ?>" />
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">名称:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="aname" value="<?php prt(my_array_value('aname', $areaSub)); ?>" />
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">地区分类:</div>
            <div class="clearfix inp">
                <select name="parentid" class="fs-ts-200">
                    <option value="0">无分类(作为顶级)</option>
                	<?php $area->option($areaSub, 0, 0); ?>
            	</select>
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">启用:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $areaSub)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
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
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt($gobackUrl); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });
	
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/area/op/write_save')); ?>", {
		"goback": "<?php prt($gobackUrl); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "操作失败";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				_GESHAI.redirect(d);
			}
		}
	});
};
</script>
<!-- javascript// -->