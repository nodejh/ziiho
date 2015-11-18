<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_cuser_profession extends geshai_model {
	public $t_cuser_profession = 'cuser_profession';
	
	function __construct() {
		parent::__construct ();
	}
	function class_cuser_profession() {
		$this->__construct ();
	}
	
	function find($k = null, $v = null) {
		$this->db->from ( $this->t_cuser_profession );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k = null, $v = null) {
		$this->db->from ( $this->t_cuser_profession );
		$this->db->where ( $k, $v );
		$this->db->order_by ('listorder');
		$this->db->select ();
		return $this->db->get_list ();
	}
	function insert($data){
		$this->db->from ( $this->t_cuser_profession );
		$this->db->set ( $data );
		$this->db->insert ();
		if(!$this->db->is_success()){
			return false;
		}
		return $this->db->insert_id();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_cuser_profession );
		$this->db->where ( $k, $v );
		$this->db->set ( $data );
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_cuser_profession );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success ();
	}
	
	function cacheWrite() {
		$content = null;
		$str = null;
		$flagTF = false;
		
		$result = $this->finds ();
		while ( $rs = $this->db->fetch_array ( $result ) ) {
			$data = array();
			$data['pname'] = $rs['pname'];
			
			$str .= ($flagTF ? ',' : null);
			$str .= ($rs['professionid'] . '=>' . array2str($data));
				
			$flagTF = true;
		}
		$content .= '<?php /* author Jolly, date ' . date('Y-m-d H:i:s', _g('cfg>time')) . ' */ ';
		$content .= 'if (! defined ( \'IN_GESHAI\' )) { exit ( \'no direct access allowed\' ); }';
		$content .= 'return ';
		$content .= 'array(' . $str . ')';
		$content .= '; ?>';
	
		_g('cache')->write('cuser', null, 'profession.php', $content);
	}
}
?>