/*!
 * date 2015.7
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */

function resume_placeholder(){
	var _placeholderData = [
			{n: "textarea[wish=\"selfintroduce\"]", t: "请输入自我介绍..."},
			{n: "textarea[relate=\"explaindesc\"]", t: "请输入..."},
			{n: "textarea[educate=\"description\"]", t: "请输入专业描述..."},
			{n: "input[educate=\"specialty_input\"]", t: "输入您的专业..."},
			{n: "textarea[attach=\"description\"]", t: "请输入附件描述..."},
			{n: "textarea[workexp=\"description\"]", t: "请输入您的工作描述..."},
			{n: "textarea[projectexp=\"pdesc\"]", t: "请输入项目描述..."},
			{n: "textarea[projectexp=\"responsible\"]", t: "请输入项目责任描述..."},
			{n: "textarea[train=\"description\"]", t: "请输入培训描述..."},
			{n: "input[wish=\"wage_input\"]", t: "输入薪资..."}
		];
	for(var i = 0; i < _placeholderData.length; i++){
		_GESHAI.placeholder({name: _placeholderData[i].n, text: _placeholderData[i].t});
	}
}

function hy_InitHtml(_o){
	var _defValue = _o.attr("def");
		_defValue = _defValue.match(/\d+/g);
	for(var i = 0; i < _CACHE_job_sort.length; i++){
		if(_CACHE_job_sort[i].parentid == 0){
			_o.append("<option value=\"" + _CACHE_job_sort[i].id + "\" " + (_GESHAI.in_array(_CACHE_job_sort[i].id, _defValue) ? "selected=\"selected\"" : "") + ">" + _CACHE_job_sort[i].sname + "</option>");
		}
	}
};

function zw_InitHtml(_o){
	var _defValue = _o.attr("def");
		_defValue = _defValue.match(/\d+/g);
	for(var i = 0; i < _CACHE_job_sort.length; i++){
		var _htmlData = "";
		if(_CACHE_job_sort[i].parentid == 0){
			_htmlData += "<optgroup label=\"" + _CACHE_job_sort[i].sname + "\">";
			
			for(var j = 0; j < _CACHE_job_sort.length; j++){
				if(_CACHE_job_sort[i].id == _CACHE_job_sort[j].parentid) {
					_htmlData += "<option value=\"" + _CACHE_job_sort[j].id + "\" " + (_GESHAI.in_array(_CACHE_job_sort[j].id, _defValue) ? "selected=\"selected\"" : "") + ">" + _CACHE_job_sort[j].sname + "</option>";
				}
			}
			_htmlData += "</optgroup>";
		}
		_o.append(_htmlData);
	}
};

function resume_sHtml(_obj){
	var _form = $("#rform");
	var _fields = {
			"m_rname": _form.find("input[name=\"m_rname\"]").val(),
			"m_publishlv": _form.find("select[name=\"m_publishlv\"] option:selected").val()
		};
	
	var _iform = $(_obj);
	for(var _k in _fields) {
		var _o = _iform.find("input[name=\"" + _k + "\"]");
		if(_o.length < 1){
			_iform.append("<input type=\"hidden\" name=\"" + _k + "\" value=\"" + _fields[_k] + "\" />");
		} else {
			_o.val(_fields[_k]);
		}
	}
};

/********************************************************/
/* resume */
function resumeDo_save(_url) {
	_GESHAI.fsubmit(document.getElementById("rform"), _url, {
		start: function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		success: function(d){
			_GESHAI.disbtn("", false);
			
			if(d.status != 1){
				d.clickBgClose = true;
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "错误：";	
				window.top._GESHAI.dialog(d);
			} else {
				window.top._GESHAI.dialog.close();
			}
		}
	});
	return false;
};

function resumeDo_delete(id) {
	var _form = document.getElementById("m_resume_form");
		_form.resumeid.value = id;
	var nameStr = $("#rname_" + id).text();
	window.top._GESHAI.dialog({
		title: "删除提醒：",
		data: "<p>您确定要删除简历“<strong>" + nameStr + "</strong>”？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			_GESHAI.fsubmit(_form, _form.getAttribute("del"), {
				start: function(){
					_GESHAI.disbtn("", true);
					window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
				},
				success: function(d){
					_GESHAI.disbtn("", false);
					
					if(d.status != 1){
						d.clickBgClose = true;
						d.isCloseBtn = false;
						d.clickBgClose = true;
						d.title = "错误：";	
						window.top._GESHAI.dialog(d);
					} else {
						window.top._GESHAI.dialog.close();
						window.location.reload();
					}
				}
			});
		}
	});
	return false;
};

/********************************************************/
/* base */
function resumeDo_base(_this, _url) {
	resume_sHtml(_this.form);
	
	window.top._GESHAI.dialog({
		title: "保存“个人信息”提醒：",
		data: "<p>个人信息作为所有简历公用，保存将会同步更新其他简历中的个人信息。<p>如果要更新请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			return _GESHAI.fsubmit(_this, _url, {
				start: function(){
					_GESHAI.disbtn("", true);
					window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
				},
				success: function(d){
					_GESHAI.disbtn("", false);
					
					if(d.status != 1){
						d.clickBgClose = true;
						d.isCloseBtn = false;
						d.clickBgClose = true;
						d.title = "错误：";	
						window.top._GESHAI.dialog(d);
					} else {
						window.top._GESHAI.dialog.close();
					}
				}
			});
		}
	});
};

/********************************************************/
/* wish */
function resumeDo_wish(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";	
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
				}
			}
		});
};

function resume_wish_wagetype(__v){
	var __wage_year = $("select[name='wage_year']");
	var __wage_month = $("select[name='wage_month']");
	var __wage_input_box = $("span[wish='wage_input_box']");
	var __wage_no = $("span[wish='wage_no']");
	switch(__v){
		case '122':
			__wage_year.show().removeAttr("disabled");
			__wage_month.hide();
			__wage_input_box.hide();
			__wage_no.hide();
			break;
		case '116':
			__wage_year.hide();
			__wage_month.show().removeAttr("disabled");
			__wage_input_box.hide();
			__wage_no.hide();
			break;
		case 'day':
			__wage_year.hide();
			__wage_month.hide();
			__wage_input_box.show().find("input").attr("value", "");
			__wage_no.hide();
			
			resume_placeholder();
			break;
		case 'hour':
			__wage_year.hide();
			__wage_month.hide();
			__wage_input_box.show().find("input").attr("value", "");
			__wage_no.hide();
			
			resume_placeholder();
			break;
		default:
			__wage_year.hide();
			__wage_month.hide();
			__wage_input_box.hide();
			__wage_no.show();
			break; 
	}
};

/********************************************************/
/* educate */
function resumeDo_educateSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#educate_write_wrap").html("").hide();
					$("#educate_add_btn").show();
						
					if(d.dotype == 'add') {
						$("#educate_data").append("<div class=\"clearfix\" style=\"display:none;\" id=\"educate_data_" + d.educateid + "\">");
						$("#educate_data_" + d.educateid).html(d.data).animate({"height": "show" }, 500);
					} else {
						$("#educate_data_" + d.educateid).html(d.data);
					}
				}
				
			}
		});
};
function resumeDo_educateDel(_educateid) {
	var _form = document.getElementById("educate_del");
		_form.educateid.value = _educateid;
	
	resume_sHtml(_form);
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			if(_educateid >= 1) {
				return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
					start: function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						
						if(d.status != 1){
							d.clickBgClose = true;
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "错误：";	
							window.top._GESHAI.dialog(d);
						} else {
							window.top._GESHAI.dialog.close();
							
							var _o = $("#educate_data_" + _educateid);
							_o.animate({"height": "0px" }, 500, "", 
								function (){
									_o.remove();
									$("#train_add_btn").show();
								});
						}
					}
				});
			}else{
				window.top._GESHAI.dialog.close();
				
				$("#educate_write_wrap").html("").hide();
				$("#educate_add_btn").show();
			}
		}
	});
	return false;
};
function resumeDo_educateForm(_id){
	var _form = document.getElementById("s_educate_form");
		$(_form).append('<input type="hidden" name="educateid" value="' + _id + '" />');
		
	_GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#educate_add_btn").hide();
					if(_id < 1) {
						$("#educate_write_wrap").html(d.data).show();
					} else {
						$("#educate_write_wrap").html("").hide();
						$("#educate_data_" + _id).html(d.data);
					}
					resume_placeholder();
				}
			}
		});
	return false;
};

/********************************************************/
/* train */
function resumeDo_trainSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#train_write_wrap").html("").hide();
					$("#train_add_btn").show();
						
					if(d.dotype == 'add') {
						$("#train_data").append("<div class=\"clearfix\" style=\"display:none;\" id=\"train_data_" + d.trainid + "\">");
						$("#train_data_" + d.trainid).html(d.data).animate({"height": "show" }, 500);
					} else {
						$("#train_data_" + d.trainid).html(d.data);
					}
				}
				
			}
		});
};
function resumeDo_trainDel(_trainid) {
	var _form = document.getElementById("train_del");
		_form.trainid.value = _trainid;
	
	resume_sHtml(_form);
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			if(_trainid >= 1) {
				return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
					start: function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						
						if(d.status != 1){
							d.clickBgClose = true;
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "错误：";	
							window.top._GESHAI.dialog(d);
						} else {
							window.top._GESHAI.dialog.close();
							var _o = $("#train_data_" + _trainid);
							_o.animate({"height": "0px" }, 500, "", 
								function (){
									_o.remove();
									$("#train_add_btn").show();
								});
						}
					}
				});
			}else{
				window.top._GESHAI.dialog.close();
				$("#train_write_wrap").html("").hide();
				$("#train_add_btn").show();
			}
		}
	});
	return false;
};
function resumeDo_trainForm(_id){
	var _form = document.getElementById("s_train_form");
		$(_form).append('<input type="hidden" name="trainid" value="' + _id + '" />');
		
	_GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#train_add_btn").hide();
					if(_id < 1) {
						$("#train_write_wrap").html(d.data).show();
					} else {
						$("#train_write_wrap").html("").hide();
						$("#train_data_" + _id).html(d.data);
					}
					resume_placeholder();
				}
			}
		});
	return false;
};

/********************************************************/
/* language */
function resumeDo_languageSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#language_write_wrap").html("").hide();
					$("#language_add_btn").show();
						
					if(d.dotype == 'add') {
						$("#language_data").append("<div class=\"clearfix\" style=\"display:none;\" id=\"language_data_" + d.languageid + "\">");
						$("#language_data_" + d.languageid).html(d.data).animate({"height": "show" }, 500);
					} else {
						$("#language_data_" + d.languageid).html(d.data);
					}
				}
				
			}
		});
};
function resumeDo_languageDel(_languageid) {
	var _form = document.getElementById("language_del");
		_form.languageid.value = _languageid;
	
	resume_sHtml(_form);
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			if(_languageid >= 1) {
				return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
					start: function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						
						if(d.status != 1){
							d.clickBgClose = true;
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "错误：";	
							window.top._GESHAI.dialog(d);
						} else {
							window.top._GESHAI.dialog.close();
							var _o = $("#language_data_" + _languageid);
							_o.animate({"height": "0px" }, 500, "", 
								function (){
									_o.remove();
									$("#language_add_btn").show();
								});
						}
					}
				});
			}else{
				window.top._GESHAI.dialog.close();
				$("#language_write_wrap").html("").hide();
				$("#language_add_btn").show();
			}
		}
	});
	return false;
};
function resumeDo_languageForm(_id){
	var _form = document.getElementById("s_language_form");
		$(_form).append('<input type="hidden" name="languageid" value="' + _id + '" />');
		
	_GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#language_add_btn").hide();
					if(_id < 1) {
						$("#language_write_wrap").html(d.data).show();
					} else {
						$("#language_write_wrap").html("").hide();
						$("#language_data_" + _id).html(d.data);
					}
					resume_placeholder();
				}
			}
		});
	return false;
};

/********************************************************/
/* projectexp */
function resumeDo_projectexpSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#projectexp_write_wrap").html("").hide();
					$("#projectexp_add_btn").show();
						
					if(d.dotype == 'add') {
						$("#projectexp_data").append("<div class=\"clearfix\" style=\"display:none;\" id=\"projectexp_data_" + d.projectexpid + "\">");
						$("#projectexp_data_" + d.projectexpid).html(d.data).animate({"height": "show" }, 500);
					} else {
						$("#projectexp_data_" + d.projectexpid).html(d.data);
					}
				}
				
			}
		});
};
function resumeDo_projectexpDel(_projectexpid) {
	var _form = document.getElementById("projectexp_del");
		_form.projectexpid.value = _projectexpid;
	
	resume_sHtml(_form);
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			if(_projectexpid >= 1) {
				return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
					start: function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						
						if(d.status != 1){
							d.clickBgClose = true;
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "错误：";	
							window.top._GESHAI.dialog(d);
						} else {
							window.top._GESHAI.dialog.close();
							var _o = $("#projectexp_data_" + _projectexpid);
							_o.animate({"height": "0px" }, 500, "", 
								function (){
									_o.remove();
									$("#projectexp_add_btn").show();
								});
						}
					}
				});
			}else{
				window.top._GESHAI.dialog.close();
				$("#projectexp_write_wrap").html("").hide();
				$("#projectexp_add_btn").show();
			}
		}
	});
	return false;
};
function resumeDo_projectexpForm(_id){
	var _form = document.getElementById("s_projectexp_form");
		$(_form).append('<input type="hidden" name="projectexpid" value="' + _id + '" />');
		
	_GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#projectexp_add_btn").hide();
					if(_id < 1) {
						$("#projectexp_write_wrap").html(d.data).show();
					} else {
						$("#projectexp_write_wrap").html("").hide();
						$("#projectexp_data_" + _id).html(d.data);
					}
					resume_placeholder();
				}
			}
		});
	return false;
};

/********************************************************/
/* workexp */
function resumeDo_workexpSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#workexp_write_wrap").html("").hide();
					$("#workexp_add_btn").show();
						
					if(d.dotype == 'add') {
						$("#workexp_data").append("<div class=\"clearfix\" style=\"display:none;\" id=\"workexp_data_" + d.workexpid + "\">");
						$("#workexp_data_" + d.workexpid).html(d.data).animate({"height": "show" }, 500);
					} else {
						$("#workexp_data_" + d.workexpid).html(d.data);
					}
				}
				
			}
		});
};
function resumeDo_workexpDel(_workexpid) {
	var _form = document.getElementById("workexp_del");
		_form.workexpid.value = _workexpid;
	
	resume_sHtml(_form);
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			if(_workexpid >= 1) {
				return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
					start: function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						
						if(d.status != 1){
							d.clickBgClose = true;
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "错误：";	
							window.top._GESHAI.dialog(d);
						} else {
							window.top._GESHAI.dialog.close();
							var _o = $("#workexp_data_" + _workexpid);
							_o.animate({"height": "0px" }, 500, "", 
								function (){
									_o.remove();
									$("#workexp_add_btn").show();
								});
						}
					}
				});
			}else{
				window.top._GESHAI.dialog.close();
				$("#workexp_write_wrap").html("").hide();
				$("#workexp_add_btn").show();
			}
		}
	});
	return false;
};
function resumeDo_workexpForm(_id){
	var _form = document.getElementById("s_workexp_form");
		$(_form).append('<input type="hidden" name="workexpid" value="' + _id + '" />');
		
	_GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#workexp_add_btn").hide();
					if(_id < 1) {
						$("#workexp_write_wrap").html(d.data).show();
					} else {
						$("#workexp_write_wrap").html("").hide();
						$("#workexp_data_" + _id).html(d.data);
					}
					resume_placeholder();
				}
			}
		});
	return false;
};

/********************************************************/
/* attach */
function resumeDo_attachSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#attach_write_wrap").html("").hide();
					$("#attach_add_btn").show();
						
					if(d.dotype == 'add') {
						$("#attach_data").append("<div class=\"clearfix\" style=\"display:none;\" id=\"attach_data_" + d.attachid + "\">");
						$("#attach_data_" + d.attachid).html(d.data).animate({"height": "show" }, 500);
					} else {
						$("#attach_data_" + d.attachid).html(d.data);
					}
				}
				
			}
		});
};
function resumeDo_attachDel(_attachid) {
	var _form = document.getElementById("attach_del");
		_form.attachid.value = _attachid;
	
	resume_sHtml(_form);
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			if(_attachid >= 1) {
				return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
					start: function(){
						_GESHAI.disbtn("", true);
						window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						
						if(d.status != 1){
							d.clickBgClose = true;
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "错误：";	
							window.top._GESHAI.dialog(d);
						} else {
							window.top._GESHAI.dialog.close();
							var _o = $("#attach_data_" + _attachid);
							_o.animate({"height": "0px" }, 500, "", 
								function (){
									_o.remove();
									$("#attach_add_btn").show();
								});
						}
					}
				});
			}else{
				window.top._GESHAI.dialog.close();
				$("#attach_write_wrap").html("").hide();
				$("#attach_add_btn").show();
			}
		}
	});
	return false;
};
function resumeDo_attachForm(_id){
	var _form = document.getElementById("s_attach_form");
		$(_form).append('<input type="hidden" name="attachid" value="' + _id + '" />');
		
	_GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
					
					$("#attach_add_btn").hide();
					if(_id < 1) {
						$("#attach_write_wrap").html(d.data).show();
					} else {
						$("#attach_write_wrap").html("").hide();
						$("#attach_data_" + _id).html(d.data);
					}
					resume_placeholder();
				}
			}
		});
	return false;
};
function resumeDo_attachFileDel(_attachid) {
	var _form = document.getElementById("attach_file_del");
		_form.attachid.value = _attachid;
		
	window.top._GESHAI.dialog({
		title: "删除提示：",
		data: "<p>你确定要删除该附件文件吗？<p>如果要删除请点击“确定”，则点击“取消”按钮</p>",
		isCloseBtn: false,
		isCancelBtn: true,
		okBtnFunc: function(){
			return _GESHAI.fsubmit(_form, _form.getAttribute("_act"), {
				start: function(){
					_GESHAI.disbtn("", true);
					window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
				},
				success: function(d){
					_GESHAI.disbtn("", false);
					
					if(d.status != 1){
						d.clickBgClose = true;
						d.isCloseBtn = false;
						d.clickBgClose = true;
						d.title = "错误：";	
						window.top._GESHAI.dialog(d);
					} else {
						window.top._GESHAI.dialog.close();
						$("#attach_file_" + _attachid).remove();
					}
				}
			});
		}
	});
	return false;
};

/* relate */
function resumeDo_relateSave(_this, _url) {
	resume_sHtml(_this.form);
	
	return _GESHAI.fsubmit(_this, _url, {
			start: function(){
				_GESHAI.disbtn("", true);
				window.top._GESHAI.dialog({bgOpacity: 0.001, isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
			},
			success: function(d){
				_GESHAI.disbtn("", false);
				
				if(d.status != 1){
					d.clickBgClose = true;
					d.isCloseBtn = false;
					d.clickBgClose = true;
					d.title = "错误：";
					window.top._GESHAI.dialog(d);
				} else {
					window.top._GESHAI.dialog.close();
				}
			}
		});
};