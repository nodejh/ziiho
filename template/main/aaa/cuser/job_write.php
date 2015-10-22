<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php include _g('template')->name('cuser', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
	<div class="label">
    	<a href="<?php prt(_g('uri')->su('user/ac/job')); ?>">&laquo;返回</a>
    </div>
    <div class="form-item clearfix">
    	<form method="post" onsubmit="return false;">
        <input type="hidden" name="jobid" value="<?php prt(my_array_value('jobid', $jobSub, 0)); ?>" />
    	<ul class="form-box">
        	<li class="clearfix">
            	<div class="lab">联系人：</div>
                <div class="checkboxs">
                	<?php if($zplxPageData['total'] >= 1){ ?>
						<?php while($zplxRs = _g('db')->result($zplxResult)){ ?>
                            <a href="javascript:;" select="zplx" checkbox-icon="true" <?php prt(my_in_array($zplxRs['zplxid'], $zplxData) ? 'checkbox-status="true" class="on"' : '');?>><input type="checkbox" name="zplxid[]" value="<?php prt($zplxRs['zplxid']); ?>" class="zp_ck" <?php prt(my_in_array($zplxRs['zplxid'], $zplxData) ? 'checked="checked"' : '');?> /><em><?php prt($zplxRs['zname']); ?></em></a>
                        <?php } ?>
                    <?php }else{ ?>
                    	<span class="empty">对不起，您还没有添加联系人哦~</span>
                    <?php } ?>
				</div>
            </li>
            
            <li class="bline clearfix">
                <div class="lab">工作地点:</div>
                <div class="inp"><span class="holder-box" id="select-area"></span><span class="holder-box"><input type="hidden" name="areaid" /><input type="text" class="it" name="area_detail" value="<?php prt(my_array_value('area_detail', $jobSub)); ?>" /></span></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">工作年限：</div>
                <div class="inp">
                	<select class="sel" name="workyear">
                        <option value="-1">-</option>
                        <?php foreach(_g('cache')->selectitem(101) as $k=>$v): ?>
                        <option value="<?php prt($k); ?>" <?php if($v['flag'] == my_array_value('workyear', $jobSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">学历要求：</div>
                <div class="inp">
                	<select class="sel" name="degree">
                      <option value="-1">-</option>
                      <?php foreach(_g('cache')->selectitem(111) as $k=>$v): ?>
                      <option value="<?php prt($k); ?>" <?php prt($k == my_array_value('degree', $jobSub) ? 'selected="selected"' : null); ?> ><?php prt($v['sname']); ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">语言要求：</div>
                <div class="checkboxs clearfix">
                	<?php $index = 0; ?>
                	<?php foreach(_g('cache')->selectitem(112) as $k=>$v){ ?>
                		<a href="javascript:;" select="language" checkbox-icon="true" <?php prt(my_in_array($k, $languageData) ? 'checkbox-status="true" class="on"' : '');?> <?php if($index > 8) { ?>style="margin-top:10px;"<?php } ?> ><input type="checkbox" name="language[]" value="<?php prt($k); ?>" class="zp_ck" <?php prt(my_in_array($k, $languageData) ? 'checked="checked"' : '');?> /><em><?php prt($v['sname']); ?></em></a>
                        <?php if($index == 8) { ?><div class="clear"></div><?php } ?>
                        <?php $index = $index + 1; ?>
					<?php } ?>
                </div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">薪资范围：</div>
                <div class="inp">
                	<select class="sel" name="wagetype">
                        <option value="-1">-</option>
                        <?php foreach(_g('cache')->selectitem(108) as $k=>$v): ?>
                        <option value="<?php prt($k); ?>" <?php if($k == my_array_value('wagetype', $jobSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <select class="sel" name="wage">
                        <option value="-1">-</option>
                        <?php foreach(_g('cache')->selectitem(116) as $k=>$v): ?>
                        <option value="<?php prt($k); ?>" <?php if($k == my_array_value('wage', $jobSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </li>
            <li class="clearfix">
            	<div class="lab">薪酬福利：</div>
                <div class="checkboxs">
                	<?php foreach(_g('cache')->selectitem(121) as $k=>$v){ ?>
                		<a href="javascript:;" select="benefit" checkbox-icon="true" <?php prt(my_in_array($k, $benefitData) ? 'checkbox-status="true" class="on"' : '');?>><input type="checkbox" name="benefit[]" value="<?php prt($k); ?>" class="zp_ck" <?php prt(my_in_array($k, $benefitData) ? 'checked="checked"' : '');?> /><em><?php prt($v['sname']); ?></em></a>
					<?php } ?>
                </div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">职位类别：</div>
                <div class="inp"><select class="sel" name="sortid" id="sort-data"><option value="0">==请选择==</option></select></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">测试时间：</div>
                <div class="inp"><input type="text" name="examtime" class="it" value="<?php prt(my_array_value('examtime', $jobSub)); ?>" /><span class="t-des">单位为“分钟”。如果为空，则为默认30分钟</span></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">标题：</div>
                <div class="inp"><input type="text" name="jname" class="it" value="<?php prt(my_array_value('jname', $jobSub)); ?>" /></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">招聘人数：</div>
                <div class="inp"><input type="text" name="pnum" class="it" value="<?php prt(my_array_value('pnum', $jobSub)); ?>" /></div>
            </li>
            <li class="clearfix">
            	<div class="lab">说明内容：</div>
                <div class="inp"><textarea name="content" style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('content', $jobSub)); ?></textarea></div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">启用状态：</div>
                <div class="inp">
                	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                    <span radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $jobSub, -1)){ ?> checked="checked"<?php } ?> /><?php prt($v['status']); ?></span>
                    <?php } ?>
                    <span class="t-des">若“关闭”，则该职位信息不会在站点出现。</span>
                </div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">开启认证：</div>
                <div class="inp">
                	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                    <span radio="isauth"><input type="radio" name="isauth" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('isauth', $jobSub, 1)){ ?> checked="checked"<?php } ?> /><?php prt($v['status']); ?></span>
                    <?php } ?>
                    <span class="t-des">开启职位认证功能，投递简历者将会进行初步的测试，打开该职位即可查看测试结果</span>
                </div>
            </li>
            
            <li class="clearfix">
            	<div class="lab">&nbsp;</div>
                <div class="btns"><button type="button" class="btn" name="disabled-buttons" onclick="cUserJobWrite(this, '<?php prt(_g('uri')->su('user/ac/job/op/write_save')); ?>', '<?php prt(_g('uri')->su('user/ac/job')); ?>');">提交并保存</button></div>
            </li>
        </ul>
        </form>
    </div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
<script language="javascript">
var _keditor_b;
KindEditor.ready(function(K) {
	_keditor_b = K.create('textarea[name="content"]', {
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

<?php if($zplxPageData['total'] >= 1){ ?>
_GESHAI.checkbox({ "fClass": "", "tClass": "on", "checkboxItem": "a[select=\"zplx\"]", "name": "zplxid[]" });
<?php } ?>

_GESHAI.checkbox({ "fClass": "", "tClass": "on", "checkboxItem": "a[select=\"language\"]", "name": "language[]" });
_GESHAI.checkbox({ "fClass": "", "tClass": "on", "checkboxItem": "a[select=\"benefit\"]", "name": "benefit[]" });

_GESHAI.placeholder({name: "input[name=\"area_detail\"]", text: "输入详细地址..."});
_GESHAI.placeholder({name: "input[name=\"examtime\"]", text: "如: 30"});
_GESHAI.placeholder({name: "input[name=\"jname\"]", text: "如: JAVA工程师"});
_GESHAI.placeholder({name: "input[name=\"pnum\"]", text: "如: 1~20人"});

_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status"});
_GESHAI.radio({ radioItem: 'span[radio="isauth"]', name: "isauth", 
	callback: function(i){ 
		var _val = $('input[name="isauth"]').eq(i).val();
		if(_val == "true") {
		} else {
			
		}
	}
});

_GESHAI.levelselect({ 
		data: _CACHE_job_area, 
		selected: s2pnsplitDe("<?php prt(my_array_value('areaid', $jobSub)); ?>"), 
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
			document.getElementsByName("areaid").item(0).value = _changeData.join(",");
		}
	});

function _sortDataAppend(__sortid){
	var _sortObj = document.getElementById("sort-data");
	var _sortParent = [];
	for(var __i = 0; __i < _CACHE_job_sort.length; __i++){
		if(_CACHE_job_sort[__i].parentid < 1){
			_sortParent.push(_CACHE_job_sort[__i]);
		}
	}
	var _htmlStr = "";
	for(var __i = 0; __i < _sortParent.length; __i++){
		_htmlStr = "<optgroup label=\"" + _sortParent[__i].sname + "\">"
		for(var __j = 0; __j < _CACHE_job_sort.length; __j++){
			if(_sortParent[__i].id == _CACHE_job_sort[__j].parentid){
				_htmlStr += "<option value=\"" + _CACHE_job_sort[__j].id + "\" " + (_CACHE_job_sort[__j].id == __sortid ? "selected=\"selected\"" : "") + ">" + _CACHE_job_sort[__j].sname + "</option>";
			}
		}
		$(_sortObj).append(_htmlStr + "</optgroup>");
	}
};
_sortDataAppend("<?php prt(my_array_value('sortid', $jobSub)); ?>");
</script>

<?php include _g('template')->name('@', 'footer', true); ?>