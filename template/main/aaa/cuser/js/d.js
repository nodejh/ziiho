/*!
 * date 2015.3
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */
function cUserExamrecordHide(_this){
	var _form = document.getElementById("form-exam101");
		_form.recordid.value = _this.getAttribute("_id");
		window.top._GESHAI.dialog({
				title: "隐藏信息",
				data: "<p>隐藏该信息后，不会再显示<p>如果隐藏请点击“确定”，则点击“取消”按钮</p>",
				isCloseBtn: false,
				isCancelBtn: true,
				okBtnFunc: function(){
					return _GESHAI.fsubmit(_form, _form.hideurl.value, {
						start: function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						success: function(d){
							_GESHAI.disbtn("", false);
							
							_form.recordid.value = "";
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "隐藏信息";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								window.top._GESHAI.redirect(d);
							}
						}
					});
				}
		});
	return false;
};
function cUserJobRecordDel(_this){
	var _form = document.getElementById("form101");
		_form.delid.value = _this.getAttribute("_id");
		window.top._GESHAI.dialog({
				title: "删除操作",
				data: "<p>若删除选项，将不可恢复。<p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				isCloseBtn: false,
				isCancelBtn: true,
				okBtnFunc: function(){
					return _GESHAI.fsubmit(_form, _form.delurl.value, {
						start: function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						success: function(d){
							_GESHAI.disbtn("", false);
							
							_form.delid.value = "";
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								window.top._GESHAI.redirect(d);
							}
						}
					});
				}
		});
	return false;
};
