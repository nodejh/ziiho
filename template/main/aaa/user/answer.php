<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php include _g('template')->name('user', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
    
    <div class="tttc">共<em><?php prt($pageData['total']); ?></em>条记录</div>
    
    <div class="clearfix datas">
    	<form method="post" onsubmit="return false;" id="form_201">
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="3%">&nbsp;</td>
                <td width="40%">职位标题</td>
                <td width="25%">职位分类</td>
                <td width="12%">分数/合格</td>
                <td width="20%">时间</td>
            </tr>
            
            <?php if($pageData['total'] >= 1){ ?>
            <?php while($AuthRs = _g('db')->result($dataResult)): ?>
            <?php $jobData = $CJOB->find('jobid', $AuthRs['jobid']); ?>
            <tr class="trow-bline trow-hover" >
            	<td width="3%"><span checkbox-item="authid"><input type="checkbox" name="authid[]" value="<?php prt($AuthRs['authid']); ?>" /></span></td>
                <td width="40%">
                	<?php if(!is_array($jobData)){ ?>
					<s class="color102"><?php prt($AuthRs['jname']); ?></s>&nbsp;<em class="color101">[信息不存在]</em>
                    <?php }else{ ?>
                    [<?php prt(my_array_value('cname', $CUSER->find_jion('a.cuid', $jobData['cuid']))); ?>]<?php prt($jobData['jname']); ?>
                    <?php } ?>
                </td>
                <td width="25%"><?php prt($JModel->sortValue($AuthRs['sortid'], 'sname')); ?></td>
                <td width="12%"><span class="<?php prt($AuthRs['ispass'] == -1 ? 'score_s201' : 'score_s202'); ?>"><?php prt($AuthRs['score']); ?></span></td>
                <td width="20%" class="ops"><?php prt(person_time($AuthRs['ctime'])); ?></td>
            </tr>
            <?php endwhile; ?>
            <?php }else{ ?>
            <tr class="trow-bline trow-hover" >
            	<td width="100%" colspan="5" class="color102">暂无答卷记录信息</td>
            </tr>
            <?php } ?>
        </table>
        <div class="clear"></div>
        
        <div class="clearfix btns">
    		<span class="btns_qx" checkbox-all="authid">全选</span>
        	<button type="button" class="btns_201" onclick="fsdo(this, 'delete');">删除所选</button>
    	</div>
        </form>
    </div>
    <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
_GESHAI.checkbox({
	"checkbox": "span[checkbox-all=authid]",
	"checkboxItem": "span[checkbox-item=authid]",
	"name": "authid[]"
});
function fsdo(_this, _t){
	if(_t == "delete"){
		if($("input[name='authid[]']:checked").length < 1){
			window.top._GESHAI.dialog({isCloseBtn: false, clickBgClose: true, title:"删除操作", data: "对不起，请至少选择一项！"});
			return null;
		}
		
		window.top._GESHAI.dialog({
				title: "删除操作",
				data: "您确定要将所选的答卷记录删除么？<br/>如果删除请点击“确定”，则点击“取消”按钮",
				isCloseBtn: false,
				isCancelBtn: true,
				isPromptIcon:true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_this, "<?php prt(_g('uri')->su('user/ac/answer/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_GESHAI.disbtn("", false);
							d.isCloseBtn = false;
							d.clickBgClose = true;
							if(d.status != 1){
								d.title = "删除操作";
								d.isErrorIcon = true;
							}else{
								d.title = "删除操作";
								d.isSuccessIcon = true;
							}
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
			});
	}else{
	}
};
</script>

<?php include _g('template')->name('@', 'footer', true); ?>