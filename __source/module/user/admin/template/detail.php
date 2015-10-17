<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml2">个人信息</a><a href="javascript:;" class="ml2">头像设置</a><a href="javascript:;" class="ml2">密码设置</a>
</div>

<div class="clearfix ul-box">
	
    <ul class="ubox">
        <li class="clearfix is">
			<a class="fa-cd icon-page-goback" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</a>
			<span class="tc-a fw"><?php prt($rUserRs['username']); ?></span>
		</li>
	</ul>
</div>

<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
    
    <form method="post" onsubmit="return false;" class="dis-n" id="form_info">
    <input type="hidden" name="act_flag_name" />
    <input type="hidden" name="do_uid" value="<?php prt($rUserRs['uid']); ?>" />
    <input type="hidden" name="hometown" />
    <input type="hidden" name="residence" />
    <ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">昵称:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="nickname" value="<?php prt($rUserRs['nickname']); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">性别:</div>
            <div class="clearfix inp">
                <select class="fs-ts-200" name="gender">
                    <?php foreach(_g('value')->ra(_g('module')->dv('user', 100000)) as $v): ?>
                    <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('gender', $rUserRs, -1)){ ?>selected="selected"<?php } ?> ><?php prt($v['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">生日:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="birthday" value="<?php prt(date("Y-m-d", my_array_value('birthday',$rUserRs)));?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd',isShowToday:false,qsEnabled:false,isShowOK:false,minDate:'1960-01-01',maxDate:'<?php prt(date("Y-m-d", _g('cfg>time'))); ?>'})" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">感情状况:</div>
            <div class="clearfix inp">
                <select class="fs-ts-200" name="emotion">
                    <?php foreach(_g('value')->ra(_g('module')->dv('user', 100001)) as $v): ?>
                    <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('emotion', $rUserRs, -1)){ ?>selected="selected"<?php } ?> ><?php prt($v['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">故乡:</div>
            <div class="clearfix inp" id="area_data_100"></div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">现居地:</div>
            <div class="clearfix inp" id="area_data_101"></div>
        </li>
    </ul>
    </form>
    
    <form method="post" enctype="multipart/form-data" onsubmit="return false;" class="dis-n" id="form_avatar">
    <input type="hidden" name="act_flag_name" />
    <input type="hidden" name="do_uid" value="<?php prt($rUserRs['uid']); ?>" />
    <input type="hidden" name="del" value="false" />
    <ul class="ubox">
    	<?php if(my_is_array($userAvatar)){ ?>
    	<li class="clearfix is">
        	<div class="clearfix tit ta_101"><a href="javascript:;" onclick="fsdo('avatar_delete');">删除头像</a></div>
        	<div class="clearfix inp"><img src="<?php prt(sdir('uploadfile') . '/' . $userAvatar['src']); ?>" width="100" height="100" /></div>
    	</li>
        <?php } ?>
        
        <li class="clearfix is">
        	<input type="file" name="avatarfile" />
        </li>
    </ul>
    </form>
    
    <form method="post" onsubmit="return false;" class="dis-n" id="form_password">
    <input type="hidden" name="act_flag_name" />
    <input type="hidden" name="do_uid" value="<?php prt($rUserRs['uid']); ?>" />
    <ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">密码:</div>
            <div class="clearfix inp">
                <input type="password" class="fs-ts-200" name="password" value="" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">确认密码:</div>
            <div class="clearfix inp">
                <input type="password" class="fs-ts-200" name="password2" value="" />
            </div>
        </li>
    </ul>
    </form>
    
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo();">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        </li>
    </ul>
</div>


<!-- //javascript -->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/calendar/WdatePicker.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/user/area.js"></script>
<script language="javascript">
var __act_flag_name = ['info', 'avatar', 'password'];
var __actFlagIndex = "";
$("#body").cjslip({
	speed: 0, 
	eventType: 'click', 
	mainEl: 'div[tab="yes"]', 
	mainState: '.page-tab a', 
	completeFunc: function (i){
		var __formObj = document.getElementById("form_" + __act_flag_name[i]);
			__formObj.act_flag_name.value = __act_flag_name[i];
		__actFlagIndex = i;
	},
	index : "<?php prt(intval(_get('tab'))); ?>"
});
/*_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });*/

/* 故乡 */
_GESHAI.levelselect({ 
		data: _CACHE_user_area, 
		selected: "<?php prt(my_array_value('hometown', $rUserRs)); ?>".split(","), 
		container: "#area_data_100", 
		name: "", 
		selectClass: "fs-ts ck-mr", 
		optionFunc: function(d){
			return {"id": d.id, "parentid": d.parentid, "text": d.aname};
		},
		callback: function(_selObj){
			var _changeData = [];
			_selObj.each(function(index, element) {
               var _cdVal =  $(this).find("option:selected").val();
			   if(parseInt(_cdVal) >= 1){
				   _changeData.push(_cdVal);
			   }
            });
			document.getElementsByName("hometown").item(0).value = _changeData.join(",");
		}
	});
/* 现居地 */
_GESHAI.levelselect({ 
		data: _CACHE_user_area, 
		selected: "<?php prt(my_array_value('residence', $rUserRs)); ?>".split(","), 
		container: "#area_data_101", 
		name: "", 
		selectClass: "fs-ts ck-mr", 
		optionFunc: function(d){
			return {"id": d.id, "parentid": d.parentid, "text": d.aname};
		},
		callback: function(_selObj){
			var _changeData = [];
			_selObj.each(function(index, element) {
               var _cdVal =  $(this).find("option:selected").val();
			   if(parseInt(_cdVal) >= 1){
				   _changeData.push(_cdVal);
			   }
            });
			document.getElementsByName("residence").item(0).value = _changeData.join(",");
		}
	});

/* doing */
function fsdo(__t){
	var _form = document.getElementById("form_" + __act_flag_name[__actFlagIndex]);
	if(__t == "avatar_delete"){
		_form.del.value = "true";
	}else{
		if(_form.del){
			_form.del.value = "false";
		}
	}
	
	return _GESHAI.fsubmit(_form, "<?php prt(_g('cp')->uri('mod/user/ac/manager/op/do')); ?>", {
		"goback": "<?php prt(_g('uri')->referer()); ?>",
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
			}
			window.top._GESHAI.dialog(d);
			if(d.status == 1){
				if(__act_flag_name[__actFlagIndex] == __act_flag_name[2]){
					document.getElementsByName("password").item(0).value = "";
					document.getElementsByName("password2").item(0).value = "";
				}else if(__act_flag_name[__actFlagIndex] == __act_flag_name[1]){
					window.location.href = window.location.href + "&tab=" + __actFlagIndex;
				}
			}
		}
	});
};
</script>
<!-- javascript// -->