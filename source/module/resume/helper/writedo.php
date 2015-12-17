<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$RESUME = $RESUME;

switch (_post ( 'f' )) {
	/* resume */
	case 'resume':
		smsg(lang('100061'), null, 1);
		break;
		
	/* base */
	case 'base':
		$chname = _post('chname');
		$gender = _post('gender');
		$birthday = _post('birthday');
		
		$phonearea = _post('phonearea');
		$mobilephone = _post('mobilephone');
		
		$email = _post('email');
		$workyear = _post('workyear');
		$home = _post('home');
		
		/* more */
		$country = _post('country');
		$nation = _post('nation');
		$idtype = _post('idtype');
		$idstr = _post('idstr');
		$maritalstatus = _post('maritalstatus');
		$politicalstatus = _post('politicalstatus');
		$height = _post('height');
		$hometown = _post('hometown');
		$qq = _post('qq');
		
		$time = _g('cfg>time');
		
		/* check fields */
		if (strlen($chname) < 1) {
			smsg(lang('resume:100000'));
			return null;
		}
		if(!_g('validate')->vm(strlen($chname), 1, 90)){
			smsg(lang('resume:100001', 30));
			return null;
		}
		/* gender */
		if (!my_array_key_exist($gender, _g('module')->dv('resume', 100000))) {
			smsg(lang('resume:100044'));
			return null;
		}
		/* birthday */
		if (strlen($birthday) < 1) {
			smsg(lang('resume:100045'));
			return null;
		}
		/* mobilephone */
		if(!_g('validate')->n($mobilephone) || !_g('validate')->vm(strlen($mobilephone), 8, 11)){
			smsg(lang('resume:100046'));
			return null;
		}
		/* email */
		if(!_g('validate')->email($email, 1)){
			smsg ( lang ( 'resume:100047') );
			return null;
		}
		/* workyear */
		if (!_g('validate')->pnum($workyear)) {
			smsg ( lang ( 'resume:100048') );
			return null;
		}
		/* home */
		if (my_count(my_explode(',', $home)) < 2) {
			smsg ( lang ( 'resume:100049') );
			return null;
		}
		
		/* is exist */
		$profileRs = $RESUME->find ($RESUME->t_resume_profile, 'uid', $uid);
		if (!$RESUME->db->is_success ( $profileRs )) {
			smsg(lang('200013'));
			return null;
		}
		
		/* set fields */
		$birthday = strtotime($birthday);
		$data = array (
				'uid' => $uid,
				'chname' => $chname,
				'gender' => $gender,
				'birthday' => $birthday,
				'phonearea' => $phonearea,
				'mobilephone' => $mobilephone,
				'email' => $email,
				'workyear' => $workyear,
				'home' => $home,
				
				'country' => $country,
				'nation' => $nation,
				'idtype' => $idtype,
				'idstr' => $idstr,
				'maritalstatus' => $maritalstatus,
				'politicalstatus' => $politicalstatus,
				'height' => $height,
				'hometown' => $hometown,
				'qq' => $qq,
				
				'ctime' => $time,
				'mtime' => $time,
				
		);
		
		/* update */
		$__s = null;
		if (my_is_array($profileRs)) {
			unset($data['ctime']);
			$__s = $RESUME->update ( $RESUME->t_resume_profile, $data, null, 'uid', $uid );
		} else {
			$__s = $RESUME->insert ( $RESUME->t_resume_profile, $data );
		}
		if (!$__s) {
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	
	/* wish */
	case 'wish':
		$area = _post ( 'area' );
		$professionid = _post ( 'professionid' );
		$sortid2 = _post ( 'sortid2' );
		$worktype = _post ( 'worktype' );
		$wagetype = _post ( 'wagetype' );
		$wage_year = _post ( 'wage_year' );
		$wage_month = _post ( 'wage_month' );
		$wage_input = _post ( 'wage_input' );
		$workstatus = _post ( 'workstatus' );
		$selfintroduce = _post ( 'selfintroduce' );
		
		/* area */
		if (my_count(my_explode(',', $area)) < 2) {
			smsg ( lang ( 'resume:100051') );
			return null;
		}
		
		/* sortid */
		if (!_g('validate')->pnum( $professionid )) {
			smsg( lang ('resume:100004') );
			return null;
		}
		
		/* sortid2 */
		if (!_g('validate')->pnum( $sortid2 )) {
			smsg( lang ('resume:100005') );
			return null;
		}
		/* worktype */
		if (!_g('validate')->pnum( $worktype )) {
			smsg( lang ('resume:100052') );
			return null;
		}
		/* wage */
		$__wagetype = _g('cache')->selectitem('108>' . $wagetype . '>flag');
		if (!$JMODEL->wagetypeIs( $__wagetype )) {
			smsg( lang ('resume:100054') );
			return null;
		}
		if (!$JMODEL->wagetypeIsInput ( $__wagetype )) {
			$__tmpWage = null;
			if ($JMODEL->wagetypeFK ( $__wagetype ) == 'y') {
				$__tmpWage = $wage_year;
			} else if ($JMODEL->wagetypeFK ( $__wagetype ) == 'm') {
				$__tmpWage = $wage_month;
			}
			if (!_g('validate')->pnum( $__tmpWage )) {
				smsg( lang ('resume:100055') );
				return null;
			}
		} else {
			if (strlen ( $wage_input ) < 1) {
				$wage_input = '面议';
			} else {
				$wage_input = my_substr ( $wage_input, 0, 10 );
			}
		}
		/* workstatus */
		if (!_g('validate')->pnum( $workstatus )) {
			smsg( lang ('resume:100053') );
			return null;
		}
		/* selfintroduce */
		if (strlen($selfintroduce) < 1) {
			smsg( lang ('resume:100050') );
		}
		if(!_g('validate')->vm(strlen ( $selfintroduce ), 0, 3000)){
			smsg( lang ('resume:100003', 1000) );
			return null;
		}
		
		/* is exist */
		$wishRs = $RESUME->find ($RESUME->t_resume_wish, 'resumeid', $resumeid);
		if (!$RESUME->db->is_success ( $wishRs )) {
			smsg(lang('200013'));
			return null;
		}
		
		$wage = null;
		if ($wagetype >= 1) {
			switch (_g('cache')->selectitem('108>' . $wagetype . '>flag')) {
				case '122':
					$wage = $wage_year;
					break;
				case '116':
					$wage = $wage_month;
					break;
				default:
					$wage = $wage_input;
					break;
			}
		}
		
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'area' => $area,
				'professionid' => _g( 'value' )->s2pnsplit( $professionid ),
				'sortid2' => _g( 'value' )->s2pnsplit( $sortid2 ),
				'wagetype' => $wagetype,
				'wage' => $wage,
				'worktype' => $worktype,
				'workstatus' => $workstatus,
				'selfintroduce' => $selfintroduce,
				'keywords' => null
		);
		$s = null;
		if (my_is_array( $wishRs )) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			$s = $RESUME->update ($RESUME->t_resume_wish, $data, null, 'resumeid', $resumeid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_wish, $data);
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	
	/* educate */
	case 'educate':
		$educateid = _post( 'educateid' );
		
		$syear = _post ( 'syear' );
		$smonth = _post ( 'smonth' );
		$smonth = ( intval( $smonth ) < 10 ? ( '0' . $smonth ) : $smonth );
		
		$eyear = _post ( 'eyear' );
		$emonth = _post ( 'emonth' );
		
		$school = _post ( 'school' );
		$specialty = _post ( 'specialty' );
		$specialty_input = _post ( 'specialty_input' );
		$degree = _post ( 'degree' );
		$isallday = _post ( 'isallday' );
		$description = _post ( 'description' );
		$overseas_exp = _post ( 'overseas_exp' );
		
		$stime = strtotime ( $syear . $smonth . '01' );
		$etime = 0;
		
		if (_g( 'validate' )->pnum ( $eyear )) {
			$etimeStr = $eyear . '0101';
			if (_g( 'validate' )->pnum ( $emonth )) {
				$emonth = ( intval( $emonth ) < 10 ? ( '0' . $emonth ) : $emonth );
				$etimeStr = $eyear . $emonth . '01';
			}
			$etime = strtotime ( $etimeStr );
		}
		
		/* check */
		if (!_g ( 'validate' )->num ( $educateid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $school ), 1, 150)){
			smsg( lang ('resume:100006', array ( 1, 50 )) );
			return null;
		}
		/* no select specialty */
		if (strlen ($specialty) < 1) {
			if(!_g('validate')->vm(strlen ( $specialty_input ), 1, 150)){
				smsg( lang ('resume:100007', array ( 1, 50 )) );
				return null;
			}
		}
		
		if (strlen( $degree ) < 1) {
			smsg( lang ('resume:100009') );
			return null;
		}
		
		if(!_g('validate')->vm(strlen ( $description ), 1, 3000)){
			smsg( lang ('resume:100008', array (1, 1000)) );
			return null;
		}
		
		$isallday = _g ( 'value' )->sb ( $isallday );
		$overseas_exp = _g ( 'value' )->sb ( $overseas_exp );
		$ctime = _g ( 'cfg>time' );
		
		$isUpdate = _g ( 'validate' )->pnum ( $educateid );
		/* is exist */
		if ($isUpdate) {
			$educateRs = $RESUME->find ($RESUME->t_resume_educate, 'educateid', $educateid);
			if (!$RESUME->db->is_success ( $educateRs )) {
				smsg(lang('200013'));
				return null;
			}
			if (!my_is_array( $educateRs )) {
				smsg( lang ('resume:100010') );
				return null;
			}
		}
		
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'stime' => $stime,
				'etime' => $etime,
				'school' => $school,
				'specialty' => $specialty,
				'specialty_input' => $specialty_input,
				'degree' => $degree,
				'isallday' => $isallday,
				'description' => $description,
				'overseas_exp' => $overseas_exp,
				'ctime' => $ctime
		);
		$s = null;
		if ($isUpdate) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			unset ( $data['ctime'] );
			$s = $RESUME->update ($RESUME->t_resume_educate, $data, null, 'educateid', $educateid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_educate, $data);
			if ($s) {
				$educateid = $RESUME->db->insert_id ();
			}
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		
		/* callback data */
		$eRs = $RESUME->find ($RESUME->t_resume_educate, 'educateid', $educateid);
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_educate_item', true );
		$contentStr = ob_get_clean ();
		
		$cbParm = array(
				'status'=>1, 
				'dotype'=> ($isUpdate ? 'update' : 'add'),
				'educateid' => $educateid
		);
		smsg($contentStr, null, $cbParm);
		break;
	case 'educate_delete':
		$educateid = _post( 'educateid' );
		
		if (!_g ( 'validate' )->pnum ( $educateid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		$educateRs = $RESUME->find ($RESUME->t_resume_educate, 'educateid', $educateid);
		if (!$RESUME->db->is_success ( $educateRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $educateRs )) {
			if (!$RESUME->delete ($RESUME->t_resume_educate, 'educateid', $educateid)) {
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	
	/* train */	
	case 'train':
		$trainid = _post( 'trainid' );
		
		$syear = _post ( 'syear' );
		$smonth = _post ( 'smonth' );
		$smonth = ( intval( $smonth ) < 10 ? ( '0' . $smonth ) : $smonth );
		
		$eyear = _post ( 'eyear' );
		$emonth = _post ( 'emonth' );
		
		$organization = _post ( 'organization' );
		$area = _post ( 'area' );
		$course = _post ( 'course' );
		$certificate = _post( 'certificate' );
		$description = _post ( 'description' );
		$ispublish = _post ( 'ispublish' );
		
		$stime = strtotime ( $syear . $smonth . '01' );
		$etime = 0;
		
		if (_g( 'validate' )->pnum ( $eyear )) {
			$etimeStr = $eyear . '0101';
			if (_g( 'validate' )->pnum ( $emonth )) {
				$emonth = ( intval( $emonth ) < 10 ? ( '0' . $emonth ) : $emonth );
				$etimeStr = $eyear . $emonth . '01';
			}
			$etime = strtotime ( $etimeStr );
		}
		
		/* check */
		if (!_g ( 'validate' )->num ( $trainid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $organization ), 1, 150)){
			smsg( lang ('resume:100011', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $area ), 1, 180)){
			smsg( lang ('resume:100012', array ( 1, 60 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $course ), 1, 150)){
			smsg( lang ('resume:100013', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $description ), 1, 3000)){
			smsg( lang ('resume:100014', array (1, 1000)) );
			return null;
		}
		
		$ispublish = _g ( 'value' )->sb ( $ispublish );
		$ctime = _g ( 'cfg>time' );
		
		$isUpdate = _g ( 'validate' )->pnum ( $trainid );
		/* is exist */
		if ($isUpdate) {
			$trainRs = $RESUME->find ($RESUME->t_resume_train, 'trainid', $trainid);
			if (!$RESUME->db->is_success ( $trainRs )) {
				smsg(lang('200013'));
				return null;
			}
			if (!my_is_array( $trainRs )) {
				smsg( lang ('resume:100015') );
				return null;
			}
		}
		
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'stime' => $stime,
				'etime' => $etime,
				'organization' => $organization,
				'area' => $area,
				'course' => $course,
				'certificate' => $certificate,
				'description' => $description,
				'ctime' => $ctime,
				'ispublish' => $ispublish
		);
		$s = null;
		if ($isUpdate) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			unset ( $data['ctime'] );
			$s = $RESUME->update ($RESUME->t_resume_train, $data, null, 'trainid', $trainid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_train, $data);
			if ($s) {
				$trainid = $RESUME->db->insert_id ();
			}
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		
		/* callback data */
		$tRs = $RESUME->find ($RESUME->t_resume_train, 'trainid', $trainid);
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_train_item', true );
		$contentStr = ob_get_clean ();
		
		$cbParm = array(
				'status'=>1,
				'dotype'=> ($isUpdate ? 'update' : 'add'),
				'trainid' => $trainid
		);
		smsg($contentStr, null, $cbParm);
		break;
	case 'train_delete':
		$trainid = _post( 'trainid' );
		
		if (!_g ( 'validate' )->pnum ( $trainid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		$trainRs = $RESUME->find ($RESUME->t_resume_train, 'trainid', $trainid);
		if (!$RESUME->db->is_success ( $trainRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $trainRs )) {
			if (!$RESUME->delete ($RESUME->t_resume_train, 'trainid', $trainid)) {
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
		
	/* language */
	case 'language':
		$languageid = _post( 'languageid' );
		
		$ltype = _post ( 'ltype' );
		$level = _post ( 'level' );
		$rwability = _post ( 'rwability' );
		$lsability = _post( 'lsability' );
		
		/* check */
		if (!_g ( 'validate' )->num ( $languageid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		if (!_g ( 'validate' )->pnum ( $ltype )) {
			smsg( lang ('resume:100016') );
			return null;
		}
		
		$isUpdate = _g ( 'validate' )->pnum ( $languageid );
		/* is exist */
		if ($isUpdate) {
			$languageRs = $RESUME->find ($RESUME->t_resume_language, 'languageid', $languageid);
			if (!$RESUME->db->is_success ( $languageRs )) {
				smsg(lang('200013'));
				return null;
			}
			if (!my_is_array( $languageRs )) {
				smsg( lang ('resume:100017') );
				return null;
			}
		}
		
		$ctime = _g ( 'cfg>time' );
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'ltype' => $ltype,
				'level' => $level,
				'rwability' => $rwability,
				'lsability' => $lsability,
				'ctime' => $ctime
		);
		$s = null;
		if ($isUpdate) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			unset ( $data['ctime'] );
			$s = $RESUME->update ($RESUME->t_resume_language, $data, null, 'languageid', $languageid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_language, $data);
			if ($s) {
				$languageid = $RESUME->db->insert_id ();
			}
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		
		/* callback data */
		$lRs = $RESUME->find ($RESUME->t_resume_language, 'languageid', $languageid);
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_language_item', true );
		$contentStr = ob_get_clean ();
		
		$cbParm = array(
				'status'=>1,
				'dotype'=> ($isUpdate ? 'update' : 'add'),
				'languageid' => $languageid
		);
		smsg($contentStr, null, $cbParm);
		break;
	case 'language_delete':
		$languageid = _post( 'languageid' );
		
		if (!_g ( 'validate' )->pnum ( $languageid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		$languageRs = $RESUME->find ($RESUME->t_resume_language, 'languageid', $languageid);
		if (!$RESUME->db->is_success ( $languageRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $languageRs )) {
			if (!$RESUME->delete ($RESUME->t_resume_language, 'languageid', $languageid)) {
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	
	/* projectexp */
	case 'projectexp':
		$projectexpid = _post( 'projectexpid' );
		
		$syear = _post ( 'syear' );
		$smonth = _post ( 'smonth' );
		$smonth = ( intval( $smonth ) < 10 ? ( '0' . $smonth ) : $smonth );
		
		$eyear = _post ( 'eyear' );
		$emonth = _post ( 'emonth' );
		
		$pname = _post ( 'pname' );
		$tool = _post ( 'tool' );
		$hardware = _post ( 'hardware' );
		$software = _post( 'software' );
		$pdesc = _post ( 'pdesc' );
		$responsible = _post( 'responsible' );
		$ispublish = _post ( 'ispublish' );
		
		$stime = strtotime ( $syear . $smonth . '01' );
		$etime = 0;
		
		if (_g( 'validate' )->pnum ( $eyear )) {
			$etimeStr = $eyear . '0101';
			if (_g( 'validate' )->pnum ( $emonth )) {
				$emonth = ( intval( $emonth ) < 10 ? ( '0' . $emonth ) : $emonth );
				$etimeStr = $eyear . $emonth . '01';
			}
			$etime = strtotime ( $etimeStr );
		}
		
		/* check */
		if (!_g ( 'validate' )->num ( $projectexpid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $pname ), 1, 150)){
			smsg( lang ('resume:100018', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $tool ), 1, 150)){
			smsg( lang ('resume:100021', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $hardware ), 1, 150)){
			smsg( lang ('resume:100022', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $software ), 1, 150)){
			smsg( lang ('resume:100023', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $pdesc ), 1, 3000)){
			smsg( lang ('resume:100019', array (1, 1000)) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( responsible ), 1, 3000)){
			smsg( lang ('resume:100020', array (1, 1000)) );
			return null;
		}
		
		$isUpdate = _g ( 'validate' )->pnum ( $projectexpid );
		/* is exist */
		if ($isUpdate) {
			$projectexpRs = $RESUME->find ($RESUME->t_resume_projectexp, 'projectexpid', $projectexpid);
			if (!$RESUME->db->is_success ( $projectexpRs )) {
				smsg(lang('200013'));
				return null;
			}
			if (!my_is_array( $projectexpRs )) {
				smsg( lang ('resume:100015') );
				return null;
			}
		}
		
		$ispublish = _g ( 'value' )->sb ( $ispublish );
		$ctime = _g ( 'cfg>time' );
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'stime' => $stime,
				'etime' => $etime,
				'pname' => $pname,
				'tool' => $tool,
				'hardware' => $hardware,
				'software' => $software,
				'pdesc' => $pdesc,
				'responsible' => $responsible,
				'ctime' => $ctime,
				'ispublish' => $ispublish
		);
		$s = null;
		if ($isUpdate) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			unset ( $data['ctime'] );
			$s = $RESUME->update ($RESUME->t_resume_projectexp, $data, null, 'projectexpid', $projectexpid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_projectexp, $data);
			if ($s) {
				$projectexpid = $RESUME->db->insert_id ();
			}
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		
		/* callback data */
		$pRs = $RESUME->find ($RESUME->t_resume_projectexp, 'projectexpid', $projectexpid);
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_projectexp_item', true );
		$contentStr = ob_get_clean ();
		
		$cbParm = array(
				'status'=>1,
				'dotype'=> ($isUpdate ? 'update' : 'add'),
				'projectexpid' => $projectexpid
		);
		smsg($contentStr, null, $cbParm);
		break;
	case 'projectexp_delete':
		$projectexpid = _post( 'projectexpid' );
		
		if (!_g ( 'validate' )->pnum ( $projectexpid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		$projectexpRs = $RESUME->find ($RESUME->t_resume_projectexp, 'projectexpid', $projectexpid);
		if (!$RESUME->db->is_success ( $projectexpRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $projectexpRs )) {
			if (!$RESUME->delete ($RESUME->t_resume_projectexp, 'projectexpid', $projectexpid)) {
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	
	/* workexp */
	case 'workexp':
		$workexpid = _post( 'workexpid' );
		
		$syear = _post ( 'syear' );
		$smonth = _post ( 'smonth' );
		$smonth = ( intval( $smonth ) < 10 ? ( '0' . $smonth ) : $smonth );
		
		$eyear = _post ( 'eyear' );
		$emonth = _post ( 'emonth' );
		
		$company = _post ( 'company' );
		$professionid = _post ( 'professionid' );
		$csize = _post ( 'csize' );
		$nature = _post( 'nature' );
		$department = _post ( 'department' );
		$sortid2 = _post( 'sortid2' );
		$sortid2_input = _post ( 'sortid2_input' );
		$description = _post ( 'description' );
		$worktype = _post ( 'worktype' );
		
		$stime = strtotime ( $syear . $smonth . '01' );
		$etime = 0;
		
		if (_g( 'validate' )->pnum ( $eyear )) {
			$etimeStr = $eyear . '0101';
			if (_g( 'validate' )->pnum ( $emonth )) {
				$emonth = ( intval( $emonth ) < 10 ? ( '0' . $emonth ) : $emonth );
				$etimeStr = $eyear . $emonth . '01';
			}
			$etime = strtotime ( $etimeStr );
		}
		
		/* check */
		if (!_g ( 'validate' )->num ( $workexpid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $company ), 1, 150)){
			smsg( lang ('resume:100024', array ( 1, 50 )) );
			return null;
		}
		if (strlen($professionid) < 1) {
			smsg( lang ('resume:100025') );
			return null;
		}
		if ($csize < 1) {
			smsg( lang ('resume:100026') );
			return null;
		}
		if ($nature < 1) {
			smsg( lang ('resume:100027') );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $department ), 1, 150)){
			smsg( lang ('resume:100028', array ( 1, 50 )) );
			return null;
		}
		if (strlen($sortid2) < 1) {
			smsg( lang ('resume:100029') );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $sortid2_input ), 0, 150)){
			smsg( lang ('resume:100030', 50) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $description ), 1, 3000)){
			smsg( lang ('resume:100031', array ( 1, 1000 )) );
			return null;
		}
		if ($worktype < 1) {
			smsg( lang ('resume:100032') );
			return null;
		}
		
		$isUpdate = _g ( 'validate' )->pnum ( $workexpid );
		/* is exist */
		if ($isUpdate) {
			$workexpRs = $RESUME->find ($RESUME->t_resume_workexp, 'workexpid', $workexpid);
			if (!$RESUME->db->is_success ( $workexpRs )) {
				smsg(lang('200013'));
				return null;
			}
			if (!my_is_array( $workexpRs )) {
				smsg( lang ('resume:100015') );
				return null;
			}
		}
		
		$ctime = _g ( 'cfg>time' );
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'stime' => $stime,
				'etime' => $etime,
				'company' => $company,
				'professionid' => _g( 'value' )->s2pnsplit( $professionid ),
				'csize' => $csize,
				'nature' => $nature,
				'department' => $department,
				'sortid2' => $sortid2,
				'sortid2_input' => $sortid2_input,
				'description' => $description,
				'worktype' => $worktype,
				'ctime' => $ctime
		);
		$s = null;
		if ($isUpdate) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			unset ( $data['ctime'] );
			$s = $RESUME->update ($RESUME->t_resume_workexp, $data, null, 'workexpid', $workexpid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_workexp, $data);
			if ($s) {
				$workexpid = $RESUME->db->insert_id ();
			}
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		
		/* callback data */
		$wRs = $RESUME->find ($RESUME->t_resume_workexp, 'workexpid', $workexpid);
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_workexp_item', true );
		$contentStr = ob_get_clean ();
		
		$cbParm = array(
				'status'=>1,
				'dotype'=> ($isUpdate ? 'update' : 'add'),
				'workexpid' => $workexpid
		);
		smsg($contentStr, null, $cbParm);
		break;
	case 'workexp_delete':
		$workexpid = _post( 'workexpid' );
		
		if (!_g ( 'validate' )->pnum ( $workexpid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		$workexpRs = $RESUME->find ($RESUME->t_resume_workexp, 'workexpid', $workexpid);
		if (!$RESUME->db->is_success ( $workexpRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $workexpRs )) {
			if (!$RESUME->delete ($RESUME->t_resume_workexp, 'workexpid', $workexpid)) {
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
	
	/* attach */
	case 'attach':
		$attachid = _post( 'attachid' );
		
		$aname = _post ( 'aname' );
		$url = _post ( 'url' );
		$description = _post ( 'description' );
		$ispublish = _post( 'ispublish' );
		
		/* check */
		if (!_g ( 'validate' )->num ( $attachid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $aname ), 1, 150)) {
			smsg( lang ('resume:100033', array ( 1, 50 )) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $url ), 0, 900)) {
			smsg( lang ('resume:100034', 300) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $description ), 1, 3000)) {
			smsg( lang ('resume:100035', array ( 1, 1000 )) );
			return null;
		}
		
		$isUpdate = _g ( 'validate' )->pnum ( $attachid );
		/* is exist */
		$attachRs = null;
		if ($isUpdate) {
			$attachRs = $RESUME->find ($RESUME->t_resume_attach, 'attachid', $attachid);
			if (!$RESUME->db->is_success ( $attachRs )) {
				smsg(lang('200013'));
				return null;
			}
			if (!my_is_array( $attachRs )) {
				smsg( lang ('resume:100015') );
				return null;
			}
		}
		
		/* upload */
		$isUpload = false;
		$fileData = _ifile('src');
		if(strlen( $fileData['name'] ) >= 1){
			$extFileStr = '*.zip;*.rar;*.psd';
			$extFileArr = array ('zip', 'rar', 'psd');
				
			if($fileData['size'] < 1){
				smsg(lang(300010));
				return null;
			}
			if(!_g('validate')->filetype($fileData['name'], $extFileArr)){
				smsg(lang(300005, $extFileStr));
				return null;
			}
			if(_g('validate')->fsover($fileData['size'], 4)){
				smsg(lang(300006, 4));
				return null;
			}
				
			/* 保存目录 */
			$rootDir = sdir(':uploadfile');
			$saveDir = 'resume/attach/' . date('Ym');
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($fileData['name']);
				
			/* 更新原文件 */
			if($isUpdate){
				if (strlen ( $attachRs['src'] ) >= 1) {
					if(!_g('file')->delete($rootDir . '/' . $attachRs['src'])){
						smsg ( lang ( 'resume:100036' ) );
						return null;
					}
				}
			}
			$isUpload = true;
		}
		
		$ispublish = _g ( 'value' )->sb ( $ispublish );
		$ctime = _g ( 'cfg>time' );
		
		$src = my_array_value( 'src', $attachRs );
		if ($isUpload) {
			$src = $sfname;
		}
		
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'aname' => $aname,
				'url' => $url,
				'src' => $src,
				'description' => $description,
				'ctime' => $ctime,
				'ispublish' => $ispublish
		);
		$s = null;
		if ($isUpdate) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			unset ( $data['ctime'] );
			$s = $RESUME->update ($RESUME->t_resume_attach, $data, null, 'attachid', $attachid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_attach, $data);
			if ($s) {
				$attachid = $RESUME->db->insert_id ();
			}
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		
		/* upload file */
		if ($isUpload) {
			if(!move_uploaded_file($fileData['tmp_name'], ($rootDir . '/' . $sfname))){
				smsg(lang('300002'));
				return null;
			}
		}
		
		/* callback data */
		$aRs = $RESUME->find ($RESUME->t_resume_attach, 'attachid', $attachid);
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_attach_item', true );
		$contentStr = ob_get_clean ();
		
		$cbParm = array(
				'status'=>1,
				'dotype'=> ($isUpdate ? 'update' : 'add'),
				'attachid' => $attachid
		);
		smsg($contentStr, null, $cbParm);
		break;
	case 'attach_delete':
		$attachid = _post( 'attachid' );
		
		if (!_g ( 'validate' )->pnum ( $attachid )) {
			smsg ( lang ( '200010' ) );
			return null;
		}
		$attachRs = $RESUME->find ($RESUME->t_resume_attach, 'attachid', $attachid);
		if (!$RESUME->db->is_success ( $attachRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $attachRs )) {
			if (strlen ( $attachRs['src'] ) >= 1) {
				if(!_g('file')->delete( _g ( 'file' )->uploadfile($attachRs['src']) )){
					smsg ( lang ( 'resume:100037' ) );
					return null;
				}
			}
			if (!$RESUME->delete ($RESUME->t_resume_attach, 'attachid', $attachid)) {
				smsg(lang('200013'));
				return null;
			}
		}
		smsg(lang('100061'), null, 1);
		break;
		
	/* relate */
	case 'relate':
		$englishlv = _post ( 'englishlv' );
		$japaneselv = _post ( 'japaneselv' );
		$explaintype = _post ( 'explaintype' );
		$explaintype_input = _post ( 'explaintype_input' );
		$explaindesc = _post ( 'explaindesc' );
		$explainis = _post ( 'explainis' );
		
		/* check */
		if(!_g('validate')->vm(strlen ( $explaintype_input ), 0, 150)){
			smsg( lang ('resume:100038', 50) );
			return null;
		}
		if(!_g('validate')->vm(strlen ( $explaindesc ), 0, 3000)){
			smsg( lang ('resume:100039', 1000) );
			return null;
		}
		
		/* is exist */
		$relateRs = $RESUME->find ($RESUME->t_resume_relate, 'resumeid', $resumeid);
		if (!$RESUME->db->is_success ( $relateRs )) {
			smsg(lang('200013'));
			return null;
		}
		
		$explainis = _g ( 'value' )->sb ( $explainis );
		/* data */
		$data = array (
				'resumeid' => $resumeid,
				'uid' => $uid,
				'englishlv' => $englishlv,
				'japaneselv' => $japaneselv,
				'explaintype' => $explaintype,
				'explaintype_input' => $explaintype_input,
				'explaindesc' => $explaindesc,
				'explainis' => $explainis
		);
		$s = null;
		if (my_is_array( $relateRs )) {
			unset ( $data['resumeid'] );
			unset ( $data['uid'] );
			$s = $RESUME->update ($RESUME->t_resume_relate, $data, null, 'resumeid', $resumeid);
		} else {
			$s = $RESUME->insert ($RESUME->t_resume_relate, $data);
		}
		if (!$s) {
			smsg(lang('200013'));
			return null;
		}
		smsg(lang('100061'), null, 1);
		break;
	
	default:
		smsg( lang( 200001 ) );
		break;
}
?>