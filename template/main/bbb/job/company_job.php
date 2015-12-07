<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>


<?php include $a = _g('template')->name('newUI', 'common/fix-header', true); ?>


</head>

<!-- include navbar  -->
<?php include $a = _g('template')->name('newUI', 'common/navbar', true); ?>



<!-- custom html  -->
<div class="container-fluid zh-mian">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">

            <div class="well zh-company-view-well">
                <span><img class="zh-company-view-pic" src="<?php prt($CUSER->logo($cUserData['logo'])); ?>" /></span>
                <em class="t"><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . _get('id'))); ?>"><?php prt($cUserData['cname']); ?></a> - [<?php prt($jsortData['sname']); ?>]<strong><?php prt($jobData['jname']); ?></strong></em>

                <div class="cbase clearfix">
                    <ul class="cb">
                        <li class="clearfix"><span class="ln">公司行业：</span>
                            <?php foreach(_g('value')->s2pnsplit2($cUserData['csortid']) as $v){ ?>
                                <?php prt($JMODEL->sortValue($v, 'sname')); ?>&nbsp;&nbsp;
                            <?php } ?>
                        </li>
                        <li class="clearfix"><span class="ln">公司性质：</span><?php prt(_g('cache')->selectitem('119>'.$cUserData['cnatureid'].'>sname')); ?></li>
                        <li class="clearfix"><span class="ln">公司规模：</span><?php prt(_g('cache')->selectitem('114>'.$cUserData['csize'].'>sname')); ?></li>
                    </ul>
                </div>

            </div>


            <ul id="myTab" class="nav nav-tabs">
               <li class="active">
                  <a href="#home" data-toggle="tab">
                     职位描述
                  </a>
               </li>
               <li><a href="#ios" data-toggle="tab">公司介绍</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
               <div class="tab-pane fade in active" id="home">
                    <div class="zh-list container-fluid zh-maxbox">
                        <br>
                        <table class="table table-striped">
                            <tr>
                                <td class="ftb w80">发布日期</td>
                                <td class="w160"><?php prt(date('Y-m-d', $jobData['ctime'])); ?></td>
                                <td class="ftb w80">工作地点</td>
                                <td class="w240">
                                    <?php foreach(_g('value')->s2pnsplit2($jobData['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;<?php } ?>
                                </td>
                                <td class="ftb w80">招聘人数</td>
                                <td class="w160"><?php prt($jobData['pnum']); ?></td>
                            </tr>
                            <tr>
                                <td class="ftb w80">工作年限</td>
                                <td class="w160"><?php prt(_g('cache')->selectitem('101>'.$jobData['workyear'].'>sname')); ?></td>
                                <td class="ftb w80">语言要求</td>
                                <td class="w240">
                                    <?php foreach(_g('value')->s2pnsplit2($jobData['language']) as $v){ ?>
                                        <?php prt(_g('cache')->selectitem('112>'.$v.'>sname')); ?>&nbsp;
                                    <?php } ?>
                                </td>
                                <td class="ftb w80">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;历</td>
                                <td class="w160"><?php prt(_g('cache')->selectitem('111>'.$jobData['degree'].'>sname')); ?></td>
                            </tr>
                            <tr>
                                <td class="ftb w80">薪资范围</td>
                                <td class="w160"><?php prt(_g('cache')->selectitem('116>'.$jobData['wage'].'>sname')); ?>/<?php prt($JMODEL->wagetypeName(_g('cache')->selectitem('108>'.$jobData['wagetype'].'>flag'))); ?></td>
                                <td class="ftb w80"></td>
                                <td class="w240"></td>
                                <td class="ftb w80"></td>
                                <td class="w160"></td>
                            </tr>
                        </table>

                        <p>
                            <?php prt($jobData['content']); ?>
                        </p>
                    </div>               
                </div>
               <div class="tab-pane fade" id="ios">
                    <div class="zh-list container-fluid zh-maxbox">
                        <p>
                            <?php prt($cUserData['cdescription']); ?>
                        </p>
                    </div>
               </div>
            </div>

            <div class="zh-company-job-btn text-center">
                <!--<a class="btn btn-info" href="--><?php //prt(_g('uri')->su('job/ac/company/op/jobstep/id/' . _get('id') . '/jobid/' . $jobid)); ?><!--" role="button">学习方案</a>-->
                <!--<a class="btn btn-info" href="--><?php //prt(_g('uri')->su('job/ac/material')); ?><!--" role="button">学习资料</a>-->
                <a class="btn btn-info" href="<?php prt(_g('uri')->su('job/ac/company/op/exam/id/' . _get('id') . '/jobid/' . $jobid)); ?>">我要测评</a>
                <a class="btn btn-info" href="#" onclick="return _requestJobReady(this);" role="button">提递简历</a>

            </div>

        </div>
    </div>
</div>



<form method="post" onsubmit="return false;" id="form_request" _ready="<?php prt(_g('uri')->su('job/ac/request/op/ready')); ?>" _do="<?php prt(_g('uri')->su('job/ac/request/op/do')); ?>"><input type="hidden" name="jobid" value="<?php prt($jobid)?>" /><input type="hidden" name="resumeid" /><input type="hidden" name="recordid" /></form>


    

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->
<!-- job-company-job// -->
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/request.js"></script>
<script language="javascript">
    $("#job-company-job").cjslip({ speed: 0, eventType: 'click', mainEl: '.bd', mainState: '.hd em' });
</script>


</html>