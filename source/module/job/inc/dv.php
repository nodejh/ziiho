<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
 	/* 100000 */
 	'100000'=>array(
			'radio' => array ('v' => 'radio', 'name' => '单选题', 'subname' => '单选题' ),
			'checkbox' => array ('v' => 'checkbox', 'name' => '多选题', 'subname' => '多选题' )/*,
 			'input'=> array ('v' => 'input', 'name' => '单行文本', 'subname' => '问答题' ),
 			'textarea'=> array ('v' => 'textarea', 'name' => '多行文本', 'subname' => '问答题' )*/
	)
);
?>