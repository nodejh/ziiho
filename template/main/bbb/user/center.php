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
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">-->
<!--                    <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example-->
<!--                    <div class="pull-right">-->
<!--                        <div class="btn-group">-->
<!--                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">-->
<!--                                Actions-->
<!--                                <span class="caret"></span>-->
<!--                            </button>-->
<!--                            <ul class="dropdown-menu pull-right" role="menu">-->
<!--                                <li><a href="#">Action</a>-->
<!--                                </li>-->
<!--                                <li><a href="#">Another action</a>-->
<!--                                </li>-->
<!--                                <li><a href="#">Something else here</a>-->
<!--                                </li>-->
<!--                                <li class="divider"></li>-->
<!--                                <li><a href="#">Separated link</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- /.panel-heading -->
<!--                <div class="panel-body">-->
<!--                    <div id="morris-area-chart"></div>-->
<!--                </div>-->
                <!-- /.panel-body -->
<!--            </div>-->
            <!-- /.panel -->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">-->
<!--                    <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example-->
<!--                    <div class="pull-right">-->
<!--                        <div class="btn-group">-->
<!--                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">-->
<!--                                Actions-->
<!--                                <span class="caret"></span>-->
<!--                            </button>-->
<!--                            <ul class="dropdown-menu pull-right" role="menu">-->
<!--                                <li><a href="#">Action</a>-->
<!--                                </li>-->
<!--                                <li><a href="#">Another action</a>-->
<!--                                </li>-->
<!--                                <li><a href="#">Something else here</a>-->
<!--                                </li>-->
<!--                                <li class="divider"></li>-->
<!--                                <li><a href="#">Separated link</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- /.panel-heading -->
<!--                <div class="panel-body">-->
<!--                    <div class="row">-->
<!--                        <div class="col-lg-4">-->
<!--                            <div class="table-responsive">-->
<!--                                <table class="table table-bordered table-hover table-striped">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>#</th>-->
<!--                                        <th>Date</th>-->
<!--                                        <th>Time</th>-->
<!--                                        <th>Amount</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr>-->
<!--                                        <td>3326</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>3:29 PM</td>-->
<!--                                        <td>$321.33</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3325</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>3:20 PM</td>-->
<!--                                        <td>$234.34</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3324</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>3:03 PM</td>-->
<!--                                        <td>$724.17</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3323</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>3:00 PM</td>-->
<!--                                        <td>$23.71</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3322</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>2:49 PM</td>-->
<!--                                        <td>$8345.23</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3321</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>2:23 PM</td>-->
<!--                                        <td>$245.12</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3320</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>2:15 PM</td>-->
<!--                                        <td>$5663.54</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                        <td>3319</td>-->
<!--                                        <td>10/21/2013</td>-->
<!--                                        <td>2:13 PM</td>-->
<!--                                        <td>$943.45</td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>-->
                            <!-- /.table-responsive -->
<!--                        </div>-->
                        <!-- /.col-lg-4 (nested) -->
<!--                        <div class="col-lg-8">-->
<!--                            <div id="morris-bar-chart"></div>-->
<!--                        </div>-->
                        <!-- /.col-lg-8 (nested) -->
<!--                    </div>-->
                    <!-- /.row -->
<!--                </div>-->
                <!-- /.panel-body -->
<!--            </div>-->
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
<!--                                    <hr>-->
<!--                                    <div class="btn-group">-->
<!--                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">-->
<!--                                            <i class="fa fa-gear"></i>  <span class="caret"></span>-->
<!--                                        </button>-->
<!--                                        <ul class="dropdown-menu" role="menu">-->
<!--                                            <li><a href="#">Action</a>-->
<!--                                            </li>-->
<!--                                            <li><a href="#">Another action</a>-->
<!--                                            </li>-->
<!--                                            <li><a href="#">Something else here</a>-->
<!--                                            </li>-->
<!--                                            <li class="divider"></li>-->
<!--                                            <li><a href="#">Separated link</a>-->
<!--                                            </li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
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
<!--        <div class="col-lg-4">-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">-->
<!--                    <i class="fa fa-bell fa-fw"></i> 消息中心-->
<!--                </div>-->
                <!-- /.panel-heading -->
<!--                <div class="panel-body">-->
<!--                    <div class="list-group">-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-comment fa-fw"></i> 企业甲看了你的简历-->
<!--                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-twitter fa-fw"></i> 获得一份认证书-->
<!--                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-envelope fa-fw"></i> 课程有更新-->
<!--                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-tasks fa-fw"></i> 邀请你面试-->
<!--                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-upload fa-fw"></i> 学完PHP课程-->
<!--                                    <span class="pull-right text-muted small"><em>11:32 AM</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-bolt fa-fw"></i> 学习了java课程-->
<!--                                    <span class="pull-right text-muted small"><em>11:13 AM</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-warning fa-fw"></i> 学完PHP课程-->
<!--                                    <span class="pull-right text-muted small"><em>10:57 AM</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-shopping-cart fa-fw"></i> 学习了java课程-->
<!--                                    <span class="pull-right text-muted small"><em>9:49 AM</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                        <a href="#" class="list-group-item">-->
<!--                            <i class="fa fa-money fa-fw"></i> 学习了java课程-->
<!--                                    <span class="pull-right text-muted small"><em>Yesterday</em>-->
<!--                                    </span>-->
<!--                        </a>-->
<!--                    </div>-->
                    <!-- /.list-group -->
<!--                    <a href="#" class="btn btn-default btn-block">View All Alerts</a>-->
<!--                </div>-->
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">-->
<!--                    <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    <div id="morris-donut-chart"></div>-->
<!--                    <a href="#" class="btn btn-default btn-block">View Details</a>-->
<!--                </div>-->
                <!-- /.panel-body -->
<!--            </div>-->
            <!-- /.panel -->
<!--            <div class="chat-panel panel panel-default">-->
<!--                <div class="panel-heading">-->
<!--                    <i class="fa fa-comments fa-fw"></i>-->
<!--                    Chat-->
<!--                    <div class="btn-group pull-right">-->
<!--                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">-->
<!--                            <i class="fa fa-chevron-down"></i>-->
<!--                        </button>-->
<!--                        <ul class="dropdown-menu slidedown">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-refresh fa-fw"></i> Refresh-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-check-circle fa-fw"></i> Available-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-times fa-fw"></i> Busy-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-clock-o fa-fw"></i> Away-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="divider"></li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-sign-out fa-fw"></i> Sign Out-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- /.panel-heading -->
<!--                <div class="panel-body">-->
<!--                    <ul class="chat">-->
<!--                        <li class="left clearfix">-->
<!--                                    <span class="chat-img pull-left">-->
<!--                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />-->
<!--                                    </span>-->
<!--                            <div class="chat-body clearfix">-->
<!--                                <div class="header">-->
<!--                                    <strong class="primary-font">Jack Sparrow</strong>-->
<!--                                    <small class="pull-right text-muted">-->
<!--                                        <i class="fa fa-clock-o fa-fw"></i> 12 mins ago-->
<!--                                    </small>-->
<!--                                </div>-->
<!--                                <p>-->
<!--                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li class="right clearfix">-->
<!--                                    <span class="chat-img pull-right">-->
<!--                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />-->
<!--                                    </span>-->
<!--                            <div class="chat-body clearfix">-->
<!--                                <div class="header">-->
<!--                                    <small class=" text-muted">-->
<!--                                        <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>-->
<!--                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>-->
<!--                                </div>-->
<!--                                <p>-->
<!--                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li class="left clearfix">-->
<!--                                    <span class="chat-img pull-left">-->
<!--                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />-->
<!--                                    </span>-->
<!--                            <div class="chat-body clearfix">-->
<!--                                <div class="header">-->
<!--                                    <strong class="primary-font">Jack Sparrow</strong>-->
<!--                                    <small class="pull-right text-muted">-->
<!--                                        <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>-->
<!--                                </div>-->
<!--                                <p>-->
<!--                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                        <li class="right clearfix">-->
<!--                                    <span class="chat-img pull-right">-->
<!--                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />-->
<!--                                    </span>-->
<!--                            <div class="chat-body clearfix">-->
<!--                                <div class="header">-->
<!--                                    <small class=" text-muted">-->
<!--                                        <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>-->
<!--                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>-->
<!--                                </div>-->
<!--                                <p>-->
<!--                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
                <!-- /.panel-body -->
<!--                <div class="panel-footer">-->
<!--                    <div class="input-group">-->
<!--                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />-->
<!--                                <span class="input-group-btn">-->
<!--                                    <button class="btn btn-warning btn-sm" id="btn-chat">-->
<!--                                        Send-->
<!--                                    </button>-->
<!--                                </span>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- /.panel-footer -->
<!--            </div>-->
            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php include _g('template')->name('user', 'footer', true); ?>