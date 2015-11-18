<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/blocks.css" />





    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
    <!-- //cuser_z -->
    <div class="cuser_z clearfix o-left">
        <?php include _g('template')->name('user', 'center_nav', true); ?>
    </div>
    <!-- cuser_z// -->



    <!-- //cuser_y -->
    <div class="cuser_y clearfix o-right">
        <h1 class="o-title">职位测评记录</h1>
        <div class="tttc">共<em><?php prt($pageData['total']); ?></em>个职位测评记录</div>

            <div class="clearfix uc-exam-rec" id="uc-exam-rec">
                <form method="post" onsubmit="return false;" id="form-exam101">
                    <input type="hidden" name="recordid" value="" />
                    <input type="hidden" name="hideurl" value="<?php prt(_g('uri')->su('user/ac/examrec/op/hide')); ?>" />
                </form>
                <ul class="rec-box">
                    <?php $index=0; ?>
                    <?php while($erRs = _g('db')->result($examRecordResult)): ?>
                        <?php $cuRs = $CUSER->find_jion('a.cuid', $erRs['cuid']); ?>
                        <li class="<?php prt($index % 3 == 0 ? null : 'ml'); ?>">
                            <div class="yz"></div>

                            <div class="cn"><img src="<?php prt($CUSER->logo($cuRs['logo'])); ?>" /><?php prt($cuRs['cname']); ?></div>
                            <div class="tit"><em><?php prt($JMODEL->sortValue($erRs['sortid'], 'sname')); ?></em>:&nbsp;<?php prt($erRs['jname']); ?></div>
                            <div class="score">
                                <div class="bl">测评成绩：</div>
                                <div class="bar">
                                    <div class="pro" style="width:<?php prt(my_array_value(1, $JMODEL->cbar($erRs, 100))); ?>px;"></div>
                                    <div class="tnum"><?php prt(my_array_value(0, $JMODEL->cbar($erRs, 100))); ?>分</div>
                                </div>
                                <div class="mct">100分</div>
                            </div>
                            <div class="xg">性格类型：<em>想象型</em></div>
                            <div class="date"><?php prt(date('Y/m/d', $erRs['ctime'])); ?></div>
                            <div class="vt"><a href="#" onclick="return userExamrecordHide(this);" _id="<?php prt($erRs['recordid']); ?>">隐藏</a>&nbsp;&nbsp;<a href="<?php prt(_g('uri')->su('job/ac/company/op/exam_s/id/'.$cuRs['cuid'].'/jobid/'.$erRs['jobid'])); ?>" target="_blank">查看详情</a></div>
                        </li>
                        <?php $index += 1; ?>
                    <?php endwhile; ?>
                </ul>

            </div>
            <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
        </div>
        <!-- cuser_y// -->

    </div>
    <div class="clear"></div>
    <!-- cuser_center// -->


<?php //include _g('template')->name('job', 'footer', true); ?>


    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
    <script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/u.js"></script>

    <script language="javascript">
        $('#uc-exam-rec').cjslip({ type: 'menu', speed: 100, mainState: 'ul.rec-box li', mainEl: ".vt", defaultShow: false });
    </script>


<?php include _g('template')->name('@', 'footer', true); ?>
