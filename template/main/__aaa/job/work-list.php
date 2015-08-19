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
                <a href="<?php prt(_g('uri')->su('job/ac/profession/op/c/sortid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                <?php } ?>
            </div>
        </div>
        
        <div class="ib ib-sp clearfix">
            <div class="s1">职位分类：</div>
            <div class="s2">
                <a href="#" class="on">全部</a>
                <?php for($i=0;$i<40;$i++){ ?>
                <a href="<?php prt(_g('uri')->su('job/ac/work/op/list/id/5')); ?>">机构组织</a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!--//spp-->
    <div class="spp clearfix">
    	<div class="line clearfix"></div>
    	<div class="nn clearfix"><a href="#" class="on">所有职位</a><a href="#">最新职位</a></div>
    </div>
    <!--spp//-->
    
    <!--//dlist-->
    <div class="dlist clearfix">
    	<ul>
        	<?php for($i=0;$i<40;$i++){ ?>
        	<li class="clearfix">
            	<div class="a1"><a href="#" target="_blank">应届生月薪5000+晋升</a></div>
                <div class="a2"><a href="#" target="_blank">人寿保险电销</a></div>
                <div class="a3">高新区</div>
                <div class="a4">今天</div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!--dlist//-->
</div>
<!-- work-list// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $cUserPage); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>