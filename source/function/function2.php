<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
function ms_profession($k = null, $k2 = null, $def = 'undefined') {
	$f = _g('loader')->lib('find', null, true);
	$v = null;
	switch (func_num_args()) {
		case 1:
			$v = $f->profession ($v);
			break;
		case 2:
			$v = $f->profession ($v, 'pname', $def);
			break;
		default:
			$v = $f->profession ();
			break;
	}
	return $v;
}
?>