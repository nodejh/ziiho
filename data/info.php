<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

/*
 * 版本信息
 */
return array (
	'name' => 'cjThis',
	/* 版本号 */
	'version' => '1.0',
	/* 版本发布日期 */
	'release' => '20131108',
	/* 版本简介 */
	'description' => '是一个多样化功能的网站管理系统',
	/* 版权 */
	'copyright' => 'Copyright ©2010 - 2015',
	/* powered by */
	'powered' => 'Powered by cjThis',
	/* powered by html */
	'powered_html' => 'Powered by <span class="pn"><a href="http://www.cjThis.com" target="_blank">cjThis</a></span>',
	/* 官方网站 */
	'author_url' => 'http://www.cjthis.com',
	/* 产品下载 */
	'download' => 'http://www.cjthis.com',
	/* 产品购买 */
	'buy' => 'http://www.cjthis.com',
	/* 授权信息 */
	'authorize' => 'http://www.cjthis.com',
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
						'value' => '<a href="http://www.cjthis.com" target="_blank">www.cjThis.com</a>' 
				),
				'bbs' => array (
						'name' => '官方论坛',
						'value' => '<a href="http://bbs.cjthis.com" target="_blank">bbs.cjThis.com</a>' 
				) 
		),
	/* 产品相关网站 */
	'product_relate' => array (
				array (
						'name' => '公司网站',
						'value' => 'http://www.cjthis.com' 
				),
				array (
						'name' => '文档',
						'value' => 'http://www.cjthis.com' 
				) 
		) 
);
?>