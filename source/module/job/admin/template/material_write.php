<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<form method="post" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="materialid" value="<?php prt(my_array_value('materialid', $materialSub, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is">
            <a href="<?php prt(_g('cp')->uri($materialWriteUrl)); ?>" class="fa-cd icon-add">添加</a>
            <a href="<?php prt(_g('cp')->uri('mod/job/ac/provide')); ?>" class="fa-cd icon-page-goback">返回首页</a>
			<?php prt($pageNow); ?>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">封面图:</div>
            <div class="clearfix inp">
            	<?php if(strlen(my_array_value('src', $materialSub)) >= 1){ ?>
            	<p style="margin-bottom:5px;"><img src="<?php prt($JMODEL->src($materialSub['src'])); ?>" width="100" /></p>
                <?php } ?>
                <p><input type="file" class="fs-ts-200" name="src" value="" /></p>
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">标题:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="title" value="<?php prt(my_array_value('title', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">副标题:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="subtitle" value="<?php prt(my_array_value('subtitle', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">作者:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="author" value="<?php prt(my_array_value('author', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">出版社:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="publish" value="<?php prt(my_array_value('publish', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">出版时间:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="publishdate" value="<?php prt(my_array_value('publishdate', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">内容简介:</div>
            <div class="clearfix inp">
                <textarea class="fs-tt" name="description"><?php prt(my_array_value('description', $materialSub)); ?></textarea>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">资料url:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="viewurl" value="<?php prt(my_array_value('viewurl', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">视频url:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="mediaurl" value="<?php prt(my_array_value('mediaurl', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">书籍url:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="bookurl" value="<?php prt(my_array_value('bookurl', $materialSub)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">附件url:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="attachurl" value="<?php prt(my_array_value('attachurl', $materialSub)); ?>" />
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
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/item/f/material/d/write_save/sortid/' . $sortid . '/provideid/' . $provideid . '/itemid/' . $itemid)); ?>", {
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