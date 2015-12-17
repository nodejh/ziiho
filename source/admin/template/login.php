<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<style type="text/css">
body {
	background: url(<?php prt ( sdir ( 'source' ) ); ?>/admin/template/image/login-bg.png) no-repeat center top;
}
</style>

<div class="clearfix login">

	<!-- //ml -->
	<div class="clearfix z ml">
		<div class="clearfix d">
			<p class="rline"></p>
			<!--<p class="tit fb fspace"><?php prt(_g('value')->geshai('name')); ?></p>
			<p class="desc fspace"><?php prt(_g('value')->geshai('description')); ?></p>-->
		</div>
	</div>
	<!-- ml// -->

	<!-- //mr -->
	<div class="clearfix y mr fspace">
		<form method="post" onsubmit="return false;">
			<p class="tit fb">
				<span class="txt">后台管理中心</span>
			</p>

			<p class="clearfix inp">
				<span class="z n">用户名:</span> <span class="z t"><input type="text" class="w" name="username" /></span>
			</p>

			<p class="clearfix inp">
				<span class="z n">密 码:</span> <span class="z t"><input type="password" class="w" name="password" /></span>
			</p>

			<p class="clearfix inp">
				<span class="z n">验证码:</span> <span class="z c"><input type="text" class="ti" name="checkcode" /></span> <span class="z ct" id="captcha-box"></span><span class="z cc"><a href="javascript:;" id="captcha-click"></a></span>
			</p>

			<p class="clearfix inp">
				<span class="z btn"><button type="submit" name="disabled-buttons" class="sb" onclick="return admin_login_do(this);">登陆</button></span>
			</p>
		</form>
	</div>
	<!-- mr// -->

</div>
<div class="clear"></div>

<div class="clearfix footer">
	<p class="t1"><?php prt(_g('value')->geshai('powered_html')); ?> v<?php prt(_g('value')->geshai('version')); ?> <?php prt(_g('value')->geshai('copyright')); ?></p>
	<p class="t2"></p>
</div>

<!-- //javascript  -->
<script language="javascript">

window.onload = function(){
	_GESHAI.captcha({ captcha: "captcha-box", "click": "captcha-click" });
};

function admin_login_do(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('ac/login/op/do')); ?>", {
		"start": function(){
			_GESHAI.disbtn("", true);
			_GESHAI.dialog({isHeader: false, isFooter: false, data: "正在登录，请稍后..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			if(d.status != 1){
				d.clickBgClose = true;
				d.title = "登陆失败";
			}else{
				d.isFooter = false;
				d.title = "登陆成功";
				d.data = "Loading...";
			}
			_GESHAI.dialog(d);
			if(d.status == 1){
				_GESHAI.redirect(d);
			}
		}
	});
};
</script>
<!-- javascript//  -->