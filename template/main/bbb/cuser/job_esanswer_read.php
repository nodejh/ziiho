<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<style type="text/css">
.qs-item { line-height:32px; margin-top:5px; }
	.qs-item .qs-create { margin:0px 5px; color:#0263ad; }
	.qs-item .qs-create:hover { text-decoration:underline; color:#F00; }
	
	.qs-item .qs-remove { margin:0px 5px; color:#F00; }
	.qs-item .qs-remove:hover { text-decoration:underline; color:#F00; }
	
.qs-html { position:absolute; left:0px; top:-100px; width:0px; height:0px; overflow:hidden; }
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
    <div class="label clearfix">
    	<span class="tit">[<?php prt($JModel->sortValue($jobData['sortid'], 'sname')); ?>]&nbsp;<?php prt($jobData['jname']); ?></span>
    	<a class="add" href="<?php prt(_g('uri')->referer()); ?>">返回</a>
    </div>
    
    <!--//answer-read-->
    <div class="clearfix answer-read">
    	<ul class="clearfix ar-box">
        	<?php 
				$i = 0;
				$orderName = 0;
				while($esRs = _g('db')->result($examsubjectResult)){
				$i= $i + 1;
				$orderName = 0;
			?>
            <input type="hidden" name="estype[<?php prt($esRs['esid']); ?>]" value="<?php prt($esRs['estype']); ?>" />
            <?php 
            	switch($esRs['estype']){
					case 'radio': ?>
			<li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?>.</div>
                    <div class="nm"><?php prt($esRs['estitle']); ?><em class="tname">[<?php prt($JModel->qsType($esRs['estype'], 'subname')); ?>]</em></div>
                </div>
                
                <div class="clearfix ti">
                	<p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                    <div class="clear"></div>
                    <p class="obox"><span class="onn"></span><span class="ott"><em>A.</em>丰富的</span></p>
                </div>
                
            </li>
            
            <?php break;
					case 'checkbox': ?>
            <li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?></div>
                    <div class="nm"><?php prt($esRs['estitle']); ?><em class="tname">[<?php prt($JModel->qsType($esRs['estype'], 'subname')); ?>]</em></div>
                </div>
                
                <div class="clearfix ti">
                	<?php foreach($JModel->qsOptionDe($esRs['esoption']) as $optKey=>$optVal){ ?>
                    <?php 
						$okAnswer = $JModel->qsSAnswer($esRs['esanswer'], $esRs['esoption'], true);
						$myAnswer = $JEXAMSA->myAnswer($esRs['esid'], $esRs['cuid'], $esRs['jobid'], $__getUid, $esRs['esoption'], $JModel, true);
						$isOk = ($okAnswer == $myAnswer);
					 ?>
                	<p class="obox"><span class="onn"></span><span class="ott"><em><?php prt($JModel->qsOptionOrder($orderName)); ?>.</em><?php prt($optVal); ?></span></p>
                    <div class="clear"></div>
                    <?php $orderName = $orderName + 1; ?> 
                    <?php } ?>
                </div>
                
                <div class="clearfix tas">
                	<span class="as1">本题答案：<?php prt($okAnswer); ?></span>
                    <span class="as2 <?php prt($isOk ? 'color100' : 'color101'); ?>">答题：<?php prt($myAnswer); ?></span>
                    <span class="as3 <?php prt($isOk ? 'icon-12 color100' : 'icon-11 color101'); ?>">&nbsp;&nbsp;</span>
                </div>
            </li>
            
            <?php break;
					case 'input': ?>
			<li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?>.</div>
                    <div class="nm"><?php prt($esRs['estitle']); ?></div>
                </div>
                
                <div class="clearfix ti">
                	<input type="text" class="single-text" />
                </div>
            </li>
            
            <?php break;
					case 'textarea': ?>
            <li class="clearfix">
            	<div class="clearfix tn">
                	<div class="nn"><?php prt($i); ?>.</div>
                    <div class="nm"><?php prt($esRs['estitle']); ?></div>
                </div>
                
                <div class="clearfix ti">
                	<textarea class="multi-text"></textarea>
                </div>
            </li>
            <?php break; } ?>
            <?php } ?>
        </ul>
        
        <!--<div class="clearfix btn-box">
        	<button type="button" class="ok">提交阅卷</button><button type="button" class="fq" onclick="_GESHAI.redirect({url: '<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        </div>-->
    </div>
    <!--answer-read//-->
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->

<?php include _g('template')->name('user', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script language="javascript">

</script>

<?php include _g('template')->name('@', 'footer', true); ?>