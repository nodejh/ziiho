<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

return array (
		'header_toolbar' => '对不起，加载顶部工具条时出现异常',
		'word_search_nodata' => '对不起，没有找到与&nbsp,“<font class="color7">%s</font>”&nbsp,相关的内容',
	/*分类*/
	'category_title_null' => '请输入分类名称',
		'category_catid_null' => '对不起，请选择分类',
		'category_catid_fail' => '分类参数错误或已丢失',
		'category_catid_noexist' => '对不起，分类不存在',
		'category_parentid_fail' => '父级分类参数错误或已丢失',
		'category_parentid_notexist' => '对不起，父级分类不存在',
		'category_appendto_nav_exception' => '错误:设置到导航失败，内部出现异常',
	/*内容*/
	'content_id_fail' => '对不起，主题参数错误或已丢失',
		'content_detail_noexist' => '对不起，您查看的该主题不存在',
		'content_noexist' => '对不起，该主题不存在',
		'content_status_fail' => '对不起，状态参数错误或已丢失',
		'content_title_maxlen' => '标题字数长度为%s~%s个字',
		'content_content_null' => '请输入主题内容',
		'content_minlen' => '内容字数长度不能少于%s个字',
		'content_maxlen' => '内容字数长度为%s~%s个字',
		'content_description_maxlen' => '内容简介字数长度不能超过%s个字',
	/*站点信息*/
	'sitebase_web_run_fail' => '请选择，站点是否关闭',
	/*网站导航添加*/
	'sitelead_add_sl_name_null' => '请输入网站导航名称',
		'sitelead_edit_sl_name_null' => '部分操作没有成功，请输入网站导航名称',
		'sitelead_slset_sl_id_no_exists' => '对不起，您要操作的导航不存在或已被删除',
		'sitelead_slsets_sl_name_null' => '请输入导航名字不能为空',
	/*网站模板添加*/
	'template_add_tm_name_null' => '请输入模板名称',
		'template_add_tm_dirname_fail' => '输入模板所在路径格式只能由，字母、数字或下划线组成',
		'template_edit_tm_name_null' => '部分操作没有成功，请输入模板名称',
		'template_edit_tm_dirname_fail' => '部分操作没有成功，输入模板所在路径格式只能由，字母、数字或下划线组成',
	/*邮箱配置*/
	'email_set_status_fail' => '邮件发送功能，参数错误或已丢失',
		'email_set_types_fail' => '邮件发送模式，参数错误或已丢失',
		'email_set_smtp_auth_fail' => 'SMTP用户身份验证，参数错误或已丢失',
	/*数据调用*/
	'datacall_module_null' => '请选择模块数据调用',
		'datacall_module_no_exists' => '对不起，参数错误或不存在',
		'datacall_title_null' => '输入数据调用名称不能为空',
		'datacall_dsid_fail' => '请选择模块数据模板，或参数错误或已丢失',
		'datacall_dcid_fail' => '对不起，参数错误或已丢失',
		'datacall_dcid_no_exists' => '模块数据调用不存在',
	/*数据调用*/
	'datastyle_module_null' => '请选择模块分类',
		'datastyle_module_no_exists' => '对不起，参数错误或不存在',
		'datastyle_title_null' => '输入模块模板名称不能为空',
		'datastyle_dsid_fail' => '对不起，参数错误或已丢失',
		'datastyle_dsid_no_exists' => '模块模板不存在',
	/*网站幻灯*/
	'showgroup_title_null' => '输入组名称不能为空',
		'showgroup_list_title_null' => '部分操作没有成功，输入组名称不能为空',
		'showdata_title_null' => '输入标题不能为空',
		'showdata_cgroupid_fail' => '请选择组类型，或参数错误或已丢失',
		'showdata_cgroupid_noexist' => '对不起，幻灯组不存在',
		'showdata_cdataid_fail' => '对不起，幻灯参数错误或已丢失',
		'showdata_cdataid_noexist' => '对不起，该幻灯不存在',
		'showdata_covertype_fail' => '封面图片类型，参数错误或已丢失',
	/*敏感词组*/
	'wordgroup_title_null' => '输入组名称不能为空',
		'wordgroup_list_title_null' => '部分操作没有成功，输入组名称不能为空',
	/*敏感词*/
	'wordfilter_badword_null' => '输入敏感词不能为空',
		'wordfilter_list_badword_null' => '部分操作没有成功，输入敏感词不能为空',
	/*邀请码*/
	'invitecode_create_num_fail' => '请输入1~100之间的整数',
		'invitecode_create_replace_overfull' => '<p>未完全生成</p><p>由于多次检查一个邀请码存在，为避免死循环系统自动退出生成</p>',
	/*积分设置*/
	'credit_field_not' => '对不起，积分类型不存在或未启用',
		'credit_title_null' => '您将启用的，积分名称不能为空',
		'credit_unit_null' => '您将启用的，积分单位不能为空',
		'credit_change_outcredit_null' => '请选择积分兑出',
		'credit_change_outcredit_not' => '积分兑出类型不存在或未启用',
		'credit_change_incredit_null' => '请选择积分兑入',
		'credit_change_incredit_not' => '积分兑入类型不存在或未启用',
		'credit_change_outcredit_incredit_equal' => '对不起，积分兑出与积分兑入不能相同!',
		'credit_change_outcost_fail' => '积分兑出必须为大于0的整数',
		'credit_change_incost_fail' => '积分兑入必须为大于0的整数',
		'credit_change_outcredit_incredit_exist' => '添加失败，积分兑出与积分兑入已存在',
		'credit_policy_rule_title_null' => '输入策略名称不能为空',
		'credit_policy_rule_action_fail' => '策略模块类型名称，只能由英文、数字或下划线组成',
		'credit_policy_rule_cycletype_notexist' => '请选择周期类型',
		'credit_policy_rule_exist' => '对不起，该策略类型名称已存在',
		'credit_policy_rule_notexist' => '对不起，该策略项不存在',
	/*表情*/
	'emotionalgroup_title_null' => '分组类型名称不能为空',
		'emotional_emotgroupid_fail' => '分组类型参数错误或已丢失',
	/*表态动作*/
	'sensetype_module_fail' => '输入模块类型由字母数字下划线组成，并以字母开头',
		'sensetype_module_exist' => '对不起，输入模块类型已存在',
		'sensetype_modules_fail' => '部分操作没有成功，输入模块类型由字母数字下划线组成，并以字母开头',
		'sensetype_modules_exist' => '部分操作没有成功，输入模块类型已存在',
		'sensetype_title_null' => '输入类型名称不能为空',
		'sense_sensetypeid_fail' => '类型参数错误或已丢失',
		'sense_sensetypeid_noexist' => '对不起，类型不存在',
		'sense_title_null' => '表态动作名称不能为空',
		'sense_filename_null' => '文件名称不能为空',
		'sense_num_message' => '对不起，该模块类型下最多可允许添加%s个',
	/*模块*/
	'module_noexist' => '模块“%s”不存在' 
);
?>