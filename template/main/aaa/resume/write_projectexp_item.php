<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_i">
    <div class="clearfix ib99">
        <a href="#" onclick="return resumeDo_projectexpForm(<?php prt($pRs['projectexpid']); ?>);">修改</a>
        <a href="#" onclick="return resumeDo_projectexpDel(<?php prt($pRs['projectexpid']); ?>);">删除</a>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">时间:</span>
        <span class="z">
            <?php prt(date('Y', $pRs['stime'])); ?>年<?php prt(date('m', $pRs['stime'])); ?>月&nbsp;~&nbsp;
            <?php if($pRs['etime'] == 0) { ?>
            至今
            <?php }else{ ?>
            <?php prt(date('Y', $pRs['etime'])); ?>年<?php prt(date('m', $pRs['etime'])); ?>
            <?php } ?>
        </span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">项目名称:</span>
        <span class="z"><?php prt($pRs['pname']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">开发工具:</span>
        <span class="z"><?php prt($pRs['tool']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">硬件环境:</span>
        <span class="z"><?php prt($pRs['hardware']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">软件环境:</span>
        <span class="z"><?php prt($pRs['software']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">项目描述:</span>
        <span class="z"><?php prt($pRs['pdesc']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">责任描述:</span>
        <span class="z"><?php prt($pRs['responsible']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">是否在我的简历显示:</span>
        <span class="z"><?php prt($pRs['ispublish'] == 1 ? '是' : '否'); ?></span>
    </div>
    
</div>