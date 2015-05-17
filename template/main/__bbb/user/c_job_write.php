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
    	<a href="<?php prt(_g('uri')->su('user/t/c_job')); ?>">&laquo;返回</a>
    </div>
    <div class="form-item clearfix">
    	<form method="post" onsubmit="return false;">
        <input type="hidden" name="jobid" value="<?php prt(my_array_value('jobid', $jobSub, 0)); ?>" />
    	<ul class="form-box">
        	<li class="clearfix">
            	<div class="lab">职位类别：</div>
                <div class="inp"><select class="sel" name="jtypeid" id="jtype-data"><option value="0">==请选择==</option></select></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">招聘标题：</div>
                <div class="inp"><input type="text" name="jname" class="it" value="<?php prt(my_array_value('jname', $jobSub)); ?>" /></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">招聘人数：</div>
                <div class="inp"><input type="text" name="pnum" class="it" value="<?php prt(my_array_value('pnum', $jobSub)); ?>" /></div>
            </li>
            <li class="clearfix">
            	<div class="lab">说明内容：</div>
                <div class="inp"><textarea name="content" style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('content', $jobSub)); ?></textarea></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">&nbsp;</div>
                <div class="btns"><button type="button" class="btn" name="disabled-buttons" onclick="cUserJobWrite(this, '<?php prt(_g('uri')->su('user/t/c_job/op/write_save')); ?>', '<?php prt(_g('uri')->su('user/t/c_job')); ?>');">提交并保存</button></div>
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
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/jtype.js"></script>
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

_GESHAI.placeholder({name: "input[name=\"jname\"]", text: "如: JAVA工程师"});
_GESHAI.placeholder({name: "input[name=\"pnum\"]", text: "如: 1~20人"});

function _jtypeDataAppend(__jtypeid){
	var _jtypeObj = document.getElementById("jtype-data");
	var _jtypeParent = [];
	for(var __i = 0; __i < _CACHE_job_jtype.length; __i++){
		if(_CACHE_job_jtype[__i].parentid < 1){
			_jtypeParent.push(_CACHE_job_jtype[__i]);
		}
	}
	var _htmlStr = "";
	for(var __i = 0; __i < _jtypeParent.length; __i++){
		_htmlStr = "<optgroup label=\"" + _jtypeParent[__i].jtname + "\">"
		for(var __j = 0; __j < _CACHE_job_jtype.length; __j++){
			if(_jtypeParent[__i].id == _CACHE_job_jtype[__j].parentid){
				_htmlStr += "<option value=\"" + _CACHE_job_jtype[__j].id + "\" " + (_CACHE_job_jtype[__j].id == __jtypeid ? "selected=\"selected\"" : "") + ">" + _CACHE_job_jtype[__j].jtname + "</option>";
			}
		}
		$(_jtypeObj).append(_htmlStr + "</optgroup>");
	}
};
_jtypeDataAppend("<?php prt(my_array_value('jtypeid', $jobSub)); ?>");
</script>

<?php include _g('template')->name('@', 'footer', true); ?>