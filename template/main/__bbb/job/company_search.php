<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/company-search-bg.jpg"
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
					<li class="ic-def clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/profession')); ?>"
						class="nn">热门行业</a></li>
					<li class="ic-def clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/work')); ?>" class="nn">热门职位</a></li>
					<li class="char-area clearfix"><a class="nn cbg1">所有公司</a>
						<div class="char-box clearfix">
                        	<?php $index = 0; ?>
                        	<?php for($i = 65; $i < 91; $i++): ?><?php $index++; ?><a
								href="<?php prt(_g('uri')->su('job/ac/company/op/search/char/' . chr($i))); ?>"
								class="<?php if($index % 4 == 1): ?>mlpx<?php endif; ?>"><em
								class="<?php prt($charStr != chr($i) ? 'def':'on'); ?>"><?php prt(chr($i)); ?></em></a><?php if($index % 4 == 0): ?><div
								class="clear"></div><?php endif; ?><?php endfor; ?>
                        </div></li>
					<li class="ic-s clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/search')); ?>" class="nn"><em
							class="icon-search">伯乐一下</em></a></li>
				</ul>
			</div>
			<!-- aaa// -->
		</div>
	</div>
	<!-- ma// -->

	<!-- //mc -->
	<div class="mc clearfix">
		<div class="company_search clearfix">
			<!-- //bd -->
			<div class="bd clearfix" id="company_search_bd">
				<ul class="box clearfix">
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">沃尔玛(WAL-MART STORES)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">荷兰皇家壳牌石油公司（ROYAL DUTCH SHELL)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">中国石油化工集团公司（SINOPEC GROUP)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">中国石油天然气集团公司（CHINA NATIONAL PETROLEUM)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">埃克森美孚（EXXON MOBIL)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">英国石油公司（BP)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">国家电网公司（STATE GRID)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">大众公司（VOLKSWAGEN)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">丰田汽车公司（TOYOTA MOTOR)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">嘉能可（GLENCORE)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">道达尔公司（TOTAL)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">雪佛龙（CHEVRON)</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">三星电子（SAMSUNG ELECTRONICS) </a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">伯克希尔－哈撒韦公司</a></li>
					<li><a href="<?php prt(_g('uri')->su('job/ac/company/op/job')); ?>">苹果公司（APPLE)</a></li>
				</ul>
			</div>
			<!-- bd// -->
		</div>
	</div>
	<!-- mc// -->
</div>
<!-- wrap-main// -->

<script type="text/javascript"
	src="<?php prt(_g('template')->dir('job')); ?>/js/scrollbar.js"></script>
<script language="javascript">
$(document).ready(function(e) {
    var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _wrapMainObj = $("#wrap-main");
		_wrapMainObj.find(".ma,.mc").height(_ss.h);
		_wrapMainObj.find(".ma .ns .aaa").height(_ss.h);
});
</script>
<?php include _g('template')->name('@', 'footer', true); ?>