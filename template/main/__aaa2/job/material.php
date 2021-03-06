<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'learn-nav'); ?>

<!-- //material-list -->
<div class="com-w material-list clearfix" id="material-list">
	<div class="sbox clearfix">
    	<div class="ib clearfix">
            <div class="s1">行业分类：</div>
            <div class="s2">
                <?php foreach($parentResult as $value){ ?>
                <a <?php prt($spid == $value['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/material/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
        
        <div class="ib ib-sp clearfix">
            <div class="s1">职位分类：</div>
            <div class="s2">
                <a <?php prt($scid == 'a' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/material/spid/' . $spid . '/scid/a')); ?>">全部</a>
                <?php foreach($childResult as $child){ ?>
                <a <?php prt($scid == $child['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/material/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!--//qqq-->
    <div class="qqq clearfix">
    	<a href="#" class="on"><em class="zx"></em>最新</a><a href="#"><em class="rq"></em>人气</a><a href="#"><em class="xg"></em>相关</a>
    </div>
    <!--qqq//-->
    
    <!--//dlist-->
    <div class="dlist clearfix">
    	<ul>
        	<?php if($pageData['total'] >= 1){ ?>
        	<?php while($rs = _g('db')->result($dataResult)){ ?>
        	<li class="clearfix">
            	<div class="pic clearfix">
                	<a href="<?php prt(_g('uri')->su('job/ac/material/op/view/id/' . $rs['materialid'])); ?>"><img src="<?php prt($JMODEL->src($rs['src'])); ?>" /></a>
                </div>
                <div class="ddd clearfix">
                	<div class="aaa clearfix">
                    	<p class="t1"><a href="<?php prt(_g('uri')->su('job/ac/material/op/view/id/' . $rs['materialid'])); ?>"><?php prt($rs['title']); ?></a></p>
                        <!--<p class="t2">作者：<?php prt($rs['author']); ?></p>-->
                    </div>
                    <div class="bbb clearfix">
                    	<!--<p class="t1">内容简介</p>-->
                        <p class="t2"><?php prt(my_substr($rs['description'], 0, 120)); ?></p>
                    </div>
                    <div class="gogo clearfix"><a href="<?php prt(_g('uri')->su('job/ac/material/op/view/id/' . $rs['materialid'])); ?>">查看资料</a></div>
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
<!-- material-list// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $cUserPage); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>