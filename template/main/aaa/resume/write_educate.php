<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //教育经历 -->
<div class="bd-box bd-box-none clearfix">
	<div class="clearfix resume_r_data" id="educate_data">
    	<form method="post" onsubmit="return false;" id="educate_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>">
        <input type="hidden" name="f" value="educate_delete" />
        <input type="hidden" name="educateid" value="" />
        </form>
    	<?php if($educateData[0] >= 1){ ?>
        <?php while($eRs = _g('db')->result($educateData[1])) {?>
    	<div class="clearfix" id="educate_data_<?php prt($eRs['educateid']); ?>">
        	<?php include _g('template')->name('resume', 'write_educate_item', true); ?>
        </div>
        <?php } ?>
		<?php } ?>
    </div>
    
    <!-- //educate_add -->
    <div class="clearfix resume_r_data_add_btn" id="educate_add_btn">
    	<a class="btn" href="#" onclick="return resumeDo_educateForm(0);">+继续添加</a>
    </div>
    <!-- educate_add// -->
    
    <!-- //educate_write -->
	<div class="clearfix resume_r_data_write_wrap" id="educate_write_wrap"></div>
    <!-- educate_write// -->
    
    <form method="post" onsubmit="return false;" id="s_educate_form" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/educate_form')); ?>"></form>
</div>
<!-- 教育经历// -->