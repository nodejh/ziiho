<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_model extends geshai_model {
	
	public $sysField = 'sys';
	public $myField = 'my';
	
	function __construct() {
		parent::__construct ();
	}
	function class_job_model() {
		$this->__construct ();
	}
	/* page */
	function page(&$data = null, $t = 'page'){
		$filename = _g ( 'template' )->name ( '@', $t, true );
		if(is_file($filename)){
			$data = _g('value')->ra($data);
			include ($filename);
		}
	}
	
	function nav($t = null){
		$__isFlag = false;
		$data = include _g('module')->helper('job', $t);
		
		include _g ( 'template' )->name ( 'job', 'job-nav', true );
	}
	
	function readSort($parentid = 0){
		$data = array();
		$cacheFile = sdir(':data') . '/cache/job/sort.php';
		if(is_file($cacheFile)){
			$arr = include $cacheFile;
			if(my_is_array($arr)){
				foreach ($arr as $v){
					if($parentid != $v['parentid']){
						continue;
					}
					$data[] = $v;
				}
			}
		}
		return $data;
	}
	function sortValue($sortid, $k = null){
		$data = array();
		$arr = null;
		$cacheFile = sdir(':data') . '/cache/job/sort.php';
		if(is_file($cacheFile)){
			$arr = include $cacheFile;
			$arr = my_array_value($sortid, $arr);
			
			if(func_num_args() > 1){
				$data = my_array_value($k, $arr);
			}else{
				$data = (is_array($arr) ? $arr : array());
			}
		}
		return $data;
	}
	function sortShow($sortid, $k = null){
		$__sortid = null;
		$__value = null;
		$__data = array();
		if(preg_match_all("/(\d+)/", $sortid, $__sortid)){
			$cacheFile = sdir(':data') . '/cache/job/sort.php';
			if(is_file($cacheFile)){
				$arr = include $cacheFile;
			}
			foreach ((is_array($__sortid[0]) ? $__sortid[0] : array()) as $id){
				$__value = my_array_value($id, $arr);
				if(func_num_args() > 1){
					$__data[] = my_array_value($k, $__value);
				}else{
					$__data[] = $__value;
				}
			}
		}
		if(func_num_args() > 1){
			$__data = my_join('<br/>', $__data);
		}
		return $__data;
	}
	
	function sortSrc($value = null){
		if(strlen($value) < 1){
			return null;
		}
		return (sdir('uploadfile') . '/' . $value);
	}
	
	function src($value = null){
		if(strlen($value) < 1){
			return (_g('template')->dir('job') . '/image/def/nopicture.jpg');
		}
		return (sdir('uploadfile') . '/' . $value);
	}
	
	function readArea($parentid = 0){
		$data = array();
		$cacheFile = sdir(':data') . '/cache/job/area.php';
		if(is_file($cacheFile)){
			$arr = include $cacheFile;
			if(my_is_array($arr)){
				foreach ($arr as $v){
					if($parentid != $v['parentid']){
						continue;
					}
					$data[] = $v;
				}
			}
		}
		return $data;
	}
	function areaValue($areaid, $k = null){
		$data = array();
		$arr = null;
		$cacheFile = sdir(':data') . '/cache/job/area.php';
		if(is_file($cacheFile)){
			$arr = include $cacheFile;
			$arr = my_array_value($areaid, $arr);
		}
		if(func_num_args() > 1){
			$data = my_array_value($k, $arr);
		}else{
			$data = (is_array($arr) ? $arr : array());
		}
		return $data;
	}
	function areaPos($areaid, $detail = null){
		$data = null;
		$areaid = my_end(my_explode(',', $areaid));
		if(!_g('validate')->pnum($areaid)){
			return '&nbsp;' . $detail;
		}
		$area = _g('module')->trigger('job', 'area');
		$pos = $area->cpos($areaid);
		
		foreach ($pos as $v){
			$data .= $v['aname'] . '&nbsp;';
		}
		return ($data . $detail);
	}
	function areaGet($d, $isArray = false){
		$rdValue = ($isArray === true ? array() : null);
		$data = array();
		if (!is_array($d)) {
			if (preg_match_all("/(\d+)/", $d, $data)){
				$data = $data[0];
			}
		} else {
			$data = $d;
		}
		if (!my_is_array($data)) {
			return $rdValue;
		}
		$isflag = false;
		foreach ($data as $__id) {
			if ($isArray === true) {
				$rdValue[] = $this->areaValue($__id);
			} else {
				if ($isflag){
					$rdValue .= '&nbsp;';
				}
				$rdValue .= $this->areaValue($__id, 'aname');
			}
			$isflag = true;
		}
		return $rdValue;
	}
	function qsType($key = null, $key2 = null){
		$arr = _g ( 'value' )->ra ( _g ( 'module' )->dv ( 'job', 100000 ) );
		switch (func_num_args()){
			case 1:
				return my_array_value($key, $arr);
				break;
			case 2:
				return my_array_value($key . '>' . $key2, $arr);
				break;
			default:
				return $arr;
				break;
		}
	}
	
	function qsHasType($k){
		return my_array_key_exist($k, $this->qsType());
	}
	
	function qsTypeGroup($value = null){
		if(in_array($value, array('radio', 'checkbox'))){
			return 100;
		}else if(in_array($value, array('input', 'textarea'))){
			return 200;
		}
	}
	
	function qsOptionIdChk($value = null){
		if(strlen($value) < 15){
			return false;
		} else {
			return true;
		}
	}
	
	function qsOptionId($value = null){
		if (!$this->qsOptionIdChk ( $value )) {
			return (_g('cfg>time') . _g('value')->randchar(9));
		}else{
			return $value;
		}
	}
	
	function qsOptionDe($option){
		return _g('value')->ra(str2array($option));
	}
	function qsOptionOrder($num){
		$arr = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';
		return my_array_value($num, explode(',', $arr), $num);
	}
	function qs2Answer($option, $answer){
		$option = $this->qsOptionDe($option);
		$answer = $this->qsOptionDe($answer);
		
		$value = null;
		$flag = false;
		foreach($answer as $k){
			$value .= ($flag ? ',' : null);
			$value .= my_array_value( $k . '>flag', $option, '-' );
			$flag = true;
		}
		return $value;
	}
	function Provide2QuestionFrom ($v) {
		$arr = array( 1 => '自定义' , 2 => '系统' );
		return my_array_value ( $v, $arr, '未知' );
	}
	function examIdDe($v){
		if (preg_match("/^(sys|my)_(\d+)$/i", $v, $matchs)) {
			return array ($matchs[1], $matchs[2]);
		} else {
			if (preg_match("/^(\w+)_(\d+)$/", $v, $matchs)) {
				return array ($matchs[1], $matchs[2]);
			} else {
				$t = _g ( 'cfg>time' );
				return array ($t . _g('value')->randchar(10), $t . _g('value')->randchar(10));
			}
		}
	}
	function toExam($modeltype, $data){
		if ($modeltype == 'my') {
			$data['idstr'] = 'my_' . $data['esid'];
			return $data;
		}
		$rd = array ();
		if ($modeltype == 'sys') {
			$rd['esid'] = $data['qsid'];
			$rd['idstr'] = $modeltype . '_' . $data['qsid'];
			$rd['estitle'] = $data['title'];
			$rd['essrc'] = $data['src'];
			$rd['estype'] = $data['stype'];
			$rd['esoption'] = $data['option'];
			$rd['esanswer'] = $data['answer'];
		} else {
			$rd['esid'] = $data['syntheticid'];
			$rd['idstr'] = $modeltype . '_' . $data['syntheticid'];
			$rd['estitle'] = $data['title'];
			$rd['essrc'] = $data['src'];
			$rd['estype'] = $data['stype'];
			$rd['esoption'] = $data['option'];
			$rd['esanswer'] = $data['answer'];
		}
		return $rd;
	}
	function myExamAnswer($id, $type, $option, $data) {
		$data = my_array_value('records', $data);
		$data = my_array_value('my', str2array( $data ));
		$data = my_explode(',', my_array_value( $id . '>' . $type, $data ));
		
		if (!my_is_array( $data )) {
			return null;
		}
		$option = $this->qsOptionDe ( $option );
		$value = null;
		$flag = false;
		foreach ($data as $k) {
			$value .= ($flag ? ',' : null);
			$value .= my_array_value( $k . '>flag', $option, '-' );
			$flag = true;
		}
		return $value;
	}
	function examAnswerField($d) {
		$d = str2array( my_array_value( 'fields', $d ) );
		return ( is_array( $d ) ? $d : array () );
	}
	function authFieldOrder($k, $d, $r = 0) {
		$value = array (1, '&or;');
		if (my_array_key_exist( 'mt' , $d)) {
			$name = my_array_value( 0, $d['mt']);
			if ($name == $k) {
				if (my_array_value( 1, $d['mt']) == 1) {
					$value = array(2, '&and;');
				}
			} else {
				if ($r == 1) {
					return null;
				}
			}
		} else {
			if ($r == 1) {
				return null;
			}
		}
		return my_array_value( $r, $value );
	}
	/* check for request job */
	function chkRequestJob($jobid){
		if (!_g ( 'validate' )->pnum ( $jobid )) {
			return lang ( 200010 );
		}
		$um = _g('module')->trigger('user', 'model');
		$logintype = $um->suser('login_type');
		if ($logintype == 2 || $logintype != 1) {
			return lang ( 'job:600004' );
		}
		$uid = $um->suser ( 'uid' );
		if (!_g ( 'validate' )->pnum ( $uid )) {
			return lang ( 'user:100024' );
		}
		
		$db = _g ( 'db' );
		
		/* job is exist */
		$db->from ( 'job_job' );
		$db->where ( 'jobid', $jobid );
		$db->where ( 'status', 1 );
		$db->select ();
		if (!$db->is_success ()) {
			return lang ( '200013' );
		}
		$jobRs = $db->get_one ();
		if (!my_is_array( $jobRs )) {
			return lang ( 'job:900000' );
		}
		if ($jobRs['isauth'] == 1) {
			$db->from ( 'job_examsubject_record' );
			$db->where ( 'uid', $uid );
			$db->where ( 'jobid', $jobid );
			$db->select ();
			if (!$db->is_success ()) {
				return lang ( '200013' );
			}
			$examRecordRs = $db->get_one ();
			if ( !my_is_array( $examRecordRs ) ) {
				return lang ( 'job:900002' );
			}
		}
		
		/* resume is exist */
		$db->from ( 'resume' );
		$db->where ( 'uid', $uid );
		$resumeCount = $db->count ();
		$db->select ();
		if (!$db->is_success ()) {
			return lang ( '200013' );
		}
		if ($resumeCount < 1) {
			return lang ( 'resume:100040' );
		}
		
		/* record is exist */
		$db->from ( 'job_apply_record' );
		$db->where ( 'uid', $uid );
		$db->where ( 'jobid', $jobid );
		$db->order_by ( 'ctime', 'desc' );
		$db->select ();
		if (!$db->is_success ()) {
			return lang ( '200013' );
		}
		$recordRs = $db->get_one ();
		if (my_is_array( $recordRs )) {
			$time = $recordRs['ctime'] + (86400 * 7);
			if ( $time > _g ( 'cfg>time' )) {
				return lang ( 'job:900001' );
			}
		}
		return $jobRs;
	}
	function wagetypeName($k){
		$arr = array('122'=>'年', '116'=>'月', 'day'=>'天', 'hour'=>'小时');
		return my_array_value($k, $arr);
	}
	function workyear($k1 = null, $k2 = null) {
		$data = _g('cache')->selectitem(101);
		$args = func_num_args();
		if ($args < 1) {
			return $data;
		} else if ($args == 1) {
			return my_array_value ($k1, $data);
		} else {
			return my_array_value ($k1 . '>' . $k2, $data);
		}
	}
	function workyearFlag($k) {
		$v = $this->workyear($k, 'flag');
		if (!preg_match("/^(-)?\d+$/", $v)) {
			return -1;
		}
		return $v;
	}
	function workyearFlag2Value($flag, $kn = 'sname') {
		$d = null;
		foreach ($this->workyear() as $k=>$v) {
			if ($v['flag'] == $flag) {
				$d = $v;
				$d['id'] = $k;
			}
		}
		return my_array_value($kn, $d);
	}
	/* 座机联系方式 */
	function mplxfs($data, $name = null){
		if (!my_is_array( $data )) {
			return null;
		}
		$value = array();
		
		$mp0 = my_array_value( 'mp0', $data );
		$mp1 = my_array_value( 'mp1', $data );
		$mp2 = my_array_value( 'mp2', $data );
		
		if (strlen( $mp0 ) >= 1) {
			$value[] = $mp0;
		}
		if (strlen( $mp1 ) >= 1) {
			$value[] = $mp1;
		}
		if (strlen( $mp2 ) >= 1) {
			$value[] = $mp2;
		}
		$value = my_join('-', $value);
		if (strlen( $name ) >= 1) {
			$value = $name . $value;
		}
		return $value;
	}
	/* 手机联系方式 */
	function tplxfs($data, $name = null){
		if (!my_is_array( $data )) {
			return null;
		}
		$value = null;
		$tp = my_array_value( 'tp', $data );
	
		if (strlen( $tp ) >= 1) {
			if (strlen($name) >= 1) {
				$value = $name;
			}
			$value .= $tp;
		}
		return $value;
	}
	/* 邮箱联系方式 */
	function emaillxfs($data, $name = null){
		if (!my_is_array( $data )) {
			return null;
		}
		$value = null;
		$tp = my_array_value( 'email', $data );
	
		if (strlen( $tp ) >= 1) {
			if (strlen($name) >= 1) {
				$value = $name;
			}
			$value .= $tp;
		}
		return $value;
	}
	function cbar($data, $count){
		$sysNum = intval(my_array_value('sys', $data));
		$syn1Num = intval(my_array_value('syn1', $data));
		$syn2Num = intval(my_array_value('syn2', $data));
		
		$value = 0;
		$n = $sysNum + $syn1Num + $syn2Num;
		if ($count >= 1) {
			$value = ($n / $count) * 100;
		}
		return array ($this->smCcount ( $n ), $value);
	}
	/* 计算进度条 */
	function bar($n, $count){
		$value = 0;
		$n = intval ( $n );
		$count = intval ( $count );
		if ($count >= 1) {
			$value = ($n / $count) * 100;
		}
		return $value;
	}
	function sm($k1 = null, $k2 = null) {
		$data = _g('cache')->selectitem(120);
		$len = func_num_args ();
		if ($len < 1) {
			return $data;
		} else if ($len == 1) {
			return my_array_value ( $k1, $data );
		} else {
			return my_array_value ( $k1 . '>' . $k2, $data );
		}
	}
	function smRemoveSys() {
		$data = array ();
		foreach ($this->sm () as $k => $v) {
			if ($this->sysField == $v['flag']){
				continue;
			}
			$data[$k] = $v;
		}
		return $data;
	}
	function smSname($k = null){
		if (preg_match("/[a-z]+/i", $k)) {
			foreach ($this->sm () as $k => $v) {
				if ($this->sysField == $v['flag']){
					return $v['sname'];
				}
			}
		} else {
			if (preg_match("/\d+/", $k)) {
				return _g('cache')->selectitem('120>' . $k . '>sname');
			}
		}
		return null;
	}
	function smFlag2Id($str = null){
		if (!preg_match("/\w+/", $str)) {
			return 0;
		}
		foreach ($this->sm () as $k => $v) {
			if ($str == $v['flag']){
				return $k;
			}
		}
	}
	function is_sys($v) {
		return ($v == $this->sysField);
	}
	function is_ljfx($v) {
		return ($v == 'syn1');
	}
	function is_qywh($v) {
		return ($v == 'syn2');
	}
	function is_xg($v) {
		return ($v == 'syn3');
	}
	function smCcount($v){
		return (intval($v) * 2);
	}
	function smScoreField() {
		$arr = array ( 'sys', 'syn1', 'syn2' );
		return $arr;
	}
	function smCnum($k) {
		$arr = array (
				'sys'=> 30,
				'syn1' => 10,
				'syn2' => 10
		);
		return my_array_value($k, $arr);
	}
	function smCscore($k) {
		$arr = array (
				'sys'=> 60,
				'syn1' => 20,
				'syn2' => 20
		);
		return my_array_value($k, $arr);
	}
	function scoreBL() {
		$arr = array (
				'0_10'=>'0 ~ 10分',
				'11_20'=>'11 ~ 20分',
				'21_30'=>'21 ~ 30分',
				'31_40'=>'31 ~ 40分',
				'41_50'=>'41 ~ 50分',
				'51_60'=>'51 ~ 60分',
				'61_70'=>'61 ~ 70分',
				'71_80'=>'71 ~ 80分',
				'81_90'=>'81 ~ 90分',
				'91_100'=>'91 ~ 100分'
		);
		return $arr;
	}
}
?>