<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$MUBAN = _g('module')->trigger('muban', 'muban');
$MINTENTION = _g('module')->trigger('muban', 'intention');
$MTYPE = _g('module')->trigger('muban', 'type');
$MLANGUAGE = _g('module')->trigger('muban', 'language');

$intention =  $MINTENTION->finds(); //求职意向
$type = $MTYPE->find(); //模板风格
$language = $MLANGUAGE->find(); //简历语言
var_dump($intention);

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