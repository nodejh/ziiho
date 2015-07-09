<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

/*
 * 版本信息
 */
return array (
	'name' => 'GeShai',
	/* 版本号 */
	'version' => '1.0',
	/* 版本发布日期 */
	'release' => '20131108',
	/* 版本简介 */
	'description' => '是一个多样化功能的网站管理系统',
	/* 版权 */
	'copyright' => 'Copyright ©2010 - 2015',
	/* powered by */
	'powered' => 'Powered by GeShai',
	/* powered by html */
	'powered_html' => 'Powered by <span class="pn"><a href="http://www.geshai.com" target="_blank">GeShai</a></span>',
	/* 官方网站 */
	'author_url' => 'http://www.geshai.com',
	/* 产品下载 */
	'download' => 'http://www.geshai.com',
	/* 产品购买 */
	'buy' => 'http://www.geshai.com',
	/* 授权信息 */
	'authorize' => 'http://www.geshai.com',
	/* 获取官方动态 */
	'product_active' => 'http://localhost/index.php?mod=article&ac=content&op=activeinfo',
	/* 产品详细介绍 */
	'product_info' => array (
				'plan' => array (
						'name' => '策划项目经理',
						'value' => 'Jolly、Cloud' 
				),
				'programmer' => array (
						'name' => '产品设计与研发团队',
						'value' => 'Jolly、Cloud' 
				),
				'ui' => array (
						'name' => 'UI&nbsp;设计',
						'value' => 'Jolly、Cloud' 
				),
				'site' => array (
						'name' => '官方网站',
						'value' => '<a href="http://www.geshai.com" target="_blank">www.GeShai.com</a>' 
				),
				'bbs' => array (
						'name' => '官方论坛',
						'value' => '<a href="http://bbs.geshai.com" target="_blank">bbs.GeShai.com</a>' 
				) 
		),
	/* 产品相关网站 */
	'product_relate' => array (
				array (
						'name' => '公司网站',
						'value' => 'http://www.geshai.com' 
				),
				array (
						'name' => '文档',
						'value' => 'http://www.geshai.com' 
				) 
		) 
);
?>