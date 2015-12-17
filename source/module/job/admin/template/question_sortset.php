<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<style type="text/css">
	.xss { float:left; margin:5px; padding:0px 5px; line-height: 22px; cursor: pointer; }
	.xss:hover { color: #ff6600; text-decoration: underline; }
	.xss-bg { background: #ccc; }
</style>

<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
    	<li class="clearfix is">
            <a href="<?php prt($gobackUrlStr); ?>" class="fa-cd icon-page-goback">返回</a>-
            &nbsp;&nbsp;<strong><?php prt($questionSub['qname']); ?>&nbsp;&nbsp;-&nbsp;&nbsp;<font class="tc-b">分类设置</font></strong>
        </li>
	</ul>
</div>

<div class="clearfix page-inform">
	<p class="light">提示：</p>
    <p class="txts"><em class="st">•</em>该功能用于设置关联多个职位分类，便于职位分类之间共享</p>
    <p class="txts"><em class="st">•</em>至少需要选择一项，才能提交</p>
</div>

<form method="post" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" name="questionid" value="<?php prt($questionSub['questionid']); ?>" />

<div class="clearfix ul-box" tab="yes">
	<ul class="ubox">
	
        <?php $sortParent0 = $sort->finds ('parentid', 0 ); while ($p0 = $sort->db->result($sortParent0)) { ?>
    	<li class="clearfix is bg-b fw" style="border-bottom: 1px solid #ccc;"><?php prt($p0['sname']); ?></li>
    	<li class="clearfix is">
    		<?php $sortParent1 = $sort->finds ('parentid', $p0['sortid'] ); while ($p1 = $sort->db->result($sortParent1)) { $isChecked = my_in_array($p1['sortid'], $sortidData, $arr); ?>
    		<span class="clearfix xss <?php prt($isChecked ? 'xss-bg' : null); ?>" checkbox-item="sortid" checkbox-icon="true" <?php prt($isChecked ? 'checkbox-status="true"' : null); ?>><input type="checkbox" class="chkbox" name="sortid[]" value="<?php prt($p1['sortid']); ?>" <?php prt($isChecked ? 'checked="checked"' : null); ?> /><?php prt($p1['sname']); ?></span>
    		<?php } ?>
    	</li>
    	<?php } ?>
    	
	</ul>
</div>
<div class="clearfix ul-box">        
	<ul class="ubox">
        <li class="clearfix is-def">
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
            <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="_GESHAI.redirect({'url':'<?php prt($gobackUrlStr); ?>'});">返回</button>
        </li>
    </ul>
</div>

</form>

<!-- //javascript -->
<script language="javascript">
_GESHAI.checkbox({
	"fClass": "",
	"tClass": "xss-bg",
	"checkbox": "",
	"checkboxItem": "span[checkbox-item=sortid]",
	"name": "sortid[]"
});

function fsdo(_this, _t){
	if($("input[name='sortid[]']:checked").length < 1) {
		window.top._GESHAI.dialog({isCloseBtn: false, clickBgClose: true, title: "操作提示：", data: "操作失败，请至少选择一项"});
		return false;
	}
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('mod/job/ac/question/op/sortsetdo')); ?>", {
		  "goback": "<?php prt( $gobackUrlStr ); ?>>",
		  "start": function(){
			  _GESHAI.disbtn("", true);
			  window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
		  },
		  "success": function(d){
			  _GESHAI.disbtn("", false);
			  
			  d.isCloseBtn = false;
			  d.clickBgClose = true;
			  d.title = "操作提示：";
			  window.top._GESHAI.dialog(d);
			  if(d.status == 1){
				  _GESHAI.redirect(d);
			  }
		  }
	  });
};
</script>
<!-- javascript//  -->