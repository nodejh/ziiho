<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php while($v = $this->db->fetch_array($result)){ ?>
	<?php if(my_array_value('channelid', $channelSub) != $v['channelid']){ ?>
<option value="<?php prt($v['channelid']); ?>"
	<?php if($channelSub['parentid'] == $v['channelid']){ ?>
	selected="selected" <?php } ?>>
            <?php if($index >= 1){ ?>
                <?php for($i = 0; $i < $index; $i++){ ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>┝
            <?php } ?>
            <?php prt($v['cname']); ?>
        </option>
<?php $this->option($channelSub, $v['channelid'], $index + 1); ?>
    <?php } ?>
<?php } ?>
<?php $index = 0; ?>