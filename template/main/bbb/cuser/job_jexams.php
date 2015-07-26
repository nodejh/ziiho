<?php if (!defined('IN_GESHAI')) {
    exit('no direct access allowed');
} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/user.js"/>


    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('cuser', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix o-right">
    <h2 class="o-title-small">[<?php prt($JModel->sortValue($jobData['sortid'], 'sname')); ?>]&nbsp;<?php prt($jobData['jname']); ?><a href="<?php prt(_g('uri')->su('user/ac/job/op/jexams_write/jobid/' . $jobid)); ?>">
            <button class="o-button o-button-info o-title-tips">+添加测试题目</button>
        </a></h2>
    
    <div class="light">
    	<p class="t1">提示：</p>
        <p class="t2"><em>•</em>建议在添加“测试题”时，请先关闭对应的职位信息，再开启职位信息。</p>
        <p class="t2"><em>•</em>当“求职者”认证测试，提交答卷后系统会自动进行阅卷，如果通过者会颁发一个该职位的“认证证书”。</p>
        <p class="t2"><em>•</em>测试题满分为100分，每道题的分值为题目总数的平均值，答题限时位30分钟。</p>
    </div>
    
    <div class="tttc">共有<em><?php prt($pageData['total']); ?></em>题目</div>

    <?php if($pageData['total'] >= 1) { ?>
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="form-jexams-post">
        <input type="hidden" name="esid" value="" />
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="50%">题目</td>
                <td width="20%">题型</td>
                <td width="30%">操作</td>
            </tr>
            <?php while($esRs = _g('db')->result($examsubjectResult)): ?>
            <tr class="trow-bline trow-hover" >
                <td width="50%"><?php prt($esRs['estitle']); ?></td>
                <td width="20%" class="cb"><?php prt($JModel->qsType($esRs['estype'], 'subname')); ?></td>
                <td width="30%" class="ops"><a href="<?php prt(_g('uri')->su('user/ac/job/op/jexams_write/jobid/' . $jobid . '/esid/' . $esRs['esid'])); ?>">修改</a><a href="javascript:;" onclick="cUserJexamDelete(this, '<?php prt(_g('uri')->su('user/ac/job/op/jexams_delete')); ?>');" data-id="<?php prt($esRs['esid']); ?>">删除</a></td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>
    <?php }else{ ?>
        <div class="clearfix yes_empty">暂无内容信息~</div>
    <?php } ?>
    <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('user', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">

</script>

<?php include _g('template')->name('@', 'footer', true); ?>