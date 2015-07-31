<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($selectData as $k => $v){ ?>
	<a href="<?php prt(_g('cp')->uri($v['uri'])); ?>" class="ml1 <?php prt($selectInd == $k ? 'on' : null); ?>"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>添加幻灯内容的分组，对幻灯分组实现前台不同地方的展示效果</p>
</div>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span checkbox-all="gid"><input type="checkbox" /></span></td>
            <td width="6%">排序</td>
            <td width="20%">名称</td>
            <td width="70%">&nbsp;</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $EXHIBIT->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span checkbox-item="gid"><input type="checkbox" name="gid[]" value="<?php prt($rs['gid']); ?>" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['gid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
            <td width="20%"><input type="text" name="gname[<?php prt($rs['gid']); ?>]" class="fs-ts-180" value="<?php prt($rs['gname']); ?>" /></td>
            <td width="70%">&nbsp;</td>
        </tr>
        <?php } ?>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
        	<td width="4%" class="tc-d" align="right">添加:</td>
            <td width="6%"><input type="text" name="_listorder" class="fs-ts-50" /></td>
            <td width="20%"><input type="text" name="_gname" class="fs-ts-180" /></td>
            <td width="70%">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'add');">+添加</button>
            </td>
        </tr>
        
  		<tr class="bg-b trow-bline">
            <td colspan="4">
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
	"checkbox": "span[checkbox-all=gid]",
	"checkboxItem": "span[checkbox-item=gid]",
	"name": "gid[]"
});

function fsdo(_this, _t){
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/gadd/i/1')); ?>", {
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
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/gupdate/i/1')); ?>", {
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
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/gdelete/i/1')); ?>", {
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