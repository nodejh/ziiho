<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">站点设置</a>
</div>

<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<form method="post" onsubmit="return false;">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">站点名称:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="sitename" value="<?php prt($options['sitename']); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">网站名称:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="subname" value="<?php prt($options['subname']); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">站点URL:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="url" value="<?php prt(my_array_value('url', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">站点关键字[keywords]:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="keywords" value="<?php prt(my_array_value('keywords', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">站点介绍[description]:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="description" value="<?php prt(my_array_value('description', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">ICP备案号:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="icp" value="<?php prt(my_array_value('icp', $options)); ?>" />
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">站点风格:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="siteskin" value="<?php prt(my_array_value('siteskin', $options)); ?>" />
            </div>
            <div class="clearfix des">
            	设置一个站点模板风格的模板名。如果为空，则使用默认模板“default”
            </div>
        </li>
        
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
        </li>
	</ul>
    </form>
    
</div>
<!-- tabs// -->

<!-- //javascript -->
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/setting/op/do')); ?>", {
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