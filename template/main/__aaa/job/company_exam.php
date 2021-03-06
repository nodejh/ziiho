<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/exam.css" />

<!-- //answers-area -->
<div class="answers-area clearfix" id="answers-area">
	<!-- //txm -->
    <div class="txm clearfix">
    	<span>共<em class="tss"><?php prt($pageData['total']); ?></em>题,满分<em class="tss">100</em>分,合格<em class="tss">60</em>分;</span>&nbsp;&nbsp;<span>限时<em class="tss"><?php prt($jobData['examtime']); ?></em>分钟;</span>&nbsp;&nbsp;<span class="at">剩余<em class="ut" flag="activetime_m">00</em>分<em class="ut" flag="activetime_s">00</em>秒</span>
    </div>
    <!-- //txm -->
    	
    <!-- //pos-box -->
    <div class="pos-box clearfix">
    	<em class="f1">当前位置:</em>
    	<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>">首页</a>
        <em class="f2">&raquo;</em>
        <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $id)); ?>"><?php prt($cUserData['cname']); ?></a>
        <em class="f2">&raquo;</em>
        <a href="<?php prt($backUrl); ?>"><?php prt($JMODEL->sortValue($jobData['sortid'], 'sname')); ?></a>
        <em class="f2">&raquo;</em>
        <em class="f3"><?php prt($jobData['jname']); ?></em>
    </div>
    <!-- pos-box// -->
    
    <!-- //des-box -->
    <div class="des-box clearfix">
    	<p class="ln">温馨提示:</p>
        <p class="tx"><em>•</em>若你的本次答题分数未合格，将会限制在24小时后，可再次重新答题。</p>
        <p class="tx"><em>•</em>您的答题分数，将会影响你的求职成果，分数越高求职机会越多...</p>
        <p class="tx"><em>•</em>提交答题后，若测试合格，系统会自动颁发于你“职位认证书”。</p>
        <p class="tx"><em>•</em>答题时间到，系统将自动提交答题内容。</p>
    </div>
    <!-- des-box// -->
    
    <form method="post" onsubmit="return false;" id="examForm">
    <input type="hidden" name="isauto" value="false" />
    <!-- //item-box -->
    <div class="item-box clearfix">
    	<ul class="is">
        	
            <?php 
				$i = 0;
				while($esRs = _g('db')->result($examsubjectResult)){
				$i= $i + 1;
			?>
            <input type="hidden" name="estype[<?php prt($esRs['esid']); ?>]" value="<?php prt($esRs['estype']); ?>" />
            <?php 
            	switch($esRs['estype']){
					case 'radio': ?>
        	<li class="clearfix" dataid="<?php prt($esRs['esid']); ?>">
            	<div class="tit clearfix">
                	<div class="hh"><?php prt($i); ?>.</div>
                    <div class="tt"><?php prt($esRs['estitle']); ?></div>
                </div>
                <div class="opts clearfix">
                	<?php $order = 0; ?>
                	<?php foreach($JMODEL->qsOptionDe($esRs['esoption']) as $optKey => $optVal){ ?>
                	<p class="h" radio="esoption[<?php prt($esRs['esid']); ?>][]"><input type="radio" name="esoption[<?php prt($esRs['esid']); ?>][]" value="<?php prt($optKey); ?>" /><?php prt($JMODEL->qsOptionOrder($order)); ?>.&nbsp;<?php prt($optVal); ?></p>
                    <?php $order = $order + 1; ?>
                    <?php } ?>
                    <script language="javascript">
                    	_GESHAI.radio({ radioItem: 'p[radio="esoption[<?php prt($esRs['esid']); ?>][]"]', name: "esoption[<?php prt($esRs['esid']); ?>][]" });
                    </script>
                </div>
            </li>
            <?php break;
					case 'checkbox': ?>
        	<li class="clearfix" dataid="<?php prt($esRs['esid']); ?>">
            	<div class="tit clearfix">
                	<div class="hh"><?php prt($i); ?>.</div>
                    <div class="tt"><?php prt($esRs['estitle']); ?></div>
                </div>
                <div class="opts clearfix">
                	<?php $order = 0; ?>
                	<?php foreach($JMODEL->qsOptionDe($esRs['esoption']) as $optKey => $optVal){ ?>
                	<p class="h" checkbox="esoption[<?php prt($esRs['esid']); ?>][]"><input type="checkbox" name="esoption[<?php prt($esRs['esid']); ?>][]" value="<?php prt($optKey); ?>" /><?php prt($JMODEL->qsOptionOrder($order)); ?>.&nbsp;<?php prt($optVal); ?></p>
                    <?php $order = $order + 1; ?>
                    <?php } ?>
                    <script language="javascript">
                    	_GESHAI.checkbox({ checkboxItem: 'p[checkbox="esoption[<?php prt($esRs['esid']); ?>][]"]', name: "esoption[<?php prt($esRs['esid']); ?>][]" });
                    </script>
                </div>
            </li>
            <?php break;
					case 'input': ?>
        	<li class="clearfix" dataid="<?php prt($esRs['esid']); ?>">
            	<div class="tit clearfix">
                	<div class="hh"><?php prt($i); ?>.</div>
                    <div class="tt"><?php prt($esRs['estitle']); ?></div>
                </div>
                <div class="opts clearfix">
                	<input class="single-text" type="text" name="esoption[<?php prt($esRs['esid']); ?>]" />
                </div>
            </li>
            <?php break;
					case 'textarea': ?>
            <li class="clearfix" dataid="<?php prt($esRs['esid']); ?>">
            	<div class="tit clearfix">
                	<div class="hh"><?php prt($i); ?>.</div>
                    <div class="tt"><?php prt($esRs['estitle']); ?></div>
                </div>
                <div class="opts clearfix">
                	<textarea class="multi-text" name="esoption[<?php prt($esRs['esid']); ?>]"></textarea>
                </div>
            </li>
            <?php break; } ?>
            <?php } ?>
            
        </ul>
    </div>
    <!-- item-box// -->
    
    <!-- //btn-box -->
    <div class="btn-box clearfix">
    	<button type="button" name="disabled-buttons" class="ok" onclick="rzExamDo(this, 'false');" id="exam-ok">提交答题</button><button type="button" name="disabled-buttons" class="fq" onclick="fqExam();">放弃答题</button>
    </div>
    <!-- btn-box// -->
    </form>
    
</div>
<div class="clear"></div>
<!-- answers-area// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
var _areaBox = $("#answers-area");
var _areaBoxTxm = _areaBox.find(".txm");
$(window).scroll(function(e) {
	var _st = $(this).scrollTop();
    if(_st >= 62){
		_areaBoxTxm.css("top", "0px");
	}else{
		_areaBoxTxm.css("top", (62 - _st) + "px");
	}
});

var __examListBox = $("#answers-area .item-box ul.is");
__examListBox.find("li").click(function(e){
	$(this).removeClass("light");
});

var __examForm = document.getElementById("examForm");
var __examTime = parseInt("<?php prt($jobData['examtime']); ?>");
var __examTimerFlag;
var __examTimerNow = __examTime;
var __examBox = $("#answers-area");
var __examTimerBox = $("#answers-area span.at");
var __examTimerBox_m = $("#answers-area em[flag=\"activetime_m\"]");
var __examTimerBox_s = $("#answers-area em[flag=\"activetime_s\"]");
function examChk(_time){
	__examTimerNow = _time;
	
	if(_time < 1){
		__examTimerBox.html("<em class=\"ut\">答题时间到,自动提交中...</em>");
		
		return rzExamDo(document.getElementById("exam-ok"), "true");
	}else{
		var _s = _time % 60;
		var _m = (_time - _s) / 60;
		
		var _sStr = (_s < 10 ? ("0" + _s) : _s);
		var _mStr = (_m < 10 ? ("0" + _m) : _m);
		
		__examTimerBox_s.html(_sStr);
		__examTimerBox_m.html(_mStr);
	}
	__examTimerFlag = setTimeout(function(){
		clearTimeout(__examTimerFlag);
		examChk(_time - 1);
	}, 1000);
};
examChk(__examTime * 60);

function rzExamDo(_this, _isauto){
	clearTimeout(__examTimerFlag);
	if(__examForm.isauto.value == "true"){
		return false;
	}
	__examForm.isauto.value = _isauto;
	
	var __doFunc = function(){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('uri')->su('job/ac/company/op/exam_do/id/' . $id . '/jobid/' . $jobid)); ?>", {
			/*"goback": "",*/
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "答题提交中..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				if(d.status != 1){
					examChk(__examTimerNow);
					
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
					
					/* 未填写的题目 */
					if(d.emptyData){
						var __isFalg = false;
						for(var i = 0; i < d.emptyData.length; i++){
							__examListBox.find("li[dataid=\"" + d.emptyData[i] + "\"]").addClass("light");
							__isFalg = true;
						}
						if(__isFalg){
							var _st = Math.max(parseInt(__examListBox.find("li[dataid=\"" + d.emptyData[0] + "\"]").offset().top) - 20, 0);
							$('body,html').stop(true, true).animate({"scrollTop": _st}, 500);
						}
					}
				}else if(d.status == 1){
					window.top._GESHAI.dialog.close();
					_GESHAI.redirect(d);
				}
			}
		});
	};
	
	if(_isauto != "true"){
		window.top._GESHAI.dialog({
			title: "温馨提示：",
			data: "<p>您确定要提交本次的答题吗？</p>",
			isCloseBtn: false,
			isCancelBtn: true,
			cancelBtnFunc: function(){
				window.top._GESHAI.dialog.close();
				examChk(__examTimerNow);
			},
			okBtnFunc: function(){
				return __doFunc();
			}
		});
	}else{
		return __doFunc();
	}
};
function fqExam(){
	clearTimeout(__examTimerFlag);
	window.top._GESHAI.dialog({
		title: "放弃答题", 
		data: "你的本次答题内容将不被保存，你确定要“放弃答题”吗？", 
		okBtnTitle: "是",
		cancelBtnTitle: "否",
		isCancelBtn: true,
		isCloseBtn: false,
		cancelBtnFunc: function(){
			window.top._GESHAI.dialog.close();
			examChk(__examTimerNow);
		},
		okBtnFunc: function(){
			window.top._GESHAI.redirect({url: "<?php prt($backUrl); ?>"});
		}
	});
};
</script>

<?php include _g('template')->name('@', 'footer', true); ?>