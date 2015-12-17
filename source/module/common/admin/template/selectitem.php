<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>本功能作用于选择项中的条目数据灵活自定义</p>
    <p class="txts"><em class="st">•</em>“标识名称”选择项的唯一标识，用作与匹配一些自定义的关联操作</p>
</div>

<div class="clearfix where-search">
	<form action="<?php prt(_g('cp')->uri()); ?>">
    <input type="hidden" name="mod" value="common" />
    <input type="hidden" name="ac" value="selectitem" />
	<div class="item">
        <span class="w-label">请选择类型：</span>
        <span class="w-ss">
        <select name="selectid" class="fs-ts">
            <option value="0">==请选择==</option>
            <?php foreach(_g('value')->ra(_g('module')->dv('@', 100003)) as $k=>$v): ?>
            <option value="<?php prt($k); ?>" <?php if($k == $selectid){ ?>selected="selected"<?php } ?>>(<?php prt($k); ?>)&nbsp;<?php prt($v['name']); ?></option>
            <?php endforeach; ?>
            </select>
        </span>
        <button type="submit" class="fbtn-ds w-ml">查询</button>
    </div>
    </form>
</div>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span checkbox-all="siid"><input type="checkbox" /></span></td>
            <td width="6%">排序</td>
            <td width="20%">标识名称</td>
            <td width="20%">选项名称</td>
            <td width="6%">启用</td>
            <td width="44%">&nbsp;</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $SELECTITEM->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span checkbox-item="siid"><input type="checkbox" name="siid[]" value="<?php prt($rs['siid']); ?>" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['siid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
            <td width="20%"><input type="text" name="flag[<?php prt($rs['siid']); ?>]" class="fs-ts-180" value="<?php prt($rs['flag']); ?>" /></td>
            <td width="20%"><input type="text" name="sname[<?php prt($rs['siid']); ?>]" class="fs-ts-180" value="<?php prt($rs['sname']); ?>" /></td>
            <td width="6%"><input type="checkbox" name="status[<?php prt($rs['siid']); ?>]" value="true" <?php prt(_g('validate')->sb2eq($rs['status']) ? 'checked="checked"' : null); ?> /></td>
            <td width="44%">&nbsp;</td>
        </tr>
        <?php } ?>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
        	<td width="4%" class="tc-d" align="right">添加:</td>
            <td width="6%"><input type="text" name="_listorder" class="fs-ts-50" value="0" /></td>
            <td width="20%"><input type="text" name="_flag" class="fs-ts-180" /></td>
            <td width="20%"><input type="text" name="_sname" class="fs-ts-180" /></td>
            <td width="6%"><input type="checkbox" name="_status" value="true" checked="checked" /></td>
            <td width="44%">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'add');">+添加</button>
            </td>
        </tr>
        
  		<tr class="bg-b trow-bline">
            <td colspan="6">
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
	"checkbox": "span[checkbox-all=siid]",
	"checkboxItem": "span[checkbox-item=siid]",
	"name": "siid[]"
});

function fsdo(_this, _t){
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/selectitem/op/add/selectid/' . $selectid)); ?>", {
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
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/selectitem/op/update/selectid/' . $selectid)); ?>", {
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
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/selectitem/op/delete/selectid/' . $selectid)); ?>", {
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