<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($selectData as $k => $v){ ?>
	<a href="<?php prt(_g('cp')->uri($v['uri'])); ?>" class="ml1 <?php prt($selectInd == $k ? 'on' : null); ?>"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>本功能作用于需要特定展示内容信息，如果首页处的“幻灯切换”</p>
    <p class="txts"><em class="st">•</em>可将要展示的内容进行“分组”规划，进行不同地方处的效果展示</p>
</div>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <table class="tbox">
    	<tr class="trow-bline">
            <td colspan="6"><a class="fa-cd icon-add" onclick="urlRedirect('<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/write/i/2')); ?>');">添加</a>
            </td>
        </tr>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span checkbox-all="eid"><input type="checkbox" /></span></td>
            <td width="6%">排序</td>
            <td width="30%">标题</td>
            <td width="10%">打开方式</td>
            <td width="14%">分组</td>
            <td width="6%">启用</td>
            <td width="30%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $EXHIBIT->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span checkbox-item="eid"><input type="checkbox" name="eid[]" value="<?php prt($rs['eid']); ?>" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['eid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>" /></td>
            <td width="30%"><?php prt($rs['title']); ?></td>
            <td width="10%"><?php prt(_g('module')->dv('@', '100001>' . $rs['target'] . '>name')); ?></td>
            <td width="14%"><?php prt(my_array_value('gname', $EXHIBIT->gfind('gid', $rs['gid']), '<em class="tc-d">x</em>')); ?></td>
            <td width="6%"><input type="checkbox" name="status[<?php prt($rs['eid']); ?>]" value="true" <?php prt(_g('validate')->sb2eq($rs['status']) ? 'checked="checked"' : null); ?> /></td>
            <td width="30%">
            	<a class="fa-cd icon-page-edit" href="<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/write/eid/' . $rs['eid'])); ?>">编辑</a>
            </td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="bg-b trow-bline">
            <td colspan="7" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="7">
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
	"checkbox": "span[checkbox-all=eid]",
	"checkboxItem": "span[checkbox-item=eid]",
	"name": "eid[]"
});

function fsdo(_this, _t){
	if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/delete')); ?>", {
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
	}else {
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/exhibit/op/update')); ?>", {
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