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

<!-- //jianligonglue -->
<div class="jianligonglue clearfix" id="jianligonglue">
	<div class="shadow"></div>
	<!-- //ddd -->
    <div class="ddd clearfix">
    	<!-- //ns -->
    	<div class="ns clearfix">
        	<a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban')); ?>">简历模板</a>
            <em>|</em>
            <a href="javascript:;">简历范文</a>
            <em>|</em>
            <a href="javascript:;">简历封面</a>
            <em>|</em>
            <a href="javascript:;">简历制作</a>
            <em>|</em>
            <a href="javascript:;">自我评价</a>
            <em>|</em>
            <a href="javascript:;">自我鉴定</a>
        </div>
        <!-- ns// -->
        
        <!-- //blocks -->
    	<div class="z blocks clearfix">
        	<div class="hh clearfix">
            	<div class="lb"></div>简历模板
            </div>
            
            <div class="bb clearfix">
            	<ul class="ss">
                	<li><a href="javascript:;">马年个人简历模板</a><em>10-20</em></li>
                    <li><a href="javascript:;">舞蹈教师求职简历模板</a><em>10-20</em></li>
                    <li><a href="javascript:;">空白的个人简历表格</a><em>10-20</em></li>
                    <li><a href="javascript:;">酒店经理个人简历表格</a><em>10-20</em></li>
                    <li><a href="javascript:;">文科类专业个人简历模板</a><em>10-20</em></li>
                </ul>
            </div>
        </div>
        <!-- blocks// -->
        
        <!-- //blocks -->
    	<div class="y blocks clearfix">
        	<div class="hh clearfix">
            	<div class="lb"></div>简历评价
            </div>
            
            <div class="bb clearfix">
            	<ul class="ss">
                	<li><a href="javascript:;">马年个人简历模板</a><em>10-20</em></li>
                    <li><a href="javascript:;">舞蹈教师求职简历模板</a><em>10-20</em></li>
                    <li><a href="javascript:;">空白的个人简历表格</a><em>10-20</em></li>
                    <li><a href="javascript:;">酒店经理个人简历表格</a><em>10-20</em></li>
                    <li><a href="javascript:;">文科类专业个人简历模板</a><em>10-20</em></li>
                </ul>
            </div>
        </div>
        <!-- blocks// -->
        
        <!-- //blocks -->
    	<div class="z blocks clearfix">
        	<div class="hh clearfix">
            	<div class="lb"></div>简历范文
            </div>
            
            <div class="bb clearfix">
            	<ul class="ss">
                	<li><a href="javascript:;">马年个人简历模板</a><em>10-20</em></li>
                    <li><a href="javascript:;">舞蹈教师求职简历模板</a><em>10-20</em></li>
                    <li><a href="javascript:;">空白的个人简历表格</a><em>10-20</em></li>
                    <li><a href="javascript:;">酒店经理个人简历表格</a><em>10-20</em></li>
                    <li><a href="javascript:;">文科类专业个人简历模板</a><em>10-20</em></li>
                </ul>
            </div>
        </div>
        <!-- blocks// -->
        
        <!-- //blocks -->
    	<div class="y blocks clearfix">
        	<div class="hh clearfix">
            	<div class="lb"></div>简历封面
            </div>
            
            <div class="bb clearfix">
            	<ul class="ii">
                	<?php for($i = 0; $i < 4; $i++): ?>
                	<li><p class="img"><a href="javascript:;"><img src="<?php prt(_g('template')->dir('job')); ?>/image/f/d/<?php prt($i + 1);?>.png" width="100%" height="100%" /></a></p><p class="tt"><a href="javascript:;">蓝色</a></p></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <!-- blocks// -->
        
	</div>
    <!-- ddd// -->
</div>
<!-- jianligonglue// -->

<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#jianligonglue");
		_mObj.height(_ss.h - 94);
		_mObj.find(".ddd").height(_ss.h - 126);
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>