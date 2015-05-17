<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //job-company-step -->
<div class="com-w job-company-step clearfix" id="job-company-step">
	<div class="tit clearfix">
    	<a href="<?php prt(_g('uri')->su('job/ac/company')); ?>" class="h">首页</a><em>></em>
        <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . _get('id'))); ?>"><?php prt($cUserData['cname']); ?></a><em>></em><strong><?php prt($jobData['jname']); ?></strong>
    </div>
    
    <div class="nnn clearfix">培训方案：<strong><?php prt($JMODEL->sortValue($jobData['sortid'], 'sname')); ?></strong></div>
    
    <!-- //steps -->
    <div class="steps clearfix">
        <?php $fflag = false; ?>
        <?php while($skRs = _g('db')->result($skillResult)){ ?>
        <div class="taaa <?php prt(!$fflag ? '' : 'taaa-bt'); ?> clearfix"><span><?php prt($skRs['sname']); ?></span><a href="javascript:;">展开</a></div>
        <div class="tbbb clearfix">
            <div class="tarea clearfix">
                <?php prt($skRs['content']); ?>
            </div>
        </div>
        <?php $fflag = true; ?>
        <?php } ?>
        <?php if(!$fflag){ ?>
        <div class="clearfix empty">对不起，该职位暂未添加学习方案。</div>
        <?php } ?>
    </div>
    <!-- steps// -->
    
    <div class="nns clearfix">
    	<a href="<?php prt(_g('uri')->su('job/ac/material')); ?>">学习资料</a>
    	<a href="<?php prt(_g('uri')->su('job/ac/company/op/jobrz/id/' . _get('id') . '/jobid/' . $jobid)); ?>">提递简历</a>
        <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . _get('id') . '/jobid/' . $jobid)); ?>">返回</a>
    </div>
</div>
<!-- job-company-step// -->
<script language="javascript">
	$("#job-company-step .steps").cjslip({mainEl: '.tbbb', mainState: '.taaa a', mainCur: true, curOff: true, defaultShow: false, eventType:"click", effect:'slideDown', speed:350, completeFunc: function(index, total, page, pageTotal, mainState, pageState, scrollEl, mainEl){
		
		mainState.not(":eq(" + index + ")").parent().children("span").removeClass("on");
		mainState.eq(index).parent().children("span").addClass("on");
		
		mainState.not(":eq(" + index + ")").html("展开");
		mainState.eq(index).html(mainEl.eq(index).is(":hidden") ? "展开" : "关闭");
	}
	});
</script>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>