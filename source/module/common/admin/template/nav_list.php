<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
	
<?php while($rs = $this->db->fetch_array($dataResult)){ ?>
    <tr class="trow-bline bg-hover-a">
        <td width="4%"><input type="hidden" name="navid[]" value="<?php prt($rs['navid']); ?>" /><span class="tc-b"><?php prt($rs['navid']); ?></span></td>
        <td width="6%"><input type="text" name="listorder[<?php prt($rs['navid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
        <td width="40%"><?php if($index >= 1){ ?><em style="padding-left:<?php prt($index * 16); ?>px; padding-right:5px;" class="tc-b"><?php if(is_array($this->find('parentid', $rs['navid']))){ ?>├────<?php }else{ ?>└────<?php } ?></em><?php } ?><input type="text" name="nname[<?php prt($rs['navid']); ?>]" class="fs-ts-140 <?php if($index < 1){ ?>t-fw<?php } ?>" value="<?php prt($rs['nname']); ?>" /><a class="ns fa-cd icon-add2" title="添加子导航" onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri($writeUrlStr . '/parentid/' . $rs['navid'])); ?>'});"></a></td>
        <td width="6%"><input type="checkbox" name="status[<?php prt($rs['navid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
        <td width="44%"><a class="fa-cd icon-page-edit" onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri($writeUrlStr . '/navid/' . $rs['navid'])); ?>'});">编辑</a>
            <a class="fa-cd icon-delete" data-id="<?php prt($rs['navid']); ?>" onclick="fsdo(this, 'delete')">删除</a></td>
    </tr>
    <?php $this->include_list($rs['navid'], ($index + 1)); ?>
<?php } ?>
<?php $index = 0; ?>