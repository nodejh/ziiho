<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;">
		<table class="tbox">
			<tr class="trow-bline">
				<td colspan="5"><a class="fa-cd icon-add"
					onclick="_GESHAI.redirect({'url': '<?php prt($writeUrl); ?>'});">添加</a>
        	<?php _g('cp')->menu->include_cpos($parentid); ?>
        </td>
			</tr>
			<tr class="bg-a trow-bline trow-fw">
				<td width="4%"><span class="icon-checkbox" checkbox-all="menuid"
					checkbox-icon="true"></span></td>
				<td width="6%">排序</td>
				<td width="14%">名称</td>
				<td width="14%">URL</td>
				<td width="62%">操作</td>
			</tr>
      
      <?php while($rs = _g('db')->fetch_array($dataResult)){ ?>
      <tr class="trow-bline bg-hover-a">
				<td width="4%"><span class="icon-checkbox" checkbox-item="menuid"
					checkbox-icon="true"><input type="checkbox" name="menuid[]"
						value="<?php prt($rs['menuid']); ?>" class="dis-n" /></span></td>
				<td width="6%"><input type="text"
					name="listorder[<?php prt($rs['menuid']); ?>]" class="fs-ts-50"
					value="<?php prt($rs['listorder']); ?>" /></td>
				<td width="14%"><input type="text"
					name="title[<?php prt($rs['menuid']); ?>]" class="fs-ts-140"
					value="<?php prt($rs['title']); ?>" /></td>
				<td width="14%"><input type="text"
					name="url[<?php prt($rs['menuid']); ?>]" class="fs-ts-140"
					value="<?php prt($rs['url']); ?>" /></td>
				<td width="62%"><a class="fa-cd icon-page-go"
					onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri('ac/menu/parentid/' . $rs['menuid'])); ?>'});">查看下级</a><a
					class="fa-cd icon-page-add"
					onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri($writeUrlStr . '/parentid/' . $rs['menuid'])); ?>'});">添加下级</a><a
					class="fa-cd icon-page-edit"
					onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri($writeUrlStr . '/menuid/' . $rs['menuid'])); ?>'});">编辑</a></td>
			</tr>
      <?php } ?>
      
      <tr class="bg-b trow-bline">
				<td colspan="5">
					<button type="button" name="disabled-buttons" class="fbtn-ds"
						onclick="fsdo(this);">更新</button>
					<button type="button" name="disabled-buttons" class="fbtn-ds"
						onclick="fsdo(this,'delete');">删除</button>
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
	"checkbox": "span[checkbox-all=menuid]",
	"checkboxItem": "span[checkbox-item=menuid]",
	"name": "menuid[]"
});

function fsdo(_this, _t){
	if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>与其下关联的子级，同时也将一并删除。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('ac/menu/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							d.isCloseBtn = false;
							d.clickBgClose = true;
							if(d.status != 1){
								d.title = "删除操作";
							}else{
								d.title = "删除操作";
							}
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
			});
	}else{
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('ac/menu/op/update')); ?>", {
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