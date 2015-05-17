<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_credit', 'common', true );
class class_common_credit_admin extends class_common_credit {
	public $common_set = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_credit_admin() {
		$this->__construct ();
	}
	
	/* 初始化对象 */
	function set_common_set_obj() {
		$this->common_set = loader ( 'class:class_common_set', 'common', true, true );
	}
	/* ------------------积分设置----------------- */
	/*基本设置*/
	function baseset($credit, $title, $unit, $description) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前模块 */
		$_m = _M ();
		/* 类型 */
		$_t = common_value_get ( 'set_field', 'creditfield', 'field' );
		/* 初始化数据 */
		$data_arr = NULL;
		/* 初始化类型 */
		$credit_fieldArr = common_value_get ( 'credit_field' );
		if (check_is_array ( $credit_fieldArr ) < 1) {
			showmsg ( lang ( 'common:credit_field_not' ), NULL, $callFunc );
		}
		/* 如果没选择项,则清空设置 */
		if (check_is_array ( $credit ) == 1) {
			$fieldinfo = NULL;
			for($i = 0; $i < array_number ( $credit ); $i ++) {
				if (check_is_key ( $credit [$i], $credit_fieldArr ) < 1) {
					continue;
				}
				if (str_len ( $title [$i] ) < 1) {
					showmsg ( lang ( 'common:credit_title_null' ), NULL, $callFunc );
				}
				if (str_len ( $unit [$i] ) < 1) {
					showmsg ( lang ( 'common:credit_unit_null' ), NULL, $callFunc );
				}
				$fieldinfo [$credit [$i]] = array (
						'field' => $credit [$i],
						'title' => $title [$i],
						'unit' => $unit [$i],
						'description' => $description [$i] 
				);
			}
			$fieldinfo = en_serialize ( $fieldinfo );
			/* 字段初始 */
			$data_arr [] = array (
					$_m,
					$_t,
					'fieldinfo',
					$fieldinfo 
			);
		}
		$this->set_common_set_obj ();
		$result = $this->common_set->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* ------------------积分兑换----------------- */
	/*添加*/
	function change_baseadd($outcost, $outcredit, $incost, $incredit, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 操作用户 */
		$uid = get_user ( 'uid' );
		/* 获取已启用的字段 */
		$creditArr = common_creditfield ();
		if (check_is_array ( $creditArr ) < 1) {
			showmsg ( lang ( 'common:credit_field_not' ), NULL, $callFunc );
		}
		/* 兑出大于0的整数 */
		if (check_nums ( $outcost ) < 1) {
			showmsg ( lang ( 'common:credit_change_outcost_fail' ), NULL, $callFunc );
		}
		/* 兑出字段 */
		if (check_is_key ( $outcredit, $creditArr ) < 1) {
			showmsg ( lang ( 'common:credit_change_outcredit_not' ), NULL, $callFunc );
		}
		/* 兑入大于0的整数 */
		if (check_nums ( $incost ) < 1) {
			showmsg ( lang ( 'common:credit_change_incost_fail' ), NULL, $callFunc );
		}
		/* 兑入字段 */
		if (check_is_key ( $incredit, $creditArr ) < 1) {
			showmsg ( lang ( 'common:credit_change_incredit_not' ), NULL, $callFunc );
		}
		/* 兑出与兑入是否同一类型 */
		if ($outcredit == $incredit) {
			showmsg ( lang ( 'common:credit_change_outcredit_incredit_equal' ), NULL, $callFunc );
		}
		/* 是否启用 */
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		/* 检查是否存在 */
		$result = $this->db->db_select ( $this->table_common_credit_change, array (
				'outcredit' => $outcredit,
				'incredit' => $incredit 
		) );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) == 1) {
			showmsg ( lang ( 'common:credit_change_outcredit_incredit_exist' ), NULL, $callFunc );
		}
		/* 初始化数据 */
		$data_arr = array (
				'uid' => $uid,
				'outcost' => $outcost,
				'outcredit' => $outcredit,
				'incost' => $incost,
				'incredit' => $incredit,
				'ctime' => $this->sys_time,
				'disabled' => $disabled 
		);
		$result = $this->db->db_insert ( $this->table_common_credit_change, $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc );
	}
	/* 简单编辑 */
	function change_baseedit($changeid, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $changeid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $changeid ); $i ++) {
			$changeid [$i] = trim_addslashes ( $changeid [$i] );
			$disabled [$i] = trim_addslashes ( $disabled [$i] );
			if (check_nums ( $changeid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$changers = $this->credit_change_query ( 'changeid', $changeid [$i] );
			if ($changers == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), $url, $callFunc_b );
			}
			if (check_is_array ( $changers ) < 1) {
				continue;
			}
			/* 是否可用 */
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = $changers ['disabled'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_credit_change, $data_arr, 'changeid', $changeid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function change_del($changeid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $changeid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $changeid ); $i ++) {
			$changeid [$i] = trim_addslashes ( $changeid [$i] );
			if (check_nums ( $changeid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$changers = $this->credit_change_query ( 'changeid', $changeid [$i] );
			if ($changers == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), $url, $callFunc_b );
			}
			if (check_is_array ( $changers ) < 1) {
				continue;
			}
			$result = $this->db->db_delete ( $this->table_common_credit_change, 'changeid', $changeid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* ------------------积分策略----------------- */
	/*添加*/
	function policy_add($title, $module, $action, $cycletype, $cycletime, $rewardnum, $credit) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 策略名称 */
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_title_null' ), NULL, $callFunc );
		}
		/* 检查模块 */
		if (check_is_array ( get_module ( $module ) ) < 1) {
			showmsg ( lang ( 'admin:module_noexist' ), NULL, $callFunc );
		}
		/* 策略模块类型 */
		if (check_en ( $action ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_action_fail' ), NULL, $callFunc );
		}
		/* 周期类型 */
		$cycletypeArr = common_value_get ( 'credit_cycletype' );
		if (check_is_key ( $cycletype, $cycletypeArr ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_cycletype_noexist' ), NULL, $callFunc );
		}
		$cycletypeResult = $this->policy_cycletype ( $cycletype, $cycletime, $rewardnum );
		if (check_is_array ( $cycletypeResult ) < 1) {
			showmsg ( $cycletypeResult, NULL, $callFunc );
		}
		$cycletime = array_key_val ( 'cycletime', $cycletypeResult );
		$rewardnum = array_key_val ( 'rewardnum', $cycletypeResult );
		/* 初始化字段 */
		$data_arr = array (
				'module' => $module,
				'action' => $action,
				'title' => $title,
				'cycletype' => $cycletype,
				'cycletime' => $cycletime,
				'rewardnum' => $rewardnum 
		);
		/* 积分字段值 */
		if (check_is_array ( $credit ) == 1) {
			foreach ( $credit as $c ) {
				if (check_num ( $c [1] ) < 1) {
					$c [1] = 0;
				}
				$data_arr [$c [0]] = $c [1];
			}
		}
		/* 检查模块类型是否已存在 */
		$result = $this->credit_rule_query ( array (
				'module' => $module,
				'action' => $action 
		) );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) == 1) {
			showmsg ( lang ( 'common:credit_policy_rule_exist' ), NULL, $callFunc );
		}
		$result = $this->db->db_insert ( $this->table_common_credit_rule, $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	function policy_edit($ruleid, $title, $module, $action, $cycletype, $cycletime, $rewardnum, $credit) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 策略名称 */
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_title_null' ), NULL, $callFunc );
		}
		/* 检查模块 */
		if (check_is_array ( get_module ( $module ) ) < 1) {
			showmsg ( lang ( 'admin:module_noexist' ), NULL, $callFunc );
		}
		/* 策略模块类型 */
		if (check_en ( $action ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_action_fail' ), NULL, $callFunc );
		}
		/* 周期类型 */
		$cycletypeArr = common_value_get ( 'credit_cycletype' );
		if (check_is_key ( $cycletype, $cycletypeArr ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_cycletype_noexist' ), NULL, $callFunc );
		}
		$cycletypeResult = $this->policy_cycletype ( $cycletype, $cycletime, $rewardnum );
		if (check_is_array ( $cycletypeResult ) < 1) {
			showmsg ( $cycletypeResult, NULL, $callFunc );
		}
		$cycletime = array_key_val ( 'cycletime', $cycletypeResult );
		$rewardnum = array_key_val ( 'rewardnum', $cycletypeResult );
		/* 初始化字段 */
		$data_arr = array (
				'module' => $module,
				'action' => $action,
				'title' => $title,
				'cycletype' => $cycletype,
				'cycletime' => $cycletime,
				'rewardnum' => $rewardnum 
		);
		/* 积分字段值 */
		if (check_is_array ( $credit ) == 1) {
			foreach ( $credit as $c ) {
				if (check_num ( $c [1] ) < 1) {
					$c [1] = 0;
				}
				$data_arr [$c [0]] = $c [1];
			}
		}
		/* 策略是否存在 */
		$result = $this->credit_rule_query ( 'ruleid', $ruleid );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) < 1) {
			showmsg ( lang ( 'common:credit_policy_rule_notexist' ), $url, $callFunc_b );
		}
		/* 检查模块类型是否已存在 */
		$this->db->from ( $this->table_common_credit_rule );
		$this->db->where_more ( 'ruleid', $ruleid, '!=' );
		$this->db->where ( array (
				'module' => $module,
				'action' => $action 
		) );
		$this->db->select ();
		$result = $this->db->get_one ();
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) == 1) {
			showmsg ( lang ( 'common:credit_policy_rule_exist' ), NULL, $callFunc );
		}
		/* 编辑操作 */
		$result = $this->db->db_update ( $this->table_common_credit_rule, $data_arr, 'ruleid', $ruleid );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 简单编辑 */
	function policy_baseedit($ruleid, $credit) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $ruleid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		/* 获取已用的字段 */
		$creditFiledArr = common_creditfield ( NULL );
		if (check_is_array ( $creditFiledArr ) < 1) {
			showmsg ( lang ( 'common:credit_field_not' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $ruleid ); $i ++) {
			$ruleid [$i] = trim_addslashes ( $ruleid [$i] );
			if (check_nums ( $ruleid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$ruleRs = $this->credit_rule_query ( 'ruleid', $ruleid [$i] );
			if ($ruleRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), $url, $callFunc_b );
			}
			/* 获取字段值 */
			$creditArr = array_key_val ( $i, $credit );
			if (check_is_array ( $creditArr ) < 1) {
				showmsg ( lang ( 'admin:submit_data_null' ), NULL, $callFunc );
			}
			/* 初始化数据 */
			$data_arr = array ();
			$fieldIndex = 0;
			foreach ( $creditArr as $c ) {
				$field = array_key_val ( 'field', $c );
				$val = array_key_val ( 'val', $c );
				/* 检查字段是否已启用 */
				if (check_is_key ( $field, $creditFiledArr ) < 1) {
					continue;
				}
				if (check_num ( $val ) < 1) {
					$val = $ruleRs [$field];
				}
				$data_arr [$field] = $val;
				/* 标记是否存储了数据 */
				$fieldIndex ++;
			}
			if ($fieldIndex < 1) {
				continue;
			}
			$result = $this->db->db_update ( $this->table_common_credit_rule, $data_arr, 'ruleid', $ruleid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function policy_del($ruleid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $ruleid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $ruleid ); $i ++) {
			$ruleid [$i] = trim_addslashes ( $ruleid [$i] );
			if (check_nums ( $ruleid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$ruleRs = $this->credit_rule_query ( 'ruleid', $ruleid [$i] );
			if ($ruleRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), $url, $callFunc_b );
			}
			$result = $this->db->db_delete ( $this->table_common_credit_rule, 'ruleid', $ruleid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 周期类型 */
	function policy_cycletype($cycletype, $cycletime, $rewardnum) {
		$returnArr = array (
				'cycletime' => '',
				'rewardnum' => '' 
		);
		if (check_num ( $rewardnum ) < 1) {
			$rewardnum = 0;
		}
		switch ($cycletype) {
			case 'not' :
				$returnArr = array (
						'cycletime' => '',
						'rewardnum' => $rewardnum 
				);
				break;
			case 'once' :
				$returnArr = array (
						'cycletime' => '',
						'rewardnum' => 1 
				);
				break;
			case 'everyday' :
				$start_hour = array_key_val ( 'start_hour', $cycletime );
				$start_minute = array_key_val ( 'start_minute', $cycletime );
				$end_hour = array_key_val ( 'end_hour', $cycletime );
				$end_minute = array_key_val ( 'end_minute', $cycletime );
				if (check_num ( $start_hour ) < 1) {
					$cycletime ['start_hour'] = 0;
				}
				if (check_num ( $start_minute ) < 1) {
					$cycletime ['start_minute'] = 0;
				}
				if (check_num ( $end_hour ) < 1) {
					$cycletime ['end_hour'] = 0;
				}
				if (check_num ( $end_minute ) < 1) {
					$cycletime ['end_minute'] = 0;
				}
				/* 起始与结束时间相加最对比 */
				$startTime = (intval ( $cycletime ['start_hour'] ) * 60) + (intval ( $cycletime ['start_minute'] ));
				$endTime = (intval ( $cycletime ['end_hour'] ) * 60) + (intval ( $cycletime ['end_minute'] ));
				if ($endTime >= 1) {
					if ($startTime > $endTime) {
						return lang ( 'admin:starttime_more_endtime' );
					}
				}
				$cycletime = en_serialize ( $cycletime );
				$returnArr = array (
						'cycletime' => $cycletime,
						'rewardnum' => $rewardnum 
				);
				break;
			case 'hour' :
				if (check_nums ( $cycletime ) < 1) {
					$cycletime = 1;
				}
				$returnArr = array (
						'cycletime' => $cycletime,
						'rewardnum' => $rewardnum 
				);
				break;
			case 'minute' :
				if (check_nums ( $cycletime ) < 1) {
					$cycletime = 1;
				}
				$returnArr = array (
						'cycletime' => $cycletime,
						'rewardnum' => $rewardnum 
				);
				break;
		}
		return $returnArr;
	}
}
?>