<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>


<?php while($rs = $this->db->fetch_array($dataResult)){ ?>
	<?php $isChild = my_is_array($this->find('parentid', $rs['menuid'])); ?>
    
    <?php
    	$levelData = $this->cpos($rs['menuid']);
		$level_floors = null;
		foreach($levelData as $floorValue){
			$level_floors .= (!empty($level_floors) ? ',' : null);
			$level_floors .= $floorValue['menuid'];
		}
	?>
    <?php $isChecked = my_in_array($rs['menuid'], $mgrData); ?>
    
    <div class="clearfix ugms_is <?php if($index < 1){ ?>ugms_is_btline<?php } ?>">
        <div class="clearfix  ugms_tit">
            <span checkbox-item="checkbox" flag="<?php prt($rs['menuid']); ?>" level="<?php prt($level_floors); ?>" <?php prt($isChecked ? 'checkbox-status="true"' : null); ?> class="z ugms_tit_m <?php prt($isChecked ? 'color100' : null); ?>" style=" margin-left:<?php prt($index * ($index < 2 ? 20 : 25)); ?>px;"><?php if($index >= 1){ ?><em class="tc-b"><?php if(is_array($this->find('parentid', $rs['menuid']))){ ?>├──<?php }else{ ?>└──<?php } ?></em><?php } ?><em class="<?php if($index < 1){ ?>fw<?php } ?>"><input type="checkbox" name="menuid[]" value="<?php prt($rs['menuid']); ?>" <?php prt($isChecked ? 'checked="checked"' : null); ?> /><?php prt($rs['title']); ?></em></span>
        </div>
    <?php if($isChild){ ?>
		<?php $this->selectHtml($mgrData, $rs['menuid'], ($index + 1)); ?>
    <?php } ?>
    </div>
<?php } ?>

<?php $index = 0; ?>