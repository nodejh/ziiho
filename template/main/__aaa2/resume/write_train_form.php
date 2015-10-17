<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_write">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="train" />
    <input type="hidden" name="trainid" value="<?php prt(my_array_value('trainid', $trainRs, 0)); ?>" />
    <ul>
        <li class="bline clearfix">
            <div class="nn">时间:</div>
            <div class="ii">
            <select class="sel" name="syear">
              <?php for($i = 1960; $i <= date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('syear', $trainRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel" name="smonth">
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('smonth', $trainRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          到
          <select class="sel" name="eyear">
              <option value="-1"></option>
              <?php for($i = 1960; $i <= date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('eyear', $trainRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel" name="emonth">
              <option value="-1"></option>
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('emonth', $trainRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
            后两项不填为至今
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">培训机构:</div>
            <div class="ii">
                <input type="text" class="ii-inp" name="organization" value="<?php prt(my_array_value('organization', $trainRs)); ?>" />
                
                培训地点：
                <input type="text" class="ii-inp" name="area" value="<?php prt(my_array_value('area', $trainRs)); ?>" />
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">培训课程:</div>
            <div class="ii">
                <input type="text" class="ii-inp" name="course" value="<?php prt(my_array_value('course', $trainRs)); ?>" />
                
                获得证书：
                <input type="text" class="ii-inp" name="certificate" value="<?php prt(my_array_value('certificate', $trainRs)); ?>" />
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">详细描述:</div>
            <div class="ii"><textarea train="description" name="description" style="width:540px; height:80px;"><?php prt(my_array_value('description', $trainRs)); ?></textarea></div>
        </li>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <div class="ii"><input type="checkbox" name="ispublish" value="true" <?php prt(1 == my_array_value('ispublish', $trainRs) ? 'checked="checked"' : null); ?> />是否在我的简历显示</div>
        </li>
    </ul>
    
    
    <ul>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_trainSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
            <a class="del_btn" href="#" onclick="return resumeDo_trainDel(<?php prt(my_array_value('trainid', $trainRs, 0)); ?>);">删除</a>
        </li>
    </ul>
    </form>
</div>