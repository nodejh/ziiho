<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<script type="text/javascript" src="<?php prt(_g('template')->dir('resume')); ?>/js/resume.js"></script>

<!-- //cuser_center -->
<div class="cuser_center clearfix o-main" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix o-left">
	<?php include _g('template')->name('user', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix o-right">
	<div class="label">
    	<a href="<?php prt($writeUrl); ?>">+创建简历</a>
    </div>
    
    <div class="light">
    	<p class="t1">提示：</p>
        <p class="t2"><em>•</em>请认真属实填写“简历信息”，一份属实的简历可增大求职几率。</p>
    </div>
    
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="m_resume_form" del="<?php prt($delUrl); ?>">
        <input type="hidden" name="resumeid" value="" />
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="20%">标题</td>
                <td width="15%">创建时间</td>
                <td width="15%">更新时间</td>
                <td width="15%">&nbsp;</td>
                <td width="5%">预览</td>
                <td width="30%">操作</td>
            </tr>
            
            <?php if($pageData['total'] >= 1){ ?>
            <?php while($rRs = _g('db')->result($resumeResult)): ?>
            <tr class="trow-bline trow-hover" >
                <td width="20%" id="rname_<?php prt($rRs['resumeid'])?>"><?php prt($rRs['rname']); ?></td>
                <td width="15%"><?php prt(person_time($rRs['ctime'])); ?></td>
                <td width="15%"><?php prt($rRs['ctime'] == $rRs['mtime'] ? '-' : person_time($rRs['mtime'])); ?></td>
                <td width="15%">&nbsp;</td>
                <td width="5%"><a href="<?php prt(_g('uri')->su('resume/ac/manager/op/view')); ?>">预览</a></td>
                <td width="30%" class="ops"><a href="<?php prt($writeUrl . '&rid=' . $rRs['resumeid']); ?>">修改</a><a href="#" onclick="return resumeDo_delete(<?php prt($rRs['resumeid'])?>);">删除</a></td>
            </tr>
            <?php endwhile; ?>
            <?php }else{ ?>
            <tr class="trow-bline trow-hover" >
                <td width="100%" colspan="6">对不起，你还没有创建简历。</td>
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