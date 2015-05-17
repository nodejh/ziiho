<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( 'common_credit_rule' )) {
	function common_credit_rule($obj) {
		$data = array (
				'content_add' => array (
						'module' => 'common',
						'action' => 'content_add',
						'title' => '添加主题',
						'cycletype' => common_value_get ( 'credit_cycletype', 'once', 'val' ),
						'cycletime' => '',
						'rewardnum' => '' 
				) 
		);
		return $data;
	}
}
?>