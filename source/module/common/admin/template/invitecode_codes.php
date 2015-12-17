<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($navData as $k => $v){ ?>
	<a href="<?php prt(_g('cp')->uri($v['uri'])); ?>" class="ml1 <?php prt($ni == $k ? 'on' : null); ?>"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>“邀请码颁发”作为邀请码的状态标识，意味着用户已拥有或准备给予用户</p>
</div>

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_101">
    <table class="tbox">
    	 <tr class="trow-bline">
            <td colspan="6"><a class="fa-cd icon-add" onclick="createWindow();">邀请码生成</a>
            </td>
        </tr>
        <tr class="bg-a trow-bline trow-fw">
            <td width="4%"><span checkbox-all="icid"><input type="checkbox" /></span></td>
            <td width="20%">邀请码</td>
            <td width="14%">生成时间</td>
            <td width="14%">会员注册时间</td>
            <td width="10%">是否颁发</td>
            <td width="38%">&nbsp;</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $INVITE->db->fetch_array($invitecodeResult)){ ?>
        <tr class="trow-bline bg-hover-a">
        	<td width="4%"><span checkbox-item="icid"><input type="checkbox" name="icid[]" value="<?php prt($rs['icid']); ?>" /></span></td>
             <td width="20%"><?php prt($rs['code']); ?></td>
            <td width="14%"><?php prt(date('Y-m-d', $rs['ctime'])); ?></td>
            <td width="14%"><?php prt($rs['registeruid'] < 1 ? '<em class="tc-b">未注册</em>' : date('Y-m-d H:i', $rs['ctime'])); ?></td>
            <td width="10%">
                <?php if(_g('validate')->sb2eq($rs['isfree'])){ ?><em class="icon-status-normal color100">已颁发</em><?php }else{ ?><em class="tc-b">未颁发</em><?php } ?>
            </td>
            <td width="38%">&nbsp;</td>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="6" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="6">
				<div class="clearfix z"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo('delete');">删除</button><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo('award');">颁发邀请码</button></div>
				<?php _g('cp')->page($pageData); ?>
            </td>
        </tr>
    </table>
	</form>
</div>

<style type="text/css">
	#form_create { background:red;}
</style>
<textarea id="create_win" class="dis-n">
	<form method="post" onsubmit="return false;" id="form_create">
    <div class="clearfix ul-box">
        <ul class="ubox">
            <li class="clearfix is is-def">
                <div class="clearfix tit">生成个数</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-180" name="num" value="20"  />
                </div>
                <div class="clearfix des">每次最多批量生成20个</div>
            </li>
        </ul>
    </div>
    </form>
</textarea>

<!-- //javascript -->
<script language="javascript">
var _pageUrl = window.location.href;

_GESHAI.checkbox({
	"fClass": "icon-checkbox",
	"tClass": "icon-checkboxed",
	"checkbox": "span[checkbox-all=icid]",
	"checkboxItem": "span[checkbox-item=icid]",
	"name": "icid[]"
});

function createWindow(){
	window.top._GESHAI.dialog({
			"title": "邀请码生成",
			"data": $("#create_win").val(),
			"isCancelBtn": true,
			"okBtnFunc" : function(){
				return window.top._GESHAI.fsubmit(window.top.document.getElementById("form_create"), "<?php prt(_g('cp')->uri('mod/common/ac/invitecode/op/createdo')); ?>", {
					"start": function(){
						_GESHAI.disbtn("", true);
					},
					"success": function(d){
						_GESHAI.disbtn("", false);
						if(d.status != 1){
							alert(d.data);
						}else{
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "邀请码生成";
							window.top._GESHAI.dialog(d);
							urlRedirect(_pageUrl);
						}
					}
				});
			}
		});
};

function fsdo(_type){
	var _form = document.getElementById("form_101");
	var _ids = document.getElementsByName("icid[]");
	var _ckFlag = false;
	for(var i = 0; i < _ids.length; i++){
		if(_ids.item(i).checked == true){
			_ckFlag = true;
			break;
		}
	}
	if(!_ckFlag){
		window.top._GESHAI.dialog({ "title": "邀请码删除", "data": "请至少选择一项！", "clickBgClose": true, "isCloseBtn": false});
		return null;
	}
	if(_type == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除“邀请码”",
				"data": "删除后不可恢复，您确定要删除这些邀请码么？",
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_form, "<?php prt(_g('cp')->uri('mod/common/ac/invitecode/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除“邀请码”";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								urlRedirect(_pageUrl);
							}
						}
					});
				}
			});
	}else if(_type == "award"){
		window.top._GESHAI.dialog({
				"title": "颁发“邀请码”",
				"data": "您确定要颁发这些邀请码么？",
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_form, "<?php prt(_g('cp')->uri('mod/common/ac/invitecode/op/awarddo')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "颁发“邀请码”";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								urlRedirect(_pageUrl);
							}
						}
					});
				}
			});
	}
};
</script>
<!-- javascript//  -->