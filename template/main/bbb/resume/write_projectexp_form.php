<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_write">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="projectexp" />
    <input type="hidden" name="projectexpid" value="<?php prt(my_array_value('projectexpid', $projectexpRs, 0)); ?>" />
    <ul>
        <li class="bline clearfix">
            <div class="nn">时间:</div>
            <div class="ii">
            <select class="sel o-input o-fix-select" name="syear">
              <?php for($i = 1960; $i < date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('syear', $projectexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel o-input o-fix-select" name="smonth">
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('smonth', $projectexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          到
          <select class="sel o-input o-fix-select" name="eyear">
              <option value="-1"></option>
              <?php for($i = 1960; $i < date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('eyear', $projectexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel o-input o-fix-select" name="emonth">
              <option value="-1"></option>
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('emonth', $projectexpRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
            后两项不填为至今
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">项目名称:</div>
            <div class="ii">
                <input type="text" class="o-input" name="pname" value="<?php prt(my_array_value('pname', $projectexpRs)); ?>" />
            </div>
        </li>

        <li class="bline clearfix">
            <div class="nn">开发工具:</div>
            <div class="ii">
                <input type="text" class="o-input" name="tool" value="<?php prt(my_array_value('tool', $projectexpRs)); ?>" />
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">硬件环境:</div>
            <div class="ii">
                <input type="text" class="o-input" name="hardware" value="<?php prt(my_array_value('hardware', $projectexpRs)); ?>" />
            </div>
        </li>

        <li class="bline clearfix">
            <div class="nn">软件环境:</div>
            <div class="ii">
                <input type="text" class="o-input" name="software" value="<?php prt(my_array_value('software', $projectexpRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">项目描述:</div>
            <div class="ii"><textarea projectexp="pdesc" class="o-input" name="pdesc" style="width:540px; height:80px;"><?php prt(my_array_value('pdesc', $projectexpRs)); ?></textarea></div>
        </li>
        
        
        <li class="clearfix">
            <div class="nn">责任描述:</div>
            <div class="ii"><textarea projectexp="responsible" class="o-input" name="responsible" style="width:540px; height:80px;"><?php prt(my_array_value('responsible', $projectexpRs)); ?></textarea></div>
        </li>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <div class="ii"><input type="checkbox" name="ispublish" value="true" <?php prt(1 == my_array_value('ispublish', $projectexpRs) ? 'checked="checked"' : null ); ?> />是否在我的简历显示</div>
        </li>
        
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_projectexpSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
            <a class="del_btn" href="#" onclick="return resumeDo_projectexpDel(<?php prt(my_array_value('projectexpid', $projectexpRs, 0)); ?>);">删除</a>
        </li>
    </ul>
    </form>
</div>