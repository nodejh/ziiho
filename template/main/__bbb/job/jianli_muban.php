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
	<!-- //sels -->
	<div class="sels clearfix"><a href="#" class="on">最新</a><a href="#" class="def">人气</a><a href="#" class="def">相关</a></div>
    <!-- sels// -->
    
    <!-- //lists -->
	<div class="lists clearfix">
    	<ul>
        	<?php for($i = 0; $i < 10; $i++): ?>
        	<li class="clearfix">
            	<div class="aaa clearfix"><img src="<?php prt(_g('template')->dir('job')); ?>/image/f/g/1.jpg" width="100%" height="100%" /></div>
                <div class="bbb clearfix">
                	<div class="ttt"><a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail')); ?>">农艺师（销售推广）英文简历模板（应届生初级岗位）</a></div>
                    <div class="des">
                    	<p>模板特点：</p>
                        <p> 适合应届生（农科、市场营销相关专业），应聘农艺师（销售推广方向）初级岗位的英文简历模板</p>
                    </div>
                    <div class="ooo">
                    	<em>分类：其他</em><em>使用量：12</em>
                    </div>
                </div>
            </li>
            <?php endfor; ?>
        </ul>
    </div>
    <!-- lists// -->
    
    <!-- //page -->
    <div class="com-page2 com-page2-mt20 com-page2-pb15 clearfix">
        <em class="dis">&laquo;上一页</em><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><em>...</em><em class="on">10</em><a href="#">下一页&raquo;</a>
    </div>
    <!-- page// -->
    
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