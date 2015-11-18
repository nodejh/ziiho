<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$JOBMODEL = _g('module')->trigger('job', 'model');
$RESUME = _g('module')->trigger('resume');
$RESUMEMODEL = _g('module')->trigger('resume', 'model');

switch (_get ( 'op' )) {
	default :
		$resumeid = _get('rid');
		if (!_g( 'validate' )->num ( $resumeid )) {
			smsg ( lang( '200010' ) );
			return null;
		}
		
		$resumeSub = $RESUME->find ($RESUME->t_resume, 'resumeid', $resumeid);
		if(my_is_array( $resumeSub )) {
			if (!my_is_array( $resumeSub )) {
				smsg( lang ('resume:100042') );
				return null;
			}
		}
		
		/* profile */
		$profileData = $RESUME->find ($RESUME->t_resume_profile, 'uid', $resumeSub['uid']);
		
		/* wish */
		$wishData = $RESUME->find ($RESUME->t_resume_wish, 'resumeid', $resumeid);
		if (my_is_array($wishData)) {
			$wishData['hangye'] = $JOBMODEL->sortShow($wishData['sortid']);
			$wishData['zhiwei'] = $JOBMODEL->sortShow($wishData['sortid2']);
		}
		
		/* degree */
		$degreeData = $RESUME->find ( $RESUME->t_resume_educate, 'resumeid', $resumeid, array('ctime', 'desc'));
		if (strlen(my_array_value('specialty_input', $degreeData)) >= 1) {
			$degreeData['specialty_input'] = '(' . $degreeData['specialty_input'] . ')';
		}
		/* educate */
		$educateData = $RESUME->finds ( $RESUME->t_resume_educate, 'resumeid', $resumeid);
		
		/* train */
		$trainData = $RESUME->finds ( $RESUME->t_resume_train, array('resumeid'=>$resumeid, 'ispublish'=>1));
		
		/* language */
		$languageData = $RESUME->finds ( $RESUME->t_resume_language, 'resumeid', $resumeid);
		
		/* projectexp */
		$projectexpData = $RESUME->finds ( $RESUME->t_resume_projectexp, array('resumeid'=>$resumeid, 'ispublish'=>1), null);
		
		/* last work */
		$lastWorkData = $RESUME->find ( $RESUME->t_resume_workexp, 'resumeid', $resumeid, array('ctime', 'desc'));
		if (my_is_array( $lastWorkData )) {
			$lastWorkData['hangye'] = $JOBMODEL->sortShow($lastWorkData['sortid']);
			if (strlen(my_array_value('sortid2_input', $lastWorkData)) >= 1) {
				$lastWorkData['sortid2_input'] = '(' . $lastWorkData['sortid2_input'] . ')';
			}
		}
		/* workexp */
		$workexpData = $RESUME->finds ( $RESUME->t_resume_workexp, 'resumeid', $resumeid);
		
		/* attach */
		$attachData = $RESUME->finds ( $RESUME->t_resume_attach, array('resumeid' => $resumeid, 'ispublish'=>1));
		
		/* relate */
		$relateData = $RESUME->find ( $RESUME->t_resume_relate, array('resumeid'=>$resumeid, 'explainis'=>1));
		
		/* print view */
		$viewTpl = 'view';
		$isOut = (_get('out') === 'yes');
		if ($isOut) {
			$viewTpl = 'view-out';
			_g('value')->outdoc();
		}
		
		include _g ( 'template' )->name ( 'resume', $viewTpl, true );
		break;
}
?>