<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<style type="text/css">
.qs-item { line-height:32px; margin-left:20px; }
	.qs-item .qs-create { margin:0px 5px; color:#0263ad; }
	.qs-item .qs-create:hover { text-decoration:underline; color:#F00; }
	
	.qs-item .qs-remove { margin:0px 5px; color:#F00; }
	.qs-item .qs-remove:hover { text-decoration:underline; color:#F00; }
	
.qs-html { position:absolute; left:0px; top:-100px; width:0px; height:0px; overflow:hidden; }
</style>

<form method="post" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="qsid" value="<?php prt(my_array_value('qsid', $qSubjectRs, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">启用:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $qSubjectRs, 1)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
    	
        <li class="clearfix is">
            <div class="clearfix tit">排序:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="listorder" value="<?php prt(my_array_value('listorder', $qSubjectRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">问题:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="title" value="<?php prt(my_array_value('title', $qSubjectRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">题型:</div>
            <div class="clearfix inp">
                <?php foreach($JMODEL->qsType() as $k=>$v){ ?>
                <span class="ck-mr" radio="stype"><input type="radio" name="stype" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('stype', $qSubjectRs)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
        
        <!--//qs-100-->
        <li class="clearfix is" id="qs-100" style="display:none;">
            <div class="clearfix tit">问题选项:</div>
            
            <div class="clearfix inp" flag="qsbox">
                <div class="clearfix qs-item">
                	<input type="checkbox" data="answer" value="checked='checked'" title="作为答案" /><input type="text" class="fs-ts-200" data="value" /><a href="javascript:;" class="qs-create" boxid="100">创建</a>
                </div>
            </div>
        </li>
        <!--qs-100//-->
        
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt($gobackUrl); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!--//qs-100-->
<textarea class="qs-html" id="i-qs-100">
	<div class="clearfix qs-item"><span flag="isanswer" idn="{id}"><input type="{type}" name="answer[]" _flag="answer" {checked} value="{id}" /></span><input type="text" name="option[{id}]" _flag="qsname" class="fs-ts-200" value="{value}" /><a href="javascript:;" class="qs-remove" onclick="_qs_remove(this);">移除</a></div>
</textarea>
<!--qs-100//-->

<!-- //javascript -->
<script language="javascript">
var _stypeValue = "<?php prt(my_array_value('stype', $qSubjectRs)); ?>";
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status"});
_GESHAI.radio({ radioItem: 'span[radio="stype"]', name: "stype", 
	callback: function(i){ 
		var _nType = $('input[name="stype"]').eq(i).val();
		if(_nType == _stypeValue){
			return null;
		}else{
			_stypeValue = _nType;
		}
		if(_nType == 'radio' || _nType == 'checkbox'){
			$("div[flag=\"qsbox\"] .qs-item span[flag=\"isanswer\"]").each(function(index, element) {
				var _html = "<input type=\"" + _nType + "\" name=\"answer[]\" _flag=\"answer\" value=\"" + $(this).attr("idn") + "\" />";
                $(this).html(_html);
					
            });
			$("#qs-100").show();
		}else if(_nType == 'input' || _nType == 'textarea'){
			$("#qs-100").hide();
		}
	 } 
});

/* create */
$("div[flag=\"qsbox\"] .qs-create").click(function(e) {
   _qs_create(this);
});
function _qs_create(_this){
	var _p = $(_this).parent();
	var _answerVal = _p.find("input[data=\"answer\"]:checked").val();
	var _textObj = _p.find("input[data=\"value\"]");
	var _textValue = $.trim(_textObj.val());
		_textObj.val("");
		
	if(_textValue.length < 1){
	   window.top._GESHAI.dialog({isCloseBtn: false, clickBgClose: true, title: "错误：", data: "创建问题选项内容不能为空！"});
	   return null;
	}
	var _rd = window._GESHAI.randstr(10);
	
	var _html = $("#i-qs-" + $(_this).attr("boxid")).val();
		if(!_GESHAI.is_empty(_answerVal)){
			if(_stypeValue == "radio"){
				$("div[flag=\"qsbox\"] .qs-item input[_flag=\"answer\"]:checked").attr("checked", "");
			}
			_html = _html.replace("{checked}", "checked=\"checked\"");
		}
		_html = _html.replace("{type}", _stypeValue);
		_html = _html.replace(/\{id\}/gi, _rd);
		
		_textValue = _textValue.replace(/\"/gi, "&quot;");
		_textValue = _textValue.replace(/\>/gi, "&gt;");
		_textValue = _textValue.replace(/\</gi, "&lt;");
		
	_p.before(_html.replace("{value}", _textValue));
	
	/* 取消当前勾选 */
	$("input[data=\"answer\"]").attr("checked", "");
};
function _qs_remove(_this){
	window.top._GESHAI.dialog({
			"title": "移除提醒：",
			"data": "<p><strong>" + ($(_this).parent().find("input[_flag=\"qsname\"]").val()) + "</strong></p><p>你确定要将其移除吗？</p>",
			"isCloseBtn": false,
			"isCancelBtn": true,
			"okBtnFunc" : function(){
				$(_this).parent().remove();
				window.top._GESHAI.dialog.close();
			}
		});
};
function _qs_init(_value){
	var __defData = <?php prt(array2json(my_array_value('option', $qSubjectRs)));?>;
	var __defAnswer = <?php prt(array2json(str2array(my_array_value('answer', $qSubjectRs))));?>;
	
	if(_value == "radio" || _value == "checkbox"){
		var _appendObj = $("#qs-100 .qs-create").parent();
		var _html = $("#i-qs-100").val();
		var _str = "";
		
		for(var k in __defData) {
			_str = "";
			_str = _html.replace("{type}", _value);
			_str = _str.replace("{checked}", (_GESHAI.in_array(k, __defAnswer) ? "checked=\"checked\"" : ""));
			_str = _str.replace(/\{id\}/gi, k);
			_appendObj.before(_str.replace("{value}", __defData[k].name));
		}
		<?php foreach(my_array_value('option', $qSubjectRs) as $optKey => $optVal){ ?>
			/*_str = _html.replace("{id}", "<?php prt($optKey); ?>");
			_appendObj.before(_str.replace("{value}", "<?php prt(my_addslashes($optVal)); ?>"));*/
		<?php } ?>
		$("#qs-100").show();
	}
};
/* submit */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/qsubject/f/write_save/sortid/' . $sortid . '/questionid/' . $questionid)); ?>", {
		"goback": "<?php prt($gobackUrl); ?>",
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
				_GESHAI.redirect(d);
			}
		}
	});
};
/* init */
_qs_init(_stypeValue);
</script>
<!-- javascript// -->