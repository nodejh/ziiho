<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_datablock', 'common', true );
class class_article_datacall extends class_common_datablock {
	public $table_article = 'article';
	public $table_article_datacall = 'article_datacall';
	public $table_article_datablock_file = 'article_datablock_file';
	public $table_article_picture = 'article_picture';
	public $table_article_thumbcall = 'article_thumbcall';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_datacall() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function thumbcall_query($_key = NULL, $_val = NULL) {
		$this->db->from ( $this->table_article_thumbcall );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 条件图片查询 */
	function dc_file_query($_key = NULL, $_val = NULL) {
		$this->db->from ( $this->table_article_datablock_file );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 条件图片查询 */
	function picture_query($_key = NULL, $_val = NULL) {
		$this->db->from ( $this->table_article_picture );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 缩略图调用生成 */
	function thumbcall_create($tc_id, $pic_id, $dc_id) {
		if (check_nums ( $tc_id ) < 1) {
			return NULL;
		}
		if (check_nums ( $pic_id ) < 1) {
			return NULL;
		}
		if (check_nums ( $dc_id ) < 1) {
			return NULL;
		}
		/* 检查调用是否存在 */
		$tc_rs = $this->thumbcall_query ( 'tc_id', $tc_id );
		if (check_is_array ( $tc_rs ) < 1) {
			return NULL;
		}
		/* 检查w,h是否生成缩略图 */
		$tc_width = $tc_rs ['tc_width'];
		$tc_height = $tc_rs ['tc_height'];
		if (check_nums ( $tc_width ) < 1 && check_nums ( $tc_height ) < 1) {
			return NULL;
		}
		
		/* 检查图片是否存在 */
		$pic_rs = $this->picture_query ( 'pic_id', $pic_id );
		if (check_is_array ( $pic_rs ) < 1) {
			return NULL;
		}
		/* 取得查询的文件 */
		$file_name = show_uf ( $pic_rs ['file_name'], true );
		/* 检查文件是否存在 */
		if (check_is_file ( $file_name ) < 1) {
			return NULL;
		}
		
		/* 文件信息 */
		$file_info = image_size ( show_uf ( $pic_rs ['file_name'], true ) );
		$file_w = $file_info [0];
		$file_h = $file_info [1];
		unset ( $file_info );
		/* 检查需要生成缩略图的尺寸 */
		$file_w = (check_nums ( $tc_width ) < 1) ? $file_w : $tc_width;
		$file_h = (check_nums ( $tc_height ) < 1) ? $file_h : $tc_height;
		
		/* 定义缩略图生成文件名 */
		$file_arr = get_fs ( $pic_rs ['file_name'], true );
		$new_file_name = $file_arr ['dir_name'] . $this->_global ['app'] ['ds'] . 'tc' . $tc_rs ['tc_id'] . '_' . $file_arr ['file_name'];
		unset ( $file_arr );
		
		/* 检查缩略图生成文件是否存在 */
		$file_rs = $this->dc_file_query ( array (
				'pic_id' => $pic_rs ['pic_id'],
				'tc_id' => $tc_rs ['tc_id'] 
		) );
		if ($file_rs == $this->db->cw) {
			return NULL;
		}
		/* 标记是否创建缩略图 */
		$is_creat = 0;
		if (check_is_array ( $file_rs ) < 1) {
			/* 标记是否创建缩略图 */
			$is_creat = 1;
			$data_arr = array (
					'file_name' => $new_file_name,
					'ctime' => $this->sys_time,
					'cover' => $pic_rs ['cover'],
					'aid' => $pic_rs ['aid'],
					'pic_id' => $pic_rs ['pic_id'],
					'tc_id' => $tc_rs ['tc_id'],
					'dc_id' => $dc_id,
					'tc_type' => $tc_rs ['tc_type'],
					'tc_width' => $tc_rs ['tc_width'],
					'tc_height' => $tc_rs ['tc_height'] 
			);
			$this->db->from ( $this->table_article_datablock_file );
			$this->db->set ( $data_arr );
			$file_result = $this->db->insert ();
			if ($file_result == $this->db->cw) {
				return NULL;
			}
		} else {
			$is_edit = 1;
			/* 如果调用尺寸和缩略图相等,则不生成 */
			if ($tc_width == $file_rs ['tc_width']) {
				if ($tc_height == $file_rs ['tc_height']) {
					/* 缩略图类型 */
					$is_edit = ($tc_rs ['tc_type'] == $file_rs ['tc_type']) ? 0 : 1;
				}
			}
			
			if ($is_edit == 1) {
				/* 标记是否创建缩略图 */
				$is_creat = 1;
				$data_arr = array (
						'file_name' => $new_file_name,
						'cover' => $pic_rs ['cover'],
						'tc_type' => $tc_rs ['tc_type'],
						'tc_width' => $tc_rs ['tc_width'],
						'tc_height' => $tc_rs ['tc_height'] 
				);
				$this->db->from ( $this->table_article_datablock_file );
				$this->db->where ( 'file_id', $file_rs ['file_id'] );
				$this->db->set ( $data_arr );
				$file_result = $this->db->update ();
				if ($file_result == $this->db->cw) {
					return NULL;
				}
			}
		}
		if ($is_creat == 1) {
			/* 生成缩略图 */
			if (check_nums ( $tc_rs ['tc_type'] ) < 1) {
				imagethumb ( $file_name, show_uf ( $new_file_name, true ), $file_w, $file_h );
			} else {
				imagecut ( $file_name, show_uf ( $new_file_name, true ), "0,0", "{$file_w},{$file_h}" );
			}
		}
		return show_uf ( $new_file_name );
	}
	/* 数据调用显示 */
	function datacall_show($dc_id) {
		if (check_nums ( $dc_id ) < 1) {
			return NULL;
		}
		$dc = $this->datacall_query ( 'dc_id', $dc_id );
		if (check_is_array ( $dc ) < 1) {
			return NULL;
		}
		/* 获取模板路径 */
		$t = $this->_loader->model ( 'class:class_template', NULL, false );
		
		/* 检查模板是否存在 */
		$tpath = $this->_global ['app'] ['path_template'] . 'main' . $this->_global ['app'] ['ds'] . $t->template_main . $this->_global ['app'] ['ds'] . 'article' . $this->_global ['app'] ['ds'] . 'datacall' . $this->_global ['app'] ['ds'];
		$template_fp = $tpath . $dc ['dc_template'] . $this->_global ['app'] ['tpl_ext'];
		if (check_is_file ( $template_fp ) < 1) {
			echo replace_str ( lang ( 'article:datacall_template_no_exists' ), '{file}', $dc ['dc_template'] );
			return NULL;
		}
		/* 检查分类是否存在 */
		if (check_nums ( $dc ['dc_cat_id'] ) == 1) {
			$c = $this->_loader->model ( 'class:class_article_category', 'article', false );
			$cat = $c->cat_id_query ( $dc ['dc_cat_id'] );
			if (check_is_array ( $cat ) < 1) {
				lang ( 'article:datacall_cat_id_no_exists', true );
				return NULL;
			}
		}
		/* 状态 */
		$status = article_status ( 'normal' );
		/* 初始化sql排序 */
		$order_arr = article_value ( 'article_datacall_order' );
		$orderby = 'ASC';
		if (check_is_key ( $dc ['dc_order'], $order_arr ) == 1) {
			$orderby = array_key_val ( 'v_val', $order_arr [$dc ['dc_order']], 'ASC' );
		}
		/* 获取数据 */
		$this->db->from ( $this->table_article );
		if (check_nums ( $dc ['dc_cat_id'] ) == 1) {
			$this->db->where ( 'cat_id', $dc ['dc_cat_id'] );
		}
		$this->db->where ( 'status', $status );
		$result_num = $this->db->count_num ();
		if (check_nums ( $dc ['data_num'] ) == 1) {
			$this->db->limit ( 0, $dc ['data_num'] );
		}
		$this->db->order_by ( 'ctime', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			lang ( 'article:datacall_exception', true );
			return NULL;
		}
		$arr = NULL;
		$indenx = 0;
		$aid_arr = NULL;
		if (check_nums ( $result_num ) == 1) {
			$result = $this->db->get_list ();
			while ( $val = $this->db->fetch_array ( $result ) ) {
				$indenx ++;
				/* 链接 */
				$url = modelurl ( 66, array (
						'id' => $val ['aid'] 
				) );
				/* 标题 */
				$title = (check_nums ( $dc ['title_maxlen'] ) == 1) ? sub_str ( $val ['title'], 0, $dc ['title_maxlen'] ) : $val ['title'];
				/* 时间 */
				$ctime = datecall_format ( $dc ['did'], $val ['ctime'] );
				unset ( $val ['ctime'] );
				
				/* 缩略图处理 */
				if (check_nums ( $dc ['dc_tc_id'] ) == 1) {
					$thumb = $this->thumbcall_create ( $dc ['dc_tc_id'], $val ['pic_id'], $dc ['dc_id'] );
				}
				
				/* 初始化值 */
				$arr .= "array('aid'=>'{$val['aid']}','uid'=>'{$val['uid']}','cat_id'=>'{$val['cat_id']}','pic_id'=>'{$val['pic_id']}','title'=>'{$title}','intro'=>'{$val['intro']}','origin'=>'{$val['origin']}','ctime'=>'{$ctime}','pictures'=>'{$val['pictures']}','reviews'=>'{$val['reviews']}','views'=>'{$val['views']}','url'=>'{$url}','thumb'=>'{$thumb}')";
				/* 分割数组 */
				$arr .= ($indenx != $result_num) ? ',' : NULL;
				$aid_arr .= ($aid_arr != NULL) ? ',' . $val ['aid'] : $val ['aid'];
			}
			unset ( $val );
			$arr = 'array(' . $arr . ');';
			/* 清理当前调用未显示的缩略图 */
			if ($aid_arr != NULL) {
				$aid_arr = explode_str ( $aid_arr, ',' );
				$this->db->from ( $this->table_article_datablock_file );
				$this->db->where ( 'dc_id', $dc_id );
				$this->db->where_not_in ( 'aid', $aid_arr );
				$dc_file_num = $this->db->count_num ();
				$dc_file_result = $this->db->select ();
				if ($dc_file_result == $this->db->cw) {
					lang ( 'article:datacall_exception', true );
					return NULL;
				}
				if (check_nums ( $dc_file_num ) == 1) {
					/* 清理缩略图 */
					$dc_file_result = $this->db->get_list ();
					while ( $val = $this->db->fetch_array ( $dc_file_result ) ) {
						delf ( show_uf ( $val ['file_name'], true ) );
					}
					/* 清理记录 */
					$this->db->from ( $this->table_article_datablock_file );
					$this->db->where ( 'dc_id', $dc_id );
					$this->db->where_not_in ( 'aid', $aid_arr );
					$file_result = $this->db->delete ();
					if ($file_result == $this->db->cw) {
						lang ( 'article:datacall_exception', true );
						return NULL;
					}
				}
			}
		}
		/* 调用变量 */
		/*$dc_arr="array('dc_tc_id'=>'{$dc['dc_tc_id']}','did'=>'{$dc['did']}')";*/
		/*"_result['dc_{$dc['dc_tagvalue']}']"=>$dc_arr*/
		$content = get_fetch ( subtemplate ( 'article/datacall/' . $dc ['dc_template'] ), array (
				"_result['{$dc['dc_tagvalue']}']" => $arr 
		) );
		return $content;
	}
}
?>