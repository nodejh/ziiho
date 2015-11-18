<?php //if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php //include _g('template')->name('@', 'header', true); ?>
<!--<link rel="stylesheet" type="text/css" href="--><?php //prt(_g('template')->dir('job')); ?><!--/css/home.css" />-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //prt(_g('template')->dir('user')); ?><!--/css/c_center.css" />-->
<!--<link rel="stylesheet" type="text/css" href="--><?php //prt(_g('template')->dir('cuser')); ?><!--/css/blocks.css" />-->
<!---->
<!---->


<?php if (!defined('IN_GESHAI')) {
    exit('no direct access allowed');
} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/user.js"/>

    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('cuser')); ?>/css/blocks.css" />



    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('cuser', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->



    <!-- //cuser_y -->
    <div class="cuser_y clearfix o-right">
        <h1 class="o-title">职位测评记录</h1>

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
    
    <div class="cu-exam-rec" id="cu-exam-rec">
    	<form method="post" onsubmit="return false;" id="form-exam101">
        	<input type="hidden" name="recordid" value="" />
            <input type="hidden" name="hideurl" value="<?php prt(_g('uri')->su('user/ac/examrecord/op/hide')); ?>" />
        </form>
    	
        <ul class="rec-box">
        	<?php $index=0; ?>
        	<?php while($erRs = _g('db')->result($examRecordResult)): ?>
                <?php $rUser = $RMODEL->profile($erRs['uid']); ?>
            	<li class="<?php prt($index % 3 == 0 ? null : 'ml'); ?>">
                	<div class="yz"></div>
                    
                	<div class="cn"><img src="<?php prt($RMODEL->avatar($rUser)); ?>" /><?php prt(my_array_value('chname', $rUser)); ?></div>
                    <div class="tit"><em><?php prt($JMODEL->sortValue($erRs['sortid'], 'sname')); ?></em>:&nbsp;<?php prt($erRs['jname']); ?></div>
                    <div class="score">
                    	<div class="bl">测评成绩：</div>
                        <div class="bar">
                        	<div class="pro" style="width:<?php prt(my_array_value(1, $JMODEL->cbar($erRs, 100))); ?>px;"></div>
                            <div class="tnum"><?php prt(my_array_value(0, $JMODEL->cbar($erRs, 100))); ?>分</div>
                        </div>
                        <div class="mct">100分</div>
                    </div>
                    <div class="xg">性格类型：<em>想象型</em></div>
                    <div class="date"><?php prt(date('Y/m/d', $erRs['ctime'])); ?></div>
                    <div class="vt"><a href="<?php prt(_g('uri')->su('job/ac/company/op/exam_s/id/'.$erRs['cuid'].'/jobid/'.$erRs['jobid'].'/uid/'.$erRs['uid'])); ?>" target="_blank">查看详情</a></div>
                </li>
                <?php $index += 1; ?>
			<?php endwhile; ?>
        </ul>
        
    </div>
    <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('cuser')); ?>/js/d.js"></script>
<script language="javascript">
selectSortsHtml($("select[name=\"sortid\"]"));
$('#cu-exam-rec').cjslip({ type: 'menu', speed: 100, mainState: 'ul.rec-box li', mainEl: ".vt", defaultShow: false });
</script>

<?php include _g('template')->name('@', 'footer', true); ?>