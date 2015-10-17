<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 设置_父级菜单 */
function member_setting_menu_a() {
	$arr = array (
			'base' => array (
					'id' => 'no',
					'title' => '个人资料' 
			),
			'profile' => array (
					'id' => 1,
					'title' => '基本资料',
					'url' => url ( 'index', 'mod/member/ac/setting/op/profile/ao/base' ) 
			),
			'avatar' => array (
					'id' => 2,
					'title' => '头像设置',
					'url' => url ( 'index', 'mod/member/ac/setting/op/avatar/ao/upload' ) 
			),
			'tag' => array (
					'id' => 3,
					'title' => '标签设置',
					'url' => url ( 'index', 'mod/member/ac/setting/op/tag/ao/my' ) 
			),
			
			'author' => array (
					'id' => 'no',
					'title' => '权限设置' 
			),
			'view' => array (
					'id' => 4,
					'title' => '空间访问',
					'url' => '' 
			),
			'message' => array (
					'id' => 5,
					'title' => '消息设置',
					'url' => '' 
			),
			'follow' => array (
					'id' => 6,
					'title' => '关注设置',
					'url' => '' 
			),
			'private' => array (
					'id' => 7,
					'title' => '隐私设置',
					'url' => '' 
			),
			'apply' => array (
					'id' => 8,
					'title' => '应用设置',
					'url' => '' 
			),
			
			'account' => array (
					'id' => 'no',
					'title' => '账号设置' 
			),
			'password' => array (
					'id' => 9,
					'title' => '密码修改',
					'url' => url ( 'index', 'mod/member/ac/setting/op/account/ao/password' ) 
			),
			'bind' => array (
					'id' => 10,
					'title' => '账号绑定',
					'url' => url ( 'index', 'mod/member/ac/setting/op/account/ao/bind' ) 
			),
			'credit' => array (
					'id' => 11,
					'title' => '积分管理',
					'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/my' ) 
			) 
	);
	return $arr;
}
/* 设置_子级菜单 */
function member_setting_menu_b($_key) {
	$arr = array (
			'profile' => array (
					'base' => array (
							'title' => '基本资料',
							'url' => url ( 'index', 'mod/member/ac/setting/op/profile/ao/base' ) 
					) 
			),
			'avatar' => array (
					'upload' => array (
							'title' => '头像设置',
							'url' => url ( 'index', 'mod/member/ac/setting/op/avatar/ao/upload' ) 
					) 
			),
			'tag' => array (
					'my' => array (
							'title' => '标签设置',
							'url' => url ( 'index', 'mod/member/ac/setting/op/tag/ao/my' ) 
					) 
			),
			'account' => array (
					'password' => array (
							'title' => '密码修改',
							'url' => url ( 'index', 'mod/member/ac/setting/op/account/ao/password' ) 
					) 
			),
			'credit' => array (
					'my' => array (
							'title' => '我的账户',
							'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/my' ) 
					),
					'charge' => array (
							'title' => '积分充值',
							'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/charge' ) 
					),
					'transfer' => array (
							'title' => '转账',
							'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/transfer' ) 
					),
					'change' => array (
							'title' => '积分兑换',
							'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/change' ) 
					),
					'orders' => array (
							'title' => '订单记录',
							'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/orders' ) 
					),
					'logs' => array (
							'title' => '积分日志',
							'url' => url ( 'index', 'mod/member/ac/setting/op/credit/ao/logs' ) 
					) 
			) 
	);
	if (check_is_key ( $_key, $arr ) < 1) {
		return NULL;
	}
	$val = array_key_val ( $_key, $arr );
	return $val;
}
/* 好友_菜单 */
function member_friend_menu() {
	$arr = array (
			'follow' => array (
					'id' => 1,
					'field' => 'follow',
					'title' => lang ( 'member:p_follow' ),
					'url' => url ( 'index', 'mod/member/ac/friend/op/follow' ) 
			),
			'fans' => array (
					'id' => 2,
					'field' => 'fans',
					'title' => lang ( 'member:p_fans' ),
					'url' => url ( 'index', 'mod/member/ac/friend/op/fans' ) 
			) 
	);
	return $arr;
}
/* 消息_菜单 */
function member_message_menu() {
	$arr = array (
			'inbox' => array (
					'id' => 1,
					'field' => 'inbox',
					'title' => lang ( 'member:inbox' ),
					'url' => url ( 'index', 'mod/member/ac/message/op/inbox' ) 
			),
			'outbox' => array (
					'id' => 2,
					'field' => 'outbox',
					'title' => lang ( 'member:outbox' ),
					'url' => url ( 'index', 'mod/member/ac/message/op/outbox' ) 
			),
			'write' => array (
					'id' => 2,
					'field' => 'write',
					'title' => lang ( 'member:sendmessage' ),
					'url' => url ( 'index', 'mod/member/ac/message/op/write' ) 
			) 
	);
	return $arr;
}
?>