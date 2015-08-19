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
}