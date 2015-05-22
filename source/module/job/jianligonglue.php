<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

//$job_muban_intenttion = '求职意向';
//$job_muban_type = '模板类型';
//$job_muban_language = '简历语言';

//$JMUBAN = _g('module')->trigger('muban', 'muban'); //cs_muban_muban


switch (_get ( 'op' )) {
	case 'muban':
        //$a = $JMUBAN->db->select();
        //$b = $JMUBAN->db->get_list();

		include _g ( 'template' )->name ( 'job', 'jianli_muban', true );
		break;
	case 'muban_detail':
		include _g ( 'template' )->name ( 'job', 'jianli_muban_detail', true );
		break;
    case 'muban_use':
        include _g( 'template' )->name( 'job', 'jianli_muban_use', true );
        break;
	default :
		include _g ( 'template' )->name ( 'job', 'jianligonglue', true );
		break;
}
?>