<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

    <style type="text/css">
        .mt101 a { color:#069; }
        .mt101 a:hover { text-decoration:underline; }
    </style>

    <!---->
    <!--<style type="text/css">-->
    <!--    .mt101 a { color:#069; }-->
    <!--    .mt101 a:hover { text-decoration:underline; }-->
    <!--</style>-->

    <!-- //cuser_center -->
    <!--<div class="cuser_center clearfix" id="cuser_center">-->
    <!--    <!-- //cuser_z -->-->
    <!--    <div class="cuser_z clearfix">-->
    <!--        --><?php //include _g('template')->name('user', 'center_nav', true); ?>
    <!--    </div>-->
    <!--    <!-- cuser_z// -->-->
    <!---->
    <!--    <!-- //cuser_y -->-->
    <!--    <div class="cuser_y clearfix">-->
    <!---->
    <!--        -->
    <!--    </div>-->
    <!--    <!-- cuser_y// -->-->
    <!---->
    <!--</div>-->
    <!--<div class="clear"></div>-->









    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('user', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->

        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">

            <h1 class="o-title">工作申请记录</h1>


            <div class="light">
                <p class="t1">提示：</p>
                <p class="t2"><em>•</em>工作申请记录，仅保留2个月内的记录，超出时间期段系统将自动删除。</p>
            </div>

            <div class="tttc">共<em><?php prt($pageData['total']); ?></em>工作申请记录</div>

            <div class="datas">
                <table class="tbox">
                    <tr class="trow-fw trow-bg" >
                        <td width="15%">公司名称</td>
                        <td width="20%">职位名称</td>
                        <td width="16%">工作地点</td>
                        <td width="12%">发布时间</td>
                        <td width="12%">申请时间</td>
                        <td width="15%">申请简历</td>
                        <td width="10%">投递状况</td>
                    </tr>
                    <?php if($pageData['total'] >= 1){ ?>
                        <?php while($jrRs = _g('db')->result($pageData['result'])): ?>
                            <?php $job = $CJOB->find('jobid', $jrRs['jobid']); ?>
                            <tr class="trow-bline trow-hover" >
                                <td width="15%"><?php prt(my_array_value('cname', $CUSER->find_jion('a.cuid', $jrRs['cuid']))); ?></td>
                                <td width="20%"><?php prt(my_array_value('jname', $job)); ?></td>
                                <td width="16%">
                                    <?php foreach(_g('value')->s2pnsplit2($job['areaid']) as $v){ ?>
                                        <?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;
                                    <?php } ?>
                                </td>
                                <td width="12%"><?php prt(person_time(my_array_value('ctime', $job))); ?></td>
                                <td width="12%"><?php prt(person_time($jrRs['ctime'])); ?></td>
                                <td width="15%"><?php prt(my_array_value('rname', $RESUME->rfind('resumeid', $jrRs['resumeid']))); ?></td>
                                <td width="10%">成功</td>
                            </tr>
                        <?php endwhile; ?>
                    <?php }else{ ?>
                        <td width="100%" colspan="7">对不起，暂无工作申请记录</td>
                    <?php } ?>
                </table>
            </div>
            <div class="page-tab"><?php prt($JModel->page($pageData)); ?></div>
        <!-- cuser_y// -->

    </div>
    <div class="clear"></div>







    <!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
    <script language="javascript">

    </script>

<?php include _g('template')->name('@', 'footer', true); ?>