<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //头部 -->
<div class="clearfix adm-header">

	<div class="clearfix z logo">
		<img src="<?php prt(_g('module')->path(':', 'template/image/logo.png')); ?>" />
	</div>

	<!-- //菜单 -->
	<div class="clearfix z menus">
		<div class="clearfix z ms">
        	<?php $myListResult = _g('cp')->menu->my_list(0); ?>
            <?php while($v = _g('db')->fetch_array($myListResult)){ ?>
        	<div class="clearfix is is-default"
				menuid="<?php prt($v['menuid']); ?>"
				onclick="adm_menu_parent(this);"><?php prt($v['title']); ?></div>
            <?php } ?>
        </div>
	</div>
	<!-- 菜单// -->

	<!-- 工具 -->
	<div class="clearfix y ops">
		<div class="clearfix ops-a">
        	<div class="as as-fc">
				<p class="as-fc-bb">上午好,<span style="background:url(<?php prt(_g('cp')->admin->ranksrc()); ?>) no-repeat;" class="margin106 rank"><?php prt(_g('cp')->admin->getData('user>username')); ?>[<?php prt(_g('cp')->admin->getData('group>gname')); ?>]</span></p>
			</div>
			<div class="as as-a">
				<a href="javascript:;" class="icon-manager-home" onclick="_GESHAI.redirect({'target': 'mcenter', 'url': '<?php prt(_g('cp')->uri('ac/mcenter')); ?>'});">管理中心</a>
			</div>
            <div class="as as-a">
				<a href="<?php prt(sdir()); ?>/" target="_blank" class="icon-site-home">网站首页</a>
			</div>
		</div>
		<div class="clear"></div>

		<div class="clearfix ops-b">
			<div class="bs bs-a">
				<a href="javascript:;" class="icon-lock-screen">锁屏</a>
			</div>
            <div class="bs bs-a">
				<a href="javascript:;" class="icon-logout">退出</a>
			</div>
		</div>
	</div>
	<!-- 工具// -->
</div>
<div class="clear"></div>
<!-- 头部// -->

<!-- //内容 -->
<div class="clearfix adm-main" id="adm-main">
	<!-- //菜单选项 -->
	<div class="clearfix z ma" id="adm-main-menu-area">
		<div class="clearfix mdata" id="adm-main-menu-data"></div>
		<div class="clearfix mbox" id="adm-main-menu-box">
			<div class="clearfix items"></div>
		</div>
		<div class="clearfix scroll" id="adm-main-menu-scroll"></div>
	</div>
	<!-- 菜单选项// -->

	<!-- //内容显示框架 -->
	<div class="clearfix z mb" id="adm-main-content">
		<div class="clearfix m-pos">
			<div class="z nt">所在位置:</div>
			<div class="z nn" id="adm-main-m-pos"></div>
		</div>
		<div class="clear"></div>

		<div class="clearfix m-frame" id="adm-main-frame-box">
			<iframe width="100%" height="100%" frameborder="no" border="0"
				framespacing="0" scrolling="auto" id="mcenter" name="mcenter"
				src="<?php prt(_g('cp')->uri('ac/mcenter'));?>"></iframe>
			<div class="clear"></div>
		</div>

	</div>
	<!-- 内容显示框架// -->
</div>
<!-- 内容// -->

<!-- //加载 -->
<form method="post" onsubmit="return false;" id="form_menu_load">
	<input type="hidden" name="menuid" value="" />
</form>
<form method="post" onsubmit="return false;" id="form_menu_pos">
	<input type="hidden" name="menuid" value="" />
</form>
<!-- 加载// -->

<script type="text/javascript">
/* 当前浏览器 */
var _explorer = _GESHAI.explorer();
/* 内容区域高度 */
var _contentHeight = 0;
/* 父级菜单 - menuid  */
var _menu_parent_value = "";
/* 父级菜单 - 导航项 */
var _menu_parent_items = $(".adm-header").find(".menus .ms .is");
/* 子菜单 - menuid  */
var _menu_child_value = "";
/* 菜单导航值 */
var _menu_position_value = "";

/* 子菜单 - 是否已展开 */
var _menu_child_clickFlag = true;
/* 子菜单 - 高 */
var _menu_child_itemsHeight = 0;
/* 子菜单 - 原高 */
var _menu_child_itemsHeight_old = 0;
/* 子菜单 - 展开或收起每次的梯高 */
var _menu_child_itemsStepFlowHeight = 0;

/* 子菜单滚动条 */
var _menu_child_ScrollDriver = document.getElementById("adm-main-menu-scroll");
var _menu_child_ScrollMoveHeight = 0;

/* 主面板格局调整 */
function adm_main_layer(){
	var _clientWidth = _GESHAI.clientsize("clientWidth");
	var _clientHeight = _GESHAI.clientsize("clientHeight");
	_contentHeight = (_clientHeight - $(".adm-header").outerHeight() - 12);
	
	document.getElementById("adm-main").style.width = (_clientWidth + "px");
	document.getElementById("adm-main-menu-box").style.height = (_contentHeight + "px");
	document.getElementById("adm-main-content").style.width = ((_clientWidth - $(".adm-main .ma").outerWidth()) + "px");
	$("#adm-main-frame-box").css({"width": (_clientWidth - $(".adm-main .ma").outerWidth()) + "px", "height": (_clientHeight - ($(".adm-header").outerHeight() + $(".adm-main .mb .m-pos").outerHeight())) + "px"});
};

/* 父级菜单 - 操作 */
function adm_menu_parent(_this){
	var _curIndex = _menu_parent_items.index(_this);
	var _curValue = $(_this).attr("menuid");
	if(_menu_parent_value == _curValue){
		return null;
	}
	_menu_parent_value = _curValue;
	_menu_position_value = _curValue;
	
	_menu_parent_items.not(":eq(" + _curIndex + ")").removeClass("is-selected").removeClass("is-hover").addClass("is-default");
	$(_this).addClass("is-selected");
	
	/* 子菜单 - 加载 */
	adm_menu_child_load(_menu_parent_value, _curIndex);
};

/* 子菜单 - 加载 */
function adm_menu_child_load(v, i){
	_menu_child_value = "";
	
	if($("#adm-main-menu-data").find("textarea[name=\"data_"+ i +"\"]").length < 1){
		var _form = document.getElementById("form_menu_load");
			_form.menuid.value = v;
		return _GESHAI.fsubmit(_form, "<?php prt(_g('cp')->uri('ac/menu/op/load')); ?>", {
			"isOnlybody": true,
			"start": function(){
				_GESHAI.dialog({"isBg": false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.dialog.close();
				$("#adm-main-menu-data").append("<textarea name=\"data_" + i + "\">" + d.data + "</textarea>");
				$("#adm-main-menu-box").find(".items").html(d.data);
				
				adm_menu_child_mouse();
				
				menu_cur_position();
			}
		});
	}else{
		$("#adm-main-menu-box").find(".items").html(_GESHAI.input("data_" + i));
		
		adm_menu_child_mouse();
		
		menu_cur_position();
	}
};

/* 子菜单 - 鼠标事件 */
function adm_menu_child_mouse(){
	/* 子 - 菜单盒子项 */
	var _menu_box = $("#adm-main-menu-box").find(".items").find(".ms .is");
	
	/* 子菜单 - 鼠标放上去 */
	_menu_box.find(".t").find(".tf").hover(function(e){
		if(_menu_child_value == $(this).attr("menuid")){
			return null;
		}
		$(this).removeClass("tf-selected");
		$(this).addClass("tf-hover");
	}, function(e){
		if(_menu_child_value == $(this).attr("menuid")){
			return null;
		}
		$(this).removeClass("tf-selected");
		$(this).removeClass("tf-hover");
	});
	
	/* 子菜单 - 全部事件 */
	_menu_box.find(".t").find(".tf").click(function(e) {
		var _curIndexValue = $(this).attr("menuid");
		if(_menu_child_value != _curIndexValue){
			/* 属性 - 菜单id */
			_menu_child_value = _curIndexValue;
		
			/* 移除当前 - 之前选中样式 */
			$("#adm-main-menu-box").find(".ms .is").find(".t").removeClass("t-selected").find(".tf").removeClass("tf-selected");
			/* 当前 - 父层背景 */
			$(this).parent().addClass("t-selected");
			
			/* 当前 - 选中样式 */
			$(this).removeClass("tf-hover");
			$(this).addClass("tf-selected");
			
			/* 位置 */
			_menu_position_value = _curIndexValue;
			menu_cur_position();
		}
		/* url 跳转 */
		menu_url_redirect(this);
    });
	
	/* 子菜单(包含子菜单) - 点击显示 or 隐藏 */
	_menu_box.find(".c").find(".tf").click(function(e) {
        var _p = $(this).parent().parent().children(".ms");
		if($(this).attr("click-flag") == "true"){
			_menu_child_clickFlag = false;
			$(this).attr("click-flag", "");
			$(this).removeClass("tf-icon-minus");
			$(this).addClass("tf-icon-plus");
			_p.hide();
		}else{
			_menu_child_clickFlag = true;
			$(this).attr("click-flag", "true");
			$(this).removeClass("tf-icon-plus");
			$(this).addClass("tf-icon-minus");
			_p.show();
		}
		adm_menu_child_scroll(true);
    });
	/* 滚动条 */
	adm_menu_child_scroll();
};

/* 子菜单 - 滚动条 */
function adm_menu_child_scroll(_clickFlag){
	var _oldHeight = _menu_child_itemsHeight_old;
	/* 当前菜单 */
	var _curMenuItem = $("#adm-main-menu-box").find(".items");
	/* 当前菜单高 */
	_menu_child_itemsHeight = _curMenuItem.outerHeight();
	_menu_child_itemsHeight_old = _menu_child_itemsHeight;
	
	
	if(_menu_child_itemsHeight > _contentHeight){
		/* 是否移动 */
		var _moveFlag = true;
		/* 鼠标坐标 */
		var _downY = 0;
		/* 计算出 - 超出的高度 */
		var _overFlowHeight = (_menu_child_itemsHeight - _contentHeight);
		
		/* 展开或关闭 */
		if(_clickFlag){
			_menu_child_itemsStepFlowHeight = (_oldHeight - _menu_child_itemsHeight);
			var _sTop = _menu_child_ScrollMoveHeight - _menu_child_itemsStepFlowHeight;
			if(_sTop < 6){
				_menu_child_ScrollDriver.style.top = "6px";
				
			}else{
				if(_sTop > _overFlowHeight){
					_menu_child_ScrollDriver.style.top = _overFlowHeight + "px";
					
				}else{
					_menu_child_ScrollDriver.style.top = _sTop + "px";
					
				}
			}
			_menu_child_ScrollMoveHeight = _sTop;
			_menu_child_ScrollDriver.style.display = "block";
		}else{
			_menu_child_ScrollDriver.style.top = "6px";
		}
		
		_menu_child_ScrollDriver.style.height = ((_contentHeight - _overFlowHeight + 6) + "px");
		
		/* 显示滚动条 */
		var _scrollDoFunc = function(_e){
			if(_menu_child_ScrollMoveHeight < 6){
				_menu_child_ScrollMoveHeight = 6;
			}else{
				if(_menu_child_ScrollMoveHeight > _overFlowHeight){
					_menu_child_ScrollMoveHeight = _overFlowHeight;
				}
			}
			_menu_child_ScrollDriver.style.top = _menu_child_ScrollMoveHeight + "px";
			_curMenuItem.css("top", (-_menu_child_ScrollMoveHeight + 6) + "px");
			
			_downY = _e.clientY;
		};
		
		/* 滚动大小 */
		var _scrollSetFunc = function(_e, _scrollDirect){
			_menu_child_itemsHeight = _curMenuItem.outerHeight();
			_overFlowHeight = (_menu_child_itemsHeight - _contentHeight);
			
			if(_menu_child_itemsHeight < _contentHeight){
				return null;
			}
			
			var _step = 25;
			_scrollDirect = _scrollDirect.toString().substr(0, 1);
			if(_explorer != "firefox"){
				if(_scrollDirect == "-"){
					/* 上移动 */
					_menu_child_ScrollMoveHeight += _step;
				}else{
					/* 下移动 */
					_menu_child_ScrollMoveHeight -= _step;
				}
			}else{
				if(_scrollDirect == "-"){
					/* 上移动 */
					_menu_child_ScrollMoveHeight -= _step;
				}else{
					/* 下移动 */
					_menu_child_ScrollMoveHeight += _step;
				}
			}
			_scrollDoFunc(_e);
		};
		
		_menu_child_ScrollDriver.onmousedown = function(_de){
			_de = (!window.event ? _de : window.event);
			_moveFlag = true;
			
			_downY = _de.clientY;
			
			/* 鼠标移动 */
			document.onmousemove = function(_e){
				if(!_moveFlag){
					return null;
				}
				_e = (!window.event ? _e : window.event);
				var _cY = _e.clientY;
				
				if(_downY == _cY){
				}else if(_downY > _cY){
					/* 上移动 */
					_menu_child_ScrollMoveHeight--;
				}else if(_downY < _cY){
					/* 下移动 */
					_menu_child_ScrollMoveHeight++;
				}
				
				_scrollDoFunc(_e);
			};
			
			document.onselectstart = function(_e){ return false; };
			document.onmouseup = function(_e){
				_moveFlag = false;
				document.onselectstart = function(_e){ return true; };
			};
		};
		/* 鼠标悬浮在 - 子菜单区域, 监听鼠标滚动 */
		_curMenuItem.parent().parent().hover(function(_de){
			_menu_child_itemsHeight = _curMenuItem.outerHeight();
			_overFlowHeight = (_menu_child_itemsHeight - _contentHeight);
			
			if(_menu_child_itemsHeight < _contentHeight){
				return null;
			}
			
			_downY = _de.clientY;
			if(_explorer == "firefox"){
				window.addEventListener = document.addEventListener;
				window.addEventListener('DOMMouseScroll', function(_e){
					_e = (!window.event ? _e : window.event);
					_scrollSetFunc(_e, _e.detail);
				}, false);
			}else{
				window.onmousewheel = document.onmousewheel = function(_e){
					_e = (!window.event ? _e : window.event);
					_scrollSetFunc(_e, _e.wheelDelta);
				};
			}
			_menu_child_ScrollDriver.style.display = "block";
		}, function(){
			_menu_child_ScrollDriver.style.display = "none";
		});
	}else{
		_menu_child_ScrollDriver.style.top = "6px";
		_menu_child_ScrollDriver.style.display = "none";
		_curMenuItem.css("top", "6px");
	}
};

/* 菜单导航位置 */
function menu_cur_position(){
	if($("#adm-main-menu-data").find("textarea[name=\"position_"+ _menu_position_value +"\"]").length < 1){
		var _form = document.getElementById("form_menu_pos");
			_form.menuid.value = _menu_position_value;
		return _GESHAI.fsubmit(_form, "<?php prt(_g('cp')->uri('ac/menu/op/pos')); ?>", {
			"isOnlybody": true,
			"start": function(){  },
			"success": function(d){
				$("#adm-main-menu-data").append("<textarea name=\"position_" + _menu_position_value + "\">" + d.data + "</textarea>");
				$("#adm-main-m-pos").html(d.data);
			}
		});
	}else{
		$("#adm-main-m-pos").html(_GESHAI.input("position_" + _menu_position_value));
	}
};

/* 菜单跳转 */
function menu_url_redirect(_this){
	var _v = $(_this).attr("urltype");
	if(_v == "inside" || _v == "outer"){
		_GESHAI.redirect({"target": "mcenter", "url": $(_this).attr("url")});
	}
};

/* 重置 */
window.onresize = function(){
	_menu_child_itemsHeight_old = 0;
	adm_main_layer();
	adm_menu_child_scroll();
};

$(document).ready(function(e){
	/* 父级菜单 - 导航 */
	_menu_parent_items.hover(function(e){
		if(_menu_parent_value == $(this).attr("menuid")){
			return null;
		}
		$(this).removeClass("is-default");
		$(this).addClass("is-hover");
	}, function(e){
		if($(this).attr("menuid") != _menu_parent_value){
			$(this).removeClass("is-selected");
			$(this).removeClass("is-hover");
			$(this).addClass("is-default");
		}else{
			$(this).removeClass("is-default");
			$(this).removeClass("is-hover");
			$(this).addClass("is-selected");
		}
		
	});
	
	/* 初始化 */
	adm_main_layer();
	adm_menu_parent(_menu_parent_items.eq(0)[0]);
});
</script>