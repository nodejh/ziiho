<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'home_nav', true); ?>

<!-- //banner -->
<div class="banner clearfix" id="banner">

	<div class="bd clearfix">
		<div class="shadow clearfix"></div>
		<ul class="box clearfix">
			<li class="clearfix"><img
				src="<?php prt(_g('template')->dir('job')); ?>/image/f/index-header-bg2.jpg" height="400"/></li>
			<li class="clearfix"><img
				src="<?php prt(_g('template')->dir('job')); ?>/image/f/index-header-bg3.jpg" height="400"/></li>
		</ul>
	</div>

	<div class="hd clearfix">
		<ul class="box clearfix">
			<li class="clearfix">1</li>
			<li class="clearfix">2</li>
		</ul>
	</div>

	<div class="cbox clearfix">

		<div class="z bi clearfix">
			<a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" class="color-white"><div class="aa clearfix color-background">学习中心</div></a>
			<div class="bb clearfix">LEARNING CENTER</div>
			<div class="cc clearfix">针对于职位的职业能力训练</div>
		</div>

		<div class="y bi clearfix">
            <a href="<?php prt(_g('uri')->su('job/ac/job')); ?>" class="color-white"><div class="aa clearfix color-background">求职中心</div></a>
			<div class="bb clearfix">JOB CENTER</div>
			<div class="cc clearfix">针对于职业的职位寻找</div>
		</div>
	</div>

</div>
<!-- banner// -->


<!-- //main -->
<div class="main clearfix">
	<!-- //i-area -->
	<div class="i-area clearfix">

		<div class="i-box i-box-bline clearfix">
			<div class="z i-box-hd clearfix">
				<div class="icons icon-learn clearfix"></div>
			</div>

			<div class="z i-box-bd clearfix">
				<div class="i-box-bd-a clearfix">学习中心</div>
				<div class="i-box-bd-b clearfix">(LEARNING CENTER)</div>
				<div class="i-box-bd-c clearfix">
					<p>本课程是严格按照企业的职位要求制定的学习方案，通过品台的测试可以获得认证。</p>
					<p>严格按照企业的职位要求制定的学习方案，通过品台的测试可以获得认证。严格按照企业的职位要求制定的学习方案，通过品台的测试</p>
					<p>通过品台的测试可以获得认证。</p>
				</div>
				<div class="i-box-bd-d clearfix">
					<div class="rz-view clearfix">
						<a href="javascript:;">我要认证</a>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>


		<div class="i-box i-box-bline clearfix">
			<div class="z i-box-hd clearfix">
				<div class="icons icon-job clearfix"></div>
			</div>

			<div class="z i-box-bd clearfix">
				<div class="i-box-bd-a clearfix">求职中心</div>
				<div class="i-box-bd-b clearfix">(JOB CENTER)</div>
				<div class="i-box-bd-c clearfix">
					<p>精选疙瘩职业的职位信息与实习信息。</p>
					<p>严格按照企业的职位要求制定的学习方案，通过品台的测试可以获得认证。严格按照企业的职位要求制定的学习方案，通过品台的测试</p>
					<p>通过品台的测试可以获得认证。</p>
				</div>
				<div class="i-box-bd-d clearfix"></div>
			</div>
		</div>
		<div class="clear"></div>


		<div class="i-box i-box-bline clearfix">
			<div class="z i-box-hd clearfix">
				<div class="icons icon-rz clearfix"></div>
			</div>

			<div class="z i-box-bd clearfix">
				<div class="i-box-bd-a clearfix">认证中心</div>
				<div class="i-box-bd-b clearfix">(CERTIFICATION CENTER)</div>
				<div class="i-box-bd-c clearfix">
					<p>专业的职业能力认证，科获得证书。</p>
					<p>严格按照企业的职位要求制定的学习方案，通过品台的测试可以获得认证。</p>
				</div>
				<div class="i-box-bd-d clearfix"></div>
			</div>
		</div>
		<div class="clear"></div>


		<div class="i-box i-box-bline clearfix">
			<div class="z i-box-hd clearfix">
				<div class="icons icon-us clearfix"></div>
			</div>

			<div class="z i-box-bd clearfix">
				<div class="i-box-bd-a clearfix">关于我们</div>
				<div class="i-box-bd-b clearfix">(ABOUT US)</div>
				<div class="i-box-bd-c clearfix">
					<p>关于本公司的简短介绍。</p>
					<p>严格按照企业的职位要求制定的学习方案，通过品台的测试可以获得认证。严格按照企业的职位要求制定的学习方案。</p>
				</div>
				<div class="i-box-bd-d clearfix">
					<div class="us-info clearfix">
						<p>
							<em class="ns-c1">E-mail:</em><em class="ns-c2"> rbb@rubyrare.com</em>
							<em class="ns-c1 ns-ml1">Tel:</em><em class="ns-c2"> 028 -
								00000000</em>
						</p>
						<p>
							<em class="ns-c1">Address:</em><em class="ns-c2"> 四川 - 成都</em>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>



	</div>
	<!-- i-area// -->
</div>
<div class="clear"></div>
<!-- main// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script language="javascript">
$(document).ready(function(e) {
	var _ms = {"w": 1920, "h": 900};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _bannero = $("#banner");
		_bannero.width(_ss.w).height(_ss.h);
		_bannero.find(".bd .box li img").width(_ss.w).height(_ss.h);
		_bannero.find(".cbox").css({"left": (((_cs.w - 1200) / 2) + "px"), "top": ((_ss.h / 2) - 150) + "px"}).show();
});

var _bannerContItem = $("#banner").find(".cbox").find(".bi");
/* 头部切换 */		
$("#banner").cjslip({
	autoPlay: true,
	loop: true,
	effect: 'left',
	mainEl: '.bd .box',
	mPrev: ".prev",
	delayTime: 5000,
	mNext: ".next",
	mainState: '.hd .box li',
	startFunc: function(i){
		
	},
	completeFunc: function(i, total, page, pageTotal, mainState, pageState, scrollEl, mainEl){
		_bannerContItem.stop(true, true);
		_bannerContItem.not(":eq(" + i + ")").hide();
		_bannerContItem.eq(i).show();
			
		mainState.not(":eq(" + i + ")").css("opacity", 0.5);
		mainState.eq(i).css("opacity", "");
	}
});
</script>

<?php include _g('template')->name('@', 'footer', true); ?>