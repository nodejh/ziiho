<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('common')); ?>/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/jianli.css" />
<?php include _g('template')->name('job', 'nav-muban-where', true); ?>
<?php include _g('template')->name('job', 'nav-muban-middle', true); ?>

<!-- //muban-area -->
<div class="muban-area clearfix">
	<!-- //pos -->
<!--	<div class="pos clearfix"><a href="#" class="home-icon">首页</a><em>></em><a href="#">简历中心</a><em>></em><a href="#">农艺师（销售推广）英文简历模板（应届生初级岗位）</a></div>-->
    <!-- pos// -->

    <!-- //cc-box -->
    <div class="cc-box clearfix">
        <!-- //view -->
        <?php
        if (!empty($muban)) {
        ?>
            <div class="view clearfix">
                <img src="<?php prt(_g('template')->dir('job'));echo $muban['mbimg']; ?>" />
            </div>


        <!-- view// -->
        
        <!-- //vd -->
        <div class="vd clearfix">

                <?php
                $UM = _g('module')->trigger('user', 'model');
                if (my_is_array($UM->suser())) {
                    //buton login true
                    ?>
                    <div class="bb1">
                        <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_use/mbid/' . $muban['mbid'])); ?>"><button type="button">使用此模板</button></a>
                    </div>
                <?php
                } else {
                    //buton login false
                    ?>
            <div class="bb1">
                    <button type="button" id="not-login-button" url="<?php prt(_g('uri')->su('user/ac/login')) ?>">使用此模板</button></div>
                <?php
                }

                ?>



                <div class="ctxt clearfix"><em><?php echo $muban['mbcount'];?></em>人使用</div>
            
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
        <?php
        }else {
            ?>
            <div class="view clearfix">
                尚无模板信息！
            </div>
        <?php
        }
        ?>
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