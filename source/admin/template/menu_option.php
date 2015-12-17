<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php while($v = $this->db->fetch_array($result)){ ?>
	<?php if(my_array_value('menuid', $menuSub) != $v['menuid']){ ?>
<option value="<?php prt($v['menuid']); ?>"
	<?php if($menuSub['parentid'] == $v['menuid']){ ?> selected="selected"
	<?php } ?>>
            <?php if($index >= 1){ ?>
                <?php for($i = 0; $i < $index; $i++){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>┝
            <?php } ?>
            <?php prt($v['title']); ?>
        </option>
<?php $this->option($menuSub, $v['menuid'], $index + 1); ?>
    <?php } ?>
<?php } ?>
<?php $index = 0; ?>