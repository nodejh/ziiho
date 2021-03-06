<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$_G ['isadmin'] = true;
define ( 'ADMIN_FLAG', _g ( 'module' )->flag(':') );
define ( 'ADMIN_HTML_FRAME', 'mainFrame' );

_g_set ( 'cp', _g ( 'module' )->trigger ( ':', 'model') );

$cpMain = array (
		'main',
		'mcenter' 
);

$ac = strtolower ( _get ( 'ac' ) );

$__isChk = true;
if (_g ( 'validate' )->hasget ( 'mod' )) {
	_g ( 'module' )->cname ( _get ( 'mod' ) );
	$__acfile = _g ( 'cp' )->ac ( _g ( 'module' )->cname (), $ac );
} else {
	$def_ac = 'login';
	$acts = array (
			$cpMain [0],
			$cpMain [1],
			'login',
			'lockscreen',
			'menu',
			'cache',
			'plugin',
			'dbbackup',
			'dbrestore' 
	);
	$ac = (in_array ( $ac, $acts ) ? $ac : $def_ac);
	if ($ac == $def_ac) {
		$ops = array (
				'out' 
		);
		$op = strtolower ( _get ( 'op' ) );
		if (in_array ( $op, $ops )) {
			$__isChk = false;
		} else {
			if (! _g ( 'validate' )->pnum ( _g ( 'cp' )->admin->uid )) {
				$__isChk = false;
			} else {
				$ac = $cpMain [0];
			}
		}
	}
	unset ( $acts );
	$__acfile = _g ( 'cp' )->ac ( ADMIN_FLAG, $ac );
}

if ($__isChk) {
	if (! _g ( 'cp' )->admin->check ()) {
		_g ( 'cp' )->goindex ();
		exit ();
	}
}
unset ( $cpMain );

_g ( 'cp' )->r ( $__acfile );
?>