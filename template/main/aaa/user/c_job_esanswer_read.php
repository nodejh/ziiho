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
    <div class="label clearfix">
    	<span class="tit">[<?php prt($JModel->sortValue($jobData['sortid'], 'sname')); ?>]&nbsp;<?php prt($jobData['jname']); ?></span>
    	<a class="add" href="<?php prt(_g('uri')->referer()); ?>">返回</a>
    </div>
    
    <!--//answer-read-->
    <div class="clearfix answer-read">
    	<ul class="clearfix ar-box">
        	<?php 
				$i = 0;
				while($esRs = _g('db')->result($examsubjectResult)){
				$i= $i + 1;
			?>
            <input type="hidden" name="estype[<?php prt($esRs['esid']); ?>]" value="<?php prt($esRs['estype']); ?>" />
            <?php 
            	switch($esRs['estype']){
					case 'radio': ?>
			<li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?>.</div>
                    <div class="nm"><?php prt($esRs['estitle']); ?></div>
                </div>
                
                <div class="clearfix ti">
                	<p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                </div>
            </li>
            
            <?php break;
					case 'checkbox': ?>
            <li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?></div>
                    <div class="nm"><?php prt($esRs['estitle']); ?></div>
                </div>
                
                <div class="clearfix ti">
                	<p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                </div>
            </li>
            
            <?php break;
					case 'input': ?>
			<li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?>.</div>
                    <div class="nm"><?php prt($esRs['estitle']); ?></div>
                </div>
                
                <div class="clearfix ti">
                	<input type="text" class="single-text" />
                </div>
            </li>
            
            <?php break;
					case 'textarea': ?>
            <li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?>.</div>
                    <div class="nm"><?php prt($esRs['estitle']); ?></div>
                </div>
                
                <div class="clearfix ti">
                	<textarea class="multi-text"></textarea>
                </div>
            </li>
            <?php break; } ?>
            <?php } ?>
        </ul>
        
        <div class="clearfix btn-box">
        	<button type="button" class="ok">提交阅卷</button><button type="button" class="fq" onclick="_GESHAI.redirect({url: '<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        </div>
    </div>
    <!--answer-read//-->
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->

<!--//qs-100-->
<textarea class="qs-html" id="i-qs-100">
	<div class="clearfix qs-item"><input type="text" name="esoption[{id}]" class="it" value="{value}" /><a href="javascript:;" class="qs-remove" onclick="_qs_remove(this);">移除</a></div>
</textarea>
<!--qs-100//-->

<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script language="javascript">
_GESHAI.placeholder({name: "input[name=\"estitle\"]", text: "题目标题..."});

_GESHAI.radio({ radioItem: 'span[radio="estype"]', name: "estype", 
	callback: function(i){ 
		var _stypeValue = $('input[name="estype"]').eq(i).val();
		
		if(_stypeValue == 'radio' || _stypeValue == 'checkbox'){
			$("#qs-100").show();
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
	var _textObj = _p.children("input[data=\"value\"]");
	var _textValue = $.trim(_textObj.val());
	_textObj.val("");
	if(_textValue.length < 1){
	   window.top._GESHAI.dialog({isCloseBtn: false, clickBgClose: true, title: "错误：", data: "创建问题选项内容不能为空！"});
	   return null;
	}
	var _html = $("#i-qs-" + $(_this).attr("boxid")).val();
		_html = _html.replace("{id}", "");
	_p.before(_html.replace("{value}", _textValue));
};
function _qs_remove(_this){
	$(_this).parent().remove();
};
function _qs_init(_value){
	if(_value == "100"){
		var _appendObj = $("#qs-100 .qs-create").parent();
		var _html = $("#i-qs-100").val();
		var _str = "";
		<?php foreach(my_array_value('esoption', $examSub) as $optKey => $optVal){ ?>
			_str = _html.replace("{id}", "<?php prt($optKey); ?>");
			_appendObj.before(_str.replace("{value}", "<?php prt(my_addslashes($optVal)); ?>"));
		<?php } ?>
		$("#qs-100").show();
	}
};
_qs_init("<?php prt($JModel->qsTypeGroup(my_array_value('estype', $examSub))); ?>");
</script>

<?php include _g('template')->name('@', 'footer', true); ?>