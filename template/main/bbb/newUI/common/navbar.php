<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!--bbb/newUI/common/navbar.php-->

<!-- //com-header -->
<div class="clearfix com-header-wrap o-nav o-nav2-center">
    <div class="clearfix com-w com-header clearfix" id="com-header">
        <div class="hd1 clearfix o-logo">
            <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>"><img src="<?php prt(_g('template')->dir('@')); ?>/image/logo.png" class="o-nav-img" /></a>
        </div>

<!--        <div class="style_1">-->
<!--        <form method="get" id="searchform" action="/">-->
<!--            <fieldset>-->
<!--                <input id="s" name="s" type="text" value="输入搜索内容" class="text_input" onblur="if(this.value==''){this.value='输入搜索内容';}" onfocus="if(this.value =='输入搜索内容') {this.value=''; }" />-->
<!--                <input name="submit" type="submit" value="" /> </fieldset>-->
<!--        </form>-->
<!--    </div>-->

        <div class="hd3 clearfix o-menu">
            <?php $UM = _g('module')->trigger('user', 'model');?>
            <?php if(my_is_array($UM->suser())){ ?>
                <div class="y uinfo_101" id="dropdown">
                    <a href="<?php prt(_g('uri')->su('user')); ?>" id="dropdown-title" class="un"><?php prt(substr($UM->suser('username'), 0, 12)); ?> <i class="fa fa-sort-desc"></i></a>
                    <div class="ui_box" id="dropdow-menu">
                        <a href="<?php prt(_g('uri')->su('user')); ?>"><i class="fa fa-user fa-fw"></i> 个人中心</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>"><i class="fa fa-sign-out  fa-fw"></i> 退出</a>
                    </div>
                </div>
            <?php }else{ ?>
                <a href="<?php prt(_g('uri')->su('user/ac/login')); ?>" class="ml o-menu-a"><i class="fa fa-user fa-fw"></i>登陆</a>
                <a href="<?php prt(_g('uri')->su('user/ac/register')); ?>" class="ml o-menu-a"><i class="fa fa-user-plus fa-fw"></i>注册</a>
            <?php } ?>
        </div>
        <div class="clearfix o-menu">
            <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="ml o-menu-a">首页</a>
            <!--<a href="--><?php //prt(_g('uri')->su('job/ac/learn')); ?><!--" class="ml o-menu-a">学习中心</a>-->
            <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="mr o-menu-a">测评中心</a>
            <a href="<?php prt(_g('uri')->su('job/ac/company')); ?>" class="mr o-menu-a">求职中心</a>
        </div>
    </div>
</div>
<!-- com-header// -->


