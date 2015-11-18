<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header-no', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(sfullurl(_g('template')->dir('resume'))); ?>/css/view.css" />

<div class="clearfix resume_view">
    <div class="hh">
    	<a href="#" class="out" title="导出简历,word文件格式" target="_blank" onclick="this.href=(window.location.href)+'&out=yes';">导出为 Word</a>
        <a href="#" class="print" title="打印简历" onclick="window.print(); return false;">打印为 PDF</a>
    </div>
    
    <!-- //tbox -->
	<div class="clearfix tbox">
    <table width="100%" class="table">
      <tr>
        <td align="center" valign="middle"><em class="tit">个人简历</em></td>
      </tr>
      <tr class="bline">
        <td class="pd">
        	<div class="t1"><?php prt(my_array_value('chname', $profileData)); ?></div>
            <div class="t2 fw tc0"><?php prt(_g('cache')->selectitem('101>'.my_array_value('workyear', $profileData).'>sname')); ?>工作经验,<em class="plr7"><?php prt(_g('module')->dv('resume', '100000>'.my_array_value('gender', $profileData).'>name')); ?>,</em><em class="plr7"><?php prt(_g('value')->date2age(my_array_value('birthday', $profileData))); ?>岁(<?php prt(date("Y年m月d日", my_array_value('birthday',$profileData))); ?>)</em></div>
            
            <div class="clearfix bfb50">
            	<div class="tx0">居住地：</div>
                <div class="tx1"><?php prt($JOBMODEL->areaGet(my_array_value('home', $profileData))); ?></div>
            </div>
            
            <div class="clearfix bfb50">
            	<div class="tx0">民<em class="plr7"></em>族：</div>
                <div class="tx1"><?php prt(_g('cache')->selectitem('103>'.my_array_value('nation', $profileData).'>sname')); ?></div>
            </div>
            
            <div class="clearfix bfb50">
            	<div class="tx0">婚<em class="plr7"></em>姻：</div>
                <div class="tx1"><?php prt(_g('cache')->selectitem('105>'.my_array_value('maritalstatus', $profileData).'>sname')); ?></div>
            </div>
            
            <div class="clearfix bfb50">
            	<div class="tx0">政治面貌：</div>
                <div class="tx1"><?php prt(_g('cache')->selectitem('100>'.my_array_value('politicalstatus', $profileData).'>sname')); ?></div>
            </div>
            
            <div class="clearfix bfb50">
            	<div class="tx0">电<em class="plr7"></em>话：</div>
                <div class="tx1"><?php prt(my_array_value('mobilephone', $profileData)); ?></div>
            </div>
            
            <div class="clearfix bfb50">
            	<div class="tx0">E-mail：</div>
                <div class="tx1"><?php prt(my_array_value('email', $profileData)); ?></div>
            </div>
        </td>
      </tr>
      
      <tr class="bline">
        <td class="pd">
        	<div class="clearfix <?php prt(my_is_array($lastWorkData) ? 'z bfb50' : null); ?>">
                <div class="clearfix btl2">
                	<span class="tx-light"></span>
                    <div class="tx0 fw">学历</div>
                </div>
                
                <div class="clearfix">
                    <div class="tx0">学<em class="plr7"></em>历：</div>
                    <div class="tx1"><?php prt(_g('cache')->selectitem('111>'.my_array_value('degree', $degreeData).'>sname')); ?></div>
                </div>
                
                <div class="clearfix">
                    <div class="tx0">专<em class="plr7"></em>业：</div>
                    <div class="tx1"><?php prt(_g('cache')->selectitem('110>'.my_array_value('specialty', $degreeData).'>sname')); ?><?php prt(my_array_value('specialty_input', $degreeData)); ?></div>
                </div>
                <div class="clear"></div>
                
                <div class="clearfix">
                    <div class="tx0">学<em class="plr7"></em>校：</div>
                    <div class="tx1"><?php prt(my_array_value('school', $degreeData)); ?></div>
                </div>
            </div>
            
            <?php if (my_is_array($lastWorkData)) { ?>
            <div class="clearfix z bfb50">
                <div class="clearfix btl2">
                	<span class="tx-light"></span>
                    <div class="tx0 fw">最近工作</div>
                    <div class="tx1 fw"><?php prt(_g('value')->d2month($lastWorkData['stime'], $lastWorkData['etime'])); ?></div>
                </div>
                
                <div class="clearfix">
                    <div class="tx0">公<em class="plr7"></em>司：</div>
                    <div class="tx1"><?php prt($lastWorkData['company']); ?></div>
                </div>
                
                <div class="clearfix">
                    <div class="tx0">行<em class="plr7"></em>业：</div>
                    <div class="tx1">
                    <?php 
                    	if (my_is_array(my_array_value('hangye', $lastWorkData))) {
							$isflag = false;
							foreach ($lastWorkData['hangye'] as $v) {
					?>
							<?php prt($isflag ? ',&nbsp;' : null); ?>
                    		<?php prt($v['sname']); ?>
                    <?php 
                    		$isflag = true;
						} } ?>
                    </div>
                </div>
                <div class="clear"></div>
                
                <div class="clearfix">
                    <div class="tx0">职<em class="plr7"></em>位：</div>
                    <div class="tx1"><?php prt($JOBMODEL->sortValue(my_array_value('sortid2', $lastWorkData), 'sname')) ?><?php prt(my_array_value('sortid2_input', $lastWorkData)); ?></div>
                </div>
            </div>
            <?php } ?>
        </td>
      </tr>
      
      <?php if (strlen(my_array_value('selfintroduce', $wishData)) >= 1){ ?>
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">自我介绍</div>
            </div>
            
            <div class="clearfix"><?php prt($wishData['selfintroduce']); ?></div>
        </td>
      </tr>
      <?php } ?>
      
      <?php if (my_is_array($wishData)){ ?>
      <!-- //工作期望 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">求职意向</div>
            </div>
            
            <div class="clearfix">
                <div class="tx0">工作性质：</div>
                <div class="tx1"><?php prt(_g('cache')->selectitem('107>'.$wishData['worktype'].'>sname')); ?></div>
            </div>
            
            <div class="clearfix">
                <div class="tx0">工作地点</div>
                <div class="tx1"><?php prt($JOBMODEL->areaGet($wishData['area'])); ?></div>
            </div>
            
            <div class="clearfix">
                <div class="tx0">希望行业：</div>
                <div class="tx1">
                	<?php 
                    	if (my_is_array(my_array_value('hangye', $wishData))) {
							$isflag = false;
							foreach ($wishData['hangye'] as $v) {
					?>
							<?php prt($isflag ? ',&nbsp;' : null); ?>
                    		<?php prt($v['sname']); ?>
                    <?php 
                    		$isflag = true;
						} } ?>
                </div>
            </div>
            <div class="clear"></div>
            
            <div class="clearfix">
                <div class="tx0">希望职位：</div>
                <div class="tx1">
                	<?php 
                    	if (my_is_array(my_array_value('zhiwei', $wishData))) {
							$isflag = false;
							foreach ($wishData['zhiwei'] as $v) {
					?>
							<?php prt($isflag ? ',&nbsp;' : null); ?>
                    		<?php prt($v['sname']); ?>
                    <?php 
                    		$isflag = true;
						} } ?>
                </div>
            </div>
            
            <div class="clearfix">
                <div class="tx0">期望薪资：</div>
                <div class="tx1"><?php prt($RESUMEMODEL->wageDe($wishData)) ?>/<?php prt(_g('cache')->selectitem('108>'.$wishData['wagetype'].'>sname')); ?></div>
            </div>
            
            <div class="clearfix">
                <div class="tx0">到岗时间：</div>
                <div class="tx1"><?php prt(_g('cache')->selectitem('109>'.$wishData['workstatus'].'>sname')); ?></div>
            </div>
        </td>
      </tr>
      <!-- 工作期望// -->
      <?php } ?>
      
      <?php if ($workexpData[0] >= 1){ ?>
      <!-- //工作经历 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">工作经历</div>
            </div>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($workexpData[1])){ ?>
            <?php $__hangye = $JOBMODEL->sortShow($val['sortid']); ?>
            <div class="clearfix <?php prt($isflag ? 'bline2' : null); ?>">
            	<div class="clearfix tc0">
	                <?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?><em class="plr5">-</em><?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?><em class="plr15"><?php prt($val['company']); ?>（<?php prt(_g('cache')->selectitem('114>'.$val['csize'].'>sname')); ?>、<?php prt(_g('cache')->selectitem('119>'.$val['nature'].'>sname')); ?>）</em>[<?php prt(_g('value')->d2month($val['stime'], $val['etime'], true)); ?>]<em class="plr15"><?php prt(_g('cache')->selectitem('107>'.$val['worktype'].'>sname')); ?></em>
	            </div>
	            
	            <div class="clearfix">
	            	<div class="clearfix z">
	                    <em class="pr5">职位：</em><?php prt($JOBMODEL->sortValue($val['sortid2'], 'sname')) ?><?php prt(strlen($val['sortid2_input']) >= 1 ? ('(' . $val['sortid2_input'] . ')') : null); ?>
	                </div>
	            	<div class="clearfix z ml50">
	                	<em class="pr5">部门：</em><?php prt($val['department']); ?>
	            	</div>
	                <div class="clearfix z ml50">
	                    <em class="pr5">行业：</em><?php $__flag = false; foreach ($__hangye as $__hval){ prt($__flag ? ',' : null); prt($__hval['sname']); $__flag = false; } ?>
	                </div>
	            </div>
	            <div class="clear"></div>
	            
	            <div class="clearfix"><?php prt($val['description']); ?></div>
            </div>
            <?php $isflag = true; ?>
            <?php } ?>
        </td>
      </tr>
      <!-- 工作经历// -->
      <?php } ?>
      
      <?php if ($projectexpData[0] >= 1){ ?>
      <!-- //项目经验 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">项目经验</div>
            </div>
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($projectexpData[1])){ ?>
            <div class="clearfix <?php prt($isflag ? 'bline2' : null); ?>">
	            <div class="clearfix">
	                <?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?><em class="plr5">-</em><?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?><em class="plr15"><?php prt($val['pname']); ?></em>
	            </div>
	            
	            <div class="clearfix">
	            	<div class="clearfix z">
	                    <em class="pr5">开发工具：</em><?php prt($val['tool']); ?>
	                </div>
	            	<div class="clearfix z ml50">
	                	<em class="pr5">硬件环境：</em><?php prt($val['hardware']); ?>
	            	</div>
	                <div class="clearfix z ml50">
	                	<em class="pr5">软件环境：</em><?php prt($val['software']); ?>
	            	</div>
	            </div>
	            
	            <?php if (strlen($val['pdesc']) >= 1){ ?>
	            <div class="clearfix">
	            	<div class="tx0 z">项目描述：</div>
	            	<div class="tx2"><?php prt($val['pdesc']); ?></div>
	           </div>
	            <div class="clear"></div>
	            <?php } ?>
	            
	            <?php if (strlen($val['responsible']) >= 1){ ?>
	            <div class="clearfix">
	            	<div class="tx0 z">责任描述：</div>
	            	<div class="tx2"><?php prt($val['responsible']); ?></div>
	            </div>
	            <div class="clear"></div>
	            <?php } ?>
            </div>
            <?php $isflag = true; ?>
            <?php } ?>
        </td>
      </tr>
      <!-- 项目经验// -->
      <?php } ?>
      
      <?php if ($trainData[0] >= 1) { ?>
      <!-- //培训 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">培训经历</div>
            </div>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($trainData[1])){ ?>
            <div class="clearfix <?php prt($isflag ? 'bline2' : null); ?>">
	            <div class="clearfix">
	                <?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?><em class="plr5">-</em><?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?><em class="plr15"><?php prt($val['course']); ?></em>
	            </div>
	            
	            <div class="clearfix">
	            	<div class="clearfix z">
	                    <em class="pr5">机构：</em><?php prt($val['organization']); ?>
	                </div>
	            	<div class="clearfix z ml50">
	                	<em class="pr5">地点：</em><?php prt($val['area']); ?>
	            	</div>
	            	<div class="clearfix z ml50">
	                	<em class="pr5">获得证书：</em><?php prt($val['certificate']); ?>
	            	</div>
	            </div>
	            <div class="clear"></div>
	            
	            <?php if (strlen($val['description']) >= 1){ ?>
	            <div class="clearfix"><?php prt($val['description']); ?></div>
	            <?php } ?>
            </div>
            <?php $isflag = true; ?>
            <?php } ?>
        </td>
      </tr>
      <!-- 培训// -->
      <?php } ?>
      
      <?php if ($educateData[0] >= 1) { ?>
      <!-- //教育 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">教育经历</div>
            </div>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($educateData[1])){ ?>
            <div class="clearfix <?php prt($isflag ? 'bline2' : null); ?>">
	            <div class="clearfix">
	                <?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?><em class="plr5">-</em><?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?><em class="plr15"><?php prt($val['school']); ?></em><em class="plr15"><?php prt(_g('cache')->selectitem('110>'.$val['specialty'].'>sname')); ?><?php prt(strlen($val['specialty_input']) >= 1 ? ('('.$val['specialty_input'].')') : null); ?></em><?php prt(_g('cache')->selectitem('111>' . $val['degree'] . '>sname')); ?><?php prt($val['overseas_exp'] == 1 ? '(海外经历)' : null); ?><?php prt($val['isallday'] == 1 ? null : ',非全日制'); ?>
	            </div>
	            <?php if (strlen($val['description']) >= 1){ ?>
	            <div class="clearfix"><?php prt($val['description']); ?></div>
	            <?php } ?>
            </div>
            <?php $isflag = true; ?>
            <?php } ?>
        </td>
      </tr>
      <!-- 教育// -->
      <?php } ?>
      
      <?php if ($languageData[0] >= 1) { ?>  
      <!-- //语言 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">语言能力</div>
            </div>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($languageData[1])){ ?>
            <div class="clearfix <?php prt($isflag ? 'bline2' : null); ?>">
            	<div class="clearfix z tx3">
            		<em class="pr5">语言类别：</em><?php prt(_g('cache')->selectitem('112>'.$val['ltype'].'>sname')); ?>
            	</div>
	            <div class="clearfix z tx3 ml20">
	            	<em class="pr5">掌握程度：</em><?php prt(_g('cache')->selectitem('113>'.$val['level'].'>sname')); ?>
	         	</div>
	         	<div class="clearfix z tx3 ml20">
	            	<em class="pr5">读写能力：</em><?php prt(_g('cache')->selectitem('113>'.$val['rwability'].'>sname')); ?>
				</div>
				<div class="clearfix z tx3 ml20">
	            	<em class="pr5">听说能力：</em><?php prt(_g('cache')->selectitem('113>'.$val['lsability'].'>sname')); ?>
	            </div>
            </div>
            <?php $isflag = true; ?>
            <?php } ?>
        </td>
      </tr>
      <!-- 语言// -->
      <?php } ?>
      
      <?php if (my_is_array($relateData)){ ?>
      <!-- //其他 -->
      <tr class="bline">
        <td class="pd">
            <div class="clearfix btl2">
                <span class="tx-light"></span>
                <div class="tx0 fw">其他</div>
            </div>
            
            <div class="clearfix">
            	<?php $isflag = false; ?>
            	<?php if ($relateData['englishlv'] >= 1){ ?>
            	<?php $isflag = true; ?>
            	<div class="clearfix z tx3">
                    <em class="pr5">英语等级：</em><?php prt(_g('cache')->selectitem('117>'.$relateData['englishlv'].'>sname')); ?>
                </div>
                <?php } ?>
                
                <?php if ($relateData['japaneselv'] >= 1){ ?>
            	<div class="clearfix z tx3 <?php prt($isflag ? 'ml20' : null); ?>">
                	<em class="pr5">日语等级：</em><?php prt(_g('cache')->selectitem('118>'.$relateData['japaneselv'].'>sname')); ?>
            	</div>
            	<?php } ?>
            </div>
            <div class="clear"></div>
            
            <div class="clearfix">
                <em class="pr5"><?php $isflag = false; if ($relateData['explaintype'] >= 1){ $isflag = true; prt(_g('cache')->selectitem('115>'.$relateData['explaintype'].'>sname')); } ?><?php if (strlen($relateData['explaintype_input']) >= 1) { prt(!$isflag ? $relateData['explaintype_input'] : ('(' . $relateData['explaintype_input'] . ')')); } ?>：</em><?php prt($relateData['explaindesc']); ?>
            </div>
        </td>
      </tr>
      <!-- 其他// -->
      <?php } ?>
    </table>
	</div>
	<!-- tbox// -->
</div>

<script language="javascript">
	$(document).ready(function(e) { $(".table tr:last").removeClass("bline"); });
</script>

<?php include _g('template')->name('@', 'footer', true); ?>