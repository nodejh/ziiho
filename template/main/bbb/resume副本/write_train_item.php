<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_i">
    <div class="clearfix ib99">
        <a href="#" onclick="return resumeDo_trainForm(<?php prt($tRs['trainid']); ?>);">修改</a>
        <a href="#" onclick="return resumeDo_trainDel(<?php prt($tRs['trainid']); ?>);">删除</a>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">时间:</span>
        <span class="z">
            <?php prt(date('Y', $tRs['stime'])); ?>年<?php prt(date('m', $tRs['stime'])); ?>月&nbsp;~&nbsp;
            <?php if($tRs['etime'] == 0) { ?>
            至今
            <?php }else{ ?>
            <?php prt(date('Y', $tRs['etime'])); ?>年<?php prt(date('m', $tRs['etime'])); ?>
            <?php } ?>
        </span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">培训机构:</span>
        <span class="z"><?php prt($tRs['organization']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">培训地点:</span>
        <span class="z"><?php prt($tRs['area']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">培训课程:</span>
        <span class="z"><?php prt($tRs['course']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">获得证书:</span>
        <span class="z"><?php prt($tRs['certificate']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">详细描述:</span>
        <span class="z"><?php prt($tRs['description']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">是否在我的简历显示:</span>
        <span class="z"><?php prt($tRs['ispublish'] == 1 ? '是' : '否'); ?></span>
    </div>
    
</div>