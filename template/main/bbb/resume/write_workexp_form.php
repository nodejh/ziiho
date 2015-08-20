<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_write">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="workexp" />
    <input type="hidden" name="workexpid" value="<?php prt(my_array_value('workexpid', $workexpRs, 0)); ?>" />
    <ul>
        <li class="bline clearfix">
            <div class="nn">时间:</div>
            <div class="ii">
            <select class="sel o-input o-fix-select" name="syear">
              <?php for($i = 1960; $i < date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('syear', $workexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel o-input o-fix-select" name="smonth">
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('smonth', $workexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          到
          <select class="sel o-input o-fix-select" name="eyear">
              <option value="-1"></option>
              <?php for($i = 1960; $i < date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('eyear', $workexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel o-input o-fix-select" name="emonth">
              <option value="-1"></option>
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('emonth', $workexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
            后两项不填为至今
            </div>
        </li>

        <li class="clearfix">
            <div class="nn">工作类型:</div>
            <div class="ii">
                <select class="sel o-input o-fix-select" name="worktype">
                    <option value="-1">-</option>
                    <?php foreach(_g('cache')->selectitem(107) as $k=>$v): ?>
                        <option value="<?php prt($k); ?>" <?php if($k == my_array_value('worktype', $workexpRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </li>

        <li class="bline clearfix">
            <div class="nn">公司名称:</div>
            <div class="ii">
                <input type="text" class="o-input" name="company" value="<?php prt(my_array_value('company', $workexpRs)); ?>" />
            </div>
        </li>
        
        <!-- 多选, 多个参数请以英文逗号分割开 -->
        <li class="bline clearfix">
            <div class="nn">公司行业:</div>
            <div class="ii">
                <select class="sel o-input o-fix-select" name="sortid" workexp="sortid" def="<?php prt(my_array_value('sortid', $workexpRs)); ?>">
                <option value="-1">-</option>
            	</select>
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">公司规模:</div>
            <div class="ii">
                <select class="sel o-input o-fix-select" name="csize">
                	<option value="-1">-</option>
					<?php foreach(_g('cache')->selectitem(114) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('csize', $workexpRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
            	</select>
                
                公司性质：
                <select class="sel o-input o-fix-select" name="nature">
                	<option value="-1">-</option>
					<?php foreach(_g('cache')->selectitem(119) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('nature', $workexpRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
            	</select>
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">部门:</div>
            <div class="ii">
                <input type="text" class="o-input" name="department" value="<?php prt(my_array_value('department', $workexpRs)); ?>" />
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">职位:</div>
            <div class="ii">
                <select class="sel o-input o-fix-select" name="sortid2" workexp="sortid2" def="<?php prt(my_array_value('sortid2', $workexpRs)); ?>">
                <option value="-1">-</option>
            	</select>

                <input type="text" class="o-input o-inpu-fix-auto" name="sortid2_input" value="<?php prt(my_array_value('sortid2_input', $workexpRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">工作描述:</div>
            <div class="ii"><textarea workexp="description" class="o-input" name="description" style="width:540px; height:80px;"><?php prt(my_array_value('description', $workexpRs)); ?></textarea></div>
        </li>

        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_workexpSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
            <a class="del_btn" href="#" onclick="return resumeDo_workexpDel(<?php prt(my_array_value('workexpid', $workexpRs, 0)); ?>);">删除</a>
        </li>
    </ul>
    </form>
    <script language="javascript">
		hy_InitHtml($("select[workexp=\"sortid\"]"));
		zw_InitHtml($("select[workexp=\"sortid2\"]"));
	</script>
</div>