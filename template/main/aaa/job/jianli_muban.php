<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('common')); ?>/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/jianli.css" />
<?php include _g('template')->name('job', 'nav-muban-where', true); ?>


<!-- //muban-area -->
<div class="muban-area clearfix">
	<!-- //sels -->
	<div class="sels clearfix"><a href="#" class="on"><?php echo var_dump($intention);  ?>最新</a><a href="#" class="def">人气</a><a href="#" class="def">相关</a></div>
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