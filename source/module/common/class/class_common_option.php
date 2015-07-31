<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_option extends geshai_model {
	public $t_common_option = 'common_option';
	
	function __construct() {
		parent::__construct ();
	}
	function class_common_option() {
		$this->__construct ();
	}
	
	function find($k = null, $v = null) {
		$this->db->from ( $this->t_common_option );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one();
	}
	
	function finds($k = null, $v = null) {
		$this->db->from ( $this->t_common_option );
		$this->db->where ( $k, $v );
		$this->db->select ();
		if(!$this->db->is_success()){
			return array();
		}
		$result = $this->db->get_list ();
		$arr = array();
		while ( $rs = $this->db->fetch_array ( $result ) ) {
			if(v2bool($rs['array'])){
				$rs['sval'] = str2array( $rs['sval'] );
				$rs['sval'] = (is_array($rs['sval']) ? $rs['sval'] : array());
			}
			$arr[$rs['skey']] = $rs ['sval'];
		}
		return $arr;
	}
	
	function get($module = null, $stype = null, $skey = null){
		$where = array();
		if(!empty( $module )){
			$where['module'] = _g( 'module' )->flag( $module );
		}
		if(!empty( $stype )){
			$where['stype'] = $stype;
		}
		if(!empty( $skey )){
			$where['skey'] = $skey;
		}
		return $this->finds( $where );
	}
	
	function save($datas) {
		if (!my_is_array( $datas ) ) {
			return false;
		}
		foreach ( $datas as $v ) {
			/* is exist */
			$sRs = $this->find(array('module'=> $v[0], 'stype'=> $v[1], 'skey'=> $v[2]));
			if(!$this->db->is_success($sRs)){
				return false;
			}
			/* data */
			$arr = array (
					'module' => $v [0],
					'stype' => $v [1],
					'skey' => $v [2],
					'sval' => $v [3],
					'array' => my_array_value(4, $v, -1)
			);
			$this->db->from ( $this->t_common_option );
			if (my_is_array ( $sRs ) ) {
				$this->db->where ( 'optionid', $sRs ['optionid'] );
				$this->db->set ( $arr );
				$this->db->update ();
			} else {
				$this->db->set ( $arr );
				$this->db->insert ();
			}
			if(!$this->db->is_success($sRs)){
				return false;
			}
		}
		
		$this->cacheWrite();
		
		return true;
	}
	
	function read(){
		$data = _g('cache')->iLoad('@', null, 'option');
		if(!is_array($data)){
			$data = array();
		}
		_g_set('option', $data);
	}
	
	function cacheWrite(){
		$data = array();
		$this->db->from ( $this->t_common_option );
		$this->db->where ();
		$this->db->select ();
		if(!$this->db->is_success()){
			return null;
		}
		$result = $this->db->get_list ();
		$data = array();
		while ( $rs = $this->db->fetch_array ( $result ) ) {
			if(v2bool($rs['array'])){
				$rs['sval'] = str2array( $rs['sval'] );
				$rs['sval'] = (is_array($rs['sval']) ? $rs['sval'] : array());
			}
			$data[$rs['module']][$rs['stype']][$rs['skey']] = $rs ['sval'];
		}
		
		$content .= '<?php /* author Jolly, date ' . date('Y-m-d H:i:s', _g('cfg>time')) . ' */ ';
		$content .= 'if (! defined ( \'IN_GESHAI\' )) { exit ( \'no direct access allowed\' ); }';
		$content .= 'return ';
		$content .= array2str($data);
		$content .= '; ?>';
		
		_g('cache')->write('@', null, 'option.php', $content);
	}
}
?>