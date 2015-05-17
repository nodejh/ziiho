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
	for(var i = 0; i < _datas.length; i++){
		if(_datas[i].parentid < 1){
			_dbox.append("<div class=\"sas clearfix\" dataid=\"" + _datas[i].id + "\"><p class=\"sparent\">" + _datas[i].sname + "</p></div>");
		}
	}
	var _di = _dbox.find(".sas");
	_di.each(function(index, element) {
        var _dataid = $(this).attr("dataid");
		for(var i = 0; i < _datas.length; i++){
			if(_datas[i].parentid == _dataid){
				$(this).append("<p class=\"sitem sitem-tt\" flag=\"sort-item\" sort-id=\"" + _datas[i].id + "\"><a href=\"javascript:;\">" + _datas[i].sname + "</a></p>");

			}
		}
    });
	
	var _sbox = $("#sort-data-selected");
	_di.find("p[flag=\"sort-item\"]").click(function(e) {
        _appendSelected(this);
    });
	
	var _appendSelected = function(_thi){
		var _sortid = $(_thi).attr("sort-id");
		var _light = $(_thi).find("a");
		if(_sbox.find("p[sort-id=\""+ _sortid +"\"]").length < 1){
			_sbox.append("<p class=\"sas sitem\" sort-id=\"" + _sortid + "\" onclick=\"cRegister_sort_selected(this, " + _sortid + ");\"><input type=\"hidden\" name=\"csortid[]\" value=\""+_sortid+"\" /><a href=\"javascript:;\">" + $(_thi).text() + "&nbsp;<em class=\"error\">×</em></a></p>");
			_light.addClass("on");
		}else{
			_sbox.find("p[sort-id=\"" + _sortid + "\"]").remove();
			_light.removeClass("on");
		}
	};
	
	/* 已选择了的 */
	if(!_GESHAI.is_empty(_eqValue)){
		_eqValue = _eqValue.split(",");
		for(var _i in _eqValue){
			_appendSelected(_di.find("p[sort-id=\"" + _eqValue[_i] + "\"]"));
		}
	}
};
function cRegister_sort_selected(_this, _id){
	var _io = $("#sort-data-box").find(".sas").find("p[sort-id=\"" + _id + "\"]");
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

function cUserProfileUpdate(_this, _url){
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			
			d.isCloseBtn = false;
			d.clickBgClose = true;
			if(d.status != 1){
				d.title = "错误原因：";
			}else if(d.status == 1){
				
			}
			window.top._GESHAI.dialog(d);
		}
	});
};

function cUserProfileDel(_this, _url){
	var _form = document.getElementById("form-cuser-upload01");
	var _flag = $(_this).attr("delete-flag");
	_form.filetype.value = _flag;
	return _GESHAI.fsubmit(_form, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			
			d.isCloseBtn = false;
			d.clickBgClose = true;
			if(d.status != 1){
				d.title = "错误原因：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				if(_flag == 'logo'){
					$("#logo-area-status").html("×未上传");
					$("#logo-area-upload").show();
					$("#logo-area-view").hide().html("");
				}else{
					$("#licence-area-status").html("×未上传");
					$("#licence-area-upload").show();
					$("#licence-area-view").hide().html("");
				}
			}
		}
	});
};

function cUserProfileUpload(_this, _url){
	_this.form.filetype.value = _this.name;
	_this.form[_this.name + "_local_name"].value = _this.value;
	
	
	return _GESHAI.fsubmit(_this.form, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			
			var _nTypeStr = '';
			if(_this.name == 'logo'){
				_nTypeStr = '上传“logo”文件';
			}else if(_this.name == 'licence'){
				_nTypeStr = '上传“营业执照”文件';
			}
			
			/* 清空值 */
			_this.form.filetype.value = "";
			_this.form[_this.name + "_local_name"].value = "";
			
			if(_this.name == 'logo'){
				$("#logo-area-upload").find("span[flag=\"file\"]").html("<input type=\"file\" class=\"z f-file\" name=\"logo\" onchange=\"_cUserProfileUpload(this);\" />");
			}else{
				$("#licence-area-upload").find("span[flag=\"file\"]").html("<input type=\"file\" class=\"z f-file\" name=\"licence\" onchange=\"_cUserProfileUpload(this);\" />");
			}
			
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = _nTypeStr + "错误原因：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				if(_this.name == 'logo'){
					$("#logo-area-status").html("<a href=\"javascript:;\" delete-flag=\"logo\" onclick=\"_cUserProfileDel(this);\">重新上传</a>");
					$("#logo-area-upload").hide();
					$("#logo-area-view").show().html("<img src=\"" + (_GESHAI.dir("uploadfile") + "/" + d.filename) + "\" width=\"100\"/>");
				}else{
					$("#licence-area-status").html("<a href=\"javascript:;\" delete-flag=\"licence\" onclick=\"_cUserProfileDel(this);\">重新上传</a>");
					$("#licence-area-upload").hide();
					$("#licence-area-view").show().html("<img src=\"" + (_GESHAI.dir("uploadfile") + "/" + d.filename) + "\" width=\"100\"/>");
				}
			}
		}
	});
};