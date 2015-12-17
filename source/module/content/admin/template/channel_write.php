<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">基本选项</a><a href="javascript:;" class="ml2 on">SEO选项</a>
</div>

<div class="clearfix ul-box">
	
    <ul class="ubox">
        <li class="clearfix is">
			<?php $channel->include_cpos(my_array_value('parentid', $channelSub)); ?>
			<?php if(my_array_key_exist('channelid', $channelSub)){ ?><span class="pos-sp">-</span><span class="tc-a t-fw"><?php prt(my_array_value('cname', $channelSub)); ?></span><?php } ?>
		</li>
	</ul>
</div>

<form method="post" onsubmit="return false;">
<input type="hidden" name="channelid" value="<?php prt(my_array_value('channelid', $channelSub, 0)); ?>" />
<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
        <li class="clearfix is">
            <div class="clearfix tit">排序:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="listorder" value="<?php prt(my_array_value('listorder', $channelSub, 0)); ?>" />
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">名称:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="cname" value="<?php prt(my_array_value('cname', $channelSub)); ?>" />
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">目录化:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-200" name="dir" value="<?php prt(my_array_value('dir', $channelSub)); ?>" />
            </div> <!--<div class="clearfix des">
            <p class="ds">dsads</p>
        </div>-->
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">栏目分类:</div>
            <div class="clearfix inp">
                <select name="parentid" class="fs-ts-200">
                    <option value="0">无分类(作为顶级)</option>
                	<?php $channel->option($channelSub, 0, 0); ?>
            	</select>
            </div>
        </li>

        <li class="clearfix is">
            <div class="clearfix tit">打开方式:</div>
            <div class="clearfix inp">
                <select name="target" class="fs-ts-200">
                <?php foreach(_g('value')->ra(_g('module')->dv('@', 100001)) as $v){ ?>
                <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('target', $channelSub)){ ?> selected="selected" <?php } ?>><?php prt($v['name']); ?></option>
                <?php } ?>
            </select>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">导航显示:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="isnav"><input type="radio" name="isnav" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('isnav', $channelSub)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">启用:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('status', $channelSub)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
            </div>
        </li>
	</ul>
    
    <ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">title:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="seo_title" value="<?php prt(my_array_value('seo_title', $channelSub)); ?>" />
            </div> <!--<div class="clearfix des">
            <p class="ds">dsads</p>
        </div>-->
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">keywords:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="seo_keywords" value="<?php prt(my_array_value('seo_keywords', $channelSub)); ?>" />
            </div> <!--<div class="clearfix des">
            <p class="ds">dsads</p>
        </div>-->
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">description:</div>
            <div class="clearfix inp">
                <input type="text" class="fs-ts-240" name="seo_description" value="<?php prt(my_array_value('seo_description', $channelSub)); ?>" />
            </div> <!--<div class="clearfix des">
            <p class="ds">dsads</p>
        </div>-->
        </li>
    </ul>
</div>
<!-- tabs// -->

<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt($gobackUrl); ?>'});">返回</button>
        </li>
    </ul>
</div>
</form>

<!-- //javascript -->
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });
_GESHAI.radio({ radioItem: 'span[radio="isnav"]', name: "isnav" });
	
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/content/ac/channel/op/write_save')); ?>", {
		"goback": "<?php prt($gobackUrl); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "操作失败";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				_GESHAI.redirect(d);
			}
		}
	});
};
</script>
<!-- javascript// -->