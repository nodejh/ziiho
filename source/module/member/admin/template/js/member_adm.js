// JavaScript Document
/*用户组编辑时需要显示设置的项*/
function member_adm_groupsetting_item(val){
	if(!isVal(val)){
		val=getboxfirst('module_arr');
	}
	var inputId="record_item_val";
	/*获取上次的值*/
	oldVal=inputval(inputId);
	if(oldVal==val) return false;
	/*设置css*/
	if(isVal(oldVal) && oldVal!=val){
		setHtmlRemoveClass("#nav_module_"+oldVal,"cont_items");
		setHtmlAddClass("#nav_module_"+oldVal,"cont_item");
		setHtmlDisplay("#set_module_"+oldVal,'none');
	}
	setHtmlRemoveClass("#nav_module_"+val,"cont_item");
	setHtmlAddClass("#nav_module_"+val,"cont_items");
	setHtmlDisplay("#set_module_"+val);
	/*显示名称*/
	$("#set_module_b_"+val).html($("#nav_module_"+val).text());
	/*保存本次值*/
	set_html_input(inputId,val);
}
/*基本任务添加*/
function task_base_add(do_url){
	var tb_listorder=inputvals('tb_listorder');
	var tb_name=inputvals('tb_name');
	var tb_content=textareaval('tb_content');
	var tb_disabled=is_check_name('tb_disabled',0);
	var tb_type=selectvals("tb_type");
	publishdo(do_url,{'tb_listorder':tb_listorder,'tb_name':tb_name,'tb_content':tb_content,'tb_disabled':tb_disabled,'tb_type':tb_type},"","","#dobt");
}
/*基本任务列表操作*/
function task_base_list(do_url_edit,do_url_del){
	var tb_id_arr=cboxvals("tb_id_arr");
	var tb_id_len=tb_id_arr.length;
	var tb_disabled_arr=[];
	if(tb_id_len<1){
		myalert({'msg_str':'请选择一个ID编号'});
		return false;
	}
	if(cboxvals("ck_dosign").length<1){
		/*编辑操作*/
		for(var i=0;i<tb_id_len;i++){
			tb_disabled_arr.push(is_check_name("tb_disabled_"+tb_id_arr[i],0));
			
		}
		publishdo(do_url_edit,{'tb_id':tb_id_arr,'tb_disabled':tb_disabled_arr},"","","#dobt");		
	}else{
		/*删除操作*/
		if(confirm("如果删除该该任务，则该任务的功能将不可用\n\n您确定要执行删除操作吗？")){
			publishdo(do_url_del,{'tb_id':tb_id_arr},"","","#dobt");
		}
	}
}
/*基本任务编辑*/
function task_base_edit(do_url,tb_id){
	var tb_listorder=inputvals('tb_listorder');
	var tb_name=inputvals('tb_name');
	var tb_content=textareaval('tb_content');
	var tb_disabled=is_check_name('tb_disabled',0);
	var tb_type=selectvals("tb_type");
	publishdo(do_url,{'tb_id':tb_id,'tb_listorder':tb_listorder,'tb_name':tb_name,'tb_content':tb_content,'tb_disabled':tb_disabled,'tb_type':tb_type},"","","#dobt");
	return false;
}