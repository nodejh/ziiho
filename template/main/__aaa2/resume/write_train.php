<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //培训经历 -->
<div class="bd-box bd-box-none clearfix">
    <div class="clearfix resume_r_data" id="train_data">
    	<form method="post" onsubmit="return false;" id="train_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>">
        <input type="hidden" name="f" value="train_delete" />
        <input type="hidden" name="trainid" value="" />
        </form>
    	<?php if($trainData[0] >= 1){ ?>
        <?php while($tRs = _g('db')->result($trainData[1])) {?>
    	<div class="clearfix" id="train_data_<?php prt($tRs['trainid']); ?>">
        	<?php include _g('template')->name('resume', 'write_train_item', true); ?>
        </div>
        <?php } ?>
		<?php } ?>
    </div>
    
    <!-- //train_add -->
    <div class="clearfix resume_r_data_add_btn" id="train_add_btn">
    	<a class="btn" href="#" onclick="return resumeDo_trainForm(0);">+继续添加</a>
    </div>
    <!-- train_add// -->
    
    <!-- //train_write -->
	<div class="clearfix resume_r_data_write_wrap" id="train_write_wrap"></div>
    <!-- train_write// -->
    
    <form method="post" onsubmit="return false;" id="s_train_form" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/train_form')); ?>"></form>
</div>
<!-- 培训经历// -->