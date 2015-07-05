/*!
 * date 2015.3
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */

function cRegister_s1(_this, _url){
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "错误：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				_GESHAI.redirect(d);
			}
		}
	});
};

function cRegister_s2(_this, _url){
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "错误原因：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				_GESHAI.redirect(d);
			}
		}
	});
};

/* //cRegister_sort start */
function cRegister_sort(_eqValue){
	var _datas = _CACHE_job_sort;
	
	var _dbox = $("#sort-data-box");
	var _sbox = $("#sort-data-selected");
	
	var _appendSelected = function(_thi){
		var _sortid = $(_thi).attr("sort-id");
		var _light = $(_thi).find("a");
		if(_sbox.find("div[sort-id=\""+ _sortid +"\"]").length < 1){
			_sbox.append("<div class=\"sas\" sort-id=\"" + _sortid + "\" onclick=\"cRegister_sort_selected(this, " + _sortid + ");\"><input type=\"hidden\" name=\"csortid[]\" value=\""+_sortid+"\" /><a href=\"javascript:;\">" + $(_thi).text() + "&nbsp;<em class=\"error\">×</em></a></div>");
			_light.addClass("on");
		}else{
			_sbox.find("div[sort-id=\"" + _sortid + "\"]").remove();
			_light.removeClass("on");
		}
	};
	for(var i = 0; i < _datas.length; i++){
		if(_datas[i].parentid < 1){
			_dbox.append("<div class=\"sas\" sort-id=\"" + _datas[i].id + "\"><a href=\"javascript:;\">" + _datas[i].sname + "</a></div>");
		}
	}
	_dbox.find(".sas").click(function(e) {
        _appendSelected(this);
    });
	
	/* 已选择了的 */
	if(!_GESHAI.is_empty(_eqValue)){
		_eqValue = _eqValue.split(",");
		for(var _i in _eqValue){
			_appendSelected(_dbox.find("div[sort-id=\"" + _eqValue[_i] + "\"]"));
		}
	}
};
function cRegister_sort_selected(_this, _id){
	var _io = $("#sort-data-box").find("div[sort-id=\"" + _id + "\"]");
	$(_this).remove();
	_io.find("a").removeClass("on");
};
/* cRegister_sort end// */

function cRegister_nature(_c, _eqId){
	var _datas = _CACHE_job_nature;
	var _dbox = $(_c);
	for(var i = 0; i < _datas.length; i++){
		_dbox.append("<option value=\"" + _datas[i].id + "\" " + (_datas[i].id == _eqId ? " selected=\"selected\"" : "") + ">" + _datas[i].nname + "</option>");
	}
};

/* update password */
function updatePassword(_this, _url){
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "错误原因：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				_GESHAI.redirect(d);
			}
		}
	});
};

/*********** info update *************/
/* base */
function cuserInfo_base(_this){
	return _GESHAI.fsubmit(_this, __actUrl, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			d.clickBgClose = true;
			
			if(d.status != 1){
				d.title = "操作失败";
			}
			window.top._GESHAI.dialog(d);
		}
	});
};
/* des */
function cuserInfo_des(_this){
	return cuserInfo_base(_this);
};
/* logo */
function cuserInfo_logo(_this, _type){
	if(_this.getAttribute("flag") == "del"){
		_type = _this.getAttribute("flag");
		_this = document.getElementById("form_logo");
		_this.act_type.value = _type;
	}else{
		_this.form.act_type.value = _type;
	}
	if(_type == "del"){
		window.top._GESHAI.dialog({
				"title": "删除“logo”",
				"data": "<p>若删除，将不可恢复。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, __actUrl, {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除“logo”";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								window.location.href = __curHref;
							}
						}
					});
				}
			});
	}else{
		if(_this.value.length < 1){
			window.top._GESHAI.dialog({ title: "错误：", data: "请选择“logo”上传文件", clickBgClose: true, isCloseBtn: false });
			return null;
		}
		_this.form.fname.value = _this.value;
		return _GESHAI.fsubmit(_this, __actUrl, {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				d.isCloseBtn = false;
				d.clickBgClose = true;
				
				if(d.status != 1){
					d.title = "操作失败";
				}
				window.top._GESHAI.dialog(d);
				if(d.status == 1){
						window.location.href = __curHref;
					}
			}
		});
	}
};
/* licence */
function cuserInfo_licence(_this, _type){
	if(_this.getAttribute("flag") == "del"){
		_type = _this.getAttribute("flag");
		_this = document.getElementById("form_licence");
		_this.act_type.value = _type;
	}else{
		_this.form.act_type.value = _type;
	}
	
	if(_type == "del"){
		window.top._GESHAI.dialog({
				"title": "删除“营业执照”",
				"data": "<p>若删除，将不可恢复，且恢复为“未认证”状态。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, __actUrl, {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								window.location.href = __curHref;
							}
						}
					});
				}
			});
	}else{
		if(_this.value.length < 1){
			window.top._GESHAI.dialog({ title: "错误：", data: "请选择“营业执照”上传文件", clickBgClose: true, isCloseBtn: false });
			return null;
		}
		_this.form.fname.value = _this.value;
		
		return _GESHAI.fsubmit(_this, __actUrl, {
			"start": function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
			},
			"success": function(d){
				_GESHAI.disbtn("", false);
				d.isCloseBtn = false;
				d.clickBgClose = true;
				
				if(d.status != 1){
					d.title = "操作失败";
				}
				window.top._GESHAI.dialog(d);
				if(d.status == 1){
						window.location.href = __curHref;
					}
			}
		});
	}
};
/* zplx */
function cuserInfo_zplx(_this, _type){
	var __id = _this.getAttribute("data-id");
	var __form = document.getElementById("form_zplx");
		__form.zplxid.value = __id;
	if(_type == "del"){
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "您确定要删除联系人“<strong>" + ($("#zname_" + __id).text()) + "</strong>”吗？",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(__form, __actDel, {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								window.top._GESHAI.dialog.close();
								_GESHAI.redirect(d);
							}
						}
					});
				}
			});
	} else {
	}
};
function cuserInfo_zplxWrite(id){
	var _html = $("#zplx_write_wrap").html().replace("{form}", "form_zplx_write");
	var _titleStr = "+新增联系人";
	var _value = {
			"zplxid": 0,
			"zname": "",
			"mp0": "",
			"mp1": "",
			"mp2": "",
			"tp": "",
			"email": ""
		};
	if(id){
		_value.zplxid = id;
		_value.zname = $("#zname_" + id).text();
		_value.mp0 = $("#mp0_" + id).text();
		_value.mp1 = $("#mp1_" + id).text();
		_value.mp2 = $("#mp2_" + id).text();
		_value.tp = $("#tp_" + id).text();
		_value.email = $("#email_" + id).text();
		
		_titleStr = "修改联系人“" + _value.zname + "”";
	}
	for(var k in _value){
		_html = _html.replace("v=\"{" + k + "}\"", "value=\"" + _value[k] + "\"");
	}
	window.top._GESHAI.dialog({
				"title": _titleStr,
				"data": _html,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					var _this = document.getElementById("form_zplx_write");
					
					return _GESHAI.fsubmit(_this, __actUrl, {
						"start": function(){
							_GESHAI.disbtn("", true);
							
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							if(d.status != 1){
								alert(d.data);
							}
							if(d.status == 1 || d.type == 'n'){
								window.top._GESHAI.dialog.close();
								_GESHAI.redirect(d);
							}
						}
					});
				}
			});
};