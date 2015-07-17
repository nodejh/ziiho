<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 常用html标签 */
function common_htmltag($module_variable = NULL) {
	$arr = array (
			'div' => array (
					'val' => html_special ( '<div class=\" \">\r\r\n</div>' ),
					'title' => html_special ( '<div>...</div>' ) 
			),
			'ul' => array (
					'val' => html_special ( '<ul >\r\n<li ></li>\r\n</ul>' ),
					'title' => html_special ( '<ul>...</ul>' ) 
			),
			'dl' => array (
					'val' => html_special ( '<dl >\r\n<dt ></dt>\r\n<dd ></dd>\r\n</dl>' ),
					'title' => html_special ( '<dl>...</dl>' ) 
			),
			'li' => array (
					'val' => html_special ( '<li ></li>' ),
					'title' => html_special ( '<li>...</li>' ) 
			),
			'p' => array (
					'val' => html_special ( '<p ></p>' ),
					'title' => html_special ( '<p>...</p>' ) 
			),
			'a' => array (
					'val' => html_special ( '<a href=\"\" target="\_blank\" ></a>' ),
					'title' => html_special ( '<a>...</a>' ) 
			),
			'img' => array (
					'val' => html_special ( '<img src=\"\" width=\"\" height=\"\" title=\"\" alt=\"\" />' ),
					'title' => html_special ( '<img... />' ) 
			),
			'span' => array (
					'val' => html_special ( '<span ></span>' ),
					'title' => html_special ( '<span>...</span>' ) 
			),
			'em' => array (
					'val' => html_special ( '<em ></em>' ),
					'title' => html_special ( '<em>...</em>' ) 
			),
			'label' => array (
					'val' => html_special ( '<label ></label>' ),
					'title' => html_special ( '<label>...</label>' ) 
			),
			'strong' => array (
					'val' => html_special ( '<strong ></strong>' ),
					'title' => html_special ( '<strong>...</strong>' ) 
			),
			'b' => array (
					'val' => html_special ( '<b ></b>' ),
					'title' => html_special ( '<b>...</b>' ) 
			),
			'i' => array (
					'val' => html_special ( '<i ></i>' ),
					'title' => html_special ( '<i>...</i>' ) 
			),
			'h1' => array (
					'val' => html_special ( '<h1 ></h1>' ),
					'title' => html_special ( '<h1>...</h1>' ) 
			),
			'h2' => array (
					'val' => html_special ( '<h2 ></h2>' ),
					'title' => html_special ( '<h2>...</h2>' ) 
			),
			'h3' => array (
					'val' => html_special ( '<h3 ></h3>' ),
					'title' => html_special ( '<h3>...</h3>' ) 
			),
			'h4' => array (
					'val' => html_special ( '<h4 ></h4>' ),
					'title' => html_special ( '<h4>...</h4>' ) 
			),
			'h5' => array (
					'val' => html_special ( '<h5 ></h5>' ),
					'title' => html_special ( '<h5>...</h5>' ) 
			),
			'h6' => array (
					'val' => html_special ( '<h6 ></h6>' ),
					'title' => html_special ( '<h6>...</h6>' ) 
			),
			'style' => array (
					'val' => html_special ( 'style=\" \"' ),
					'title' => html_special ( 'style' ) 
			),
			'class' => array (
					'val' => html_special ( 'class=\" \"' ),
					'title' => html_special ( 'class' ) 
			),
			'id' => array (
					'val' => html_special ( 'id=\" \"' ),
					'title' => html_special ( 'id' ) 
			) 
	);
	return $arr;
}
?>