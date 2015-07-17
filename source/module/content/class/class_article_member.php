<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_article', 'article', true );
class class_article_member extends class_article {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_member() {
		$this->__construct ();
	}
	
	/* 保存 */
	function save($statusname, $aid, $title, $tourl, $keywords, $origin, $originurl, $catid, $content, $description, $tid, $iscomment) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_c = msg_func ( 'callFunc_c' );
		
		/* 模块类型 */
		$_module = _M ();
		/* 获取配置 */
		$sets = get_db_set ( array (
				'smodule' => $_module,
				'stype' => article_value_get ( 'set_field', 'set', 'field' ) 
		) );
		if (check_is_array ( $dmarr ) < 1) {
			// showmsg(lang('article:content_config_null'),NULL,$callFunc);
		}
		/* 草稿类型 */
		$statusdraft = article_status ( 'draft', 'field' );
		/* 检查是否为草稿操作 */
		if ($statusname != $statusdraft) {
			$statusname = 'normal';
		}
		/* 状态 */
		$statusVal = article_status ( $statusname );
		/* 标题长度 */
		$title_minlen = 1;
		$title_maxlen = 100;
		/* 内容长度 */
		$content_minlen = 10;
		$content_maxlen = 0;
		/* 简介长度 */
		$description_maxlen = 200;
		/* 标签个数 */
		$tag_maxlen = 10;
		unset ( $sets );
		/* 标记是否为草稿 */
		$isdraft = 0;
		/* 标记是否为编辑状态 */
		$isedit = 0;
		/* 主题变量 */
		$ars = NULL;
		
		/* 主题参数 */
		if (check_num ( $aid ) < 1) {
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'article:content_id_fail' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'article:content_id_fail' ), NULL, $callFunc_c, array (
						'status' => 'no' 
				) );
			}
		}
		/* 分类 */
		if (check_nums ( $catid ) < 1) {
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'common:category_catid_fail' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'common:category_catid_fail' ), NULL, $callFunc_c, array (
						'status' => 'no' 
				) );
			}
		}
		/* 检查标题长度 */
		if (check_is_len ( str_stripslashes ( $title ), $title_minlen, $title_maxlen ) < 1) {
			$lang = lang ( 'article:content_title_len', array (
					$title_minlen,
					$title_maxlen 
			) );
			if ($statusname != $statusdraft) {
				showmsg ( $lang, NULL, $callFunc );
			} else {
				showmsg ( $lang, NULL, $callFunc_c, array (
						'status' => 'no' 
				) );
			}
		}
		/* 检查内容长度 */
		$cont_len = str_len ( html_clear ( str_stripslashes ( $content ) ) );
		if ($cont_len < $content_minlen) {
			$lang_key = (check_nums ( $content_maxlen ) < 1) ? 'content_content_minlen' : 'content_content_len_fail';
			if (check_nums ( $content_maxlen ) < 1) {
				$lang = lang ( 'article:' . $lang_key, $content_minlen );
			} else {
				$lang = lang ( 'article:' . $lang_key, array (
						$content_minlen,
						$content_maxlen 
				) );
			}
			if ($statusname != $statusdraft) {
				showmsg ( $lang, NULL, $callFunc );
			} else {
				showmsg ( $lang, NULL, $callFunc_c, array (
						'status' => 'no' 
				) );
			}
		}
		if (check_nums ( $content_maxlen ) == 1) {
			if ($cont_len > $content_maxlen) {
				$lang = lang ( 'article:content_content_len_fail', array (
						$content_minlen,
						$content_maxlen 
				) );
				if ($statusname != $statusdraft) {
					showmsg ( $lang, NULL, $callFunc );
				} else {
					showmsg ( $lang, NULL, $callFunc_c, array (
							'status' => 'no' 
					) );
				}
			}
		}
		/* 为草稿则忽略 */
		if ($statusname != $statusdraft) {
			/* 检查简介 */
			if (str_len ( $description ) < 1) {
				/* 自动获取内容简介 */
				$description = sub_str ( html_clear ( str_stripslashes ( $content ) ), 0, $description_maxlen );
			} else {
				/* 检查长度 */
				if (str_len ( str_stripslashes ( $description ) ) > $description_maxlen) {
					$lang = lang ( 'article:content_description_len_fail', $description_maxlen );
					if ($statusname != $statusdraft) {
						showmsg ( $lang, NULL, $callFunc );
					} else {
						showmsg ( $lang, NULL, $callFunc_c, array (
								'status' => 'no' 
						) );
					}
				}
			}
		}
		/* 是否选择标签 */
		/*
		if(array_number($tid)<1){
			showmsg(lang('article:content_tag_null'),NULL,$callFunc);
		}
		*/
		/*如果aid大于1,则检查是否存在*/
		if (check_nums ( $aid ) == 1) {
			$ars = $this->article_query ( 'aid', $aid );
			if ($ars == $this->db->cw) {
				if ($statusname != $statusdraft) {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				} else {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
							'status' => 'ex' 
					) );
				}
			}
			if (check_is_array ( $ars ) < 1) {
				if ($statusname != $statusdraft) {
					showmsg ( lang ( 'article:content_id_noexist' ), $callbackUrl, $callFunc );
				} else {
					showmsg ( lang ( 'article:content_id_noexist' ), NULL, $callFunc_c, array (
							'status' => 'no' 
					) );
				}
			}
			if ($ars ['status'] == article_status ( 'draft' )) {
				$isdraft = 1;
			} else {
				$statusVal = $ars ['status'];
			}
			$isedit = 1;
		}
		/* 所属主题的用户 */
		$uid = array_key_val ( 'uid', $ars, get_user ( 'uid' ) );
		/* 时间 */
		$ctime = array_key_val ( 'ctime', $ars, $this->sys_time );
		/* 跳转url */
		if (str_len ( $tourl ) >= 1) {
			$tourl = url_pre_append ( $tourl );
		}
		/* 来源 */
		if (str_len ( $origin ) < 1) {
			$origin = array_key_val ( 'origin', $ars );
		}
		/* 来源url */
		if (str_len ( $originurl ) >= 1) {
			$originurl = url_pre_append ( $originurl );
		}
		/* 封面图 */
		$old_imgsrc = array_key_val ( 'imgsrc', $ars );
		/* 允许评论 */
		if (check_num ( $iscomment ) < 1) {
			$iscomment = array_key_val ( 'iscomment', $ars, yesno_val ( 'normal' ) );
		}
		unset ( $ars );
		/* 检查分类是否存在 */
		$categoryRs = common_category_query ( 'catid', $catid );
		if ($categoryRs == $this->db->cw) {
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
						'status' => 'ex' 
				) );
			}
		}
		if (check_is_array ( $categoryRs ) < 1) {
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'common:category_catid_noexist' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'common:category_catid_noexist' ), NULL, $callFunc_c, array (
						'status' => 'no' 
				) );
			}
		}
		unset ( $categoryRs );
		
		/* 开始事务 */
		$this->db->trans_begin ();
		
		/* 取得图片数量,如果不为编辑时,则获取临时的 */
		if ($isedit == 1) {
			$this->db->from ( $this->table_article_picture );
			$this->db->where ( 'aid', $aid );
			$pictures = $this->db->count_num ();
			$this->db->clear_sql ();
		} else {
			$pictures = common_temp_attachment_count ( array (
					'module' => $_module,
					'idtype' => 'aid',
					'uid' => $uid 
			) );
		}
		if ($pictures == $this->db->cw) {
			$this->db->trans_rollback_end ();
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
						'status' => 'ex' 
				) );
			}
		}
		/* 取得图片封面 */
		$imgsrc = NULL;
		if (check_nums ( $pictures ) == 1) {
			/* 是否指定了封面 */
			if ($isedit == 1) {
				$coverRs = $this->db->db_select ( $this->table_article_picture, array (
						'aid' => $aid,
						'iscover' => 1 
				) );
			} else {
				$coverRs = common_temp_attachment_query ( array (
						'module' => $_module,
						'idtype' => 'aid',
						'uid' => $uid,
						'iscover' => 1 
				) );
			}
			if ($coverRs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				if ($statusname != $statusdraft) {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				} else {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
							'status' => 'ex' 
					) );
				}
			}
			/* 如果未指定,则获取最新一个图作为封面 */
			if (check_is_array ( $coverRs ) == 1) {
				$imgsrc = array_key_val ( 'file_name', $coverRs );
			} else {
				if ($isedit == 1) {
					$this->db->from ( $this->table_article_picture );
					$this->db->where ( 'aid', $aid );
					$this->db->order_by ( 'picid', 'DESC' );
					$this->db->select ();
					$coverRs = $this->db->get_one ();
				} else {
					/* 临时 */
					$coverRs = common_temp_attachment_query ( array (
							'module' => $_module,
							'idtype' => 'aid',
							'uid' => $uid 
					) );
				}
				if ($coverRs == $this->db->cw) {
					$this->db->trans_rollback_end ();
					if ($statusname != $statusdraft) {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					} else {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
								'status' => 'ex' 
						) );
					}
				}
				$imgsrc = array_key_val ( 'file_name', $coverRs );
			}
			unset ( $coverRs );
		}
		/* 清理更新前的封面图 */
		if ($isedit == 1) {
			if ($imgsrc != $old_imgsrc) {
				serachfile_del ( show_uf ( $old_imgsrc, true ) . '*' );
			}
		}
		/* 初始化数据 */
		$dataArr = array (
				'uid' => $uid,
				'catid' => $catid,
				'imgsrc' => $imgsrc,
				'title' => $title,
				'tourl' => $tourl,
				'description' => $description,
				'origin' => $origin,
				'originurl' => $originurl,
				'keywords' => $keywords,
				'ctime' => $ctime,
				'pictures' => $pictures,
				'views' => 0,
				'iscomment' => $iscomment,
				'isdescription' => yesno_val ( 'normal' ),
				'isslide' => yesno_val ( 'normal' ),
				'status' => $statusVal,
				'attrid' => 0,
				'iconid' => 0 
		);
		/* 处理主题 */
		if ($isedit == 1) {
			$result = $this->db->db_update ( $this->table_article, $dataArr, 'aid', $aid );
		} else {
			$result = $this->db->db_insert ( $this->table_article, $dataArr, true );
			$aid = $result;
		}
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
						'status' => 'ex' 
				) );
			}
		}
		/* 处理内容 */
		$result = $this->article_content_query ( $aid );
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
						'status' => 'ex' 
				) );
			}
		}
		if (check_is_array ( $result ) == 1) {
			$result = $this->db->db_update ( $this->table_article_content, array (
					'content' => $content 
			), 'aid', $aid );
		} else {
			$result = $this->db->db_insert ( $this->table_article_content, array (
					'aid' => $aid,
					'content' => $content 
			) );
		}
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
						'status' => 'ex' 
				) );
			}
		}
		/* 添加主题关联 */
		if ($isedit != 1 && $isdraft != 1) {
			if ($statusVal == article_status ( 'normal' )) {
				$result = common_blend_content_add ( array (
						'module' => $_module,
						'idtype' => 'aid',
						'sid' => $aid,
						'uid' => $uid,
						'ctime' => $ctime 
				) );
				if ($result == $this->db->cw) {
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				}
			}
		}
		/* 转移临时附件到该主题下 */
		if ($isedit != 1) {
			if ($pictures >= 1) {
				$tempResult = common_temp_attachment_query ( array (
						'module' => $_module,
						'idtype' => 'aid',
						'uid' => $uid 
				), NULL, true );
				if ($coverRs == $this->db->cw) {
					$this->db->trans_rollback_end ();
					if ($statusname != $statusdraft) {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					} else {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
								'status' => 'ex' 
						) );
					}
				}
				$tempData = array ();
				while ( $tempRs = $this->db->fetch_array ( $tempResult ) ) {
					$tempData = array (
							'uid' => $tempRs ['uid'],
							'aid' => $aid,
							'file_name' => $tempRs ['file_name'],
							'file_type' => $tempRs ['file_type'],
							'file_info' => $tempRs ['file_info'],
							'ctime' => $tempRs ['ctime'],
							'iscover' => $tempRs ['iscover'] 
					);
					$result = $this->db->db_insert ( $this->table_article_picture, $tempData );
					if ($result == $this->db->cw) {
						$this->db->trans_rollback_end ();
						if ($statusname != $statusdraft) {
							showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
						} else {
							showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
									'status' => 'ex' 
							) );
						}
					}
					$result = common_temp_attachment_del ( 'attachid', $tempRs ['attachid'] );
					if ($result == $this->db->cw) {
						$this->db->trans_rollback_end ();
						if ($statusname != $statusdraft) {
							showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
						} else {
							showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
									'status' => 'ex' 
							) );
						}
					}
				}
				unset ( $tempData, $tempRs );
			}
		}
		/* 处理标签 */
		$tagObj = loader ( 'class:class_article_tag', 'article', true, true );
		if (check_is_array ( $tid ) == 1) {
			/* 已选择的 */
			if (array_number ( $tid ) > 10) {
				$this->db->trans_rollback_end ();
				$lang = replace_str ( lang ( 'article:content_tag_maxlen' ), '{maxlen}', $tag_maxlen );
				if ($statusname != $statusdraft) {
					showmsg ( $lang, NULL, $callFunc );
				} else {
					showmsg ( $lang, NULL, $callFunc_c, array (
							'status' => 'no' 
					) );
				}
			}
			/* 更新标签清理 */
			$this->db->from ( $this->table_article_tag );
			$this->db->where ( 'aid', $aid );
			$this->db->where_not_in ( 'tid', $tid );
			$result = $this->db->delete ();
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				if ($statusname != $statusdraft) {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				} else {
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
							'status' => 'ex' 
					) );
				}
			}
			/* 更新标签 */
			for($i = 0; $i < array_number ( $tid ); $i ++) {
				$tid [$i] = trim_addslashes ( $tid [$i] );
				if (check_nums ( $tid [$i] ) < 1) {
					$this->db->trans_rollback_end ();
					if ($statusname != $statusdraft) {
						showmsg ( lang ( 'article:content_tagid_fail' ), NULL, $callFunc );
					} else {
						showmsg ( lang ( 'article:content_tagid_fail' ), NULL, $callFunc_c, array (
								'status' => 'no' 
						) );
					}
				}
				/* 检查是否存在关联 */
				$result = $tagObj->tag_query ( array (
						'aid' => $aid,
						'tid' => $tid [$i] 
				) );
				if ($result == $this->db->cw) {
					$this->db->trans_rollback_end ();
					if ($statusname != $statusdraft) {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					} else {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
								'status' => 'ex' 
						) );
					}
				}
				if (check_is_array ( $result ) == 1) {
					continue;
				}
				/* 检查标签名是否存在 */
				$result = $tagObj->tagname_id_query ( $tid [$i] );
				if ($result == $this->db->cw) {
					$this->db->trans_rollback_end ();
					if ($statusname != $statusdraft) {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					} else {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
								'status' => 'ex' 
						) );
					}
				}
				if (check_is_array ( $result ) < 1) {
					continue;
				}
				/* 新增标签 */
				$result = $this->db->db_insert ( $this->table_article_tag, array (
						'aid' => $aid,
						'tid' => $tid [$i] 
				) );
				if ($result == $this->db->cw) {
					$this->db->trans_rollback_end ();
					if ($statusname != $statusdraft) {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					} else {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
								'status' => 'ex' 
						) );
					}
				}
			}
		} else {
			/* 系统自动获取 */
			/*
			$tagname_rs=$tagObj->tagname_list(10);
			if($tagname_rs==$this->db->cw){
				$this->db->trans_rollback_end();
				showmsg(lang('global:dbexception'),NULL,$callFunc);
			}
			*/
		}
		unset ( $tagObj );
		/* 更新聚合标签 */
		$result = $this->article_labelset ( $aid, $labelid );
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			if ($statusname != $statusdraft) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			} else {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_c, array (
						'status' => 'ex' 
				) );
			}
		}
		$this->db->trans_commit_end ();
		/* 是否保存草稿操作 */
		if ($statusname != $statusdraft) {
			if ($isedit != 1) {
				$succeedurl = url ( 'index', 'mod/article/ac/member/op/content/ao/write_succeed/id/' . $aid );
				showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc, array (
						'status' => 'addok',
						'isdialog' => 'no',
						'aid' => $aid,
						'succeedurl' => $succeedurl 
				) );
			} else {
				$detailurl = url ( 'index', 'mod/article/ac/content/op/detail/id/' . $aid );
				showmsg ( lang ( 'global:dbsuccess' ), $detailurl, $callFunc, array (
						'aid' => $aid 
				) );
			}
		} else {
			showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_c, array (
					'status' => 'ok',
					'aid' => $aid,
					'savetime' => date ( 'H:i:s', $this->sys_time ) 
			) );
		}
	}
	/* 设置聚合标签 */
	function article_labelset($aid, $labelid) {
		/* 没有选择聚合标签,则直接清空 */
		if (check_is_array ( $labelid ) < 1) {
			/* 查询是否存在聚合标签 */
			$result = $this->db->db_select ( $this->table_article_labelid, array (
					'aid' => $aid 
			) );
			if ($result == $this->db->cw) {
				return $result;
			}
			if (check_is_array ( $result ) < 1) {
				return $result;
			}
			/* 清空 */
			$result = $this->db->db_delete ( $this->table_article_labelid, array (
					'aid' => $aid 
			) );
			if ($result == $this->db->cw) {
				return $result;
			}
			/* 取消主题最新设置的聚合标签 */
			$result = $this->db->db_update ( $this->table_article, array (
					'labelid' => 0 
			), 'aid', $aid );
			if ($result == $this->db->cw) {
				return $result;
			}
			return $result;
		}
		/* 清除需要更新的标签 */
		$this->db->from ( $this->table_article_labelid );
		$this->db->where ( 'aid', $aid );
		$this->db->where_not_in ( 'labelid', $labelid );
		$result = $this->db->delete ();
		if ($result == $this->db->cw) {
			return $result;
		}
		for($j = 0; $j < array_number ( $labelid ); $j ++) {
			$labelid [$j] = trim_addslashes ( $labelid [$j] );
			if (check_nums ( $labelid [$j] ) < 1) {
				return $result;
			}
			/* 查询是否存在已选择的聚合标签 */
			$result = $this->db->db_select ( $this->table_article_labelid, array (
					'aid' => $aid,
					'labelid' => $labelid [$j] 
			) );
			if ($result == $this->db->cw) {
				return $result;
			}
			if (check_is_array ( $result ) == 1) {
				continue;
			}
			/* 查询标签名是否存在 */
			$result = $this->db->db_select ( $this->table_article_label, 'labelid', $labelid [$j] );
			if ($result == $this->db->cw) {
				return $result;
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 新增聚合标签 */
			$result = $this->db->db_insert ( $this->table_article_labelid, array (
					'aid' => $aid,
					'labelid' => $labelid [$j] 
			) );
			if ($result == $this->db->cw) {
				return $result;
			}
		}
		/* 获取主题最新的标签 */
		$orderby = order_val ( 2 );
		$this->db->from ( $this->table_article_labelid );
		$this->db->where ( 'aid', $aid );
		$this->db->order_by ( 'id', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		$labelid = array_key_val ( 'labelid', $result, 0 );
		/* 为主题设置最新的标签 */
		$result = $this->db->db_update ( $this->table_article, array (
				'labelid' => $labelid 
		), 'aid', $aid );
		if ($result == $this->db->cw) {
			return $result;
		}
		return $result;
	}
	/* 状态操作 */
	function update_status($aid, $status) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'common:param_ids_null' ), NULL, $callFunc );
		}
		/* 设置状态 */
		$statusVal = article_status ( $status );
		if (check_num ( $statusVal ) < 1) {
			showmsg ( lang ( 'article:content_status_fail' ), NULL, $callFunc );
		}
		/* 模块 */
		$_module = _M ();
		/* 正常状态 */
		$normal = article_status ( 'normal' );
		
		/* 开始事务 */
		$this->db->trans_begin ();
		
		foreach ( $aid as $v ) {
			$v = trim_addslashes ( $v );
			if (check_nums ( $v ) < 1) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'common:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			$qrs = $this->article_query ( 'aid', $v );
			if ($qrs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			/* 如果不为正常状态则删除关联 */
			if ($normal != $statusVal) {
				$result = common_blend_content_del ( array (
						'module' => $_module,
						'idtype' => 'aid',
						'sid' => $v 
				) );
			} else {
				$result = common_blend_content_add ( array (
						'module' => $_module,
						'idtype' => 'aid',
						'sid' => $v,
						'uid' => $qrs ['uid'],
						'ctime' => $qrs ['ctime'] 
				) );
			}
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			$result = $this->db->db_update ( $this->table_article, array (
					'status' => $statusVal 
			), 'aid', $v );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 提交事务 */
			$this->db->trans_commit ();
		}
		$this->db->trans_end ();
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 更新分类 */
	function update_category($aid, $catid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'common:param_ids_null' ), NULL, $callFunc );
		}
		if (check_nums ( $catid ) < 1) {
			showmsg ( lang ( 'common:category_catid_fail' ), NULL, $callFunc );
		}
		foreach ( $aid as $v ) {
			if (check_nums ( $v ) < 1) {
				showmsg ( lang ( 'common:param_ids_fail' ), NULL, $callFunc );
			}
		}
		/* 分类是否存在 */
		$category = common_category_query ( 'catid', $catid );
		if ($category == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $category ) < 1) {
			showmsg ( lang ( 'common:category_catid_noexist' ), NULL, $callFunc );
		}
		/* 更新主题分类 */
		$this->db->from ( $this->table_article );
		$this->db->where_in ( 'aid', $aid );
		$this->db->set ( 'catid', $catid );
		$result = $this->db->update ();
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 设置聚合标签 */
	function labelset($aid, $labelid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'common:param_ids_null' ), NULL, $callFunc );
		}
		if (check_is_array ( $labelid ) < 1) {
			$labelid = NULL;
		}
		/* 开始事务 */
		$this->db->trans_begin ();
		
		for($i = 0; $i < array_number ( $aid ); $i ++) {
			$aid [$i] = trim_addslashes ( $aid [$i] );
			if (check_nums ( $aid [$i] ) < 1) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'common:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 主题是否存在 */
			$result = $this->article_query ( 'aid', $aid [$i] );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			$result = $this->article_labelset ( $aid [$i], $labelid );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 提交事务 */
			$this->db->trans_commit ();
		}
		/* 结束事务 */
		$this->db->trans_end ();
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 设置属性标签 */
	function attrset($aid, $attrid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'common:param_ids_null' ), NULL, $callFunc );
		}
		if (check_nums ( $attrid ) < 1) {
			$attrid = 0;
		}
		
		for($i = 0; $i < array_number ( $aid ); $i ++) {
			$aid [$i] = trim_addslashes ( $aid [$i] );
			if (check_nums ( $aid [$i] ) < 1) {
				showmsg ( lang ( 'common:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 主题是否存在 */
			$result = $this->article_query ( 'aid', $aid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 更新属性标签 */
			$result = $this->db->db_update ( $this->table_article, array (
					'attrid' => $attrid 
			), 'aid', $aid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 主题删除 */
	function del($aid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'common:param_ids_null' ), NULL, $callFunc );
		}
		/* 当前模块名 */
		$_m = _M ();
		
		/* 开始事务 */
		$this->db->trans_begin ();
		
		foreach ( $aid as $v ) {
			$v = trim_addslashes ( $v );
			if (check_nums ( $v ) < 1) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'common:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 检查主题是否存在 */
			$qrs = $this->article_query ( 'aid', $v );
			if ($qrs == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			/* 获取主题图片 */
			$this->db->from ( $this->table_article_picture );
			$this->db->where ( 'aid', $v );
			$picture_num = $this->db->count_num ();
			$this->db->select ();
			$picture_rs = $this->db->get_list ();
			if ($picture_rs == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 删除主题图片 */
			if (check_nums ( $picture_num ) == 1) {
				while ( $val = $this->db->fetch_array ( $picture_rs ) ) {
					$pic_src = show_uf ( $val ['file_name'], true );
					if (check_is_file ( $pic_src ) == 1) {
						/* 清除图 */
						serachfile_del ( $pic_src . '*', false );
						/* 检查目录是否为空 */
						$file_arr = get_fs ( $pic_src, true );
						check_null_dir ( $file_arr ['dir_name'], true );
					}
				}
			}
			/* 删除主题图片记录 */
			$result = $this->db->db_delete ( $this->table_article_picture, 'aid', $v );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			
			/* 获取关联标签数 */
			$this->db->from ( $this->table_article_tag );
			$this->db->where ( 'aid', $v );
			$tag_num = $this->db->count_num ();
			$this->db->clear_sql ();
			if ($tag_num == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_nums ( $tag_num ) == 1) {
				$result = $this->db->db_delete ( $this->table_article_tag, 'aid', $v );
				if ($result == $this->db->cw) {
					/* 回滚事务 */
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
				}
			}
			
			/* 获取聚合标签 */
			$result = $this->db->db_select ( $this->table_article_labelid, 'aid', $v );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $label_result ) == 1) {
				/* 删除聚合标签 */
				$label_result = $this->db->db_delete ( $this->table_article_labelid, 'aid', $v );
				if ($label_result == $this->db->cw) {
					/* 回滚事务 */
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
				}
			}
			
			/* 删除关联主题记录 */
			$result = common_blend_content_del ( array (
					'module' => $_m,
					'idtype' => 'aid',
					'sid' => $v 
			) );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 删除主题内容 */
			$result = $this->db->db_delete ( $this->table_article_content, 'aid', $v );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 删除主题 */
			$result = $this->db->db_delete ( $this->table_article, 'aid', $v );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 提交事务 */
			$this->db->trans_commit ();
		}
		/* 结束事务 */
		$this->db->trans_end ();
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
}
?>