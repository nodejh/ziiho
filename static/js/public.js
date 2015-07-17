// JavaScript Document
/*验证码*/
var codeimg_timerid=null;
function getcodeimg(arg_id){
	var _id="#codeimg";
	if(isVal(arg_id)){
		_id=arg_id;
	}
	clearTimeout(codeimg_timerid);
	var url=_CJG.rootpath+'index.php?mod=common&ac=captcha&op=rc&rd='+(new Date().getTime());
	codeimg_timerid=setTimeout(function(){
		if($(_id+" img").length<1){
			$(_id).html('<img src="'+url+'" border="0"/>');
		}else{
			$(_id+" img").attr("src",url);
		}
	},300);
}
/*加载css,js*/
function loadappend(loadType,loadSrc){
	var appendhead="",appendtype="";
	switch(loadType){
		case "css":
			appendhead=document.getElementsByTagName("head").item(0);
			appendtype=document.createElement("link");
			appendtype.rel="stylesheet";
			appendtype.type="text/css";
			appendtype.href=loadSrc;
			appendhead.appendChild(appendtype);	
		break;
		case "js":				
			appendhead=document.getElementsByTagName("head").item(0);
			appendtype=document.createElement("script");
			appendtype.src=loadSrc;
			appendtype.type="text/javascript";
			appendhead.appendChild(appendtype);
		break;
	}
}
/*获取js src=的值*/
function initjscss(){
	var gs_common=document.scripts[0].src;
	var str_arr=gs_common.split("?");
	var str_arr_len=str_arr.length;
	if(str_arr_len<2){return false;}
	str_arr=str_arr[(str_arr_len-1)];
	str_arr=str_arr.split(",");
	/*init files*/
	var file_arr=loadjscss_file();
	loadappend(file_arr['js_jq'],'js_jq');
	for(var i=0;i<str_arr.length;i++){
		loadappend(file_arr[str_arr[i]],str_arr[i]);
	}
}
/*获取滚动条高*/
var sscroll=0;
$(window).scroll(function(){
	sscroll=parseInt($(window).scrollTop());
});
/*滚动条高度*/
function getscrolltop(){
    var scrolltop_val=0;
    if(document.documentElement && document.documentElement.scrollTop){
        scrolltop_val=document.documentElement.scrollTop;
    }else if(document.body){
		scrolltop_val=document.body.scrollTop;
    }
	if(check_nums(scrolltop_val)<1){
		scrolltop_val=0;
	}
    return scrolltop_val;
}
/*获取浏览器类型*/
function get_explorer() {
	var explorer = window.navigator.userAgent ;
	if (explorer.indexOf("MSIE") >= 0){/*ie*/ 
		return 'ie';
	}else if (explorer.indexOf("Firefox") >= 0){/*firefox*/
		return "firefox";
	}else if(explorer.indexOf("Chrome") >= 0){/*Chrome*/
		return "chrome";
	}else if(explorer.indexOf("Opera") >= 0){/*opera*/
		return "opera";
	}else if(explorer.indexOf("Safari") >= 0){/*safari*/
		return "safari";
	}
}
/*当前url*/
function current_url(){
	return window.location.href;
}
/*获取url域名*/
function get_urldomain(arg_url){
	var host = '';
	if(!isVal(arg_url)){
		arg_url = current_url();
	}
	var _regex = /.*\:\/\/([^\/]*).*/;
	var _match = arg_url.match(_regex);
	if(isVal(_match)){
		host = _match[1];
	}
	return host;
}
/*获取网页尺寸*/
function get_clientwh(){
	var w=document.documentElement.clientWidth;
	var h=document.documentElement.clientHeight;
	var v={'width':parseInt(w),'height':parseInt(h)};
	return v;
}
/*获取鼠标xy坐标*/
function get_mouse_xy(ev){
	var px=parseInt(ev.clientX);
	var py=(parseInt(ev.clientY)+sscroll);
	var p={'px':px,'py':py};
	return p;
}
/*获取元素坐标*/
function get_element_xy(e_id){
	var x=0;
	var y=0;
	var p='';
	if($(e_id).length>=1){
		x=parseInt($(e_id).offset().left);
		y=parseInt($(e_id).offset().top);
	}
	p={'ex':x,'ey':y};
	return p;
}
/*js获取元素坐标和大小*/
function getposition(obj){
    var nameobj=obj,topValue=0,rightValue=0,bottomValue=0,leftValue=0,widthValue=0,heightValue=0;
	if(typeof(obj)!='object'){
		obj=document.getElementById(obj);
		nameobj=obj;
	}
    while(obj){
		topValue+=obj.offsetTop;
		leftValue+=obj.offsetLeft;
		obj=obj.offsetParent;   
    }
	widthValue=nameobj.offsetWidth;
	heightValue=nameobj.offsetHeight;
	rightValue=(parseInt(window.document.documentElement.clientWidth)-leftValue);
	bottomValue=(parseInt(window.document.documentElement.clientHeight)-topValue);
	finalvalue={'top':parseInt(topValue),'right':rightValue,'bottom':bottomValue,'left':parseInt(leftValue),'width':parseInt(widthValue),'height':parseInt(heightValue)};
	return finalvalue;
}
/*获取元素距顶部底部的距离*/
function get_element_tb(arg_id){
	/*元素*/
	var element_obj=document.getElementById(arg_id);
	/*元素位置*/
	var element_pos=getposition(arg_id);
	/*滚动条高度*/
	var s_top=getscrolltop();
	/*获取页面可视区域总高*/
	var c_height=parseInt(Math.min(window.document.documentElement.clientHeight,window.document.body.offsetHeight));
	/*计算元素距顶部*/
	var top_val=element_pos.top-s_top;
	/*计算元素距底部*/
	var bottom_val=c_height-top_val;
	if(top_val<bottom_val){
		element_pos.top=bottom_val;	
	}
	var val={'top':top_val,'bottom':bottom_val,'e_top':element_pos.top,'e_bottom':element_pos.bottom};
	return val;
}
/*屏蔽解除按钮*/
function disableButton(buttons,isDisable){
	try{
		if(!isVal(buttons)){
			return false;
		}
		switch(typeof(buttons)){
			case 'string':
				if($(buttons).length>=1){
					$(buttons).attr("disabled",isDisable);
				}
			break;
			case 'object':
				$.each(buttons,function(i,val){
					/*屏蔽二维数组*/
					if(!isObject(val)){
						disableButton(val,isDisable);
					}
				});
			break;
		}
	}catch(e){}
	return false;
}
/*判断是否大于0的整数*/
function check_nums(v){
	var val=new String(v);
	if(val.match(/^(1|[1-9][0-9]*)$/)==null){
		return 0;
	}
	return 1;
}
/*检查字符串是否为空*/
function isVal(val){
	if(typeof(val)=="undefined" || val=="" || val==null){
		return false;
	}
	return true;
}
/*检查是否为布尔值*/
function isBoolean(val){
	if(typeof(val)!='boolean'){
		return false;
	}
	return true;
}
/*检查是否为数组或对象*/
function isObject(val){
	if(typeof(val)!='object'){
		return false;
	}
	return true;
}
/*执行函数调用*/
function do_callback_func(arg_func,arg_param){
	try{
		eval((arg_func)+'(arg_param)');
	}catch(e){}
}
/*随机数生成*/
function getrandoms(n){
	var chars=['0','1','2','3','4','5','6','7','8','9'];
	var id="",str="";
    for(var i=0;i<n;i++) {
		id=Math.ceil(Math.random()*9);
		str+=chars[id];
	}
	return str;
}
/*对象合并*/
function arr_merge(arrs,des,override){
	if(!isBoolean(override)){
		override=true;
	}
	if(!isVal(des)){
		des={};
	}
    if(arrs instanceof Array){
        for(var i = 0, len = arrs.length; i < len; i++){
             arr_merge(arrs[i],des,override);
		}
    }
    for(var i in arrs){
        if(override || !(i in des)){
            des[i] = arrs[i];
        }
    } 
    return des;
}
/*对象转成字符串*/
function objecttostr(obj){
	switch(typeof(obj)){
		case 'object':
			var ret = [];
			if (obj instanceof Array){
				for (var i = 0, len = obj.length; i < len; i++){
					ret.push(objecttostr(obj[i]));
				}
				return '[' + ret.join(',') + ']';
			}else if (obj instanceof RegExp){
				return obj.toString();
			}else{
				for (var a in obj){
					ret.push(a + ':' + objecttostr(obj[a]));
				}
				return '{' + ret.join(',') + '}';
			}
		break;		
		case 'function':
			return 'function() {}';
		break;
		case 'number':
			return obj.toString();
		break;
		case 'string':
			return "\"" + obj.replace(/(\\|\")/g, "\\$1").replace(/\n|\r|\t/g, function(a) {return ("\n"==a)?"\\n":("\r"==a)?"\\r":("\t"==a)?"\\t":"";}) + "\"";
		break;
		case 'boolean':
			return obj.toString();
		break;
		default:
			return obj.toString();
		break;
	} 
}	
/*文本框值获取和设置*/
function inputval(idname,type,setval){
	if(!isVal(type)) type='name';
	var o=$('input['+type+'="'+idname+'"]');
	if(o.length<1){ return ''; }
	if(typeof(setval)=='undefined' || setval==null){
		return $.trim(o.val());
	}
	o.val(setval);
}
/*文本域值获取和设置*/
function textareaval(idname,type,setval){
	if(!isVal(type)) type='name';
	var o=$('textarea['+type+'="'+idname+'"]');
	if(o.length<1){ return ''; }
	if(typeof(setval)=='undefined' || setval==null){
		return $.trim(o.val());
	}else{
		o.val(setval);
	}
}	
/*下拉菜单值获取*/
function selectval(idname,type){
	if(!isVal(type)) type='name';
	var o=$('select['+type+'="'+idname+'"]');
	if(o.length<1){ return ''; }
	return $.trim(o.val());
}
/*获取复选框被选中的值*/
function checkedval(idname,type){
	if(!isVal(type)) type='name';
	var valueArr =[];
	$('input['+type+'="'+idname+'"]:checked').each(function(){
		valueArr.push($(this).val());
	});
	return valueArr;
}	
/*返回选框被选中的第一个值*/
function getboxfirst(id,type,defaultval){
	var arr=checkedval(id,type);
	var _val='';
	if(typeof(arr)=='object' && arr.length>=1){
		_val=arr[0];
	}else{
		if(isVal(defaultval)){
			_val=defaultval;
		}
	}
	return _val;
}
/*设置新的input,如果不存在则创建*/
function set_html_input(idname,setval){
	if(!isVal(setval)){
		setval="";
	}
	var obj=$("input[name='"+idname+"']");
	if(obj.length<1){
		$("body").append('<input type="hidden" name="'+idname+'" id="'+idname+'" value="'+setval+'" />');
	}else{
		inputval(idname,'name',setval);
	}
}
/*设置选中或不选中*/
function setchecked(idname,type,ischecked){
	if(!isVal(idname)) return false;
	if(!isVal(type)) type='name';
	var o=$('input['+type+'="'+idname+'"]');
	if(o.length<1) return false;
	if(ischecked!=true){
		ischecked=false;
	}
	o.attr("checked",ischecked);
}
/*全选选取*/
function checkedall(idname,ckidname,defaultchecked){
	if(isBoolean(defaultchecked)){
		if(defaultchecked==true){
			setchecked(idname,'name',defaultchecked);
			setchecked(ckidname,'name',defaultchecked);
			return false;
		}
	}
	if(isVal(ckidname)){
		var ckObj=$('input[name="'+ckidname+'"]');
		if(ckObj.length<1) return false;
		if(ckObj.attr("checked")==true){
			setchecked(idname,'name',false);
			setchecked(ckidname,'name',false);
		}else{
			setchecked(idname,'name',true);
			setchecked(ckidname,'name',true);
		}
	}
}
/*给html标签填充数据*/
function setHtmlData(idname,data,isappend){
	if(!isVal(idname)) return false;
	if(!isBoolean(isappend)) isappend=false;
	if(!isVal(data)) data='';
	var obj=null;
	if(!isObject(idname)){
		obj=$(idname);
	}else{
		obj=idname;
	}
	if(isappend!=true){
		obj.html(data);
	}else{
		obj.append(data);
	}
}
/*获取html标签数据*/
function getHtmlData(idname){
	if(!isVal(idname)) return false;
	return $(idname).html();
}
/*设置html标签display*/
function setHtmlDisplay(idname,val){
	var obj=null;
	if(!isVal(idname)) return false;
	if(!isVal(val)) val="block";
	if(!isObject(idname)){
		obj=$(idname);
	}else{
		obj=idname;
	}
	obj.css({'display':val});
}
/*设置html标签css*/
function setHtmlCss(idname,val){
	var obj=null;
	if(!isVal(idname)) return false;
	if(!isVal(val)) val="";
	if(!isObject(idname)){
		obj=$(idname);
	}else{
		obj=idname;
	}
	obj.css(val);
}
/*设置html标签class*/
function setHtmlAddClass(idname,val){
	if(!isVal(idname)) return false;
	if(!isVal(val)) val="";
	$(idname).addClass(val);
}
/*移除html标签class*/
function setHtmlRemoveClass(idname,val){
	if(!isVal(idname)) return false;
	if(!isVal(val)) return false;
	$(idname).removeClass(val);
}
/*字符串替换*/
function str_replace(str,s,r){
	return str.replace(s,r);
}
/*字符串加密*/
function en_url(str){
	return encodeURIComponent(escape(str));
}
/*字符串加密*/
function de_url(str){
	return decodeURIComponent(unescape(str));
}
function ajaxAction(param){
	if(!isVal(param) && !isObject(param)) return false;
	/*提交url*/
	if(!isVal(param.actionUrl)) return false;
	var actionUrl=param.actionUrl;
	/*提交数据*/
	var actionData='';
	if(isVal(param.actionData)){
		actionData=param.actionData;
	}
	/*设置执行中的状态,参数为html标签ID*/
	var showStatusId='';
	if(isVal(param.showStatusId)){
		showStatusId=param.showStatusId;
	}
	/*设置显示返回数据,参数为html标签ID*/
	var showDataId='';
	if(isVal(param.showDataId)){
		showDataId=param.showDataId;
	}
	/*设置执行中要屏蔽的按钮*/
	var offButton='';
	if(isVal(param.offButton)){
		offButton=param.offButton;
	}
	/*时间*/
	var setTimeOut=30;
	if(isVal(param.TimeOut)){
		setTimeOut=parseInt(param.TimeOut);
	}
	setTimeOut=setTimeOut*1000;
	
	$.ajax({
		type:'POST',
		url:actionUrl,
		data:actionData,
		timeout:setTimeOut,
		beforeSend:function(XMLHttpRequest){
			/*请求开始...;*/
			disableButton(offButton,true);
			if(isVal(showStatusId)){
				setHtmlDisplay(showStatusId);
				setHtmlDisplay(showDataId,'none');
			}
		},
		success:function(data,textStatus){
			/*清除加载信息*/
			if(isVal(showStatusId)){
				setHtmlDisplay(showStatusId,'none');
			}
			/*返回数据信息*/
			setAjaxActionData($.trim(data),param);
			/*解除屏蔽按钮*/
			disableButton(offButton,false);
		},
		complete:function(XMLHttpRequest,textStatus){/*调用远程成功 textStatus=success,error*/	},
		error:function(XMLHttpRequest,textStatus,errorThrown){
			/*调用失败*/
			var errorMsg='数据读取失败';
			if(isVal(showStatusId)){
				setHtmlData(showStatusId,errorMsg);
			}else{
				setHtmlDisplay(showDataId);
				setHtmlData(showDataId,errorMsg);
			}
			disableButton(offButton,false);
		}
	});	
}
/*回调信息解析返回*/
function setAjaxActionData(data,param){
	/*检查回调函数*/
	var callbackArr=AjaxActionDataCallback(data);
	/*dialog参数*/
	var dialogValue={'title':'回调信息','width':450,'height':200,'drag':true,'showbg':false,'data':data};
	if(callbackArr.isCallback!=1){
		/*直接显示数据*/
		if(isVal(param.showDataId)){
			setHtmlDisplay(param.showDataId);
			setHtmlData(param.showDataId,data);
			return false;
		}
		/*显示异常*/
		if(window.top == window.self){
			dialog(dialogValue);
		}else{
			window.top.dialog(dialogValue);
		}
		return false;
	}
	/*获取处理数据*/
	var v={};
	try{
		v=eval(callbackArr.callbackData);
	}catch(e){
		v={};
	}
	/*直接显示数据*/
	if(isVal(param.showDataId)){
		setHtmlDisplay(param.showDataId);
		setHtmlData(param.showDataId,v.data);
		return false;
	}
	/*触发回调函数*/
	var callflag=0;
	try{
		if(isVal(v.callFunc)){
			eval(v.callFunc+'(v,param)');
			callflag=1;
		}
	}catch(e){}
	if(callflag!=1){
		if(window.top == window.self){
			dialog(dialogValue);
		}else{
			window.top.dialog(dialogValue);
		}
	}
}
/*********************************************************/
/*回调信息解析*/
function AjaxActionDataCallback(str){
	if(!isVal(str)) return str;
	/*解析状态*/
	var isCallback=0;
	var arr=null;
	/*转为字符串*/
	str=str.toString();
	/*去掉前后空格*/
	str=str.replace(/(^\s*)|(\s*$)/g, "");
	var matchArr=str.match(/\{ajaxactioncallback\}+(.+?)\{\/ajaxactioncallback\}/gi);
	if(isVal(matchArr) && isObject(matchArr)){
		isCallback=1;
		matchArr=matchArr[matchArr.length-1];
		matchArr=matchArr.replace(/(^\{ajaxactioncallback})/gi,"");
		arr='('+(matchArr.replace(/(\{\/ajaxactioncallback\})/gi,""))+')';
	}
	return {'isCallback':isCallback,'callbackData':arr};
}
/*url跳转*/
var redirectUrlTimeId=null;
function redirectUrl(param){
	clearTimeout(redirectUrlTimeId);
	if(!isObject(param)){
		param={};
	}
	if(!isVal(param.url)){
		return false;
	}
	redirectUrlTimeId=setTimeout(function(){
		if(!isVal(param.urlTarget)){
			switch(param.urlTarget){
				case "_top":
					window.top.location.href=param.url;
				break;
				default:
					window.location.href=param.url;
				break;
			}
		}else{
			try{
				window.document.getElementById(param.urlTarget).src=param.url;
			}catch(exception){
				/*mydialog({'data':'跳转失败，参数有误!'});*/
				window.location.href=param.url;
			}
		}
	},100);
}
/*是否为url*/
function isUrl(val){
	if(!isVal(val)){
		return false;
	}
	val=$.trim(val.toLowerCase());
	if(val=='javascript:;' || val=='#'){
		return false;
	}
	return true;
}
/*鼠标放上去显示当前背景*/
function currentbg(o,yn){
	var bg="";
	if(!isVal(yn)){	
		bg="#F0F7FD";
	}
	$("#"+o.id).css({"background-color":bg});
}
/*插入字符到*/
function insertchar(o,val){
	$(o).insertAtCaret(val);
}
/*鼠标放上去显示层,离开则隐藏*/
var mousehover_sh_timer='';
function mousehover_sh(o,is_show,func,param){
	clearTimeout(mousehover_sh_timer);
	var html_input="page_input_0";
	var obj,_speed=200;
	if(!isVal(is_show)){
		is_show=false
	}else{
		is_show=true;
	}
	/*隐藏上次的*/
	var id_val=inputvals(html_input);
	if(is_show!=false){
		if(id_val!=""){
			$("#"+id_val).css({"display":"none"});
		}
	}
	mousehover_sh_timer=setTimeout(function(){
		if(typeof(o)=='string'){
			obj=o;
		}else{
			obj=o.id;
		}
		/*获取当前坐标*/
		var pos=getposition(obj);
		/*要显示的对象*/
		var setid="target_"+obj;
		var setobj=$("#"+setid);
		/*要显示对象的状态*/
		var status=setobj.css("display");
		if(is_show!=false){
			if(status!="none"){
				setobj.fadeOut(_speed);
			}else{
				var mtop=pos.top;
				if(!isVal(param.addtop)){
					mtop=(check_nums(param.addtop)<1)?mtop:(mtop+parseInt(param.addtop));
				}
				setobj.css({"top":mtop+"px"});
				setobj.fadeIn(_speed);
			}
		}else{
			if(status!="none"){
				setobj.fadeIn(_speed);
			}
		}
		/*记录*/
		set_html_input(html_input,setid);
	},200);
}
/*隐藏和显示*/
function tag_hiddenshow(arg_id,is_one){
	if(!isVal(is_one)){
		is_one=false;
	}else{
		is_one=true;
	}
	if(!isVal(arg_id)){
		return false;
	}
	var obj,_speed=500;
	if(typeof(arg_id)=='string'){
		obj=$("#"+arg_id);
	}else{
		obj=arg_id;
		arg_id=arg_id.id;
	}
	/*当前显示,其他隐藏*/
	if(is_one!=false){
		var html_input='group_set_val_01';
		var id_val=inputvals(html_input);
		/*记录本次参数*/
		set_html_input(html_input,arg_id);
		/*设置选定样式*/
		if(id_val!=arg_id){
			if(id_val!=""){
				var old_obj=$("#"+id_val);
				if(old_obj.css("display")!="none"){
					old_obj.slideUp(_speed);
				}
			}
		}
	}
	/*显示当前*/
	if(obj.css("display")!="block"){
		obj.slideDown(_speed);
	}else{
		obj.slideUp(_speed);
	}
}
/** 筛选选中
  * @chkType 类型
  * @selectorName 选择器
  * @dClass 默认class名
  * @sClass 选中的class名
  * @valName input名称
  * @inputName 记录当前选择的选择器
  */
function selector_checkbox(chkType,selectorName,dClass,sClass,valName,inputName){
	var textVal=inputval(inputName);
	set_html_input(inputName,textVal);
	
	switch(chkType){
		case "radio":
			if(isVal(textVal)){
				$(textVal).removeClass(sClass);
				$(textVal).addClass(dClass);
			}
			$(selectorName).removeClass(dClass);
			$(selectorName).addClass(sClass);
			setchecked(valName,'name',true);
		break;
		case "checkbox":
			var chkObj=$('input[id="'+valName+'"]');
			var chkYN=false;
			if(chkObj.attr("checked")==true){
				$(selectorName).removeClass(sClass);
				$(selectorName).addClass(dClass);
			}else{
				$(selectorName).removeClass(dClass);
				$(selectorName).addClass(sClass);
				chkYN=true;
			}
			setchecked(valName,'id',chkYN);
		break;
		default:
			
		break;
	}
	return false;
}
/***************************************/
/*enter键触发事件*/
function enterKeyClick(ev,param){
	if(!isObject(param)) param={};
	var k=ev.keyCode || window.event.keyCode;
	if(k==13){
		if(isVal(param.func)){
			try{
				eval((param.func)+'(param)');
			}catch(e){
				mydialog({'data':'调用&nbsp;<b>'+param.func+'</b>&nbsp;异常或未定义'});
			}
		}
	}
}
/*字符串截取*/
function sub_str(arg_str,arg_slen,arg_elen,arg_dot){
	if(!isVal(arg_str)){
		return '';
	}
	var strlen=$.trim(arg_str).length;
	if(!isVal(arg_elen)){
		arg_elen=strlen;
	}
	var str=arg_str.substr(arg_slen,arg_elen);
	if(strlen>arg_elen){
		if(!isVal(arg_dot)){
			arg_dot='';
		}
		str=str+''+arg_dot;
	}
	return str;
}
/*添加cookie*/
function addcookie(objName,objValue,objHours){
    var str = objName + "=" + escape(objValue);
	/*为时不设定过期时间，浏览器关闭时cookie自动消失*/
    if(objHours > 0){
        var date = new Date();
        var ms = objHours*3600*1000;
        date.setTime(date.getTime() + ms);
        str += "; expires=" + date.toGMTString();
	}
   document.cookie = str;
}
/*设置cookie*/
function setcookie(name,value){
	/*此 cookie 将被保存 30 天*/
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
/*获得coolie的值*/
function getcookie(name){
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
	if(arr != null){
		return unescape(arr[2]);
	}
	return null;
}
/*删除cookie*/
function delcookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=getcookie(name);
    if(cval!=null) document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
/*清除cookie*/
function clearcookie(){
	var keys=document.cookie.match(/[^ =;]+(?=\=)/g);
	if (keys!=null){
		for (var i =0; i<keys.length; i++){
			document.cookie=keys[i]+'=0;expires=' + new Date(0).toUTCString();
		}
	} 
}
/*设置选项卡样式*/
function setSelectClass(val, classA, classB, selectType){
	if(!isVal(val)){
		return false;
	}
	var inputId = "r001";
	/*获取上次的值*/
	oldVal = inputval(inputId);
	if(oldVal == val){
		return false;
	}
	/*设置css*/
	if(isVal(oldVal) && oldVal!=val){
		setHtmlRemoveClass(oldVal, classB);
		setHtmlAddClass(oldVal, classA);
		if(!isVal(selectType)){
			setHtmlDisplay(oldVal, 'none');
		}
	}
	setHtmlRemoveClass(val, classA);
	setHtmlAddClass(val, classB);
	if(!isVal(selectType)){
		setHtmlDisplay(val);
	}else if(isObject(selectType)){
		setHtmlData(selectType.setDataId, selectType.data);
	}
	/*保存本次值*/
	set_html_input(inputId, val);
}