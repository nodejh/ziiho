<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_file {
	function __construct() {
	}
	function geshai_file() {
		$this->__construct ();
	}
	
	function nname($v) {
		$ext = my_end ( my_explode ( '.', $v ) );
		$nameStr = _g ( 'value' )->randchar ( 16 ) . '-' . _g ( 'cfg>time' );
		return ($nameStr . '.' . $ext);
	}
	
	function isfile($v){
		if(strlen($v) < 1){
			return false;
		}
		return is_file($v);
	}
	
	function read($dir, $fname, $def = null) {
		if (strlen ( $dir ) < 1 || strlen ( $fname ) < 1) {
			return $def;
		}
		$dir = $this->clean_dir ( $dir );
		$fpath = ($dir . '/' . $fname);
		if (! is_file ( $fpath )) {
			return $def;
		}
		if (! @$fp = fopen ( $fpath, 'r' )) {
			return $def;
		}
		if (flock ( $fp, LOCK_SH | LOCK_NB )) {
			$cLen = filesize ( $fpath );
			if ($cLen < 1) {
				$data = $def;
			} else {
				$data = fread ( $fp, $cLen );
			}
			flock ( $fp, LOCK_UN );
		} else {
			$data = $def;
		}
		fclose ( $fp );
		return $data;
	}
	function write($dir, $fname, $content, $mode = 'w') {
		if (strlen ( $dir ) < 1 || strlen ( $fname ) < 1) {
			return false;
		}
		$dir = $this->clean_dir ( $dir );
		if (! is_dir ( $dir )) {
			return false;
		}
		$name = $dir . '/' . $fname;
		if (! $fp = fopen ( $name, $mode )) {
			return false;
		}
		$s = flock ( $fp, LOCK_EX | LOCK_NB );
		if ($s) {
			fwrite ( $fp, $content );
			flock ( $fp, LOCK_UN );
		}
		fclose ( $fp );
		return $s;
	}
	function delete($fname) {
		if (strlen ( $fname ) < 1) {
			return - 1;
		}
		$fname = $this->clean_dir ( $fname );
		if (! is_file ( $fname )) {
			return - 2;
		}
		return unlink ( $fname );
	}
	function uploadfile($v = null){
		if(_g('validate')->em($v)){
			return null;
		}
		$path = sdir(':uploadfile');
		$path = ($path . '/' . $v);
		return $path;
	}
	/* dir */
	function clean_dir($str) {
		$str = str_replace ('\\', '/', $str);
		if ($str == '/') {
			return $str;
		}
		if (substr ($str, -1, 1) == '/') {
			$str = substr ($str, 0, -1);
		}
		return $str;
	}
	function isdir($v){
		if(strlen($v) < 1){
			return false;
		}
		return is_dir($v);
	}
	function create_dir($root, $dir) {
		if (strlen ( $root ) < 1 || strlen ( $dir ) < 1) {
			return - 1;
		}
		$root = $this->clean_dir ( $root );
		$dir = $this->clean_dir ( $dir );
		if (! is_dir ( $root )) {
			return - 1;
		}
		if (! chmod ( $root, 0777 )) {
			return false;
		}
		$dirSplit = explode ( '/', $dir );
		for($i = 0; $i < count ( $dirSplit ); $i ++) {
			$str .= '/' . $dirSplit [$i];
			$cDir = $root . $str;
			if (! is_dir ( $cDir )) {
				$s = mkdir ( $cDir, 0777 );
				if (! $s) {
					return false;
				}
			}
		}
		return true;
	}
	function delete_dir($root, $dir) {
		
	}
}
?>