/**
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 *
 */
function logout(){
	_GESHAI.dialog({
			title: "温馨提示",
			data: "<p>您确定要退出吗？</p><p>如果退出请点击“确定”，则点击“取消”按钮</p>",
			isCloseBtn: false,
			isCancelBtn: true,
			okBtnFunc: function(){
				var _form = document.getElementById("form_logout");
				return _GESHAI.fsubmit(_form, _form.getAttribute("_acturl"), {
					start: function(){
						_GESHAI.disbtn("", true);
						_GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						_GESHAI.redirect(d);
					}
				});
			}
		});
};


/* 锁屏 */
function lockscreenInput(__dis){
	var _sw = _GESHAI.clientsize("clientWidth");
	var _sh = _GESHAI.clientsize("clientHeight");
	var _lcObj = $("#lockscreen_box");
		_lcObj.width(_sw).height(_sh);
	if (arguments.length >= 1) {
		_lcObj.css("display", __dis);
	}
};
function lockscreenWindow(){
	_GESHAI.dialog({
			title: "温馨提示",
			data: "<p>确定要锁屏吗？</p><p>锁屏后，输入登录密码进行解锁。</p><p>如果锁屏请点击“确定”，则点击“取消”按钮</p>",
			isCloseBtn: false,
			isCancelBtn: true,
			okBtnFunc: function(){
				var _form = document.getElementById("form_lockscreen");
				return _GESHAI.fsubmit(_form, _form.getAttribute("_acturl"), {
					start: function(){
						_GESHAI.disbtn("", true);
						_GESHAI.dialog({isHeader: false, isFooter: false, data: "创建锁屏中..."});
					},
					success: function(d){
						_GESHAI.disbtn("", false);
						if(d.status != 1){
							d.isCloseBtn = false;
							d.clickBgClose = true;
							_GESHAI.dialog(d);
						}else{
							_GESHAI.dialog.close();
							lockscreenInput("block");
						}
					}
				});
			}
		});
};
function lockscreenDe(){
	var _form = document.getElementById("form_lockscreen_de");
	return _GESHAI.fsubmit(_form, _form.getAttribute("_acturl"), {
		start: function(){
			_GESHAI.disbtn("", true);
			_GESHAI.dialog({isHeader: false, isFooter: false, data: "屏幕解锁中..."});
		},
		success: function(d){
			_GESHAI.disbtn("", false);
			/* clear password */
			_form.password.setAttribute("value", "");
			
			if(d.status != 1){
				d.title = "错误：";
				d.isCloseBtn = false;
				d.clickBgClose = true;
				_GESHAI.dialog(d);
			}else{
				_GESHAI.dialog.close();
				lockscreenInput("none");
			}
		}
	});
};

function greetingMessage(__obj){
	var d = new Date();
	var h = d.getHours(); 
	var m = d.getMinutes(); 
	var s = d.getSeconds();
	var vStr = '';
	h = h < 10 ? '0' + ''+ h : h;
	m = m < 10 ? '0' + '' + m : m;
	s = s < 10 ? '0' + '' + s : s;
	if(h>=0 && h<6){
		vStr = '凌晨';
	}else if(h>=6 && h<9){
		vStr = '早上';
	}else if(h>=9 && h<12){
		vStr = '上午';
	}else if(h>=12 && h<14){
		vStr = '中午';
	}else if(h>=14 && h<18){
		vStr = '下午';
	}else if(h>=18 && h<21){
		vStr = '晚上';
	}else{
		vStr = '深夜';
	}
	__obj.innerHTML = vStr;
	setTimeout(function(){
		greetingMessage(__obj);
	}, 600 * 1000);
};

function urlRedirect(v){
	window.location.href = v;
};