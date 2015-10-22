<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //header -->
<div class="user-center-header clearfix" id="user-center-header">
	<div class="m clearfix">
    	<!-- //uch-z -->
        <div class="z uch-z clearfix">
            <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>">首页</a>
            <a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>">认证中心</a>
            <a href="<?php prt(_g('uri')->su('job/ac/work')); ?>">求职中心</a>
        </div>
        <!-- uch-z// -->
        
        <!-- //uch-y -->
        <div class="y uch-y clearfix">
            <?php $UM = _g('module')->trigger('user', 'model');?>
            <?php if(my_is_array($UM->suser())){ ?>
            <div class="uc_box_101">
            	<a class="mr" href="<?php prt(_g('uri')->su('user')); ?>" style="font-size:14px;"><?php prt($UM->suser('username')); ?></a>
                <div class="uc_menu">
                	<a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>">退出</a>
                </div>
            </div>
            <?php }else{ ?>
            	<a class="mr" href="<?php prt(_g('uri')->su('user/ac/login')); ?>" class="icon">登录</a>
                <a class="mr" href="<?php prt(_g('uri')->su('user/ac/register')); ?>" class="icon">注册</a>
            <?php } ?>
        </div>
        <!-- uch-y// -->
    </div>
</div>
<div class="clear"></div>
<!-- header// -->

<script language="javascript">
$("#user-center-header").cjslip({
	type: 'menu',
	effect: "slideDown",
	speed: 80,
	defaultShow: false,
	mainState: ".uc_box_101",
	mainEl: ".uc_menu"
})
</script>