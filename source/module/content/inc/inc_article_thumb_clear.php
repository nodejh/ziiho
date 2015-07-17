<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( 'inc_article_thumb_clear' )) {
	function inc_article_thumb_clear() {
		global $_G;
		$tableStr = 'article_picture';
		$_G ['db']->from ( $tableStr );
		$result = $_G ['db']->select ();
		if ($result == $_G ['db']->cw) {
			return $result;
		}
		$result = $_G ['db']->get_list ();
		while ( $rs = $_G ['db']->fetch_array ( $result ) ) {
			$fileSrc = show_uf ( $rs ['file_name'], true );
			if (check_is_file ( $fileSrc ) == 1) {
				/* 清理缩略图 */
				serachfile_del ( $fileSrc . '*' );
			}
		}
	}
}
?>