<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>


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

            <div class="zh-company-job-btn">
                <a class="btn btn-info" href="<?php prt(_g('uri')->su('job/ac/company/op/jobstep/id/' . _get('id') . '/jobid/' . $jobid)); ?>" role="button">学习方案</a>
                <a class="btn btn-info" href="<?php prt(_g('uri')->su('job/ac/material')); ?>" role="button">学习资料</a>
                <a class="btn btn-info" href="<?php prt(_g('uri')->su('job/ac/company/op/jobrz/id/' . _get('id') . '/jobid/' . $jobid)); ?>" role="button">提递简历</a>
            </div>

        </div>
    </div>
</div>

    

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->


</html>