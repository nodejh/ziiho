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
					<li class="ic-on clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/material')); ?>" class="nn">学习资料</a></li>
					<li class="ic-def clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/practical')); ?>" class="nn">实用信息</a></li>
					<li class="ic-s clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/search')); ?>" class="nn"><em
							class="icon-search">伯乐一下</em></a></li>
				</ul>
			</div>
			<!-- aaa// -->

			<!-- //bbb -->
			<div class="bbb clearfix">
				<div class="sb clearfix"></div>

				<a href="javascript:;" class="icon-btn icon-page-up"><img
					src="<?php prt(_g('template')->dir('job')); ?>/image/page-up.png" /></a>
				<a href="javascript:;" class="icon-btn icon-page-down"><img
					src="<?php prt(_g('template')->dir('job')); ?>/image/page-down.png" /></a>

				<div class="area-bd">
					<ul class="box">
						<li style="background: #0d1e68;"><a href="#">机构组织</a></li>
						<li style="background: #0b465f;"><a href="#">信息产业</a></li>
						<li style="background: #164c31;"><a href="#">医药卫生</a></li>
						<li style="background: #43550b;"><a href="#">建筑建材</a></li>
						<li style="background: #443207;"><a href="#">冶金资产</a></li>
						<li style="background: #5a2f22;"><a href="#">石油化工</a></li>
						<li style="background: #6a1a6b;"><a href="#">水利水电</a></li>
					</ul>
				</div>
			</div>
			<!-- bbb// -->
		</div>
	</div>
	<!-- ma// -->
	<div class="mb clearfix"></div>
	<!-- //mc -->
	<div class="mc clearfix">
		<div class="data clearfix">
			<!-- //bd -->
			<div class="bd clearfix">
				<div class="d-box">
                	<?php for($i = 0; $i < 4; $i++): ?>
                    <ul class="box">
						<li style="background: #ff7036;"><a href="#"><em class="fbig">财务数据分析员</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #593b3e;"><a href="#"><em class="fbig">研究与试验发展</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #01143e;"><a href="#"><em class="fbig">客户经理（销售代表）</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #006a60;"><a href="#"><em class="fbig">财务数据分析员</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #01417e;"><a href="#"><em class="fbig">专业技术服务</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #006ea7;"><a href="#"><em class="fbig">市场拓展经理/员</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #666666;"><a href="#"><em class="fbig">金融信托和管理</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #004878;"><a href="#"><em class="fbig">房地产开发经营</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #00887a;"><a href="#"><em class="fbig">工程技术与规划管理</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #c1a700;"><a href="#"><em class="fbig">计算机及通讯</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #3c6657;"><a href="#"><em class="fbig">区域主管
									项目经理</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #6ba151;"><a href="#"><em class="fbig">财务数据分析员</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #6d455a;"><a href="#"><em class="fbig">工程技术与规划管理</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #9e2036;"><a href="#"><em class="fbig">市场拓展经理</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #005d35;"><a href="#"><em class="fbig">财务数据分析员</em><br />
							<em class="fsmall">学习方案</em></a></li>
						<li style="background: #7b2394;"><a href="#"><em class="fbig">专业技术服务</em><br />
							<em class="fsmall">学习方案</em></a></li>
					</ul>
                    <?php endfor; ?>
            	</div>
			</div>
			<div class="clear"></div>
			<!-- bd// -->
			<!-- hd// -->
			<div class="hd clearfix">
				<div class="n-box">
                	<?php for($i = 0; $i < 4; $i++): ?><a href="#"
						class="icon-def"></a><?php endfor; ?>
                </div>
			</div>
			<!-- hd// -->
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
	
	var _bbbBox = _wrapMainObj.find(".ma .ns .bbb");
	var _bbbItems = _bbbBox.find(".area-bd ul.box li");
	var _bbbIH = _bbbItems.eq(0).outerHeight();
	var _bbbICount = ((_ss.h - (_ss.h % _bbbIH)) / _bbbIH) - 2;
	_bbbBox.find(".icon-page-down").css("top",  ((_bbbICount * (_bbbIH + 10)) + 80) + "px");
	
	$("#wrap-main").cjslip({
		autoPlay: false,
		loop: false,
		direction: 'top',
		delayTime: 5000,
		visNum: _bbbICount,
		scrollNum: (_bbbICount - 1),
		scrollEl: '.ma .ns .bbb .area-bd ul.box',
		sPrev: ".ma .ns .bbb .icon-page-up",
		sNext: ".ma .ns .bbb .icon-page-down"
	});
	
	/* 数据 */
	var _dataBdObj = _wrapMainObj.find(".mc .data .bd");
	var _dataBoxObj = _dataBdObj.find(".d-box");
	var _dataBoxItemObj = _dataBoxObj.find("ul.box").eq(0);
	var _dataBoxWH = [_dataBoxItemObj.outerWidth(), _dataBoxItemObj.outerHeight()];
		_dataBdObj.width(_dataBoxWH[0]).height(_dataBoxWH[1]);
		_dataBoxObj.width(_dataBoxWH[0]).height(_dataBoxWH[1]);
	
	$("#wrap-main").cjslip({
		autoPlay: false,
		loop: true,
		effect: 'left',
		mainEl: '.mc .data .bd .d-box',
		delayTime: 5000,
		mainState: '.mc .data .hd .n-box a'
	});
});
	
</script>

<?php include _g('template')->name('@', 'footer', true); ?>