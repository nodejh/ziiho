<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //profession-job -->
<?php $arr = array('金融分析师', '国际投资分析师', '管理人员', '内勤人员', '采购', '建筑设计人员', '计算机'); ?>
<div class="com-w profession-job clearfix" id="profession-job">
	<div class="n clearfix">汽车制造行业</div>
    <div class="sbox clearfix">
    	<div class="s1">职位分类：</div>
        <div class="s2">
        	<a href="#" class="on">全部</a>
			<?php for($i=0;$i<40;$i++){ ?>
        	<a href="<?php prt(_g('uri')->su('job/ac/profession/op/c/id/5')); ?>"><?php prt($arr[rand(0,6)]); ?></a>
            <?php } ?>
        </div>
    </div>
    
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
<!-- profession-job// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $cUserPage); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>