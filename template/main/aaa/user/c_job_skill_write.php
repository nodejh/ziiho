<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    
<?php include _g('template')->name('user', 'nav', true); ?>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php $UModel->cUserCenterNav(); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
	<div class="label">
    	<a href="<?php prt(_g('uri')->referer()); ?>">&laquo;返回</a>
    </div>
    <div class="form-item clearfix">
    	<form method="post" onsubmit="return false;">
        <input type="hidden" name="jobid" value="<?php prt($jobid); ?>" />
        <input type="hidden" name="skillid" value="<?php prt(my_array_value('skillid', $skillsub, 0)); ?>" />
    	<ul class="form-box">
        	<li class="clearfix">
            	<div class="lab">职位名称：</div>
                <div class="inp"><?php prt($jobData['jname']); ?></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">标题：</div>
                <div class="inp"><input type="text" name="sname" class="it" value="<?php prt(my_array_value('sname', $skillsub)); ?>" /></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">说明内容：</div>
                <div class="inp"><textarea name="content" style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('content', $skillsub)); ?></textarea></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">&nbsp;</div>
                <div class="btns"><button type="button" class="btn" name="disabled-buttons" onclick="cUserSKillWrite(this, '<?php prt(_g('uri')->su('user/t/c_job/op/skill_write_save')); ?>', '<?php prt(_g('uri')->referer()); ?>');">提交并保存</button></div>
            </li>
        </ul>
        </form>
    </div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script language="javascript">
var _keditor_b;
KindEditor.ready(function(K) {
	_keditor_b = K.create('textarea[name="content"]', {
		themeType : 'simple',
		cssData:'body{font-size:14px;}',
		resizeType: 1,
		pasteType : 1,
		allowFileManager : false,
		allowImageUpload : false,
		allowFlashUpload : false,
		allowMediaUpload : false,
		allowFileUpload : false,
		afterCreate: function(){ this.sync(); },
        afterBlur: function(){ this.sync(); },
		items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'image', 'link']
	});
});

_GESHAI.placeholder({name: "input[name=\"sname\"]", text: "如: 熟练Excel"});
</script>

<?php include _g('template')->name('@', 'footer', true); ?>