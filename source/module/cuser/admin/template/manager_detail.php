<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">基本信息</a><a href="javascript:;" class="ml2">公司介绍</a><a href="javascript:;" class="ml2">logo</a><a href="javascript:;" class="ml2">营业执照</a><a href="javascript:;" class="ml2">招聘联系人</a>
</div>

<div class="clearfix ul-box">
	
    <ul class="ubox">
        <li class="clearfix is">
			<a class="fa-cd icon-page-goback" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</a>
			<span class="tc-a fw"><?php prt($CUserRs['username']); ?>（<?php prt($CUserRs['cname']); ?>）</span>
		</li>
	</ul>
</div>


<!-- //tabs -->
<div class="clearfix" tab="yes">
	<!-- //基本信息 -->
    <form method="post" onsubmit="return false;" id="form_base" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="cuser_act" value="base" />
	<div class="clearfix ul-box">
        <ul class="ubox">
            <li class="clearfix is">
                <div class="clearfix tit">用户名:</div>
                <div class="clearfix inp">
                    <?php prt($CUserRs['username']); ?>
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">电子邮箱:</div>
                <div class="clearfix inp">
                    <?php prt($CUserRs['email']); ?>
                </div>
            </li>
    
            <li class="clearfix is">
                <div class="clearfix tit">公司名称:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-200" name="cname" value="<?php prt($CUserRs['cname']); ?>" />
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">行业类别:</div>
                <div class="clearfix inp">
                    <select multiple="multiple" name="csortid[]" class="fs-ts-h180" style="width:260px;">
                        <?php $CSortResult_a = $CSort->finds(array('parentid'=>0, 'status'=> _g('value')->sb( true ))); ?>
                        <?php while($CSortRs_v1 = $CSort->db->fetch_array($CSortResult_a)){ ?>
                            <option value="<?php prt($CSortRs_v1['sortid']); ?>" <?php if(my_in_array($CSortRs_v1['sortid'], my_explode(',', my_array_value('csortid', $CUserRs)))){ ?> selected="selected"<?php } ?> ><?php prt($CSortRs_v1['sname']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="clearfix des">
                    <p class="ds">按住“Ctrl”键，可进行多项选择</p>
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">公司性质:</div>
                <div class="clearfix inp">
                    <select name="cnatureid" class="fs-ts">
                        <option value="-1">==请选择==</option>
                        <?php $gsxzResult = _g('get')->selectitem(119); ?>
                        <?php while($val = _g('db')->result($gsxzResult)){ ?>
                        <option value="<?php prt($val['siid']); ?>" <?php if(_g('validate')->v2eq(my_array_value('cnatureid', $CUserRs), $val['natureid'])){ ?> selected="selected"<?php } ?> ><?php prt($val['sname']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">公司规模:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-200" name="csize" value="<?php prt(my_array_value('csize', $CUserRs)); ?>" />
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">公司地址:</div>
                <div class="clearfix inp">
                    <span id="select-area"></span><input type="text" class="fs-ts-200" name="area_detail" value="<?php prt($CUserRs['area_detail']); ?>" />
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">联系人:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-200" name="contacts" value="<?php prt($CUserRs['contacts']); ?>" />
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">联系电话:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-100" name="telephone[]" value="<?php prt($CUser->telephone($CUserRs['telephone'], 0)); ?>" /> - <input type="text" class="fs-ts-200" name="telephone[]" value="<?php prt($CUser->telephone($CUserRs['telephone'], 1)); ?>" /> - <input type="text" class="fs-ts-100" name="telephone[]" value="<?php prt($CUser->telephone($CUserRs['telephone'], 2)); ?>" />
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">手机号码:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-200" name="mobilephone" value="<?php prt($CUserRs['mobilephone']); ?>" />
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">公司邮箱:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-200" name="cemail" value="<?php prt($CUserRs['cemail']); ?>" />
                </div>
            </li>
            
            <li class="clearfix is-def">
            	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_base(this);">提交</button>
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        	</li>
        </ul>
	</div>
    </form>
    <!-- 基本信息// -->
    
    <!-- //公司介绍 -->
    <form method="post" onsubmit="return false;" id="form_des" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="cuser_act" value="des" />
    <div class="clearfix ul-box">
        <ul class="ubox">
            <li class="clearfix is">
                <div class="clearfix inp">
                    <textarea name="cdescription" style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('cdescription', $CUserRs)); ?></textarea>
                </div>
            </li>
            
            <li class="clearfix is-def">
            	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_des(this);">提交</button>
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        	</li>
        </ul>
    </div>
    </form>
    <!-- 公司介绍// -->
    
    <!-- //logo -->
    <form method="post" enctype="multipart/form-data" onsubmit="return false;" id="form_logo" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="cuser_act" value="logo" />
    <input type="hidden" name="act_type" value="del_logo" />
    <div class="clearfix ul-box">
        <ul class="ubox">
        	<?php if(strlen(my_array_value('logo', $CUserRs)) >= 1){ ?>
            <li class="clearfix is">
                <div class="clearfix tit"><button type="button" name="disabled-buttons" class="fbtn-ds tc-d" onclick="fsdo_logo(this, 'del_logo');">删除文件</button></div>
                <div class="clearfix inp margin104">
                    <img src="<?php prt(sdir('uploadfile') . '/' . $CUserRs['logo']); ?>" width="100" />
                </div>
            </li>
            <?php } ?>
            
            <li class="clearfix is">
                <div class="clearfix inp">
                    <input type="file" class="fs-ts-200" name="logofile" />
                </div>
            </li>
            
            <li class="clearfix is-def">
            	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_logo(this);">提交上传</button>
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        	</li>
        </ul>
    </div>
    </form>
    <!-- logo// -->
    
    <!-- //营业执照 -->
    <form method="post" enctype="multipart/form-data" onsubmit="return false;" id="form_licence" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="cuser_act" value="licence" />
    <input type="hidden" name="act_type" value="del_licence" />
    <input type="hidden" name="authlicence" value="false" />
    <div class="clearfix ul-box">
        <ul class="ubox">
        	<?php if(strlen(my_array_value('licence', $CUserRs)) >= 1){ ?>
            <li class="clearfix is">
                <div class="clearfix tit">认证状态：<?php prt($CUserRs['authlicence'] == _g('value')->sb(true) ? '<em class="color100 icon-status-normal">已认证</em>' : '<em class="tc-d icon-status-error">未认证</em>'); ?></div>
                <div class="clearfix inp margin104">
                    <button type="button" name="disabled-buttons" class="fbtn-ds" a_status="true" onclick="fsdo_licence(this, 'status');">通过</button>
                    <button type="button" name="disabled-buttons" class="fbtn-ds" a_status="false" onclick="fsdo_licence(this, 'status');">不通过</button>
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit"><button type="button" name="disabled-buttons" class="fbtn-ds tc-d" onclick="fsdo_licence(this, 'del_licence');">删除文件</button></div>
                <div class="clearfix inp margin104">
                    <a href="<?php prt(sdir('uploadfile') . '/' . $CUserRs['licence']); ?>" target="_blank" title="点击预览大图"><img src="<?php prt(sdir('uploadfile') . '/' . $CUserRs['licence']); ?>" width="100" /></a>
                </div>
            </li>
            <?php } ?>
            
            <li class="clearfix is">
                <div class="clearfix inp">
                    <input type="file" class="fs-ts-200" name="licencefile" />
                </div>
            </li>
            
            <li class="clearfix is-def">
            	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_licence(this);">提交上传</button>
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        	</li>
        </ul>
    </div>
    </form>
    <!-- 营业执照// -->
    
    <!-- //招聘联系人 -->
    <form method="post" onsubmit="return false;" id="form_zplx" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="cuser_act" value="zplx" />
    <input type="hidden" name="act_type" value="" />
    <input type="hidden" name="del_zplxid" value="" />
    <div class="clearfix table-box">
        <table class="tbox">
            <tr class="bg-a trow-bline trow-fw">
                <td width="20%">联系人</td>
                <td width="30%">区号/座机/转机</td>
                <td width="20%">手机</td>
                <td width="20%">邮箱</td>
                <td width="10%">操作</td>
            </tr>
            
            <?php while($rs = _g('db')->fetch_array($zplxResult)){ ?>
            <tr class="trow-bline bg-hover-a">
                <td width="20%"><input type="hidden" name="zplxid[]" value="<?php prt($rs['zplxid']); ?>" /><input type="text" class="fs-ts-200" name="zname[<?php prt($rs['zplxid']); ?>]" value="<?php prt($rs['zname']); ?>" /></td>
                <td width="30%"><input type="text" name="mp0[<?php prt($rs['zplxid']); ?>]" class="fs-ts-50" value="<?php prt($rs['mp0']); ?>" /><em class="padding101">-</em><input type="text" class="fs-ts-200 margin103" name="mp1[<?php prt($rs['zplxid']); ?>]" value="<?php prt($rs['mp1']); ?>" /><em class="padding101">-</em><input type="text" name="mp2[<?php prt($rs['zplxid']); ?>]" class="fs-ts-50" value="<?php prt($rs['mp2']); ?>" /></td>
                <td width="20%"><input type="text" class="fs-ts-200" name="tp[<?php prt($rs['zplxid']); ?>]" value="<?php prt($rs['tp']); ?>" /></td>
                <td width="20%"><input type="text" class="fs-ts-200" name="email[<?php prt($rs['zplxid']); ?>]" value="<?php prt($rs['email']); ?>" /></td>
                <td width="10%"><a class="fa-cd icon-delete" del_dataid="<?php prt($rs['zplxid']); ?>" onclick="fsdo_zplx(this, 'delete')">删除</a></td>
            </tr>
            <?php } ?>
            
            <tr class="trow-bline bg-hover-a">
                <td width="20%"><input type="text" class="fs-ts-200" name="_zname" value="" /></td>
                <td width="30%"><input type="text" name="_mp0" class="fs-ts-50" value="" /><em class="padding101">-</em><input type="text" class="fs-ts-200 margin103" name="_mp1" value="" /><em class="padding101">-</em><input type="text" name="_mp2" class="fs-ts-50" value="" /></td>
                <td width="20%"><input type="text" class="fs-ts-200" name="_tp" value="" /></td>
                <td width="20%"><input type="text" class="fs-ts-200" name="_email" value="" /></td>
                <td width="10%"><button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_zplx(this, 'add');">+添加</button></td>
            </tr>
            
            <tr class="bg-b trow-bline">
            <td colspan="5">
            	<span class="z">
                	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_zplx(this);" id="btn_zplx">提交更新</button>
                    <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
				</span>
				<?php _g('cp')->page($zplxPageData); ?>
            </td>
        </tr>
    	</table>
    </div>
    </form>
    <!-- 招聘联系人// -->
    
</div>
<!-- tabs// -->

<!-- //javascript -->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
<script language="javascript">
/*_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });*/

var __curHref = "";
var __act_falgs = ['base', 'des', 'logo', 'licence', 'zplx'];
var __act_falgIndex = "";
$("#body").cjslip({
	speed: 0, 
	eventType: 'click', 
	mainEl: 'div[tab="yes"]', 
	mainState: '.page-tab a', 
	index: "<?php prt(intval(_get('tab'))); ?>",
	completeFunc: function(i){
		__act_falgIndex = i;
		__curHref = (window.location.href.replace(/\&tab\=[0-9]+/g, "")) + "&tab=" + i;
	}
});

_GESHAI.levelselect({ 
	data: _CACHE_job_area, 
	selected: "<?php prt(my_array_value('area', $CUserRs)); ?>".split(","), 
	container: "#select-area", 
	name: "area[]", 
	selectClass: "fs-ts ck-mr", 
	optionFunc: function(d){
		return {"id": d.id, "parentid": d.parentid, "text": d.aname};
	},
	callback: function(_s){
		
	}
});

var _keditor_b;
KindEditor.ready(function(K) {
	_keditor_b = K.create('textarea[name="cdescription"]', {
		themeType : 'simple',
		cssData:'body{font-size:14px;}',
		resizeType: 1,
		pasteType : 1,
		allowFileManager : false,
		allowImageUpload : false,
		allowFlashUpload : false,
		allowMediaUpload : false,
		allowFileUpload : false,
		afterCreate: function(){ this.sync(); },
        afterBlur: function(){ this.sync(); },
		items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'image', 'link']
	});
});

var __actUrl = "<?php prt(_g('cp')->uri('mod/cuser/ac/manager/op/detail_update')); ?>";
/* base */
function fsdo_base(_this){
	return _GESHAI.fsubmit(_this, __actUrl, {
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
		}
	});
};
/* des */
function fsdo_des(_this){
	return fsdo_base(_this);
};
/* logo */
function fsdo_logo(_this, _type){
	_this.form.act_type.value = _type;
	if(_type == "del_logo"){
		window.top._GESHAI.dialog({
				"title": "删除“logo”",
				"data": "<p>若删除，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, __actUrl, {
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
								window.location.href = __curHref;
							}
						}
					});
				}
			});
	}else{
		if(_this.form.logofile.value.length < 1){
			window.top._GESHAI.dialog({ title: "错误：", data: "请选择“logo”上传文件", clickBgClose: true, isCloseBtn: false });
			return null;
		}
		return _GESHAI.fsubmit(_this, __actUrl, {
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
						window.location.href = __curHref;
					}
			}
		});
	}
};
/* licence */
function fsdo_licence(_this, _type){
	_this.form.act_type.value = _type;
	_this.form.authlicence.value = _this.getAttribute("a_status");
	
	if(_type == "del_licence"){
		window.top._GESHAI.dialog({
				"title": "删除“营业执照”",
				"data": "<p>若删除，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, __actUrl, {
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
								window.location.href = __curHref;
							}
						}
					});
				}
			});
	}else if(_type == "status"){
		return _GESHAI.fsubmit(_this, __actUrl, {
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
						window.location.href = __curHref;
					}
			}
		});
	}else{
		if(_this.form.licencefile.value.length < 1){
			window.top._GESHAI.dialog({ title: "错误：", data: "请选择“营业执照”上传文件", clickBgClose: true, isCloseBtn: false });
			return null;
		}
		return _GESHAI.fsubmit(_this, __actUrl, {
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
						window.location.href = __curHref;
					}
			}
		});
	}
};
/* zplx */
function fsdo_zplx(_this, _type){
	var _del_ID = _this.getAttribute("del_dataid");
	if(_type == "delete"){
		_this = document.getElementById('btn_zplx');
	}
	_this.form.act_type.value = _type;
	_this.form.del_zplxid.value = _del_ID;
	
	if(_type == "delete"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, __actUrl, {
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
								window.location.href = __curHref;
							}
						}
					});
				}
			});
	} else {
		return _GESHAI.fsubmit(_this, __actUrl, {
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
					window.location.href = __curHref;
				}
			}
		});
	}
};
</script>
<!-- javascript// -->