<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php while($v = $this->db->fetch_array($result)){ ?>
	<?php if(my_array_value('sortid', $sortSub) != $v['sortid']){ ?>
    	<option value="<?php prt($v['sortid']); ?>" <?php if($sortSub['parentid'] == $v['sortid']){ ?> selected="selected" <?php } ?>>
			<?php for($i = 0; $i < $index; $i++){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>┝
            <?php prt($v['sname']); ?>
        </option>
	<?php } ?>
    <?php $this->option($sortSub, $v['sortid'], $index + 1); ?>
<?php } ?>
<?php $index = 0; ?>