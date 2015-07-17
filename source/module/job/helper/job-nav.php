<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

return array (
		array('ac'=>'company', 'uri'=>'job/ac/company', 'name'=>'名企'),
		/*array('ac'=>'profession', 'uri'=>'job/ac/profession', 'name'=>'热门行业'),*/
		array('ac'=>'work', 'uri'=>'job/ac/work', 'name'=>'热门职位'),
		array('ac'=>'companys', 'uri'=>'job/ac/companys', 'name'=>'所有公司'),
);
?>