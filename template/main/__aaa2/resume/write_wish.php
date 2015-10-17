<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //求职意向 -->
<div class="bd-box bd-box-none clearfix">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="wish" />
    <ul>
        <li class="bline clearfix">
            <div class="nn">地点:</div>
            <div class="ii"><div class="clearfix" id="area-data-3"></div><input type="hidden" name="area" /></div>
        </li>
        
        <!-- 多个参数请以半角逗号分隔开 -->
        <li class="bline clearfix">
            <div class="nn">行业:</div>
            <div class="ii">
            <select class="sel" name="sortid" wish="sortid" def="<?php prt(my_array_value('sortid', $wishSub)); ?>">
                <option value="-1">-</option>
            </select>
            </div>
        </li>
        
        <!-- 多个参数请以半角逗号分隔开 -->
        <li class="bline clearfix">
            <div class="nn">职位:</div>
            <div class="ii">
            <select class="sel" name="sortid2" wish="sortid2" def="<?php prt(my_array_value('sortid2', $wishSub)); ?>">
                <option value="-1">-</option>
            </select>
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">工作性质:</div>
            <div class="ii">
            <select class="sel" name="worktype">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(107) as $k=>$v): ?>
                <option value="<?php prt($k); ?>" <?php if($k == my_array_value('worktype', $wishSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select></div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">期望薪资:</div>
            <div class="ii">
            <select class="sel" name="wagetype">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(108) as $k=>$v): ?>
                <option _flag="<?php prt($v['flag']); ?>" value="<?php prt($k); ?>" <?php if($k == my_array_value('wagetype', $wishSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select>
            
            <select class="sel" name="wage_year" style="display:none;">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(122) as $k=>$v): ?>
                <option value="<?php prt($k); ?>" <?php if($k == my_array_value('wage', $wishSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select>
            
            <select class="sel" name="wage_month" style="display:none;">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(116) as $k=>$v): ?>
                <option value="<?php prt($k); ?>" <?php if($k == my_array_value('wage', $wishSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select>
            
            <span wish="wage_input_box" style="display:none;"><input type="text" class="ii-inp2" wish="wage_input" name="wage_input" value="<?php prt(my_array_value('wage', $wishSub)); ?>"></span>
            <span wish="wage_no" style="display:none; border:1px solid #ccc; background:#f2f2f2; color:#999; padding:2px 5px;">请选择</span>
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">到岗时间:</div>
            <div class="ii">
            <select class="sel" name="workstatus">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(109) as $k=>$v): ?>
                <option value="<?php prt($k); ?>" <?php if($k == my_array_value('workstatus', $wishSub)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select>
            </div>
        </li>
        
        <li class="clearfix">
            <div class="nn">自我介绍:</div>
            <div class="ii"><textarea wish="selfintroduce" name="selfintroduce" style="width:540px; height:80px;"><?php prt(my_array_value('selfintroduce', $wishSub)); ?></textarea></div>
        </li>
    </ul>
    
    <ul>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_wish(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
        </li>
    </ul>
    </form>
    
    <script language="javascript">
		hy_InitHtml($("select[wish=\"sortid\"]"));
		zw_InitHtml($("select[wish=\"sortid2\"]"));
		
		$(document).ready(function(e) {
			var __wagetype_obj = $("select[name='wagetype']");
			resume_wish_wagetype(__wagetype_obj.find("option:selected").attr("_flag"));
			
			__wagetype_obj.change(function(e) {
				var __v = $(this).find("option:selected").attr("_flag");
				resume_wish_wagetype(__v);
			});
		});
		
	</script>
</div>
<!-- 求职意向// -->