<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>本功能作用于过滤站点会员提交的，不文明词、恶意词语或影响站点形象的词语</p>
    <p class="txts"><em class="st">•</em>“敏感词”表示要被过滤的词语，“替换词”表示被过滤后要显示的词语</p>
</div>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span checkbox-all="fwid"><input type="checkbox" /></span></td>
            <td width="20%">过滤词</td>
            <td width="20%">替换词</td>
            <td width="6%">启用</td>
            <td width="50%">&nbsp;</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $FILTERWORD->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span checkbox-item="fwid"><input type="checkbox" name="fwid[]" value="<?php prt($rs['fwid']); ?>" /></span></td>
            <td width="20%"><input type="text" name="fword[<?php prt($rs['fwid']); ?>]" class="fs-ts-180" value="<?php prt($rs['fword']); ?>" /></td>
            <td width="20%"><input type="text" name="rword[<?php prt($rs['fwid']); ?>]" class="fs-ts-180" value="<?php prt($rs['rword']); ?>" /></td>
            <td width="6%"><input type="checkbox" name="status[<?php prt($rs['fwid']); ?>]" value="true" <?php prt(_g('validate')->sb2eq($rs['status']) ? 'checked="checked"' : null); ?> /></td>
            <td width="50%">&nbsp;</td>
        </tr>
        <?php } ?>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
        	<td width="4%" class="tc-d" align="right">添加:</td>
            <td width="20%"><input type="text" name="_fword" class="fs-ts-180" /></td>
            <td width="20%"><input type="text" name="_rword" class="fs-ts-180" /></td>
            <td width="6%"><input type="checkbox" name="_status" value="true" /></td>
            <td width="50%">
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
	"checkbox": "span[checkbox-all=fwid]",
	"checkboxItem": "span[checkbox-item=fwid]",
	"name": "fwid[]"
});

function fsdo(_this, _t){
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/filterword/op/add')); ?>", {
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
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/filterword/op/update')); ?>", {
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
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/filterword/op/delete')); ?>", {
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