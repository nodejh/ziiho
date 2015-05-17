<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
<?php include _g('template')->name('job', 'nav3', true); ?>

<!-- //muban-where -->
<div class="muban-where clearfix" id="muban-where">
	<div class="box-area clearfix">
    	<!-- //swd -->
    	<div class="swd clearfix">
        	<div class="sbb"></div>
            <div class="stt clearfix">
        		<div class="icon clearfix"></div>
            	<input type="text" name="wd" class="ww" />
            	<button type="button" class="bb">找模板</button>
            </div>
        </div>
        <!-- swd// -->
        
        <!-- //sdd -->
        <div class="sdd clearfix">
        	<div class="aaa clearfix">求职意向</div>
            <div class="bbb clearfix"><a href="#" class="on">不限</a><a href="#">保险</a><a href="#">材料</a><a href="#">电气</a></div>
        </div>
        <!-- sdd// -->
        
        <!-- //sdd -->
        <div class="sdd clearfix">
        	<div class="aaa clearfix">模板风格</div>
            <div class="bbb clearfix"><a href="#" class="on">不限</a><a href="#">黑白</a><a href="#">彩色</a></div>
        </div>
        <!-- sdd// -->
        
        <!-- //sdd -->
        <div class="sdd clearfix">
        	<div class="aaa clearfix">简历语言</div>
            <div class="bbb clearfix"><a href="#" class="on">不限</a><a href="#">中文</a><a href="#">英文</a></div>
        </div>
        <!-- sdd// -->
        
    </div>
</div>
<!-- muban-where// -->


<!-- //muban-area -->
<div class="muban-area clearfix">
	<!-- //pos -->
	<div class="pos clearfix"><a href="#" class="home-icon">首页</a><em>></em><a href="#">简历中心</a><em>></em><a href="#">农艺师（销售推广）英文简历模板（应届生初级岗位）</a></div>
    <!-- pos// -->
    
    <!-- //cc-box -->
    <div class="cc-box clearfix">
        <!-- //view -->
        <div class="view clearfix">
            <img src="<?php prt(_g('template')->dir('job')); ?>/image/f/g/2.png" />
        </div>
        <!-- view// -->
        
        <!-- //vd -->
        <div class="vd clearfix">
            <div class="bb1"><button type="button">使用此模板</button></div>
            
            <div class="ctxt clearfix"><em>100</em>人使用</div>
            
            <div class="fx clearfix">
            	<div class="fx-nn">分享到：</div>
                <div class="fx-icon">
                	<a href="#" class="fx-c fx-weixin"></a>
                    <a href="#" class="fx-c fx-weibo"></a>
                    <a href="#" class="fx-c fx-renren"></a>
                    <a href="#" class="fx-c fx-douban"></a>
                </div>
            </div>
        </div>
        <!-- vd// -->
        
    </div>
    <!-- cc-box// -->
    
</div>
<div class="clear"></div>
<!-- muban-area// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script language="javascript">
$(document).ready(function(e) {
	var _ms = {"w": 1920, "h": 900};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
});
</script>

<?php include _g('template')->name('@', 'footer', true); ?>