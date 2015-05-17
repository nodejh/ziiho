<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //company-list -->
<div class="com-w company-list clearfix" id="company-list">
    <div class="sbox clearfix">
    	<div class="s1">行业分类：</div>
        <div class="s2">
        	<a <?php prt($spid == 'a' ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/companys/spid/a')); ?>">全部</a>
			<?php foreach($parentResult as $value){ ?>
        	<a <?php prt($spid == $value['sortid'] ? 'class="on"' : ''); ?> href="<?php prt(_g('uri')->su('job/ac/companys/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
            <?php } ?>
        </div>
    </div>
    
    <!--//dlist-->
    <div class="dlist clearfix">
    	<ul>
        	<?php if($pageData['total'] >= 1){ ?>
        	<?php while($rs = _g('db')->result($compayResult)){ ?>
        	<li class="clearfix">
            	<div class="a1"><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" target="_blank"><?php prt($rs['cname']); ?></a></div>
                <div class="a2"><?php prt(my_substr($rs['cdescription'], 0, 40)); ?>...</div>
                <div class="a3"><?php prt($JMODEL->sortShow($rs['csortid'], 'sname')); ?></div>
                <div class="a4"><?php prt($JMODEL->areaPos($rs['area'], $rs['area_detail'])); ?></div>
            </li>
            <?php } ?>
            <?php }else{ ?>
            <li class="clearfix"><div class="empty">对不起，暂无该内容信息！</div></li>
            <?php } ?>
        </ul>
    </div>
    <!--dlist//-->
</div>
<!-- company-list// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $pageData); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>