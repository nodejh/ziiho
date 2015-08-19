<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
<?php include _g('template')->name('job', 'nav2', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img src="<?php prt(_g('template')->dir('job')); ?>/image/f/learn-bg.jpg" width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //news-index -->
<div class="news-index clearfix" id="news-index">
	<div class="shadow"></div>
	
    <!-- //mm -->
    <div class="mm clearfix">
    	<!-- //aaa -->
    	<div class="aaa clearfix">
            <div class="a1 clearfix">
                <div class="bd clearfix">
                	<!-- //iii -->
                    <div class="iii clearfix">
                    	<div class="img"><img src="<?php prt(_g('template')->dir('job')); ?>/image/f/e/1.jpg" width="100%" height="100%" /></div>
                        <div class="tttt clearfix">
                        	<p class="nnn"><a href="#">1.面试互联网产品经理前需要分析的3个问题</a></p>
                        </div>
                    </div>
                    <!-- iii// -->
                    
                    <!-- //iii -->
                    <div class="iii clearfix">
                    	<div class="img"><img src="<?php prt(_g('template')->dir('job')); ?>/image/f/e/2.jpg" width="100%" height="100%" /></div>
                        <div class="tttt clearfix">
                        	<p class="nnn"><a href="#">2.面试互联网产品经理前需要分析的3个问题</a></p>
                        </div>
                    </div>
                    <!-- iii// -->
                </div>
                <div class="hd"><a href="#">●</a><a href="#">●</a></div>
            </div>
            <div class="a2 clearfix">
                <div class="ibs">
                    <div class="ss clearfix"></div>
                    <div class="cc clearfix">
                    	<p class="tit"><a href="#"><font class="t1">面试时如何机智地回答“优点和缺点”的问题？</font><font class="t2">( 2015-01-04 )</font></a></p>
                        <p class="des">不管申请的岗位是律师、会计、老师、行政，或者是公务员等等，我们都要用到个人简历。但是如果在发出简历前...</p>
                    </div>
                </div>
                <div class="ibs ibs-mt15">
                    <div class="ss clearfix"></div>
                    <div class="cc clearfix">
                    	<p class="tit"><a href="#"><font class="t1">九个会让你求职失败的原因九个会让你求职失败的原因</font><font class="t2">( 2015-01-04 )</font></a></p>
                        <p class="des">不管申请的岗位是律师、会计、老师、行政，或者是公务员等等，我们都要用到个人简历。但是如果在发出简历前...</p>
                    </div>
                </div>
                <div class="ibs ibs-mt15">
                    <div class="ss clearfix"></div>
                    <div class="cc clearfix">
                    	<p class="tit"><font><a href="#"><font class="t1">HR详谈求职简历筛选之道</font><font class="t2">( 2015-01-04 )</font></a></p>
                        <p class="des">不管申请的岗位是律师、会计、老师、行政，或者是公务员等等，我们都要用到个人简历。但是如果在发出简历前...</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- aaa// -->
        
        <!-- //bbb -->
    	<div class="bbb clearfix">
        	<ul>
            	<li><a href="#">· 青岛海洽会开幕 7名海外人才获750万元创业资助</a></li>
                <li><a href="#">· 2010年青岛市教育局直属单位公开招聘面试公告</a></li>
                <li><a href="#">· 关于公布2010年青岛市部分事业单位公开招聘面试方案</a></li>
                <li><a href="#">· 青岛人事局：关于印发《青岛市人力资源和社会保障局高校</a></li>
                <li><a href="#">· 青岛第二实验初级中学公开招聘教师简章公示</a></li>
            </ul>
        </div>
        <!-- bbb// -->
        
        <div class="com-page com-page-mt10 clearfix">
        	<em class="dis">&laquo;上一页</em><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><em>...</em><em class="on">10</em><a href="#">下一页&raquo;</a>
        </div>
        
    </div>
    <!-- mm// -->
</div>
<!-- news-index// -->

<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#news-index");
		_mObj.height(_ss.h - 94);
		_mObj.find(".mm").height(_ss.h - 126);
		
	$("#news-index").cjslip({
		autoPlay: true,
		loop: true,
		effect: 'left',
		mainEl: '.mm .aaa .a1 .bd',
		delayTime: 3000,
		triggerTime: 150,
		mainState: '.mm .aaa .a1 .hd a',
		onClass: 'on'
	});
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>