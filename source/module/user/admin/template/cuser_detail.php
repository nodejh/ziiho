<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">基本信息</a><a href="javascript:;" class="ml2 on">公司资料</a>
</div>

<div class="clearfix ul-box">
	
    <ul class="ubox">
        <li class="clearfix is">
			<a class="fa-cd icon-page-goback" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</a>
			<span class="tc-a t-fw"><?php prt($CUserRs['cname']); ?></span>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
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
	</ul>
    <ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">行业类别:</div>
            <div class="clearfix inp">
                <select multiple="multiple" name="csortid[]" class="fs-ts-h180">
                	<?php $CSortResult_a = $CSort->finds(array('parentid'=>0, 'status'=> _g('value')->sb( true ))); ?>
                	<?php while($CSortRs_v1 = $CSort->db->fetch_array($CSortResult_a)){ ?>
                	<optgroup label="<?php prt(my_addslashes($CSortRs_v1['sname'])); ?>">
                    	<?php $CSortResult_b = $CSort->finds(array('parentid'=>$CSortRs_v1['sortid'], 'status'=> _g('value')->sb( true ))); ?>
                    	<?php while($CSortRs_v2 = $CSort->db->fetch_array($CSortResult_b)){ ?>
                        <option value="<?php prt($CSortRs_v2['sortid']); ?>" <?php if(my_in_array($CSortRs_v2['sortid'], my_explode(',', my_array_value('csortid', $CUserRs)))){ ?> selected="selected"<?php } ?> ><?php prt($CSortRs_v2['sname']); ?></option>
                        <?php } ?>
                    </optgroup>
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
					<?php $CNatureResult = $CNature->finds('status', _g('value')->sb( true )); ?>
					<?php while($CNatureRs = $CSort->db->fetch_array($CNatureResult)){ ?>
                	<option value="<?php prt($CNatureRs['natureid']); ?>" <?php if(_g('validate')->v2eq(my_array_value('cnatureid', $CUserRs), $CNatureRs['natureid'])){ ?> selected="selected"<?php } ?> ><?php prt($CNatureRs['nname']); ?></option>
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
            <div class="clearfix tit">公司介绍:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="cdescription" value="<?php prt(my_array_value('cdescription', $CUserRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">招聘联系人:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="recruitment" value="<?php prt(my_array_value('recruitment', $CUserRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">联系电话:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-100" name="rtelephone[]" value="<?php prt($CUser->telephone(my_array_value('rtelephone', $CUserRs), 0)); ?>" /> - <input type="text" class="fs-ts-200" name="rtelephone[]" value="<?php prt($CUser->telephone(my_array_value('rtelephone', $CUserRs), 1)); ?>" /> - <input type="text" class="fs-ts-100" name="rtelephone[]" value="<?php prt($CUser->telephone(my_array_value('rtelephone', $CUserRs), 2)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">手机号码:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="rmobilephone" value="<?php prt(my_array_value('rmobilephone', $CUserRs)); ?>" />
            </div>
        </li>
    </ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });
_GESHAI.radio({ radioItem: 'span[radio="isnav"]', name: "isnav" });
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

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/user/ac/cuser/op/detail_update')); ?>", {
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
</script>
<!-- javascript// -->