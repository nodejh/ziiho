<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_model {
	
	/*
	 * 当前加载模板模块
	 */
	public $module = null;
	/*
	 * 当前加载模板
	 */
	public $template = null;
	/*
	 * 菜单类
	 */
	public $menu = null;
	/*
	 * 管理员类
	 */
	public $admin = null;
	
	function __construct() {
		$this->init ();
	}
	function class_admin_model() {
		$this->__construct ();
	}
	function init() {
		$this->admin = _g ( 'module' )->trigger ( ':');
		$this->menu = _g ( 'module' )->trigger ( ':', 'menu');
	}
	function set_template($module = null, $template = null) {
		$this->module = _g ( 'module' )->flag ( $module );
		$this->template = $template;
	}
	function get_template($module = null, $name = null) {
		if (empty ( $module )) {
			$module = $this->module;
		}
		$module = _g ( 'module' )->flag ( $module );
		
		if (empty ( $name )) {
			$name = $this->template;
		}
		if (_g ( 'module' )->isadmin ( $module )) {
			$path = 'template';
		} else {
			$path = 'admin/template';
		}
		$f = _g ( 'module' )->filename ( $module, ($path . '/' . $name) );
		return $f;
	}
	function ac($module = null, $name = null) {
		$module = _g ( 'module' )->flag ( $module );
		if (_g ( 'module' )->isadmin ( $module )) {
			$path = $name;
		} else {
			$path = 'admin/' . $name;
		}
		$f = _g ( 'module' )->filename ( $module, $path );
		return $f;
	}
	function uri($param = null) {
		$rd = '{rd}';
		$paramData = null;
		if (! empty ( $param )) {
			$params = my_explode ( '/', $param );
			$index = 0;
			foreach ( $params as $val ) {
				$index ++;
				if ($index % 2 === 0) {
					if ($val == $rd) {
						$val = getrand ( 6, 1 );
					}
					$paramData .= ('=' . $val);
				} else {
					$paramData .= ((! empty ( $paramData ) ? '&' : null) . $val);
				}
			}
		}
		$url = (sdir () . '/admin.php' . (! empty ( $paramData ) ? '?' : null) . $paramData);
		return $url;
	}
	function cpPluTpl($tName = NULL) {
		global $ADM;
		if (strlen ( $tName ) < 1) {
			$ADM->tpl = NULL;
		} else {
			$ADM->tpl = 'plugin:' . strtolower ( _get ( 'pn' ) ) . '/' . $tName;
		}
	}
	function cpPluTplName($tName = NULL) {
		return cptpl ( 'plugin:' . strtolower ( _get ( 'pn' ) ) . '/' . $tName );
	}
	function cpPluExtUrl($param = NULL) {
		$plugin = strtolower ( _get ( 'pn' ) );
		if (! preg_match ( "/^(\w+)$/i", $plugin )) {
			$urlStr = 'ac/plugin';
		} else {
			$urlStr = 'ac/plugin/op/ext/pn/' . $plugin;
			if (! empty ( $param ) && ! is_array ( $param ) && ! is_bool ( $param )) {
				$_par = preg_replace ( "/^(\/)/", '', $param );
				if (! empty ( $_par )) {
					$urlStr .= ('/' . $_par);
				}
			}
		}
		return $this->uri ( $urlStr );
	}
	function r($__acfile) {
		if (strlen ( $__acfile ) < 1) {
			prt ( lang ( '200010' ) );
			return null;
		}
		if (! is_file ( $__acfile )) {
			prt ( lang ( '200002', $__acfile ) );
			return null;
		}
		
		require ($__acfile);
		
		if (strlen ( $this->template ) != 0) {
			if (! _g ( 'validate' )->onlybody ()) {
				$__cp_headerTpl = $this->get_template ( ':', 'header' );
				if (is_file ( $__cp_headerTpl )) {
					include ($__cp_headerTpl);
				} else {
					prt ( lang ( '200002', $__cp_headerTpl ) );
					return null;
				}
			}
			$__cp_bodyTpl = $this->get_template ();
			if (is_file ( $__cp_bodyTpl )) {
				include ($__cp_bodyTpl);
			} else {
				prt ( lang ( '200002', $__cp_bodyTpl ) );
				return null;
			}
			
			if (! _g ( 'validate' )->onlybody ()) {
				$__cp_footerTpl = $this->get_template ( ':', 'footer' );
				if (is_file ( $__cp_footerTpl )) {
					include ($__cp_footerTpl);
				} else {
					prt ( lang ( '200002', $__cp_bodyTpl ) );
				}
			}
		}
	}
	/* page nav */
	function page(&$data = null){
		$filename = _g('module')->helper(':', 'page');
		if(is_file($filename)){
			$data = _g('value')->ra($data);
			include ($filename);
		}
	}
}
?>