<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
	
<?php while($rs = $this->db->fetch_array($dataResult)){ ?>
    <tr class="trow-bline bg-hover-a">
        <td width="4%"><input type="hidden" name="channelid[]" value="<?php prt($rs['channelid']); ?>" /><span class="tc-b"><?php prt($rs['channelid']); ?></span></td>
        <td width="6%"><input type="text" name="listorder[<?php prt($rs['channelid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
        <td width="40%"><?php if($index >= 1){ ?><em style="padding-left:<?php prt($index * 16); ?>px; padding-right:5px;" class="tc-b"><?php if(is_array($this->find('parentid', $rs['channelid']))){ ?>├────<?php }else{ ?>└────<?php } ?></em><?php } ?><input type="text" name="cname[<?php prt($rs['channelid']); ?>]" class="fs-ts-140 <?php if($index < 1){ ?>t-fw<?php } ?>" value="<?php prt($rs['cname']); ?>" /><a class="ns fa-cd icon-add2" title="添加子栏目" onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri($writeUrlStr . '/parentid/' . $rs['channelid'])); ?>'});"></a></td>
        <td width="6%"><input type="checkbox" name="status[<?php prt($rs['channelid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
        <td width="44%"><a class="fa-cd icon-page-edit" onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri($writeUrlStr . '/channelid/' . $rs['channelid'])); ?>'});">编辑</a>
            <a class="fa-cd icon-delete" data-id="<?php prt($rs['channelid']); ?>" onclick="fsdo(this, 'delete')">删除</a></td>
    </tr>
    <?php $this->include_list($rs['channelid'], ($index + 1)); ?>
<?php } ?>
<?php $index = 0; ?>