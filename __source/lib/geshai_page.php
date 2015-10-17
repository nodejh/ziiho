<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_page {
	function __construct() {
	}
	function geshai_page() {
		$this->__construct ();
	}
	
	
	function d($total, $start, $size, $page, $prev, $next, $last, $navData) {
		$data = array (
				'total' => $total,
				'start' => $start,
				'size' => $size,
				'page' => $page,
				'first' => 1,
				'prev' => $prev,
				'next' => $next,
				'last' => $last,
				'data' => $navData 
		);
		return $data;
	}
	
	function c($totalNum = 0, $pageSize = 20, $navNum = 10, $page = 1, $startNum = 0) {
		$totalNum = (! _g ( 'validate' )->num ( $totalNum ) ? 0 : $totalNum);
		$pageSize = (! _g ( 'validate' )->pnum ( $pageSize ) ? 20 : $pageSize);
		$navNum = (! _g ( 'validate' )->pnum ( $navNum ) ? 10 : $navNum);
		$page = (! _g ( 'validate' )->pnum ( $page ) ? 1 : $page);
		$startNum = (! _g ( 'validate' )->num ( $startNum ) ? 0 : $startNum);
		
		$_last = ($pageSize < 1) ? 0 : ceil ( $totalNum / $pageSize );
		$page = ($page > $_last) ? $_last : $page;
		$_prev = (($page - 1) < 1) ? 1 : ($page - 1);
		$_next = ($page == $_last) ? $_last : $page + 1;
		$_start = max ( $startNum, (($page - 1) * $pageSize) );
		
		
		if ($_last <= 1) {
			if ($totalNum == 0) {
				$page = 0;
				$_prev = 0;
				$_next = 0;
				$_last = 0;
			}
			return $this->d ( $totalNum, $_start, $pageSize, $page, $_prev, $_next, $_last, array () );
		}
		
		$navData = array ();
		$o = $navNum;
		$u = ceil ( $o / 2 );
		$f = $page - $u;
		if ($f < 0) {
			$f = 0;
		}
		$n = $_last;
		if ($n < 1) {
			$n = 1;
		}
		$navData [] = 1;
		for($i = 1; $i <= $o; $i ++) {
			
			if ($n <= 1) {
				break;
			}
			
			$c = $f + $i;
			if ($i == 1 && $c > 2) {
				$navData [] = null;
			}
			if ($c == 1) {
				continue;
			}
			if ($c == $n) {
				break;
			}
			$navData [] = $c;
			if ($i == $o && $c < $n - 1) {
				$navData [] = null;
			}
			
			if ($i > $n) {
				break;
			}
		}
		$navData [] = $n;
		return $this->d ( $totalNum, $_start, $pageSize, $page, $_prev, $_next, $_last, $navData );
	}
}
?>