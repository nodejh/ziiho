<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php while($v = $this->db->fetch_array($result)){ ?>
	<?php if(my_array_value('areaid', $areaSub) != $v['areaid']){ ?>
<option value="<?php prt($v['areaid']); ?>"
	<?php if($areaSub['parentid'] == $v['areaid']){ ?>
	selected="selected" <?php } ?>>
            <?php if($index >= 1){ ?>
                <?php for($i = 0; $i < $index; $i++){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>┝
            <?php } ?>
            <?php prt($v['aname']); ?>
        </option>
<?php $this->option($areaSub, $v['areaid'], $index + 1); ?>
    <?php } ?>
<?php } ?>
<?php $index = 0; ?>