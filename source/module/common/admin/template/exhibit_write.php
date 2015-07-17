<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($selectData as $k => $v){ ?>
	<a href="<?php prt(_g('cp')->uri($v['uri'])); ?>" class="ml1 <?php prt($selectInd == $k ? 'on' : null); ?>"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<form method="post" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="eid" value="<?php prt(my_array_value('eid', $exhibitSub, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        
        <li class="clearfix is">
            <div class="clearfix tit">排序:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="listorder" value="<?php prt(my_array_value('listorder', $exhibitSub)); ?>" />
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">标题:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="title" value="<?php prt(my_array_value('title', $exhibitSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">URL:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="url" value="<?php prt(my_array_value('url', $exhibitSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">分组类型:</div>
            <div class="clearfix inp">
                <select name="gid" class="fs-ts-200">
                    <option value="0">==请选择==</option>
                    <?php while($rs = $EXHIBIT->db->fetch_array($groupResult)){ ?>
                    <option value="<?php prt($rs['gid']); ?>" <?php if($rs['gid'] == my_array_value('gid', $exhibitSub)){ ?>selected="selected"<?php } ?> ><?php prt($rs['gname']); ?></option>
                    <?php } ?>
            	</select>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">打开方式:</div>
            <div class="clearfix inp">
                <select name="target" class="fs-ts-200">
                <?php foreach(_g('value')->ra(_g('module')->dv('@', 100001)) as $k => $v){ ?>
                <option value="<?php prt($k); ?>" <?php if($k == my_array_value('target', $exhibitSub)){ ?> selected="selected" <?php } ?>><?php prt($v['name']); ?></option>
                <?php } ?>
            </select>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">内容简介:</div>
            <div class="clearfix inp">
                <textarea class="fs-tt" name="description"><?php prt(my_array_value('description', $exhibitSub)); ?></textarea>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">启用:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $exhibitSub, _g('value')->sb(false))){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">图片:</div>
            <div class="clearfix inp">
            	<?php if(strlen(my_array_value('src', $exhibitSub)) >= 1){ ?>
            	<p style="margin-bottom:5px;"><img src="<?php prt(uploadfile($exhibitSub['src'])); ?>" width="100" /></p>
                <?php } ?>
                <p><input type="file" class="fs-ts-200" name="src" value="" /></p>
            </div>
        </li>
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });
	
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/write_save')); ?>", {
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
				urlRedirect('<?php prt(_g('uri')->referer()); ?>');
			}
		}
	});
};
</script>
<!-- javascript// -->