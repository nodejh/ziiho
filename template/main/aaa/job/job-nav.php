<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //com-bar -->
<div class="com-w com-bar clearfix">
	<div class="job-nav clearfix">
    	<?php foreach($data as $v){ ?>
        <?php if($__isFlag){ ?><em>|</em><?php } ?>
    	<a href="<?php prt(_g('uri')->su($v['uri'])); ?>" <?php if(_get('ac') == $v['ac']){ ?>class="on"<?php } ?> ><?php prt($v['name']); ?></a>
        <?php $__isFlag = true; ?>
        <?php } ?>
    </div>
    <?php include _g('template')->name('@', 'bar-search', true); ?>
</div>
<!-- com-bar// -->