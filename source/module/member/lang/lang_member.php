<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

return array (
		'notice' => '通知',
		'message' => '消息',
		
		'uid' => 'UID',
		'username' => '用户名',
		'password' => '密码',
		'email' => 'E-mail(邮箱)',
		'nickname' => '昵称',
		
		'ta' => 'TA',
		'me' => '我',
		
		'follow' => '关注',
		'fans' => '粉丝',
		
		'p_follow' => '关注的人',
		'p_fans' => '的粉丝',
		
		'add_follow' => '加关注',
		'cancel_follow' => '取消关注',
		
		'remove_fans' => '移除粉丝',
		'follow_fans' => '相互关注',
		
		'inbox' => '收件箱',
		'outbox' => '发件箱',
		'sendmessage' => '发送消息',
		
		'loginout_success' => '退出成功',
		'login_success' => '登录成功',
		'register_success' => '注册成功',
		
		'loginclose' => '对不起，会员登录已关闭',
		'logined' => '对不起，您已在会话状态',
		'loginedregister' => '对不起，您已在会话状态，如需操作请先退出会话状态',
		
		'nologin' => '对不起，请先登录',
		'uid_fail' => '对不起，参数错误',
		'uid_noexist' => '对不起，您的账号不存在',
		'uid_stop' => '对不起，您的账号已被屏蔽',
		
		'uid_get_noexist' => '该会员不存在',
		'uid_get_stop' => '该会员已被屏蔽',
		
		'username_info' => '用户名由26个英文字母和数字组成(%s~%s个字符)，并以英文字母开头',
		'password_info' => '密码长度为%s~%s个字符',
		'nickname_info' => '昵称长度为%s~%s个字符',
		
		'username_null' => '请输入用户名',
		'username_fail' => '请输入有效的用户名',
		'username_noexist' => '用户名不存在',
		'username_isexist' => '用户名已存在',
		'password_null' => '请输入密码',
		'password_fail' => '请输入有效的密码',
		'password_noexist' => '输入密码错误',
		'email_null' => '请输入邮箱地址',
		'email_fail' => '请输入有效的邮箱地址',
		'email_isexist' => '邮箱已存在',
		'email_noexist' => '邮箱不存在',
		'pwd_not_pwd2' => '输入两次密码不一致',
		
		'groupid_fail' => '会员组参数错误或已丢失，或未初始化',
		'groupid_noexist' => '初始化会员组不存在或设置有误',
		
		'to_email_status_check' => '对不起，对方的E-mail邮箱尚未验证',
		'email_status_check' => '对不起，您的E-mail邮箱尚未验证',
		'status_check' => '对不起，您的账号处于待审核状态中',
		'status_stop' => '对不起，您的账号已被锁定',
		'status_recycle' => '对不起，您的账号已被屏蔽',
		'system_group_no_access' => '对不起，您无权操作，请返回',
		'group_no_access' => '对不起，您当前无权操作，如有疑问请联系管理员',
		'term_no_access' => '对不起，您无权操作，如有疑问请联系管理员',
	/*头像上传*/
	'avatar_imagesize_info' => '头像最大尺寸为:%sx%s像素',
		'avatar_upload_temp_noexist' => '对不起，该操作不存在或已过期',
		'avatar_upload_crop_xy_fail' => '选区坐标参数错误或已丢失',
		'avatar_upload_crop_wh_fail' => '选区尺寸参数错误或已丢失',
		'avatar_upload_crop_file_noexist' => '头像文件不存在或已丢失',
		'avatar_upload_crop_wh_not_config_fail' => '对不起，选区尺寸参数不在配置尺寸内',
	/*基本资料设置*/
	'profile_nickname_null' => '输入昵称不能为空',
		'profile_nickname_info' => '昵称在%s~%s个字',
		'profile_gender_fail' => '请选择性别',
		'profile_inform_info' => '个性签名最多不能超过%s个字',
	/*标签设置*/
	'setting_tagname_nodata' => '对不起，暂无标签数据',
		'setting_tagmy_num' => '最多可贴%s个标签',
		'setting_tagmy_null' => '您还没有给自己贴标签哦!',
		'setting_tagmy_save_id_null' => '对不起，提交数据不完整',
		'setting_tagmy_save_id_fail' => '对不起，参数错误或已丢失',
	/*密码修改*/
	'password_set_success' => '密码修改成功，为了您的账户安全，请返回重新登录',
		'password_set_old_pwd_null' => '请输入原密码',
		'password_set_old_pwd_fail' => '原密码错误',
		'password_set_new_pwd_null' => '请输入新密码',
		'password_set_new_pwd_info' => '请输入新密码长度在%s~%s个字符',
		'password_set_new_pwd2_null' => '请输入确认新密码',
		'password_set_new_pwd_not_new_pwd2' => '输入两次新密码不一致',
		'password_set_old_pwd_equal_new_pwd' => '操作失败，新密码不能和原密码相同',
	/*朋友操作*/
	'follow_success' => '关注成功',
		'follow_del_success' => '取消成功',
		'follow_uid_self' => '对不起，这是您自己',
		'follow_noexist' => '对不起，您没有关注该会员',
		'follow_exist' => '对不起，您已关注了该会员',
		'fans_noexist' => '对不起，该粉丝不存在',
		'fans_del_success' => '移除成功',
	/*消息*/
	'message_write_exception' => '发送失败，内部出现异常',
		'message_write_success' => '发送成功',
		'message_id_fail' => '对不起，参数错误或已丢失',
		'message_noexist' => '该信息不存在或已被删除',
		'message_write_search_fail' => '对不起，搜索条件为空或格式错误',
		'message_write_search_count' => '共搜索到&nbsp,<strong class="color6">%s</strong>&nbsp,个符合条件的会员',
		'message_write_username_null' => '请输入收件人',
		'message_write_username_fail' => '输入收件人格式错误',
		'message_write_username_noexist' => '收件人不存在',
		'message_write_username_self' => '对不起，您不能给自己发送信息',
		'message_write_title_null' => '请输入信息标题',
		'message_write_content_null' => '请输入信息内容',
	/*发送邮件*/
	'message_email_close' => '对不起，邮箱发送功能已关闭',
		'message_email_status_fail' => '对不起，邮箱发送功能参数错误或已丢失',
		'message_email_status_check' => '对不起，邮箱发送功能尚未开启',
		'message_email_type_fail' => '对不起，邮箱发送方式参数错误或已丢失',
		'message_email_auth_fail' => '对不起，邮箱smtp用户身份验证参数错误或已丢失',
		'message_email_send_fail' => '对不起，邮箱发送失败，请重新尝试或检查配置是否有误',
	/*会员添加*/
	'add_username_fail' => '输入用户名格式错误',
		'add_email_fail' => '输入E-mail(邮箱)格式错误',
		'add_nickname_fail' => '输入昵称格式错误',
		'add_password_fail' => '输入密码格式错误',
		'add_password2_fail' => '请输入输入确认密码',
		'add_password_not_equal' => '两次密码不一致',
		'add_username_isexist' => '用户名已存在',
		'add_email_isexist' => '邮箱已存在',
		'add_groupid_fail' => '对不起，%s参数错误或已丢失',
		'add_groupid_notexist' => '对不起，%s不存在',
	/*用户组*/
	'group_title_null' => '输入组名称不能为空',
		'group_grouptype_fail' => '对不起，初始化组类型错误',
		'group_groupid_fail' => '对不起，参数错误或已丢失',
		'group_groupid_notexist' => '操作失败，该组不存在',
		'group_allow_helper_notexist' => '组设置%s功能少',
		
		'set_uid_fail' => '对不起，参数错误或已丢失',
		'set_uid_notexist' => '对不起，您要操作的会员不存在',
		'set_system_groupid_fail' => '对不起，系统组参数错误或已丢失',
		'set_system_groupid_notexist' => '对不起，系统组不存在',
		'set_menu_id_fail' => '对不起，管理菜单参数错误或已丢失',
		'set_menu_id_dbexception' => '对不起，处理管理菜单数据异常',
	/*会员标签添加*/
	'tagname_name_null' => '输入标签名称不能为空',
	/*会员地区分类操作*/
	'area_title_null' => '地区分类名称不能为空',
		'area_aid_fail' => '对不起，参数错误或已丢失',
		'area_aid_notexist' => '对不起，该地区分类不存在',
		'area_parent_fail' => '对不起，上级分类参数错误或已丢失',
		'area_parent_notexist' => '对不起，上级分类不存在',
	/*头像上传设置保存*/
	'adm_dir_fail' => '输入附件保存位置格式错误',
		'adm_size_fail' => '输入上传图片大小只能为大于或等于0的整数',
		'adm_quality_fail' => '输入缩略图质量只能为0~100之间的整数',
		'adm_allow_width_fail' => '输入上传图片尺寸w（宽）只能为大于或等于0的整数',
		'adm_allow_height_fail' => '输入上传图片尺寸h（高）只能为大于或等于0的整数',
		'adm_thumb_width_fail' => '输入图片缩略图尺寸w（宽）只能为大于或等于0的整数',
		'adm_thumb_height_fail' => '输入图片缩略图尺寸h（高）只能为大于或等于0的整数',
		'adm_crop_minwidth_fail' => '输入裁剪选区框最小缩放尺寸w（宽）只能为大于或等于0的整数',
		'adm_crop_minheight_fail' => '输入裁剪选区框最小缩放尺寸h（高）只能为大于或等于0的整数',
	/*邀请码注册检查*/
	'register_invitecode_null' => '请输入邀请码',
		'register_invitecode_fail' => '请输入有效的邀请码',
		'register_invitecode_noexist' => '对不起，此邀请码不存在',
		'register_invitecode_nobuy' => '此邀请码尚未被购买，暂无法使用',
		'register_invitecode_used' => '对不起，此邀请码已被注册',
		'register_invitecode_expire' => '对不起，此邀请码已过期' 
);
?>