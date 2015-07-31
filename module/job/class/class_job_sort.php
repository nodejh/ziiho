<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_sort extends geshai_model {
	public $t_job_sort = 'job_sort';
	public $sss = null;
	function __construct() {
		parent::__construct ();
	}
	function class_job_sort() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_sort );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$this->db->from ( $this->t_job_sort );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_list ();
	}
	
	function get_finds($datas){
		if(!my_is_array($datas)){
			return array(0, null);
		}
		$this->db->from ( $this->t_job_sort );
		$this->db->where_in ( 'sortid', $datas );
		$this->db->where('status', _g('value')->sb( 'true' ));
		$count = $this->db->count();
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return array($count, $this->db->get_list ());
	}
	
	function child($sortid, $isOnlyIds = false, $isFindCur = true, &$data = array(), $index = 0) {
		if (! _g ( 'validate' )->pnum ( $sortid )) {
			return $data;
		}
		$this->db->from ( $this->t_job_sort );
		$this->db->where ( ($isFindCur === true ? 'sortid' : 'parentid'), $sortid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return $data;
		}
		
		/* 当前 */
		if ($isFindCur === true) {
			$v = $this->db->get_one ();
			$v ['index'] = $index;
			
			my_array_push ( $data, ($isOnlyIds === true ? $v ['sortid'] : $v) );
			
			$this->child ( $v ['sortid'], $isOnlyIds, false, $data, ($index + 1) );
		} else {
			/* 获取子级 */
			$result = $this->db->get_list ();
			while ( $v = $this->db->fetch_array ( $result ) ) {
				$v ['index'] = $index;
				
				my_array_push ( $data, ($isOnlyIds === true ? $v ['sortid'] : $v) );
				
				$this->child ( $v ['sortid'], $isOnlyIds, false, $data, ($index + 1) );
				$index = 1;
			}
		}
		return $data;
	}
	
	/* 管理 - 操作 */
	function include_list($parentid = 0, $index = 0) {
		if (! _g ( 'validate' )->num ( $parentid )) {
			return null;
		}
		$dataResult = $this->finds ( 'parentid', $parentid );
		$writeUrlStr = 'mod/job/ac/sort/op/write';
		
		include (_g ( 'cp' )->get_template ( 'job', 'sort_list' ));
	}
	
	/* 编辑页面 - option */
	function option($sortSub, $parentid, $index = 0) {
		$this->db->from ( $this->t_job_sort );
		$this->db->where ( 'parentid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return null;
		}
		$result = $this->db->get_list ();
		include _g ( 'cp' )->get_template ( 'job', 'sort_option' );
	}
	
	/* 页面位置 - position */
	function cpos($parentid, &$data = array()) {
		$this->db->from ( $this->t_job_sort );
		$this->db->where ( 'sortid', $parentid );
		$this->db->order_by ( 'listorder' );
		$count = $this->db->count ();
		$this->db->select ();
		if (! $this->db->is_success () || $count < 1) {
			return $data;
		}
		$result = $this->db->get_one ();
		if (is_array ( $result )) {
			$data = my_array_unshift ( $data, $result );
			$this->cpos ( $result ['parentid'], $data );
		}
		return $data;
	}
	/* 页面位置 - 显示 */
	function include_cpos($parentid) {
		$data = array ();
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$data = $this->cpos ( $parentid );
			$data = (! is_array ( $data ) ? array () : $data);
		}
		$urlb = _g ( 'cp' )->uri ( 'mod/job/ac/sort/parentid/' );
		
		include _g ( 'cp' )->get_template ( 'job', 'sort_pos' );
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_sort);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	/* 编辑 */
	function update($sortid, $listorder, $sname, $status) {
		foreach ( $sortid as $id ) {
			if (! _g ( 'validate' )->pnum ( $id )) {
				smsg ( lang ( '110014' ) );
				return null;
			}
			$rs = $this->find ( 'sortid', $id );
			if (! $this->db->is_success ( $rs )) {
				smsg ( lang ( '200013' ) );
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
			if (strlen ( my_array_value ( $id, $sname ) ) >= 1) {
				$data ['sname'] = $sname [$id];
			}
			$data['status'] = _g('value')->sb( my_array_value ( $id, $status ) );
			
			$this->db->from ( $this->t_job_sort );
			$this->db->where ( 'sortid', $id );
			$this->db->set ( $data );
			$this->db->update ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
		
		$this->cache();
	}
	
	/* 添加 or 编辑 */
	function write_save($sortid, $parentid, $listorder, $sname, $sdescription, $status) {
		$isEdit = _g ( 'validate' )->pnum ( $sortid );
		$sortSub = null;
		$updateId = $sortid;
		if ($isEdit) {
			$sortSub = $this->find ( 'sortid', $sortid );
			if (! $this->db->is_success ( $sortSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $sortSub )) {
				smsg ( lang ( 'job:100000' ) );
				return null;
			}
		}
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$sortParentSub = $this->find ( 'sortid', $parentid );
			if (! $this->db->is_success ( $sortParentSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $sortParentSub )) {
				smsg ( lang ( '110015' ) );
				return null;
			}
		}
		/* execute */
		$data = array (
				'parentid' => $parentid,
				'listorder' => $listorder,
				'sname' => $sname,
				'sdescription'=>$sdescription,
				'ctime' => _g ( 'cfg>time' ),
				'status'=> $status
		);
		
		$this->db->from ( $this->t_job_sort );
		if ($isEdit) {
			my_unset ( $data, 'ctime' );
			$this->db->where ( 'sortid', $sortid );
		}
		$this->db->set ( $data );
		if ($isEdit) {
			$this->db->update ();
		} else {
			$this->db->insert ();
			$updateId = $this->db->insert_id();
		}
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* upload  */
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
			$saveDir = 'job/sort';
			if(!_g('file')->create_dir($rootDir, $saveDir)){
				smsg(lang('300003'));
				return null;
			}
			/* 文件名 */
			$sfname = $saveDir . '/' . _g('file')->nname($srcFile['name']);
			
			if($isEdit){
				/* delete old file */
				if(!_g('file')->delete($rootDir . '/' . $sortSub['src'])){
					smsg(lang('job:300002'));
					return null;
				}
			}
			if(!$this->updateValue(array('sortid'=>$updateId), array('src'=>$sfname))){
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
	/* 批量添加 */
	function multi_write_save ( $parentid, $sname, $status ){
		if (_g ( 'validate' )->pnum ( $parentid )) {
			$sortParentSub = $this->find ( 'sortid', $parentid );
			if (! $this->db->is_success ( $sortParentSub )) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if (! is_array ( $sortParentSub )) {
				smsg ( lang ( '110015' ) );
				return null;
			}
		}
		/* execute */
		$data = array (
				'parentid' => $parentid,
				'sname' => '',
				'ctime' => _g ( 'cfg>time' ),
				'status'=> $status
		);
		$sname = my_addslashes(_g('value')->nl2arr(my_stripslashes($sname)));
		foreach ($sname as $name){
			$name = trim($name);
			if(strlen($name) < 1){
				continue;
			}
			$data['sname'] = $name;
			
			$this->db->from ( $this->t_job_sort );
			$this->db->set ( $data );
			$this->db->insert ();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	/* 删除 */
	function delete($sortid) {
		if (! _g ( 'validate' )->pnum ( $sortid )) {
			smsg ( lang ( '110014' ) );
			return null;
		}
		$rs = $this->find ( 'sortid', $sortid );
		if (! $this->db->is_success ( $rs )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (! is_array ( $rs )) {
			smsg ( lang ( '100061' ), null, 1 );
			return null;
		}
		
		/* 获取子级 */
		$values = $this->child ( $sortid, true );
		
		/* result */
		$qRs = null;
		$__dir = sdir(':uploadfile');
		$__sdir = sdir('uploadfile');
		for($i = 0; $i < my_count($values); $i++){
			$qRs = $this->find('sortid', $values[$i]);
			if (! $this->db->is_success ($qRs)) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($qRs)){
				continue;
			}
			if(strlen($qRs['src']) >= 1){
				if(!_g('file')->delete($__dir . '/' .$qRs['src'])){
					smsg(lang(300009, $__sdir . '/' .$qRs['src']));
					return null;
				}
			}
			$this->db->from($this->t_job_sort);
			$this->db->where('sortid', $values[$i]);
			$this->db->delete();
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	
	function cache(){
		$result = $this->finds('status', _g('value')->sb(true));
		
		$flag = false;
		$data = null;
		$sData = null;
		$__ddd = null;
		while($rs = $this->db->fetch_array($result)){
			if($flag){
				$data .= ',';
				$sData .= ',';
			}
			$data .= '{"id": ' . $rs['sortid'];
			$data .= ',"parentid": ' . $rs['parentid'];
			$data .= ',"sname": "' . my_addslashes($rs['sname']) . '"';
			$data .= '}';
			
			$sData .= $rs['sortid']. '=>array(\'sortid\'=> ' . $rs['sortid'];
			$sData .= ',\'parentid\'=>' . $rs['parentid'];
			$sData .= ',\'sname\'=>' . '\'' . my_addslashes($rs['sname']) . '\'';
			$sData .= ',\'sdescription\'=>' . '\'' . my_addslashes($rs['sdescription']) . '\'';
			$sData .= ',\'src\'=>' . '\'' . $rs['src'] . '\'';
			$sData .= ')';
			
			$flag = true;
		}
		$data = 'var _CACHE_job_sort = [' . $data . '];';
		_g('cache')->write('job', null, 'sort.js', $data);
		
		$sData = "<?php \nif (! defined ( 'IN_GESHAI' )) {\n exit ( 'no direct access allowed' );\n} return array(" . $sData;
		$sData .= "); ?>";
		_g('cache')->write('job', null, 'sort.php', $sData);
	}
}
?>