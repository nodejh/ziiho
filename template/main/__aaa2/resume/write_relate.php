<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //其他 -->
<div class="bd-box bd-box-none clearfix">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="relate" />
    <ul>
    	<li class="bline clearfix">
            <div class="nn">英语等级:</div>
            <div class="ii">
                <select class="sel" name="englishlv">
                	<option value="-1">-</option>
					<?php foreach(_g('cache')->selectitem(117) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('englishlv', $relateData)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
                
                日语等级:
                <select class="sel" name="japaneselv">
                	<option value="-1">-</option>
					<?php foreach(_g('cache')->selectitem(118) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('japaneselv', $relateData)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </li>
    	
        <li class="bline clearfix">
            <div class="nn">主题类型:</div>
            <div class="ii">
                <select class="sel" name="explaintype">
                	<option value="-1">-</option>
					<?php foreach(_g('cache')->selectitem(115) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('explaintype', $relateData)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" class="ii-inp" name="explaintype_input" value="<?php prt(my_array_value('explaintype_input', $relateData)); ?>" />
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">主题内容:</div>
            <div class="ii"><textarea relate="explaindesc" name="explaindesc" style="width:540px; height:80px;"><?php prt(my_array_value('explaindesc', $relateData)); ?></textarea></div>
        </li>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <div class="ii"><input type="checkbox" name="explainis" value="true" <?php prt(1 == my_array_value('explainis', $relateData) ? 'checked="checked"' : null); ?> />显示在我的简历中</div>
        </li>
    </ul>
    
    <ul>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_relateSave(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
        </li>
    </ul>
    </form>
</div>
<!-- 其他// -->