<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!--bbb/common/home_nav2.php-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php prt(_g('cfg>charset')); ?>" />
    <title>网站首页 - <?php prt(_g('value')->geshai('powered')); ?></title>
    <meta name="generator" content="cloud,jolly" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/ooo.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/over.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(sdir('static')); ?>/dialog/default/default.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <!--<link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/geshai.common.min.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.cjslip-v1.0.3.min.js"></script>

    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.cjslip-v1.0.3.min.js"></script>

    <script type="text/javascript">
        _GESHAI.setting("path", "<?php prt(sdir()); ?>");
        _GESHAI.setting("fsubmitKey_get", "<?php prt(_g('cfg>fmkey>get')); ?>");
        _GESHAI.setting("fsubmitKey_post", "<?php prt(_g('cfg>fmkey>post')); ?>");
        _GESHAI.setting("fsubmitKey_ajax", "<?php prt(_g('cfg>fmkey>ajax')); ?>");
        _GESHAI.setting("fsubmitKey_onlybody", "<?php prt(_g('cfg>fmkey>onlybody')); ?>");

    </script>

</head>

<body id="body">
<!-- //com-header -->
<div class="clearfix com-header-wrap o-nav2 o-nav2-login">
    <div class="clearfix com-w com-header clearfix" id="com-header">
        <div class="hd1 clearfix o-logo">
            <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>"><img src="<?php prt(_g('template')->dir('@')); ?>/image/logo.png" class="o-nav-img" /></a>
        </div>

        <?php $UM = _g('module')->trigger('user', 'model');?>
        <?php if(my_is_array($UM->suser())){ ?>
            <div class="hd3 clearfix o-menu">
                <div class="y uinfo_101" id="dropdown">
                    <a href="<?php prt(_g('uri')->su('user')); ?>" id="dropdown-title" class="un"><?php prt(substr($UM->suser('username'), 0, 12)); ?> <i class="fa fa-sort-desc"></i></a>
                    <div class="ui_box" id="dropdow-menu">
                        <a href="<?php prt(_g('uri')->su('user')); ?>"><i class="fa fa-user fa-fw"></i> 个人中心</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>"><i class="fa fa-sign-out  fa-fw"></i> 退出</a>
                    </div>
                </div>
            </div>
            <div class="clearfix o-menu">
                <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="ml o-menu-a">首页</a>
                <!--<a href="--><?php //prt(_g('uri')->su('job/ac/learn')); ?><!--" class="ml o-menu-a">学习中心</a>-->
                <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="mr o-menu-a">职业测评</a>
                <a href="<?php prt(_g('uri')->su('job/ac/work')); ?>" class="mr o-menu-a">推荐求职</a>
            </div>
        <?php }else{ ?>
            <div class="clearfix o-menu">
                <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="ml o-menu-a">首页</a>
                <!--<a href="--><?php //prt(_g('uri')->su('job/ac/learn')); ?><!--" class="ml o-menu-a">学习中心</a>-->
                <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="mr o-menu-a">职业测评</a>
                <a href="<?php prt(_g('uri')->su('job/ac/work')); ?>" class="mr o-menu-a">推荐求职</a>
                <a href="<?php prt(_g('uri')->su('user/ac/login')); ?>" class="ml o-menu-a"><i class="fa fa-user fa-fw"></i>登陆</a>
                <a href="<?php prt(_g('uri')->su('user/ac/register')); ?>" class="ml o-menu-a"><i class="fa fa-user-plus fa-fw"></i>注册</a>
            </div>
        <?php } ?>


    </div>
</div>
<!-- com-header// -->
<script language="javascript">
    $("#com-header").cjslip({
        type: 'menu',
        effect: "slideDown",
        speed: 80,
        defaultShow: false,
        mainState: ".uinfo_101",
        mainEl: ".ui_box"
    });

    $('#dropdown-title').mouseover(function() {
        $('#dropdown-title').css('color', '#000');
    });

    $('#dropdown-title').mouseout(function() {
        $('#dropdown-title').css('color', '#fff');
    });

    $('#dropdow-title').blur(function() {
        $('#dropdown-title').css('color', '#fff');
    });

    $('#dropdow-menu a').hover(function() {
        $('#dropdown-title').css('color', '#000');
    });

    $('#dropdow-menu a').mouseout(function() {
        $('#dropdown-title').css('color', '#fff');
    });


</script>
