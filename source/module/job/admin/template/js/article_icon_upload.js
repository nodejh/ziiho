// JavaScript Document
/*
	这个方法作用： 就是选择完图片后关闭时执行。
	参数：numFilesQueued 就是先择图片的数量
*/
function article_icon_fileDialogComplete(numFilesSelected, numFilesQueued){
	if(numFilesQueued>0){
		try{
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
function article_icon_uploadSuccess(file,serverData){
	var ob={'file':file,'div_id':'#uploadmsg','data_id':'#icon_'};
	setAjaxActionData(serverData,ob);
}
/*
	作用：主要是进度条
	参数：article_icon_uploadProgress(file object, bytes complete, total bytes)
     bytes 上传字节数 ，total 总字节数
*/
function article_icon_uploadProgress(file, bytesLoaded,total ){
	var c=Math.floor((bytesLoaded/total)*100);
	if(c<100){
		$("#uploadmsg").html('已上传'+c+'%');
	}else{
		$("#uploadmsg").html('上传完成，等待回应');
	}
}
/*
	作用：就是循环上传队列的图片
	参数：file Object
*/
function article_icon_uploadComplete(file){
	if(this.getStats().files_queued > 0){
		this.startUpload();
	}
}
/*
	作用： 把所选的图片入列。
	参数： file Object.
*/
function article_icon_fileQueued(file){
	var fileSize=Math.floor(file.size/1024)+"kb";
	var file_name=(file.name.length>22)?file.name.substring(0,22)+'...':file.name;
}
/*清除队列文件*/
function article_icon_del_file(file){
	swfu.cancelUpload(file.id);
}
//按钮提交
function article_icon_post_set(swfu){
	swfu.addPostParam("pid",11);	
	swfu.startUpload();
}
/*上传初始化*/
function article_icon_upload_init(do_url,uf_size,uf_type,ac_uid,iconid){
	swfu=new SWFUpload({
		upload_url:do_url,
		flash_url:_CJG.staticpath+'image/swfupload.swf',
		file_post_name:"iconfile",
		file_size_limit:uf_size,
		file_upload_limit:0,
		file_queue_limit:1,
		file_types:uf_type,
		post_params:{"ac_uid":ac_uid,"iconid":iconid,'callFunc':'article_icon_uploadfail','callFunc_b':'article_icon_uploadmsg','isajax':1},
		/* 按钮的设置 */
		button_action:"-100",
		button_image_url:"", // Relative to the Flash file
		button_text:"",
		button_text_style:"",
		button_placeholder_id :"iconselect",
		button_width:120,
		button_height:24,
		button_text_top_padding:0,
		button_text_left_padding:0,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,			
		/* 选择完图片后执行 */
		file_dialog_complete_handler:article_icon_fileDialogComplete,
		/* 上传成功后执行 */
		upload_success_handler:article_icon_uploadSuccess,
		/* 主要是进度条 */
		upload_progress_handler:article_icon_uploadProgress,
		/* 循环队列里的图片上传 */
		upload_complete_handler: article_icon_uploadComplete,
		/* 主要是把图片加入队列 */
		file_queued_handler:article_icon_fileQueued,
		//清除队列文件			
		debug: false
	});
	return swfu;
}
/*返回失败提示信息*/
function article_icon_uploadfail(data,ob){
	$(ob.div_id).html(data.data);
	swfu.cancelUpload(ob.file.id);
}
/*返回成功提示信息*/
function article_icon_uploadmsg(data,ob){
	$(ob.div_id).html(data.data);
	swfu.cancelUpload(ob.file.id);
	/*显示图标*/
	$(ob.data_id+data.iconid,parent.document).html('<img src=\"'+data.filename+'\"/>');
	parent.dialogClose();
}