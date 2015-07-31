<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_write">
    <form method="post" enctype="multipart/form-data" onsubmit="return false;">
    <input type="hidden" name="f" value="attach" />
    <input type="hidden" name="attachid" value="<?php prt(my_array_value('attachid', $attachRs, 0)); ?>" />
    <ul>
        <li class="bline clearfix">
            <div class="nn">附件名称:</div>
            <div class="ii">
                <input type="text" class="ii-inp" name="aname" value="<?php prt(my_array_value('aname', $attachRs)); ?>" />
                
                附件链接：
                <input type="text" class="ii-inp" name="url" value="<?php prt(my_array_value('url', $attachRs)); ?>" />
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">上传附件:</div>
            <div class="ii">
            	<?php if(strlen(my_array_value('srcname', $attachRs)) >= 1){ ?>
                <p id="attach_file_<?php prt($attachRs['attachid']); ?>"><?php prt($attachRs['srcname']); ?><a href="#" onclick="return resumeDo_attachFileDel(<?php prt($attachRs['attachid']); ?>);">删除附件</a></p>
                <?php } ?>
                <p><input type="file" name="src" /></p>
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">附件描述:</div>
            <div class="ii"><textarea attach="description" name="description" style="width:540px; height:80px;"><?php prt(my_array_value('description', $attachRs)); ?></textarea></div>
        </li>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <div class="ii"><input type="checkbox" name="ispublish" value="true" <?php prt(1 == my_array_value('ispublish', $attachRs) ? 'checked="checked"' : null ); ?> />显示在我的简历中</div>
        </li>
        
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_attachSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
          <a class="del_btn" href="#" onclick="return resumeDo_attachDel(<?php prt(my_array_value('attachid', $attachRs, 0)); ?>);">删除</a>
        </li>
    </ul>
    </form>
</div>