<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_material extends geshai_model {
	public $t_job_material = 'job_material';
	function __construct() {
		parent::__construct ();
	}
	function class_job_material() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_material );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_material );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_material );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	
	function relate($value, $id = null, $limit = 10){
		$this->db->from ( $this->t_job_material );
		$this->db->where ( 'sortid', $value );
		if(_g('validate')->pnum($id)){
			$this->db->where ('materialid', $id, '!=');
		}
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, $limit);
		$this->db->select ();
		return $this->db->get_list ();
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_material);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function writeSave($materialid, $data){
		$isUpdate = _g('validate')->pnum($materialid);
		$updateId = $materialid;
		$qRs = null;
		if($isUpdate){
			$qRs = $this->find('materialid', $materialid);
			if (! $this->db->is_success ($qRs)) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($qRs)){
				smsg ( lang ( 'job:400000' ) );
				return null;
			}
		}
		
		$this->db->from($this->t_job_material);
		if($isUpdate){
			my_unset($data, 'ctime');
			$this->db->where('materialid', $materialid);
			$this->db->set($data);
			$this->db->update();
		}else{
			$this->db->set($data);
			$this->db->insert();
			
			$updateId = $this->db->insert_id();
		}
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* upload */
		$srcFile = _ifile('src');
		if($srcFile['size'] >= 1){
			$extMsg = my_join(';', _g('module')->dv('@', 200000));
			$info = getimagesize($srcFile['tmp_name']);
			if(!_g('validate')->imagetype($srcFile['tmp_name'])){
				smsg(lang(300005, $extMsg));
				return null;
			}
			if(_g('validate')->fsover($srcFile['size'], 4)){
				smsg(lang(300006, 4));
				return null;
			}
			if($info[0] < 1 || $info[1] < 1){
				smsg(lang(300008));
				return null;
			}
				
			/* 保存目录 */
			$rootDir = sdir(':uploadfile');
			$saveDir = 'job/material';
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($srcFile['name']);
			
			/* delete old file */
			if($isUpdate){
				if(!_g('file')->delete($rootDir . '/' . $qRs['src'])){
					smsg(lang('job:300002'));
					return null;
				}
			}
			if(!$this->updateValue(array('materialid'=>$updateId), array('src'=>$sfname))){
				smsg ( lang ( '200013' ) );
				return null;
			}
			/* up  */
			if(!move_uploaded_file($srcFile['tmp_name'], ($rootDir . '/' . $sfname))){
				smsg(lang('300002'));
				return null;
			}
		}
		
		
		smsg ( lang ( '100061' ), null, 1 );
	}
	function delete($materialid){
		$qRs = $this->find('materialid', $materialid);
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($qRs)){
			smsg ( lang ( 'job:400000' ) );
			return null;
		}
		if(strlen($qRs['src']) >= 1){
			if(!_g('file')->delete(sdir(':uploadfile') . '/' . $qRs['src'])){
				smsg(lang('job:300003'));
				return null;
			}
		}
		
		$this->db->from($this->t_job_material);
		$this->db->where('materialid', $materialid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
		return true;
	}
}
?>