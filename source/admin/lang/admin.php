<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

return array (
		'100000' => '后台管理中心',
		'100001' => '对不起，您无权操作或请联系管理员',
		
		'100002' => '请输入用户名',
		'100003' => '用户名错误',
		'100004' => '请输入密码',
		'100005' => '密码错误',
		'100006' => '登陆成功',
		'100007' => '密码修改成功，为了您的账户安全，请返回重新登录',
		'100008' => '暂无内容信息！',
		
		'110001' => '该菜单不存在',
		'110002' => '菜单名称不能为空',
	
	/*菜单添加*/
	'menu_edit_name_null' => '输入菜单名不能为空',
		'menu_edit_no_exists' => '操作失败，上级菜单不存在或已被删除',
		'menu_edit_target_fail' => '打开链接方式只能为字母、数字或下划线组成',
		'menu_edit_modelurl_id_fail' => '部分操作没有成功，URL链接编号只能为大于或等于0的整数',
		'menu_edit_new_menu_id_fail' => '操作失败，移动菜单参数menu_id错误或已丢失',
		'menu_edit_new_menu_id_no_exists' => '操作失败，移动菜单不存在',
		'menu_list_name_null' => '部分操作没有成功，菜单名不能为空，请重新输入',
		'menu_list_modelurl_id_fail' => '部分操作没有成功，URL链接编号只能为大于或等于0的整数',
		'menu_list_target_fail' => '部分操作没有成功，打开链接只能为字母、数字或下划线组成',
		'menu_menu_id_fail' => '对不起，参数错误或已丢失',
		'menu_getval_isexist' => '对不起，url参数值已存在',
	/*模块*/
	'module_title_null' => '输入模块标题不能为空',
		'module_fail' => '模块参数不存在或已丢失',
		'module_exists' => '对不起，模块目录已存在',
		'module_noexist' => '对不起，模块不存在',
		'module_status_fail' => '对不起，状态参数错误或已丢失',
		'module_status_do_error' => '<p>设置状态失败</p><p>1.模块未安装</p><p>2.目录权限不足或无权访问</p><p>3.未知异常</p>',
		'module_start' => '您确定要将“_module_”模块开启?',
		'module_close' => '将“_module_”模块关闭后则不可用，您确定要关闭么?',
		'module_core_noallow' => '对不起，“%s”为核心模块，不允许操作',
		'module_dir_noexist' => '对不起，该模块安装包不存在',
		
		'module_no_install' => '对不起，该模块尚未安装',
		'module_file_noexist' => '<p>文件不存在</p><p>%s</p>',
		
		'module_install' => '您确定要将&nbsp“<strong>%s</strong>”&nbsp模块<strong>安装</strong>么?',
		'module_installed' => '<p>该模块已安装</p><p>如需重新安装请删除文件:%s</p><p>文件位置:%s</p>',
		'module_install_tablestruct_exception' => '安装数据表异常',
		'module_install_tabledata_exception' => '插入表数据异常',
		'module_install_update_exception' => '更新%s模块参数内部出现异常',
		'module_install_function_noexist' => '<p>运行文件:%s</p><p>安装功能缺少:%s</p>',
		'module_install_create_lockfile_fail' => '<p>锁定%s模块失败，目录权限不足或异常</p><p>%s</p>',
		'module_install_success' => '模块%s已安装成功',
		
		'module_uninstall' => '您确定要将&nbsp“<strong>%s</strong>”&nbsp模块<strong>卸载</strong>么?',
		'module_uninstall_db_backup_start' => '正在准备当前模块数据表备份...',
		'module_uninstall_file_fail' => '对不起，卸载失败，目录权限不足',
		'module_uninstall_del_lockfile_fail' => '<p>删除(%s)锁定模块%s失败，目录权限不足或异常</p><p>%s</p>',
		'module_uninstall_droptable_exception' => '删除数据表异常',
		'module_uninstall_success' => '模块%s已卸载成功',
	/*数据库*/
	'database_backup_table_null' => '请选择将要备份的数据表',
		'database_backup_dir_noexist' => '备份目录:%s权限不足或不存在',
		'database_backup_fail' => '数据库备份失败',
		'database_backup_success' => '数据库备份完成<br/>生成备份文件在%s目录下，共计%s卷',
		'database_restore_file_null' => '请选择要还原的备份文件',
		'database_restore_dir_noexist' => '数据还原%s目录不存在',
		'database_restore_table_struct_noexist' => '%s目录下的表结构文件不存在',
		'database_restore_table_struct_exception' => '错误:&nbsp;数据表结构还原处理异常',
		'database_restore_data_exception' => '错误:&nbsp;数据还原处理异常',
		'database_restore_backup_del_null' => '请选择要删除的备份文件',
		'database_restore_backup_del_fail' => '删除备份文件失败，目录权限不足或不存在',
		'database_restore_backup_del_success' => '删除备份文件成功',
		'database_restore_success' => '数据还原成功',
		'database_restore_success2' => '<p>数据还原成功</p><p>备份文件已删除</p>',
		'database_sqlquery_drop_noallow' => '对不起，在此不允许使用drop命令',
		'database_sqlquery_null' => 'SQL 语句为空',
		'database_sqlquery_fail' => 'SQL 语句错误',
		'database_sqlquery_rows_null' => '没有找到记录',
	/*更新缓存*/
	'cache_update_all_fail' => '更新全站缓存失败，可能权限不足或内部异常',
		'cache_update_all_success' => '更新全站缓存成功' 
);
?>