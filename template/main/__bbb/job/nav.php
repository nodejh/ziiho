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
                    <p class="y"><a href="<?php prt(_g('uri')->su('user')); ?>" style="font-size:14px;"><?php prt($UM->suser('username')); ?></a></p>
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