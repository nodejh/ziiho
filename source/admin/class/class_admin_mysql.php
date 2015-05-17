<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_mysql extends class_model {
	
	/* 备份类型,0=结构,1=数据 */
	public $btype = 1;
	/* 文件扩展名 */
	public $bext = '.sql';
	/* 备份后的表名 */
	public $btable = NULL;
	/* 备份目录 */
	public $bdir = NULL;
	/* 删除数据表文件名 */
	public $bunfilename = NULL;
	/* 备份文件名 */
	public $bfilename = NULL;
	/* 备份大小 */
	public $bsize = 2048;
	/* 显示目录 */
	public $show_sqldir = NULL;
	/* 保存目录 */
	public $sqldir = NULL;
	/* 换行符 */
	public $ds = "\n";
	/* 每条sql语句的结尾符 */
	public $sqlEnd = ';';
	/* 卷数 */
	public $splitnum = 1;
	
	/* 构造函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_admin_mysql() {
		$this->__construct ();
	}
	
	/* 设置备份目录 */
	function set_backup_dir() {
		global $_G;
		/* 备份根目录 */
		$rootdir = $_G ['app'] ['path_data'];
		/* 备份目录 */
		$dir = NULL;
		if (! empty ( $this->bdir )) {
			$dir = $this->bdir . '/';
		}
		/* 备份目录 */
		$dirname = 'backup/' . $dir;
		/* 可视化的目录 */
		$this->show_sqldir = ($_G ['web'] ['datapath']) . $dirname;
		/* 不存在则创建目录 */
		if (create_dir ( $rootdir, $dirname ) < 1) {
			showmsg ( lang ( 'admin:database_backup_dir_noexist', $this->show_sqldir ) );
		}
		$this->sqldir = $rootdir . $dirname;
	}
	/*
	 * 数据库备份 参数：$tablename=表名(数组)
	 */
	function backup($tables) {
		if (! is_array ( $tables ) || empty ( $tables )) {
			return NULL;
		}
		/* 设置备份目录 */
		$this->set_backup_dir ();
		foreach ( $tables as $tablename ) {
			/* 设置文件表名 */
			$this->btable = $this->db->dns ['tablepre_mark'] . $tablename;
			/* 表结构信息 */
			if ($this->btype != 1) {
				$_sInfo = $this->_insert_table_structure ( $tablename );
				if (! $this->_write_file ( $_sInfo, $this->bfilename . $this->bext )) {
					/* 备份数据表结构失败 */
				}
				unset ( $_sInfo );
				
				$this->bunfilename = trim ( $this->bunfilename );
				if (! empty ( $this->bunfilename )) {
					$_dropInfo = $this->_insert_table_drop ( $tablename );
					if (! $this->_write_file ( $_dropInfo, $this->bunfilename . $this->bext )) {
						/* 备份删除数据表失败 */
					}
					unset ( $_dropInfo );
				}
			}
			/* 数据文件名 */
			$filename = $this->bfilename . '_data';
			/* sql内容变量 */
			$sql = NULL;
			/* 获取表数据 */
			$this->db->_select ( $this->db->_db_table ( $tablename ) );
			/* 字段数量 */
			$num_fields = $this->db->num_fields ( $this->db->_db_table ( $tablename ) );
			/* 循环每条记录 */
			while ( $record = $this->db->fetch_array () ) {
				/* 单条记录 */
				$sql .= $this->_insert_record ( $tablename, $num_fields, $record );
				/* 如果大于分卷大小，则写入文件 */
				if (strlen ( $sql ) >= op2num ( $this->bsize, 1024, 3 )) {
					$file = $filename . '_v' . $this->splitnum . $this->bext;
					if (! $this->_write_file ( $sql, $file )) {
						return NULL;
					}
					/* 下一个分卷 */
					$this->splitnum ++;
					/* 重置sql内容变量,重新统计大小 */
					$sql = NULL;
				}
			}
			/* sql大小不够分卷大小 */
			if (! empty ( $sql )) {
				$filename .= '_v' . $this->splitnum . $this->bext;
				if (! $this->_write_file ( $sql, $filename )) {
					return NULL;
				}
			}
		}
		return array (
				$this->show_sqldir,
				$this->splitnum 
		);
	}
	/* 插入数据库备份基础信息 */
	function _retrieve() {
		$value = '';
		$value .= '/*' . $this->ds;
		$value .= 'Date: ' . date ( 'Y/m/d H:i:s' ) . $this->ds;
		$value .= '*/' . $this->ds;
		$value .= $this->ds;
		return $value;
	}
	/* 插入表删除 */
	function _insert_table_drop($table) {
		$sql = "DROP TABLE IF EXISTS `" . $this->btable . '`' . $this->sqlEnd . $this->ds;
		return $sql;
	}
	/* 插入表结构 */
	function _insert_table_structure($table) {
		/* 表结构 */
		$Sinfo = $this->db->_show_table_structure ( $table );
		$Sstr = preg_replace ( "/CREATE\s+TABLE\s+`([a-zA-Z0-9_]+)`/i", '`' . $this->btable . '`', $Sinfo );
		
		$sql = '';
		/* 注释信息 */
		if (! is_file ( $this->sqldir . $this->bfilename . $this->bext )) {
			$sql .= $this->_retrieve ();
		}
		/* 插入表结构 */
		$sql .= '-- ----------------------------' . $this->ds;
		$sql .= '-- Table structure for ' . $this->btable . $this->ds;
		$sql .= '-- ----------------------------' . $this->ds;
		/* 如果存在则删除表 */
		$sql .= "DROP TABLE IF EXISTS `" . $this->btable . '`' . $this->sqlEnd . $this->ds;
		$sql .= "CREATE TABLE " . $Sstr;
		$sql .= $this->sqlEnd;
		/* 设置默认存储引擎 */
		$sql = preg_replace ( "/\)\s+([a-zA-Z0-9_]+)\=(.+?);/", ") TYPE=MyISAM;", $sql );
		$sql .= $this->ds . $this->ds;
		/*
		 * $sql .= '-- ----------------------------'.$this->ds; $sql .= '-- Records '.$this->btable.$this->ds; $sql .= '-- ----------------------------'.$this->ds.$this->ds;
		 */
		return $sql;
	}
	/* 插入单条记录 */
	function _insert_record($table, $num_fields, $record) {
		/* sql字段逗号分割 */
		$comma = '';
		$sqlstr .= "INSERT INTO `" . $this->btable . "` VALUES(";
		/* 循环每个子段下面的内容 */
		for($i = 0; $i < array_number ( $num_fields ); $i ++) {
			$sqlstr .= ($comma . "'" . $this->db->_real_escape_string ( $record [$i] ) . "'");
			$comma = ",";
		}
		$sqlstr .= ");" . $this->ds;
		return $sqlstr;
	}
	/* 写入文件 */
	function _write_file($sql, $filename) {
		$filestr = $this->sqldir . $filename;
		$re = true;
		if (! $fp = fopen ( $filestr, "a+" )) {
			$re = false;
			echo "打开文件失败！";
		}
		if (! fwrite ( $fp, $sql )) {
			$re = false;
			echo "写入文件失败，请文件是否可写";
		}
		if (! fclose ( $fp )) {
			$re = false;
			echo "关闭文件失败！";
		}
		return $re;
	}
	/**
	 * 导入备份数据
	 */
	function restore($sqlfile, $sqlType = NULL) {
		/* 检测文件是否存在 */
		if (! is_file ( $sqlfile )) {
			exit ( "文件不存在！请检查" );
		}
		if (filesize ( $sqlfile ) < 1) {
			return true;
		}
		/* 锁定数据库 */
		$this->db->lock_db ();
		
		$result = $this->_import ( $sqlfile, $sqlType );
		return $result;
	}
	
	/* 将sql导入到数据库(普通导入) */
	function _import($sqlfile, $sqlType = NULL) {
		$f = fopen ( $sqlfile, "r" );
		/* 缓冲变量 */
		$SqlStr = '';
		while ( ! feof ( $f ) ) {
			/* 读取每一行sql */
			$line = trim ( fgets ( $f ) );
			/* 如果包含'-- '等注释，或为空白行，则跳过 */
			if ($line == '' || preg_match ( "/\-\-\s+/", $line, $match )) {
				continue;
			}
			$SqlStr .= $line;
			/* 如果结尾包含';'(即为一个完整的sql语句) */
			if (substr ( $line, - 1 ) == ';') {
				if ($sqlType == 'insert') {
					if (preg_match ( "/INSERT\s+INTO\s+\`\#\@\@\_\_([a-zA-Z0-9_]+)\`/", $SqlStr, $match )) {
						$SqlStr = $this->db->_replace_tablepre ( $SqlStr );
						if (! $this->_runsql ( $SqlStr )) {
							return false;
						}
						/* 清空缓冲变量 */
						$SqlStr = '';
					}
				} else if ($sqlType == 'create') {
					if (preg_match ( "/;/", $line, $match ) || preg_match ( "/TYPE=MyISAM;/", $line, $matchType )) {
						if (preg_match ( "/TYPE=MyISAM;/", $SqlStr, $match )) {
							$mysqlVersionInfo = $this->db->mysql_version_type ();
							if ($mysqlVersionInfo [0] >= 4.1) {
								$SqlStr = preg_replace ( "/TYPE=MyISAM;/", $mysqlVersionInfo [1] . ';', $SqlStr );
							}
							$SqlStr = $this->db->_replace_tablepre ( $SqlStr );
							if (! $this->_runsql ( $SqlStr )) {
								return false;
							}
						} else {
							$SqlStr = $this->db->_replace_tablepre ( $SqlStr );
							if (! $this->_runsql ( $SqlStr )) {
								return false;
							}
						}
						/* 清空缓冲变量 */
						$SqlStr = '';
					}
				} else if ($sqlType == 'droptable') {
					if (preg_match ( "/;/", $line, $match ) && preg_match ( "/^DROP\s+TABLE\s+IF\s+EXISTS\s+\`\#\@\@\_\_([a-zA-Z0-9_]+)\`\;/i", $SqlStr, $matchDT )) {
						$SqlStr = $this->db->_replace_tablepre ( $SqlStr );
						if (! $this->_runsql ( $SqlStr )) {
							return false;
						}
						/* 清空缓冲变量 */
						$SqlStr = '';
					}
				}
			}
		}
		fclose ( $f );
		return true;
	}
	/* 运行sql */
	function _runsql($sql) {
		$sql = str_replace ( "\n", '', trim ( $sql ) );
		if ($this->db->_query ( $sql ) != $this->db->zq) {
			return false;
		}
		return true;
	}
	/* 析构自动解开数据库 */
	function __destruct() {
		$this->db->unlock_db ();
	}
}