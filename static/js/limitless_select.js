// JavaScript Document
function limitless_select(arr,arg_doc_id,arg_self){
	/* data 数组 */
	var classArrData = arr;
	var rand_id=(Math.ceil(Math.random()*100));
	/* 追加到HTML里的ID */
	var classHtmlID = arg_doc_id;
	/* values */
	var classValuesName = 'value_name_'+rand_id;
	/* 编辑时取目录ID */
	var classDirID = new Array();
	/* select name prefix */
	var classPrefix = 's_'+rand_id+'_';
	/* 最大级数 */
	var classMaxDir = 10;
	/* 目录ID所在级数 */
	var classDirNum = 0;
	/* data length */
	var classArrDataLength = classArrData.length;
	
	this.value_name_id=classValuesName;
	
	/*对象id*/
	this.obj_id=function(id) {
		return document.getElementById(id);
	}
	/* create values input */
	this.createValuesInput=function(){
		var objValues = document.createElement('input');
		/*此为隐藏文本域*/
		objValues.type = 'hidden';
		objValues.id = objValues.name = classValuesName;
		window.attachEvent?objValues.Name=classValuesName:objValues.name=classValuesName;
		this.obj_id(classHtmlID).appendChild(objValues);
	}
	/* 查找下级目录 */
	this.classSearchDir=function(dirID) {
		var newArr = new Array();
		var key = 0;
		for(var i=0; i<classArrDataLength; i++) {
			if(classArrData[i][1]==dirID) {
				newArr[key] = classArrData[i];
				key++;
			}
		}
		return newArr;
	}
	/* 递归取目录数据 */
	this.recursionDir=function(dirID, key) {
		var key = key==undefined?0:key;
		for(var i=0; i<classArrDataLength; i++) {
			if(classArrData[i][0]==dirID) {
				classDirID[key] = new Array();
				classDirID[key][0] = classArrData[i];
				classDirID[key][1] = this.classSearchDir(classArrData[i][1]);
				key++;
				this.recursionDir(classArrData[i][1], key);
			}
		}
	}
	/* get values */
	this.classGetValues=function(){
		var values = '';
		for(var i=1; i<classMaxDir; i++) {
			if(this.obj_id(classPrefix+i)!=null && this.obj_id(classPrefix+i).value!='') {
				values += this.obj_id(classPrefix+i).value+',';
			}
		}
		this.obj_id(classValuesName).value = values.substr(0, values.length-1);
	}
	/* edit Select */
	this.editSelect=function(dirID){
		/* 创建值文本框 */
		if(this.obj_id(classValuesName)==null){
			this.createValuesInput();
		}
		/* edit data */
		this.recursionDir(dirID);
		/* select name */
		var selectName = 0;
		/* dir length */
		var selectLen = classDirID.length-1;
		/* add options */
		for(var i=selectLen; i>=0; i--){
			selectName++;
			var objSelect = document.createElement('select');
			objSelect.id = classPrefix+selectName;
			objSelect.name=objSelect.id;
			//window.attachEvent?objSelect.Name=classPrefix+classDirNum:objSelect.name=classPrefix+classDirNum;
			
			objSelect.onchange = function(){
				_createSelect(arg_self,this);
			}
			/* select length */
			var childLen = classDirID[i][1].length;
			objSelect.options.add(new Option('==请选择==', ''));
			
			for(var s=0; s<childLen; s++){
				objSelect.options.add(new Option(classDirID[i][1][s][2], classDirID[i][1][s][0]));
				if(classDirID[i][0][0]==classDirID[i][1][s][0]){
					objSelect.options[s+1].selected = true;
				}
			}
			/* append html */
			this.obj_id(classHtmlID).appendChild(objSelect);
		}
		this.classGetValues();
	}
	/* currently dir */
	this.currentlyDir=function(dirID){
		for(var i=0; i<classArrDataLength; i++) {
		   if(classArrData[i][0]==dirID) {
			classDirNum++;
			this.currentlyDir(classArrData[i][1]);
		   }
		}
	}
	/* createSelect */
	this.createSelect=function(obj){
		/*创建值文本框*/
		if(this.obj_id(classValuesName)==null){
			this.createValuesInput();
		}
		if(isNaN(obj)) {
			var dirID = obj.value;
			if(obj.value=='') { /* is null */
				var len = parseInt(obj.id.substr(classPrefix.length))+1;
				for(var d=len; d<classMaxDir; d++) {
					if(this.obj_id(classPrefix+d)==null) continue;
						var elementID = this.obj_id(classPrefix+d);
						elementID.parentNode.removeChild(this.obj_id(classPrefix+d));
					}
					this.classGetValues();
					return false;
				}
			}else{
				var dirID = obj;
			}
		/*初始化目录*/
		classDirNum = 1;
		this.currentlyDir(dirID);
		/* removeChild */
		for(var r=classDirNum; r<classMaxDir; r++) {
			if(this.obj_id(classPrefix+r)==null){
				continue;
			}
			var elementID = this.obj_id(classPrefix+r);
			elementID.parentNode.removeChild(this.obj_id(classPrefix+r));
		}
		var dirArr = this.classSearchDir(dirID);
		var dirArrLen = dirArr.length;
		if(dirArrLen <= 0) {
			this.classGetValues(); return ;
		}
		var objSelect = document.createElement('select');
		objSelect.id = classPrefix+classDirNum;
		objSelect.name=objSelect.id;
		//window.attachEvent?objSelect.Name=classPrefix+classDirNum:objSelect.name=classPrefix+classDirNum;
		
		objSelect.onchange = function () {
			_createSelect(arg_self,this);
		}
		
		objSelect.options.add(new Option('==请选择==', ''));
		
		for(var i=0; i<dirArrLen; i++) {
			objSelect.options.add(new Option(dirArr[i][2], dirArr[i][0]));
		}
		this.obj_id(classHtmlID).appendChild(objSelect);
		this.classGetValues();
		/*alert(document.getElementById(classHtmlID).innerHTML);*/
	}
}
function _createSelect(arg_self,o){
	eval(arg_self).createSelect(o);
}
/*选择器提示信息*/
function _selectmsg(_select,ids){
	var s_str=member_area_smsg(ids);
	if(typeof(s_str)!='object'){
		_select.options.add(new Option('请选择','qxz'));
	}else{
		_select.options.add(new Option(s_str[1],s_str[0]));
	}
}
/* 创建, 传入分类起点ID,默认为0,为根类 */
//createSelect(3);
/* 编辑, 传入最终分类ID */
//editSelect(3);
//追加到下级
//createSelect(3);