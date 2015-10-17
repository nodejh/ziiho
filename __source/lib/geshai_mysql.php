<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_mysql {
	
	
	public $dns = null;
	
	public $db_conn;
	
	public $result;
	
	public $status;
	
	public $sql;
	
	public $row;
	
	public $is_debug = false;
	
	public $bulletin = false;
	
	public $show_error = true;
	
	public $is_error = false;
	public function __construct(&$dns) {
		$this->dns = $dns;
		$this->db_conn = $dns ['conn'];
		$this->connect ();
	}
	function geshai_mysql(&$dns) {
		$this->__construct ( $dns );
	}
	
	
	public function connect() {
		if ($this->db_conn == 1) {
			
			if (! $this->db_conn = mysql_pconnect ( $this->dns ['host'], $this->dns ['user'], $this->dns ['password'] )) {
				$this->show_error ? $this->show_error ( '错误信息提示', '数据库连接失败' ) : '';
			}
		} else {
			
			if (! $this->db_conn = mysql_connect ( $this->dns ['host'], $this->dns ['user'], $this->dns ['password'] )) {
				$this->show_error ? $this->show_error ( '错误信息提示', '数据库连接失败' ) : '';
			}
		}
		
		if (! $this->select_db ( $this->dns ['database'] )) {
			if ($this->show_error) {
				$this->show_error ( '数据库不可用：' . $this->dns ['database'], $this->dns ['database'] );
			}
		}
		$this->execute ( "SET NAMES '" . $this->dns ['charset'] . "',character_set_client=binary;" );
	}
	
	public function select_db($db_database) {
		return mysql_select_db ( $db_database, $this->db_conn );
	}
	
	public function create_database($database_name) {
		$sql = 'CREATE DATABASE ' . $database_name;
		return $this->execute ( $sql );
	}
	
	public function show_databases() {
		$this->execute ( 'SHOW DATABASES' );
		$data = array (
				$this->db_num_rows (),
				$this->result 
		);
		/*
		 * while ($row = $this->fetch_array($this->result)) { echo $row['database']; }
		 */
		return $data;
	}
	
	public function get_database() {
		$rsPtr = mysql_list_dbs ( $this->db_conn );
		$i = 0;
		$cnt = mysql_num_rows ( $rsPtr );
		while ( $i < $cnt ) {
			$rs [] = mysql_db_name ( $rsPtr, $i );
			$i ++;
		}
		return $rs;
	}
	
	public function drop_table($table) {
		$table = $this->table ( $table );
		$s = $this->execute ( "DROP TABLE IF EXISTS {$table}" );
		return $s;
	}
	
	public function get_table() {
		$s = $this->execute ( 'SHOW TABLES' );
		if (! $this->is_success ( $s )) {
			return null;
		}
		return $this->result;
	}
	
	public function find_table($table) {
		if (empty ( $table )) {
			return null;
		}
		$table = $this->table ( $table );
		$s = $this->execute ( "SHOW TABLES LIKE '%{$table}%'" );
		if (! $this->is_success ( $s )) {
			return null;
		}
		$result = $this->db_num_rows ();
		return $result;
	}
	
	public function read_table_status() {
		$s = $this->execute ( "SHOW TABLE STATUS FROM " . $this->dns ['database'] );
		return $this->is_success ( $s );
	}
	
	public function table_structure($table) {
		$table = $this->table ( $table );
		$s = $this->execute ( "SHOW CREATE TABLE {$table}" );
		if (! $this->is_success ( $s )) {
			return null;
		}
		$result = $this->fetch_array ();
		return $result [1];
	}
	
	public function table($table, $isdbadd = true, $isclearpre = false) {
		$pre = trim ( $this->dns ['tablepre'] );
		$table = trim ( $table );
		
		
		$sublen = - (strlen ( $table ) - strlen ( $pre ));
		$clear_pre_table = substr ( $table, $sublen );
		
		
		if ($isdbadd == true) {
			if ($isclearpre != true) {
				$table = ('`' . $this->dns ['database'] . '`.`' . $pre . $table . '`');
			} else {
				$table = $clear_pre_table;
			}
		} else {
			if ($isclearpre != true) {
				$table = $pre . $table;
			} else {
				$table = $clear_pre_table;
			}
		}
		return $table;
	}
	
	public function replace_table_pre2str($str) {
		$str = preg_replace ( "/\`\#\@\@\_\_([a-z-A-Z-0-9_]+)\`/", $this->replace_table_pre2str_strip ( "\\1" ), $str );
		return $str;
	}
	public function replace_table_pre2str_strip($table, $isadd = true) {
		$str = trim ( $this->dns ['tablepre'] ) . trim ( $table );
		if ($isadd == true) {
			$str = ('`' . $str . '`');
		}
		return $str;
	}
	
	public function get_db_size() {
		$sql = "SELECT SUM(DATA_LENGTH) + SUM(INDEX_LENGTH) FROM `INFORMATION_SCHEMA`.`TABLES` WHERE `TABLE_SCHEMA`='" . $this->dns ['database'] . "'";
		$s = $this->execute ( $sql );
		if (! $this->is_success ( $s )) {
			return null;
		}
		$result = $this->fetch_array ();
		return $result [0];
	}
	
	public function get_table_size($table, $ispre = false) {
		if (empty ( $table )) {
			return null;
		}
		if ($ispre == true) {
			$table = $this->table ( $table, false );
		}
		$sql = "SELECT * FROM `INFORMATION_SCHEMA`.`TABLES` WHERE `INFORMATION_SCHEMA`.`TABLES`.`TABLE_SCHEMA` = '" . $this->dns ['database'] . "' AND `INFORMATION_SCHEMA`.`TABLES`.`TABLE_NAME` = '" . $table . "'";
		$s = $this->execute ( $sql );
		if (! $this->is_success ( $s )) {
			return null;
		}
		$result = $this->fetch_array ();
		$result = ($result ['DATA_LENGTH'] + $result ['INDEX_LENGTH']);
		return $result;
	}
	
	public function execute($sql) {
		if (empty ( $sql )) {
			$this->status = $this->dns ['error'];
			$this->show_error ( 'SQL语句错误：', 'SQL查询语句为空' );
		}
		$this->sql = $sql;
		$result = mysql_query ( $this->sql, $this->db_conn );
		if (! $result) {
			$this->status = $this->dns ['error'];
			
			
			if ($this->show_error) {
				$this->show_error ( '错误SQL语句：', $this->sql );
			}
		} else {
			$this->status = $this->dns ['success'];
			$this->result = $result;
		}
		return $this->status;
	}
	
	function get_status() {
		return $this->status;
	}
	
	function is_success($s = null) {
		$str = (func_num_args () < 1 ? $this->status : $s);
		if ($str == $this->dns ['error']) {
			return false;
		}
		return true;
	}
	
	function is_result($r = null) {
		$r = (func_num_args () < 1 ? $this->result : $r);
		return is_resource ( $r );
	}
	
	public function mysql_result_li() {
		if ($this->is_result ()) {
			return mysql_result ( $this->result );
		}
	}
	
	public function fetch_array($result = null) {
		$r = (func_num_args () < 1 ? $this->result : $result);
		if ($this->is_result ( $r )) {
			return mysql_fetch_array ( $r );
		}
		return null;
	}
	
	public function fetch_assoc() {
		if ($this->is_result ()) {
			return mysql_fetch_assoc ( $this->result );
		}
	}
	
	public function fetch_row() {
		if ($this->is_result ()) {
			return mysql_fetch_row ( $this->result );
		}
	}
	
	public function fetch_object() {
		if ($this->is_result ()) {
			return mysql_fetch_object ( $this->result );
		}
	}
	
	public function real_escape_string($str) {
		return mysql_real_escape_string ( $str, $this->db_conn );
	}
	
	public function insert_id() {
		return mysql_insert_id ();
	}
	
	public function db_data_seek($id) {
		if ($id > 0) {
			$id = $id - 1;
		}
		if (! mysql_data_seek ( $this->result, $id )) {
			$this->show_error ( 'SQL语句有误：', '指定的数据为空' );
		}
		return $this->result;
	}
	
	public function db_num_rows() {
		if (! $this->is_result ()) {
			if ($this->show_error) {
				$this->show_error ( 'SQL语句错误', '暂时为空，没有任何内容！' );
			}
		} else {
			return mysql_num_rows ( $this->result );
		}
	}
	
	public function db_affected_rows() {
		return mysql_affected_rows ( $this->db_conn );
	}
	
	public function get_field($table = null) {
		$f = array ();
		if (func_num_args () >= 1) {
			if (empty ( $table )) {
				return $f;
			}
			$sql = "SELECT * FROM {$table}";
			$this->execute ( $sql );
		}
		if (! $this->is_result ()) {
			return $f;
		}
		$total = mysql_num_fields ( $this->result );
		for($i = 0; $i < $total; $i ++) {
			$rs = mysql_fetch_field ( $this->result, $i );
			$f [] = $rs->name;
		}
		return $f;
	}
	
	public function trans_begin() {
		mysql_query ( "BEGIN", $this->db_conn );
	}
	
	public function trans_commit() {
		mysql_query ( "COMMIT", $this->db_conn );
	}
	
	public function trans_rollback() {
		mysql_query ( "ROLLBACK", $this->db_conn );
	}
	
	public function trans_end() {
		mysql_query ( "END", $this->db_conn );
	}
	
	public function lock_table($table, $op = 'WRITE') {
		$table = $this->table ( $table );
		$s = $this->execute ( "LOCK TABLE {$table} " . $op );
		return $this->is_success ( $s );
	}
	
	public function unlock_table() {
		$s = $this->execute ( "UNLOCK TABLE" );
		return $this->is_success ( $s );
	}
	
	public function lock_db($op = 'WRITE') {
		$s = $this->execute ( "LOCK TABLES " . $this->dns ['database'] . ' ' . $op );
		return $this->is_success ( $s );
	}
	
	public function unlock_db() {
		$s = $this->execute ( "UNLOCK TABLES" );
		return $this->is_success ( $s );
	}
	
	public function free_result() {
		if (is_resource ( $this->result )) {
			mysql_free_result ( $this->result );
		}
	}
	
	public function close() {
		if ($this->db_conn) {
			mysql_close ( $this->db_conn );
		}
	}
	
	public function __destruct() {
		$this->free_result ();
		$this->close ();
	}
	
	function validate_field($field) {
		if (preg_match ( "/[\'\\\"\<\>]+/", $field )) {
			return null;
		}
		return $field;
	}
	
	function inject_check($sql) {
		$check = eregi ( 'select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql );
		if ($check) {
			return null;
		} else {
			return $sql;
		}
	}
	
	public function server($num = null) {
		switch ($num) {
			case 1:
				
				$v = mysql_get_server_info ( $this->db_conn );
				break;
			case 2:
				
				$v = mysql_get_host_info ( $this->db_conn );
				break;
			case 3:
				
				$v = mysql_get_proto_info ( $this->db_conn );
				break;
			default:
				
				$v = mysql_get_client_info ();
				break;
		}
		return $v;
	}
	
	public function version($t = null) {
		$info = $this->server ( $t );
		$Arr = explode ( '.', trim ( $info ) );
		return floatval ( $Arr [0] . '.' . $Arr [1] );
	}
	
	public function version_type() {
		$v = $this->version ();
		$v = ($v < 1 ? $this->version ( 1 ) : $v);
		if ($v >= 4.1) {
			$storageEngine = ("ENGINE=MyISAM DEFAULT CHARSET=" . $this->dns ['charset']);
		} else {
			$storageEngine = "TYPE=MyISAM";
		}
		return array (
				$v,
				$storageEngine 
		);
	}
	
	public function show_error($message = "", $sql = "") {
		if (! $sql) {
			echo '<font color="red">' . $message . '</font><br />';
		} else {
			echo '<fieldset>';
			echo '<legend>错误信息提示:</legend><br />';
			echo '<div style="font-size:14px; clear:both; font-family:Verdana, Arial, Helvetica, sans-serif;">';
			echo '<div style="height:20px; background:#000000; border:1px #000000 solid">';
			echo '<font color="white">错误号：12142</font>';
			echo '</div><br />';
			echo '错误原因：' . mysql_error () . '<br /><br />';
			echo '<div style="height:20px; background:#FF0000; border:1px #FF0000 solid">';
			echo '<font color="white">' . $message . '</font>';
			echo '</div>';
			echo '<font color="red"><pre>' . $sql . '</pre></font>';
			$ip = getip ();
			if ($this->bulletin) {
				$time = date ( "Y-m-d H:i:s" );
				$message = $message . "\r\n" . $this->sql . "\r\n客户IP:" . $ip . "\r\n时间 :" . $time . "\r\n\r\n";
				$server_date = date ( "Y-m-d" );
				$dir = $this->getfilepath () . '/log/sql_error/';
				$filename = $server_date . '.txt';
				$file_path = $dir . $filename;
				$error_content = $message;
				$file = $dir; /* 设置文件保存目录 */
   			/*建立文件夹*/
   											if (! file_exists ( $file )) {
					if (! mkdir ( $file, 0777 )) {
						/* 默认的 mode 是 0777，意味着最大可能的访问权 */
						echo '创建错误日志文件夹失败';
					}
				}
				
				/* 建立txt日期文件 */
				if (! file_exists ( $file_path )) {
					
					fopen ( $file_path, "w+" );
					/* 首先要确定文件存在并且可写 */
					if (is_writable ( $file_path )) {
						/* 使用添加模式打开$filename，文件指针将会在文件的开头 */
						if (! $handle = fopen ( $file_path, 'a' )) {
							echo '不能打开文件' . $filename;
							exit ();
						}
						/* 将$somecontent写入到我们打开的文件中 */
						if (! fwrite ( $handle, $error_content )) {
							echo '不能写入到文件 ' . $filename;
							exit ();
						}
						/* 关闭文件 */
						fclose ( $handle );
					} else {
						echo '文件' . $filename . '不可写';
					}
				} else {
					/* 首先要确定文件存在并且可写 */
					if (is_writable ( $file_path )) {
						/* 使用添加模式打开$filename，文件指针将会在文件的开头 */
						if (! $handle = fopen ( $file_path, 'a' )) {
							echo '不能打开文件' . $filename;
							exit ();
						}
						/* 将$somecontent写入到我们打开的文件中 */
						if (! fwrite ( $handle, $error_content )) {
							echo '不能写入到文件' . $filename;
							exit ();
						}
						/* 关闭文件 */
						fclose ( $handle );
					} else {
						echo '文件' . $filename . '不可写';
					}
				}
			}
			echo '<br />';
			if ($this->is_error) {
				exit ();
			}
		}
		echo '</div>';
		echo '</fieldset><br />';
	}
}
?>