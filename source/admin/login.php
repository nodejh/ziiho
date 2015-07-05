<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

switch (_get ( 'op' )) {
	case 'do' :
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		$username = _post ( 'username' );
		$password = _post ( 'password' );
		$checkcode = _post ( 'checkcode' );
		
		if (strlen ( $username ) < 1) {
			smsg ( lang ( ':100002' ) );
			return null;
		}
		if (! _g ( 'validate' )->en_e ( $username )) {
			if(!_g('validate')->email($username)){
				smsg ( lang ( ':100003' ) );
				return null;
			}
		}
		
		/* 密码 */
		if (strlen ( $password ) < 1) {
			smsg ( lang ( ':100004' ) );
			return null;
		}
		if (strlen ( $checkcode ) < 1) {
			smsg ( lang ( '200011' ) );
			return null;
		}
		if (! _g ( 'validate' )->checkcode ( $checkcode )) {
			smsg ( lang ( '200012' ) );
			return null;
		}
		
		/* 用户类 */
		$userCla = _g ( 'module' )->trigger ( 'user');
		
		/* 用户名是否存在 */
		$userRs = $userCla->find ( 'username', $username );
		if (! _g('cp')->admin->db->is_success ( $userRs )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (! my_is_array ( $userRs )) {
			smsg ( lang ( ':100003' ) );
			return null;
		}
		if (! _g ( 'validate' )->v2eq ( $userRs ['username'], $username, true )) {
			smsg ( lang ( ':100003' ) );
			return null;
		}
		/* 密码是否正确 */
		if (! _g ( 'validate' )->v2eq ( $userRs ['password'], my_md5 ( $password, 2 ), true )) {
			smsg ( lang ( ':100005' ) );
			return null;
		}
		/* 系统时间 */
		$sysTime = _g ( 'cfg>time' );
		/* 更新主表(member)登录信息 */
		$fieldData = array (
				'lasttime' => my_array_value ( 'curtime', $userRs ),
				'lastip' => my_array_value ( 'curip', $userRs ),
				'curtime' => $sysTime,
				'curip' => getip (),
				'online' => $sysTime
		);
		$result = $userCla->update ( $fieldData, 'uid', $userRs['uid'] );
		if (!$result) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		if(!_g('cp')->admin->getIsAdmin( $userRs['uid'] )){
			if(!my_is_array(_g('cp')->admin->findAdmin( $userRs['uid'] ))){
				smsg ( lang ( ':100001' ) );
				return null;
			}
		}
		
		_g ( 'value' )->checkcode_destroy ();
		_g ( 'value' )->user ( null, $userRs );
		smsg ( lang ( ':100006' ), _g ( 'cp' )->uri (), 1 );
		break;
	
	case 'out' :
		
		break;
	
	default :
		_g ( 'cp' )->set_template ( ':', 'login' );
		
		/* 已登录会员名 */
		$username = _g ( 'value' )->user ( 'username' );
		break;
}
?>