<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>请按“职位分类”查询关联的学习方案。在方案的集合，依次进入添加该方案的项目内容</p>
    <p class="txts"><em class="st">•</em>可用，当设置“不可用”时，该方案被保留，将不被使用</p>
</div>

<div class="clearfix where-search">
	<form action="<?php prt(_g('cp')->uri()); ?>">
    <input type="hidden" name="mod" value="job" />
    <input type="hidden" name="ac" value="provide" />
	<div class="item">
        <span class="w-label">职位分类：</span>
        <span class="w-ss">
        <select name="sortid" class="fs-ts">
            <option value="0">==请选择分类==</option>
            <?php $sortStatusTrue = _g('value')->sb( true ); ?>
            <?php $sParentResult = $SORT->finds(array('parentid'=> 0, 'status' => $sortStatusTrue)); ?>
            <?php while($sPV = $PROVIDE->db->fetch_array($sParentResult)){ ?>
            <optgroup label="<?php prt($sPV['sname']); ?>">
                <?php $sChildResult = $SORT->finds(array('parentid'=> $sPV['sortid'], 'status' => $sortStatusTrue)); ?>
                <?php while($sCV = $PROVIDE->db->fetch_array($sChildResult)){ ?>
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
	<form method="post" onsubmit="return false;" id="form_provide">
    <input type="hidden" name="sortid" value="<?php prt($sortid); ?>" />
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span class="icon-checkbox" checkbox-all="provideid" checkbox-icon="true"><input type="checkbox" class="vis-n" /></span></td>
            <td width="6%">排序</td>
            <td width="25%">方案名称</td>
            <td width="16%">项目数量</td>
            <td width="10%">可用</td>
            <td width="39%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $PROVIDE->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span class="icon-checkbox" checkbox-item="provideid" checkbox-icon="true"><input type="checkbox" name="provideid[]" value="<?php prt($rs['provideid']); ?>" class="vis-n" /></span></td>
            <td width="6%"><input type="text" name="listorder[<?php prt($rs['provideid']); ?>]" class="fs-ts-50" value="<?php prt($rs['listorder']); ?>"></td>
            <td width="25%"><input type="text" name="pname[<?php prt($rs['provideid']); ?>]" class="fs-ts-240" value="<?php prt($rs['pname']); ?>" /></td>
            <td width="16%"><?php prt($PROVIDE->count('provideid', $rs['provideid'])); ?></td>
            <td width="10%"><input type="checkbox" name="status[<?php prt($rs['provideid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
            <td width="39%"><a href="<?php prt(_g('cp')->uri($itemsUrl . '/provideid/' . $rs['provideid'])); ?>" class="tc-a">管理项目</a></td>
        </tr>
        <?php } ?>
        <?php } ?>
        
        <tr class="trow-bline bg-hover-a">
        	<td width="4%" class="tc-d" align="right">添加:</td>
            <td width="6%"><input type="text" name="_listorder" class="fs-ts-50" value="0"></td>
            <td width="25%"><input type="text" name="_pname" class="fs-ts-240" /></td>
            <td width="16%">&nbsp;</td>
            <td width="10%"><input type="checkbox" name="_status" value="true" checked="checked" /></td>
            <td width="39%">
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
<?php } ?>

<!-- //javascript -->
<script language="javascript">
_GESHAI.checkbox({
	"fClass": "icon-checkbox",
	"tClass": "icon-checkboxed",
	"checkbox": "span[checkbox-all=provideid]",
	"checkboxItem": "span[checkbox-item=provideid]",
	"name": "provideid[]"
});

function fsdo(_this, _t){
	if(_t == "add"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/add')); ?>", {
				"start": function(){
					_GESHAI.disbtn("", true);
					window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
				},
				"success": function(d){
					_GESHAI.disbtn("", false);
					
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "添加“方案”";
					window.top._GESHAI.dialog(d);
					if(d.status == 1){
						_GESHAI.redirect(d);
					}
				}
			});
	}else if(_t == "update"){
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/update')); ?>", {
				"start": function(){
					_GESHAI.disbtn("", true);
					window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
				},
				"success": function(d){
					_GESHAI.disbtn("", false);
					
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "更新“方案”";
					window.top._GESHAI.dialog(d);
					if(d.status == 1){
						_GESHAI.redirect(d);
					}
				}
			});
	}else if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除“方案”",
				"data": "<p>若删除选项，将不可恢复。</p><p>与其下关联的“方案项目”和“学习资料”，不会被删除。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/provide/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除“方案”";
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