/*!
 * date 2015.3
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */

function cUserJobWrite(_this, _url, _goUrl){
	return _GESHAI.fsubmit(_this, _url, {
		"goback": _goUrl,
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

function cUserJobDelete(_this, _url){
	var _thisForm = document.getElementById("form-job-post");
		_thisForm.jobid.value = _this.getAttribute("data-id");
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。<p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_thisForm, _url, {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_thisForm.id.value = "";
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
		});
};


/* 技能 */
function cUserSKillWrite(_this, _url, _goUrl){
	return _GESHAI.fsubmit(_this, _url, {
		"goback": _goUrl,
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

function cUserSKillDelete(_this, _url){
	var _thisForm = document.getElementById("form-skill-post");
		_thisForm.skillid.value = _this.getAttribute("data-id");
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。<p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_thisForm, _url, {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_thisForm.id.value = "";
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
		});
};

/* examsubject */
function cUserExamSubjectWrite(_this, _url, _goUrl){
	if(window._GESHAI.cchecked("answer_flag[]").length < 1){
		window._GESHAI.dialog({title: "错误：", clickBgClose: true, isCloseBtn: false, data: "请至少勾选一项，作为题目的正确答案。"});
		return false;
	};
	return _GESHAI.fsubmit(_this, _url, {
		"goback": _goUrl,
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