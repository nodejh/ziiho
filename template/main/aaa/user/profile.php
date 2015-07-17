<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
    <!-- //cuser_z -->
    <div class="cuser_z clearfix">
        <?php include _g('template')->name('user', 'center_nav', true); ?>
    </div>
    <!-- cuser_z// -->

    <!-- //cuser_y -->
    <div class="cuser_y clearfix">
        <div class="company-tab-hd clearfix">
            <a href="javascript:;">基本资料</a>
        </div>
        
        <div class="company-tab-bd clearfix">
            <!-- //基本信息 -->
            <div class="bd-box bd-box-none clearfix">
                <form method="post" onsubmit="return false;">
                <input type="hidden" name="tabtype" value="base" />
                <ul>
                    <li class="bline clearfix">
                        <div class="nn">用户名:</div>
                        <div class="ii"><?php prt(my_array_value('username', $userData)); ?></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">昵称:</div>
                        <div class="ii"><input type="text" class="ii-inp" name="nickname" value="<?php prt(my_array_value('nickname', $userData)); ?>" /></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">性别:</div>
                        <div class="ii">
                        	<select class="sel" name="gender">
                                <?php foreach(_g('value')->ra(_g('module')->dv('user', 100000)) as $v): ?>
                                <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('gender', $userData, -1)){ ?>selected="selected"<?php } ?> ><?php prt($v['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
						</div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">生日:</div>
                        <div class="ii">
                            <input type="text" name="birthday" class="ii-calendar" value="<?php prt(date("Y-m-d", my_array_value('birthday',$userData)));?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd',isShowToday:false,qsEnabled:false,isShowOK:false,minDate:'1960-01-01',maxDate:'<?php prt(date("Y-m-d", _g('cfg>time'))); ?>'})"/>
                        </div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">感情状况:</div>
                        <div class="ii">
                        <select class="sel" name="emotion">
                        	<option value="-1">==请选择==</option>
                            <?php foreach(_g('value')->ra(_g('module')->dv('user', 100001)) as $v): ?>
                            <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('emotion', $userData)){ ?>selected="selected"<?php } ?> ><?php prt($v['name']); ?></option>
                            <?php endforeach; ?>
                        </select></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">故乡:</div>
                        <div class="ii"><div class="clearfix" id="area-data-2"></div><input type="hidden" name="hometown" /></div>
                    </li>
                    
                    <li class="bline clearfix">
                        <div class="nn">现居地:</div>
                        <div class="ii"><div class="clearfix" id="area-data-1"></div><input type="hidden" name="residence" /></div>
                    </li>
                    
                    <li class="clearfix">
                    	<div class="nn">个性签名:</div>
                        <div class="ii"><textarea name="sign" style="width:540px; height:80px;"><?php prt(my_array_value('sign', $userData)); ?></textarea></div>
                    </li>
                    
                    <li class="clearfix">
                    	<div class="nn">&nbsp;</div>
                    	<button type="button" class="btn-ok" name="disabled-buttons" onclick="cUserProfileUpdate(this, '<?php prt(_g('uri')->su('user/ac/profile/op/do')); ?>');">保存</button>
                    </li>
                </ul>
                </form>
            </div>
            <!-- 基本信息// -->
            
        </div>
    </div>
    <!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/calendar/WdatePicker.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/user/area.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
$("#cuser_center").cjslip({
	speed: 0,
	eventType: "click",
	mainEl: '.company-tab-bd',
	mainState: '.company-tab-hd a'
});

_GESHAI.levelselect({ 
		data: _CACHE_user_area, 
		selected: "<?php prt(my_array_value('residence', $userData)); ?>".split(","), 
		container: "#area-data-1", 
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
			document.getElementsByName("residence").item(0).value = _changeData.join(",");
		}
	});

_GESHAI.levelselect({ 
		data: _CACHE_user_area, 
		selected: "<?php prt(my_array_value('hometown', $userData)); ?>".split(","), 
		container: "#area-data-2", 
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
			document.getElementsByName("hometown").item(0).value = _changeData.join(",");
		}
	});

var _placeholderData = [
		{n: "name=\"sign\"", t: "说出您的个性..."}
	];
for(var i = 0; i < _placeholderData.length; i++){
	_GESHAI.placeholder({name: "textarea[" + _placeholderData[i].n + "]", text: _placeholderData[i].t});
}

</script>

<?php include _g('template')->name('@', 'footer', true); ?>