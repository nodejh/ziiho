<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php while($v = $this->db->fetch_array($result)){ ?>
	<?php if(my_array_value('navid', $navSub) != $v['navid']){ ?>
<option value="<?php prt($v['navid']); ?>"
	<?php if($navSub['parentid'] == $v['navid']){ ?>
	selected="selected" <?php } ?>>
            <?php if($index >= 1){ ?>
                <?php for($i = 0; $i < $index; $i++){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>┝
            <?php } ?>
            <?php prt($v['nname']); ?>
        </option>
<?php $this->option($navSub, $v['navid'], $index + 1); ?>
    <?php } ?>
<?php } ?>
<?php $index = 0; ?>