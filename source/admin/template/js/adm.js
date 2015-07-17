// JavaScript Document
/*显示当前设置选项*/
function adm_showCurrentItem(data){
	if(!isVal(data)){
		return false;
	}
	if(!isObject(data)){
		data={};
	}
	/*html标签属性*/
	var htmlAttr="fielditem";
	if(isVal(data.htmlAttr)){
		htmlAttr=data.htmlAttr;
	}
	var inputRecordId="input_adm_showCurrentItem";
	if(isVal(data.inputRecordId)){
		inputRecordId=data.inputRecordId;
	}
	/*获取上次的参数*/
	var oldVal=inputval(inputRecordId);
	/*记录本次参数*/
	set_html_input(inputRecordId,data.val);
	if(isVal(oldVal)){
		if(oldVal==data.val){
			return false
		}
		setHtmlDisplay($('li['+htmlAttr+'="'+oldVal+'"]'),"none");
	}
	setHtmlDisplay($('li['+htmlAttr+'="'+data.val+'"]'));
}
/*获取官方动态*/
function adm_GetAuthorProductActiveInfo(_getUrl,_dataId){
	var _dataIdObj=$(_dataId);
	$.ajax({
		type:'POST',
		url:_getUrl,
		data:{},
		timeout:(30*1000),
		beforeSend:function(XMLHttpRequest){
			_dataIdObj.html('<p class="c_ml5px c_mt5px color1">正在获取动态信息...</p>');
		},
		success:function(data,textStatus){
			data=$.trim(data);
			if(data==''){
				_dataIdObj.html('<p class="c_ml5px c_mt5px color1">暂无动态信息。</p>');
			}else{
				_dataIdObj.html("");
				var i=0;
				var Arr=data.match(/\<cj_item\>(([\s]+(.*?))|(.*?))*\<\/cj_item\>/gi);
				if(isVal(Arr)){
					var _dataTitle=null;
					var _dataUrl=null;
					var regExp=null;
					for(i=0; i<Arr.length;i++){
						/*标题*/
						regExp=new RegExp("\<title\>(.+?)\<\/title\>",'gi');
						_dataTitle=regExp.exec(Arr[i]);
						_dataTitle=_dataTitle[1];
						/*url*/
						regExp=new RegExp("\<url\>(.+?)\<\/url\>",'gi');
						_dataUrl=regExp.exec(Arr[i]);
						_dataUrl=_dataUrl[1];
						_dataIdObj.append('<p class="c_ml5px c_mt5px"><a href="'+_dataUrl+'" target="_blank">'+_dataTitle+'</a></p>');
					}
				}
				if(i<1){
					_dataIdObj.html('<p class="c_ml5px c_mt5px color1">暂无动态信息。</p>');
				}
			}
		},
		complete:function(XMLHttpRequest,textStatus){},
		error:function(XMLHttpRequest,textStatus,errorThrown){
			_dataIdObj.html('<p class="c_ml5px c_mt5px color1">获取动态信息失败...</p>');
		}
	});
}