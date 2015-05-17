{eval $ismain=false/} {eval $cssfiles=array(
($_G['web']['sourcepath']).'module/admin/template/css/main.css' ); /}
{modtemplate admin/template/adm_header}

<!--顶部开始-->
<div class="a_top" id="a_top">
	<!--logo开始-->
	<div class="a_top_left">
		<img
			src="{field:_G.web.sourcepath/}module/admin/template/image/logo.jpg"
			height="70" width="164" />
	</div>
	<!--logo结束-->
	<!--右边开始-->
	<div class="a_top_right">
		<div class="a_top_right_a">
			<p class="a_top_nav">
				<span id="greeting"></span><strong>{print get_user('username')/}</strong>[创始人]&nbsp;&nbsp;<a
					href="javascript:;" onclick="adm_loginout();">{lang global:logout/}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a
					href="{field:_G.web.url/}" target="_blank">{lang global:siteindex/}</a>
			</p>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>

		<!--主菜单开始-->
		<div class="a_top_right_b">
			<!--主菜单左边开始-->
			<div class="a_top_right_b_l">
				<ul id="menu_item">
					{eval $menu_result=admin_menu_get();/} {eval $menuMainDown=NULL/}
					{dbres $menu_result $m}
					<li data_menuid="{field:m.menu_id/}">{if
						$m['isopenchild']!=yesno_val('normal')} <A href="javascript:;"
						id="mlink_{field:m.menu_id/}"
						onclick="adm_menuShowDown({field:m.menu_id/},true)">{field:m.title/}</A>
						{else} {eval $menuMainDown[]=$m['menu_id']/} <A
						href="javascript:;" id="mlink_{field:m.menu_id/}"
						onclick="adm_menuShowDown({field:m.menu_id/})"> <span class="c_l">{field:m.title/}</span>
							<span class="c_l c_mt2px"><img
								src="{field:_G.web.sourcepath/}module/admin/template/image/down.png" /></span>
					</A> {/if}
					</li> {/dbres}
					<div class="clr"></div>
				</ul>
				<span id="mms"></span>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
			<!--主菜单左边结束-->
		</div>
		<div class="clr"></div>
		<!--主菜单结束-->
	</div>
	<div class="clr"></div>
	<!--右边结束-->
</div>
<div class="clr"></div>
<!--顶部结束-->

<!--内容区域开始-->
<div class="a_cont">
	<div id="a_left" class="a_left">
		<div id="a_left_a" class="c_w100 a_left_a">
			<div class="a_left_a_main">
				<ul id="menu_two_result" class="c_none">
					<li>数据读取中...</li>
				</ul>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>

		<div id="a_left_b" class="c_w100 a_left_b c_hidden">
			<div class="a_left_b_main">
				<table width="100%" height="16" border="0" cellpadding="0"
					cellspacing="0">
					<tr>
						<td width="50%" valign="middle"><button type="button"
								class="c_r c_mr2px a_left_b_main_button1"
								onclick="adm_menuButton()"></button></td>
						<td width="50%" valign="middle"><button type="button"
								class="c_l c_ml2px a_left_b_main_button2"
								onclick="adm_menuButton('down')"></button></td>
					</tr>
				</table>
			</div>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>

	<div id="a_right" class="a_right">
		<iframe height="99.8%" width="100%" frameborder="no" border="0"
			framespacing="0" scrolling="auto" id="mainFrame" name="mainFrame"
			src="{url 'index','mod/admin/ac/main/op/infocenter'/}"></iframe>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
<!--内容区域结束-->

<!--主菜单下级开始-->
{if check_is_array($menuMainDown)==1} {loop $menuMainDown $idval} {eval
$menu_result=admin_menu_get($idval);/}
<div class="c_none menulayer" id="menulayer_{field:idval/}">
	<ul>
		{dbres $menu_result $val}
		<li>
			<p id="maindown_{field:val.menu_id/}" class="menulayer_a">
				<a href="javascript:;"
					onclick="adm_menuShowDown({field:val.menu_id/},true,'class','maindown_','menulayer_a','menulayer_b')"><span
					class="c_pr5px"><img
						src="{field:_G.web.sourcepath/}module/admin/template/image/menus.png" /></span>{field:val.title/}</a>
			</p>
		</li>
		<div class="clr"></div>
		{/dbres}
	</ul>
</div>
{/loop} {/if}
<!--主菜单下级开始-->

<script language="javascript">
var _setValue={
	'menu_isopenchild':parseInt("{print yesno_val('check')/}"),
	'menu_openSrc':_CJG.sourcepath+'module/admin/template/image/menu_open.png',
	'menu_closeSrc':_CJG.sourcepath+'module/admin/template/image/menu_close.png'
};
var showDateTimeId=null;
function showDateTime(){
	clearTimeout(showDateTimeId);
	var d = new Date();
	var h = d.getHours(); 
	var m = d.getMinutes(); 
	var s = d.getSeconds();
	var vStr;
	h = h < 10 ? '0' + ''+ h : h;
	m = m < 10 ? '0' + '' + m : m;
	s = s < 10 ? '0' + '' + s : s;
	if(h>=0 && h<6){
		vStr = '凌晨好';
	}else if(h>=6 && h<9){
		vStr = '早上好';
	}else if(h>=9 && h<11){
		vStr = '上午好';
	}else if(h>=11 && h<14){
		vStr = '中午好';
	}else if(h>=14 && h<18){
		vStr = '下午好';
	}else if(h>=18 && h<21){
		vStr = '晚上好';
	}else{
		vStr = '深夜好';
	}
	setHtmlData("#greeting",vStr + ',');
	showDateTimeId=setTimeout(function(){showDateTime();},1000);
}
$(document).ready(function(){
	var content_h=$(window).height();
	var top_h=$("#a_top").height();
	var rigth_h=content_h-top_h;
	$("#a_right").css({height:rigth_h+'px'});
	$("#a_left").css({height:rigth_h+'px'});
	$("#a_left_a").css({height:(rigth_h-27-5)+'px'});
	$("#a_left_b").css({'visibility':'visible',height:(27-1)+'px'});
	
	showDateTime();
	adm_menuShowDown('',true);
});
function adm_menuButton(typeStr){
	if(!isVal(typeStr)) typeStr='up';
	var scrollSplit=200;
	var scrollObj=$("#a_left_a");
	var scrollTop=scrollObj.scrollTop();
	var scrollHeight=scrollObj.scroll().height();
	if(typeStr=='up'){
		if(scrollTop<1) return false;
		scrollObj.scrollTop(scrollTop-scrollSplit);
	}else{
		scrollObj.scrollTop(scrollTop+scrollSplit);
	}
}
function adm_menuShowDown(id,isload,styleType,idname,_style1,_style2){
	if(!isVal(styleType)){
		var str,html_input='input_id_01';
		/*初始化选择*/
		if(!isVal(id)){
			if($("#menu_item li").length<1){
				return false;
			}
			id=$.trim($('#menu_item li:first').attr("data_menuid"));
		}
		/*获取上次的参数*/
		var id_val=inputval(html_input);
		/*记录本次参数*/
		set_html_input(html_input,id);
		/*设置选定样式*/
		if(id_val!=id){
			if(isVal(id_val)){
				$("#mlink_"+id_val).css({color:"#FFF"});
			}
		}
		$("#mlink_"+id).css({color:"#FF0"});
	}else{
		adm_menuStyleSet(id,idname,_style1,_style2,{'isopenchild':_setValue.menu_isopenchild});
	}
	if(isBoolean(isload)){
		if(isload==true){
			ajaxAction({'actionUrl':"{url 'index','mod/admin/ac/menu/op/menuchild'/}",'actionData':{'menu_id':id,'callback_param':{'callFunc':'ajaxActionDialog','isajax':1}},'showDataId':"#menu_two_result"});
		}
	}else{
		JJmenubox({menuEl:'#mlink_'+id,boxEl:'#menulayer_'+id,delayTime:100,openedClass:'',showType:1});
	}
}
function adm_menuStyleSet(id,idname,_style1,_style2,param){
	var str,val,html_input='input_id_03';
	if(!isObject(param)) param={};
	if(isVal(param.inputname)){
		html_input=param.inputname;
	}
	/*获取上次的参数*/
	var id_val=inputval(html_input);
	/*记录本次参数*/
	set_html_input(html_input,id);
	/*设置选定样式*/
	if(id_val!=id){
		if(isVal(id_val)){
			$("#"+idname+id_val).removeClass(_style2);
			$("#"+idname+id_val).addClass(_style1);
			/*点击其他则关闭上次点击的下级菜单*/
			/*
			if(isVal(param.closeMenu)){
				setHtmlDisplay(param.closeMenu+id_val,'none');
				$("#openclose_"+id_val+" img").attr("src",_setValue.menu_openSrc);
			}
			*/
		}
	}
	/*还原下级菜单样式*/
	var menuchild_val=inputval('input_id_04');
	if(isVal(menuchild_val)){
		$("#openmenu_"+menuchild_val).removeClass("childmenu_b");
		$("#openmenu_"+menuchild_val).addClass("childmenu_a");
	}
	
	/*是否展开或关闭当前下级菜单*/
	if(_setValue.menu_isopenchild!=param.isopenchild){
		if($(param.closeMenu+id).css("display")=="block"){
			$("#"+idname+id).addClass(_style1);
			$("#"+idname+id).removeClass(_style2);
			$("#font_"+id).removeClass("fw");
			setHtmlDisplay(param.closeMenu+id,'none');
			$("#openclose_"+id+" img").attr("src",_setValue.menu_openSrc);
		}else{
			$("#"+idname+id).removeClass(_style1);
			$("#"+idname+id).addClass(_style2);
			$("#font_"+id).addClass("fw");
			setHtmlDisplay(param.closeMenu+id);
			$("#openclose_"+id+" img").attr("src",_setValue.menu_closeSrc);
		}
	}else{
		$("#"+idname+id).removeClass(_style1);
		$("#"+idname+id).addClass(_style2);
	}
}
function adm_menuOpen(id,isopenchild,url){
	dialogClose();
	adm_menuStyleSet(id,"mclink_","menu_two_result_a","menu_two_result_b",{'isopenchild':isopenchild,'closeMenu':"#openmenu_"});
	/*是否展开下级菜单*/
	if(_setValue.menu_isopenchild==isopenchild){
		/*直接跳转*/
		if(!isUrl(url)) return false;
		window.document.getElementById(_CJG.MF).src=url;
	}
}
function adm_menuAction(parentid,id,url){
	/*设置当前父级菜单样式*/
	adm_menuStyleSet(parentid,'mclink_','menu_two_result_a','menu_two_result_b',{'isopenchild':_setValue.menu_isopenchild});
	/*设置所选中的当前菜单样式*/
	adm_menuStyleSet(id,'openmenu_','childmenu_a','childmenu_b',{'isopenchild':_setValue.menu_isopenchild,'inputname':'input_id_04'});
	/*直接跳转*/
	if(!isUrl(url)){
		return false;
	}
	window.document.getElementById(_CJG.MF).src=url;
}
function adm_loginout(){
	mydialog({'data':'您确定要退出么?','showCancelButton':true,'okClick':'ajaxAction','okClickValue':{'actionUrl':"{url 'index','mod/admin/ac/entry/op/logouts'/}",'actionData':{'callback_param':{'callFunc':'ajaxActionDialog','url':"{url 'index','mod/admin/ac/entry/op/login'/}",'isajax':1}}}});
}
</script>

</body>
</html>