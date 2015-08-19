<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    
<?php include _g('template')->name('user', 'nav', true); ?>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
    <!-- //cuser_z -->
    <div class="cuser_z clearfix">
        <?php $UModel->cUserCenterNav(); ?>
    </div>
    <!-- cuser_z// -->

    <!-- //cuser_y -->
    <div class="cuser_y clearfix">
        <div class="company-tab-hd clearfix">
            <a href="javascript:;">基本信息</a>
            <a href="javascript:;">公司简介</a>
            <a href="javascript:;">招聘联系人</a>
            <a href="javascript:;">logo/执照</a>
        </div>
        
        <div class="company-tab-bd clearfix">
            <!-- //基本信息 -->
            <div class="bd-box bd-box-none clearfix">
                <form method="post" onsubmit="return false;">
                <input type="hidden" name="tabtype" value="base" />
                <ul>
                    <li class="bline clearfix">
                        <div class="nn">用户名:</div>
                        <div class="ii"><?php prt(my_array_value('username', $cUserData)); ?></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">电子邮箱:</div>
                        <div class="ii"><?php prt(my_array_value('email', $cUserData)); ?></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">公司名称:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="cname" value="<?php prt(my_array_value('cname', $cUserData)); ?>" /></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">行业类型:</div>
                        <div class="select-sort select-c clearfix" id="sort-data-box"></div>
                        <div class="s-to clearfix">>></div>
                        <div class="selected-sort select-c clearfix" id="sort-data-selected"></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">公司性质:</div>
                        <div class="ii"><select class="sel" name="cnatureid" id="nature-data"><option value="0">==请选择==</option></select></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">公司规模:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="csize" value="<?php prt(my_array_value('csize', $cUserData)); ?>" /></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">公司地址:</div>
                        <div class="ii"><span class="holder-box" id="select-area"></span><span class="holder-box"><input type="hidden" name="area" /><input type="text" class="ii-inp" name="area_detail" value="<?php prt(my_array_value('area_detail', $cUserData)); ?>" /></span></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">联系人:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="contacts" value="<?php prt(my_array_value('contacts', $cUserData)); ?>" /></div>
                    </li>
                     <li class="bline clearfix">
                        <div class="nn">联系电话:</div>
                        <div class="ii"><span class="holder-box"><input type="text" class="ii-inp2" name="telephone[]" telephone="1" value="<?php prt($CUSER->telephone(my_array_value('telephone', $cUserData), 0)); ?>" /></span><span class="split">-</span><span class="holder-box"><input type="text" class="ii-inp3" name="telephone[]" telephone="2" value="<?php prt($CUSER->telephone(my_array_value('telephone', $cUserData), 1)); ?>" /></span><span class="split">-</span><span class="holder-box"><input type="text" class="ii-inp2" name="telephone[]" telephone="3" value="<?php prt($CUSER->telephone(my_array_value('telephone', $cUserData), 2)); ?>" /></span></div>
                    </li>
                    <li class="bline clearfix">
                        <div class="nn">手机号码:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="mobilephone" value="<?php prt(my_array_value('mobilephone', $cUserData)); ?>" /></div>
                    </li>
                    
                    <li class="clearfix">
                    	<div class="nn">&nbsp;</div>
                    	<button type="button" class="btn-ok" name="disabled-buttons" onclick="cUserProfileUpdate(this, '<?php prt(_g('uri')->su('user/t/c_company/op/do')); ?>');">保存</button>
                    </li>
                </ul>
                </form>
            </div>
            <!-- 基本信息// -->
            
            <!-- //公司简介 -->
            <div class="bd-box bd-box-none clearfix">
                <form method="post" onsubmit="return false;">
                <input type="hidden" name="tabtype" value="cdescription" />
                <ul>
                    <li class="clearfix">
                        <textarea name="cdescription" style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('cdescription', $cUserData)); ?></textarea>
                    </li>
                    <li class="clearfix">
                    	<button type="button" class="btn-ok" name="disabled-buttons" onclick="cUserProfileUpdate(this, '<?php prt(_g('uri')->su('user/t/c_company/op/do')); ?>');">保存</button>
                    </li>
                </ul>
                </form>
            </div>
            <!-- 公司简介// -->
            
            <!-- //招聘联系人 -->
            <div class="bd-box bd-box-none clearfix">
                <form method="post" onsubmit="return false;">
                <input type="hidden" name="tabtype" value="recruit" />
                <ul>
                    <li class="bline clearfix">
                        <div class="nn">联系人:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="recruitment" value="<?php prt(my_array_value('recruitment', $cUserData)); ?>" /></div>
                    </li>
                     <li class="bline clearfix">
                        <div class="nn">联系电话:</div>
                        <div class="ii"><span class="holder-box"><input type="text" class="ii-inp2" name="rtelephone[]" rtelephone="1" value="<?php prt($CUSER->telephone(my_array_value('rtelephone', $cUserData), 0)); ?>" /></span><span class="split">-</span><span class="holder-box"><input type="text" class="ii-inp3" name="rtelephone[]" rtelephone="2" value="<?php prt($CUSER->telephone(my_array_value('rtelephone', $cUserData), 1)); ?>" /></span><span class="split">-</span><span class="holder-box"><input type="text" class="ii-inp2" name="rtelephone[]" rtelephone="3" value="<?php prt($CUSER->telephone(my_array_value('rtelephone', $cUserData), 2)); ?>" /></span></div>
                    </li>
                    <li class="bline clearfix">
                        <div class="nn">手机号码:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="rmobilephone" value="<?php prt(my_array_value('rmobilephone', $cUserData)); ?>" /></div>
                    </li>
                    <li class="bline clearfix">
                        <div class="nn">联系邮箱:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="remail" value="<?php prt(my_array_value('remail', $cUserData)); ?>" /></div>
                    </li>
                    
                    <li class="clearfix">
                    	<div class="nn">&nbsp;</div>
                    	<button type="button" class="btn-ok" name="disabled-buttons" onclick="cUserProfileUpdate(this, '<?php prt(_g('uri')->su('user/t/c_company/op/do')); ?>');">保存</button>
                    </li>
                </ul>
                </form>
            </div>
            <!-- 招聘联系人// -->
            
            <!-- //营业执照 -->
            <div class="bd-box bd-box-none clearfix">
                <form method="post" enctype="multipart/form-data" onsubmit="return false;" id="form-cuser-upload01">
                <input type="hidden" name="tabtype" value="file" />
                <input type="hidden" name="filetype" value="" />
                <ul>
                    <li class="bline clearfix">
                        <div class="nn">公司 logo:</div>
                        <div class="ii"><span class="gr fdel" id="logo-area-status"><?php if(!$CUSER->isf(my_array_value('logo', $cUserData))){ ?>×未上传<?php }else{ ?><a href="javascript:;" delete-flag="logo" onclick="_cUserProfileDel(this);">重新上传</a><?php } ?></span></div>
                        <div class="clear"></div>
                        <div class="nn">&nbsp;</div>
                        <div class="file-area mt8 clearfix" id="logo-area-upload" style="display:<?php prt(!$CUSER->isf(my_array_value('logo', $cUserData)) ? '' : 'none'); ?>;">
                        	<span flag="file"><input type="file" class="z f-file" name="logo" onchange="_cUserProfileUpload(this);" /></span>
                        	<input type="text" name="logo_local_name" class="z f-txt" />
                            <button type="button" class="z f-btn">上传</button>
                        </div>
                        
                        <div class="file-area mt8 clearfix" id="logo-area-view" style="display:<?php prt(!$CUSER->isf(my_array_value('logo', $cUserData)) ? 'none' : ''); ?>;"><img src="<?php prt(sdir('uploadfile') . '/' . my_array_value('logo', $cUserData)); ?>" width="100" /></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">营业执照:</div>
                        <div class="ii"><span class="gr fdel" id="licence-area-status"><?php if(!$CUSER->isf(my_array_value('licence', $cUserData))){ ?>×未上传<?php }else{ ?><a href="javascript:;" delete-flag="licence" onclick="_cUserProfileDel(this);">重新上传</a><?php } ?></span></div>
                        <div class="clear"></div>
                        <div class="nn">&nbsp;</div>
                        <div class="file-area mt8 clearfix" id="licence-area-upload" style="display:<?php prt(!$CUSER->isf(my_array_value('licence', $cUserData)) ? '' : 'none'); ?>;">
                        	<span flag="file"><input type="file" class="z f-file" name="licence" onchange="_cUserProfileUpload(this);" /></span>
                        	<input type="text" name="licence_local_name" class="z f-txt" />
                            <button type="button" class="z f-btn">上传</button>
                        </div>
                        <div class="file-area mt8 clearfix" id="licence-area-view" style="display:<?php prt(!$CUSER->isf(my_array_value('licence', $cUserData)) ? 'none' : ''); ?>;"><img src="<?php prt(sdir('uploadfile') . '/' . my_array_value('licence', $cUserData)); ?>" width="100" /></div>
                    </li>
                </ul>
                </form>
            </div>
            <!-- 营业执照// -->
            
        </div>
    </div>
    <!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/nature.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
$("#cuser_center").cjslip({
	speed: 0,
	eventType: "click",
	mainEl: '.company-tab-bd',
	mainState: '.company-tab-hd a'
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

_GESHAI.levelselect({ 
		data: _CACHE_job_area, 
		selected: "<?php prt(my_array_value('area', $cUserData)); ?>".split(","), 
		container: "#select-area", 
		name: "", 
		selectClass: "sel mr8", 
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
			document.getElementsByName("area").item(0).value = _changeData.join(",");
		}
	});

cRegister_sort("<?php prt(my_array_value('csortid', $cUserData)); ?>");
cRegister_nature("#nature-data", "<?php prt(my_array_value('cnatureid', $cUserData)); ?>");

var _placeholderData = [
		{n: "name=\"csize\"", t: "如:1~20人"},
		{n: "name=\"area_detail\"", t: "详细地址..."},
		
		{n: "telephone=\"1\"", t: "区号"},
		{n: "telephone=\"2\"", t: "电话号码"},
		{n: "telephone=\"3\"", t: "转机"},
		
		{n: "rtelephone=\"1\"", t: "区号"},
		{n: "rtelephone=\"2\"", t: "电话号码"},
		{n: "rtelephone=\"3\"", t: "转机"}
	];
for(var i = 0; i < _placeholderData.length; i++){
	_GESHAI.placeholder({name: "input[" + _placeholderData[i].n + "]", text: _placeholderData[i].t});
}

function _cUserProfileDel(_this){
	return cUserProfileDel(_this, '<?php prt(_g('uri')->su('user/t/c_company/op/fdel')); ?>');
};
function _cUserProfileUpload(_this){
	return cUserProfileUpload(_this, '<?php prt(_g('uri')->su('user/t/c_company/op/do')); ?>');
};
</script>

<?php include _g('template')->name('@', 'footer', true); ?>