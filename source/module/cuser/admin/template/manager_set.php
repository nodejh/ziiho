<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">推荐设置</a><a href="javascript:;" class="ml2">管理账户</a><a href="javascript:;" class="ml2">密码重置</a>
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
	<!-- //推荐 -->
    <form method="post" onsubmit="return false;" id="form_recommend" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="act" value="recommend" />
	<div class="clearfix ul-box">
        <ul class="ubox">
            <li class="clearfix is">
                <div class="clearfix tit">推荐度:</div>
                <div class="clearfix inp">
                    <select name="level" class="fs-ts-200">
                    	<option value="0" >不推荐</option>
                        <?php foreach(_g('module')->dv('cuser', 100000) as $lv){ ?>
                            <option value="<?php prt($lv['v']); ?>" <?php prt($lv['v'] == my_array_value('level', $recommentRs) ? 'selected="selected"' : '');?> ><?php prt($lv['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="clearfix des">
                    <p class="ds">设置推荐程度，等级越高“企业”显示越靠前</p>
                </div>
            </li>
            
            <li class="clearfix is">
                <div class="clearfix tit">时间:</div>
                <div class="clearfix inp">
                    S：<input type="text" class="fs-ts-180" name="stime" value="<?php prt($recommentRs['stime']); ?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd HH:mm:ss'})" />&nbsp;~&nbsp;E：<input type="text" class="fs-ts-180" name="etime" value="<?php prt($recommentRs['etime']); ?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd HH:mm:ss'})" />
                </div>
            </li>
            
            <li class="clearfix is-def">
            	<button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_recommend(this);">提交</button>
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
        	</li>
        </ul>
	</div>
    </form>
    <!-- 推荐// -->
    
    <!-- //账户管理 -->
    <form method="post" onsubmit="return false;" id="form_account" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="act" value="account" />
    <input type="hidden" name="doflag" value="" />
    <input type="hidden" name="status" value="" />
    <div class="clearfix ul-box">
        <ul class="ubox">
            <li class="clearfix is">
                <div class="clearfix tit">账户状态：<?php prt($CUserRs['status'] == _g('value')->sb(true) ? '<em class="color100 icon-status-normal">已启用</em>' : '<em class="tc-d icon-status-error">已停用</em>'); ?></div>
                <div class="clearfix inp margin104">
                    <button type="button" name="disabled-buttons" class="fbtn-ds" my_v="true" onclick="fsdo_account(this, 'status');">启用</button>
                    <button type="button" name="disabled-buttons" class="fbtn-ds" my_v="false" onclick="fsdo_account(this, 'status');">停用</button>
                </div>
            </li>
        </ul>
    </div>
    </form>
    <!-- 账户管理// -->
    
    <!-- //密码重置 -->
    <form method="post" onsubmit="return false;" id="form_password" class="dis-n">
    <input type="hidden" name="cuid" value="<?php prt($CUserRs['cuid']); ?>" />
    <input type="hidden" name="act" value="password" />
    <input type="hidden" name="doflag" value="" />
    <div class="clearfix ul-box">
        <ul class="ubox">
        	<li class="clearfix is">
                <div class="clearfix tit">新密码:</div>
                <div class="clearfix inp">
                    <input type="text" class="fs-ts-200" name="password" />
                </div>
            </li>
            
            <li class="clearfix is-def">
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo_password(this);">提交</button>
                <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt(_g('uri')->referer()); ?>'});">返回</button>
            </li>
        </ul>
    </div>
    </form>
    <!-- 密码重置// -->
    
</div>
<!-- tabs// -->

<!-- //javascript -->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/calendar/WdatePicker.js"></script>
<script language="javascript">
var __actUrl = "<?php prt(_g('cp')->uri('mod/cuser/ac/manager/op/set_do')); ?>";
/*_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });*/

var __curHref = "";
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

/* recommend */
function fsdo_recommend(_this){
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
/* account */
function fsdo_account(_this, _type){
	_this.form.doflag.value = _type;
	if(_type == "status"){
		_this.form.status.value = _this.getAttribute("my_v");
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
};
/* password */
function fsdo_password(_this, _type){
	_this.form.doflag.value = _type;
	if(_type == "status"){
		_this.form.status.value = _this.getAttribute("my_v");
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
};
</script>
<!-- javascript// -->