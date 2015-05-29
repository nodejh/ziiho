<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('common')); ?>/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/jianli.css" />
<?php include _g('template')->name('job', 'nav-muban-where', true); ?>
<?php include _g('template')->name('job', 'nav-muban-middle', true); ?>

<!-- //muban-area -->
<div class="muban-area clearfix">

    <!-- //sels -->
    <div class="sels clearfix">
        <a href="#" class="on"><i class="fa fa-clock-o"></i>最新</a>
        <a href="#" class="def"><i class="fa fa-fire"></i>人气</a>
        <a href="#" class="def"><i class="fa fa-link"></i>相关</a>
    </div>
    <!-- sels// -->

    <!-- //lists -->
	<div class="lists clearfix">
    	<ul>
            <?php
            if(!empty($muban)) {
                foreach ($muban as $k => $v) {
                        ?>
                    <li class="clearfix">
                        <div class="aaa clearfix"><img src="<?php prt(_g('template')->dir('job'));echo $v['3'];?>" width="100%" height="100%" /></div>
                        <div class="bbb clearfix">
                            <div class="ttt"><a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_detail/mbid/' . $v['mbid'])); ?>"><?php echo $v['1']; ?></a></div>
                            <div class="des">
                                <p>模板特点：</p>
                                <p> <?php echo $v['4']; ?></p>
                            </div>
                            <div class="ooo">
                                <em>分类：<?php echo $v['8']; ?></em><em>使用量：<?php echo $v['9']; ?></em>
                            </div>
                        </div>
                    </li>
                        <?php
                }
            } else {
                ?>
                <li class="clearfix">
                    尚无模板信息！
                </li>
            <?php
            }
            ?>

        </ul>
    </div>
    <!-- lists// -->
    
    <!-- //page -->
<!--    <div class="com-page2 com-page2-mt20 com-page2-pb15 clearfix">-->
<!--        <em class="dis">&laquo;上一页</em><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a href="#">6</a><a href="#">7</a><a href="#">8</a><a href="#">9</a><em>...</em><em class="on">10</em><a href="#">下一页&raquo;</a>-->
<!--    </div>-->
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