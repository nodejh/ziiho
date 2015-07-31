<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( 'article_adm_membergroup_allow' )) {
	function article_adm_membergroup_allow($obj) {
		$data = array (
				'allowaddcontent' => post_param ( 'allowaddcontent' ),
				'status' => post_param ( 'status' ),
				'content_minlen' => post_param ( 'content_minlen' ),
				'content_maxlen' => post_param ( 'content_maxlen' ) 
		);
		return $data;
	}
}
?>