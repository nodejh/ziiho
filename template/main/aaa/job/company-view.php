<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //job-company-view -->
<div class="com-w job-company-view clearfix" id="job-company-view">
	<div class="tit clearfix">
    	<span class="ipic"><img src="<?php prt($CUSER->logo($detailData['logo'])); ?>" /></span>
        <em class="t"><?php prt($detailData['cname']); ?></em>
    </div>
    <div class="line clearfix"></div>
    <div class="hd clearfix"><em class="on">公司简介</em><em>公司职位</em></div>
    <div class="bd clearfix">
    	<div class="t"><?php prt($detailData['cdescription']); ?></div>
        <div class="j">
        	<?php while($rs = _g('db')->result($jobResult)){ ?>
            <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $rs['cuid'] . '/jobid/' . $rs['jobid'])); ?>"><?php prt($JMODEL->sortValue($rs['sortid'], 'sname')); ?></a>
            <?php } ?>
        </div>
    </div>
</div>
<!-- job-company-view// -->
<script language="javascript">
	$("#job-company-view").cjslip({ speed: 0, eventType: 'click', mainEl: '.bd', mainState: '.hd em' });
</script>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>