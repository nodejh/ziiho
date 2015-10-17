<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //header -->
<div class="nav clearfix" id="nav">
	<div class="shadow shadow-bg2 clearfix"></div>
	<div class="shadow-border clearfix"></div>

	<div class="area clearfix">
		<div class="bd clearfix">
			<ul class="box clearfix">
				<li class="z ss aa clearfix">
					<p class="z sy tbg3">
						<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="fs">首页</a>
					</p>
				</li>
				<li class="z ss bb bb2 clearfix">
					<p class="z <?php prt(_get('ac')=='jianligonglue'?'tbg3-def':'tbg3'); ?>">
						<a href="<?php prt(_g('uri')->su('job/ac/jianligonglue')); ?>" class="fs">简历攻略</a>
					</p>
					<p class="z <?php prt(_get('ac')=='mianshizhinan'?'tbg3-def':'tbg3'); ?>">
						<a href="<?php prt(_g('uri')->su('job/ac/mianshizhinan')); ?>"
							class="fs">面试指南</a>
					</p>
                    <p class="z <?php prt(_get('ac')=='zhichangdaren'?'tbg3-def':'tbg3'); ?>">
						<a href="<?php prt(_g('uri')->su('job/ac/zhichangdaren')); ?>"
							class="fs">职场达人</a>
					</p>
                    <p class="z <?php prt(_get('ac')=='news'?'tbg3-def':'tbg3'); ?>">
						<a href="<?php prt(_g('uri')->su('job/ac/news')); ?>"
							class="fs">职业资讯</a>
					</p>
				</li>
				<li class="y ss cc clearfix">
					<p class="y zc tbg3">
						<a href="<?php prt(_g('uri')->su('job/ac/register')); ?>"
							class="icon">注册</a>
					</p>
					<p class="y dl tbg3">
						<a href="<?php prt(_g('uri')->su('job/ac/login')); ?>"
							class="icon">登录</a>
					</p>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="clear"></div>
<!-- header// -->