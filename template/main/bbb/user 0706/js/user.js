/*!
 * date 2015.3
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */

function register_email(_this, _url){
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

function emailAuthSend(_url){
	return _GESHAI.fsubmit(document.getElementById("form-emailAuthSend"), _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			if(d.status != 1){
				d.clickBgClose = true;
				d.title = "错误：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog(d);
			}
		}
	});
};

function forgetEmailSend(_this, _url){
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			if(d.status != 1){
				d.clickBgClose = true;
				d.title = "错误：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog(d);
			}
		}
	});
};

function forgetUpdatePassword(_this, _url, _toUrl){
	return _GESHAI.fsubmit(_this, _url, {
		"goback": _toUrl,
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			if(d.status != 1){
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

function userLogin(_this, _urlA, _urlB){
	var _url = (_this.form.flag.value == '1' ? _urlA : _urlB);
	return _GESHAI.fsubmit(_this, _url, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			if(d.status != 1){
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


/* user avatar */
function userUploadAvatar(_actUrl){
	var __form = document.getElementById("form_avatar");
	return _GESHAI.fsubmit(__form, _actUrl, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			
			if(d.status != 1){
				d.clickBgClose = true;
				d.title = "错误：";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				avatarCropInit(d);
			}
			
			/* reset */
			avatarSelectHtml();
		}
	});
};
function userAvatarSave(_actUrl){
	var __form = document.getElementById("form_avatar");
	return _GESHAI.fsubmit(__form, _actUrl, {
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			d.isCloseBtn = false;
			
			avatarSelectHtml();
			
			if(d.status != 1){
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