<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span checkbox-all="professionid"><input type="checkbox" /></span></td>
            <td width="6%">排序</td>
            <td width="20%">名称</td>
            <td width="6%">可用</td>
            <td width="70%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span checkbox-item="professionid"><input type="checkbox" name="professionid[]" value="<?php prt($rs['professionid']); ?>" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['professionid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
            <td width="20%"><input type="text" name="pname[<?php prt($rs['professionid']); ?>]" class="fs-ts-180" value="<?php prt($rs['pname']); ?>" /></td>
            <td width="6%"><input type="checkbox" name="status[<?php prt($rs['professionid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
            <td width="64%">&nbsp;</td>
        </tr>
        <?php } ?>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
        	<td width="4%" class="tc-d" align="right">添加:</td>
            <td width="6%"><input type="text" name="_listorder" class="fs-ts-50" value="0" /></td>
            <td width="20%"><input type="text" name="_pname" class="fs-ts-180" /></td>
            <td width="6%"><input type="checkbox" name="_status" value="true" checked="checked" /></td>
            <td width="64%">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'add');">+添加</button>
            </td>
        </tr>
        
  		<tr class="bg-b trow-bline">
            <td colspan="5">
				<div class="clearfix z"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'delete');">删除</button><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'update');">更新</button></div>
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
	"checkbox": "span[checkbox-all=professionid]",
	"checkboxItem": "span[checkbox-item=professionid]",
	"name": "professionid[]"
});

function fsdo(_this, _t){
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/cuser/ac/profession/op/add')); ?>", {
				"start": function(){
					_GESHAI.disbtn("", true);
					window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
				},
				"success": function(d){
					_GESHAI.disbtn("", false);
					
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "添加操作";
					window.top._GESHAI.dialog(d);
					if(d.status == 1){
						_GESHAI.redirect(d);
					}
				}
			});
	}else if(_t == "update"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/cuser/ac/profession/op/update')); ?>", {
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
	}else if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/cuser/ac/profession/op/delete')); ?>", {
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
	}
};
</script>
<!-- javascript//  -->