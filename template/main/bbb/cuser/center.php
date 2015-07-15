<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/user.js" />


    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('cuser', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->


        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">
            <h1 class="o-title">企业中心</h1>
            <div class="o-content">
                您好，欢迎进入企业用户中心！
            </div>

        </div>
        <!-- cuser_y// -->

    </div>


    <div class="clear"></div>
    <!-- cuser_center// -->

<?php include _g('template')->name('user', 'footer', true); ?>


<?php include _g('template')->name('@', 'footer', true); ?>