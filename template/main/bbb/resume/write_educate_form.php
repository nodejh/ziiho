<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_write">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="educate" />
    <input type="hidden" name="educateid" value="<?php prt(my_array_value('educateid', $educateRs, 0)); ?>" />
    <ul>
      <li class="bline clearfix">
          <div class="nn">时间:</div>
          <div class="ii">
          <select class="sel o-input o-fix-select" name="syear">
              <?php for($i = 1960; $i < date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('syear', $educateRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel o-input o-fix-select" name="smonth">
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('smonth', $educateRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          到
          <select class="sel o-input o-fix-select" name="eyear">
              <option value="-1"></option>
              <?php for($i = 1960; $i < date('Y'); $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('eyear', $educateRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          <select class="sel o-input o-fix-select" name="emonth">
              <option value="-1"></option>
              <?php for($i = 1; $i <= 12; $i++){ ?>
              <option value="<?php prt($i); ?>" <?php prt($i == my_array_value('emonth', $educateRs) ? 'selected="selected"' : null); ?> ><?php prt($i); ?></option>
              <?php } ?>
          </select>
          后两项不填为至今
          </div>
      </li>
      
      <li class="bline clearfix">
          <div class="nn">学校:</div>
          <div class="ii">
              <input type="text" class="o-input" name="school" _school="<?php prt(my_array_value('educateid', $educateRs)); ?>"  value="<?php prt(my_array_value('school', $educateRs)); ?>" />
          </div>
      </li>
      
      <li class="bline clearfix">
          <div class="nn">专业:</div>
          <div class="ii">
          <span class="z">
          <select class="sel o-input o-fix-select" name="specialty">
              <option value="-1">-</option>
              <?php foreach(_g('cache')->selectitem(110) as $k=>$v): ?>
              <option value="<?php prt($k); ?>" <?php prt($k == my_array_value('specialty', $educateRs) ? 'selected="selected"' : null); ?> ><?php prt($v['sname']); ?></option>
              <?php endforeach; ?>
          </select></span>
          <span class="z"><input type="text" class="o-input" educate="specialty_input" name="specialty_input" value="<?php prt(my_array_value('specialty_input', $educateRs)); ?>" /></span>
          </div>
      </li>
      
      <li class="bline clearfix">
          <div class="nn">学历:</div>
          <div class="ii">
          <select class="sel o-input o-fix-select" name="degree">
              <option value="-1">-</option>
              <?php foreach(_g('cache')->selectitem(111) as $k=>$v): ?>
              <option value="<?php prt($k); ?>" <?php prt($k == my_array_value('degree', $educateRs) ? 'selected="selected"' : null); ?> ><?php prt($v['sname']); ?></option>
              <?php endforeach; ?>
          </select>
          <input type="checkbox" name="isallday" value="true" <?php prt(1 == my_array_value('isallday', $educateRs) ? 'checked="checked"' : null); ?> />全日制
          </div>
      </li>
      
      <li class="clearfix">
          <div class="nn">专业描述:</div>
          <div class="ii"><textarea class="o-input" educate="description" name="description" style="width:540px; height:80px;"><?php prt(my_array_value('description', $educateRs)); ?></textarea></div>
      </li>
      
      <li class="bline clearfix">
          <div class="nn">海外经历:</div>
          <div class="ii">
              <?php foreach(_g('value')->sbs() as $k=>$v){ ?>
                <span class="ck-mr" radio="status"><input type="radio" name="overseas_exp" value="<?php prt($k); ?>" <?php if($v['v'] == my_array_value('overseas_exp', $educateRs, -1)){ ?> checked="checked"<?php } ?> /><?php prt($v['name']); ?></span>
                <?php } ?>
          </div>
      </li>
    </ul>
    
      <li class="clearfix">
          <div class="nn">&nbsp;</div>
          <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_educateSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
          <a class="del_btn" href="#" onclick="return resumeDo_educateDel(<?php prt(my_array_value('educateid', $educateRs, 0)); ?>);">删除</a>
      </li>
    </form>
</div>