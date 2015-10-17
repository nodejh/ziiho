<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_group extends class_model {
	public $table_member_group = 'member_group';
	public $table_member_groupset = 'member_groupset';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_group() {
		$this->__construct ();
	}
	
	/* 组按条件查询 */
	function group_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_group );
		$this->db->where ( $_key, $_val );
		$this->db->order_by ( 'groupid' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 组列表 */
	function group_list($grouptype = NULL, $page_size = 100, $page_nums = 7, $page = 1) {
		$orderby = order_val ();
		$this->db->from ( $this->table_member_group );
		if (! empty ( $grouptype )) {
			$this->db->where ( 'grouptype', $grouptype );
		}
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'groupid', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		return array (
				$pg,
				$result 
		);
	}
	/* -------------------设置组-------------------- */
	/*组配置按条件查询*/
	function groupset_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_groupset );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* ------------------------------------------- */
	/*按积分获取下一个会员组(仅返回groupid)*/
	function group_credit_query($groupid, $credit) {
		if (check_num ( $credit ) < 1) {
			return $groupid;
		}
		/* 会员组类型 */
		$grouptype = member_grouptype ( 'member' );
		
		/* 查询组比较,积分>=组积分,则获取下一个组 */
		$gRs = $this->group_query ( 'groupid', $groupid );
		if ($gRs == $this->db->cw) {
			return $gRs;
		}
		if (! is_array ( $gRs )) {
			return NULL;
		}
		/* 如果越组,则获取该组 */
		$_groupidVal = $groupid;
		if ($gRs ['credit'] <= $credit) {
			$this->db->from ( $this->table_member_group );
			$this->db->where ( 'grouptype', $grouptype );
			$this->db->where_more ( 'credit', $credit, '<=' );
			$this->db->order_by ( 'groupid', 'DESC' );
			$overGroupRs = $this->db->select ();
			if ($overGroupRs == $this->db->cw) {
				return $overGroupRs;
			}
			$overGroupRs = $this->db->get_one ();
			if (! is_array ( $overGroupRs )) {
				return NULL;
			}
			$_groupidVal = $overGroupRs ['groupid'];
			unset ( $overGroupRs );
		} else {
			/* 积分是否符合组积分,如果不符合,则获取符合组 */
			$this->db->from ( $this->table_member_group );
			$this->db->where ( 'grouptype', $grouptype );
			$this->db->where_more ( 'credit', $credit, '<=' );
			$this->db->order_by ( 'groupid' );
			$accordGroupRs = $this->db->select ();
			if ($accordGroupRs == $this->db->cw) {
				return $accordGroupRs;
			}
			$accordGroupRs = $this->db->get_one ();
			$_groupidVal = array_key_val ( 'groupid', $accordGroupRs, $_groupidVal );
		}
		unset ( $gRs );
		/* 获取下一个组 */
		$this->db->from ( $this->table_member_group );
		$this->db->where ( 'grouptype', $grouptype );
		$this->db->where_more ( 'credit', $credit, '>' );
		$this->db->order_by ( 'groupid' );
		$newGroupRs = $this->db->select ();
		if ($newGroupRs == $this->db->cw) {
			return $newGroupRs;
		}
		$newGroupRs = $this->db->get_one ();
		if (! is_array ( $newGroupRs )) {
			return $_groupidVal;
		}
		/* 如果积分不足组下一个组积分,则返回原组 */
		if ($newGroupRs ['credit'] > $credit) {
			return $_groupidVal;
		}
		return $newGroupRs ['groupid'];
	}
	/* 返回下一个组 */
	function group_next($groupid) {
		/* 会员组类型 */
		$grouptype = member_grouptype ( 'member' );
		
		$this->db->from ( $this->table_member_group );
		$this->db->where_more ( 'groupid', $groupid, '>' );
		$this->db->where ( 'grouptype', $grouptype );
		$this->db->order_by ( 'groupid' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 会员组初始化 */
	function group_init($uid, $isGroupInfo = false) {
		$MObj = loader ( 'class:class_member', 'member', true, true );
		$CObj = loader ( 'class:class_member_credit', 'member', true, true );
		
		/* 获取会员信息 */
		$memberRs = $MObj->member_query ( 'uid', $uid );
		if ($memberRs == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		if (! is_array ( $memberRs )) {
			return lang ( 'member:uid_get_noexist' );
		}
		
		/* 系统已启用的积分字段 */
		$creditFieldArr = common_creditfield ( NULL );
		if (! is_array ( $creditFieldArr )) {
			return lang ( 'common:credit_field_not' );
		}
		
		/* 获取会员原有存在积分 */
		$creditRs = $CObj->member_credit_query ( 'uid', $uid );
		if ($creditRs == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		
		$creditVal = array ();
		$creditData = NULL;
		/* 如果不存在原有积分,则获取初始化的积分 */
		if (! is_array ( $creditRs )) {
			/* 已配置的初始字段 */
			$memberinitSet = get_db_set ( array (
					'smodule' => 'member',
					'stype' => member_value_get ( 'set_field', 'memberinit', 'field' ) 
			) );
			if ($memberinitSet == $this->db->cw) {
				return lang ( 'global:exception' );
			}
			if (! is_array ( $memberinitSet )) {
				return lang ( 'global:get_db_set_null' );
			}
			$groupid = config_val ( 'groupid', $memberinitSet );
			$creditVal = de_serialize ( config_val ( 'credit', $memberinitSet ) );
			unset ( $memberinitSet );
		} else {
			$groupid = $memberRs ['groupid'];
		}
		if (check_nums ( $groupid ) < 1) {
			return lang ( 'member:groupid_fail' );
		}
		
		/* 会员组是否存在 */
		$groupRs = $this->group_query ( 'groupid', $groupid );
		if ($groupRs == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		if (! is_array ( $groupRs )) {
			return lang ( 'member:groupid_noexist' );
		}
		/* 排除未被启用的积分字段 */
		if (! is_array ( $creditRs )) {
			foreach ( $creditVal as $cK => $cV ) {
				if (! array_key_exists ( $cK, $creditFieldArr )) {
					continue;
				}
				if ($cK != $CObj->creditCore) {
					$creditData [$cK] = $cV;
				} else {
					$creditData [$cK] = op2num ( $groupRs ['credit'], $cV );
				}
			}
		} else {
			foreach ( $creditFieldArr as $cK => $cV ) {
				$creditData [$cK] = $creditRs [$cK];
			}
		}
		unset ( $creditVal, $creditFieldArr );
		
		if (! is_array ( $creditData )) {
			return lang ( 'common:credit_field_not' );
		}
		
		/* 获取计算出来的会员组 */
		$newGroupRs = $this->group_credit_query ( $groupid, $creditData [$CObj->creditCore] );
		if ($newGroupRs == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		if (empty ( $newGroupRs )) {
			return lang ( 'member:groupid_noexist' );
		}
		$newGroupid = $newGroupRs;
		
		/* 更新会员组 */
		if ($newGroupid != $groupid) {
			$result = $MObj->member_update ( array (
					'groupid' => $newGroupid 
			), 'uid', $uid );
			if ($result == $this->db->cw) {
				return lang ( 'global:exception' );
			}
		}
		
		/* 更新积分 */
		if (! is_array ( $creditRs )) {
			$result = $CObj->member_credit_add ( array_merge ( array (
					'uid' => $uid 
			), $creditData ) );
		} else {
			if ($creditData [$CObj->creditCore] != $creditRs [$CObj->creditCore]) {
				$result = $CObj->member_credit_update ( $creditData, 'uid', $uid );
			}
		}
		if ($result == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		/* 返回值类型 */
		if ($isGroupInfo != true) {
			$returnData = $this->db->zq;
		} else {
			$currGroupRs = $this->group_query ( 'groupid', $newGroupid );
			if ($currGroupRs == $this->db->cw) {
				return $currGroupRs;
			}
			$nextGroupRs = $this->group_next ( $newGroupid );
			if ($nextGroupRs == $this->db->cw) {
				return $nextGroupRs;
			}
			if (! is_array ( $nextGroupRs )) {
				$nextGroupRs = $currGroupRs;
			}
			$returnData = array (
					'cgroup' => $currGroupRs,
					'ngroup' => $nextGroupRs 
			);
		}
		return $returnData;
	}
}
?>