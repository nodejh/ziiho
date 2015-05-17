<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'function:function_comment_val', 'comment' );
loader ( 'function:function_comment_value', 'comment' );
/* 初始化 */
function _comment_hook() {
	loader ( 'model:model_comment', 'comment', true, true )->model_import ();
}
?>