<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}
function member_value($_key = NULL, $is_arr = false) {
	$darr = array (
			'config' => array (
					'nickname_min' => 1,
					'nickname_max' => 22 
			),
			'status' => array (
					'normal' => array (
							'field' => 'normal',
							'val' => 0,
							'title' => '正常' 
					),
					'check' => array (
							'field' => 'check',
							'val' => 1,
							'title' => '人工审核' 
					),
					'email' => array (
							'field' => 'email',
							'val' => 2,
							'title' => 'E-mail&nbsp;验证' 
					),
					'stop' => array (
							'field' => 'stop',
							'val' => 3,
							'title' => '禁止' 
					),
					'recycle' => array (
							'field' => 'recycle',
							'val' => 4,
							'title' => '回收站' 
					) 
			),
			'avatar_status' => array (
					'normal' => array (
							'field' => 'normal',
							'val' => 0,
							'title' => '正常' 
					),
					'check' => array (
							'field' => 'check',
							'val' => 1,
							'title' => '人工审核' 
					),
					'recycle' => array (
							'field' => 'recycle',
							'val' => 2,
							'title' => '放入回收站' 
					) 
			),
			'subject_template' => array (
					'mood' => array (
							'val' => 'member/mood_list_a',
							'title' => '会员空间主页主题列表模板' 
					),
					'arrive' => array (
							'val' => 'member/arrive_list_a',
							'title' => '会员空间主页主题列表模板' 
					) 
			),
			'set_field' => array (
					'memberinit' => array (
							'field' => 'memberinit',
							'title' => '会员组初始化' 
					),
					'baseset' => array (
							'field' => 'baseset',
							'title' => '基本设置' 
					),
					'seo' => array (
							'field' => 'seo',
							'title' => 'seo会员空间' 
					),
					'avatar_set' => array (
							'field' => 'avatar_set',
							'title' => '头像设置' 
					),
					'avatar_water' => array (
							'field' => 'avatar_water',
							'title' => '头像水印设置' 
					) 
			),
			'group_type' => array (
					'system' => array (
							'field' => 'system',
							'title' => '管理组' 
					),
					'member' => array (
							'field' => 'member',
							'title' => '会员组' 
					),
					'special' => array (
							'field' => 'special',
							'title' => '特殊组' 
					),
					'default' => array (
							'field' => 'default',
							'title' => '默认组' 
					) 
			),
			'message_type' => array (
					'email' => array (
							'field' => 'email',
							'type' => 'content_type',
							'title' => 'Email' 
					),
					'notice' => array (
							'field' => 'notice',
							'type' => 'content_type',
							'title' => '通知' 
					),
					'message' => array (
							'field' => 'message',
							'type' => 'send_status',
							'title' => '短消息' 
					) 
			),
			'message_content_type' => array (
					'text' => array (
							'field' => 'text',
							'func' => 'html_special',
							'title' => '文本方式' 
					),
					'html' => array (
							'field' => 'html',
							'func' => 'html_special_de',
							'title' => 'html方式' 
					) 
			),
			'message_variable_name' => array (
					'username' => array (
							'val' => tag_var_name ( 'username' ),
							'title' => '会员名',
							'description' => '(应用范围：标题和内容)' 
					),
					'nickname' => array (
							'val' => tag_var_name ( 'nickname' ),
							'title' => '会员昵称',
							'description' => '(应用范围：标题和内容)' 
					),
					'time' => array (
							'val' => tag_var_name ( 'time' ),
							'title' => '发送时间',
							'description' => '(应用范围：标题和内容)' 
					) 
			),
			'message_box_status' => array (
					'normal' => array (
							'field' => 'normal',
							'val' => 0,
							'title' => '正常' 
					),
					'delete' => array (
							'field' => 'delete',
							'val' => 1,
							'title' => '删除' 
					) 
			),
			'datacall_set_url' => array (
					'add' => array (
							'field' => 'add',
							'val' => url ( 'index', 'mod/member/ac/admin/op/datacall/ao/add/menu_id/425' ),
							'title' => '会员数据调用添加url' 
					),
					'edit' => array (
							'field' => 'edit',
							'val' => url ( 'index', 'mod/member/ac/admin/op/datacall/ao/edit/menu_id/424' ),
							'title' => '会员数据调用编辑url' 
					) 
			),
			'datastyle_set_url' => array (
					'add' => array (
							'field' => 'add',
							'val' => url ( 'index', 'mod/member/ac/admin/op/datastyle/ao/add/menu_id/428' ),
							'title' => '会员数据模板添加url' 
					),
					'edit' => array (
							'field' => 'edit',
							'val' => url ( 'index', 'mod/member/ac/admin/op/datastyle/ao/edit/menu_id/427' ),
							'title' => '会员数据模板编辑url' 
					) 
			),
			'adm_message_type_url' => array (
					'email' => array (
							'url' => url ( 'index', 'mod/member/ac/admin/op/email/ao/sends' ),
							'title' => 'Email' 
					),
					'notice' => array (
							'url' => url ( 'index', 'mod/member/ac/admin/op/notice/ao/sends' ),
							'title' => '提醒' 
					),
					'message' => array (
							'url' => url ( 'index', 'mod/member/ac/admin/op/msg/ao/sends' ),
							'title' => '短消息' 
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