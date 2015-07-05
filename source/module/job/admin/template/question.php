<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix where-search">
	<form action="<?php prt(_g('cp')->uri()); ?>">
    <input type="hidden" name="mod" value="job" />
    <input type="hidden" name="ac" value="question" />
	<div class="item">
        <span class="w-label">筛选分类：</span>
        <span class="w-ss">
        <select name="sortid" class="fs-ts">
            <option value="0">==请选择分类==</option>
            <?php $sortStatusTrue = _g('value')->sb( true ); ?>
            <?php $sParentResult = $sort->finds(array('parentid'=> 0, 'status' => $sortStatusTrue)); ?>
            <?php while($sPV = _g('db')->fetch_array($sParentResult)){ ?>
            <optgroup label="<?php prt($sPV['sname']); ?>">
                <?php $sChildResult = $sort->finds(array('parentid'=> $sPV['sortid'], 'status' => $sortStatusTrue)); ?>
                <?php while($sCV = _g('db')->fetch_array($sChildResult)){ ?>
                    <option value="<?php prt($sCV['sortid']); ?>" <?php if($sortid == $sCV['sortid']){ ?>selected="selected"<?php } ?> ><?php prt($sCV['sname']); ?></option>
                <?php } ?>
            </optgroup>
            <?php } ?>
        </select>
        </span>
        <button type="submit" class="fbtn-ds w-ml">查询</button>
    </div>
    </form>
</div>

<?php if(_g('validate')->pnum($sortid)){ ?>
<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <input type="hidden" name="sortid" value="<?php prt($sortid); ?>" />
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span class="icon-checkbox" checkbox-all="questionid" checkbox-icon="true"><input type="checkbox" class="vis-n" /></span></td>
            <td width="6%">排序</td>
            <td width="30%">题库名称</td>
            <td width="16%">题目数量</td>
            <td width="44%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $JQuestion->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span class="icon-checkbox" checkbox-item="questionid" checkbox-icon="true"><input type="checkbox" name="questionid[]" value="<?php prt($rs['questionid']); ?>" class="vis-n" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['questionid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>"></td>
            <td width="30%"><input type="text" name="qname[<?php prt($rs['questionid']); ?>]" class="fs-ts-240" value="<?php prt($rs['qname']); ?>" /></td>
            <td width="16%"><?php prt($JQS->count('questionid', $rs['questionid'])); ?></td>
            <td width="44%"><a href="<?php prt(_g('cp')->uri($subjectUrl . '/sortid/' . $rs['sortid'] . '/questionid/' . $rs['questionid'])); ?>" class="tc-a">管理</a></td>
        </tr>
        <?php } ?>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
        	<td width="4%" class="tc-d" align="right">添加:</td>
            <td width="6%"><input type="text" name="_listorder" class="fs-ts-50" value="0"></td>
            <td width="30%"><input type="text" name="_qname" class="fs-ts-240" /></td>
            <td width="60%" colspan="2">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'add');">提交</button>
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
<?php } ?>

<!-- //javascript -->
<script language="javascript">
_GESHAI.checkbox({
	"fClass": "icon-checkbox",
	"tClass": "icon-checkboxed",
	"checkbox": "span[checkbox-all=questionid]",
	"checkboxItem": "span[checkbox-item=questionid]",
	"name": "questionid[]"
});

function fsdo(_this, _t){
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/add')); ?>", {
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
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/update')); ?>", {
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
				"data": "<p>若删除选项，将不可恢复。</p><p>与其下关联的答题选项，同时也将一并删除。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/delete')); ?>", {
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