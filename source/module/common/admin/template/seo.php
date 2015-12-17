<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-tab">
	<?php foreach(_g('module')->seo() as $k=>$v){ ?>
	<a href="javascript:;" class="ml1"><?php prt($v['subname']);?></a>
    <?php } ?>
</div>

<!-- //tabs -->
<div class="clearfix ul-box">
	
	<?php foreach (_g('module')->seo() as $MN=>$mV){ ?>
	<div class="clearfix" tab="yes">
		<div class="clearfix">
			<!-- //global -->
			<?php $_seoGlobalVars = _g('module')->seoVar('@'); ?>
			<?php if (my_is_array($_seoGlobalVars)) { ?>
			<div class="clearfix seovar seovar_bl">
				<?php foreach ($_seoGlobalVars as $k=>$v){ ?>
				<span class="glo"><em><?php prt(_g('module')->seoVarTag($k)); ?></em><font><?php prt($v['description']); ?></font></span>
				<?php } ?>
			</div>
			<?php } ?>
			<!-- global// -->
			
			<?php $_seoVars = _g('module')->seoVar($MN); ?>
			<?php if (my_is_array($_seoVars)) { ?>
			<div class="clearfix seovar">
				<?php foreach ($_seoVars as $k=>$v){ ?>
				<span class="local"><em><?php prt(_g('module')->seoVarTag($k)); ?></em><font><?php prt($v['description']); ?></font></span>
				<?php } ?>
			</div>
			<?php } ?>
			<?php include _g('cp')->get_template($MN, 'seo'); ?>
		</div>
    </div>
    <?php } ?>
    
</div>
<!-- tabs// -->

<!-- //javascript -->
<script language="javascript">
$("#body").cjslip({ speed: 0, eventType: 'click', mainEl: 'div[tab="yes"]', mainState: '.page-tab a' });

/* doing */
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/common/ac/seo/op/do')); ?>", {
		"goback": "<?php prt(_g('uri')->referer()); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			d.clickBgClose = true;
			window.top._GESHAI.dialog(d);
		}
	});
};
</script>
<!-- javascript// -->