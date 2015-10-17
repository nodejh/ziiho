<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //语言能力 -->
<div class="bd-box bd-box-none clearfix">
    <div class="clearfix resume_r_data" id="language_data">
    	<form method="post" onsubmit="return false;" id="language_del" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>">
        <input type="hidden" name="f" value="language_delete" />
        <input type="hidden" name="languageid" value="" />
        </form>
    	<?php if($languageData[0] >= 1){ ?>
        <?php while($lRs = _g('db')->result($languageData[1])) {?>
    	<div class="clearfix" id="language_data_<?php prt($lRs['languageid']); ?>">
        	<?php include _g('template')->name('resume', 'write_language_item', true); ?>
        </div>
        <?php } ?>
		<?php } ?>
    </div>
    
    <!-- //language_add -->
    <div class="clearfix resume_r_data_add_btn" id="language_add_btn">
    	<a class="btn" href="#" onclick="return resumeDo_languageForm(0);">+继续添加</a>
    </div>
    <!-- language_add// -->
    
    <!-- //language_write -->
	<div class="clearfix resume_r_data_write_wrap" id="language_write_wrap"></div>
    <!-- language_write// -->
    
    <form method="post" onsubmit="return false;" id="s_language_form" _act="<?php prt(_g('uri')->su('resume/ac/manager/op/language_form')); ?>"></form>
</div>
<!-- 语言能力// -->