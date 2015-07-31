<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<style type="text/css">

.resumebtn { padding:3px 10px; background:none; border:none; color:#F00; cursor:pointer; }
.resumebtn:hover { color:#F00; text-decoration:underline; }

.resume_r_data {  }
	.resume_r_data .resume_r_data_i { margin-top:10px; padding:10px; background:#fafafa; border-bottom:2px solid #eee; position:relative; }
		.resume_r_data .resume_r_data_i .ib99 { position:absolute; right:10px; top:10px; }
		
.resume_r_data_add_btn { margin-top:10px; text-align:center; }
	.resume_r_data_add_btn a.btn { padding:5px 10px; color:#039; }
	.resume_r_data_add_btn a.btn:hover { text-decoration:underline; }
	
.resume_r_data_write_wrap { display:none; }
	.resume_r_data_write { margin-top:10px; }
		.resume_r_data_write a.del_btn { margin-left:10px; }
</style>

<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/calendar/WdatePicker.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('resume')); ?>/js/resume.js"></script>

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
            <a href="javascript:;">基本信息</a>
            <a href="javascript:;">求职意向</a>
            <a href="javascript:;">教育经历</a>
            <a href="javascript:;">培训经历</a>
            <a href="javascript:;">语言能力</a>
            <a href="javascript:;">项目经验</a>
            <a href="javascript:;">工作经验</a>
            <a href="javascript:;">作品附件</a>
            <a href="javascript:;">附加信息</a>
        </div>
        
        <div class="company-tab-bd clearfix">
        	<!-- //rbox1 -->
        	<div class="rbox1 clearfix" style="border-bottom:3px solid #069; background:#E1ECFF;">
                <div class="bd-box clearfix">
                <form method="post" onsubmit="return false;" id="rform">
                <input type="hidden" name="f" value="resume" />
                <ul>
                    <li class="bline clearfix">
                        <div class="nn">简历名称:</div>
                        <div class="ii">
                            <input type="text" class="ii-inp" name="m_rname" value="<?php prt(my_array_value('rname', $resumeSub)); ?>" />
                            
                            公开程度:
                            <select class="sel" name="m_publishlv">
                                <?php foreach(_g('value')->ra(_g('module')->dv('resume', 100001)) as $v): ?>
                                <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('publishlv', $resumeSub, -1)){ ?>selected="selected"<?php } ?> ><?php prt($v['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            
                            <a class="resumebtn" onclick="return resumeDo_save('<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</a>
                        </div>
                    </li>
                </ul>
                </form>
                </div>
            </div>
            <!-- rbox1// -->
            
            <!-- //rbox2 -->
            <div class="rbox2 clearfix">
                <!-- //基本信息 -->
                <?php include _g('template')->name('resume', 'write_profile', true); ?>
                <!-- 基本信息// -->
                
                <!-- //求职意向 -->
                <?php include _g('template')->name('resume', 'write_wish', true); ?>
                <!-- 求职意向// -->
                
                <!-- //教育经历 -->
                <?php include _g('template')->name('resume', 'write_educate', true); ?>
                <!-- 教育经历// -->
                
                <!-- //培训经历 -->
                <?php include _g('template')->name('resume', 'write_train', true); ?>
                <!-- 培训经历// -->
                
                <!-- //语言能力 -->
                <?php include _g('template')->name('resume', 'write_language', true); ?>
                <!-- 语言能力// -->
                
                <!-- //项目经历 -->
                <?php include _g('template')->name('resume', 'write_projectexp', true); ?>
                <!-- 项目经历// -->
                
                <!-- //工作经验 -->
                <?php include _g('template')->name('resume', 'write_workexp', true); ?>
                <!-- 工作经验// -->
                
                <!-- //附件 -->
                <?php include _g('template')->name('resume', 'write_attach', true); ?>
                <!-- 附件// -->
                
                <!-- //其他 -->
                <?php include _g('template')->name('resume', 'write_relate', true); ?>
                <!-- 其他// -->
            </div>
            <!-- //rbox2 -->
            
        </div>
    </div>
    <!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->

<?php include _g('template')->name('job', 'footer', true); ?>

<script language="javascript">
$("#cuser_center").cjslip({
	speed: 0,
	eventType: "click",
	mainEl: '.company-tab-bd .rbox2',
	mainState: '.company-tab-hd a',
	index: 1
});

$("#base_box").cjslip({mainEl: '.base-more', mainState: '.base-more-bar', onClass: "label_on", mainCur: true, curOff: true, defaultShow: false, eventType:"click", effect:'slideDown', speed:350, index: false, 
	completeFunc: function() { 
		var o = $(".base-more-bar em").eq(0);
		if($(".base-more").is(":hidden")){
			o.html("+");
		}else{
			o.html("-");
		}
	}
});

/* base */
_GESHAI.levelselect({ 
		data: _CACHE_job_area, 
		selected: "<?php prt(my_array_value('home', $resumeProfile)); ?>".split(","), 
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
			document.getElementsByName("home").item(0).value = _changeData.join(",");
		}
	});

_GESHAI.levelselect({ 
		data: _CACHE_job_area, 
		selected: "<?php prt(my_array_value('hometown', $resumeProfile)); ?>".split(","), 
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

/* wish */
_GESHAI.levelselect({ 
		data: _CACHE_job_area, 
		selected: "<?php prt(my_array_value('area', $wishSub)); ?>".split(","), 
		container: "#area-data-3", 
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

resume_placeholder();
</script>

<?php include _g('template')->name('@', 'footer', true); ?>