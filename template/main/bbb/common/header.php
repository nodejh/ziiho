<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!--bbb/common/header.php-->
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php prt(_g('cfg>charset')); ?>" />
        <title>网站首页 - <?php prt(_g('value')->geshai('powered')); ?></title>
        <meta name="generator" content="cloud,jolly" />
        <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/ooo.css" />
        <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/over.css" />
        <link rel="stylesheet" type="text/css" href="<?php prt(sdir('static')); ?>/dialog/default/default.css" />
        <link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/geshai.common.min.js"></script>
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
<?php if(_g('validate')->hasget('ac') && !in_array(_get('ac'), array('index', 'home', 'login', 'register', 'forget'))){ ?>
    <!-- //com-header -->
    <div class="clearfix com-header-wrap o-nav">
        <div class="clearfix com-w com-header clearfix" id="com-header">
            <div class="hd1 clearfix">
                <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>"><img src="<?php prt(_g('template')->dir('@')); ?>/image/logo.png" height="62" /></a>
            </div>
            <div class="hd3 clearfix o-menu">
                <?php $UM = _g('module')->trigger('user', 'model');?>
                <?php if(my_is_array($UM->suser())){ ?>
                    <div class="y uinfo_101">
                        <a href="<?php prt(_g('uri')->su('user')); ?>" class="un"><em><?php prt(substr($UM->suser('username'), 0, 12)); ?></em></a>
                        <div class="ui_box">
                            <a href="<?php prt(_g('uri')->su('user')); ?>">个人中心</a>
                            <a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>">退出</a>
                        </div>
                    </div>
                <?php }else{ ?>
                    <a href="<?php prt(_g('uri')->su('user/ac/login')); ?>" class="co dl">登陆</a>
                    <a href="<?php prt(_g('uri')->su('user/ac/register')); ?>" class="co zc">注册</a>
                <?php } ?>
            </div>
            <div class="clearfix o-menu">
                <a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" class="ml o-menu-a">学习中心</a>
                <a href="<?php prt(_g('uri')->su('job/ac/company')); ?>" class="mr o-menu-a">求职中心</a>
            </div>
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
        })
    </script>
<?php } ?>