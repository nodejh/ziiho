<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_material">
    <table class="tbox">
    	 <tr class="trow-bline">
            <td colspan="6">
                <a href="<?php prt(_g('cp')->uri($materialWriteUrl)); ?>" class="fa-cd icon-add">添加</a>
            	<a href="<?php prt(_g('cp')->uri('mod/job/ac/provide')); ?>" class="fa-cd icon-page-goback">返回首页</a>
            	<?php prt($pageNow); ?>
            </td>
        </tr>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span class="icon-checkbox" checkbox-all="materialid" checkbox-icon="true"><input type="checkbox" class="vis-n" /></span></td>
            <td width="10%">封面</td>
            <td width="25%">名称</td>
            <td width="10%">含附件</td>
            <td width="16%">操作时间</td>
            <td width="40%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $JMaterial->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span class="icon-checkbox" checkbox-item="materialid" checkbox-icon="true"><input type="checkbox" name="materialid[]" value="<?php prt($rs['materialid']); ?>" class="vis-n" /></span></td>
             <td width="10%">
             	<?php if(strlen($rs['src']) < 1){ ?>
                无
                <?php }else{ ?>
                <img src="<?php prt($JMODEL->src($rs['src'])); ?>" width="90" />
                <?php } ?>
             </td>
            <td width="25%">
                <?php prt($rs['title']); ?>
            </td>
            <td width="10%">否</td>
            <td width="16%"><?php prt(date('Y-m-d H:i', $rs['ctime'])); ?></td>
            <td width="40%">
            	<a class="fa-cd icon-page-edit" href="<?php prt(_g('cp')->uri($materialWriteUrl . '/materialid/' . $rs['materialid'])); ?>">编辑</a>
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
				<div class="clearfix z"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'delete');">删除</button></div>
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
	"checkbox": "span[checkbox-all=materialid]",
	"checkboxItem": "span[checkbox-item=materialid]",
	"name": "materialid[]"
});

function fsdo(_this, _t){
	if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/item/f/material/d/delete/sortid/' . $sortid . '/provideid/' . $provideid . '/itemid/' . $itemid)); ?>", {
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