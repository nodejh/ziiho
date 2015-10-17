<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php if(!empty($sess_type)){ ?>
	<div class="clearfix loed" id="login1">
	<?php if($sess_type == 1){ ?>
        <ul class="mb">
            <li>
                <a href="<?php prt(_g('uri')->su('user')); ?>" class="mbs ucenter"><img src="<?php prt(_g('value')->avatar(null)); ?>" width="16" height="16" />个人中心</a>
                <div class="mbcs">
                    <span class="clearfix m-open"></span>
                    <div class="clear"></div>
                    
                    <div class="clearfix m-ibox box-shadow">
                        <a href="<?php prt(_g('uri')->su('user/ac/avatar')); ?>">修改头像</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/profile')); ?>">个人资料</a>
                        <a href="<?php prt(_g('uri')->su('resume/ac/manager')); ?>">我的简历</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/password')); ?>">修改密码</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>">退出</a>
                    </div>
                </div>
            </li>
        </ul>
    <?php } ?>
    
    <?php if($sess_type == 2){ ?>
        <ul class="mb">
            <li>
                <a href="<?php prt(_g('uri')->su('user')); ?>" class="mbs ucenter"><img src="<?php prt(_g('value')->avatar(null)); ?>" width="16" height="16" />个人中心</a>
                <div class="mbcs">
                    <span class="clearfix m-open"></span>
                    <div class="clear"></div>
                    
                    <div class="clearfix m-ibox box-shadow">
                        <a href="<?php prt(_g('uri')->su('user/ac/company')); ?>">公司信息</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/job')); ?>">职位管理</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/password')); ?>">修改密码</a>
                        <a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>">退出</a>
                    </div>
                </div>
            </li>
        </ul>
    <?php } ?>
    </div>

<script language="javascript">
$("#login1").cjslip({
	type: 'menu',
	effect: "slideDown",
	speed: 50,
	defaultShow: false,
	mainState: "ul.mb li",
	mainEl: "div.mbcs"
})
</script>

<?php }else{ ?>
    <div class="clearfix los" id="login0">
        <a href="<?php prt(_g('uri')->su('user/ac/register')); ?>" class="reg"><em>注册</em></a>
        <span class="sp ml5">|</span>
        <a href="<?php prt(_g('uri')->su('user/ac/login')); ?>" class="ml5 login"><em>登陆</em></a>
    </div>
<?php } ?>