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
						href="<?php prt(_g('uri')->su('job/ac/company')); ?>" class="nn">名&nbsp;企</a></li>
					<li class="ic-wn clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/profession')); ?>"
						class="nn">热门行业</a></li>
					<li class="ic-def clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/work')); ?>" class="nn">热门职位</a></li>
					<li class="char-area clearfix"><a class="nn cbg">所有公司</a>
						<div class="char-box clearfix">
                        	<?php $index = 0; ?>
                        	<?php for($i = 65; $i < 91; $i++): ?><?php $index++; ?><a
								href="<?php prt(_g('uri')->su('job/ac/company/op/search/char/' . chr($i))); ?>"
								class="<?php if($index % 4 == 1): ?>mlpx<?php endif; ?>"><em
								class="def"><?php prt(chr($i)); ?></em></a><?php if($index % 4 == 0): ?><div
								class="clear"></div><?php endif; ?><?php endfor; ?>
                        </div></li>
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
                    	<?php $jBgColor = array('0d1e68', '0b465f', '164c31', '43550b', '443207', '5a2f22', '6a1a6b'); ?>
                        <?php while($rs = _g('db')->result($sortResult)): ?>
						<li style="background: #<?php prt($jBgColor[rand(0, 6)]); ?>;"><a href="<?php prt(_g('uri')->su('job/ac/profession/op/list/sortid/' . $rs['sortid'])); ?>"><?php prt($rs['sname']); ?></a></li>
                        <?php endwhile; ?>
                        
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
		<div class="company_search clearfix">
			<!-- //bd -->
			<div class="bd clearfix" id="company_search_bd">
				<ul class="box clearfix">
                	<?php while($rs = _g('db')->result($userResult)): ?>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/id/' . $rs['cuid'])); ?>"><?php prt($rs['cname']); ?></a></li>
                    <?php endwhile; ?>
				</ul>
			</div>
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
	
});
	
</script>

<?php include _g('template')->name('@', 'footer', true); ?>