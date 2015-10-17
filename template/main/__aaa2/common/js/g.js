/*!
 * date 2015.7
 * Copyright 2010-2015, Jolly,Cloud,Bonejay
 */

function getSortValue(id, k){
	var l = arguments.length;
	var flag = false;
	var d = "";
	if(!_GESHAI.is_empty(id)){
		for(var i = 0; i < _CACHE_job_sort.length; i++){
			if(_CACHE_job_sort[i].id == id){
				flag = true;
				d = _CACHE_job_sort[i];
			}
		}
	}
	if(l < 2) { 
		return (!flag ? {} : d);
	} else {
		return (!flag ? "" : _GESHAI.array_value(k, d));
	}
};
function deMutiSortValue(ids){
	var v = [];
	if(_GESHAI.is_empty(ids)){
		return v;
	}
	var d = ids.match(/\d+/g);
	for(var i = 0; i < d.length; i++) {
		v.push(getSortValue(d[i]));
	}
	return v;
};
function selectSortsHtml(_o){
	var _defValue = _o.attr("def");
	if(!_GESHAI.is_empty(_defValue)){
		_defValue = _defValue.match(/\d+/g);
	}
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
function s2pnsplitDe(v){
	var d = [];
	if(_GESHAI.is_empty(v)){
		return d;
	}
	if(_GESHAI.is_array(v)){
		return v;
	}
	d = v.match(/\d+/g);
	return d;
};