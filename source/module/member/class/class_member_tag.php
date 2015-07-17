<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_tag extends class_model {
	public $table_member_tag = 'member_tag';
	public $table_member_tagof = 'member_tagof';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_tag() {
		$this->__construct ();
	}
	
	/* 标签名查询 */
	function tag_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_tag );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* ----------------------------------------- */
	/*会员标签查询*/
	function tagof_query($_key, $_val = NULL, $isArr = false) {
		$this->db->from ( $this->table_member_tagof );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$fun = ($isArr != true) ? 'get_one' : 'get_list';
		$result = $this->db->$fun ();
		return $result;
	}
	/* 标签设置保存 */
	function tagof_set($tagid) {
		sleep ( 1 );
		
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前会员 */
		$uid = get_user ( 'uid' );
		/* 统计已选择标签的个数 */
		$tagid_len = array_number ( $tagid );
		/* 清空当前会员的标签 */
		if ($tagid_len < 1) {
			/* 检查会员是否存在标签 */
			$qrs = $this->tagof_query ( 'uid', $uid );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $qrs ) == 1) {
				/* 清空该会员所有标签 */
				$this->db->from ( $this->table_member_tagof );
				$this->db->where ( 'uid', $uid );
				$result = $this->db->delete ();
				if ($result == $this->db->cw) {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				}
			}
			showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
		}
		/* ---------------更新操作------------------ */
		/*开始事务*/
		$this->db->trans_begin ();
		
		/* 删除需要更新的标签 */
		$this->db->from ( $this->table_member_tagof );
		$this->db->where ( 'uid', $uid );
		$this->db->where_not_in ( 'tagid', $tagid );
		$result = $this->db->delete ();
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		for($i = 0; $i < $tagid_len; $i ++) {
			$tagid [$i] = trim_addslashes ( $tagid [$i] );
			if (check_nums ( $tagid [$i] ) < 1) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'member:setting_tagmy_save_id_fail' ), NULL, $callFunc );
			}
			/* 检查会员标签是否存在 */
			$qrs = $this->tagof_query ( array (
					'uid' => $uid,
					'tagid' => $tagid [$i] 
			) );
			if ($qrs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $qrs ) == 1) {
				continue;
			}
			/* 检查标签名是否存在 */
			$tagRs = $this->tag_query ( 'tagid', $tagid [$i] );
			if ($tagRs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $tagRs ) < 1) {
				continue;
			}
			unset ( $tagRs );
			
			/* 新增标签 */
			$dataArr = array (
					'uid' => $uid,
					'tagid' => $tagid [$i],
					'ctime' => $this->sys_time 
			);
			$this->db->from ( $this->table_member_tagof );
			$this->db->set ( $dataArr );
			unset ( $dataArr );
			$result = $this->db->insert ();
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		$this->db->trans_commit_end ();
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
}
?>