<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/learn-bg.jpg"
			width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //wrap-main -->
<div class="wrap-main clearfix" id="wrap-main">
	<!-- //ma -->
	<div class="ma clearfix">
		<div class="ns clearfix">
			<!-- //aaa -->
			<div class="aaa clearfix">
				<div class="sb clearfix"></div>
				<ul class="box clearfix">
					<li class="ic-home clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="nn">返回首页</a></li>
					<li class="ic-def clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" class="nn">学习方案</a></li>
					<li class="ic-def clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/material')); ?>" class="nn">学习资料</a></li>
					<li class="ic-on clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/practical')); ?>" class="nn">实用信息</a></li>
					<li class="ic-s clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/search')); ?>" class="nn"><em
							class="icon-search">伯乐一下</em></a></li>
				</ul>
			</div>
			<!-- aaa// -->

			<!-- //bbb -->
			<div class="bbb clearfix"></div>
			<!-- bbb// -->
		</div>
	</div>
	<!-- ma// -->
	<div class="mb clearfix"></div>
	<!-- //mc -->
	<div class="mc clearfix">
		<div class="practical clearfix">
			<!-- //bd -->
			<div class="bd clearfix">
				<div class="d-box">
					<ul class="box">
						<li style="background: #2f3573;"><a href="<?php prt(_g('uri')->su('job/ac/jianligonglue')); ?>"><em class="fbig">简历攻略</em></a></li>
						<li style="background: #255b4a;"><a href="<?php prt(_g('uri')->su('job/ac/mianshizhinan')); ?>"><em class="fbig">面试指南</em></a></li>
						<li style="background: #555924;"><a href="<?php prt(_g('uri')->su('job/ac/zhichangdaren')); ?>"><em class="fbig">职场达人</em></a></li>
						<li style="background: #732f47;"><a href="<?php prt(_g('uri')->su('job/ac/news')); ?>"><em class="fbig">职业资讯</em></a></li>
					</ul>
				</div>
			</div>
			<div class="clear"></div>
			<!-- bd// -->
		</div>
	</div>
	<!-- mc// -->
</div>
<!-- wrap-main// -->

<script language="javascript">
$(document).ready(function(e) {
    var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _wrapMainObj = $("#wrap-main");
		_wrapMainObj.find(".ma,.mc").height(_ss.h);
		_wrapMainObj.find(".ma .ns .aaa,.ma .ns .bbb").height(_ss.h);
});
	
</script>

<?php include _g('template')->name('@', 'footer', true); ?>