// JavaScript Document
/*
	这个方法作用： 就是选择完图片后关闭时执行。
	参数：numFilesQueued 就是先择图片的数量
*/
function common_adm_emotional_fileDialogComplete(numFilesSelected, numFilesQueued){
	if(numFilesQueued>0){
		try{
			var emotgroupid=selectval('emotgroupid');
			if(check_nums(emotgroupid)<1){
				$("#upload_list").html("");
				mydialog({'data':'分组类型参数错误或已丢失'});
				return false;
			}
			this.addPostParam("emotgroupid",emotgroupid);
			this.startUpload();
		}
		catch(ex){
			this.debug(ex);
		}
	}
}
/*
	这个方法作用： 就是上传成功后执行,这里上传成功不是说真的把图片上传成功了，只是把数据提交到服务器成功了。
	参数：(file object, server data)
*/
function common_adm_emotional_uploadSuccess(file,serverData){
	var ob={'file':file,'data_id':'#list_','div_id':'#pro_','div_do':"#do_"};
	setAjaxActionData(serverData,ob);
}
/*
	作用：主要是进度条
	参数：(file object, bytes complete, total bytes)
     bytes 上传字节数 ，total 总字节数
*/
function common_adm_emotional_uploadProgress(file, bytesLoaded,total ){
	var c=Math.floor((bytesLoaded/total)*100);
	if($("#do_"+file.id+" a").length==1){
		$("#do_"+file.id).html('删除');
	}
	if(c<100){
		$("#pro_"+file.id).html('已上传'+c+'%');
	}else{
		$("#pro_"+file.id).html('上传完成，等待回应');
	}
}
/*
	作用：就是循环上传队列的图片
	参数：file Object
*/
function common_adm_emotional_uploadComplete(file){
	if(this.getStats().files_queued > 0){
		this.startUpload();
	}
}
/*
	作用： 把所选的图片入列。
	参数： file Object.
*/
function common_adm_emotional_fileQueued(file){
	var fileSize=Math.floor(file.size/1024)+"kb";
	var html_str='<li id="list_'+file.id+'">';
	html_str+='<p class="multipleupload_wait_title">'+file.name+'</p>';
	html_str+='<p class="multipleupload_wait_size">'+fileSize+'</p>';
	html_str+='<p class="multipleupload_wait_pro" id="pro_'+file.id+'">等待上传</p>';
	html_str+='<p class="multipleupload_wait_do" id="do_'+file.id+'"><a href="javascript:;" onclick="common_adm_emotional_upload_del(\''+file.id+'\')">删除</a></p>';
	
	html_str+='<div class="clr"></div>';
	html_str+='</li>';
	$("#upload_list").append(html_str);
}
/*
function common_adm_emotional_fileQueued(file){
	var fileSize=Math.floor(file.size/1024)+"kb";
	var file_name=(file.name.length>22)?file.name.substring(0,22)+'...':file.name;
}
*/
/*清除队列文件*/
function common_adm_emotional_upload_del(file_id){
	swfu.cancelUpload(file_id);
	$("#list_"+file_id).remove();
}
/*获取图片列表个数*/
function common_adm_emotional_upload_num(){
	var len=$("#upload_list li").length;
	return parseInt(len);
}
/*返回上传异常提示信息*/
function common_adm_emotional_uploadfail(data,ob){
	if(isVal(data.data)){
		$(ob.div_id+ob.file.id).html(data.data);
	}else{
		$(ob.div_id+ob.file.id).html('');
	}
	$(ob.div_do+ob.file.id).html('<a href="javascript:;" onclick="common_adm_emotional_upload_del(\''+ob.file.id+'\')">删除</a>');
}
/*返回上传成功信息*/
function common_adm_emotional_uploadmsg(data,ob){
	var t=null;
	clearTimeout(t);
	/*上传成功处理*/
	swfu.cancelUpload(ob.file.id);
	$(ob.div_id+ob.file.id).html(data.data);
	$(ob.data_id+ob.file.id).fadeOut(1000);
	t=setTimeout(function(){$(ob.data_id+ob.file.id).remove();},1000);
}
/*上传初始化*/
function common_adm_emotional_upload(do_url,uf_size,uf_type,ac_uid){
	swfu=new SWFUpload({
		upload_url:do_url,
		flash_url:_CJG.staticpath+'image/swfupload.swf',
		file_post_name:"filearr",
		file_size_limit:uf_size,
		file_upload_limit:0,
		file_queue_limit:10,
		file_types:uf_type,
		post_params:{'isajax':1,"ac_uid":ac_uid,'callFunc':'common_adm_emotional_uploadfail','callFunc_b':'common_adm_emotional_uploadmsg'},
		/* 按钮的设置 */
		button_action:"-110",//-100
		button_image_url:"", // Relative to the Flash file
		button_text:"",
		button_text_style:"",
		button_placeholder_id :"upload_bt",
		button_width:120,
		button_height:24,
		button_text_top_padding:0,
		button_text_left_padding:0,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,			
		/* 选择完图片后执行 */
		file_dialog_complete_handler:common_adm_emotional_fileDialogComplete,
		/* 上传成功后执行 */
		upload_success_handler:common_adm_emotional_uploadSuccess,
		/* 主要是进度条 */
		upload_progress_handler:common_adm_emotional_uploadProgress,
		/* 循环队列里的图片上传 */
		upload_complete_handler: common_adm_emotional_uploadComplete,
		/* 主要是把图片加入队列 */
		file_queued_handler:common_adm_emotional_fileQueued,
		//清除队列文件			
		debug: false
	});
	return swfu;
}