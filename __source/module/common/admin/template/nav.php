<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_nav">
	<input type="hidden" name="id" value="" />
	<button type="button" name="disabled-buttons" id="btn_delete" class="dis-n">删除</button>
    <table class="tbox">
        <tr class="trow-bline">
            <td colspan="5"><a class="fa-cd icon-add" onclick="_GESHAI.redirect({'url': '<?php prt(_g('cp')->uri($writeUrlStr)); ?>'});">添加</a>
            </td>
        </tr>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%">ID</td>
            <td width="6%">排序</td>
            <td width="40%">名称</td>
            <td width="6%">启用</td>
            <td width="44%">操作</td>
        </tr>
  		<?php $nav->include_list(); ?>
  		<tr class="bg-b trow-bline">
            <td colspan="5">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">更新</button>
            </td>
        </tr>
    </table>
	</form>
</div>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this, _t){
	var _thisForm = document.getElementById("form_nav");
	if(_t == "delete"){
		var _thisBtn = document.getElementById("btn_delete");
			_thisForm.id.value = _this.getAttribute("data-id");
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除该导航，将不可恢复。</p><p>与其下关联的子导航，同时也将一并删除。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_thisBtn, "<?php prt(_g('cp')->uri('mod/common/ac/nav/op/delete')); ?>", {
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
	}else{
		return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/nav/op/update')); ?>", {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				if(d.status != 1){
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "操作失败";
					window.top._GESHAI.dialog(d);
				}else if(d.status == 1){
					window.top._GESHAI.dialog.close();
					_GESHAI.redirect(d);
				}
			}
		});
	}
};
</script>
<!-- javascript//  -->