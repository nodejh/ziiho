<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_cuser">
	<input type="hidden" name="id" value="" />
	<button type="button" name="disabled-buttons" id="btn_delete" class="dis-n">删除</button>
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="15%">企业名称</td>
            <td width="20%">行业类型</td>
            <td width="10%">认证状态</td>
            <td width="55%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $CUser->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
             <td width="15%"><?php prt($rs['cname']); ?></td>
            <td width="20%">
            	<?php $CSortData = $CSort->get_finds(str2array($rs['csortid'])); ?>
                <?php if($CSortData[0] > 0){ ?>
                	<?php while($CSortRs = $CSort->db->fetch_array($CSortData[1])){ ?>
            		<p><?php prt($CSortRs['sname']); ?></p>
                    <?php } ?>
                <?php }else{ ?>
                -
                <?php } ?>
            </td>
            <td width="10%">
            	<?php if(_g('validate')->sb2eq($rs['authenticate'])){ ?>
            	<span class="icon-status-normal">已认证</span>
                <?php }else{ ?>
                <span class="icon-status-error">未认证</span>
                <?php } ?>
			</td>
            <td width="55%">
            <a class="fa-cd icon-page-go" href="<?php prt(_g('cp')->uri('mod/job/ac/cuser/op/detail/cuid/' . $rs['cuid'])); ?>">查看资料</a>
            <a class="fa-cd icon-delete" data-id="<?php prt($rs['cuid']); ?>" onclick="fsdo(this, 'delete')">删除</a></td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="4" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="4"><?php _g('cp')->page($pageData); ?></td>
        </tr>
    </table>
	</form>
</div>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this, _t){
	var _thisForm = document.getElementById("form_cuser");
	if(_t == "delete"){
		var _thisBtn = document.getElementById("btn_delete");
			_thisForm.id.value = _this.getAttribute("data-id");
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>与其下关联的子级，同时也将一并删除。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_thisBtn, "<?php prt(_g('cp')->uri('mod/job/ac/cuser/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_thisForm.id.value = "";
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