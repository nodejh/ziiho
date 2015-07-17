<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //header -->
<div class="nav clearfix" id="nav">
	<div class="shadow shadow-bg clearfix"></div>
	<div class="shadow-border clearfix"></div>

	<div class="area clearfix">
		<div class="bd clearfix">
			<ul class="box clearfix">
				<li class="z ss ss-w aa clearfix">
					<p class="z sy tbg2">
						<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="fs">首页</a>
					</p>
				</li>
				<li class="z ss ss-w bb clearfix">
					<p class="z xx tbg2">
						<a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" class="fs">学习中心</a>
					</p>
					<p class="y qz tbg2">
						<a href="<?php prt(_g('uri')->su('job/ac/company')); ?>"
							class="fs">求职中心</a>
					</p>
				</li>
				<li class="z ss ss-w cc clearfix">
                	<?php $UM = _g('module')->trigger('user', 'model');?>
                	<?php if(my_is_array($UM->suser())){ ?>
                    <div class="y uinfo_101">
                    	<a href="<?php prt(_g('uri')->su('user')); ?>" style="font-size:14px;"><?php prt($UM->suser('username')); ?></a>
                        <div class="ui_box">
                        	<a href="<?php prt(_g('uri')->su('user')); ?>">个人中心</a>
                            <a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>">退出</a>
                        </div>
					</div>
                    <?php }else{ ?>
					<p class="y zc tbg2">
						<a href="<?php prt(_g('uri')->su('user/ac/register')); ?>"
							class="icon">注册</a>
					</p>
					<p class="y dl tbg2">
						<a href="<?php prt(_g('uri')->su('user/ac/login')); ?>"
							class="icon">登录</a>
					</p>
                    <?php } ?>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="clear"></div>
<!-- header// -->

<script language="javascript">
$("#nav").cjslip({
	type: 'menu',
	effect: "slideDown",
	speed: 80,
	defaultShow: false,
	mainState: ".uinfo_101",
	mainEl: ".ui_box"
})
</script>