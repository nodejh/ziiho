<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

/* --------------------------------------------------------------- */
/* --------------------------------------------------------------- */
/*
 *	注: 除了更改数据库配置，请别随意改动
 */
/* --------------------------------------------------------------- */
/* 数据库配置 */
/* --------------------------------------------------------------- */

/* 主机 */
$_G ['dns'] ['host'] = 'localhost';
/* 用户名 */
$_G ['dns'] ['user'] = 'root';
/* 密码 */
$_G ['dns'] ['password'] = 'root';
/* 数据库名 */
$_G ['dns'] ['database'] = 'ziiho';
/* 0=及时链接,1=持久链接 */
$_G ['dns'] ['conn'] = '0';
/* 表前缀 */
$_G ['dns'] ['tablepre'] = 'cs_';
/* 数据库表名前缀代替符 */
$_G ['dns'] ['tablepre_mark'] = '#@@__';
/* 数据库编码 */
$_G ['dns'] ['charset'] = 'utf8';
/* 执行结果正确 */
$_G ['dns'] ['success'] = 'success';
/* 执行结果错误 */
$_G ['dns'] ['error'] = 'error';

/* --------------------------------------------------------------- */
/* 目录形式 */
/* --------------------------------------------------------------- */

/* root */
$_G ['dir'] ['root'] = 'http://localhost/ziiho';

/* --------------------------------------------------------------- */
/* 系统设置 */
/* --------------------------------------------------------------- */

/* is debug */
$_G ['cfg'] ['debug'] = true;
/* The module variable name */
$_G ['cfg'] ['module'] = '_MODULE_';
/* The locking file name */
$_G ['cfg'] ['install_lock'] = 'install.lock';
/* session prefix */
$_G ['cfg'] ['session_prefix'] = 'session_geshai_';
/* cookie prefix */
$_G ['cfg'] ['cookie_prefix'] = 'cookie_geshai_';
/* charset */
$_G ['cfg'] ['charset'] = 'utf-8';
/* encode */
$_G ['cfg'] ['encode'] = 'base64';
/* timezone */
$_G ['cfg'] ['timezone'] = 8;
/* system time */
$_G ['cfg'] ['time'] = time ();
/* lang */
$_G ['cfg'] ['lang'] = 'ch';
/* domain */
$_G ['cfg'] ['domain'] = 'localhost';
/* url */
$_G ['cfg'] ['url'] = 'http://localhost/ziiho';
/* form method key */
$_G ['cfg'] ['fmkey'] = array (
		'post' => '1e1a92b494c18a9955e591a2902dcd02',
		'get' => 'beaaa971c77cf131c8dec0e22848f724',
		'ajax' => 'beaaa971c77cf131c8dec0e22848f724',
		'onlybody' => 'beaaa971c77cf131c8dec0e22848f724' 
);
/* php */
$_G ['cfg'] ['php'] = '.php';
/* template extension */
$_G ['cfg'] ['extension'] = '.html';
/* 分页省略符号键名称 */
$_G ['cfg'] ['page_omit'] = 'page_omit';
/* 内容分页截取标示符 */
$_G ['cfg'] ['content_split'] = '{(subpage(cj@=@cj)subpage)}';
?>