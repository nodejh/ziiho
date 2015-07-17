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
					<li class="char-area clearfix"><a class="nn cbg">所有公司</a>
						<div class="char-box clearfix">
                        	<?php $index = 0; ?>
                        	<?php for($i = 65; $i < 91; $i++): ?><?php $index++; ?><a
								href="<?php prt(_g('uri')->su('job/ac/company/op/search/char/' . chr($i))); ?>"
								class="<?php if($index % 4 == 1): ?>mlpx<?php endif; ?>"><em
								class="<?php prt($charStr != chr($i) ? 'def':'on'); ?>"><?php prt(chr($i)); ?></em></a><?php if($index % 4 == 0): ?><div
								class="clear"></div><?php endif; ?><?php endfor; ?>
                        </div></li>
					<li class="ic-s clearfix"><a
						href="<?php prt(_g('uri')->su('job/ac/search')); ?>" class="nn nn-bg"><em
							class="icon-search">伯乐一下</em></a></li>
				</ul>
			</div>
			<!-- aaa// -->
		</div>
	</div>
	<!-- ma// -->

	<!-- //mc -->
	<div class="mc clearfix">
		<div class="search-box clearfix">
        	<div class="w-inp clearfix">
            	<div class="shadow clearfix"></div>
                <div class="icon"></div>
                <input type="text" class="wd" name="word" placeholder="请输入您要查询的公司/实习/学习方案等" />
                <button type="button" class="wb">伯乐一下</button>
            </div>
            <div class="ddd">
            	<div class="aaa">热门搜索：</div>
                <div class="ds"><a href="javascript:;">国家电网</a><a href="javascript:;">三星电子</a><a href="javascript:;">产品制造</a><a href="javascript:;">IT</a><a href="javascript:;">软件工程师</a></div>
            </div>
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