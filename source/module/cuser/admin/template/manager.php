<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix page-inform">
	<p class="light">检索条件</p>
</div>

<!-- // -->
<div class="clearfix ul-box">
	<form method="get" action="<?php prt(_g('cp')->uri()); ?>">
    <input type="hidden" name="mod" value="cuser" />
    <input type="hidden" name="ac" value="manager" />
    
	<ul class="ubox">
        
        <li class="clearfix is">
            <div class="clearfix z">
            	<p class="clearfix">
                	<em class="padding100">行业分类:</em>
                    <select name="q_professionid" class="fs-ts-200" style="width:260px;">
                    	<option value="0" >==请选择==</option>
                        <?php $proResult = $CPRO->finds('status', _g('value')->sb( true )); ?>
                        <?php while($v = $CPRO->db->fetch_array($proResult)){ ?>
                            <option value="<?php prt($v['professionid']); ?>" <?php prt($q_professionid == $v['professionid'] ? 'selected="selected"' : ''); ?> ><?php prt($v['pname']); ?></option>
                        <?php } ?>
                    </select>
                </p>
            </div>
            
            <div class="clearfix z margin100">
            	<p class="clearfix"><em class="padding100">ID:</em><input type="text" class="fs-ts-200" name="q_cuid" value="<?php prt($q_cuid); ?>" /></p>
            </div>
            
            <div class="clearfix z margin100">
                <p class="clearfix"><em class="padding100">用户名:</em><input type="text" class="fs-ts-200" name="q_username" value="<?php prt($q_username); ?>" /></p>
            </div>
            
            <div class="clearfix z margin100">
                <p class="clearfix"><em class="padding100">企业名称:</em><input type="text" class="fs-ts-200" name="q_cname" value="<?php prt($q_cname); ?>" /></p>
            </div>
        </li>
        
        <li class="clearfix is">
            <div class="clearfix z">
            	<p class="clearfix">
                	<em class="padding100">账户状态:</em>
                    <select name="q_status" class="fs-ts-200">
                    	<option value="0" >==请选择==</option>
                        <?php foreach(_g('value')->sbs() as $sk => $sv){ ?>
                            <option value="<?php prt($sk); ?>" <?php prt($q_status == $sk ? 'selected="selected"' : ''); ?> ><?php prt($sv['startuse']); ?></option>
                        <?php } ?>
                    </select>
                </p>
            </div>
            
            <div class="clearfix z margin100">
            	<p class="clearfix">
                	<em class="padding100">认证状态:</em>
                    <select name="q_authlicence" class="fs-ts-200">
                    	<option value="0" >==请选择==</option>
                        <?php foreach(_g('value')->sbs() as $sk => $sv){ ?>
                            <option value="<?php prt($sk); ?>" <?php prt($q_authlicence == $sk ? 'selected="selected"' : ''); ?> ><?php prt($sv['auth']); ?></option>
                        <?php } ?>
                    </select>
                </p>
            </div>
            
            <div class="clearfix z margin100">
            	<p class="clearfix">
                	<em class="padding100">推荐企业:</em>
                    <input type="checkbox" name="q_recommend" value="true" <?php prt($q_recommend == 'true' ? 'checked="checked"' : ''); ?> />
                </p>
            </div>
            
            <div class="clearfix z margin102">
            	<p class="clearfix"><button type="submit" class="fbtn-ds">提交查询</button></p>
            </div>
        </li>
        
    </ul>
    </form>
</div>
<!-- // -->

<div class="clearfix table-box">
	<form method="post" onsubmit="return false;" id="form_cuser">
	<input type="hidden" name="id" value="" />
	<button type="button" name="disabled-buttons" id="btn_delete" class="dis-n">删除</button>
    <table class="tbox">
        <tr class="bg-a trow-bline trow-fw">
            <td width="20%">企业名称</td>
            <td width="15%">行业类型</td>
            <td width="10%">账户状态</td>
            <td width="10%">认证状态</td>
            <td width="30%">推荐/程度/时间start~end</td>
            <td width="20%">操作</td>
        </tr>
        
        <?php if(my_array_value('total', $pageData) >= 1){ ?>
        <?php while($rs = $CUser->db->fetch_array($dataResult)){ ?>
        <tr class="trow-bline bg-hover-a">
             <td width="20%"><?php prt($rs['cname']); ?></td>
            <td width="15%">
            	<?php $CSortData = $CSort->get_finds(my_explode(',', $rs['csortid'])); ?>
                <?php if($CSortData[0] > 0){ ?>
            		<?php prt(my_array_value('sname', $CSort->db->fetch_array($CSortData[1]))); ?>&nbsp;...
                <?php }else{ ?>
                -
                <?php } ?>
            </td>
            <td width="10%">
            	<?php if($rs['status'] == _g('value')->sb(true)){ ?>
                	<span class="icon-status-normal">已启用</span>
                <?php }else{ ?>
                	<span class="icon-status-error">已停用</span>
                <?php } ?>
            </td>
            <td width="10%">
            	<?php if($rs['authlicence'] == _g('value')->sb(true)){ ?>
                	<span class="icon-rz">&nbsp;</span>
            		<span class="icon-status-normal">已认证</span>
                <?php }else{ ?>
					<?php if(strlen($rs['licence']) >= 1){ ?>
                    <span class="icon-pictrue">&nbsp;</span>
                    <?php }else{ ?>
                    <span class="icon-pictrue-def">&nbsp;</span>
                    <?php } ?>
                	<span class="icon-status-error tc-b">未认证</span>
                <?php } ?>
			</td>
            <td width="30%" class="fontsize100">
            	<?php $recommend = $CR->is($rs['cuid']); ?>
            	<?php if($recommend[0]){ ?>
                <span class="icon-status-normal">&nbsp;</span>
                <strong><?php prt($recommend[1]['level']); ?></strong>&nbsp;/
                <?php prt(date('Y-m-d H:i:s', $recommend[1]['stime'])); ?>~<?php prt(date('Y-m-d H:i:s', $recommend[1]['etime'])); ?>
                <?php }else{ ?>
                <span class="icon-status-error tc-b">未推荐</span>
                <?php } ?>
            </td>
            <td width="30%">
            <a class="fa-cd icon-page-go" href="<?php prt(_g('cp')->uri('mod/cuser/ac/manager/op/detail/cuid/' . $rs['cuid'])); ?>">查看</a>
            <a class="fa-cd icon-set" href="<?php prt(_g('cp')->uri('mod/cuser/ac/manager/op/set/cuid/' . $rs['cuid'])); ?>">管理</a>
        </tr>
        <?php } ?>
        <?php }else{ ?>
        <tr class="trow-bline bg-hover-a">
            <td colspan="6" class="tc-b"><?php prt(lang(':100008')); ?></td>
        </tr>
        <?php } ?>
        
  		<tr class="bg-b trow-bline">
            <td colspan="6"><?php _g('cp')->page($pageData); ?></td>
        </tr>
    </table>
	</form>
</div>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this, _t){
	var _thisForm = document.getElementById("form_cuser");
	if(_t == "delete"){
		var _thisBtn = document.getElementById("btn_delete");
			_thisForm.id.value = _this.getAttribute("data-id");
		window.top._GESHAI.dialog({
				"title": "删除操作",
				"data": "<p>若删除选项，将不可恢复。</p><p>与其下关联的子级，同时也将一并删除。</p><p>如果删除请点击“确定”，则点击“取消”按钮</p>",
				"isCloseBtn": false,
				"isCancelBtn": true,
				"okBtnFunc" : function(){
					return _GESHAI.fsubmit(_thisBtn, "<?php prt(_g('cp')->uri('mod/cuser/ac/manager/op/delete')); ?>", {
						"start": function(){
							_GESHAI.disbtn("", true);
							window.top._GESHAI.dialog({isHeader: false, isFooter: false, data: "Loading..."});
						},
						"success": function(d){
							_thisForm.id.value = "";
							_GESHAI.disbtn("", false);
							
							d.isCloseBtn = false;
							d.clickBgClose = true;
							d.title = "删除操作";
							window.top._GESHAI.dialog(d);
							if(d.status == 1){
								_GESHAI.redirect(d);
							}
						}
					});
				}
			});
	}
};
</script>
<!-- javascript//  -->