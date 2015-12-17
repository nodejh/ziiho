<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<a href="javascript:;" class="ml1">访问与控制</a>
</div>

<!-- //tabs -->
<div class="clearfix ul-box" tab="yes">
	<form method="post" onsubmit="return false;">
	<ul class="ubox">
    	<li class="clearfix is">
            <div class="clearfix tit">开启站点:</div>
            <div class="clearfix inp">
            	<?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="status" value="<?php prt($k); ?>" <?php if($v['v'] == _g('value')->sb(my_array_value('status', $options, _g('value')->sb(true)))){ ?> checked="checked"<?php } ?> /><?php prt($v['status']); ?></span>
                <?php } ?>
            </div>
            <div class="clearfix des">关闭站点后，站点将不可访问，但仅限超级管理员或指定的用户，才可访问。</div>
        </li>
        
        <?php foreach($uGroupData as $k=>$v) { ?>
        <?php $index = 0; ?>
        <li class="clearfix is">
            <div class="clearfix tit">可访问<?php prt($v['name']); ?>:</div>
            <div class="clearfix inp">
            	 <?php 
				 	$UGResult = $UGROUP->getList($v['v']);
					while($rs = $UGROUP->db->fetch_array($UGResult)){
						$index = $index + 1;
						$isCheked = my_in_array($rs['ugid'], my_array_value($v['v'], $ugOptions));
				?>
                <span class="checked_box <?php if($isCheked){ ?>checked_on<?php } ?>" checked="usergroup_<?php prt($v['v']); ?>" checkbox-icon="true" <?php if($isCheked){ ?>checkbox-status="true"<?php } ?>><em class="checked_inp"><input type="checkbox" name="usergroup[<?php prt($v['v']); ?>][]" value="<?php prt($rs['ugid']); ?>" <?php if($isCheked){ ?>checked="checked"<?php } ?> /></em><?php prt($rs['gname']); ?></span>
                <?php if($index % 8 == 0){ ?><div class="clear"></div><?php } ?>
                <?php } ?>
            </div>
            <div class="clearfix des">设置可访问<?php prt($v['name']); ?>。可选择多个</div>
        </li>
       <?php } ?>
        
        <li class="clearfix is">
            <div class="clearfix tit">可访问用户:</div>
            <div class="clearfix inp">
                <textarea class="fs-tt2" name="userable"><?php prt(my_array_value('userable', $options)); ?></textarea>
            </div>
            <div class="clearfix des"><p>设置可访问站点的用户名。</p><p>可设置为多个用户，每行为一个</p></div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix tit">可访问IP:</div>
            <div class="clearfix inp">
                <textarea class="fs-tt2" name="ipable"><?php prt(my_array_value('ipable', $options)); ?></textarea>
            </div>
            <div class="clearfix des"><p>设置可访问站点的IP。</p><p>可设置为多个IP，每行为一个</p></div>
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
_GESHAI.radio({ radioItem: 'span[radio="status"]', name: "status" });

<?php foreach($uGroupData as $k=>$v) { ?>
_GESHAI.checkbox({ "fClass": "", "tClass": "checked_on", "checkboxItem": "span[checked=\"usergroup_<?php prt($v['v']); ?>\"]", "name": "usergroup[<?php prt($v['v']); ?>][]" });
<?php } ?>

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/visitablecfg/op/do')); ?>", {
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