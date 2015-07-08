<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<!-- //cuser_center -->
<div class="cuser_center clearfix o-main" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix o-left">
	<?php include _g('template')->name('user', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix o-right">
	<h1 class="o-title">个人中心</h1>
    <div class="o-content">
        <div class="o-panel o-panel-blue">
            <div class="o-panel-top o-color-white">
                <i class="fa fa-comments fa-5x"></i>
                <div class="o-panel-tips">
                    <span>5</span><br>认证书
                </div>
            </div>
            <a href="<?php prt(_g('uri')->su('user/ac/myauth')); ?>">
                <div class="o-panel-bottom">
                    <span class="o-panel-bottomn-tips o-color-blue">查看详情</span>
                    <span class="o-panel-bottomn-icon o-color-blue"><i class="fa fa-arrow-circle-right"></i></span>
                </div>
            </a>
        </div>
        <div class="o-panel o-panel-green">
            <div class="o-panel-top o-color-white">
                <i class="fa fa-file-text fa-5x"></i>
                <div class="o-panel-tips">
                    <span>2</span><br>简历
                </div>
            </div>
            <a href="#">
                <div class="o-panel-bottom">
                    <span class="o-panel-bottomn-tips o-color-green">查看详情</span>
                    <span class="o-panel-bottomn-icon o-color-green"><i class="fa fa-arrow-circle-right"></i></span>
                </div>
            </a>
        </div>
        <div class="o-panel o-panel-yellow">
            <div class="o-panel-top o-color-white">
                <i class="fa fa-newspaper-o fa-5x"></i>
                <div class="o-panel-tips">
                    <span>15</span><br>答卷
                </div>
            </div>
            <a href="<?php prt(_g('uri')->su('user/ac/answer')); ?>">
                <div class="o-panel-bottom">
                    <span class="o-panel-bottomn-tips o-color-yellow">查看详情</span>
                    <span class="o-panel-bottomn-icon o-color-yellow"><i class="fa fa-arrow-circle-right"></i></span>
                </div>
            </a>
        </div>
        <div class="o-panel o-panel-pink">
            <div class="o-panel-top o-color-white">
                <i class="fa fa-book fa-5x"></i>
                <div class="o-panel-tips">
                    <span>8</span><br>我的课程
                </div>
            </div>
            <a href="#">
                <div class="o-panel-bottom">
                    <span class="o-panel-bottomn-tips o-color-pink">查看详情</span>
                    <span class="o-panel-bottomn-icon o-color-pink"><i class="fa fa-arrow-circle-right"></i></span>
                </div>
            </a>
        </div>
    </div>


</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->

<?php include _g('template')->name('user', 'footer', true); ?>




<script language="javascript">

</script>

<?php include _g('template')->name('@', 'footer', true); ?>