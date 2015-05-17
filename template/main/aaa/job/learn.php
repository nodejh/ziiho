<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'learn-nav'); ?>

<!-- //learn-list -->
<div class="com-w learn-list clearfix" id="learn-list">
	<div class="sbox clearfix">
    	<div class="ib clearfix">
            <div class="s1">行业分类：</div>
            <div class="s2">
                <?php foreach($parentResult as $value){ ?>
                <a <?php prt($spid == $value['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
        
        <div class="ib ib-sp clearfix">
            <div class="s1">职位分类：</div>
            <div class="s2">
                <a <?php prt($scid == 'a' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . $spid . '/scid/a')); ?>">全部</a>
                <?php foreach($childResult as $child){ ?>
                <a <?php prt($scid == $child['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!--//qqq-->
    <div class="qqq clearfix">
    	<a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" class="on"><em class="zx"></em>最新</a><a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>"><em class="rq"></em>人气</a><a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>"><em class="xg"></em>相关</a>
    </div>
    <!--qqq//-->
    
    <!--//dlist-->
    <div class="dlist clearfix">
    	<ul>
        	<?php if($pageData['total'] >= 1){ ?>
        	<?php while($rs = _g('db')->result($dataResult)){ ?>
        	<li class="clearfix">
            	<div class="pic clearfix">
                	<a href="<?php prt(_g('uri')->su('job/ac/learn/op/view/jobid/' . $rs['jobid'])); ?>" target="_blank"><img src="<?php prt($CUSER->logo(my_array_value('logo', $CUSER->find_jion('a.cuid', $rs['cuid'])))); ?>" /></a>
                </div>
                <div class="ddd clearfix">
                	<div class="aaa clearfix">
                    	<p class="t1"><a href="<?php prt(_g('uri')->su('job/ac/learn/op/view/jobid/' . $rs['jobid'])); ?>" target="_blank"><?php prt($rs['jname']); ?></a></p>
                        <p class="t2">共有<em><?php prt($JSKILL->count('jobid', $rs['jobid'])); ?></em>项</p>
                    </div>
                    <div class="bbb clearfix">
                    	<p class="t1">职位说明</p>
                        <p class="t2"><?php prt(my_substr(strip_tags($rs['content']), 0, 120)); ?>...</p>
                    </div>
                    <div class="gogo clearfix"><a href="<?php prt(_g('uri')->su('job/ac/learn/op/view/jobid/' . $rs['jobid'])); ?>" target="_blank">查看方案</a></div>
                </div>
            </li>
            <?php } ?>
            <?php }else{ ?>
            <li class="clearfix empty">对不起，暂无该内容信息！</li>
            <?php } ?>
        </ul>
    </div>
    <!--dlist//-->
</div>
<!-- learn-list// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $pageData); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>