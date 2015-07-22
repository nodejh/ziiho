<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php
//$navDataArr = array(
//    'center'=> array('uri'=>'user/ac/center', 'name'=>'<i class="fa fa-dashboard fa-fw o-fa-right"></i> &nbsp;企业中心'),
//    'company'=> array('uri'=>'user/ac/company', 'name'=>'<i class="fa fa-info-circle fa-fw o-fa-right"></i> &nbsp;公司信息'),
//    'zplx'=> array('uri'=>'user/ac/zplx', 'name'=>'<i class="fa fa-user fa-fw o-fa-right"></i> &nbsp;招聘联系人'),
//    'job'=> array('uri'=>'user/ac/job', 'name'=>'<i class="fa fa-cog fa-fw o-fa-right"></i> &nbsp;职位管理'),
//    'password'=> array('uri'=>'user/ac/password', 'name'=>'<i class="fa fa-wrench fa-fw o-fa-right"></i> &nbsp;密码修改')
//);
//?>
<!--<div class="ul-item" id="ul-item">-->
<!--    <ul>-->
<!--        --><?php //foreach($navDataArr as $ndaK => $ndaV): ?>
<!--            <li><a href="--><?php //prt(_g('uri')->su($ndaV['uri'])); ?><!--" --><?php //prt(_get('ac') == $ndaK ? 'class="on"' : '');?><!-- >--><?php //prt($ndaV['name']); ?><!--</a></li>-->
<!--        --><?php //endforeach; ?>
<!--    </ul>-->
<!--</div>-->




<div class="ul-item" id="ul-item">
    <ul>
        <li><a id="company-url-center" href="<?php prt(_g('uri')->su('user/ac/center')); ?>"><i class="fa fa-dashboard fa-fw o-fa-right"></i> &nbsp;企业中心</a></li>
        <li>
            <a id="company-url-company" href="<?php prt(_g('uri')->su('user/ac/company')); ?>"><i class="fa fa-info-circle fa-fw o-fa-right"></i> &nbsp;公司信息</a>
            <ul id="company-list" class="company-tab-hd clearfix o-cuser-infotitle">
                <li><a href="javascript:;" class="o-company-list">基本信息</a></li>
                <li><a href="javascript:;" class="o-company-list">公司简介</a></li>
                <li><a href="javascript:;" class="o-company-list">公司LOGO</a></li>
                <li><a href="javascript:;" class="o-company-list">营业执照</a></li>
            </ul>
        </li>
        <li><a id="company-url-zplx" href="<?php prt(_g('uri')->su('user/ac/zplx')); ?>"><i class="fa fa-user fa-fw o-fa-right"></i> &nbsp;招聘联系人</a></li>
        <li><a id="company-url-job" href="<?php prt(_g('uri')->su('user/ac/job')); ?>"><i class="fa fa-cog fa-fw o-fa-right"></i> &nbsp;职位管理</a></li>
        <li><a id="company-url-password" href="<?php prt(_g('uri')->su('user/ac/password')); ?>"><i class="fa fa-wrench fa-fw o-fa-right"></i> &nbsp;密码修改</a></li>
    </ul>
</div>


