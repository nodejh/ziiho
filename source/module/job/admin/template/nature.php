<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_nature">
	<input type="hidden" name="id" value="" />
	<button type="button" name="disabled-buttons" id="btn_delete" class="dis-n">删除</button>
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="6%">排序</td>
            <td width="40%">名称</td>
            <td width="6%">启用</td>
            <td width="48%">操作</td>
        </tr>
  		
		<?php while($rs = _g('db')->fetch_array($natureResult)){ ?>
        <tr class="trow-bline bg-hover-a">
            <td width="6%"><input type="hidden" name="natureid[]" value="<?php prt($rs['natureid']); ?>" /><input type="text" name="listorder[<?php prt($rs['natureid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
            <td width="40%"><input type="text" name="nname[<?php prt($rs['natureid']); ?>]" class="fs-ts-180" value="<?php prt($rs['nname']); ?>" /></td>
            <td width="6%"><input type="checkbox" name="status[<?php prt($rs['natureid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
            <td width="48%"><a class="fa-cd icon-delete" data-id="<?php prt($rs['natureid']); ?>" onclick="fsdo(this, 'delete')">删除</a></td>
        </tr>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
            <td width="6%"><input type="text" name="_listorder" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
            <td width="40%"><input type="text" name="_nname" class="fs-ts-180" value="<?php prt($rs['nname']); ?>" /></td>
            <td width="6%"><input type="checkbox" name="_status" value="true" checked="checked" /></td>
            <td width="48%"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'add');">添加</button></td>
        </tr>
        
  		<tr class="bg-b trow-bline">
            <td colspan="4">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">更新</button>
            </td>
        </tr>
    </table>
	</form>
</div>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this, _t){
	var _thisForm = document.getElementById("form_nature");
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/nature/op/add')); ?>", {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				if(d.status != 1){
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "操作失败";
					window.top._GESHAI.dialog(d);
				}else if(d.status == 1){
					window.top._GESHAI.dialog.close();
					_GESHAI.redirect(d);
				}
			}
		});
	}else if(_t == "delete"){
		var _thisBtn = document.getElementById("btn_delete");
			_thisForm.id.value = _this.getAttribute("data-id");
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_thisBtn, "<?php prt(_g('cp')->uri('mod/job/ac/nature/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_thisForm.id.value = "";
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
	}else{
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/nature/op/update')); ?>", {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				if(d.status != 1){
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "操作失败";
					window.top._GESHAI.dialog(d);
				}else if(d.status == 1){
					window.top._GESHAI.dialog.close();
					_GESHAI.redirect(d);
				}
			}
		});
	}
};
</script>
<!-- javascript//  -->