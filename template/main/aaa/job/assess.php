<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<!-- //learn-list -->
<div class="com-w learn-list clearfix" id="learn-list">
	<div class="sbox clearfix">
    	<div class="ib clearfix">
            <div class="s1">行业分类：</div>
            <div class="s2">
                <?php foreach($parentResult as $value){ ?>
                <a <?php prt($spid == $value['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/assess/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
        
        <div class="ib ib-sp clearfix">
            <div class="s1">职位分类：</div>
            <div class="s2">
                <a <?php prt($scid == 'a' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/assess/spid/' . $spid . '/scid/a')); ?>">全部</a>
                <?php foreach($childResult as $child){ ?>
                <a <?php prt($scid == $child['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/assess/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- learn-list// -->

<!--//assess-wrap-->
<div class="clearfix assess-wrap">
    <!--//assess-area-->
    <div class="clearfix assess-area">
        <div class="clearfix label"><span class="light"></span><span class="t">认证中心</span></div>
        <div class="clearfix box">
        	<?php $index = 0; ?>
        	<?php while($val = _g('db')->result($JJOBResult)){ ?>
        	<div class="clearfix item <?php prt($index%4!=0 ? 'item-mr' : null); ?>">
            	<a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $val['cuid'])); ?>" class="img"><img src="<?php prt($CUSER->getLogo($val['cuid'])); ?>" /></a>
                
                <div class="clearfix tit"><a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>"><?php prt($val['jname']); ?></a></div>
                
                <div class="clearfix col"><span class="txt"><?php prt($JMODEL->sortValue($val['sortid'], 'sname')); ?></span></div>
                <div class="clearfix col">工作地点: <?php foreach(_g('value')->s2pnsplit2($val['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;<?php } ?></div>
                <div class="clearfix tags">
                	<?php foreach(_g('value')->s2pnsplit2($val['benefit']) as $v){ ?>
                	<span><?php prt(_g('cache')->selectitem('121>'.$v.'>sname')); ?></span>
                    <?php } ?>
                </div>
                <div class="clearfix btn"><a class="rz" href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>">测试</a></div>
            </div>
            <?php $index = $index + 1; ?>
            <?php } ?>
        </div>
        
        <?php if($index < 1){ ?>
        <div class="clearfix not"> >_< 拼了命也没有找到相关信息！</div>
        <?php } ?>
    </div>
    <!--assess-area//-->
    
    <?php _g('module')->trigger('job', 'model', null, 'page', $pageData); ?>
</div>
<!--//assess-wrap-->

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>