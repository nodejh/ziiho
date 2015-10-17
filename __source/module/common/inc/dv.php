<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
return array(
 	/* 100000 */
 	'100001'=>array(
			1 => array ('v' => '_self','name' => '默认' ),
			2 => array ('v' => '_blank','name' => '新窗口' ) 
	),
	'100002'=>array(
			'true' => array ('v' => 1, 'name' => '是', 'auth' => '已认证', 'startuse' => '已启用', 'status' => '开启' ),
			'false' => array ('v' => -1, 'name' => '否', 'auth' => '未认证', 'startuse' => '已停用', 'status' => '关闭' )
	),
	'100003'=>array(
			100 => array('name'=>'政治面貌'),
			101 => array('name'=>'工作年龄'),
			102 => array('name'=>'国家'),
			103 => array('name'=>'民族'),
			104 => array('name'=>'证件类型'),
			105 => array('name'=>'婚姻状况'),
			123 => array('name'=>'感情状况'),
			106 => array('name'=>'手机地区'),
			107 => array('name'=>'工作形式'),
			
			108 => array('name'=>'薪资类型'),
			122 => array('name'=>'[年]期望薪资'),
			116 => array('name'=>'[月]期望薪资'),
			
			109 => array('name'=>'到岗时间'),
			110 => array('name'=>'专业'),
			111 => array('name'=>'学历'),
			112 => array('name'=>'语言种类'),
			113 => array('name'=>'了解程度'),
			114 => array('name'=>'公司规模'),
			115 => array('name'=>'业余兴趣'),
			117 => array('name'=>'英语等级'),
			118 => array('name'=>'日语等级'),
			119 => array('name'=>'公司性质'),
			120 => array('name'=>'综合题型'),
			121 => array('name'=>'薪酬福利')
			
	),
		'100004'=>array(
				1 => array ('v' => 'asc','name' => '升序' ),
				2 => array ('v' => 'desc','name' => '降序' )
		),
	/* 200000 */
	'200000'=>array('*.gif', '*.png', '*.jpg'),
	'200001'=>array('image/gif', 'image/png', 'image/x-png', 'image/jpeg', 'image/pjpeg'),
	
);
?>