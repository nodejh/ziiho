<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //work-list -->
<div class="com-w work-list clearfix" id="work-list">
	<div class="sbox clearfix">
    	<div class="ib clearfix">
            <div class="s1">行业分类：</div>
            <div class="s2">
                <?php foreach($parentResult as $value){ ?>
                <a <?php prt($spid == $value['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/work/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
        
        <div class="ib ib-sp clearfix">
            <div class="s1">职位分类：</div>
            <div class="s2">
                <a <?php prt($scid == 'a' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/work/spid/' . $spid . '/scid/a')); ?>">全部</a>
                <?php foreach($childResult as $child){ ?>
                <a <?php prt($scid == $child['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/work/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!--//spp-->
    <div class="spp clearfix">
    	<div class="line clearfix"></div>
    	<div class="nn clearfix"><a <?php prt($qType == 'a' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/work')); ?>">所有职位</a><a <?php prt($qType == 'new' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/work/t/new')); ?>">最新职位</a></div>
    </div>
    <!--spp//-->
    
    <!--//dlist-->
    <div class="dlist clearfix">
    	<ul>
        	<?php if($pageData['total'] >= 1){ ?>
        	<?php while($rs = _g('db')->result($JJOBResult)){ ?>
        	<li class="clearfix">
            	<div class="a1"><a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $rs['cuid'] . '/jobid/' . $rs['jobid'])); ?>" ><?php prt($rs['jname']); ?></a></div>
                <div class="a2"><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" ><?php prt($rs['cname']); ?></a></div>
                <div class="a3"><?php prt($JMODEL->areaPos($rs['area'], $rs['area_detail'])); ?></div>
                <div class="a4"><?php prt(person_time($rs['ctime'])); ?></div>
            </li>
            <?php } ?>
            <?php }else{ ?>
            <li class="clearfix"><div class="empty">对不起，暂无该内容信息！</div></li>
            <?php } ?>
        </ul>
    </div>
    <!--dlist//-->
</div>
<!-- work-list// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $pageData); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>