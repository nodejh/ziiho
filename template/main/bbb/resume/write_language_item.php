<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_i">
    <div class="clearfix ib99">
        <a href="#" onclick="return resumeDo_languageForm(<?php prt($lRs['languageid']); ?>);">修改</a>
        <a href="#" onclick="return resumeDo_languageDel(<?php prt($lRs['languageid']); ?>);">删除</a>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">语言类别:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('112>' . $lRs['ltype'] . '>sname')); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">掌握程度:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('113>' . $lRs['level'] . '>sname')); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">读写能力:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('113>' . $lRs['rwability'] . '>sname')); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">听说能力:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('113>' . $lRs['lsability'] . '>sname')); ?></span>
    </div>
    
</div>