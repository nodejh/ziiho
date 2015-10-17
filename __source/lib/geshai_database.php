<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_database extends geshai_mysql {
	public $_set_value = null;
	public $_from = null;
	public $_distinct = null;
	public $_joins = null;
	public $_where = null;
	public $_group_by = null;
	public $_having = null;
	
	public $_order_by = null;
	
	public $_limit = null;
	
	public $_rand_limit = null;
	
	public $_set_sql = null;
	function __construct(&$dns) {
		parent::__construct ( $dns );
		$this->connect ();
	}
	function geshai_database(&$dns) {
		$this->__construct ( $dns );
	}
	
	
	function select($fields = null) {
		$sql = $this->get_sql ();
		if (empty ( $this->_set_sql )) {
			$str = ('SELECT ' . $this->sql_field ( $fields ) . ' FROM ' . $this->_from . ' ' . $sql);
		} else {
			$str = $this->_set_sql;
		}
		$this->execute ( $str );
		$this->clear_sql ();
		return $this->status;
	}
	
	function insert() {
		$this->set_insert ();
		$this->execute ( 'INSERT INTO ' . $this->_from . '(' . $this->_set_value [0] . ') VALUES (' . $this->_set_value [1] . ')' );
		$this->clear_sql ();
		return $this->status;
	}
	
	function update() {
		$this->set_update ();
		$where = $this->get_sql ();
		$this->execute ( 'UPDATE ' . $this->_from . ' SET ' . $this->_set_value . $where );
		$this->clear_sql ();
		return $this->status;
	}
	
	function delete() {
		$where = $this->get_sql ();
		$this->execute ( 'DELETE FROM ' . $this->_from . $where );
		$this->clear_sql ();
		return $this->status;
	}
	
	function count() {
		if (! empty ( $this->_distinct )) {
			$_field = substr ( $this->_distinct, 1 );
		} else {
			$_field = 'COUNT(*)';
		}
		$sql = $this->get_sql ( true );
		$this->execute ( 'SELECT ' . $_field . 'FROM' . $this->_from . ' ' . $sql );
		if (! $this->is_success ()) {
			return 0;
		}
		$result = $this->fetch_array ();
		return my_array_value ( 0, $result );
	}
	
	function get_one() {
		if (! $this->is_success ()) {
			return $this->status;
		}
		return $this->fetch_array ();
	}
	
	function get_list() {
		if (! $this->is_success ()) {
			return $this->status;
		}
		return $this->result;
	}
	/* 记录集 */
	function result($r = null) {
		return $this->fetch_array ( $r );
	}
	/* 表字段 */
	function field($field = null) {
		$value = null;
		if (empty ( $field )) {
			$field = $this->get_field ( $this->_from );
		} else {
			$field = my_explode ( ',', $field );
		}
		foreach ( $field as $v ) {
			$f = $this->standard_field ( $v );
			if (! empty ( $value )) {
				$value .= ',';
			}
			$value .= $f;
		}
		return $value;
	}
	
	function sql_field($field = null) {
		$this->validate_field ( $field );
		
		$value = $this->field ( $field );
		if (! empty ( $this->_distinct )) {
			$value .= $this->_distinct;
		}
		return $value;
	}
	
	function get_sql($is_count = false) {
		$sql = null;
		if (! empty ( $this->_joins )) {
			$sql .= (' ' . $this->_joins);
		}
		if (! empty ( $this->_where )) {
			$sql .= (' WHERE ' . $this->_where);
		}
		if (! empty ( $this->_group_by )) {
			$sql .= (' GROUP BY ' . $this->_group_by);
		}
		if (! empty ( $this->_having )) {
			$sql .= (' HAVING ' . $this->_having);
		}
		if ($is_count != true) {
			if (! empty ( $this->_order_by )) {
				$sql .= (' ORDER BY ' . $this->_order_by);
			}
			if (! empty ( $this->_limit )) {
				$sql .= (' LIMIT ' . $this->_limit);
			}
			if (! empty ( $this->_rand_limit )) {
				$sql .= $this->_rand_limit;
			}
		}
		return $sql;
	}
	
	function from($val) {
		if (! _g ( 'validate' )->enl_el ( $val )) {
			$val = null;
		}
		$this->_from = $this->table ( $val );
		return $this->_from;
	}
	
	function where_op($_key, $op_symbol = '-', $value = null, $symbol = '>', $op_value = null, $link = 'AND') {
		$link = strtoupper ( $link );
		if (! empty ( $_key )) {
			$field = $this->standard_field ( $_key );
			$where = ("(('{$value}' {$op_symbol} {$field}) {$symbol} '{$op_value}')");
			if (! empty ( $this->_where )) {
				$this->_where .= (" {$link} " . $where);
			} else {
				$this->_where = $where;
			}
		}
	}
	
	function where($_key, $_value = null, $symbol = '=', $link = 'AND') {
		$link = strtoupper ( $link );
		if (my_is_array ( $_key )) {
			foreach ( $_key as $k => $v ) {
				$this->where ( $k, $v, $symbol, $link );
			}
		} else {
			if (! empty ( $_key )) {
				$field = $this->standard_field ( $_key );
				$where = ("{$field} {$symbol} '" . $_value . "'");
				if (! empty ( $this->_where )) {
					$this->_where .= (" {$link} " . $where);
				} else {
					$this->_where = $where;
				}
			}
		}
	}
	
	function where_in($_key, $_value = null, $link = 'AND') {
		$link = strtoupper ( $link );
		$valStr = null;
		$field = $this->standard_field ( $_key );
		if (my_is_array ( $_value )) {
			$valArr = array ();
			foreach ( $_value as $k => $v ) {
				$valArr [] = ("'" . $v . "'");
			}
			$valStr = ("{$field} IN(" . implode ( ",", $valArr ) . ")");
		} else {
			if (! empty ( $_key )) {
				$valStr = ("{$field} IN('" . $_value . "')");
			}
		}
		if (! empty ( $this->_where )) {
			$this->_where .= (" {$link} " . $valStr);
		} else {
			$this->_where = $valStr;
		}
	}
	
	function where_not_in($_key, $_value = null, $link = 'AND') {
		$link = strtoupper ( $link );
		$valStr = null;
		$field = $this->standard_field ( $_key );
		if (my_is_array ( $_value )) {
			$valArr = array ();
			foreach ( $_value as $k => $v ) {
				$valArr [] = ("'" . $v . "'");
			}
			$valStr = ("{$field} NOT IN(" . implode ( ",", $valArr ) . ")");
		} else {
			if (! empty ( $_key )) {
				$valStr = ("{$field} NOT IN('" . $_value . "')");
			}
		}
		if (! empty ( $this->_where )) {
			$this->_where .= (" {$link} " . $valStr);
		} else {
			$this->_where = $valStr;
		}
	}
	
	function where_like($_key, $_value = null, $link = 'AND') {
		$link = strtoupper ( $link );
		if (my_is_array ( $_key )) {
			foreach ( $_key as $k => $v ) {
				$this->where_like ( $k, $v, $link );
			}
		} else {
			if (! empty ( $_key )) {
				$field = $this->standard_field ( $_key );
				$where = ("{$field} LIKE '%" . $_value . "%'");
				if (! empty ( $this->_where )) {
					$this->_where .= (" {$link} " . $where);
				} else {
					$this->_where = $where;
				}
			}
		}
	}
	
	function where_regexp($_key, $_value = null, $isStrict = false, $link = 'AND') {
		$link = strtoupper ( $link );
		$type = ($isStrict != true) ? 'REGEXP' : 'REGEXP BINARY';
		if (my_is_array ( $_key )) {
			foreach ( $_key as $k => $v ) {
				$this->where_regexp ( $k, $v, $link );
			}
		} else {
			if (! empty ( $_key )) {
				$field = $this->standard_field ( $_key );
				$where = ("{$field} " . $type . " ('" . $_value . "')");
				if (! empty ( $this->_where )) {
					$this->_where .= (" {$link} " . $where);
				} else {
					$this->_where = $where;
				}
			}
		}
	}
	
	function where_not_regexp($_key, $_value = null, $isStrict = false, $link = 'AND') {
		$link = strtoupper ( $link );
		$type = ($isStrict != true) ? 'NOT REGEXP' : 'NOT REGEXP BINARY';
		if (my_is_array ( $_key )) {
			foreach ( $_key as $k => $v ) {
				$this->where_not_regexp ( $k, $v, $link );
			}
		} else {
			if (! empty ( $_key )) {
				$field = $this->standard_field ( $_key );
				$where = ("{$field} " . $type . " ('" . $_value . "')");
				if (! empty ( $this->_where )) {
					$this->_where .= (" {$link} " . $where);
				} else {
					$this->_where = $where;
				}
			}
		}
	}
	
	
	function join($table1, $key1, $table2, $key2, $jointype = 'JOIN') {
		preg_match ( "/^([a-z]+)\.([a-z0-9_]+)$/i", $key1, $match1 );
		preg_match ( "/^([a-z]+)\.([a-z0-9_]+)$/i", $key2, $match2 );
		
		$table1 = $this->table ( $table1 );
		$table2 = $this->table ( $table2 );
		
		$asname1 = my_array_value ( 1, $match1 );
		$asname2 = my_array_value ( 1, $match2 );
		
		$key1 = my_array_value ( 2, $match1 );
		$key2 = my_array_value ( 2, $match2 );
		
		$this->_joins = sprintf ( " %s AS `%s` %s %s AS `%s` ON (`%s`.`%s` = `%s`.`%s`) ", $table1, $asname1, strtoupper ( $jointype ), $table2, $asname2, $asname1, $key1, $asname2, $key2 );
	}
	
	function join_together($key1, $table, $key2, $jointype = 'JOIN') {
		preg_match ( "/^([a-z]+)\.([a-z0-9_]+)$/i", $key1, $match1 );
		preg_match ( "/^([a-z]+)\.([a-z0-9_]+)$/i", $key2, $match2 );
		
		$table = $this->table ( $table );
		
		$asname1 = $match1 [1];
		$asname2 = $match2 [1];
		
		$key1 = my_array_value ( 2, $match1 );
		$key2 = my_array_value ( 2, $match2 );
		
		$this->_joins .= sprintf ( " %s %s AS `%s` ON (`%s`.`%s` = `%s`.`%s`) ", strtoupper ( $jointype ), $table, $asname2, $asname1, $key1, $asname2, $key2 );
	}
	
	function order_by($_key = null, $order = 'ASC') {
		if (my_is_array ( $_key )) {
			foreach ( $_key as $k => $v ) {
				$this->order_by ( $k, $v );
			}
		} else {
			$order = strtoupper ( $order );
			$field = $this->standard_field ( $_key );
			$valStr = "{$field} {$order}";
			if (! empty ( $this->_order_by )) {
				$this->_order_by .= ("," . $valStr);
			} else {
				$this->_order_by = $valStr;
			}
		}
	}
	
	function limit($start = 0, $offset = 10) {
		$this->_limit = " {$start}, {$offset}";
	}
	
	function rand_limit($start = 0, $offset = 0) {
		$limits = ($offset < 1 ? $start : ($start . ',' . $offset));
		$this->_rand_limit = " ORDER BY RAND() LIMIT {$limits}";
	}
	
	function group_by($_key = null) {
		if(my_is_array($_key)){
			foreach ($_key as $k){
				$this->group_by($k);
			}
		}else{
			$field = $this->standard_field ( $_key );
			if (! empty ( $this->_order_by )) {
				$this->_group_by .= ", {$field}";
			} else {
				$this->_group_by = "{$field}";
			}
		}
	}
	
	function distinct($_key) {
		$field = $this->standard_field ( $_key );
		$this->_distinct = ",COUNT(DISTINCT {$field})";
	}
	
	function standard_field($_key) {
		$this->validate_field ( $_key );
		if (preg_match ( "/^([a-z]+)\.([a-z0-9_]+)$/i", $_key, $matchs )) {
			$n1 = my_array_value ( 1, $matchs );
			$n2 = my_array_value ( 2, $matchs );
			$valStr = ('`' . $n1 . '`.`' . $n2 . '`');
		} else {
			if (! preg_match ( "/^([a-z]+)\.([a-z0-9_]+)\s+(as)\s+([a-z0-9_]+)$/i", $_key, $matchs )) {
				$valStr = '`' . $_key . '`';
			} else {
				$n1 = my_array_value ( 1, $matchs );
				$n2 = my_array_value ( 2, $matchs );
				$n3 = my_array_value ( 3, $matchs );
				$n4 = my_array_value ( 4, $matchs );
				$valStr = ('`' . $n1 . '`.`' . $n2 . '`' . ' AS ' . '`' . $n4 . '`');
			}
		}
		return $valStr;
	}
	
	function regexp($val) {
		$val = ('(.*' . $val . '.*)$');
		return $val;
	}
	
	function set_sql($val) {
		$this->_set_sql = $val;
	}
	
	function set_where($val, $link = 'AND') {
		$val = trim ( $val );
		if (empty ( $val )) {
			return null;
		}
		$link = strtoupper ( $link );
		if (! empty ( $this->_where )) {
			$this->_where .= (" {$link} {$val}");
		} else {
			$this->_where .= $val;
		}
	}
	
	function set($_key, $_val = null) {
		if (my_is_array ( $_key )) {
			foreach ( $_key as $k => $v ) {
				$this->set ( $k, $v );
			}
		} else {
			$this->validate_field ( $_key );
			$this->_set_value [$_key] = $_val;
		}
	}
	
	function set_insert() {
		$fields = array ();
		$values = array ();
		foreach ( $this->_set_value as $k => $v ) {
			$fields [] = ('`' . $k . '`');
			$values [] = "'{$v}'";
		}
		$fields = implode ( ',', $fields );
		$values = implode ( ',', $values );
		$this->_set_value = array (
				$fields,
				$values 
		);
	}
	
	function set_update() {
		$values = array ();
		foreach ( $this->_set_value as $k => $v ) {
			$values [] = ("`{$k}` = '" . $v . "'");
		}
		$values = implode ( ',', $values );
		$this->_set_value = $values;
	}
	
	function trans_rollback_end() {
		$this->trans_rollback ();
		$this->trans_end ();
	}
	
	function trans_commit_end() {
		$this->trans_commit ();
		$this->trans_end ();
	}
	
	function clear_sql() {
		$this->_from = null;
		$this->_distinct = null;
		$this->_joins = null;
		$this->_where = null;
		$this->_set_value = null;
		$this->_group_by = null;
		$this->_having = null;
		$this->_order_by = null;
		$this->_limit = null;
		$this->_rand_limit = null;
		$this->_set_sql = null;
	}
	
	function __destruct() {
		$this->clear_sql ();
	}
}
?>