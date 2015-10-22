<?php
/*
 * geshai v1.0 2011.5 (http://www.geshai.com) author Jolly, Cloud
 */
date_default_timezone_set('PRC');

define ( 'GESHAI_DIR', str_replace ( '\\', '/', dirname ( __FILE__ ) ) );
require GESHAI_DIR . '/source/base.php';
base::create ( 'resume' );
?>