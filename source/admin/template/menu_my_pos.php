<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php $index = 0; ?>
<?php foreach($positionData as $v){ ?>
	<?php if($index >= 1){ ?>
<p class="ns">&raquo;</p>
<?php } ?>
<p class="ns"><?php prt($v['title']); ?></p>
<?php $index += 1; ?>
<?php } ?>