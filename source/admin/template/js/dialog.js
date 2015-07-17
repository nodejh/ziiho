/*设置时间id*/
var dialogTimerId=null;
function dialog(param){
	/*清除时间id*/
	clearTimeout(dialogTimerId);
	if(!isVal(param)) param={};
	/*清除除内容*/
	$("#windown-box").remove();
	/*是否显示窗口*/
	var showDialog = true;
	if(isBoolean(param.showDialog)){
		showDialog=param.showDialog;
	}
	/*加载状态图片*/
	var loadSrc = _CJG.sourcepath+"module/admin/template/image/loading.gif";
	if(isVal(param.loadSrc)){
		loadSrc=param.loadSrc;
	}
	/*两个按钮id为随机*/
	var okButtonId='windown-button-'+getrandoms(4);
	var cancelButtonId='windown-button-'+getrandoms(4);
	/*两个按钮名称*/
	var okButtonTitle='确定';
	var cancelButtonTitle='取消';
	/*设置标题*/
	var title='温馨提示:';
	if(isVal(param.title)){
		title=param.title;
	}
	/*设置最大窗口宽度*/
	var width=950;
	if(isVal(param.width)){
		if(param.width<=width){
			width=param.width;
		}
	}else{
		width=420;
	}
	/*设置最大窗口高度*/
	var height=527;
	if(isVal(param.height)){
		if(param.height<=height){
			height=param.height;
		}
	}else{
		height=120;
	}
	/*显示背景*/
	var showbg=true;
	if(isBoolean(param.showbg)){
		showbg=param.showbg;
	}
	/*是否可拖动*/
	var drag=true;
	if(isBoolean(param.drag)){
		drag=param.drag;
	}
	/*内容样式*/
	var cssName='';
	if(isVal(param.cssName)){
		cssName=param.cssName;
	}
	/*加载提示状态*/
	var showloading=false;
	if(isBoolean(param.showloading)){
		showloading=param.showloading;
	}
	/*自动关闭时间*/
	var time='';
	if(isVal(param.time)){
		time=parseInt(param.time);
	}
	/*点击背景关闭*/
	var cbgclose=false;
	if(isBoolean(param.cbgclose)){
		cbgclose=param.cbgclose;
	}
	/*******************参数*****************/
	/*显示类型*/
	var contentType='text';
	if(isVal(param.type)){
		contentType=param.type;
	}
	/*url*/
	var toUrl='';
	if(isVal(param.url)){
		toUrl=param.url;
	}
	/*url数据类型*/
	var dataType='POST';
	if(isVal(param.datatype)){
		dataType=(param.datatype).toUpperCase();
	}
	/*显示数据*/
	var dataValue='';
	if(isVal(param.data)){
		dataValue=param.data;
	}
	/*点击ok按钮的函数调用*/
	var okClick="dialogClose();";
	if(isVal(param.okClick)){
		okClick=param.okClick+"();";
		if(!isVal(param.okClickValue)) param.okClickValue={};
		/*操作时将要禁止的按钮*/
		var offButtonArr=['#'+okButtonId,'#'+cancelButtonId];
		if(isVal(param.okClickValue.offButton)){
			if(isObject(param.okClickValue.offButton)){
				param.okClickValue.offButton=param.okClickValue.offButton.concat(offButtonArr);
			}else{
				offButtonArr.push(param.okClickValue.offButton);
				param.okClickValue.offButton=offButtonArr;
			}
		}else{
			param.okClickValue.offButton=offButtonArr;
		}
		if(isVal(param.okClickValue)){
			okClick=param.okClick+"("+objecttostr(param.okClickValue)+");";
		}
	}
	/*指定html链接跳转方式*/
	var urlTarget='';
	if(isVal(param.urlTarget)){
		urlTarget=param.urlTarget;
	}
	/*显示点击链接跳转*/
	var returnUrl='';
	if(isVal(param.returnUrl)){
		returnUrl=param.returnUrl;
	}
	/*显示确定按钮*/
	var showOkButton=true;
	if(isBoolean(param.showOkButton)){
		showOkButton=param.showOkButton;
	}
	if(showOkButton==true){
		if(isVal(param.okButtonTitle)){
			okButtonTitle=param.okButtonTitle;
		}
	}
	/*显示取消按钮*/
	var showCancelButton=false;
	if(isBoolean(param.showCancelButton)){
		showCancelButton=param.showCancelButton;
	}
	if(showCancelButton==true){
		if(isVal(param.cancelButtonTitle)){
			cancelButtonTitle=param.cancelButtonTitle;
		}
	}
	/*初始化自动关闭窗口提示信息*/
	var timeMsg='';
	if(isVal(time)){
		timeMsg='秒钟后自动关闭';
	}
	if(isVal(returnUrl)){
		timeMsg='秒钟后自动跳转';
	}
	/***********************************/
	/*显示窗口*/
	if(showDialog == true) {
		var simpleWindown_html = new String();
			simpleWindown_html = "<div id=\"windownbg\" style=\"height:"+($(document).height())+"px;filter:alpha(opacity=0);background:#000000;opacity:0;z-index: 999999\"></div>";
			simpleWindown_html += "<div id=\"windown-box\">";
			simpleWindown_html += "<div id=\"windown-title\"><h2></h2><span id=\"windown-close\"><a href=\"javascript:;\" onclick=\"dialogClose()\">×</a></span></div>";
			simpleWindown_html += "<div id=\"windown-content-border\"><div id=\"windown-content\"></div></div>";
			
			/*底部start*/
			simpleWindown_html += "<div id=\"windown-button-main\">";
			
			/*时间执行*/
			if(isVal(time)){
			simpleWindown_html += "<span class=\"windown-click-url\"><font id=\"windown-show-time\"></font>&nbsp;"+timeMsg;
			if(isVal(returnUrl)){
			simpleWindown_html += ",&nbsp;<a href=\""+returnUrl+"\" target=\""+urlTarget+"\" onclick=\"redirectUrl({'url':this.href,'urlTarget':this.target});dialogClose();return false;\">点击此链接跳转</a>";
			}
			simpleWindown_html += "</span>";
			}
			if(showOkButton==true || showCancelButton==true){
			simpleWindown_html += "&nbsp;&nbsp;";
			}
			/*按钮start*/
			if(showOkButton==true){;
			simpleWindown_html += "<button type=\"button\" class=\"windown-button-a\" id=\""+okButtonId+"\" name=\""+okButtonId+"\" onclick=\'"+okClick+"\'>"+okButtonTitle+"</button>";
			}
			if(showOkButton==true && showCancelButton==true){
			simpleWindown_html += "&nbsp;&nbsp;";
			}
			if(showCancelButton==true){
			simpleWindown_html += "<button type=\"button\" class=\"windown-button-b\" id=\""+cancelButtonId+"\" name=\""+cancelButtonId+"\" onclick=\"dialogClose();\">"+cancelButtonTitle+"</button>";
			}
			/*按钮end*/
			simpleWindown_html += "&nbsp;&nbsp;&nbsp;&nbsp;</div>";
			/*底部end*/
			simpleWindown_html += "</div>";
			$("body").append(simpleWindown_html);
			show = false;
	}
	switch(contentType.toLowerCase()){
		case "text":
			$("#windown-content").html(dataValue);
		break;
		case "id":
			$("#windown-content").html($(dataValue).html());
		break;		
		case "img":
			$("#windown-content").ajaxStart(function() {
				if(showloading==true){
					$(this).html("<img src='"+loadSrc+"' class='loading' />");
				}
			});
			$.ajax({
				error:function(){
					$("#windown-content").html("<p class='windown-error'>加载数据出错...</p>");
				},
				success:function(html){
					$("#windown-content").html("<img src="+dataValue+" alt='' />");
				}
			});
		break;
		case "url":
			$("#windown-content").ajaxStart(function(){
				if(showloading==true){
					$(this).html("<img src='"+loadSrc+"' class='loading' />");
				}
			});
			$.ajax({
				type:dataType,
				url:toUrl,
				data:dataValue,
				error:function(){
					$("#windown-content").html("<p class='windown-error'>加载数据出错...</p>");
				},
				success:function(html){
					$("#windown-content").html(html);
				}
			});
		break;
		case "iframe":
			$("#windown-content").ajaxStart(function(){
				if(showloading==true){
					$(this).html("<img src='"+loadSrc+"' class='loading' />");
				}
			});
			$.ajax({
				error:function(){
					$("#windown-content").html("<p class='windown-error'>加载数据出错...</p>");
				},
				success:function(html){
					_CJG.dialogIframeId="dialog-content-iframe-"+getrandoms(4);
					$("#windown-content").html("<iframe id=\""+_CJG.dialogIframeId+"\" src=\""+toUrl+"\" width=\"100%\" height=\""+parseInt(height)+"px"+"\" scrolling=\"auto\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>");
					_CJG.dialogIframe=window.frames[_CJG.dialogIframeId];
				}
			});
		}
	/*设置标题*/	
	$("#windown-title h2").html(title);
	/*是否显示背景*/
	if(showbg == true){
		$("#windownbg").show();
	}else{
		$("#windownbg").remove();
	}
	/*设置透明度*/
	$("#windownbg").animate({opacity:"0.2"},"normal");
	$("#windown-box").show();
	if(height>=527) {
		$("#windown-title").css({width:"auto"});
		$("#windown-content").css({width:"auto"});
		$("#windown-title").css({width:(parseInt(width)+22)+"px"});
		$("#windown-content").css({width:(parseInt(width)+17)+"px",height:height+"px"});
	}else {	
		$("#windown-title").css({width:(parseInt(width)+10)+"px"});
		$("#windown-content").css({width:width+"px",height:height+"px"});
	}
	var	cw=document.documentElement.clientWidth;
	var ch=document.documentElement.clientHeight;
	var est=document.documentElement.scrollTop;
	var _version=$.browser.version;
	if (_version==6.0){
		$("#windown-box").css({left:"50%",top:(parseInt((ch)/2)+est)+"px",marginTop: -((parseInt(height)+53)/2)+"px",marginLeft:-((parseInt(width)+32)/2)+"px",zIndex: "999999"});
	}else{
		$("#windown-box").css({left:"50%",top:"50%",marginTop:-((parseInt(height)+53)/2)+"px",marginLeft:-((parseInt(width)+32)/2)+"px",zIndex: "999999"});
	}
	var Drag_ID=document.getElementById("windown-box"),DragHead=document.getElementById("windown-title");
	var moveX=0;
	var moveY=0;
	var moveTop;
	var moveLeft=0;
	var moveable=false;
	if(_version==6.0){
		moveTop=est;
	}else{
		moveTop=0;
	}
	var	sw=Drag_ID.scrollWidth,sh=Drag_ID.scrollHeight;
	DragHead.onmouseover=function(e) {
		if(drag==true){
			DragHead.style.cursor = "default";/*move*/
		}else{
			DragHead.style.cursor = "default";
		}
	}
	DragHead.onmousedown=function(e){
		if(drag==true){
			moveable=true;
		}else{
			moveable=false;
		}
		e=window.event?window.event:e;
		var ol=Drag_ID.offsetLeft;
		var ot=Drag_ID.offsetTop-moveTop;
		moveX=e.clientX-ol;
		moveY=e.clientY-ot;
		document.onmousemove=function(e){
			if(moveable){
				e=window.event?window.event:e;
				var x=e.clientX-moveX;
				var y=e.clientY-moveY;
				if (x>0 && (x+sw<cw) && y>0 && (y+sh<ch)){
					Drag_ID.style.left=x+"px";
					Drag_ID.style.top=parseInt(y+moveTop)+"px";
					Drag_ID.style.margin = "auto";
				}
			}
		}
		document.onmouseup=function(){
			moveable = false;
		}
		Drag_ID.onselectstart=function(e){
			return false;
		}
	}
	$("#windown-content").attr("class","windown-"+cssName);
	if(isVal(time)){
		var _param={'url':returnUrl,'urlTarget':urlTarget};
		dialogUpdateTime(time,$("#windown-show-time"),_param);
	}
	if(cbgclose==true){
		$("#windownbg").click(function(){
			dialogClose();
		});
	}
}
/*时间更新*/
function dialogUpdateTime(_doTime,_showHtmlObj,_param){
	_showHtmlObj.html(_doTime);
	if(_doTime<2){
		dialogTimerId=setTimeout(function(){
			dialogClose();
			if(isVal(_param)){
				redirectUrl(_param);
			}
		},1000);
		return false;
	}
	dialogTimerId=setTimeout(function(){
		dialogUpdateTime((_doTime-1),_showHtmlObj,_param);
	},1000);
}
/*关闭窗口*/
function dialogClose(){
	clearTimeout(dialogTimerId);
	$("#windownbg").remove();
	$("#windown-box").fadeOut("fast",function(){$(this).remove();});
}
/***********简化**********/
function mydialog(param){
	if(!isVal(param)) param={};
	if(isVal(param.data)){
		param.data='<div class="windown-content-data"><div class="fs14px">'+param.data+'</div></div>';
	}
	if(window.top!=window.self){
		window.top.dialog(param);
	}else{
		dialog(param);
	}
}
/*ajax操作dialog*/
function ajaxActionDialog(serverData,param){
	if(!isVal(serverData)) serverData={};
	if(!isVal(param)) param={};
	var arr=param;
	if(isObject(serverData) && isObject(param.okClickValue)){
		arr.okClickValue=arr_merge(param.okClickValue,serverData);
	}else{
		arr.okClickValue=serverData;
	}
	/*覆盖参数*/
	if(isVal(serverData.data)){
		arr.data=serverData.data;
	}
	if(isVal(serverData.urlTarget)){
		arr.urlTarget=serverData.urlTarget;
	}
	if(isVal(serverData.url)){
		arr.showOkButton=false;
		arr.time=3;
		arr.returnUrl=serverData.url;
	}
	arr.data='<div class="windown-content-data"><div class="fs14px">'+arr.data+'</div></div>';
	if(window.top!=window.self){
		window.top.dialog(arr);
	}else{
		dialog(arr);
	}
}