<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //工作经验 -->
<div class="bd-box bd-box-none clearfix">
	<div class="clearfix resume_r_data" id="workexp_data">
    	<form method="post" onsubmit="return false;" id="workexp_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>">
        <input type="hidden" name="f" value="workexp_delete" />
        <input type="hidden" name="workexpid" value="" />
        </form>
    	<?php if($workexpData[0] >= 1){ ?>
        <?php while($wRs = _g('db')->result($workexpData[1])) {?>
    	<div class="clearfix" id="workexp_data_<?php prt($wRs['workexpid']); ?>">
        	<?php include _g('template')->name('resume', 'write_workexp_item', true); ?>
        </div>
        <?php } ?>
		<?php } ?>
    </div>
    
    <!-- //workexp_add -->
    <div class="clearfix resume_r_data_add_btn" id="workexp_add_btn">
    	<a class="btn" href="#" onclick="return resumeDo_workexpForm(0);">+继续添加</a>
    </div>
    <!-- workexp_add// -->
    
    <!-- //workexp_write -->
	<div class="clearfix resume_r_data_write_wrap" id="workexp_write_wrap"></div>
    <!-- workexp_write// -->
    
    <form method="post" onsubmit="return false;" id="s_workexp_form" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/workexp_form')); ?>"></form>
</div>
<!-- 工作经验// -->