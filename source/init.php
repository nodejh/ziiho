<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}


set_time_limit ( 60 );

ini_set ( 'memory_limit', '265M' );

define ( 'DS', '/' );
define ( 'GESHAI_ROOT', str_replace ( '\\', '/', dirname ( dirname ( __FILE__ ) ) ) );

$_G = array ();


$_G ['isadmin'] = false;


$_configFile = GESHAI_ROOT . '/data/config.php';
if (! is_file ( $_configFile )) {
	header ( "Location: install/install.php" );
	exit ();
}
require ($_configFile);
unset ( $_configFile );


$install_lock_file = $_G ['cfg'] ['install_lock'];
if (strlen ( $install_lock_file ) < 1 || ! is_file ( GESHAI_ROOT . '/data/' . $install_lock_file )) {
	header ( "Location: install/install.php" );
	exit ();
}


header ( 'Content-type:text/html; charset=' . $_G ['cfg'] ['charset'] );
header ( 'Vary:Accept-Language' );


if ($_G ['cfg'] ['debug'] === true) {
	error_reporting ( E_ALL ^ E_NOTICE );
	@ini_set ( 'display_errors', 'ON' );
} else {
	error_reporting ( 0 );
	@ini_set ( 'display_errors', 'Off' );
}
if (function_exists ( 'set_magic_quotes_runtime' )) {
	@set_magic_quotes_runtime ( 0 );
}
define ( 'MAGIC_QUOTES_GPC', get_magic_quotes_gpc () );


require (GESHAI_ROOT . '/source/function/function.php');
require (GESHAI_ROOT . '/source/function/function2.php');

if (MAGIC_QUOTES_GPC) {
	$_POST = my_stripslashes ( $_POST );
	$_GET = my_stripslashes ( $_GET );
	$_COOKIE = my_stripslashes ( $_COOKIE );
	$_REQUEST = my_stripslashes ( $_REQUEST );
}


require (GESHAI_ROOT . '/source/lib/geshai_loader.php');
$_G ['loader'] = new geshai_loader ();


$_G ['get'] = $_G ['loader']->lib ( 'get', null, true );
$_G ['value'] = $_G ['loader']->lib ( 'value', null, true );
$_G ['validate'] = $_G ['loader']->lib ( 'validate', null, true );
$_G ['module'] = $_G ['loader']->lib ( 'module', null, true );
$_G ['template'] = $_G ['loader']->lib ( 'template', null, true );
$_G ['session'] = $_G ['loader']->lib ( 'session', null, true );
$_G ['cookie'] = $_G ['loader']->lib ( 'cookie', null, true );
$_G ['uri'] = $_G ['loader']->lib ( 'uri', null, true );
$_G ['cache'] = $_G ['loader']->lib ( 'cache', null, true );
$_G ['file'] = $_G ['loader']->lib ( 'file', null, true );
$_G ['page'] = $_G ['loader']->lib ( 'page', null, true );
$_G ['mail'] = $_G ['loader']->lib ( 'mail', null, true );

$_G ['loader']->lib ( 'base' );
$_G ['loader']->lib ( 'model' );
$_G ['loader']->lib ( 'common' );

/* setting datas */
// cfg_setting_get();

/* setting timezone */
if (function_exists ( 'date_default_timezone_set' )) {
	date_default_timezone_set ( _g ( ':>>', 'timezone' ) );
	$_G ['cfg'] ['time'] = (time () + (intval ( _g ( ':>>', 'timeoffset' ) ) * 60));
}

/* 插件激活 */
// $_G['plugin']->active();

?>