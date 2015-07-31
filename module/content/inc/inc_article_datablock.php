<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 数据调用变量 */
function article_databock_variable() {
	$mn = get_module ( _M (), 'name' );
	$arr = array (
			'aid' => array (
					'field' => 'aid',
					'val' => tag_name_set ( 'aid' ),
					'tag' => tag_name_set ( 'aid' ),
					'title' => $mn . 'ID' 
			),
			'cat_id' => array (
					'field' => 'catid',
					'val' => tag_name_set ( 'catid' ),
					'tag' => tag_name_set ( 'catid' ),
					'title' => '内容分类ID' 
			),
			'pic_id' => array (
					'field' => 'picid',
					'val' => tag_name_set ( 'picid' ),
					'tag' => tag_name_set ( 'picid' ),
					'title' => '图片ID' 
			),
			'title' => array (
					'field' => 'title',
					'val' => tag_name_set ( 'title' ),
					'tag' => tag_name_set ( 'title' ),
					'title' => $mn . '标题' 
			),
			'url' => array (
					'field' => 'url',
					'val' => html_special ( '<a href=\"' . tag_name_set ( 'url' ) . '\" target=\"_blank\">' . tag_name_set ( 'title' ) . '</a>' ),
					'tag' => html_special ( '<a href=...' ),
					'title' => $mn . '链接' 
			),
			'iconident' => array (
					'field' => 'iconident',
					'level' => 1,
					'parse' => '<?php if(str_len($data[\'iconident\'])>=1){ echo $data[\'iconident\']; } ?>',
					'val' => tag_name_set ( 'iconident' ),
					'tag' => tag_name_set ( 'iconident' ),
					'title' => $mn . '标题图标标识' 
			),
			'icon' => array (
					'field' => 'icon',
					'level' => 1,
					'parse' => '<?php if(str_len($data[\'icon\'])>=1){ ?><img src="<?php echo $data[\'icon\']; ?>"/><?php } ?>',
					'val' => tag_name_set ( 'icon' ),
					'tag' => tag_name_set ( 'icon' ),
					'title' => $mn . '标题图标' 
			),
			'thumb' => array (
					'field' => 'thumb',
					'val' => html_special ( '<img src=\"' . tag_name_set ( 'thumb' ) . '\" width=\"' . tag_name_set ( 'thumbwidth' ) . '\" height=\"' . tag_name_set ( 'thumbheight' ) . '\" alt=\"' . tag_name_set ( 'title' ) . '\" title=\"' . tag_name_set ( 'title' ) . '\" />' ),
					'tag' => html_special ( '<img src=...' ),
					'title' => $mn . '封面图' 
			),
			'thumbwidth' => array (
					'field' => 'thumbwidth',
					'val' => tag_name_set ( 'thumbwidth' ),
					'tag' => tag_name_set ( 'thumbwidth' ),
					'title' => $mn . '封面图宽' 
			),
			'thumbheight' => array (
					'field' => 'thumbheight',
					'val' => tag_name_set ( 'thumbheight' ),
					'tag' => tag_name_set ( 'thumbheight' ),
					'title' => $mn . '封面图高' 
			),
			'description' => array (
					'field' => 'description',
					'val' => tag_name_set ( 'description' ),
					'tag' => tag_name_set ( 'description' ),
					'title' => $mn . '简介' 
			),
			'origin' => array (
					'field' => 'origin',
					'val' => tag_name_set ( 'origin' ),
					'tag' => tag_name_set ( 'origin' ),
					'title' => $mn . '来源' 
			),
			'keywords' => array (
					'field' => 'keywords',
					'val' => tag_name_set ( 'keywords' ),
					'tag' => tag_name_set ( 'keywords' ),
					'title' => $mn . '关键字' 
			),
			'pictures' => array (
					'field' => 'pictures',
					'val' => tag_name_set ( 'pictures' ),
					'tag' => tag_name_set ( 'pictures' ),
					'title' => '图片数量' 
			),
			'reviews' => array (
					'field' => 'reviews',
					'val' => tag_name_set ( 'reviews' ),
					'tag' => tag_name_set ( 'reviews' ),
					'title' => $mn . '评论数' 
			),
			'views' => array (
					'field' => 'views',
					'val' => tag_name_set ( 'views' ),
					'tag' => tag_name_set ( 'views' ),
					'title' => $mn . '查看数' 
			),
			'ctime' => array (
					'field' => 'time',
					'val' => tag_name_set ( 'time' ),
					'tag' => tag_name_set ( 'time' ),
					'title' => $mn . '发布时间' 
			),
			'uid' => array (
					'field' => 'uid',
					'val' => tag_name_set ( 'uid' ),
					'tag' => tag_name_set ( 'uid' ),
					'title' => '作者UID' 
			),
			'username' => array (
					'field' => 'username',
					'val' => tag_name_set ( 'username' ),
					'tag' => tag_name_set ( 'username' ),
					'title' => '会员名' 
			),
			'nickname' => array (
					'field' => 'nickname',
					'val' => tag_name_set ( 'nickname' ),
					'tag' => tag_name_set ( 'nickname' ),
					'title' => '会员昵称' 
			),
			'avatar' => array (
					'field' => 'avatar',
					'val' => html_special ( '<img src=\"' . tag_name_set ( 'avatar' ) . '\" width=\"' . tag_name_set ( 'avatarwidth' ) . '\" height=\"' . tag_name_set ( 'avatarheight' ) . '\" alt=\"' . tag_name_set ( 'nickname' ) . '\" title=\"' . tag_name_set ( 'nickname' ) . '\" />' ),
					'tag' => html_special ( '<img src=...' ),
					'title' => '会员头像' 
			),
			'avatarwidth' => array (
					'field' => 'avatarwidth',
					'val' => tag_name_set ( 'avatarwidth' ),
					'tag' => tag_name_set ( 'avatarwidth' ),
					'title' => '会员头像宽' 
			),
			'avatarheight' => array (
					'field' => 'avatarheight',
					'val' => tag_name_set ( 'avatarheight' ),
					'tag' => tag_name_set ( 'avatarheight' ),
					'title' => '会员头像高' 
			),
			'spaceurl' => array (
					'field' => 'spaceurl',
					'val' => html_special ( '<a href=\"' . tag_name_set ( 'spaceurl' ) . '\" target=\"_blank\">' . tag_name_set ( 'nickname' ) . '</a>' ),
					'tag' => html_special ( '<a href=...' ),
					'title' => '会员空间链接' 
			) 
	);
	/* 组合公用变量 */
	$arr = common_datablock_variable ( $arr );
	return $arr;
}
?>