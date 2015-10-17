<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //job-company-job -->
<div class="com-w job-company-job clearfix" id="job-company-job">
	<div class="tit clearfix">
    	<span class="ipic"><img src="<?php prt($CUSER->logo($cUserData['logo'])); ?>" /></span>
        <em class="t"><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . _get('id'))); ?>"><?php prt($cUserData['cname']); ?></a> - [<?php prt($jsortData['sname']); ?>]<strong><?php prt($jobData['jname']); ?></strong></em>
    </div>
    
    <div class="cbase clearfix">
    	<ul class="cb">
        	<li class="clearfix"><span class="ln">公司行业：</span>
            <?php foreach(_g('value')->s2pnsplit2($cUserData['csortid']) as $v){ ?>
			<?php prt($JMODEL->sortValue($v, 'sname')); ?>&nbsp;&nbsp;
            <?php } ?>
            </li>
            <li class="clearfix"><span class="ln">公司性质：</span><?php prt(_g('cache')->selectitem('119>'.$cUserData['cnatureid'].'>sname')); ?></li>
            <li class="clearfix"><span class="ln">公司规模：</span><?php prt(_g('cache')->selectitem('114>'.$cUserData['csize'].'>sname')); ?></li>
        </ul>
    </div>
    
    <div class="line clearfix"></div>
    <div class="hd clearfix"><em class="on">职位信息</em><em>公司介绍</em></div>
    <div class="bd clearfix">
    	<div class="t clearfix">
        	<div class="info clearfix">
            	<table>
                	<tr>
                    	<td class="ftb w80">发布日期</td>
                        <td class="w160"><?php prt(date('Y-m-d', $jobData['ctime'])); ?></td>
                        <td class="ftb w80">工作地点</td>
                        <td class="w240">
                        	<?php foreach(_g('value')->s2pnsplit2($jobData['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;<?php } ?>
                        </td>
                        <td class="ftb w80">招聘人数</td>
                        <td class="w160"><?php prt($jobData['pnum']); ?></td>
                    </tr>
                    <tr>
                    	<td class="ftb w80">工作年限</td>
                        <td class="w160"><?php prt(_g('cache')->selectitem('101>'.$jobData['workyear'].'>sname')); ?></td>
                        <td class="ftb w80">语言要求</td>
                        <td class="w240">
                        	<?php foreach(_g('value')->s2pnsplit2($jobData['language']) as $v){ ?>
                            <?php prt(_g('cache')->selectitem('112>'.$v.'>sname')); ?>&nbsp;
                            <?php } ?>
                        </td>
                        <td class="ftb w80">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;历</td>
                        <td class="w160"><?php prt(_g('cache')->selectitem('111>'.$jobData['degree'].'>sname')); ?></td>
                    </tr>
                    <tr>
                    	<td class="ftb w80">薪资范围</td>
                        <td class="w160"><?php prt(_g('cache')->selectitem('116>'.$jobData['wage'].'>sname')); ?>/<?php prt($JMODEL->wagetypeName(_g('cache')->selectitem('108>'.$jobData['wagetype'].'>flag'))); ?></td>
                        <td class="ftb w80"></td>
                        <td class="w240"></td>
                        <td class="ftb w80"></td>
                        <td class="w160"></td>
                    </tr>
                </table>
            </div>
            
            <div class="xcfl clearfix">
            	<div class="ln"><strong>薪酬福利：</strong></div>
                <div class="ts">
                	<?php foreach(_g('value')->s2pnsplit2($jobData['benefit']) as $v){ ?>
					<span><?php prt(_g('cache')->selectitem('121>'.$v.'>sname')); ?></span>
                    <?php } ?>
                </div>
            </div>
            
        	<div class="text clearfix">
            	<?php prt($jobData['content']); ?>
            </div>
            <?php if(strlen($jobData['area_detail'])>=1){ ?>
            <div class="address clearfix">
            	<strong>工作地址：</strong><?php foreach(_g('value')->s2pnsplit2($jobData['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?><?php } ?><?php prt($jobData['area_detail']); ?>
            </div>
            <?php } ?>
            
            <?php if(strlen($jobData['zplxid'])>=1){ ?>
            <div class="zplx clearfix">
            	<div class="ln"><strong>联系人：</strong></div>
                <div class="lxs">
				<?php foreach(_g('value')->s2pnsplit2($jobData['zplxid']) as $v){ ?>
                	<?php $zplxRs = $JZPLX->find(array('zplxid'=>$v,'status'=>1)); ?>
                    <?php if(my_is_array($zplxRs)){ ?>
					<p><?php prt($zplxRs['zname']); ?><?php prt($JMODEL->mplxfs($zplxRs, '&nbsp;')); ?><?php prt($JMODEL->tplxfs($zplxRs, '&nbsp;&nbsp;手机:&nbsp;')); ?><?php prt($JMODEL->emaillxfs($zplxRs, '&nbsp;&nbsp;邮箱:&nbsp;')); ?></p>
                    <?php } ?>
				<?php } ?>
                </div>
            </div>
            <?php } ?>
            
            <div class="msg clearfix">*提醒：用人单位招聘人才，以任何名义向应聘者收取费用都属于违法（如体检费、兼职淘宝刷钻等），请应聘者提高警惕！</div>
        </div>
        <div class="j clearfix"><?php prt($cUserData['cdescription']); ?></div>
    </div>
    
    <div class="nns clearfix">
    	<a href="<?php prt(_g('uri')->su('job/ac/company/op/jobstep/id/' . _get('id') . '/jobid/' . $jobid)); ?>">学习方案</a>
        <a href="<?php prt(_g('uri')->su('job/ac/material')); ?>">学习资料</a>
        <a href="<?php prt(_g('uri')->su('job/ac/company/op/jobrz/id/' . _get('id') . '/jobid/' . $jobid)); ?>">我要认证</a>
        <a href="#" onclick="return _requestJobReady(this);">提递简历</a>
    </div>
</div>

<form method="post" onsubmit="return false;" id="form_request" _ready="<?php prt(_g('uri')->su('job/ac/request/op/ready')); ?>" _do="<?php prt(_g('uri')->su('job/ac/request/op/do')); ?>"><input type="hidden" name="jobid" value="<?php prt($jobid)?>" /><input type="hidden" name="resumeid" /><input type="hidden" name="recordid" /></form>

<!-- job-company-job// -->
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/request.js"></script>
<script language="javascript">
	$("#job-company-job").cjslip({ speed: 0, eventType: 'click', mainEl: '.bd', mainState: '.hd em' });
</script>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>