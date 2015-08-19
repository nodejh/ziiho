<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$RESUME = _g('module')->trigger('resume');

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
		
		
		include _g ( 'template' )->name ( 'resume', 'view', true );
		break;
}
?>