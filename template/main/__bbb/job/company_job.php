<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/company-bg.jpg"
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
					<li class="ic-wn clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/company')); ?>" class="nn">名&nbsp;企</a></li>
					<li class="ic-def clearfix"><a
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
						<?php while($rs = _g('db')->result($cUserResult)): ?>
                    	<li><img src="<?php prt($CUSER->logo($rs['logo'])); ?>" width="100%" height="84" onclick="_GESHAI.redirect({url:'<?php prt(_g('uri')->su('job/ac/company/id/' . $rs['cuid'])); ?>'});" style="cursor:pointer;" /></li>
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
		<div class="work clearfix">
			<!-- //log-title -->
        	<div class="log-title clearfix">
                <p class="logo">
                    <img src="<?php prt($CUSER->logo($cUserData['logo'])); ?>" width="100%" height="100%" />
                </p>
                <p class="t"><?php prt($cUserData['cname']); ?></p>
            </div>
            <div class="clear"></div>
			<!-- log-title// -->
            
            <!-- //job-detail -->
            <div class="job-detail clearfix">
            	<p class="fl"><?php prt($jobData['jname']); ?> - 职位要求：</p>
                <?php prt($jobData['content']); ?>
            </div>
            <!-- job-detail// -->
            
            <!-- //job-nav -->
            <div class="job-nav clearfix">
            	<div class="ns ns-ml"><div class="shadow"></div><a href="<?php prt(_g('uri')->su('job/ac/company/op/jobrz/id/' . _get('id') . '/jobid/' . $jobid)); ?>">我要认证</a></div>
                <div class="ns"><div class="shadow"></div><a href="<?php prt(_g('uri')->su('job/ac/company/op/jobstep/id/' . _get('id') . '/jobid/' . $jobid)); ?>">学习方案</a></div>
            </div>
            <!-- job-nav// -->
            
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
	var _dataBdObj = _wrapMainObj.find(".mc .work .bd");
	var _dataBoxObj = _dataBdObj.find(".d-box");
	var _dataBoxItemObj = _dataBoxObj.find("ul.box").eq(0);
	var _dataBoxWH = [_dataBoxItemObj.outerWidth(), _dataBoxItemObj.outerHeight()];
		_dataBdObj.width(_dataBoxWH[0]).height(_dataBoxWH[1]);
		_dataBoxObj.width(_dataBoxWH[0]).height(_dataBoxWH[1]);
	
	$("#wrap-main").cjslip({
		autoPlay: false,
		loop: true,
		effect: 'left',
		mainEl: '.mc .work .bd .d-box',
		delayTime: 5000,
		mainState: '.mc .work .hd .n-box a'
	});
});
	
</script>

<?php include _g('template')->name('@', 'footer', true); ?>