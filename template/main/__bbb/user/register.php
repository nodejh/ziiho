<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/register.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/register-index-bg.jpg"
			width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //register-index -->
<div class="register-index clearfix" id="register_index">
	<!-- //box -->
	<div class="box clearfix">
		<div class="shadow clearfix"></div>
		<div class="n clearfix">
			<div class="c aa clearfix">
				<span class="icon-checkbox" data="1"></span>个人注册
			</div>
			<div class="c bb clearfix">
				<span class="icon-checkbox" data="2"></span>公司注册
			</div>
		</div>
		<div class="btn yh clearfix">
			<a href="javascript:;">确定</a>
		</div>
	</div>
	<!-- box// -->
</div>
<!-- register-index// -->

<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#register_index");
		_mObj.height(_ss.h - 66);
	
	/* select */
	var _selectValue = "";
	var _selectObjItems = _mObj.find(".box .n .c");
	_selectObjItems.click(function(e){
		var _index = _selectObjItems.index(this);
        if($(this).find(".icon-checkbox").attr("flag") != "true"){
			_selectValue = parseInt($(this).find(".icon-checkbox").attr("data"));
			_selectObjItems.not(":eq(" + _index + ")").find(".icon-checkbox").removeClass("icon-checkboxed").attr("flag", "");
			$(this).find(".icon-checkbox").addClass("icon-checkboxed").attr("flag", "true");
		}
    });
	/* btn */
	_mObj.find(".box .btn").click(function(e){
        if(_selectValue < 1){
			alert("对不起，请先选择注册类型！");
			return false;
		}
		if(_selectValue == 1){
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('user/ac/register/op/email')); ?>"});
		}else{
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('user/ac/register/op/company')); ?>"});
		}
    });
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>