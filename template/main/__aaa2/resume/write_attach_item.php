<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_i">
    <div class="clearfix ib99">
        <a href="#" onclick="return resumeDo_attachForm(<?php prt($aRs['attachid']); ?>);">修改</a>
        <a href="#" onclick="return resumeDo_attachDel(<?php prt($aRs['attachid']); ?>);">删除</a>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">名称:</span>
        <span class="z" id="attach_<?php prt($aRs['attachid']); ?>"><?php prt($aRs['aname']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">url链接:</span>
        <span class="z">
            <?php prt($aRs['url']); ?>
        </span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">文件:</span>
        <span class="z">
        	<?php if(strlen($aRs['src']) >= 1){ ?>
			<a href="<?php prt(uploadfile($aRs['src'])); ?>" target="_blank">下载附件</a>
            <?php }else{ ?>
            未上传
            <?php } ?>
        </span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">描述:</span>
        <span class="z"><?php prt($aRs['description']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">是否在简历显示:</span>
        <span class="z"><?php prt($aRs['ispublish'] == 1 ? '是' : '否'); ?></span>
    </div>
    
</div>