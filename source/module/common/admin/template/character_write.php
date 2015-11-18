<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<form method="post" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="characterid" value="<?php prt(my_array_value('characterid', $characterRs, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        
        <li class="clearfix is">
            <div class="clearfix tit">排序:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="listorder" value="<?php prt(my_array_value('listorder', $characterRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">名称:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="tname" value="<?php prt(my_array_value('tname', $characterRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">匹配标识:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="charflag" value="<?php prt(my_array_value('charflag', $characterRs)); ?>" />
            </div>
            <div class="clearfix des">与答题选项对应</div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">内容简介:</div>
            <div class="clearfix inp">
                <textarea class="fs-tt" name="content" style="height:280px; visibility:visible;"><?php prt(my_array_value('content', $characterRs)); ?></textarea>
            </div>
        </li>
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
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
				'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'image', 'link']
	});
});

function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/character/op/write_save')); ?>", {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "操作失败";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				urlRedirect('<?php prt(_g('uri')->referer()); ?>');
			}
		}
	});
};
</script>
<!-- javascript// -->