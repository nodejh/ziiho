<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
<?php include _g('template')->name('job', 'nav2', true); ?>
<style type="text/css"> body { background:#000; } </style>


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

<!-- //zhichangdaren -->
<div class="zhichangdaren clearfix" id="zhichangdaren">
	<!-- //datas -->
    <div class="datas clearfix">
        <div class="shadow"></div>
        <!-- //box-area -->
        <div class="box-area clearfix">
        	<?php for($j = 0; $j < 5; $j++): ?>
            <div class="boxs clearfix">
                <?php for($i = 0; $i < 10; $i++): ?>
                <div class="ibox clearfix">
                    <div class="img"><img src="<?php prt(_g('template')->dir('job')); ?>/image/f/a/<?php prt(rand(1, 10));?>.jpg" width="100%" height="100%" /></div>
                    <div class="tt"><a href="javascript:;">小明 - 面试经历</a></div>
                </div>
                <?php endfor; ?>
            </div>
            <?php endfor; ?>
        </div>
        <!-- box-area// -->
	</div>
    <!-- datas// -->
    <!-- //box-hd -->
    <div class="box-hd clearfix">
    <?php for($i = 0; $i < 5; $i++): ?><a href="javascript:;" class="icon-def"></a><?php endfor; ?>
    </div>
    <!-- box-hd// -->
</div>
<!-- zhichangdaren// -->

<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#zhichangdaren");
		_mObj.height(_ss.h - 66);
		
	$("#zhichangdaren").cjslip({
		autoPlay: false,
		loop: true,
		effect: 'left',
		mainEl: '.datas .box-area',
		delayTime: 5000,
		triggerTime: 150,
		mainState: '.box-hd a',
		onClass: 'icon-on'
	});
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>