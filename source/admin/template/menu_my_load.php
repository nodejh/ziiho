<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix ms">
    <?php while($v = $this->db->fetch_array($result)){ ?>
    <?php $isChild = is_array($this->find('parentid', $v['menuid'])); ?>
    <?php if($isChild){ ?>
    	<?php $defCss = 'tf-icon-minus';?>
    <?php }else{ ?>
    	<?php $defCss = 'tf-icon-point';?>
    <?php } ?>
    <?php
					
switch ($v ['urltype']) {
						case 'inside' :
							$url = _g ( 'cp' )->uri ( $v ['url'] );
							break;
						
						case 'outer' :
							$url = $v ['url'];
							break;
						
						default :
							$url = null;
							break;
					}
					?>
    <div class="clearfix is">
		<div class="t c">
			<div class="tf <?php prt($defCss); ?>" style="margin-left:<?php prt(($index * 14)); ?>px; padding-left:12px;" menuid="<?php prt($v['menuid']); ?>" urltype="<?php prt($v['urltype']); ?>" url="<?php prt($url); ?>" click-flag="true"><?php prt($v['title']); ?></div>
		</div>
            <?php $this->my_include_find($v['menuid'], $index + 1); ?>
    </div>
    <?php } ?>
    <?php $index = 1; ?>
</div>