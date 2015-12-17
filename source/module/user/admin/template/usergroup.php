<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($uGroupData as $k=>$v){ ?>
	<a href="javascript:;" class="ml2 <?php prt($v['v'] == $ugtype ? 'on' : null); ?>" onclick="urlRedirect('<?php prt(_g('cp')->uri('mod/user/ac/usergroup/ugtype/' . $v['v'])); ?>');"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<!-- //tabs -->
<div class="clearfix" tab="yes">
    
    <?php if($ugtype == 1){ ?>
    <!-- //系统用户组 -->
    <div class="clearfix table-box">
        <form method="post" onsubmit="return false;" id="formtj">
        <input type="hidden" name="actfalg" value="" />
        <input type="hidden" name="ugtype" value="<?php prt($ugtype); ?>" />
        <input type="hidden" name="id" value="" />
        <table class="tbox">
            <tr class="bg-a trow-bline trow-fw">
                <td width="6%">&nbsp;</td>
                <td width="20%">名称</td>
                <td width="20%">头衔</td>
                <td width="54%">操作</td>
            </tr>
            
            <?php while($rs = $UGROUP->db->fetch_array($uGroupResult)){ ?>
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" class="tc-b"><input type="hidden" name="ugid[]" value="<?php prt($rs['ugid']); ?>" /><?php prt($rs['ugid']); ?></td>
                <td width="20%"><input type="text" name="gname[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['gname']); ?>" /></td>
                <td width="20%"><input type="text" name="ranksrc[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['ranksrc']); ?>" /></td>
                <td width="54%"><a class="fa-cd icon_205" onclick="urlRedirect('<?php prt(_g('cp')->uri($mSettingUri . '/ugid/' . $rs['ugid'])); ?>');">管理设置</a><a class="fa-cd icon-set" onclick="urlRedirect('<?php prt(_g('cp')->uri($settingUri . '/ugid/' . $rs['ugid'])); ?>');">基本设置</a><a class="fa-cd icon-delete" data-id="<?php prt($rs['ugid']); ?>" onclick="fsdo('delete', this)">删除</a></td>
            </tr>
            <?php } ?>
            
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" align="right" class="tc-c">添加:</td>
                <td width="20%"><input type="text" name="_gname" class="fs-ts-180"  value="" /></td>
                <td width="20%"><input type="text" name="_ranksrc" class="fs-ts-180"  value="<?php prt($rs['aname']); ?>" /></td>
                <td width="54%"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo('add');">添加</button></td>
            </tr>
            
            <tr class="bg-b trow-bline">
                <td colspan="4">
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo();">更新</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <!-- 系统用户组// -->
    <?php }else if($ugtype == 2){ ?>
    
    <!-- //会员用户组 -->
    <div class="clearfix table-box">
        <form method="post" onsubmit="return false;" id="formtj">
        <input type="hidden" name="actfalg" value="" />
        <input type="hidden" name="ugtype" value="<?php prt($ugtype); ?>" />
        <input type="hidden" name="id" value="" />
        <table class="tbox">
            <tr class="bg-a trow-bline trow-fw">
                <td width="6%">&nbsp;</td>
                <td width="20%">名称</td>
                <td width="20%">经验值段</td>
                <td width="20%">头衔</td>
                <td width="34%">操作</td>
            </tr>
            
            <?php while($rs = $UGROUP->db->fetch_array($uGroupResult)){ ?>
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" class="tc-b"><input type="hidden" name="ugid[]" value="<?php prt($rs['ugid']); ?>" /><?php prt($rs['ugid']); ?></td>
                <td width="20%"><input type="text" name="gname[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['gname']); ?>" /></td>
                <td width="20%"><input type="text" name="sexp[<?php prt($rs['ugid']); ?>]" class="fs-ts-100"  value="<?php prt($rs['sexp']); ?>" /><em class="padding101">-</em><input type="text" name="eexp[<?php prt($rs['ugid']); ?>]" class="fs-ts-100"  value="<?php prt($rs['eexp']); ?>" /></td>
                <td width="20%"><input type="text" name="ranksrc[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['ranksrc']); ?>" /></td>
                <td width="34%"><a class="fa-cd icon-set" onclick="urlRedirect('<?php prt(_g('cp')->uri($settingUri . '/ugid/' . $rs['ugid'])); ?>');">基本设置</a><a class="fa-cd icon-delete" data-id="<?php prt($rs['ugid']); ?>" onclick="fsdo('delete', this)">删除</a></td>
            </tr>
            <?php } ?>
            
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" align="right" class="tc-c">添加:</td>
                <td width="20%"><input type="text" name="_gname" class="fs-ts-180"  value="" /></td>
                <td width="20%"><input type="text" name="_sexp" class="fs-ts-100"  value="" /><em class="padding101">-</em><input type="text" name="_eexp" class="fs-ts-100"  value="" /></td>
                <td width="20%"><input type="text" name="_ranksrc" class="fs-ts-180"  value="<?php prt($rs['aname']); ?>" /></td>
                <td width="34%"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo('add');">添加</button></td>
            </tr>
            
            <tr class="bg-b trow-bline">
                <td colspan="5">
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo();">更新</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <!-- 会员用户组// -->
    
    <?php }else if($ugtype == 3){ ?>
    
    <!-- //自定义用户组 -->
    <div class="clearfix table-box">
        <form method="post" onsubmit="return false;" id="formtj">
        <input type="hidden" name="actfalg" value="" />
        <input type="hidden" name="ugtype" value="<?php prt($ugtype); ?>" />
        <input type="hidden" name="id" value="" />
        <table class="tbox">
            <tr class="bg-a trow-bline trow-fw">
                <td width="6%">&nbsp;</td>
                <td width="20%">名称</td>
                <td width="20%">头衔</td>
                <td width="54%">操作</td>
            </tr>
            
            <?php while($rs = $UGROUP->db->fetch_array($uGroupResult)){ ?>
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" class="tc-b"><input type="hidden" name="ugid[]" value="<?php prt($rs['ugid']); ?>" /><?php prt($rs['ugid']); ?></td>
                <td width="20%"><input type="text" name="gname[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['gname']); ?>" /></td>
                <td width="20%"><input type="text" name="ranksrc[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['ranksrc']); ?>" /></td>
                <td width="54%"><a class="fa-cd icon-set" onclick="urlRedirect('<?php prt(_g('cp')->uri($settingUri . '/ugid/' . $rs['ugid'])); ?>');">基本设置</a><a class="fa-cd icon-delete" data-id="<?php prt($rs['ugid']); ?>" onclick="fsdo('delete', this)">删除</a></td>
            </tr>
            <?php } ?>
            
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" align="right" class="tc-c">添加:</td>
                <td width="20%"><input type="text" name="_gname" class="fs-ts-180"  value="" /></td>
                <td width="20%"><input type="text" name="_ranksrc" class="fs-ts-180"  value="<?php prt($rs['aname']); ?>" /></td>
                <td width="54%"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo('add');">添加</button></td>
            </tr>
            
            <tr class="bg-b trow-bline">
                <td colspan="4">
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo();">更新</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <!-- 自定义用户组// -->
    
    <?php }else if($ugtype == 4){ ?>
    <!-- //自定义用户组 -->
    <div class="clearfix table-box">
        <form method="post" onsubmit="return false;" id="formtj">
        <input type="hidden" name="actfalg" value="" />
        <input type="hidden" name="ugtype" value="<?php prt($ugtype); ?>" />
        <input type="hidden" name="id" value="" />
        <table class="tbox">
            <tr class="bg-a trow-bline trow-fw">
                <td width="6%">&nbsp;</td>
                <td width="20%">名称</td>
                <td width="20%">头衔</td>
                <td width="54%">操作</td>
            </tr>
            
            <?php while($rs = $UGROUP->db->fetch_array($uGroupResult)){ ?>
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" class="tc-b"><input type="hidden" name="ugid[]" value="<?php prt($rs['ugid']); ?>" /><?php prt($rs['ugid']); ?></td>
                <td width="20%"><input type="text" name="gname[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['gname']); ?>" /></td>
                <td width="20%"><input type="text" name="ranksrc[<?php prt($rs['ugid']); ?>]" class="fs-ts-180"  value="<?php prt($rs['ranksrc']); ?>" /></td>
                <td width="54%"><a class="fa-cd icon-set" onclick="urlRedirect('<?php prt(_g('cp')->uri($settingUri . '/ugid/' . $rs['ugid'])); ?>');">基本设置</a><a class="fa-cd icon-delete" data-id="<?php prt($rs['ugid']); ?>" onclick="fsdo('delete', this)">删除</a></td>
            </tr>
            <?php } ?>
            
            <tr class="trow-bline bg-hover-a">
            	<td width="4%" align="right" class="tc-c">添加:</td>
                <td width="20%"><input type="text" name="_gname" class="fs-ts-180"  value="" /></td>
                <td width="20%"><input type="text" name="_ranksrc" class="fs-ts-180"  value="<?php prt($rs['aname']); ?>" /></td>
                <td width="54%"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo('add');">添加</button></td>
            </tr>
            
            <tr class="bg-b trow-bline">
                <td colspan="4">
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo();">更新</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <!-- 自定义用户组// -->
    <?php } ?>
</div>
<!-- tabs// -->

<!-- //javascript -->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/calendar/WdatePicker.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/user/area.js"></script>
<script language="javascript">
/* doing */
function fsdo(_act, _this){
	var _form = document.getElementById("formtj");
		_form.actfalg.value = _act;
		_form.id.value = "";
	var _actUrls = {
			"add": "<?php prt(_g('cp')->uri('mod/user/ac/usergroup/op/add')); ?>",
			"update": "<?php prt(_g('cp')->uri('mod/user/ac/usergroup/op/update')); ?>",
			"delete": "<?php prt(_g('cp')->uri('mod/user/ac/usergroup/op/delete')); ?>",
		};
	if(!_act){
		_act = "update";
	}
	if(_act == "delete"){
		var __id = _this.getAttribute("data-id");
		_form.id.value = __id;
		var _title = document.getElementsByName("gname[" + __id + "]").item(0).value;
		window.top._GESHAI.dialog({
				"title": ("删除“" + _title + "”"),
				"data": "<p>若删除，将不可恢复</p><p>该用户组的设置功能也将同时失效</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_form, _actUrls[_act], {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							d.isCloseBtn = false;
							d.clickBgClose = true;
							
							if(d.status != 1){
								d.title = "错误：";
							}
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								urlRedirect(d.url);
							}
						}
					});
				}
			});
	}else{
		return _GESHAI.fsubmit(_form, _actUrls[_act], {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				d.isCloseBtn = false;
				d.clickBgClose = true;
				
				if(d.status != 1){
					d.title = "错误：";
				}
				window.top._GESHAI.dialog(d);
				if(d.status == 1){
					urlRedirect(d.url);
				}
			}
		});
	}
};
</script>
<!-- javascript// -->