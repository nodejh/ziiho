<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- // -->
<div class="clearfix ul-box">
	<form method="get" action="<?php prt(_g('cp')->uri()); ?>">
    <input type="hidden" name="mod" value="job" />
    <input type="hidden" name="ac" value="synthetic" />
    
	<ul class="ubox">
        
        <li class="clearfix is">
            <div class="clearfix z">
            	<p class="clearfix">
                	<em class="padding100">类型:</em>
                    <select name="q_typeid" class="fs-ts-200">
                    	<option value="0">==请选择==</option>
                        <?php $siResult = _g('get')->selectitem(120); ?>
                    	<?php while($rs = _g('db')->result($siResult)){ ?>
                    	<?php if(!$JMODEL->is_sys($rs['flag'])){ ?>
                        <option value="<?php prt($rs['siid']); ?>" <?php prt($rs['siid'] == $typeid ? 'selected="selected"' : null); ?> ><?php prt($rs['sname']); ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </p>
            </div>
            
            <div class="clearfix z margin102">
            	<p class="clearfix"><button type="submit" class="fbtn-ds">提交查询</button></p>
            </div>
        </li>
        
    </ul>
    </form>
</div>
<!-- // -->

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_question">
    <input type="hidden" name="sortid" value="<?php prt($sortid); ?>" />
    <table class="tbox">
        <tr class="trow-bline">
        	<td width="100%" colspan="5">
            	<a href="<?php prt(_g('cp')->uri($writeUrl)); ?>" class="fa-cd icon-add">添加</a>
            </td>
        </tr>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span class="icon-checkbox" checkbox-all="syntheticid" checkbox-icon="true"><input type="checkbox" class="vis-n" /></span></td>
            <td width="30%">题目</td>
            <td width="16%">题型</td>
            <td width="6%">启用</td>
            <td width="44%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $SYNTHETIC->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span class="icon-checkbox" checkbox-item="syntheticid" checkbox-icon="true"><input type="checkbox" name="syntheticid[]" value="<?php prt($rs['syntheticid']); ?>" class="vis-n" /></span></td>
            <td width="30%"><?php prt($rs['title']); ?></td>
            <td width="16%"><?php prt($JMODEL->qsType($rs['stype'], 'name')); ?></td>
            <td width="6%"><input type="checkbox" name="status[<?php prt($rs['syntheticid']); ?>]" value="true" <?php if(_g('validate')->sb2eq($rs['status'])){ ?>checked="checked"<?php } ?> /></td>
            <td width="44%"><a href="<?php prt(_g('cp')->uri($writeUrl . '/syntheticid/' . $rs['syntheticid'])); ?>" class="tc-a">编辑</a></td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="5" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="5">
				<div class="clearfix z">
                	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this, 'delete');">删除</button>
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">更新</button>
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
	"checkbox": "span[checkbox-all=syntheticid]",
	"checkboxItem": "span[checkbox-item=syntheticid]",
	"name": "syntheticid[]"
});

function fsdo(_this, _t){
	if(_t == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>确定要删除题目内容吗？</p><p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/synthetic/op/delete')); ?>", {
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
	} else {
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/synthetic/op/update')); ?>", {
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