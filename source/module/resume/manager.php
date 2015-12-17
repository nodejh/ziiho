<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JMODEL = _g('module')->trigger('job', 'model');
$RESUME = _g('module')->trigger('resume');

switch (_get ( 'op' )) {
	case 'write':
		$resumeSub = array ( 'rname' => ('我的简历' . _g('value')->randchar(4)) );
		$wishSub = array ();
		$educateData = array (0, null);
		
		$resumeid = 0;
		if (_g( 'validate' )->hasget( 'rid' )) {
			$resumeid = _get( 'rid' );
			if (!_g( 'validate' )->pnum( $resumeid )) {
				smsg ( lang( '200010' ) );
				return null;
			}
			$resumeid = $RESUME->getId ( $resumeid );
		} else {
			$resumeid = $RESUME->getId ();
		}
		
		/* profile */
		$resumeProfile = $RESUME->find ($RESUME->t_resume_profile, 'uid', $uid);
		/* result */
		if (!empty( $resumeid )) {
			$resumeSub = $RESUME->find ($RESUME->t_resume, 'resumeid', $resumeid);
			$wishSub = $RESUME->find ($RESUME->t_resume_wish, 'resumeid', $resumeid);
			
			/* educate */
			$educateData = $RESUME->finds ( $RESUME->t_resume_educate, 'resumeid', $resumeid);
			
			/* train */
			$trainData = $RESUME->finds ( $RESUME->t_resume_train, 'resumeid', $resumeid);
			
			/* language */
			$languageData = $RESUME->finds ( $RESUME->t_resume_language, 'resumeid', $resumeid);
			
			/* projectexp */
			$projectexpData = $RESUME->finds ( $RESUME->t_resume_projectexp, 'resumeid', $resumeid);
			
			/* workexp */
			$workexpData = $RESUME->finds ( $RESUME->t_resume_workexp, 'resumeid', $resumeid);
			
			/* attach */
			$attachData = $RESUME->finds ( $RESUME->t_resume_attach, 'resumeid', $resumeid);
			
			/* relate */
			$relateData = $RESUME->find ( $RESUME->t_resume_relate, 'resumeid', $resumeid);
		}
		
		include _g ( 'template' )->name ( 'resume', 'write', true );
		break;
	case 'writedo':
		$resumeid = $RESUME->getId ();
		/* var */
		$m_rname = _post ( 'm_rname' );
		$m_publishlv = _post ( 'm_publishlv' );
		
		if(!_g('validate')->vm(strlen ( $m_rname ), 1, 60)){
			smsg( lang('resume:100002', array ( 1, 20 )) );
			return null;
		}
		$m_publishlv = ( _g ( 'validate' )->pnum ( $m_publishlv ) ? $m_publishlv : -1 );
		
		$ctime = _g ( 'cfg>time' );
		/* resume data */
		$data = array ( 
				'rname' => $m_rname,
				'ctime' => $ctime,
				'mtime' => $ctime,
				'publishlv' => $m_publishlv,
				'uid' => $uid
		);
		if (!$RESUME->chkId ()) {
			if (!$RESUME->insert( $RESUME->t_resume, $data )) {
				smsg(lang('200013'));
				return null;
			}
			$resumeid = $RESUME->getId ( $RESUME->db->insert_id () );
		} else {
			unset ($data['ctime']);
			unset ($data['uid']);
			if (!$RESUME->update( $RESUME->t_resume, $data, null, 'resumeid', $resumeid )) {
				smsg(lang('200013'));
				return null;
			}
		}
		
		include _g( 'module' )->helper ( 'resume', 'writedo' );
		break;
	case 'delete':
		$resumeid = _post( 'resumeid' );
		if (!_g( 'validate' )->num ( $resumeid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		$resumeSub = $RESUME->find ($RESUME->t_resume, 'resumeid', $resumeid);
		if (!$RESUME->db->is_success ($resumeSub)) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $resumeSub )){
			/* attach delete */
			$attachData = $RESUME->finds ( $RESUME->t_resume_attach, 'resumeid', $resumeid);
			if (!$RESUME->db->is_success ( $attachData[1] )) {
				smsg(lang('200013'));
				return null;
			}
			if ($attachData[0] >= 1) {
				while ($aRs = $RESUME->db->fetch_array ($attachData[1])) {
					if (strlen( $aRs['src'] ) >= 1) {
						if(!_g('file')->delete(_g ( 'file' )->uploadfile($aRs['src']))){
							smsg ( lang ( 'resume:100037' ) );
							return null;
						}
					}
				}
			}
			
			/* data delete */
			$tables = array( 'resume', 'resume_attach', 'resume_educate', 'resume_language',
					'resume_projectexp', 'resume_relate', 'resume_train', 'resume_wish', 'resume_workexp' );
			foreach ($tables as $t) {
				if (!$RESUME->delete( $t, 'resumeid', $resumeid )) {
					smsg(lang('200013'));
					return null;
				}
			}
		}
		
		smsg(lang('100061'), null, 1);
		break;
	/* form */
	case 'educate_form':
		$educateid = _post( 'educateid' );
		
		$educateRs = array ();
		if (!_g( 'validate' )->num ( $educateid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		if (_g( 'validate' )->pnum ( $educateid )) {
			$educateRs = $RESUME->find ($RESUME->t_resume_educate, 'educateid', $educateid);
			if (!$RESUME->db->is_success ( $educateRs )) {
				smsg(lang('200013'));
				return null;
			}
			$educateRs = $RESUME->toData( $educateRs );
		}
		
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_educate_form', true );
		$contentStr = ob_get_clean ();
		
		smsg(($contentStr), null, 1);
		break;
		
	case 'train_form':
		$trainid = _post( 'trainid' );
		
		$trainRs = array ();
		if (!_g( 'validate' )->num ( $trainid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		if (_g( 'validate' )->pnum ( $trainid )) {
			$trainRs = $RESUME->find ($RESUME->t_resume_train, 'trainid', $trainid);
			if (!$RESUME->db->is_success ( $trainRs )) {
				smsg(lang('200013'));
				return null;
			}
			$trainRs = $RESUME->toData( $trainRs );
		}
		
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_train_form', true );
		$contentStr = ob_get_clean ();
		
		smsg(($contentStr), null, 1);
		break;
		
	case 'language_form':
		$languageid = _post( 'languageid' );
		
		$languageRs = array ();
		if (!_g( 'validate' )->num ( $languageid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		if (_g( 'validate' )->pnum ( $languageid )) {
			$languageRs = $RESUME->find ($RESUME->t_resume_language, 'languageid', $languageid);
			if (!$RESUME->db->is_success ( $languageRs )) {
				smsg(lang('200013'));
				return null;
			}
			$languageRs = $RESUME->toData( $languageRs );
		}
		
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_language_form', true );
		$contentStr = ob_get_clean ();
		
		smsg(($contentStr), null, 1);
		break;
		
	case 'projectexp_form':
		$projectexpid = _post( 'projectexpid' );
		
		$projectexpRs = array ();
		if (!_g( 'validate' )->num ( $projectexpid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		if (_g( 'validate' )->pnum ( $projectexpid )) {
			$projectexpRs = $RESUME->find ($RESUME->t_resume_projectexp, 'projectexpid', $projectexpid);
			if (!$RESUME->db->is_success ( $projectexpRs )) {
				smsg(lang('200013'));
				return null;
			}
			$projectexpRs = $RESUME->toData( $projectexpRs );
		}
		
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_projectexp_form', true );
		$contentStr = ob_get_clean ();
		
		smsg(($contentStr), null, 1);
		break;
	
	case 'workexp_form':
		$workexpid = _post( 'workexpid' );
		
		$workexpRs = array ();
		if (!_g( 'validate' )->num ( $workexpid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		if (_g( 'validate' )->pnum ( $workexpid )) {
			$workexpRs = $RESUME->find ($RESUME->t_resume_workexp, 'workexpid', $workexpid);
			if (!$RESUME->db->is_success ( $workexpRs )) {
				smsg(lang('200013'));
				return null;
			}
			$workexpRs = $RESUME->toData( $workexpRs );
		}
		
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_workexp_form', true );
		$contentStr = ob_get_clean ();
		
		smsg(($contentStr), null, 1);
		break;
		
	case 'attach_form':
		$attachid = _post( 'attachid' );
		
		$attachRs = array ();
		if (!_g( 'validate' )->num ( $attachid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		if (_g( 'validate' )->pnum ( $attachid )) {
			$attachRs = $RESUME->find ($RESUME->t_resume_attach, 'attachid', $attachid);
			if (!$RESUME->db->is_success ( $attachRs )) {
				smsg(lang('200013'));
				return null;
			}
			$attachRs = $RESUME->toData( $attachRs );
			if (strlen( $attachRs['src'] ) >= 1) {
				$attachRs['srcname'] = my_end(my_explode('/', $attachRs['src']));
			}
		}
		
		ob_start();
		include _g ( 'template' )->name ( 'resume', 'write_attach_form', true );
		$contentStr = ob_get_clean ();
		
		smsg(($contentStr), null, 1);
		break;
	case 'attach_fdel':
		$attachid = _post( 'attachid' );
		
		if (!_g( 'validate' )->pnum ( $attachid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		$attachRs = $RESUME->find ($RESUME->t_resume_attach, 'attachid', $attachid);
		if (!$RESUME->db->is_success ( $attachRs )) {
			smsg(lang('200013'));
			return null;
		}
		if (my_is_array( $attachRs )) {
			if (strlen( $attachRs['src'] ) >= 1) {
				if(!_g('file')->delete(_g ( 'file' )->uploadfile($attachRs['src']))){
					smsg ( lang ( 'resume:100037' ) );
					return null;
				}
				if (!$RESUME->update ($RESUME->t_resume_attach, 'src', null, 'attachid', $attachid)) {
					smsg(lang('200013'));
					return null;
				}
			}	
		}
		smsg(lang('100061'), null, 1);
		break;
	default :
		_g('uri')->referer(true);
		$RESUME->delId ();
		
		$RESUME->db->from($RESUME->t_resume);
		$RESUME->db->where('uid', $uid);
		$pageData = _g('page')->c($RESUME->db->count(), 10, 10, _get('page'));
		$RESUME->db->limit($pageData['start'], $pageData['size']);
		$RESUME->db->order_by('ctime');
		$RESUME->db->select();
		$resumeResult = $RESUME->db->get_list();
		$pageData['uri'] = 'resume/ac/manager/page/';
		
		$writeUrl = _g('uri')->su('resume/ac/manager/op/write');
		$delUrl = _g('uri')->su('resume/ac/manager/op/delete');
		
		include _g ( 'template' )->name ( 'resume', 'manager', true );
		break;
}
?>