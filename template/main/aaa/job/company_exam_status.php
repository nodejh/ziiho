<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/exam.css" />

<!--<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="h">返回首页</a><?php if(my_is_array($companyData)){ ?><a href="<?php prt($backUrl); ?>">返回<?php prt($companyData['cname']); ?></a><?php } ?>-->

<!-- //exam-appear -->
<div class="clearfix exam-appear" id="exam-appear">
    
    <!-- //subs -->
    <div class="clearfix subs">
    	<ul>
        	<?php foreach($examModels as $k=>$v){ ?>
        	<li>
            	<div class="ntit"><?php prt($v['sname']); ?></div>
                <div class="score"><?php if(!$JMODEL->is_xg($v['flag'])){ ?><span class="a"><?php prt($JMODEL->smCcount($answerData[$v['flag']])); ?></span><span class="b">/</span><span class="c">满分<?php prt($JMODEL->smCscore($v['flag'])); ?></span><?php }else{ ?><span class="xgt">想象型</span><?php } ?></div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!-- subs// -->
    
    <!-- //results -->
    <div class="clearfix results">
    	<?php foreach($examModels as $k=>$v){ ?>
    	<table width="100%">
        	<tr>
            	<td align="center" valign="middle" width="10%" class="mtit"><?php prt($v['sname']);?></td>
                <td width="80%">
                	<?php if(!$JMODEL->is_xg($v['flag'])){ ?>
                    
                    <?php if($JMODEL->is_sys($v['flag'])){ ?>
                    <div class="clearfix sys-box" id="bar_<?php prt($JMODEL->sysField); ?>">
						<?php foreach($examSysDatas as $qsModelK=>$qsModelV){ ?>
                        <div class="clearfix ibox">
                            <div class="ntit"><?php prt($qsModelK+1); ?>. <?php prt($qsModelV['name']);?></div>
                            
                            <div class="clearfix bar-dt">
                                <div class="clearfix bar">
                                    <div class="pro"><span><?php prt($qsModelV['num']);?></span></div>
                                </div>
                                <div class="clearfix cts"><?php prt($qsModelV['count']);?></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    
                    <?php if($JMODEL->is_ljfx($v['flag'])){ ?>
                	<div class="clearfix ibox" id="bar_<?php prt($v['flag']); ?>">
                    	<div class="clearfix bar-dt">
                            <div class="clearfix bar">
                                <div class="pro"><span><?php prt($answerData[$v['flag']]); ?></span></div>
                            </div>
                            <div class="clearfix cts"><?php prt($answerData['fields'][$v['flag']]); ?></div>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if($JMODEL->is_qywh($v['flag'])){ ?>
                	<div class="clearfix ibox" id="bar_<?php prt($v['flag']); ?>">
                    	<div class="clearfix bar-dt">
                            <div class="clearfix bar">
                                <div class="pro"><span><?php prt($answerData[$v['flag']]); ?></span></div>
                            </div>
                            <div class="clearfix cts"><?php prt($answerData['fields'][$v['flag']]); ?></div>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php }else{ ?>
                    <div class="clearfix xg">
                    	<div class="clearfix type">想象型</div>
                        <div class="clear"></div>
                        <div class="clearfix des">想象力丰富，憧憬未来。喜欢思考问题，在 生活中不注意小节，对那些不能立即了解其想法价值的人往往很不耐烦。有时行为刻板，不宜合群，难以相处。这类人不多，大约只占10%，在科学家、发明家、 研究人员和艺术家、作家中居多。</div>
                    </div>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <?php } ?>
    </div>
    <!-- results// -->

</div>
<div class="clear"></div>
<!-- exam-appear// -->

<?php include _g('template')->name('job', 'footer', true); ?>

<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
$(document).ready(function(e) {
	var __barWidth = 400;
	var __subs = $("#exam-appear .subs ul li");
	var __subsLen = parseInt(__subs.length);
	if(__subsLen >= 1) {
		__subs.width((1000 - (__subsLen * 20)) / __subsLen);
	}
	
	<?php foreach($examSysDatas as $qsModelK=>$qsModelV){ ?>
		$("#bar_<?php prt($JMODEL->sysField); ?> .pro").eq("<?php prt($qsModelK); ?>").animate({width: "<?php prt($JMODEL->bar($qsModelV['num'], $qsModelV['count'])); ?>%"}, 2000);
		<?php } ?>
	
	<?php foreach($examModels as $k=>$v){ ?>
		<?php if($JMODEL->is_ljfx($v['flag']) || $JMODEL->is_qywh($v['flag'])){ ?>
		$("#bar_<?php prt($v['flag']); ?> .pro").animate({width: "<?php prt($JMODEL->bar($answerData[$v['flag']], $answerData['fields'][$v['flag']])); ?>%"}, 2000);
		<?php } ?>
	<?php } ?>
		$("#exam-appear .results table .pro span").animate({opacity: "show"}, 2500);
});
	


</script>

<?php include _g('template')->name('@', 'footer', true); ?>