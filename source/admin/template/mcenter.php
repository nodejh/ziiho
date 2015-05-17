<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<style type="text/css">
.index-box { width: 100%; padding-top: 5px; padding-bottom: 5px; }
.index-ul ul li { width: 100%; padding-top: 5px; padding-bottom: 5px; border-bottom: 1px solid #EEE; }
.index-z { float: left; width: 52%; }
.index-y { float: right; width: 46%; }
</style>

<div class="index-box">

	<!--左边开始-->
	<div class="index-z">

		<!--个人信息开始-->
		<div class="index-ul">
			<ul>
				<li class="c_bg2"><p class="c_ml5px fw">我的个人信息</p></li>
				<li>
					<p class="c_ml5px c_mt5px">
						您好,&nbsp;<strong>{field:member.username/}</strong>&nbsp;欢迎您回来!
					</p>
					<p class="c_ml5px c_mt5px">管理级别:&nbsp;超级管理员</p>
					<p class="c_ml5px c_mt10px">上次登录时间:&nbsp;{datestyle
						$member['before_time'],'Y-m-d H:i:s'/}</p>
					<p class="c_ml5px c_mt5px">上次登录IP:&nbsp;{field:member.before_ip/}</p>
					<div class="clr"></div>
				</li>
				<div class="clr"></div>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<!--个人信息结束-->

		<!--系统信息开始-->
		<div class="index-ul c_mt10px">
			<ul>
				<li class="c_bg2"><p class="c_ml5px fw">系统信息</p></li>
				<li>
					<p class="c_ml5px c_mt5px">
						{field:_G.cj.name/}程序版本:&nbsp;{field:_G.cj.name/}&nbsp;v{field:_G.cj.version/}&nbsp;release
						&nbsp;{field:_G.cj.release/}&nbsp;&nbsp;[<a
							href="{field:_G.cj.download/}" target="_blank">查看最新版本</a>]
					</p>
					<p class="c_ml5px c_mt5px c_h0px">&nbsp;</p> {loop get_serverinfo()
					$SInfo}
					<p class="c_ml5px c_mt5px">{field:SInfo.name/}:&nbsp;{field:SInfo.value/}</p>
					{/loop}
					<div class="clr"></div>
				</li>
				<div class="clr"></div>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<!--系统信息结束-->

		<!--开发团队信息开始-->
		<div class="index-ul c_mt10px">
			<ul>
				<li class="c_bg2"><p class="c_ml5px fw">{field:_G.cj.name/}开发团队</p></li>
				<li>{loop array_key_val('product_info',array_key_val('cj',$_G))
					$PInfo}
					<p class="c_ml5px c_mt5px">{field:PInfo.name/}:&nbsp;{field:PInfo.value/}</p>
					{/loop}
					<div class="clr"></div>
				</li>
				<div class="clr"></div>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<!--开发团队信息结束-->

		<!--相关链接开始-->
		<div class="index-ul c_mt10px">
			<ul>
				<li class="c_bg2"><p class="c_ml5px fw">相关链接</p></li>
				<li>{eval $index=0;/} {loop
					array_key_val('product_relate',array_key_val('cj',$_G)) $PR} {eval
					$index++;/} <span
					class="c_l c_mt5px c_mr10px {if $index<2}c_ml5px{/if}"><a
						href="{field:PR.value/}" target="_blank">{field:PR.name/}</a></span>
					{/loop}
					<div class="clr"></div>
				</li>
				<div class="clr"></div>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<!--相关链接结束-->

	</div>
	<!--左边结束-->

	<!--右边开始-->
	<div class="index-y">

		<!--授权信息开始-->
		<div class="index-ul">
			<ul>
				<li class="c_bg2"><p class="c_ml5px fw">授权信息</p></li>
				<li>
					<p class="c_ml5px c_mt5px">
						{field:_G.cj.name/}程序版本:&nbsp;{field:_G.cj.name/}&nbsp;v{field:_G.cj.version/}&nbsp;release
						&nbsp;{field:_G.cj.release/}&nbsp;&nbsp;[<a
							href="{field:_G.cj.buy/}" target="_blank">技术支持与服务</a>]
					</p>
					<p class="c_ml5px c_mt5px c_h0px">&nbsp;</p>
					<p class="c_mt5px c_ml5px">
						授权类型:&nbsp;<span id="authorize-type"></span>
					</p>
					<p class="c_mt5px c_ml5px">
						授权码:&nbsp;<span id="authorize-code"></span>
					</p>
					<div class="clr"></div>
				</li>
				<div class="clr"></div>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<!--授权信息结束-->

		<!--官方动态开始-->
		<div class="index-ul c_mt10px">
			<ul>
				<li class="c_bg2"><p class="c_ml5px fw">官方最新动态</p></li>
				<li class="ared" id="product-active-info"></li>
				<div class="clr"></div>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		<!--官方动态结束-->

	</div>
	<!--右边结束-->

	<div class="clr"></div>
</div>