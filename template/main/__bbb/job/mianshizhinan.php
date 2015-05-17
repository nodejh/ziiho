<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
<?php include _g('template')->name('job', 'nav2', true); ?>

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

<!-- //mianshizhinan -->
<div class="mianshizhinan clearfix" id="mianshizhinan">
	<!-- //aaa -->
    <div class="z aaa clearfix">
        <div class="c-shadow"></div>
        <div class="box clearfix">
        	<ul>
            	<li><a href="javascript:;" class="on">英语面试</a></li>
                <li><a href="javascript:;">软件工程师面试</a></li>
                <li><a href="javascript:;">销售面试</a></li>
            </ul>
        </div>
	</div>
    <!-- aaa// -->
    
    <!-- //bbb -->
    <div class="y bbb clearfix">
        <div class="c-shadow"></div>
        <div class="items clearfix">
        	<ul class="bx clearfix">
            	<?php for($j = 0; $j < 5; $j++): ?>
            	<li><a href="#">软件工程师面试指南</a></li>
                <li><a href="javascript:;">销售面试指南</a></li>
                <li><a href="javascript:;">英语面试指南</a></li>
                <?php endfor; ?>
            </ul>
        </div>
        <div class="com-page com-page-pr15 clearfix">
        	<em class="dis">&laquo;上一页</em><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><em>...</em><em class="on">10</em><a href="#">下一页&raquo;</a>
        </div>
	</div>
    <!-- bbb// -->
</div>
<!-- mianshizhinan// -->

<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _ww = _ss.h - 94;
	var _mObj = $("#mianshizhinan");
		_mObj.height(_ww);
		_mObj.find(".aaa,.bbb").height(_ww);
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>