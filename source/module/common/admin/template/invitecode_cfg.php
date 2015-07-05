<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach($navData as $k => $v){ ?>
	<a href="<?php prt(_g('cp')->uri($v['uri'])); ?>" class="ml1 <?php prt($ni == $k ? 'on' : null); ?>"><?php prt($v['name']); ?></a>
    <?php } ?>
</div>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>“邀请码有效时间”作为颁发给用户的邀请码的一个注册时间期限段。若邀请码过期，则作废将不被受理</p>
</div>

<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<form method="post" onsubmit="return false;">
	<ul class="ubox">
        <li class="clearfix is">
                <div class="clearfix tit">邀请码有效时间:</div>
                <div class="clearfix inp">
                    S：<input type="text" class="fs-ts-180" name="stime" value="<?php prt($options['stime']); ?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd HH:mm:ss'})" />&nbsp;~&nbsp;E：<input type="text" class="fs-ts-180" name="etime" value="<?php prt($options['etime']); ?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd HH:mm:ss'})" />
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
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/calendar/WdatePicker.js"></script>
<script language="javascript">
/*_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });*/

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/invitecode/op/cfgdo')); ?>", {
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