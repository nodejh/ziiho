<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'function:function_common_val', 'common' );
loader ( 'function:function_common_value', 'common' );
loader ( 'function:function_common_parse', 'common' );
loader ( 'inc:inc_common', 'common' );
loader ( 'inc:inc_common_datablock', 'common' );
loader ( 'inc:inc_common_htmltag', 'common' );
/* 初始化 */
function _common_hook() {
	loader ( 'model:model_common', 'common', true, true )->model_import ();
}
?>