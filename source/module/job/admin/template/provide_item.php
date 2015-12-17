<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_item">
    <table class="tbox">
    	 <td width="100%" colspan="6">
            <a href="<?php prt(_g('cp')->uri($writeUrl)); ?>" class="fa-cd icon-add">添加</a>
            <a href="<?php prt(_g('cp')->uri('mod/job/ac/provide')); ?>" class="fa-cd icon-page-goback">返回首页</a>
            <?php prt($pageNow); ?>
        </td>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span class="icon-checkbox" checkbox-all="itemid" checkbox-icon="true"><input type="checkbox" class="vis-n" /></span></td>
            <td width="6%">排序</td>
            <td width="40%">名称</td>
            <td width="10%">可用</td>
            <td width="12%">操作时间</td>
            <td width="28%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $PROVIDE->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span class="icon-checkbox" checkbox-item="itemid" checkbox-icon="true"><input type="checkbox" name="itemid[]" value="<?php prt($rs['itemid']); ?>" class="vis-n" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['itemid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>"></td>
            <td width="40%"><?php prt($rs['title']); ?></td>
            <td width="10%"><input type="checkbox" name="status[<?php prt($rs['itemid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
            <td width="12%"><?php prt(date('Y-m-d H:i', $rs['ctime'])); ?></td>
            <td width="28%">
                <a class="fa-cd icon-page-edit" href="<?php prt(_g('cp')->uri($writeUrl . '/itemid/' . $rs['itemid'])); ?>">编辑</a>
                <a class="fa-cd icon_206" href="<?php prt(_g('cp')->uri($materialUrl . '/itemid/' . $rs['itemid'])); ?>">资料管理</a>
            </td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="6" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="6">
				<div class="clearfix z">
                	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'delete');">删除</button>
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">更新</button>
                    
                    <select name="new_provideid" class="fs-ts">
                    	<option value="0">==请选择方案==</option>
                        <?php while($pRs = $PROVIDE->db->fetch_array($provideResult)){ ?>
                        <option value="<?php prt($pRs['provideid']); ?>"><?php prt($pRs['pname']); ?></option>
                        <?php } ?>
                    </select>
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'move');">移动所选</button>
                </div>
				<?php _g('cp')->page($pageData); ?>
            </td>
        </tr>
    </table>
	</form>
</div>

<!-- //javascript -->
<script language="javascript">
_GESHAI.checkbox({
	"fClass": "icon-checkbox",
	"tClass": "icon-checkboxed",
	"checkbox": "span[checkbox-all=itemid]",
	"checkboxItem": "span[checkbox-item=itemid]",
	"name": "itemid[]"
});

function fsdo(_this, _t){
	if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/item/f/delete/sortid/' . $sortid . '/provideid/' . $provideid)); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
		});
	} else if(_t == "move"){
		window.top._GESHAI.dialog({
				"title": "移动操作",
				"data": "<p>您确定要移动已选择的“方案条目”吗？</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/item/f/move/sortid/' . $sortid . '/provideid/' . $provideid)); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "移动操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
		});
	} else {
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/item/f/update/sortid/' . $sortid . '/provideid/' . $provideid)); ?>", {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "更新操作";
				window.top._GESHAI.dialog(d);
				if(d.status == 1){
					_GESHAI.redirect(d);
				}
			}
		});
	}
};
</script>
<!-- javascript//  -->