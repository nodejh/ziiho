<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}

$MUBAN = _g('module')->trigger('muban', 'muban');
$MINTENTION = _g('module')->trigger('muban', 'intention');
$MTYPE = _g('module')->trigger('muban', 'type');
$MLANGUAGE = _g('module')->trigger('muban', 'language');
$MHTML = _g('module')->trigger('muban', 'html');
$MCATEGORY = _g('module')->trigger('muban', 'category');

$intention = $MINTENTION->find_array('iid', '0', '>'); //求职意向
$type = $MTYPE->find_array('tid', '0', '>'); //模板风格
$language = $MLANGUAGE->find_array('lid', '0', '>'); //模板语言


switch (_get ( 'op' )) {
	case 'muban':

        //替换分类ID为分类名称
        foreach($muban as $k => $v){
            $res = $MCATEGORY->find('cid', $v['8'], '=');
            $muban[$k]['8'] = $res[1];
        }
        //查询所有
        if (_get('o') == 1) {
            $order = 'mbcount desc';
            $muban = $MUBAN->find_array('mbid', '0', '>', $order);
        } else {
            $muban = $MUBAN->find_array('mbid', '0', '>');
        }
		include _g ( 'template' )->name ( 'job', 'jianli_muban', true );
		break;
	case 'muban_detail':
        $mbid = _get ('mbid');
        $muban = $MUBAN->find('mbid', $mbid);
		include _g ( 'template' )->name ( 'job', 'jianli_muban_detail', true );
		break;
    case 'muban_use':
        $mbid = _get('mbid');
        $html = $MHTML->find('mbid', $mbid);
        $muban = $MUBAN->find('mbid', $mbid);
        include _g( 'template' )->name( 'job', 'jianli_muban_use', true );
        break;
    case 'muban_save':
        //var_dump($_POST);
        break;
	default :
		include _g ( 'template' )->name ( 'job', 'jianligonglue', true );
		break;
}
?>