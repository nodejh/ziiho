<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($uGroupData as $k=>$v){ ?>
	<a href="javascript:;" class="ml2 <?php prt($v['v'] == $ugtype ? 'on' : null); ?>" onclick="urlRedirect('<?php prt(_g('cp')->uri('mod/user/ac/usergroup/ugtype/' . $v['v'])); ?>');"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<div class="clearfix ul-box">
    <ul class="ubox">
        <li class="clearfix is">
			<span class="tc-a fw">当前正在对“<?php prt(my_array_value('gname', $usergroupSub)); ?>”管理设置</span>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="ugid" value="<?php prt(my_array_value('ugid', $usergroupSub)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is bg-a">
            <div class="clearfix tit">管理选项:</div>
        </li>
        
        <li class="clearfix is-def">
            <div class="clearfix ugmsetting_menu">
                <?php _g('cp')->menu->selectHtml(my_array_value('menuid', $mgrData)); ?>
            </div>
        </li>
	</ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt($curUrl); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });

var _checkboxs = $("span[checkbox-item=\"checkbox\"]");
_GESHAI.checkbox({
	"fClass": "icon-checkbox",
	"tClass": "icon-checkboxed",
	/*"checkbox": "span[checkbox-all=menuid]",*/
	"checkboxItem": "span[checkbox-item=checkbox]",
	"name": "menuid[]",
	"tFunc": function(b, i){
		var _ids = _checkboxs.eq(i).attr("level");
			_ids = _ids.split(',');
		for(var j = 0; j < _ids.length; j++){
			var _obj = $("span[flag=\"" + _ids[j] + "\"]");
				_obj.attr("checkbox-status", "true");
				_obj.addClass("color100");
				_obj.find("input[name=\"menuid[]\"]").attr("checked", "checked");
		}
	},
	"fFunc": function(b, i){
		_checkboxs.eq(i).parent(".ugms_tit").parent(".ugms_is").find("span[checkbox-item=\"checkbox\"]").each(function(index, element) {
            $(this).attr("checkbox-status", "");
			$(this).removeClass("color100");
			$(this).find("input[name=\"menuid[]\"]").attr("checked", "");
        });
	}
});


function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/usergroup/op/msettingdo')); ?>", {
		"goback": "<?php prt($curUrl); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			
			d.isCloseBtn = false;
			d.clickBgClose = true;
			if(d.status != 1){
				d.title = "操作失败";
			}else{
				d.title = "操作成功";
			}
			window.top._GESHAI.dialog(d);
		}
	});
};
</script>
<!-- javascript// -->