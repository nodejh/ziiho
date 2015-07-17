<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <input type="hidden" name="sortid" value="<?php prt($sortid); ?>" />
    <table class="tbox">
        <tr class="trow-bline">
        	<td width="100%" colspan="4">
            	<a href="<?php prt(_g('cp')->uri($subjectWriteUrl)); ?>" class="fa-cd icon-add">添加</a>
            	<a href="<?php prt(_g('cp')->uri('mod/job/ac/question')); ?>" class="fa-cd icon-page-goback">返回首页</a>
                <?php prt($pageNow); ?>
            </td>
        </tr>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span class="icon-checkbox" checkbox-all="qsid" checkbox-icon="true"><input type="checkbox" class="vis-n" /></span></td>
            <td width="30%">题目</td>
            <td width="16%">题型</td>
            <td width="50%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $JQuestion->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span class="icon-checkbox" checkbox-item="qsid" checkbox-icon="true"><input type="checkbox" name="qsid[]" value="<?php prt($rs['qsid']); ?>" class="vis-n" /></span></td>
            <td width="30%"><?php prt($rs['title']); ?></td>
            <td width="16%"><?php prt($JMODEL->qsType($rs['stype'], 'name')); ?></td>
            <td width="50%"><a href="<?php prt(_g('cp')->uri($subjectWriteUrl . '/qsid/' . $rs['qsid'])); ?>" class="tc-a">编辑</a></td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="4" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="4">
				<div class="clearfix z">
                	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'delete');">删除</button>
                    
                    <select name="new_questionid" class="fs-ts">
                    	<option value="0">==请选择题库==</option>
                        <?php while($qRs = $JQuestion->db->fetch_array($questionResult)){ ?>
                        <option value="<?php prt($qRs['questionid']); ?>"><?php prt($qRs['qname']); ?></option>
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
	"checkbox": "span[checkbox-all=qsid]",
	"checkboxItem": "span[checkbox-item=qsid]",
	"name": "qsid[]"
});

function fsdo(_this, _t){
	if(_t == "move"){
		window.top._GESHAI.dialog({
			"title": "移动题目操作",
			"data": "确定要移动题目内容吗？",
			"isCloseBtn": false,
			"isCancelBtn": true,
			"okBtnFunc" : function(){
				return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/qsubject/f/move/sortid/' . $sortid . '/questionid/' . $questionid)); ?>", {
					"start": function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
					},
					"success": function(d){
						_GESHAI.disbtn("", false);
						
						d.isCloseBtn = false;
						d.clickBgClose = true;
						d.title = "移动题目操作";
						window.top._GESHAI.dialog(d);
						if(d.status == 1){
							_GESHAI.redirect(d);
						}
					}
				});
			}
		});
	}else if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>确定要删除题目内容吗？</p><p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/qsubject/f/delete/sortid/' . $sortid . '/questionid/' . $questionid)); ?>", {
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