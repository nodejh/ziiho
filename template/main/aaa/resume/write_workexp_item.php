<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_i">
    <div class="clearfix ib99">
        <a href="#" onclick="return resumeDo_workexpForm(<?php prt($wRs['workexpid']); ?>);">修改</a>
        <a href="#" onclick="return resumeDo_workexpDel(<?php prt($wRs['workexpid']); ?>);">删除</a>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">时间:</span>
        <span class="z">
            <?php prt(date('Y', $wRs['stime'])); ?>年<?php prt(date('m', $wRs['stime'])); ?>月&nbsp;~&nbsp;
            <?php if($wRs['etime'] == 0) { ?>
            至今
            <?php }else{ ?>
            <?php prt(date('Y', $wRs['etime'])); ?>年<?php prt(date('m', $wRs['etime'])); ?>
            <?php } ?>
        </span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">公司名称:</span>
        <span class="z"><?php prt($wRs['company']); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">公司行业:</span>
        <span class="z" id="workexp_hy_<?php prt($wRs['workexpid']); ?>"></span>
        <script language="javascript">
			window.onload = function(){
				var d = deMutiSortValue("<?php prt($wRs['sortid'])?>");
				var o = $("#workexp_hy_<?php prt($wRs['workexpid']); ?>");
				for(var i = 0; i < d.length; i++){
					o.append(d[i].sname);
				}
			};
		</script>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">公司规模:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('114>' . $wRs['csize'] . '>sname')); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">公司性质:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('119>' . $wRs['nature'] . '>sname')); ?></span>
    </div> 
    
    <div class="clearfix ib100">
        <span class="z">部门:</span>
        <span class="z"><?php prt($wRs['department']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">职位:</span>
        <span class="z" id="workexp_zw_<?php prt($wRs['workexpid']); ?>"></span>
        <script language="javascript">
			window.onload = function(){
				$("#workexp_zw_<?php prt($wRs['workexpid']); ?>").html(getSortValue("<?php prt($wRs['sortid2'])?>", "sname"));
			};
		</script>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">工作描述:</span>
        <span class="z"><?php prt($wRs['description']); ?></span>
    </div>
    
    <div class="clearfix ib100">
        <span class="z">工作类型:</span>
        <span class="z"><?php prt(_g('cache')->selectitem('107>' . $wRs['worktype'] . '>sname')); ?></span>
    </div>
    
</div>