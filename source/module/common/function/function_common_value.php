<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}
function common_value($_key = NULL, $is_arr = false) {
	$darr = array (
			'nav_type' => array (
					'main' => array (
							'field' => 'main',
							'title' => '主导航' 
					),
					'footer' => array (
							'field' => 'footer',
							'title' => '底部导航' 
					) 
			),
			'nav_xy' => array (
					'x' => array (
							'field' => 'x',
							'val' => 'x',
							'title' => '横向排列' 
					),
					'y' => array (
							'field' => 'y',
							'val' => 'y',
							'title' => '纵向排列' 
					) 
			),
			'gender' => array (
					0 => array (
							'val' => 1,
							'title' => '男' 
					),
					1 => array (
							'val' => 0,
							'title' => '女' 
					),
					2 => array (
							'val' => 2,
							'title' => '保密' 
					) 
			),
			'where_day' => array (
					1 => array (
							'val' => 3,
							'title' => '三天内' 
					),
					2 => array (
							'val' => 7,
							'title' => '一周内' 
					),
					3 => array (
							'val' => 30,
							'title' => '一个月内' 
					),
					4 => array (
							'val' => 365,
							'title' => '一年内' 
					) 
			),
			'orderby' => array (
					1 => array (
							'field' => 1,
							'val' => 'ASC',
							'title' => '<font color="#FF0000">&uarr;</font>按升序' 
					),
					2 => array (
							'field' => 2,
							'val' => 'DESC',
							'title' => '<font color="#FF0000">&darr;</font>按降序' 
					) 
			),
			'data_num' => array (
					1 => array (
							'val' => 10,
							'title' => '10条' 
					),
					2 => array (
							'val' => 20,
							'title' => '20条' 
					),
					3 => array (
							'val' => 30,
							'title' => '30条' 
					),
					4 => array (
							'val' => 50,
							'title' => '50条' 
					) 
			),
			'content_page_sign' => array (
					'hr' => array (
							'val' => '<hr style="page-break-after:always;" class="ke-pagebreak" />',
							'title' => '分页标示符' 
					) 
			),
			'url_pre' => array (
					'http' => array (
							'val' => 'http://' 
					),
					'https' => array (
							'val' => 'https://' 
					),
					'ftp' => array (
							'val' => 'ftp://' 
					) 
			),
			'url_target' => array (
					'self' => array (
							'field' => 'self',
							'val' => '_self',
							'title' => '当前窗口打开' 
					),
					'blank' => array (
							'field' => 'blank',
							'val' => '_blank',
							'title' => '新窗口打开' 
					) 
			),
			'seo_global_name' => array (
					'site_name' => array (
							'field' => 'site_name',
							'val' => tag_var_name ( 'site_name' ),
							'title' => '站点名称',
							'description' => '(应用范围：所有位置)' 
					),
					'web_name' => array (
							'field' => 'web_name',
							'val' => tag_var_name ( 'web_name' ),
							'title' => '网站名称',
							'description' => '(应用范围：所有位置)' 
					),
					'web_url' => array (
							'field' => 'web_url',
							'val' => tag_var_name ( 'web_url' ),
							'title' => '站点网址',
							'description' => '(应用范围：所有位置)' 
					),
					'admin_email' => array (
							'field' => 'admin_email',
							'val' => tag_var_name ( 'admin_email' ),
							'title' => '管理员邮箱',
							'description' => '(应用范围：所有位置)' 
					) 
			),
			'default_value' => array (
					'title_minlen' => array (
							'val' => 1,
							'title' => '标题最小长度' 
					),
					'title_maxlen' => array (
							'val' => 0,
							'title' => '标题最大长度' 
					),
					'content_minlen' => array (
							'val' => 1,
							'title' => '内容最小长度' 
					),
					'content_maxlen' => array (
							'val' => 0,
							'title' => '内容最大长度' 
					),
					'description_maxlen' => array (
							'val' => 200,
							'title' => '介绍最大长度' 
					),
					'comment_minlen' => array (
							'val' => 1,
							'title' => '评论内容最小长度' 
					),
					'comment_maxlen' => array (
							'val' => 500,
							'title' => '评论内容最大长度' 
					) 
			),
			'email_type' => array (
					'mail' => array (
							'field' => 'mail',
							'val' => 'mail',
							'title' => 'mail()函数发发送' 
					),
					'smtp' => array (
							'field' => 'smtp',
							'val' => 'smtp',
							'title' => 'SMTP模块发送',
							'description' => 'SMTP 模块发送设置' 
					) 
			),
			'yesno' => array (
					'normal' => array (
							'field' => 'normal',
							'val' => 0,
							'val2' => 'yes',
							'val3' => 'y',
							'title' => '是',
							'title2' => '按等比例',
							'title3' => '开启',
							'title4' => '已验证',
							'title5' => '已读',
							'title6' => '网络图片' 
					),
					'check' => array (
							'field' => 'check',
							'val' => 1,
							'val2' => 'no',
							'val3' => 'n',
							'title' => '否',
							'title2' => '固定裁剪',
							'title3' => '关闭',
							'title4' => '未验证',
							'title5' => '未读',
							'title6' => '上传图片' 
					) 
			),
			'imageaction' => array (
					'content' => array (
							'field' => 'content',
							'val' => 'content',
							'defaultsrc' => 'template/static/image/nopic.jpg',
							'title' => '内容图' 
					),
					'avatar' => array (
							'field' => 'avatar',
							'val' => 'avatar',
							'defaultsrc' => 'template/static/image/default_head.png',
							'title' => '会员头像' 
					) 
			),
			'imgageuploadtype' => array (
					'jpg' => array (
							'val' => 'jpg',
							'title' => '*.jpg' 
					),
					'jpeg' => array (
							'val' => 'jpeg',
							'title' => '*.jpeg' 
					),
					'gif' => array (
							'val' => 'gif',
							'title' => '*.gif' 
					),
					'png' => array (
							'val' => 'png',
							'title' => '*.png' 
					) 
			),
			'imgageactiontype' => array (
					'gd' => array (
							'val' => 'gd',
							'title' => 'gd' 
					),
					'imagemagick' => array (
							'val' => 'imagemagick',
							'title' => 'imagemagick' 
					) 
			),
			'imagewaterpostion' => array (
					0 => array (
							'val' => 0,
							'title' => '随机' 
					),
					1 => array (
							'val' => 1,
							'title' => '顶部居左' 
					),
					2 => array (
							'val' => 2,
							'title' => '顶部居中' 
					),
					3 => array (
							'val' => 3,
							'title' => '顶部居右' 
					),
					4 => array (
							'val' => 4,
							'title' => '中间居左' 
					),
					5 => array (
							'val' => 5,
							'title' => '中间居中' 
					),
					6 => array (
							'val' => 6,
							'title' => '中间居右' 
					),
					7 => array (
							'val' => 7,
							'title' => '底部居左' 
					),
					8 => array (
							'val' => 8,
							'title' => '底部居中' 
					),
					9 => array (
							'val' => 9,
							'title' => '底部居右' 
					) 
			),
			'imgagewatertype' => array (
					'jpg' => array (
							'val' => 'jpg',
							'title' => 'jpg&nbsp;水印类型' 
					),
					'jpeg' => array (
							'val' => 'jpeg',
							'title' => 'jpeg&nbsp;水印类型' 
					),
					'gif' => array (
							'val' => 'gif',
							'title' => 'gif &nbsp;水印类型' 
					),
					'png' => array (
							'val' => 'png',
							'title' => 'png &nbsp;水印类型' 
					),
					'text' => array (
							'val' => 'text',
							'title' => 'text &nbsp;文本类型' 
					) 
			),
			'imgageuploadsize' => array (
					'size' => array (
							'val' => 4 
					) 
			),
			'uploadthumbrule' => array (
					'name' => array (
							'val' => '.t=',
							'title' => '上传文件缩略图命名规则名' 
					) 
			),
			'uploadfilehtmlfield' => array (
					'uploadfile' => array (
							'val' => 'uploadfile' 
					) 
			),
			'cycleunit' => array (
					'day' => array (
							'field' => 'day',
							'val' => 1,
							'title' => '天' 
					),
					'hour' => array (
							'field' => 'hour',
							'val' => 2,
							'title' => '小时' 
					),
					'minute' => array (
							'field' => 'minute',
							'val' => 3,
							'title' => '分钟' 
					) 
			),
			'datablock_code' => array (
					'sys' => array (
							'field' => 'sys',
							'val' => html_special ( '<!--{datablock={dcid}}-->' ),
							'title' => '内部调用' 
					),
					'js' => array (
							'field' => 'js',
							'val' => html_special ( '<script language=\"javascript\" src=\"index.php?mod=common&ac=datablock&id={dcid}\"></script>' ),
							'title' => 'js调用方式' 
					) 
			),
			'emotional_path' => array (
					'path' => array (
							'val' => 'common/emotional/{y}/{m}',
							'title' => '表情保存位置' 
					) 
			),
			'showdata_path' => array (
					'path' => array (
							'val' => 'common/showdata/{y}/{m}',
							'title' => '幻灯封面图保存位置' 
					) 
			),
			'action_field' => array (
					'edit' => array (
							'field' => 'edit',
							'title' => '编辑' 
					),
					'move' => array (
							'field' => 'move',
							'title' => '移动到' 
					),
					'del' => array (
							'field' => 'del',
							'title' => '删除' 
					) 
			),
			'sense_num' => array (
					'num' => array (
							'val' => 10,
							'限制最多可允许添加表态动作个数' 
					) 
			),
			'attachment_type' => array (
					'image' => array (
							'field' => 'image',
							'val' => 1,
							'图像类型' 
					),
					'file' => array (
							'field' => 'file',
							'val' => 2,
							'文件类型' 
					) 
			),
			'set_field' => array (
					'sitebase' => array (
							'field' => 'sitebase' 
					),
					'seo' => array (
							'field' => 'seo' 
					),
					'sitestyle' => array (
							'field' => 'sitestyle' 
					),
					'email_set' => array (
							'field' => 'email_set' 
					),
					'sitecontrol' => array (
							'field' => 'sitecontrol',
							'title' => '站点访问与控制' 
					),
					'set' => array (
							'field' => 'set',
							'title' => '全局设置' 
					),
					'register_set' => array (
							'field' => 'register_set',
							'title' => '注册设置' 
					),
					'invitecodebaseset' => array (
							'field' => 'invitecodebaseset',
							'title' => '邀请码基本设置' 
					),
					'creditfield' => array (
							'field' => 'creditfield',
							'title' => '积分基本设置' 
					),
					'serveroptimize' => array (
							'field' => 'serveroptimize',
							'title' => '服务器优化设置' 
					) 
			)
			,
			'site_status' => array (
					'normal' => array (
							'field' => 'normal',
							'title' => '开启访问',
							'description' => '开启访问:&nbsp;允许任何人访问站点' 
					),
					'limited' => array (
							'field' => 'limited',
							'title' => '限制访问',
							'description' => '限制访问:&nbsp;由“超级管理员”指定的会员才能访问站点，通常用于站点内部测试
' 
					),
					'close' => array (
							'field' => 'close',
							'title' => '完全关闭',
							'description' => '完全关闭:&nbsp;除“超级管理员”外，其他人都不允许访问站点' 
					) 
			),
			'allow_register_type' => array (
					'close' => array (
							'field' => 'close',
							'title' => '关闭注册' 
					),
					'ordinary' => array (
							'field' => 'ordinary',
							'title' => '普通注册' 
					),
					'invitecode' => array (
							'field' => 'invitecode',
							'title' => '邀请码注册' 
					) 
			),
			'invitecode_status' => array (
					'default' => array (
							'field' => 'default',
							'title' => '默认' 
					),
					'bought' => array (
							'field' => 'bought',
							'title' => '已购买' 
					),
					'used' => array (
							'field' => 'used',
							'title' => '已注册' 
					),
					'notused' => array (
							'field' => 'notused',
							'title' => '未使用' 
					),
					'overdue' => array (
							'field' => 'overdue',
							'title' => '已过期' 
					) 
			),
			'credit_field' => array (
					'credit0' => array (
							'field' => 'credit0',
							'iscore' => 1 
					),
					'credit1' => array (
							'field' => 'credit1',
							'iscore' => 0 
					),
					'credit2' => array (
							'field' => 'credit2',
							'iscore' => 0 
					),
					'credit3' => array (
							'field' => 'credit3',
							'iscore' => 0 
					),
					'credit4' => array (
							'field' => 'credit4',
							'iscore' => 0 
					),
					'credit5' => array (
							'field' => 'credit5',
							'iscore' => 0 
					),
					'credit6' => array (
							'field' => 'credit6',
							'iscore' => 0 
					),
					'credit7' => array (
							'field' => 'credit7',
							'iscore' => 0 
					),
					'credit8' => array (
							'field' => 'credit8',
							'iscore' => 0 
					),
					'credit9' => array (
							'field' => 'credit9',
							'iscore' => 0 
					) 
			),
			'credit_cycletype' => array (
					'not' => array (
							'field' => 'not',
							'val' => 0,
							'title' => '不限' 
					),
					'once' => array (
							'field' => 'once',
							'val' => 1,
							'title' => '一次' 
					),
					'everyday' => array (
							'field' => 'everyday',
							'val' => 2,
							'title' => '每天' 
					),
					'hour' => array (
							'field' => 'hour',
							'val' => 3,
							'title' => '小时' 
					),
					'minute' => array (
							'field' => 'minute',
							'val' => 4,
							'title' => '分钟' 
					) 
			) 
	);
	if ($is_arr == false) {
		if (! array_key_exists ( $_key, $darr )) {
			$darr = $_key;
		} else {
			$darr = $darr [$_key];
		}
	}
	return $darr;
}
?>