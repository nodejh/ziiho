<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

    <style type="text/css">
        .mt101 a { color:#069; }
        .mt101 a:hover { text-decoration:underline; }
    </style>
<!---->
<!--    <!-- //cuser_center -->-->
<!--    <div class="cuser_center clearfix" id="cuser_center">-->
<!--        <!-- //cuser_z -->-->
<!--        <div class="cuser_z clearfix">-->
<!--            --><?php //include _g('template')->name('user', 'center_nav', true); ?>
<!--        </div>-->
<!--        <!-- cuser_z// -->-->

    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('user', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->

        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">

            <h1 class="o-title">职位认证记录</h1>

            <div class="tttc">共<em><?php prt($pageData['total']); ?></em>认证记录</div>

            <div class="datas">
                <form method="post" onsubmit="return false;" id="form-job-post">
                    <input type="hidden" name="jobid" value="" />
                </form>
                <table class="tbox">
                    <tr class="trow-fw trow-bg" >
                        <td width="35%">职位</td>
                        <td width="40%" class="mt101">
                            系统题 / 自定义
                            <?php foreach(_g('cache')->selectitem(120) as $k=>$v){ ?>
                                / <?php prt($v['sname']); ?><?php prt($JModel->authFieldOrder($v['flag'],$__qw, 1)); ?>
                            <?php } ?>
                        </td>
                        <td width="15%">时间</td>
                        <td width="10%">&nbsp;</td>
                    </tr>

                    <?php while($erRs = _g('db')->result($examRecordResult)): ?>

                        <tr class="trow-bline trow-hover" >
                            <td width="35%">[<?php prt(my_array_value('cname', $CUSER->find_jion('a.cuid', $erRs['cuid']))); ?>]<?php prt($erRs['jname']); ?></td>
                            <td width="40%">
                                <?php $fflag = false; ?>
                                <?php foreach($JModel->examAnswerField($erRs) as $fk=>$fv){ ?>
                                    <?php if($fflag){ ?> / <?php } ?>
                                    [<?php prt($erRs[$fk].'/'. $fv); ?>]
                                    <?php $fflag = true; ?>
                                <?php } ?>
                            </td>
                            <td width="15%"><?php prt(person_time($erRs['ctime'])); ?></td>
                            <td width="10%" class="ops"><a href="javascript:;" onclick=""></a></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
        </div>
        <!-- cuser_y// -->

    </div>
    <div class="clear"></div>
    <!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
    <script language="javascript">

    </script>

<?php include _g('template')->name('@', 'footer', true); ?>