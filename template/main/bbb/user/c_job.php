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
    	<a href="<?php prt(_g('uri')->su('user/t/c_job/op/write')); ?>">+发布职位</a>
    </div>
    
    <div class="light">
    	<p class="t1">提示：</p>
        <p class="t2"><em>•</em>若需对发布的职位进行“认证测试”，建议在添加“测试题”时，请先关闭对应的职位信息，再开启职位信息。</p>
    </div>
    
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="form-job-post">
        <input type="hidden" name="jobid" value="" />
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="30%">标题</td>
                <td width="25%">职位分类</td>
                <td width="15%">招聘人数</td>
                <td width="30%">操作</td>
            </tr>
            
            <?php while($jRs = _g('db')->result($JJResult)): ?>
            <tr class="trow-bline trow-hover" >
                <td width="30%"><?php prt($jRs['jname']); ?></td>
                <td width="25%"><?php prt($JModel->sortValue($jRs['sortid'], 'sname')); ?></td>
                <td width="15%"><?php prt($jRs['pnum']); ?>人</td>
                <td width="30%" class="ops"><a href="<?php prt(_g('uri')->su('user/t/c_job/op/jexams/jobid/' . $jRs['jobid'])); ?>">测题管理</a><a href="<?php prt(_g('uri')->su('user/t/c_job/op/esanswer/jobid/' . $jRs['jobid'])); ?>">答卷管理</a><a href="<?php prt(_g('uri')->su('user/t/c_job/op/skill/jobid/' . $jRs['jobid'])); ?>">方案</a><a href="<?php prt(_g('uri')->su('user/t/c_job/op/write/jobid/' . $jRs['jobid'])); ?>">修改</a><a href="javascript:;" onclick="cUserJobDelete(this, '<?php prt(_g('uri')->su('user/t/c_job/op/delete')); ?>');" data-id="<?php prt($jRs['jobid']); ?>">删除</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">

</script>

<?php include _g('template')->name('@', 'footer', true); ?>