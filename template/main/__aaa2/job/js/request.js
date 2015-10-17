/*!
 * date 2015.3
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */
function _requestJobReady(_this){
	var _form = document.getElementById("form_request");
	var _readyUrl = _form.getAttribute("_ready");
	var _doUrl = _form.getAttribute("_do");
	var _titStr = "简历投递操作";
	if(!_GESHAI.is_empty(_readyUrl) && !_GESHAI.is_empty(_doUrl)) {
		window.top._GESHAI.dialog({
				title: _titStr,
				data: "你确定要申请该职位吗？",
				isCloseBtn: false,
				isCancelBtn: true,
				okBtnFunc : function(){
					return _GESHAI.fsubmit(_form, _readyUrl, {
						start: function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						success: function(d){
							_GESHAI.disbtn("", false);
							d.title = _titStr;
							if(d.status != 1){
								d.isCloseBtn = false;
								d.clickBgClose = true;
								window.top._GESHAI.dialog(d);
							} else {
								var _fraName = "job_request_select";
								d.isCancelBtn = true;
								d.data = "<iframe width=\"620\" height=\"300\" frameborder=\"no\" border=\"0\" framespacing=\"0\" scrolling=\"auto\" id=\"" + _fraName + "\" name=\"" + _fraName + "\" src=\"" + d.selurl + "\"></iframe>";
								d.okBtnFunc = function(){
									var _fraObj = $(window.frames[_fraName].document);
									var _recordidVal = _fraObj.find("input[name=\"resumeid\"]:checked").val();
									var _resumeidVal = [];
									
									_fraObj.find("input[name=\"recordid[]\"]:checked").each(function(index, element) {
                                        _resumeidVal.push($(this).val());
                                    });
									
									_form.resumeid.value = (!_GESHAI.is_empty(_recordidVal) ? _recordidVal : "");
									_form.recordid.value = _resumeidVal.join(",");
									
									if(_GESHAI.is_empty(_recordidVal)) {
										alert("对不起，请选择简历！");
									} else {
										_requestJobDo(_form, _doUrl);
									}
								};
								window.top._GESHAI.dialog(d);
							}
						}
					});
				}
		});
	} else {
		window.top._GESHAI.dialog({ data: "对不起，无效的请求！", isCloseBtn: false, clickBgClose: true });
	}
	return false;
};
function _requestJobDo(_this, _url){
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			
			d.isCloseBtn = false;
			d.clickBgClose = true;
			if(d.status != 1){
				d.title = "错误：";
				alert(d.data);
			}else{
				window.top._GESHAI.dialog(d);
			}
		}
	});
};