<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$USER = _g('module')->trigger('user');
$UModel = _g('module')->trigger('user', 'model');

$CUser = _g('module')->trigger('cuser');

if(my_is_array($UModel->suser())){
	/* smsg(lang('user:100012')); */
	header('location:' . _g('uri')->su('user'));
	return null;
}

switch (_get ( 'op' )) {
	case 'email':
		include _g ( 'template' )->name ( 'user', 'register_email', true );
		break;
	case 'email_do' :
		$checkcode = _post('checkcode');
		
		$email = _post('email');
		$password = _post('password');
		$password2 = _post('password2');
		$cemail = _post('cemail');
		
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		
		/* 验证码 */
		if(strlen($checkcode) < 1){
			smsg(lang('200011'));
			return null;
		}
		if(!_g('validate')->checkcode($checkcode)){
			smsg(lang('200012'));
			return null;
		}
		
		/* 邮箱 */
		if(!_g('validate')->email($email, 1)){
			smsg ( lang ( 'user:100000') );
			return null;
		}
		/* 密码检查 */
		if(!_g('validate')->vm(strlen($password), 6, 30)){
			smsg ( lang ( 'user:100001', array(6, 30)) );
			return null;
		}
		if(strlen($password2) < 1){
			smsg ( lang ( 'user:100002') );
			return null;
		}
		if(!_g('validate')->v2eq(my_md5($password, 2), my_md5($password2, 2), true)){
			smsg ( lang ( 'user:100003') );
			return null;
		}
		
		$ctime = _g('cfg>time');
		$cip = getip();
		$datas = array(
				'username'=>$email,
				'password'=>my_md5($password, 2),
				'regtime'=>$ctime,
				'regip'=>$cip,
				'lasttime'=>$ctime,
				'lastip'=>$cip,
				'curtime'=>$ctime,
				'curip'=>$cip,
				'status'=>1
		);
		$USER->emailRegister($datas);
		break;
		
	case 'email_auth' :
		$suser = $UModel->suser();
		$targetMailUrl = _g('value')->eu($UModel->suser('username'));
		
		$authStep = false;
		if(my_is_array($suser)){
			$uRs = $USER->find('uid', $UModel->suser('uid'));
			if(my_is_array($uRs)){
				if(!_g('validate')->v2eq($uRs['email_auth'], _g('value')->sb(true))){
					$authStep = true;
				}
			}
		}
		if($authStep){
			include _g ( 'template' )->name ( 'user', 'register_email_auth', true );
		}else{
			$authStatus = false;
			include _g ( 'template' )->name ( 'user', 'register_email_auth_status', true );
		}
		break;
	case 'email_auth_do' :
		$email = _get('e');
		
		$authStatus = false;
		if(strlen($email) >= 1){
			$email = urldecode(base64_decode(base64_decode($email)));;
			if(_g('validate')->email($email, 1)){
				$uRs = $USER->find('username', $email);
				if(my_is_array($uRs)){
					if(_g('validate')->v2eq($uRs['username'], $UModel->suser('username'))){
						if(!_g('validate')->v2eq($uRs['email_auth'], _g('value')->sb(true))){
							if($USER->email_auth('uid', $uRs['uid'])){
								$authStatus = true;
							}
						}
					}
				}
			}
		}
		include _g ( 'template' )->name ( 'user', 'register_email_auth_status', true );
		break;
	case 'email_auth_send' :
		$suser = $UModel->suser();
		if(!my_is_array($suser)){
			smsg(lang('user:100008'));
			return null;
		}
		$uRs = $USER->find('uid', $suser['uid']);
		if(!my_is_array($uRs)){
			smsg(lang('user:100009'));
			return null;
		}
		if(_g('validate')->v2eq($uRs['email_auth'], _g('value')->sb(true))){
			smsg(lang('user:100010'));
			return null;
		}
		if(!$USER->email_send($suser)){
			smsg(_g('mail')->message());
			return null;
		}
		smsg(lang('user:100005', $suser['username']), null, 1);
		break;
	case 'email_success' :
		if(!_g('validate')->v2eq($CUser->sess_cuser('flag'), 'register', true)){
			smsg(lang('cuser:300002'), _g('uri')->su('user/ac/login'));
			return null;
		}
		include _g ( 'template' )->name ( 'user', 'register_email3', true );
		break;
	
	/* 企业 */
	case 'company' :
		include _g ( 'template' )->name ( 'user', 'register_company', true );
		break;
	case 'company_do' :
		/*$username = _post('username');*/
		$email = _post('email');
		$password = _post('password');
		$password2 = _post('password2');
		$cname = _post('cname');
		$area = _post('area');
		$area_detail = _post('area_detail');
		$contacts = _post('contacts');
		$telephone = _post('telephone');
		$mobilephone = _post('mobilephone');
		
		/* 用户名 */
		/*if(!_g('validate')->en_e($username, 3, 30) || !_g('validate')->vm(strlen($username), 3, 30)){
			smsg ( lang ( 'cuser:100000', array(3, 30)) );
			return null;
		}*/
		/* 邮箱 */
		if(!_g('validate')->email($email, 1)){
			smsg ( lang ( 'cuser:100001') );
			return null;
		}
		/* 密码检查 */
		if(!_g('validate')->vm(strlen($password), 6, 30)){
			smsg ( lang ( 'cuser:100002', array(6, 30)) );
			return null;
		}
		if(strlen($password2) < 1){
			smsg ( lang ( 'cuser:100003') );
			return null;
		}
		if(!_g('validate')->v2eq(my_md5($password, 2), my_md5($password2, 2), true)){
			smsg ( lang ( 'cuser:100004') );
			return null;
		}
		
		/* 公司名称 */
		if(!_g('validate')->vm(strlen($cname), 1, 300)){
			smsg ( lang ( 'cuser:100005', array(1, 100)) );
			return null;
		}
		
		/* 公司地址 */
		if(my_count(my_explode(',', $area)) < 2){
			smsg ( lang ( 'cuser:100006') );
			return null;
		}
		
		/* 联系人 */
		if(!_g('validate')->vm(strlen($contacts), 1, 60)){
			smsg ( lang ( 'cuser:100007', array(1, 20)) );
			return null;
		}
		
		/* 联系方式验证(手机or座机) */
		/* 座机 */
		if (!preg_match("/^\d{1,4}$/", my_array_value(0, $telephone))) {
			$telephone[0] = null;
		}
		if (!preg_match("/^\d{1,11}$/", my_array_value(1, $telephone))) {
			$telephone[1] = null;
		}
		if (!preg_match("/^\d{1,8}$/", my_array_value(2, $telephone))) {
			$telephone[2] = null;
		}
		$phoneFlag = ((strlen($telephone[0]) >= 1 && strlen($telephone[1]) >= 1) ? true : false);
		
		/* 手机 */
		if (strlen($mobilephone) >= 1) {
			if(!_g('validate')->pnum($mobilephone) || !_g('validate')->vm(strlen($mobilephone), 8, 11)){
				smsg ( lang ( 'cuser:100008') );
				return null;
			}
			$phoneFlag = true;
		}
		/* 如果座机or手机填写无效 */
		if (!$phoneFlag) {
			smsg ( lang ( 'cuser:100020') );
			return null;
		}
		
		/* 默认参数 */
		$telephone = my_addslashes(array2str($telephone));
		$ctime = _g('cfg>time');
		$cip = getip();
		$datas = array(
				/*'username'=>$username,*/
				'password'=>my_md5($password, 2),
				'email'=>$email,
				'regtime'=>$ctime,
				'regip'=>$cip,
				'lasttime'=>$ctime,
				'lastip'=>$cip,
				'curtime'=>$ctime,
				'curip'=>$cip,
				'status'=>1,
				'cname'=>$cname,
				'area'=>$area,
				'area_detail'=>$area_detail,
				'contacts'=>$contacts,
				'telephone'=>$telephone,
				'mobilephone'=>$mobilephone
		);
		$CUser->register($datas, 1);
		break;
		
	case 'company2' :
		if(!_g('validate')->v2eq($CUser->sess_cuser('flag'), 'register', true)){
			smsg(lang('cuser:300002'), _g('uri')->su('user/ac/login'));
			return null;
		}
		include _g ( 'template' )->name ( 'user', 'register_company2', true );
		break;
	case 'company2_do' :
		$cuid = _post('cuid');
		$csortid = _post('csortid');
		$cnatureid = _post('cnatureid');
		$csize = _post('csize');
		$cdescription = _post('cdescription');
		$recruitment = _post('recruitment');
		$rtelephone = _post('rtelephone');
		$rmobilephone = _post('rmobilephone');
		
		/* cuid是否合法 */
		if(!_g('validate')->pnum($cuid)){
			smsg(lang('cuser:300000'));
			return null;
		}
		if(!my_is_array($CUser->find('cuid', $cuid))){
			smsg(lang('cuser:300001'));
			return null;
		}
		
		/* 行业类别 */
		if(!my_is_array($csortid)){
			smsg ( lang ( 'cuser:100011') );
			return null;
		}
		/* 公司性质 */
		if(!_g('validate')->pnum($cnatureid)){
			smsg ( lang ( 'cuser:100012') );
			return null;
		}
		
		/* 招聘联系电话 */
		$rtelephone[0] = substr(my_array_value(0, $rtelephone), 0, 6);
		$rtelephone[1] = substr(my_array_value(1, $rtelephone), 0, 10);
		$rtelephone[2] = substr(my_array_value(2, $rtelephone), 0, 6);
		
		$__csortid = null;
		foreach ($csortid as $__v){
			$__csortid .= ',' . $__v . ',';
		} 
		$datas = array(
				'cuid'=>$cuid,
				'csortid'=>$__csortid,
				'cnatureid'=>$cnatureid,
				'csize'=>$csize,
				'cdescription'=>$cdescription
		);
		$CUser->register($datas, 2);
		break;
	case 'company2_licence':
		$licence = _ifile('licence');
		
		break;
	case 'company3' :
		if(!_g('validate')->v2eq($CUser->sess_cuser('flag'), 'register', true)){
			smsg(lang('cuser:300002'), _g('uri')->su('user/ac/login'));
			return null;
		}
		include _g ( 'template' )->name ( 'user', 'register_company3', true );
		break;
		
	/* 手机 */
	case 'tel' :
		include _g ( 'template' )->name ( 'user', 'register_tel', true );
		break;
		
		case 'tel2' :
		include _g ( 'template' )->name ( 'user', 'register_tel2', true );
		break;
		
		case 'tel3' :
		include _g ( 'template' )->name ( 'user', 'register_tel3', true );
		break;
		
	default :
		include _g ( 'template' )->name ( 'user', 'register', true );
		break;
}
?>