<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>


<!-- //com-bar -->
<ul class="nav nav-tabs">
	<?php foreach($data as $v){ ?>
	<?php if($__isFlag){ ?> <?php } ?>
	<li role="presentation"  <?php if(_get('ac') == $v['ac']){ ?> class="active" <?php } ?>>
		<a href="<?php prt(_g('uri')->su($v['uri'])); ?>" <?php if(_get('ac') == $v['ac'])  { ?>  class="zh-font-h3 zh-bgcolor-whitegrey" <?php } else { ?> class="zh-font-h3" <?php } ?>><?php prt($v['name']); ?></a>
	</li>
	<?php $__isFlag = true; ?>
	<?php } ?>
</ul>
<!-- com-bar// -->





