<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<style type="text/css">
.center_z { float: left; width: 49%; }
.center_y { float: right; width: 49%; }
	.center_ibox { padding:5px; }
		.center_ibox ul.ibb { border-bottom:2px solid #eee; }
			.center_ibox ul.ibb li { line-height:24px; padding:2px 5px; }
			.center_ibox ul.ibb li.tit { border-bottom:1px dashed #eee; }
</style>

<!-- //center_z -->
<div class="clearfix center_z">

    <!-- //个人信息 -->
    <div class="clearfix center_ibox">
        <ul class="clearfix ibb">
            <li class="tit fw">我的个人信息</li>
            <li>Jolly&nbsp;您好，欢迎回来!</li>
            <li>管理级别:&nbsp;超级管理员</li>
            <li>上次登录时间:&nbsp;2015-2-12 14:20:44</li>
            <li>上次登录IP:&nbsp;192.168.0.90</li>
        </ul>
    </div>
    <div class="clear"></div>
    <!-- 个人信息// -->
    
    <!-- //在线会员 -->
    <div class="clearfix center_ibox">
        <ul class="clearfix ibb">
            <li class="tit fw">在线会员<em class="tc-d padding101">230</em>人</li>
            <li><em class="padding101">Jolly</em>，<em class="padding101">coco</em>，<em class="padding101">匆匆那年</em>...</li>
        </ul>
    </div>
    <div class="clear"></div>
    <!-- 在线会员// -->
    
    <!-- //新注册会员 -->
    <div class="clearfix center_ibox">
        <ul class="clearfix ibb">
            <li class="tit fw">最近登录会员</li>
            <li><em class="padding101">abc</em>，<em class="padding101">环游世界</em>，<em class="padding101">明明</em>...</li>
        </ul>
    </div>
    <div class="clear"></div>
    <!-- 新注册会员// -->

    <!-- //系统信息 -->
    <div class="clearfix center_ibox">
        <ul class="clearfix ibb">
            <li class="tit fw">系统信息</li>
            <?php foreach(_g('value')->ra(_g('value')->serverinfo()) as $v){ ?>
            <li><?php prt($v['name']); ?>：<?php prt($v['value']); ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="clear"></div>
    <!-- 系统信息// -->

    <!-- //开发团队信息 -->
    <!--<div class="clearfix center_ibox">
        <ul class="clearfix ibb">
            <li class="tit fw"><?php prt(_g('value')->geshai('name'));?>开发团队</li>
            <?php foreach(_g('value')->ra(_g('value')->geshai('product_info')) as $v){ ?>
            <li class="ta_100"><?php prt($v['name']); ?>:&nbsp;<?php prt($v['value']); ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="clear"></div>-->
    <!-- 开发团队信息// -->

</div>
<!-- center_z// -->

<!-- //center_y -->
<div class="clearfix center_y">

    <!-- //统计信息 -->
    <div class="clearfix center_ibox">
        <ul class="clearfix ibb">
            <li class="tit fw">统计信息</li>
            <li class="ta_100">会员：<em class="tc-d padding101">350</em>个记录<li>
            <li class="ta_100">企业：<em class="tc-d padding101">50</em>个记录<li>
            <li>招聘：<em class="tc-d padding101">150</em>个记录</li>
            <li>学习资料：<em class="tc-d padding101">1500</em>个记录</li>
        </ul>
    </div>
    <div class="clear"></div>
    <!-- 统计信息// -->

</div>
<!-- center_y// -->