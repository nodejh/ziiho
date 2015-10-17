<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php include _g('template')->name('cuser', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
	<div class="label clearfix">
    	<span class="tit">[<?php prt($JModel->sortValue($jobData['sortid'], 'sname')); ?>]&nbsp;<?php prt($jobData['jname']); ?></span>
    	<a class="add" href="<?php prt(_g('uri')->su('user/ac/job/op/skill_write/jobid/' . $jobid)); ?>">+添加学习方案</a>
    </div>
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="form-skill-post">
        <input type="hidden" name="skillid" value="" />
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="50%">标题</td>
                <td width="30%">&nbsp;</td>
                <td width="20%">操作</td>
            </tr>
            
            <?php while($skRs = _g('db')->result($skillResult)): ?>
            <tr class="trow-bline trow-hover" >
                <td width="50%"><?php prt($skRs['sname']); ?></td>
                <td width="30%" class="cb">&nbsp;</td>
                <td width="20%" class="ops"><a href="<?php prt(_g('uri')->su('user/ac/job/op/skill_write/jobid/' . $jobid . '/skillid/' . $skRs['skillid'])); ?>">修改</a><a href="javascript:;" onclick="cUserSKillDelete(this, '<?php prt(_g('uri')->su('user/ac/job/op/skill_delete')); ?>');" data-id="<?php prt($skRs['skillid']); ?>">删除</a></td>
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