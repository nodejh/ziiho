<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<style type="text/css">
.qs-item { line-height:32px; margin-top:5px; }
	.qs-item .qs-create { margin:0px 5px; color:#0263ad; }
	.qs-item .qs-create:hover { text-decoration:underline; color:#F00; }
	
	.qs-item .qs-remove { margin:0px 5px; color:#F00; }
	.qs-item .qs-remove:hover { text-decoration:underline; color:#F00; }
	
.qs-html { position:absolute; left:0px; top:-100px; width:0px; height:0px; overflow:hidden; }
</style>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php include _g('template')->name('cuser', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
	<div class="label">
    	<a href="<?php prt(_g('uri')->referer()); ?>">&laquo;返回</a>
    </div>
    
    <div class="light">
    	<p class="t1">提示：</p>
        <p class="t2"><em>•</em>建议在添加“测试题”时，请先“关闭”对应的职位信息，再“开启”职位信息。</p>
        <p class="t2"><em>•</em>添加“测题”成功后，为了确保数据一致，将不能对其“题目选项”进行“移除”操作</p>
        <p class="t2"><em>•</em>若要对其“题目选项”进行“移除”操作，可返回管理界面对该题进行“删除”</p>
    </div>
    
    <div class="form-item clearfix">
    	<form method="post" onsubmit="return false;">
        <input type="hidden" name="jobid" value="<?php prt($jobid); ?>" />
        <input type="hidden" name="esid" value="<?php prt(my_array_value('esid', $examSub, 0)); ?>" />
    	<ul class="form-box">
        	<li class="clearfix">
            	<div class="lab">职位名称：</div>
                <div class="inp"><?php prt($jobData['jname']); ?></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">题目：</div>
                <div class="inp"><input type="text" name="estitle" class="it" value="<?php prt(my_array_value('estitle', $examSub)); ?>" /></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">题型：</div>
                <div class="inp">
                	<?php foreach($JModel->qsType() as $k=>$v){ ?>
                	<span radio="estype" style="margin-right:10px; cursor:pointer;"><input type="radio" name="estype" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('estype', $examSub)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                    <?php } ?>
                </div>
            </li>
            
            <!--//qs-100-->
            <li class="clearfix" id="qs-100" style="display:none;">
            	<div class="lab">题目选项：</div>
                <div class="clearfix inp" flag="qsbox">
                	<div class="clearfix qs-item">
                		<span class="icc icc-icon" title="勾选此项，将作为题目的正确答案。"><input type="checkbox" name="_answer_flag_a" value="checked='checked'" /></span><input type="text" class="it" data="value" /><a href="javascript:;" class="qs-create" boxid="100">创建</a>
                	</div>
                </div>
            </li>
            <!--qs-100//-->
            
            <li class="clearfix">
            	<div class="lab">&nbsp;</div>
                <div class="btns"><button type="button" class="btn" name="disabled-buttons" onclick="cUserExamSubjectWrite(this, '<?php prt(_g('uri')->su('user/ac/job/op/jexams_write_save')); ?>', '<?php prt(_g('uri')->referer()); ?>');">提交</button></div>
            </li>
        </ul>
        </form>
    </div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->

<!--//qs-100-->
<textarea class="qs-html" id="i-qs-100">
	<div class="clearfix qs-item"><span class="icc"><input type="{type}" name="answer_flag[]" value="{id}" {ck} /></span><input type="text" name="esoption[{id}]" class="it" value="{value}" /><a href="javascript:;" class="qs-remove" onclick="_qs_remove(this);">移除</a></div>
</textarea>
<!--qs-100//-->

<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script language="javascript">
var __oldEsType = "<?php prt(my_array_value('estype', $examSub)); ?>";
_GESHAI.placeholder({name: "input[name=\"estitle\"]", text: "题目标题..."});

_GESHAI.radio({ radioItem: 'span[radio="estype"]', name: "estype", 
	callback: function(i){ 
		var _stypeValue = $('input[name="estype"]').eq(i).val();
		if(_stypeValue == 'radio' || _stypeValue == 'checkbox'){
			$("#qs-100").show();
			if(__oldEsType != _stypeValue){
				__oldEsType = _stypeValue;
				$("input[name=\"answer_flag[]\"]").each(function(index, element) {
                    $(this).parent().html("<input type=\"" + _stypeValue + "\" name=\"answer_flag[]\" value=\"" + $(this).val() + "\" />");
                });
			}
		}else if(_stypeValue == 'input' || _stypeValue == 'textarea'){
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
	var _textObj = _p.find("input[data=\"value\"]");
	var _textValue = $.trim(_textObj.val());
	_textObj.val("");
	if(_textValue.length < 1){
	   window.top._GESHAI.dialog({isCloseBtn: false, clickBgClose: true, title: "错误：", data: "创建问题选项内容不能为空！"});
	   return null;
	}
	var _isChked = window._GESHAI.rchecked("_answer_flag_a");
	var _rd = window._GESHAI.randstr(10);
	
	/* 新增时，清除单选项之前的选项 */
	if(typeof(_isChked) != "undefined") {
		var _clearCked = document.getElementsByName("answer_flag[]");
		for(var i = 0; i < _clearCked.length; i++){
			_clearCked.item(i).checked = "";
		}
	}
	/* 新增选项 */
	var _html = $("#i-qs-" + $(_this).attr("boxid")).val();
		_html = _html.replace(/\{id\}/g, _rd);
		_html = _html.replace("{type}", __oldEsType);
		_html = _html.replace("{ck}", _isChked);
	_p.before(_html.replace("{value}", _textValue));
	
	$("input[name=\"_answer_flag_a\"]").attr("checked", "");
};
function _qs_remove(_this){
	window.top._GESHAI.dialog({
			"title": "删除操作",
			"data": "<p>移除该选项将会影响“认证测试”情况，您确定要移除吗？<p>如果是请点击“确定”，则点击“取消”按钮</p>",
			"isCloseBtn": false,
			"isCancelBtn": true,
			"okBtnFunc" : function(){
				$(_this).parent().remove();
				window.top._GESHAI.dialog.close();
			}
	});
};
function _qs_init(_value){
	var __defData = <?php prt(array2json(my_array_value('esoption', $examSub))); ?>;
	var __answerData = <?php prt(array2json(my_array_value('esanswer', $examSub))); ?>;
	if(_value == "100"){
		var _appendObj = $("#qs-100 .qs-create").parent();
		var _html = $("#i-qs-100").val();
		var _str = "";
		
		for(var k in __defData) {
			_str = _html.replace(/\{id\}/g, k);
			_str = _str.replace("{type}", __oldEsType);
			_str = _str.replace("{ck}", (_GESHAI.in_array(k, __answerData) ? "checked=\"checked\"" : ""));
			_appendObj.before(_str.replace("{value}", __defData[k].name));
		};
		
		$("#qs-100").show();
	}
};
_qs_init("<?php prt($JModel->qsTypeGroup(my_array_value('estype', $examSub))); ?>");
</script>

<?php include _g('template')->name('@', 'footer', true); ?>