<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //profession-data -->
<div class="com-w profession-data clearfix">
	<ul class="dbox">
    	<?php foreach($JMODEL->readSort() as $value){ ?>
        
        <li class="clearfix">
        	<div class="ttt clearfix"><a href="<?php prt(_g('uri')->su('job/ac/profession/op/c/sortid/' . $value['sortid'])); ?>" target="_blank"><?php prt($value['sname']); ?></a></div>
        	<div class="aaa clearfix">
            	<a href="<?php prt(_g('uri')->su('job/ac/profession/op/c/sortid/' . $value['sortid'])); ?>" target="_blank"><img src="<?php prt($JMODEL->sortSrc($value['src'])); ?>" width="380" height="240" /></a>
            </div>
            <div class="bbb clearfix">
            	<div class="a1">
                	<p class="n1"><strong>需求职位：</strong></p>
                    <p class="n2"><?php $__vvInd = 0; foreach($JMODEL->readSort($value['sortid']) as $vv){ if($__vvInd > 3) { break; } prt(($__vvInd != 0 ? '、' : '') . $vv['sname']); $__vvInd++; } ?> 等...</p>
                </div>
                <div class="a2">
                	<p class="n1"><strong>行业背景:</strong></p>
                    <p class="n2"><?php prt($value['sdescription']); ?></p>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<!-- profession-data// -->

<?php _g('module')->trigger('job', 'model', null, 'page', $cUserPage); ?>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>