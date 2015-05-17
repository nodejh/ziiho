<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_module {
	public $current_name = null;
	
	public $_triggers = array ();
	function __construct() {
	}
	function geshai_module() {
		$this->__construct ();
	}
	
	
	function cname($m = null) {
		if (func_num_args () < 1) {
			return $this->current_name;
		} else {
			$this->current_name = strtolower ( $this->flag ( $m ) );
		}
	}
	
	
	function flag($v) {
		switch ($v) {
			case ':' :
				$m = 'admin';
				break;
			case '@' :
				$m = 'common';
				break;
			default :
				$m = $v;
				break;
		}
		return $m;
	}
	
	
	function isadmin($module = '') {
		$v = ($module == 'admin');
		return $v;
	}
	
	
	function filename($module, $name = null, $extension = 'php') {
		$module = $this->flag ( $module );
		if (empty ( $module )) {
			return null;
		}
		
		$root = sdir ( 'source' );
		$sroot = sdir ( ':source' );
		
		$path = null;
		if (_g ( 'module' )->isadmin ( $module )) {
			$path .= ('/' . $module . '/');
		} else {
			$path .= ('/module/' . $module . '/');
		}
		if (! _g ( 'validate' )->em ( $name )) {
			$path .= ($name . '.' . $extension);
		}
		if (is_file ( $sroot . $path )) {
			return ($sroot . $path);
		}
		return ($root . $path);
	}
	
	
	function classname($module, $cla = null) {
		if ($cla !== null) {
			$c = $module . '_' . $cla;
		} else {
			$c = $module;
		}
		return $c;
	}
	
	
	function c($module, $name = null, $param = null, $is_instance = false) {
		if (empty ( $module )) {
			return null;
		}
		$module = $this->flag ( $module );
		$cla = 'class_' . $this->classname ( $module, $name );
		
		$dir = sdir ( ':source' );
		if ($this->isadmin ( $module )) {
			$c_dir = '/' . $module . '/class/' . $cla;
		} else {
			$c_dir = '/module/' . $module . '/class/' . $cla;
		}
		$filename = $dir . $c_dir . '.php';
		if (! is_file ( $filename )) {
			return null;
		}
		
		
		if (! class_exists ( $cla )) {
			require ($filename);
		}
		
		if ($is_instance === true) {
			return new $cla ( $param );
		}
	}
	
	
	function trigger($module, $claName = null, $claParams = null, $method = null) {
		$module = $this->flag ( $module );
		if (_g ( 'validate' )->em ( $module )) {
			return null;
		}
		
		
		$mName = $this->classname ( $module, $claName );
		
		
		$is_instance = _g ( 'validate' )->en_e ( $method );
		
		
		if (! my_array_key_exist ( $module . '>' . $mName, $this->_triggers )) {
			$cla = $this->c ( $module, $claName, $claParams, true );
			$this->_triggers [$module] [$mName] = $cla;
		} else {
			$cla = $this->_triggers [$module] [$mName];
		}
		if ($is_instance) {
			$params = array_slice ( func_get_args (), 4 );
			return call_user_func_array ( array (
					$cla,
					$method 
			), $params );
		} else {
			return $cla;
		}
	}
	
	
	function lang($name, $rep = null) {
		if (_g ( 'validate' )->em ( $name )) {
			return null;
		}
		if (is_array ( $name )) {
			return null;
		} else {
			if (gettype ( $name ) == 'boolean') {
				return $name;
			}
			if (strlen ( $name ) < 1) {
				return $name;
			}
		}
		
		$c_dir = null;
		
		if (preg_match ( "/^(\w+)$/i", $name )) {
			$filename = 'global';
			$keyname = $name;
		} else if (preg_match ( "/^:(\w+)$/i", $name )) {
			$c_dir = '/' . $this->flag ( ':' );
			$filename = $this->flag ( ':' );
			$keyname = substr ( $name, 1 );
		} else if (preg_match ( "/^@:(\w+)$/i", $name ) || preg_match ( "/^(\w+):(\w+)$/i", $name ) || preg_match ( "/^(\w+):(\w+)\>(\w+)$/i", $name )) {
			$_tmp = explode ( ':', $name );
			$c_dir = '/module/' . $this->flag ( $_tmp [0] );
			$filename = $this->flag ( $_tmp [0] );
			$keyname = $_tmp [1];
			
			my_unset ( $_tmp );
		} else {
			return $name;
		}
		
		$l_key_data = explode ( '>', $keyname );
		$l_key_len = my_count ( $l_key_data );
		if ($l_key_len > 1) {
			$l_name = $filename;
			for($i = 0; $i < ($l_key_len - 1); $i ++) {
				$l_name .= '_' . $l_key_data [$i];
			}
			$l_key = my_array_value ( $l_key_len - 1, $l_key_data );
		} else {
			$l_name = $filename;
			$l_key = $keyname;
		}
		
		
		$dir = sdir ( ':source' );
		$filepath = ($dir . $c_dir . '/lang/' . $l_name . '.php');
		if (! is_file ( $filepath )) {
			return $name;
		}
		$data = include ($filepath);
		if (! my_array_key_exist ( $l_key, $data )) {
			return $name;
		}
		$rnt = vsprintf ( my_array_value ( $l_key, $data ), (! is_array ( $rep ) ? array (
				$rep 
		) : $rep) );
		return $rnt;
	}
	
	
	function dv($module, $k = null, $def = null) {
		$argLen = func_num_args ();
		$value = array ();
		
		$module = $this->flag ( $module );
		if (_g ( 'validate' )->em ( $module )) {
			if ($argLen == 1) {
				return array ();
			} else {
				return null;
			}
		}
		$filename = $this->filename ( $module, 'inc/dv' );
		if (is_file ( $filename )) {
			$value = include $filename;
		}
		if (! is_array ( $value )) {
			$value = array ();
		}
		$v = my_array_value ( $k, $value, $def );
		return $v;
	}
	
	function helper($module, $name = null) {
		if (_g ( 'validate' )->em ( $module ) || _g ( 'validate' )->em ( $name )) {
			return null;
		}
		$filename = $this->filename ( $module, 'helper/' . $name );
		return $filename;
	}
	
	function inc($module, $name = null) {
		if (_g ( 'validate' )->em ( $module ) || _g ( 'validate' )->em ( $name )) {
			return null;
		}
		$filename = $this->filename ( $module, 'inc/' . $name );
		return $filename;
	}
}
?>