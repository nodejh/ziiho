<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_category', 'common', true );
class class_common_category_admin extends class_common_category {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_category_admin() {
		$this->__construct ();
	}
	
	/* 基本添加 */
	function baseadd($module, $listorder, $title, $description, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:category_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		/* 检查模块是否存在 */
		if (check_is_key ( $module, get_module () ) < 1) {
			showmsg ( lang ( 'admin:module_noexist' ), NULL, $callFunc );
		}
		/* 初始化内容 */
		$data_arr = array (
				'catids' => 0,
				'module' => $module,
				'listorder' => $listorder,
				'title' => $title,
				'description' => $description,
				'ctime' => $this->sys_time,
				'disabled' => $disabled,
				'innav' => yesno_val ( 'check' ) 
		);
		$result = $this->db->db_insert ( $this->table_common_category, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 基本编辑 */
	function baseedit($catid, $listorder, $title, $description, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $catid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $catid ); $i ++) {
			$catid [$i] = trim_addslashes ( $catid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$description [$i] = trim_addslashes ( $description [$i] );
			$disabled [$i] = trim_addslashes ( $disabled [$i] );
			if (check_nums ( $catid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			$category = $this->category_query ( 'catid', $catid [$i] );
			if ($category == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $category ['listorder'];
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $category ['title'];
			}
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = yesno_val ( 'check' );
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'description' => $description [$i],
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_category, $data_arr, 'catid', $catid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 添加设置 */
	function addset($catids, $module, $listorder, $title, $description, $disabled, $innav, $seo_title, $seo_keywords, $seo_description, $template) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $catids ) < 1) {
			showmsg ( lang ( 'common:category_parentid_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:category_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		if (check_num ( $innav ) < 1) {
			$innav = yesno_val ( 'check' );
		}
		/* 检查父级是否存在 */
		if (check_nums ( $catids ) == 1) {
			$category = $this->category_query ( 'catid', $catids );
			if ($category == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $category ) < 1) {
				showmsg ( lang ( 'common:category_parentid_notexist' ), NULL, $callFunc );
			}
			unset ( $category );
		}
		$sysTime = $this->sys_time;
		$dataArr = array (
				'catids' => $catids,
				'module' => $module,
				'listorder' => $listorder,
				'title' => $title,
				'description' => $description,
				'ctime' => $sysTime,
				'disabled' => $disabled,
				'innav' => $innav,
				'seo_title' => $seo_title,
				'seo_keywords' => $seo_keywords,
				'seo_description' => $seo_description,
				'template' => $template 
		);
		$resultID = $this->db->db_insert ( $this->table_common_category, $dataArr, true );
		if ($resultID == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 添加到导航显示 */
		if ($innav != yesno_val ( 'check' )) {
			$navDataArr = array (
					'module' => $module,
					'navtype' => common_nav_type ( 'main' ),
					'listorder' => 0,
					'title' => $title,
					'navurl' => url ( 'index', 'mod/' . $module . '/ac/content/op/lists/catid/' . $resultID ),
					'ofkey' => 'catid',
					'ofval' => $resultID,
					'navxy' => 'x',
					'disabled' => $disabled,
					'ctime' => $sysTime 
			);
			$navObj = loader ( 'class:class_common_nav', 'common', true, true );
			$navResult = $navObj->_categoryAppendToNav ( $navDataArr );
			unset ( $navObj, $navDataArr );
			if ($navResult == $this->db->cw) {
				showmsg ( lang ( 'common:category_appendto_nav_exception' ), $url, $callFunc );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 编辑设置 */
	function editset($catid, $catids, $listorder, $title, $description, $disabled, $innav, $seo_title, $seo_keywords, $seo_description, $template) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 保存数据 */
		$dataArr = array ();
		/* 检查参数 */
		if (check_nums ( $catid ) < 1) {
			showmsg ( lang ( 'common:category_catid_fail' ), NULL, $callFunc );
		}
		if (check_num ( $catids ) < 1) {
			showmsg ( lang ( 'common:category_parentid_fail' ), NULL, $callFunc );
		}
		/* 检查当前分类是否存在 */
		$category = $this->category_query ( 'catid', $catid );
		if ($category == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $category ) < 1) {
			showmsg ( lang ( 'common:category_catid_noexist' ), $url, $callFunc_b );
		}
		/* 检查参数 */
		if (str_len ( $title ) < 1) {
			$title = $category ['title'];
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = $category ['listorder'];
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		if (check_num ( $innav ) < 1) {
			$innav = yesno_val ( 'check' );
		}
		/* 检查选择的分类是否存在 */
		if ($catid != $catids) {
			if (check_nums ( $catids ) == 1) {
				$qrs = $this->category_query ( 'catid', $catids );
				if ($qrs == $this->db->cw) {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				}
				if (check_is_array ( $qrs ) < 1) {
					showmsg ( lang ( 'common:category_parentid_notexist' ), NULL, $callFunc );
				}
				unset ( $qrs );
			}
			$dataArr ['catids'] = $catids;
		}
		/* 初始化数据 */
		$dataArr ['listorder'] = $listorder;
		$dataArr ['title'] = $title;
		$dataArr ['description'] = $description;
		$dataArr ['disabled'] = $disabled;
		$dataArr ['innav'] = $innav;
		$dataArr ['seo_title'] = $seo_title;
		$dataArr ['seo_keywords'] = $seo_keywords;
		$dataArr ['seo_description'] = $seo_description;
		$dataArr ['template'] = $template;
		$result = $this->db->db_update ( $this->table_common_category, $dataArr, 'catid', $catid );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 如果为添加到导航显示,就添加,则检查存在就删除 */
		$navObj = loader ( 'class:class_common_nav', 'common', true, true );
		$navQrs = $navObj->nav_query ( array (
				'module' => $category ['module'],
				'ofkey' => 'catid',
				'ofval' => $catid 
		) );
		if ($navQrs == $this->db->cw) {
			showmsg ( lang ( 'common:category_appendto_nav_exception' ), $url, $callFunc );
		}
		if ($innav == yesno_val ( 'check' )) {
			if (check_is_array ( $navQrs ) == 1) {
				$navResult = $navObj->_categoryNavDel ( 'navid', $navQrs ['navid'] );
				if ($navResult == $this->db->cw) {
					showmsg ( lang ( 'common:category_appendto_nav_exception' ), $url, $callFunc );
				}
			}
		} else {
			if (check_is_array ( $navQrs ) == 1) {
				$navDataArr = array (
						'title' => $title 
				);
				$navResult = $navObj->_categoryAppendToNav ( $navDataArr, 'navid', $navQrs ['navid'] );
			} else {
				$navDataArr = array (
						'module' => $category ['module'],
						'navtype' => common_nav_type ( 'main' ),
						'listorder' => 0,
						'title' => $title,
						'navurl' => url ( 'index', 'mod/' . $category ['module'] . '/ac/content/op/lists/catid/' . $catid ),
						'ofkey' => 'catid',
						'ofval' => $catid,
						'navxy' => 'x',
						'disabled' => $disabled,
						'ctime' => $this->sys_time 
				);
				$navResult = $navObj->_categoryAppendToNav ( $navDataArr );
			}
			unset ( $navDataArr );
			if ($navResult == $this->db->cw) {
				showmsg ( lang ( 'common:category_appendto_nav_exception' ), $url, $callFunc );
			}
		}
		unset ( $navObj, $navQrs );
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 分类删除 */
	function del($catid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $catid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		/* 导航类 */
		$navObj = loader ( 'class:class_common_nav', 'common', true, true );
		
		for($i = 0; $i < array_number ( $catid ); $i ++) {
			$catid [$i] = trim_addslashes ( $catid [$i] );
			if (check_nums ( $catid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 是否存在 */
			$category = $this->category_query ( 'catid', $catid [$i] );
			if ($category == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $category ) < 1) {
				continue;
			}
			$str_catid = $this->category_child_id ( $category ['module'], $catid [$i] );
			if ($str_catid == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			$str_catid = explode ( ',', $str_catid );
			
			/* 删除显示在导航的分类 */
			$navResult = $navObj->_categoryNavDel ( array (
					'module' => $category ['module'],
					'ofkey' => 'catid',
					'ofval' => $str_catid 
			) );
			if ($navResult == $this->db->cw) {
				showmsg ( lang ( 'common:category_appendto_nav_exception' ), $url, $callFunc );
			}
			
			/* 删除分类 */
			$this->db->from ( $this->table_common_category );
			$this->db->where_in ( 'catid', $str_catid );
			$result = $this->db->delete ();
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 缓存生成,或url方式返回在js文件里面 */
	function category_write($module) {
		$w_disabled = yesno_val ( 'normal' );
		$this->db->from ( $this->table_common_category );
		$this->db->where ( 'module', $module );
		$this->db->where ( 'disabled', $w_disabled );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		$cont = NULL;
		while ( $val = $this->db->fetch_array ( $result ) ) {
			if ($cont != NULL) {
				$cont .= ',';
			}
			$cont .= '[' . $val ['catid'] . ',' . $val ['catids'] . ",'" . $val ['title'] . "']";
		}
		$file_name = $this->_global ['app'] ['path_data'] . 'datafile/' . $module . '_category.js';
		$cont = "function {$module}_category(){var data_arr = new Array(" . $cont . ");return data_arr;}";
		template_write ( $file_name, $cont );
	}
}
?>