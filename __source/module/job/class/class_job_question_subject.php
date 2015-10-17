<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_question_subject extends geshai_model {
	public $t_job_question_subject = 'job_question_subject';
	function __construct() {
		parent::__construct ();
	}
	function class_job_question_subject() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_question_subject );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_question_subject );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_question_subject );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_question_subject);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function writeSave($data, $qsid){
		$isUpdate = _g('validate')->pnum($qsid);
		$qRs = null;
		if($isUpdate){
			$qRs = $this->find('qsid', $qsid);
			if (! $this->db->is_success ($qRs)) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($qRs)){
				smsg ( lang ( 'job:600003' ) );
				return null;
			}
		}
		
		$this->db->from($this->t_job_question_subject);
		if($isUpdate){
			my_unset($data, 'ctime');
			$this->db->where('qsid', $qsid);
			$this->db->set($data);
			$this->db->update();
		}else{
			$this->db->set($data);
			$this->db->insert();
			$qsid = $this->db->insert_id();
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
			$saveDir = 'job/question';
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($srcFile['name']);
		
			/* delete old file */
			if($isUpdate){
				if (strlen( $qRs['src'] ) >= 1) {
					if(!_g('file')->delete($rootDir . '/' . $qRs['src'])){
						smsg(lang('job:600014'));
						return null;
					}
				}
			}
			$s = $this->updateValue (array( 'qsid' => $qsid), array('src' => $sfname));
			if(!$s){
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
	function delete($qsid){
		$qRs = $this->find('qsid', $qsid);
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($qRs)){
			smsg ( lang ( 'job:600003' ) );
			return null;
		}
		
		/* delete file */
		if (strlen( $qRs['src'] ) >= 1) {
			if(!_g('file')->delete(sdir(':uploadfile') . '/' . $qRs['src'])){
				smsg(lang('job:600015'));
				return null;
			}
		}
		
		/* execute record */
		$this->db->from($this->t_job_question_subject);
		$this->db->where('qsid', $qsid);
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