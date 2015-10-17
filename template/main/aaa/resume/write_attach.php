<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //附件 -->
<div class="bd-box bd-box-none clearfix">
    <div class="clearfix resume_r_data" id="attach_data">
    	<form method="post" onsubmit="return false;" id="attach_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>">
        <input type="hidden" name="f" value="attach_delete" />
        <input type="hidden" name="attachid" value="" />
        </form>
    	<?php if($attachData[0] >= 1){ ?>
        <?php while($aRs = _g('db')->result($attachData[1])) {?>
    	<div class="clearfix" id="attach_data_<?php prt($aRs['attachid']); ?>">
        	<?php include _g('template')->name('resume', 'write_attach_item', true); ?>
        </div>
        <?php } ?>
		<?php } ?>
    </div>
    
    <!-- //attach_add -->
    <div class="clearfix resume_r_data_add_btn" id="attach_add_btn">
    	<a class="btn" href="#" onclick="return resumeDo_attachForm(0);">+继续添加</a>
    </div>
    <!-- attach_add// -->
    
    <!-- //attach_write -->
	<div class="clearfix resume_r_data_write_wrap" id="attach_write_wrap"></div>
    <!-- attach_write// -->
    
    <form method="post" onsubmit="return false;" id="s_attach_form" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/attach_form')); ?>"></form>
    <form method="post" onsubmit="return false;" id="attach_file_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/attach_fdel')); ?>"><input type="hidden" name="attachid" value="" /></form>
</div>
<!-- 附件// -->