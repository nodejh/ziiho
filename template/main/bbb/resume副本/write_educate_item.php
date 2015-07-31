<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_i">
    <div class="clearfix ib99">
        <a href="#" onclick="return resumeDo_educateForm(<?php prt($eRs['educateid']); ?>);">修改</a>
        <a href="#" onclick="return resumeDo_educateDel(<?php prt($eRs['educateid']); ?>);">删除</a>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">时间:</span>
        <span class="z">
            <?php prt(date('Y', $eRs['stime'])); ?>年<?php prt(date('m', $eRs['stime'])); ?>月&nbsp;~&nbsp;
            <?php if($eRs['etime'] == 0) { ?>
            至今
            <?php }else{ ?>
            <?php prt(date('Y', $eRs['etime'])); ?>年<?php prt(date('m', $eRs['etime'])); ?>
            <?php } ?>
        </span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">学校:</span>
        <span class="z" id="educate_<?php prt($eRs['educateid']); ?>"><?php prt($eRs['school']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">专业:</span>
        <span class="z">
            <?php prt(_g('cache')->selectitem('110>' . $eRs['specialty'] . '>sname')); ?>
            <?php if(strlen($eRs['specialty_input']) >= 1){ ?>,<?php prt($eRs['specialty_input']); ?><?php } ?>
        </span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">学历:</span>
        <span class="z">
			<?php prt(_g('cache')->selectitem('111>' . $eRs['degree'] . '>sname')); ?>
            <?php if($eRs['isallday'] == 1){ ?>,全日制<?php } ?>
        </span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">专业描述:</span>
        <span class="z"><?php prt($eRs['description']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">海外经历:</span>
        <span class="z"><?php prt($eRs['overseas_exp'] == 1 ? '是' : '否'); ?></span>
    </div>
    
</div>