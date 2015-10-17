<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header-no', true); ?>

<div style="width:90%; margin:auto;">
    <!-- //tbox -->
    <table width="100%">
      <tr>
        <td align="center" valign="middle" style="font-size:20px;">个人简历</td>
      </tr>
      <tr>
        <td width="100%">
        	
        	<table width="100%">
              <tr>
                <td colspan="2" width="100%" style="font-weight:bold; font-size:16px;">
                	<?php prt(my_array_value('chname', $profileData)); ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" width="100%">
					<?php prt(_g('cache')->selectitem('101>'.my_array_value('workyear', $profileData).'>sname')); ?>工作经验,&nbsp;&nbsp;<?php prt(_g('module')->dv('resume', '100000>'.my_array_value('gender', $profileData).'>name')); ?>,&nbsp;&nbsp;<?php prt(_g('value')->date2age(my_array_value('birthday', $profileData))); ?>岁(<?php prt(date("Y年m月d日", my_array_value('birthday',$profileData))); ?>)
                </td>
              </tr>
              <tr>
                <td width="50%">居住地：<?php prt($JOBMODEL->areaGet(my_array_value('home', $profileData))); ?></td>
                <td width="50%">民族：<?php prt(_g('cache')->selectitem('103>'.my_array_value('nation', $profileData).'>sname')); ?></td>
              </tr>
              <tr>
                <td width="50%">婚姻：<?php prt(_g('cache')->selectitem('105>'.my_array_value('maritalstatus', $profileData).'>sname')); ?></td>
                <td width="50%">政治面貌：<?php prt(_g('cache')->selectitem('100>'.my_array_value('politicalstatus', $profileData).'>sname')); ?></td>
              </tr>
              <tr>
                <td width="50%">电话：<?php prt(my_array_value('mobilephone', $profileData)); ?></td>
                <td width="50%">E-mail：<?php prt(my_array_value('email', $profileData)); ?></td>
              </tr>
            </table>
            
        </td>
      </tr>
      
      <?php if (strlen(my_array_value('selfintroduce', $wishData)) >= 1){ ?>
      <tr>
        <td>
        
        	<table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">自我介绍</td>
                </tr>
                <tr>
                	<td><?php prt($wishData['selfintroduce']); ?></td>
                </tr>
            </table>
            
        </td>
      </tr>
      <?php } ?>
      
      <?php if (my_is_array($wishData)){ ?>
      <!-- //工作期望 -->
      <tr>
        <td>
        	
            <table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">求职意向</td>
                </tr>
                <tr>
                	<td>工作性质：<?php prt(_g('cache')->selectitem('107>'.$wishData['worktype'].'>sname')); ?></td>
                </tr>
                <tr>
                	<td>工作地点：<?php prt($JOBMODEL->areaGet($wishData['area'])); ?></td>
                </tr>
                <tr>
                	<td>希望行业：
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
                    </td>
                </tr>
                <tr>
                	<td>希望职位：
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
                    </td>
                </tr>
                <tr>
                	<td>期望薪资：<?php prt($RESUMEMODEL->wageDe($wishData)) ?>/<?php prt(_g('cache')->selectitem('108>'.$wishData['wagetype'].'>sname')); ?></td>
                </tr>
                <tr>
                	<td>到岗时间：<?php prt(_g('cache')->selectitem('109>'.$wishData['workstatus'].'>sname')); ?></td>
                </tr>
            </table>
            
        </td>
      </tr>
      <!-- 工作期望// -->
      <?php } ?>
      
      <?php if ($workexpData[0] >= 1){ ?>
      <!-- //工作经历 -->
      <tr>
        <td>
        
        	<table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">工作经历</td>
                </tr>
			</table>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($workexpData[1])){ ?>
            <?php $__hangye = $JOBMODEL->sortShow($val['sortid']); ?>
            <table width="100%"  <?php prt($isflag ? 'style="border-top:1px dashed #ccc;"' : null); ?> >
            	<tr>
                	<td>
                    	<?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?>&nbsp;-&nbsp;<?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php prt($val['company']); ?>（<?php prt(_g('cache')->selectitem('114>'.$val['csize'].'>sname')); ?>、<?php prt(_g('cache')->selectitem('119>'.$val['nature'].'>sname')); ?>）&nbsp;&nbsp;[<?php prt(_g('value')->d2month($val['stime'], $val['etime'], true)); ?>]&nbsp;&nbsp;<?php prt(_g('cache')->selectitem('107>'.$val['worktype'].'>sname')); ?>
                    </td>
                </tr>
                <tr>
                	<td>职位：<?php prt($JOBMODEL->sortValue($val['sortid2'], 'sname')) ?><?php prt(strlen($val['sortid2_input']) >= 1 ? ('(' . $val['sortid2_input'] . ')') : null); ?></td>
                </tr>
                <tr>
                	<td>部门：<?php prt($val['department']); ?></td>
                </tr>
                <tr>
                	<td>行业：<?php $__flag = false; foreach ($__hangye as $__hval){ prt($__flag ? ',' : null); prt($__hval['sname']); $__flag = false; } ?></td>
                </tr>
                <tr>
                	<td><?php prt($val['description']); ?></td>
                </tr>
			</table>
            <?php $isflag = true; ?>
            <?php } ?>
            
        </td>
      </tr>
      <!-- 工作经历// -->
      <?php } ?>
      
      <?php if ($projectexpData[0] >= 1){ ?>
      <!-- //项目经验 -->
      <tr>
        <td>
        
        	<table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">项目经验</td>
                </tr>
			</table>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($projectexpData[1])){ ?>
            <table width="100%"  <?php prt($isflag ? 'style="border-top:1px dashed #ccc;"' : null); ?> >
            	<tr>
                	<td><?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?>&nbsp;-&nbsp;<?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php prt($val['pname']); ?></td>
                </tr>
                <tr>
                	<td>开发工具：<?php prt($val['tool']); ?></td>
                </tr>
                <tr>
                	<td>硬件环境：<?php prt($val['hardware']); ?></td>
                </tr>
                <tr>
                	<td>软件环境：<?php prt($val['software']); ?></td>
                </tr>
                
                <?php if (strlen($val['pdesc']) >= 1){ ?>
                <tr>
                	<td>项目描述：<?php prt($val['pdesc']); ?></td>
                </tr>
                <?php } ?>
                
                <?php if (strlen($val['responsible']) >= 1){ ?>
                <tr>
                	<td>责任描述：<?php prt($val['responsible']); ?></td>
                </tr>
                <?php } ?>
			</table>
        	<?php $isflag = true; ?>
            <?php } ?>
            
        </td>
      </tr>
      <!-- 项目经验// -->
      <?php } ?>
      
      <?php if ($trainData[0] >= 1) { ?>
      <!-- //培训 -->
      <tr>
        <td>
        	
            <table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">培训经历</td>
                </tr>
			</table>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($trainData[1])){ ?>
            <table width="100%"  <?php prt($isflag ? 'style="border-top:1px dashed #ccc;"' : null); ?> >
            	<tr>
                	<td><?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?>&nbsp;-&nbsp;<?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php prt($val['course']); ?></td>
                </tr>
                <tr>
                	<td>机构：<?php prt($val['organization']); ?></td>
                </tr>
                <tr>
                	<td>地点：<?php prt($val['area']); ?></td>
                </tr>
                <tr>
                	<td>获得证书：<?php prt($val['certificate']); ?></td>
                </tr>
                <?php if (strlen($val['description']) >= 1){ ?>
                <tr>
                	<td><?php prt($val['description']); ?></td>
                </tr>
                <?php } ?>
            </table>
            <?php $isflag = true; ?>
            <?php } ?>
            
        </td>
      </tr>
      <!-- 培训// -->
      <?php } ?>
      
      <?php if ($educateData[0] >= 1) { ?>
      <!-- //教育 -->
      <tr>
        <td>
        
        	<table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">教育经历</td>
                </tr>
			</table>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($educateData[1])){ ?>
            <table width="100%"  <?php prt($isflag ? 'style="border-top:1px dashed #ccc;"' : null); ?> >
            	<tr>
                	<td><?php prt($RESUMEMODEL->rdateDe($val['stime'])); ?>&nbsp;-&nbsp;<?php prt($RESUMEMODEL->rdateDe($val['etime'])); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php prt($val['school']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php prt(_g('cache')->selectitem('110>'.$val['specialty'].'>sname')); ?><?php prt(strlen($val['specialty_input']) >= 1 ? ('('.$val['specialty_input'].')') : null); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php prt(_g('cache')->selectitem('111>' . $val['degree'] . '>sname')); ?><?php prt($val['overseas_exp'] == 1 ? '(海外经历)' : null); ?><?php prt($val['isallday'] == 1 ? null : ',非全日制'); ?></td>
                </tr>
                <?php if (strlen($val['description']) >= 1){ ?>
                <tr>
                	<td><?php prt($val['description']); ?></td>
                </tr>
                <?php } ?>
            </table>
            <?php $isflag = true; ?>
            <?php } ?>
            
        </td>
      </tr>
      <!-- 教育// -->
      <?php } ?>
      
      <?php if ($languageData[0] >= 1) { ?>  
      <!-- //语言 -->
      <tr>
        <td>
        
        	<table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">语言能力</td>
                </tr>
			</table>
            
            <?php $isflag = false; ?>
            <?php while ($val = _g('db')->result($languageData[1])){ ?>
            <table width="100%"  <?php prt($isflag ? 'style="border-top:1px dashed #ccc;"' : null); ?> >
                <tr>
                    <td style="width:25%">语言类别：<?php prt(_g('cache')->selectitem('112>'.$val['ltype'].'>sname')); ?></td>
                    <td style="width:25%">掌握程度：<?php prt(_g('cache')->selectitem('113>'.$val['level'].'>sname')); ?></td>
                    <td style="width:25%">读写能力：<?php prt(_g('cache')->selectitem('113>'.$val['rwability'].'>sname')); ?></td>
                    <td style="width:25%">听说能力：<?php prt(_g('cache')->selectitem('113>'.$val['lsability'].'>sname')); ?></td>
                </tr>
            </table>
            <?php $isflag = true; ?>
            <?php } ?>
        </td>
      </tr>
      <!-- 语言// -->
      <?php } ?>
      
      <?php if (my_is_array($relateData)){ ?>
      <!-- //其他 -->
      <tr>
        <td>
        	
            <table width="100%" >
            	<tr style="background:#E1E1E1; font-weight:bold;">
                	<td valign="middle">其他</td>
                </tr>
			</table>
            
            <table width="100%" >
            	<tr>
                	<td>
                    	<?php $isflag = false; ?>
						<?php if ($relateData['englishlv'] >= 1){ ?>
                        <?php $isflag = true; ?>
                        英语等级：<?php prt(_g('cache')->selectitem('117>'.$relateData['englishlv'].'>sname')); ?>
                        <?php } ?>
                        <?php if ($relateData['japaneselv'] >= 1){ ?>
                        <?php prt($isflag ? '&nbsp;&nbsp;&nbsp;&nbsp;' : null); ?>
                        日语等级：<?php prt(_g('cache')->selectitem('118>'.$relateData['japaneselv'].'>sname')); ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<?php $isflag = false; if ($relateData['explaintype'] >= 1){ $isflag = true; prt(_g('cache')->selectitem('115>'.$relateData['explaintype'].'>sname')); } ?><?php if (strlen($relateData['explaintype_input']) >= 1) { prt(!$isflag ? $relateData['explaintype_input'] : ('(' . $relateData['explaintype_input'] . ')')); } ?>：<?php prt($relateData['explaindesc']); ?>
                    </td>
                </tr>
			</table>
            
        </td>
      </tr>
      <!-- 其他// -->
      <?php } ?>
    </table>
</div>
<script language="javascript">
	$(document).ready(function(e) { $(".table tr:last").removeClass("bline"); });
</script>

<?php include _g('template')->name('@', 'footer', true); ?>