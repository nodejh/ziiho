<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix resume_r_data_write">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="language" />
    <input type="hidden" name="languageid" value="<?php prt(my_array_value('languageid', $languageRs, 0)); ?>" />
    <ul>
        <li class="bline clearfix">
            <div class="nn">语言类别:</div>
            <div class="ii">
                <select class="sel o-input o-fix-select" name="ltype">
                	<option value="-1">-</option>
					<?php foreach(_g('cache')->selectitem(112) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('ltype', $languageRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
                
                掌握程度：
                <select class="sel o-input o-fix-select" name="level">
					<?php foreach(_g('cache')->selectitem(113) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('level', $languageRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
            </select>
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">读写能力:</div>
            <div class="ii">
                <select class="sel o-input o-fix-select" name="rwability">
					<?php foreach(_g('cache')->selectitem(113) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('rwability', $languageRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
            	</select>
                
                听说能力：
                <select class="sel o-input o-fix-select" name="lsability">
					<?php foreach(_g('cache')->selectitem(113) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('lsability', $languageRs)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
            </select>
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_languageSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
            <a class="del_btn" href="#" onclick="return resumeDo_languageDel(<?php prt(my_array_value('languageid', $languageRs, 0)); ?>);">删除</a>
        </li>
    </ul>
    </form>
</div>