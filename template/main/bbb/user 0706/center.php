<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('user', 'head', true); ?>
<?php include _g('template')->name('user', 'navigation', true); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">个人中心</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-certificate fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">5</div>
                            <div>我的认证书</div>
                        </div>
                    </div>
                </div>
                <a href="<?php prt(_g('uri')->su('user/t/myauth')); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">查看详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-newspaper-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>我的答卷</div>
                        </div>
                    </div>
                </div>
                <a href="<?php prt(_g('uri')->su('user/t/answer')); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">查看详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>我的课程</div>
                        </div>
                    </div>
                </div>
                <a href="<?php prt(_g('uri')->su('user/t/course')); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">查看详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>我的简历</div>
                        </div>
                    </div>
                </div>
                <a href="<?php prt(_g('uri')->su('user/t/resume')); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">查看详情</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o fa-fw"></i> 我的时间轴
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge"><i class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.12 13：05</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>通过职乎找到第一份工作：阿里巴巴.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.12 21：00</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>阿里邀请面试.</p>
                                    <p>面试地点四川省成都市武侯区.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.09 23：03</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>获得了第一份企业认证书：《阿里的认证书》。</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.06 10：00</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>完成了第一份答卷：《PHP面试100问》</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge info"><i class="fa fa-save"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.04 01：00</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>写了我的第一份简历：《应聘前端工程师-小红》.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.02 19：00</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>学习了我的第一门课程：《深入浅出Node.js》</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">2015.06.01 20：00</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>加入职乎开始学习新的东西</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->

        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include _g('template')->name('user', 'footer', true); ?>