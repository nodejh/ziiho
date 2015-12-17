<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( 'inc_article_check_for_comment' )) {
	function inc_article_check_for_comment($aid) {
		$A = loader ( 'class:class_article', 'article', true, true );
		$articleRs = $A->article_query ( 'aid', $aid );
		if ($articleRs == $A->db->cw) {
			return $articleRs;
		}
		if (check_is_array ( $articleRs ) < 1) {
			return NULL;
		}
		if ($articleRs ['status'] != article_status ( 'normal' )) {
			return NULL;
		}
		return $articleRs;
	}
}
?>