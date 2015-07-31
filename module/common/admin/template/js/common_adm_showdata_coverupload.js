// JavaScript Document
/*
	这个方法作用： 就是选择完图片后关闭时执行。
	参数：numFilesQueued 就是先择图片的数量
*/
function showdata_cover_fileDialogComplete(numFilesSelected, numFilesQueued){
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
function showdata_cover_uploadSuccess(file,serverData){
	var ob={'file':file,'showMsgId':"#cover_upload_msg"};
	setAjaxActionData(serverData,ob);
}
/*
	作用：主要是进度条
	参数：showdata_cover_uploadProgress(file object, bytes complete, total bytes)
     bytes 上传字节数 ，total 总字节数
*/
function showdata_cover_uploadProgress(file, bytesLoaded,total ){
	var c=Math.floor((bytesLoaded/total)*100);
	if(c<100){
		$("#cover_upload_msg").html('已上传'+c+'%');
	}else{
		$("#cover_upload_msg").html('上传完成，等待回应');
	}
}
/*
	作用：就是循环上传队列的图片
	参数：file Object
*/
function showdata_cover_uploadComplete(file){
	if(this.getStats().files_queued > 0){
		this.startUpload();
	}
}
/*
	作用： 把所选的图片入列。
	参数： file Object.
*/
function showdata_cover_fileQueued(file){
	var fileSize=Math.floor(file.size/1024)+"kb";
	var file_name=(file.name.length>22)?file.name.substring(0,22)+'...':file.name;
}
/*清除队列文件*/
function showdata_cover_del_file(file){
	swfu.cancelUpload(file.id);
}
//按钮提交
function showdata_cover_post_set(swfu){
	swfu.addPostParam("pid",11);	
	swfu.startUpload();
}
/*上传失败提示信息*/
var showdata_cover_showMsgTimeId=null;
function showdata_cover_upload_error(data,ob){
	clearTimeout(showdata_cover_showMsgTimeId);
	setHtmlData(ob.showMsgId,'');
	mydialog({'data':data.data});
}
/*上传成功提示信息*/
function showdata_cover_upload_msg(data,ob){
	clearTimeout(showdata_cover_showMsgTimeId);
	setHtmlData(ob.showMsgId,data.data);
	swfu.cancelUpload(ob.file.id);
	inputval('cover_upload_image','name',data.src);
	showdata_cover_showMsgTimeId=setTimeout(function(){
		setHtmlData(ob.showMsgId);
	},2000);
}
/*上传初始化*/
function showdata_cover_upload(do_url,uf_size,uf_type,ac_uid,cdataid){
	swfu=new SWFUpload({
		upload_url:do_url,
		flash_url:_CJG.staticpath+'image/swfupload.swf',
		file_post_name:"filearr",
		file_size_limit:uf_size,
		file_upload_limit:0,
		file_queue_limit:1,
		file_types:uf_type,
		post_params:{'isajax':1,"ac_uid":ac_uid,"cdataid":cdataid,'callFunc':'showdata_cover_upload_error','callFunc_b':'showdata_cover_upload_msg'},
		/* 按钮的设置 */
		button_action:"-100",
		button_image_url:"", // Relative to the Flash file
		button_text:"",
		button_text_style:"",
		button_placeholder_id :"upload_bt",
		button_width:55,
		button_height:22,
		button_text_top_padding:0,
		button_text_left_padding:0,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,			
		/* 选择完图片后执行 */
		file_dialog_complete_handler:showdata_cover_fileDialogComplete,
		/* 上传成功后执行 */
		upload_success_handler:showdata_cover_uploadSuccess,
		/* 主要是进度条 */
		upload_progress_handler:showdata_cover_uploadProgress,
		/* 循环队列里的图片上传 */
		upload_complete_handler: showdata_cover_uploadComplete,
		/* 主要是把图片加入队列 */
		file_queued_handler:showdata_cover_fileQueued,
		//清除队列文件			
		debug: false
	});
	return swfu;
}