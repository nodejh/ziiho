// JavaScript Document
/*
	这个方法作用： 就是选择完图片后关闭时执行。
	参数：numFilesQueued 就是先择图片的数量
*/
function article_fileDialogComplete(numFilesSelected, numFilesQueued){
	if(numFilesQueued>0){
		try{
			setHtmlData("#upload_msg",'');
			this.addPostParam("aid",aid_val());	
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
function article_uploadSuccess(file,serverData){
	var ob={'file':file,'div_id':'#pro_','data_id':'#list_','div_do':'#do_'};
	setAjaxActionData(serverData,ob);
}
/*
	作用：主要是进度条
	参数：(file object, bytes complete, total bytes)
     bytes 上传字节数 ，total 总字节数
*/
function article_uploadProgress(file, bytesLoaded,total ){
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
function article_uploadComplete(file){
	if(this.getStats().files_queued > 0){
		this.startUpload();
	}
}
/*
	作用： 把所选的图片入列。
	参数： file Object.
*/
function article_fileQueued(file){
	var fileSize=Math.floor(file.size/1024)+"kb";
	
	var html_str='<li id="list_'+file.id+'">';
	html_str+='<p class="a_upload_wait_title">'+file.name+'</p>';
	html_str+='<p class="a_upload_wait_size">'+fileSize+'</p>';
	html_str+='<p class="a_upload_wait_pro" id="pro_'+file.id+'">等待上传</p>';
	html_str+='<p class="a_upload_wait_do" id="do_'+file.id+'"><a href="javascript:;" onclick="article_pic_del(\''+file.id+'\')">删除</a></p>';
	
	html_str+='<div class="clr"></div>';
	html_str+='</li>';
	$("#a_upload_wait_list").append(html_str);
}
/*
function article_fileQueued(file){
	var fileSize=Math.floor(file.size/1024)+"kb";
	var file_name=(file.name.length>22)?file.name.substring(0,22)+'...':file.name;
}
*/
/*清除队列文件*/
function article_pic_del(file_id){
	swfu.cancelUpload(file_id);
	$("#list_"+file_id).remove();
}
/*获取图片列表个数*/
function article_upload_pic_num(){
	var len=$("#a_upload_lists li").length;
	return parseInt(len);
}
/*获取主题aid*/
function aid_val(){
	var aid=parent.$("input[name='aid']").attr("value");
	return parseInt(aid);
}
/*按钮提交*/
function article_sbpost(swfu){
	swfu.addPostParam("aid",11);	
	swfu.startUpload();
}
/*上传初始化*/
function article_uploadpic(do_url,ac_uid,uf_size,uf_type){
	swfu=new SWFUpload({
		upload_url:do_url,
		flash_url:_CJG.staticpath+'image/swfupload.swf',
		file_post_name:"ap_file",
		file_size_limit:uf_size,
		file_upload_limit:0,
		file_queue_limit:10,
		file_types:uf_type,
		post_params:{"ac_uid":ac_uid,'callFunc':'article_adm_picture_upload_error','callFunc_b':'article_adm_picture_upload_succeed','isajax':1},
		/* 按钮的设置 */
		button_action:"-110",
		button_image_url:"", // Relative to the Flash file
		button_text:"",
		button_text_style:"",
		button_placeholder_id :"a_upload_bt",
		button_width:120,
		button_height:24,
		button_text_top_padding:0,
		button_text_left_padding:0,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,			
		/* 选择完图片后执行 */
		file_dialog_complete_handler:article_fileDialogComplete,
		/* 上传成功后执行 */
		upload_success_handler:article_uploadSuccess,
		/* 主要是进度条 */
		upload_progress_handler:article_uploadProgress,
		/* 循环队列里的图片上传 */
		upload_complete_handler: article_uploadComplete,
		/* 主要是把图片加入队列 */
		file_queued_handler:article_fileQueued,
		//清除队列文件			
		debug: false
	});
	return swfu;
}