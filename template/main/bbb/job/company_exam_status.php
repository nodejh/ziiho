<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>
<?php include $a = _g('template')->name('newUI', 'common/fix-header', true); ?>


<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/exam.css" />


</head>

<!-- include navbar  -->
<?php include $a = _g('template')->name('newUI', 'common/navbar', true); ?>

<!-- //answers-area -->
<div class="answers-success clearfix" id="answers-success">
    
    <div class="clearfix message <?php prt(!$isEmpty ? 'message-success' : 'message-error'); ?>">
    	<em class="tt"><?php if(!$isEmpty){ ?>恭喜您，你的答卷已成功提交。<?php }else{ ?>对不起，您当前提交答题的为白卷，故尚未提交。<?php } ?></em>
    </div>
    
    <div class="clearfix nnn">
    	<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="h">返回首页</a><?php if(my_is_array($companyData)){ ?><a href="<?php prt($backUrl); ?>">返回<?php prt($companyData['cname']); ?></a><?php } ?>
    </div>
    
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
function rzExamDo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('uri')->su('job/ac/company/op/exam_do/id/' . $id . '/jobid/' . $jobid)); ?>", {
		/*"goback": "",*/
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "答题提交中..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
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
</script>

<?php include _g('template')->name('@', 'footer', true); ?>