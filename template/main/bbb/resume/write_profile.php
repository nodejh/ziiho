<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<!-- //基本信息 -->
<div class="bd-box bd-box-none clearfix" id="base_box">
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="f" value="base" />
    <div class="clearfix" style="background:#eee; height:24px; padding:5px 10px; font-weight:bold;">个人资料</div>
    <ul>
        <li class="bline clearfix">
            <div class="nn">姓名:</div>
            <div class="ii">
            <input type="text" class="o-input" name="chname" value="<?php prt(my_array_value('chname', $resumeProfile)); ?>" />

            </div>
        </li>

        <li class="bline clearfix">
            <div class="nn">性别:</div>
            <div class="ii">

            <select class="sel o-input o-fix-select o-resume-form-width" name="gender">
                <?php foreach(_g('value')->ra(_g('module')->dv('resume', 100000)) as $v): ?>
                    <option value="<?php prt($v['v']); ?>" <?php if($v['v'] == my_array_value('gender', $resumeProfile, -1)){ ?>selected="selected"<?php } ?> ><?php prt($v['name']); ?></option>
                <?php endforeach; ?>
            </select>
    </div>
    </li>


        
        <li class="bline clearfix">
            <div class="nn">出身日期:</div>
            <div class="ii">
                <input type="text" name="birthday" class="ii-calendar o-input o-resume-form-width" value="<?php prt(date("Y-m-d", my_array_value('birthday',$resumeProfile)));?>" readonly="readonly" onclick="WdatePicker({isShowClear:false,readOnly:true,'dateFmt':'yyyy-MM-dd',isShowToday:false,qsEnabled:false,isShowOK:false,minDate:'1960-01-01',maxDate:'<?php prt(date("Y-m-d", _g('cfg>time'))); ?>'})"/>
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">手机号码:</div>
            <div class="ii">
<!--                <select class="sel o-input o-fix-select" name="phonearea">-->
<!--                    <option value="-1">-</option>-->
<!--					--><?php //foreach(_g('cache')->selectitem(106) as $k=>$v): ?>
<!--                    <option value="--><?php //prt($k); ?><!--" --><?php //if($k == my_array_value('phonearea', $resumeProfile)){ ?><!--selected="selected"--><?php //} ?><!-- >--><?php //prt($v['sname']); ?><!--</option>-->
<!--                    --><?php //endforeach; ?>
<!--                </select>-->
                <input type="text" class="o-input o-resume-form-width" name="mobilephone" value="<?php prt(my_array_value('mobilephone', $resumeProfile)); ?>" />
            </div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">邮箱:</div>
            <div class="ii"><input type="text" class="o-input" name="email" value="<?php prt(my_array_value('email', $resumeProfile)); ?>" /></div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">工作年龄:</div>
            <div class="ii">
            <select class="sel o-input o-fix-select o-resume-form-width-fix" name="workyear">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(101) as $k=>$v): ?>
                <option value="<?php prt($k); ?>" <?php if($k == my_array_value('workyear', $resumeProfile)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select></div>
        </li>
        
        <li class="bline clearfix">
            <div class="nn">现居地:</div>
            <div class="ii"><div class="clearfix" id="area-data-1"></div><input type="hidden" name="home" class="o-input" /></div>
        </li>
    </ul>
    
    <div class="clearfix" style="margin-top:10px;"><a class="base-more-bar" style="background:#eee; height:24px; padding:5px 10px; font-weight:bold; cursor:pointer;">更多资料信息<em>+</em></a></div>
    <div class="clearfix base-more">
        <ul>
            <li class="bline clearfix">
                <div class="nn">国家:</div>
                <div class="ii">
                <select class="sel o-input o-fix-select o-resume-form-width-fix" name="country">
                    <option value="-1">-</option>
                    <?php foreach(_g('cache')->selectitem(102) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('country', $resumeProfile)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            </li>

            <li class="bline clearfix">
                <div class="nn">民族:</div>
                <div class="ii">

            <select class="sel o-input o-fix-select o-resume-form-width-fix" name="nation">
                <option value="-1">-</option>
                <?php foreach(_g('cache')->selectitem(103) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('nation', $resumeProfile)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                <?php endforeach; ?>
            </select>
                </div>
            </li>

            
            <li class="bline clearfix">
                <div class="nn">证件类型:</div>
                <div class="ii">
                <select class="sel o-input o-fix-select o-resume-form-width-fix" name="idtype">
                    <option value="-1">-</option>
                    <?php foreach(_g('cache')->selectitem(104) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('idtype', $resumeProfile)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            </li>

            <li class="bline clearfix">
                <div class="nn">证件号码:</div>
                <div class="ii">
            <input type="text" class="o-input" name="idstr" value="<?php prt(my_array_value('idstr', $resumeProfile)); ?>" />
                </div>
            </li>

            <li class="bline clearfix">
                <div class="nn">婚姻状况:</div>
                <div class="ii">
                <select class="sel o-input o-fix-select o-resume-form-width-fix" name="maritalstatus">
                    <option value="-1">-</option>
                    <?php foreach(_g('cache')->selectitem(105) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('maritalstatus', $resumeProfile)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select>

                </div>
            </li>

            <li class="bline clearfix">
                <div class="nn">身高:</div>
                <div class="ii">

            <input type="text" class="o-input o-resume-form-width" name="height" value="<?php prt(my_array_value('height', $resumeProfile)); ?>" />&nbsp;cm
                </div>
            </li>

            
            <li class="bline clearfix">
                <div class="nn">政治面貌:</div>
                <div class="ii">
                <select class="sel o-input o-fix-select o-resume-form-width-fix" name="politicalstatus">
                    <option value="-1">-</option>
                    <?php foreach(_g('cache')->selectitem(100) as $k=>$v): ?>
                    <option value="<?php prt($k); ?>" <?php if($k == my_array_value('politicalstatus', $resumeProfile)){ ?>selected="selected"<?php } ?> ><?php prt($v['sname']); ?></option>
                    <?php endforeach; ?>
                </select></div>
            </li>
            
            <li class="bline clearfix">
                <div class="nn">故乡:</div>
                <div class="ii"><div class="clearfix" id="area-data-2"></div><input type="hidden" name="hometown" class="o-input" /></div>
            </li>
            
            <li class="bline clearfix">
                <div class="nn">qq号码:</div>
                <div class="ii">
                    <input type="text" class="o-input" name="qq" value="<?php prt(my_array_value('qq', $resumeProfile)); ?>" />
                </div>
            </li>
        </ul>
    </div>
    
    <ul>
        <li class="clearfix">
            <div class="nn">&nbsp;</div>
            <button type="button" class="btn-ok" name="disabled-buttons" onclick="resumeDo_base(this, '<?php prt(_g('uri')->su('resume/ac/manager/op/writedo')); ?>');">保存</button>
        </li>
    </ul>
    </form>
</div>
<!-- 基本信息// -->