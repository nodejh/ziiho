<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header-no', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<style type="text/css">
.gbg { background:#eee; padding:5px 10px; line-height:24px; }
</style>

<!-- //cuser_y -->
<div class="cuser_y clearfix">
    <div class="datas">
    	<form method="post" onsubmit="return false;">
        <!-- //简历 -->
    	<div class="gbg"><strong>选择简历</strong></div>
    	<table style="width:100%;">
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="90%"><strong>简历名称</strong></td>
            </tr>
            
            <?php if($resumeResData['total'] >= 1){ ?>
            <?php while($rRs = _g('db')->result($resumeResult)): ?>
            <tr>
                <td width="10%"><input type="radio" name="resumeid" value="<?php prt($rRs['resumeid']); ?>" /></td>
                <td width="90%"><?php prt($rRs['rname']); ?></td>
            </tr>
            <?php endwhile; ?>
            <?php }else{ ?>
            <tr>
                <td width="100%" colspan="2">对不起，你还没有创建简历。</td>
            </tr>
            <?php } ?>
        </table>
    	<!-- 简历// -->
    
    	<!-- //认证书 -->
    	<div class="gbg"><strong>选择认证书</strong></div>
    	<table style="width:100%;">
            <tr>
                <td width="10%">&nbsp;</td>
                <td width="40%"><strong>[公司]职位信息</strong></td>
                <td width="40%">
                	<strong>
                	系统题 / 自定义
                    <?php foreach(_g('cache')->selectitem(120) as $k=>$v){ ?>
                    / <?php prt($v['sname']); ?>
                    <?php } ?></
                    <strong>
                </td>
            </tr>
            
            <?php if($examRecData['total'] >= 1){ ?>
            <?php while($recRs = _g('db')->result($examRecResult)): ?>
            <tr class="trow-bline trow-hover" >
                <td width="10%"><input type="checkbox" name="recordid[]" value="<?php prt($recRs['recordid']); ?>" /></td>
                <td width="40%">[<?php prt(my_array_value('cname', $CUSER->find_jion('a.cuid', $recRs['cuid']))); ?>]<?php prt($recRs['jname']); ?></td>
                <td width="40%">
					<?php $fflag = false; ?>
                    <?php foreach($JMODEL->examAnswerField($recRs) as $fk=>$fv){ ?>
                    <?php if($fflag){ ?> / <?php } ?>
                    [<?php prt($recRs[$fk].'/'. $fv); ?>]
                    <?php $fflag = true; ?>
                    <?php } ?>
                </td>
            </tr>
            <?php endwhile; ?>
            <?php }else{ ?>
            <tr>
                <td width="100%" colspan="3">对不起，你还没有认证书。</td>
            </tr>
            <?php } ?>
        </table>
    	</div>
    	<div class="page-tab"><?php prt($JMODEL->page($examRecData)); ?></div>
    	<!-- 认证书// -->
</div>
<!-- cuser_y// -->

<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">

</script>

<?php include _g('template')->name('@', 'footer', true); ?>