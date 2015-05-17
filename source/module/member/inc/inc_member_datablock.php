<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 数据调用变量 */
function member_databock_variable() {
	$mn = get_module ( _M (), 'name' );
	$arr = array (
			'uid' => array (
					'field' => 'uid',
					'val' => tag_name_set ( 'uid' ),
					'tag' => tag_name_set ( 'uid' ),
					'title' => '作者UID' 
			),
			'username' => array (
					'field' => 'username',
					'val' => tag_name_set ( 'username' ),
					'tag' => tag_name_set ( 'username' ),
					'title' => '会员名' 
			),
			'nickname' => array (
					'field' => 'nickname',
					'val' => tag_name_set ( 'nickname' ),
					'tag' => tag_name_set ( 'nickname' ),
					'title' => '昵称' 
			),
			'register_time' => array (
					'field' => 'regtime',
					'val' => tag_name_set ( 'regtime' ),
					'tag' => tag_name_set ( 'regtime' ),
					'title' => '注册时间' 
			),
			'before_time' => array (
					'field' => 'btime',
					'val' => tag_name_set ( 'btime' ),
					'tag' => tag_name_set ( 'btime' ),
					'title' => '上次登录时间' 
			),
			'last_time' => array (
					'field' => 'etime',
					'val' => tag_name_set ( 'etime' ),
					'tag' => tag_name_set ( 'etime' ),
					'title' => '最后登录时间' 
			),
			'avatar' => array (
					'field' => 'avatar',
					'val' => tag_name_set ( 'avatar' ),
					'tag' => tag_name_set ( 'avatar' ),
					'title' => '头像' 
			),
			'spaceurl' => array (
					'field' => 'spaceurl',
					'val' => html_special ( '<a href=\"' . tag_name_set ( 'spaceurl' ) . '\" target=\"_blank\">' . tag_name_set ( 'nickname' ) . '</a>' ),
					'tag' => html_special ( '<a href=...' ),
					'title' => '空间链接' 
			),
			'gender' => array (
					'field' => 'gender',
					'val' => tag_name_set ( 'gender' ),
					'tag' => tag_name_set ( 'gender' ),
					'title' => '性别' 
			),
			'birthday' => array (
					'field' => 'birthday',
					'val' => tag_name_set ( 'birthday' ),
					'tag' => tag_name_set ( 'birthday' ),
					'title' => '生日' 
			),
			'hometown' => array (
					'field' => 'hometown',
					'val' => tag_name_set ( 'hometown' ),
					'tag' => tag_name_set ( 'hometown' ),
					'title' => '家乡' 
			),
			'address' => array (
					'field' => 'address',
					'val' => tag_name_set ( 'address' ),
					'tag' => tag_name_set ( 'address' ),
					'title' => '居住地' 
			),
			'inform' => array (
					'field' => 'inform',
					'val' => tag_name_set ( 'inform' ),
					'tag' => tag_name_set ( 'inform' ),
					'title' => '签名' 
			),
			'fansnum' => array (
					'field' => 'fansnum',
					'val' => tag_name_set ( 'fansnum' ),
					'tag' => tag_name_set ( 'fansnum' ),
					'title' => '粉丝数' 
			),
			'follownum' => array (
					'field' => 'follownum',
					'val' => tag_name_set ( 'follownum' ),
					'tag' => tag_name_set ( 'follownum' ),
					'title' => '关注数' 
			) 
	);
	/* 组合公用变量 */
	$arr = common_datablock_variable ( $arr );
	return $arr;
}
?>