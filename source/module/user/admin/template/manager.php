<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix ul-box">
	<ul class="ubox">
    	 <li class="clearfix is">
         	<a class="fa-cd icon-add" onclick="_GESHAI.redirect({'url': '<?php prt(_g('cp')->uri('mod/user/ac/manager/op/create')); ?>'});">创建新用户</a>
         </li>
	</ul>
</div>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>输入相应的条件找关联用户</p>
</div>

<!-- // -->
<div class="clearfix ul-box">
	<form method="get" action="<?php prt(_g('cp')->uri()); ?>">
    <input type="hidden" name="mod" value="user" />
    <input type="hidden" name="ac" value="manager" />
    
	<ul class="ubox">
        
        <li class="clearfix is">
            <div class="clearfix z">
            	<p class="clearfix"><em class="padding100">UID:</em><input type="text" class="fs-ts-200" name="q_uid" value="<?php prt($_q_uid); ?>" /></p>
            </div>
            
            <div class="clearfix z margin100">
                <p class="clearfix"><em class="padding100">用户名:</em><input type="text" class="fs-ts-200" name="q_username" value="<?php prt($_q_username); ?>" /></p>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix z">
                <p class="clearfix"><em class="padding100">昵称:</em><input type="text" class="fs-ts-200" name="q_nickname" value="<?php prt($_q_nickname); ?>" /></p>
            </div>
            
            <div class="clearfix z margin102">
            	<p class="clearfix"><button type="submit" class="fbtn-ds">提交查询</button></p>
            </div>
        </li>
        
    </ul>
    </form>
</div>
<!-- // -->

<?php if($isWhere){ ?>
<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_user">
	<input type="hidden" name="id" value="" />
	<button type="button" name="disabled-buttons" id="btn_delete" class="dis-n">删除</button>
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="6%">头像</td>
            <td width="20%">用户名</td>
            <td width="20%">昵称</td>
            <td width="15%">注册时间</td>
            <td width="39%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $USER->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="6%"><img src="<?php prt($UAVATAR->src($rs)); ?>" width="50" height="50" /></td>
            <td width="20%"><?php prt($rs['username']); ?></td>
            <td width="20%"><?php prt($rs['nickname']); ?></td>
            <td width="15%"><?php prt(person_time($rs['regtime'], 'Y-m-d H:i:s')); ?></td>
            <td width="39%">
            <a class="fa-cd icon_205" href="<?php prt(_g('cp')->uri('mod/user/ac/manager/op/setting/r_uid/' . $rs['uid'])); ?>">设置</a>
            <a class="fa-cd icon-page-go" href="<?php prt(_g('cp')->uri('mod/user/ac/manager/op/detail/r_uid/' . $rs['uid'])); ?>">查看</a>
            </td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="5" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="5"><?php _g('cp')->page($pageData); ?></td>
        </tr>
    </table>
	</form>
</div>
<?php } ?>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this, _t){
	var _thisForm = document.getElementById("form_user");
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
	}else{
		
	}
};
</script>
<!-- javascript//  -->