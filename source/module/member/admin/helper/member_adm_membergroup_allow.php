<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( 'member_adm_membergroup_allow' )) {
	function member_adm_membergroup_allow($obj) {
		/* 昵称长度 */
		$_nickname_min = member_config_get ( 'nickname_min' );
		$_nickname_max = member_config_get ( 'nickname_max' );
		
		$nickname_min = post_param ( 'nickname_min' );
		if (check_nums ( $nickname_min ) < 1) {
			$nickname_min = $_nickname_min;
		} else {
			if ($nickname_min > $_nickname_max) {
				$nickname_min = $_nickname_min;
			}
		}
		$nickname_max = post_param ( 'nickname_max' );
		if (check_nums ( $nickname_max ) < 1) {
			$nickname_max = $_nickname_max;
		} else {
			if ($nickname_max > $_nickname_max) {
				$nickname_max = $_nickname_max;
			}
		}
		
		$data = array (
				'allowvisit' => post_param ( 'allowvisit' ),
				'allowinvisible' => post_param ( 'allowinvisible' ),
				'allowavatar' => post_param ( 'allowavatar' ),
				'nickname_min' => $nickname_min,
				'nickname_max' => $nickname_max 
		);
		return $data;
	}
}
?>