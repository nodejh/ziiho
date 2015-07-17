<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'function:function_member_value', 'member' );
loader ( 'function:function_member_val', 'member' );
/* 菜单 */
loader ( 'inc:inc_member_menu', 'member' );
loader ( 'inc:inc_member_datablock', 'member' );
/* 初始化 */
function _member_hook() {
	loader ( 'model:model_member', 'member', true, true )->membermodel ();
}
?>