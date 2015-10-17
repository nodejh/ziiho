<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //项目经历 -->
<div class="bd-box bd-box-none clearfix">
    <div class="clearfix resume_r_data" id="projectexp_data">
    	<form method="post" onsubmit="return false;" id="projectexp_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>">
        <input type="hidden" name="f" value="projectexp_delete" />
        <input type="hidden" name="projectexpid" value="" />
        </form>
    	<?php if($projectexpData[0] >= 1){ ?>
        <?php while($pRs = _g('db')->result($projectexpData[1])) {?>
    	<div class="clearfix" id="projectexp_data_<?php prt($pRs['projectexpid']); ?>">
        	<?php include _g('template')->name('resume', 'write_projectexp_item', true); ?>
        </div>
        <?php } ?>
		<?php } ?>
    </div>
    
    <!-- //projectexp_add -->
    <div class="clearfix resume_r_data_add_btn" id="projectexp_add_btn">
    	<a class="btn" href="#" onclick="return resumeDo_projectexpForm(0);">+继续添加</a>
    </div>
    <!-- projectexp_add// -->
    
    <!-- //projectexp_write -->
	<div class="clearfix resume_r_data_write_wrap" id="projectexp_write_wrap"></div>
    <!-- projectexp_write// -->
    
    <form method="post" onsubmit="return false;" id="s_projectexp_form" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/projectexp_form')); ?>"></form>
</div>
<!-- 项目经历// -->