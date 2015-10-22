<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_nature extends geshai_model {
	public $t_common_nature = 'common_nature';
	
	function __construct() {
		parent::__construct ();
	}
	function class_common_nature() {
		$this->__construct ();
	}
	
	function find($selectid, $k = null, $v = null) {
		$this->db->from ( $this->t_common_selectitem );
		$this->db->where ( $k, $v );
		$this->db->order_by ('listorder');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k = null, $v = null) {
		$this->db->from ( $this->t_common_selectitem );
		$this->db->where ( $k, $v );
		$this->db->order_by ('listorder');
		$this->db->select ();
		return $this->db->get_list ();
	}
	function insert($data){
		$this->db->from ( $this->t_common_selectitem );
		$this->db->set ($data);
		$this->db->insert ();
		if(!$this->db->is_success()){
			return false;
		}
		return $this->db->insert_id();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_common_selectitem );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_common_selectitem );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	
	function cacheWrite(){
		$content = null;
		$str = null;
		
		$flagTF = false;
		foreach(_g('value')->ra(_g('module')->dv('@', 100003)) as $k=>$v) {
			$result = $this->finds('selectid', $k);
			if(!$this->db->is_success($result)){
				return null;
			}
			$data = array();
			while ( $rs = $this->db->fetch_array ( $result ) ) {
				$data[$rs['siid']]['flag'] = $rs['flag'];
				$data[$rs['siid']]['sname'] = $rs['sname'];
			}
			
			$str .= ($flagTF ? ',' : null);
			
			$str .= '\'' . $k . '\'=>';
			$str .= array2str($data);
			
			$flagTF = true;
		}
		$content .= '<?php /* author Jolly, date ' . date('Y-m-d H:i:s', _g('cfg>time')) . ' */ ';
		$content .= 'if (! defined ( \'IN_GESHAI\' )) { exit ( \'no direct access allowed\' ); }';
		$content .= 'return ';
		$content .= 'array(' . $str . ')';
		$content .= '; ?>';
	
		_g('cache')->write('@', null, 'selectitem.php', $content);
	}
}
?>