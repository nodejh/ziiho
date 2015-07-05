<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //job-company-job -->
<div class="com-w job-company-job clearfix" id="job-company-job">
	<div class="tit clearfix">
    	<span class="ipic"><img src="<?php prt($CUSER->logo($cUserData['logo'])); ?>" /></span>
        <em class="t"><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . _get('id'))); ?>"><?php prt($cUserData['cname']); ?></a> - [<?php prt($jsortData['sname']); ?>]<strong><?php prt($jobData['jname']); ?></strong></em>
    </div>
    <div class="line clearfix"></div>
    <div class="hd clearfix"><em class="on">职位描述</em><em>公司介绍</em></div>
    <div class="bd clearfix">
    	<div class="t"><?php prt($jobData['content']); ?></div>
        <div class="j"><?php prt($cUserData['cdescription']); ?></div>
    </div>
    
    <div class="nns clearfix">
    	<a href="<?php prt(_g('uri')->su('job/ac/company/op/jobstep/id/' . _get('id') . '/jobid/' . $jobid)); ?>">学习方案</a>
        <a href="<?php prt(_g('uri')->su('job/ac/material')); ?>">学习资料</a>
        <?php if($MYAUTH->is($jobid)){ ?>
        	<a href="javascript:;" onclick="_GESHAI.dialog({ clickBgClose: true, title: '温馨提醒', data: '该功能正在研发中...' });">提递简历</a>
        <?php }else{ ?>
        	<a href="<?php prt(_g('uri')->su('job/ac/company/op/jobrz/id/' . _get('id') . '/jobid/' . $jobid)); ?>">我要认证</a>
        <?php } ?>
    </div>
</div>
<!-- job-company-job// -->
<script language="javascript">
	$("#job-company-job").cjslip({ speed: 0, eventType: 'click', mainEl: '.bd', mainState: '.hd em' });
</script>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>