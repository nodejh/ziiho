<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<style type="text/css">
.qs-item { line-height:32px; margin-left:20px; }
	.qs-item .qs-create { margin:0px 5px; color:#0263ad; }
	.qs-item .qs-create:hover { text-decoration:underline; color:#F00; }
	
	.qs-item .qs-remove { margin:0px 5px; color:#F00; }
	.qs-item .qs-remove:hover { text-decoration:underline; color:#F00; }
	
.qs-html { position:absolute; left:0px; top:-100px; width:0px; height:0px; overflow:hidden; }
</style>

<form method="post" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="itemid" value="<?php prt(my_array_value('itemid', $proItemSub, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        
        <li class="clearfix is">
            <a href="<?php prt(_g('cp')->uri('mod/job/ac/provide')); ?>" class="fa-cd icon-page-goback">返回首页</a>
            <?php prt($pageNow); ?>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">方案分类:</div>
            <div class="clearfix inp">
                <select name="post_provideid" class="fs-ts-200">
                    <option value="0">==请选择==</option>
                    <?php while($pRs = _g('db')->fetch_array($provideResult)){ ?>
                    <option value="<?php prt($pRs['provideid']); ?>" <?php if(my_array_value('provideid', $proItemSub) == $pRs['provideid']){ ?>selected="selected"<?php } ?> ><?php prt($pRs['pname']); ?></option>
                    <?php } ?>
            	</select>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">排序:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="listorder" value="<?php prt(my_array_value('listorder', $proItemSub, 0)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">标题:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="title" value="<?php prt(my_array_value('title', $proItemSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">启用:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $proItemSub, 1)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">内容简介:</div>
            <div class="clearfix inp">
                <textarea class="fs-tt" name="content"><?php prt(my_array_value('content', $proItemSub)); ?></textarea>
            </div>
        </li>
        
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="urlRedirect('<?php prt($backUrl); ?>');">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status"});

/* submit */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/item/f/write_save/sortid/' . $sortid . '/provideid/' . $provideid)); ?>", {
		"goback": "<?php prt($backUrl); ?>",
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