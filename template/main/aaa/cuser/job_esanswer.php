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
    	<a class="add" href="<?php prt($goBack); ?>">返回</a>
    </div>
    <div class="tttc">已有<em><?php prt($pageData['total']); ?></em>人答卷</div>
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="form-jexams-post">
        <input type="hidden" name="esid" value="" />
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="30%">答卷者</td>
                <td width="20%">答卷时间</td>
                <td width="50%">操作</td>
            </tr>
            <?php 
				if($pageData['total'] >= 1) { 
            	while($esaRs = _g('db')->result($JAnswerResult)){
			 ?>
            <tr class="trow-bline trow-hover" >
                <td width="30%"><?php prt(_g('value')->username($_USER->find_jion('a.uid', $esaRs['uid']))); ?></td>
                <td width="20%" class="cb"><?php prt(person_time($esaRs['ctime'])); ?></td>
                <td width="50%" class="ops"><a href="<?php prt(_g('uri')->su('user/ac/job/op/esanswer_read/answerid/' . $esaRs['answerid'])); ?>">查看答卷</a><!--<a href="javascript:;" onclick="cUserSKillDelete(this, '<?php prt(_g('uri')->su('user/ac/job/op/skill_delete')); ?>');" data-id="<?php prt($esaRs['esid']); ?>">删除</a>--></td>
            </tr>
            <?php }; ?>
            <?php }else{ ?>
            <tr class="trow-bline trow-hover" >
            	<td width="100%" colspan="3">暂无答卷内容信息</td>
            </tr>
            <?php } ?>
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