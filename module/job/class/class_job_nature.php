<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_nature extends geshai_model {
	public $t_job_nature = 'job_nature';
	function __construct() {
		parent::__construct ();
	}
	function class_job_nature() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_nature );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$this->db->from ( $this->t_job_nature );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_list ();
	}
	
	/* 添加 */
	function add($listorder, $nname, $status) {
		$listorder = (!_g('validate')->num($listorder) ? 0 : $listorder);
		/* execute */
		$data = array (
				'listorder' => $listorder,
				'nname' => $nname,
				'ctime' => _g ( 'cfg>time' ),
				'status'=> $status
		);
		$this->db->from ( $this->t_job_nature );
		$this->db->set ( $data );
		$this->db->insert ();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	
	/* 编辑 */
	function update($natureid, $listorder, $nname, $status) {
		foreach ( $natureid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$rs = $this->find ( 'natureid', $id );
			if (! $this->db->is_success ( $rs )) {
				smsg ( lang ( '110013' ) );
				return null;
			}
			if (! is_array ( $rs )) {
				continue;
			}
			
			/* doing */
			$data = array ();
			if (_g ( 'validate' )->num ( my_array_value ( $id, $listorder ) )) {
				$data ['listorder'] = $listorder [$id];
			}
			if (strlen ( my_array_value ( $id, $nname ) ) >= 1) {
				$data ['nname'] = $nname [$id];
			}
			$data['status'] = _g('value')->sb( my_array_value ( $id, $status ) );
			
			$this->db->from ( $this->t_job_nature );
			$this->db->where ( 'natureid', $id );
			$this->db->set ( $data );
			$this->db->update ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '110013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		
		$this->cache();
	}
	
	/* 删除 */
	function delete($natureid) {
		if (! _g ( 'validate' )->pnum ( $natureid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$rs = $this->find ( 'natureid', $natureid );
		if (! $this->db->is_success ( $rs )) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		if (! is_array ( $rs )) {
			continue;
		}
		
		/* execute */
		$this->db->from ( $this->t_job_nature );
		$this->db->where ( 'natureid', $natureid );
		$this->db->delete ();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '110013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	
	function cache(){
		
		$result = $this->finds('status', _g('value')->sb(true));
	
		$flag = false;
		$data = null;
		while($rs = $this->db->fetch_array($result)){
			if($flag){
				$data .= ',';
			}
			$data .= '{"id": ' . $rs['natureid'];
			$data .= ',"nname": "' . my_addslashes($rs['nname']) . '"';
			$data .= '}';
				
			$flag = true;
		}
		$data = 'var _CACHE_job_nature = [' . $data . '];';
		_g('cache')->write('job', null, 'nature.js', $data);
	}
}
?>