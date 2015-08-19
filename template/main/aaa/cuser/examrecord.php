<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<style type="text/css">
	.mt101 a { color:#069; }
	.mt101 a:hover { text-decoration:underline; }
</style>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php include _g('template')->name('cuser', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
    
    <div class="light">
    	<p class="t1">提示：</p>
        <p class="t2"><em>•</em>在这里根据您的需求条件，可能会找到所你感兴趣的求职者。</p>
    </div>
    
    <div class="">
    	<form method="get">
        	<input type="hidden" name="ac" value="examrecord" />
        	<p>
            	职位分类：<select name="sortid" def="<?php prt(my_array_value('sortid',$__qw)); ?>"><option value="">-</option></select>
            	<button type="submit">提交查询</button>
            <p>
        </form>
    </div>
    
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="form-job-post">
        <input type="hidden" name="jobid" value="" />
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="20%">职位</td>
                <td width="15%">认证者</td>
                <td width="40%" class="mt101">
                	<a href="<?php prt($mtOrderUrl . 'sys_' . $JModel->authFieldOrder('sys',$__qw)); ?>">系统题<?php prt($JModel->authFieldOrder('sys',$__qw, 1)); ?></a> / <a href="<?php prt($mtOrderUrl . 'my_'.$JModel->authFieldOrder('my',$__qw)); ?>">自定义<?php prt($JModel->authFieldOrder('my',$__qw, 1)); ?></a>
                    <?php foreach(_g('cache')->selectitem(120) as $k=>$v){ ?>
                    / <a href="<?php prt($mtOrderUrl . $v['flag'] . '_' . $JModel->authFieldOrder($v['flag'],$__qw)); ?>"><?php prt($v['sname']); ?><?php prt($JModel->authFieldOrder($v['flag'],$__qw, 1)); ?></a>
                    <?php } ?>
                </td>
                <td width="15%">时间</td>
                <td width="10%">操作</td>
            </tr>
            
            <?php while($erRs = _g('db')->result($examRecordResult)): ?>
            
            <tr class="trow-bline trow-hover" >
                <td width="20%"><?php prt($erRs['jname']); ?></td>
                <td width="15%"><?php prt($RMODEL->profile($erRs['uid'], 'chname')); ?></td>
                <td width="40%">
                <?php $fflag = false; ?>
                <?php foreach($JModel->examAnswerField($erRs) as $fk=>$fv){ ?>
                <?php if($fflag){ ?> / <?php } ?>
                [<?php prt($erRs[$fk].'/'. $fv); ?>]
                <?php $fflag = true; ?>
                <?php } ?>
                </td>
                <td width="15%"><?php prt(person_time($erRs['ctime'])); ?></td>
                <td width="10%" class="ops"><a href="javascript:;" onclick="">查看简历</a></td>
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


<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script language="javascript">
	selectSortsHtml($("select[name=\"sortid\"]"));
</script>

<?php include _g('template')->name('@', 'footer', true); ?>