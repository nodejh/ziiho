<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php prt(_g('uri')->su('home')); ?>">职乎</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>"><i class="fa fa-home fa-lg"></i></a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-list-ul"></i>  <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu">
                    <li>
                        <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>">
                            首页
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>">
                            学习中心
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('job/ac/company')); ?>">
                            推荐求职
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('job/ac/jianligonglue')); ?>">
                            简历中心
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> 通知
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 通知
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> 通知
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> 通知
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> 通知
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?php prt(_g('uri')->su('user/t/profile')); ?>"><i class="fa fa-user fa-fw"></i> 个人资料</a>
                    </li>
                    <li><a href="<?php prt(_g('uri')->su('user/t/profile')); ?>"><i class="fa fa-gear fa-fw"></i> 设置</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('user')); ?>"><i class="fa fa-dashboard fa-fw"></i> 个人中心</a>
                    </li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('user/t/myauth')); ?>"><i class="fa fa-certificate fa-fw"></i> 我的认证书</a>
                    </li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('user/t/answer')); ?>"><i class="fa fa-newspaper-o fa-fw"></i> 我的答卷</a>
                    </li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('user/t/course')); ?>"><i class="fa fa-book fa-fw"></i> 我的课程</a>
                    </li>
                    <li>
                        <a href="<?php prt(_g('uri')->su('user/t/resume')); ?>"><i class="fa fa-file-text fa-fw"></i> 我的简历</a>
                    </li>
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>-->
<!--                        <ul class="nav nav-second-level">-->
<!--                            <li>-->
<!--                                <a href="flot.html">Flot Charts</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="morris.html">Morris.js Charts</a>-->
<!--                            </li>-->
<!--                        </ul>-->
                        <!-- /.nav-second-level -->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>-->
<!--                        <ul class="nav nav-second-level">-->
<!--                            <li>-->
<!--                                <a href="panels-wells.html">Panels and Wells</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="buttons.html">Buttons</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="notifications.html">Notifications</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="typography.html">Typography</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="icons.html"> Icons</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="grid.html">Grid</a>-->
<!--                            </li>-->
<!--                        </ul>-->
                        <!-- /.nav-second-level -->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>-->
<!--                        <ul class="nav nav-second-level">-->
<!--                            <li>-->
<!--                                <a href="#">Second Level Item</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">Second Level Item</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">Third Level <span class="fa arrow"></span></a>-->
<!--                                <ul class="nav nav-third-level">-->
<!--                                    <li>-->
<!--                                        <a href="#">Third Level Item</a>-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                        <a href="#">Third Level Item</a>-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                        <a href="#">Third Level Item</a>-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                        <a href="#">Third Level Item</a>-->
<!--                                    </li>-->
<!--                                </ul>-->
                                <!-- /.nav-third-level -->
<!--                            </li>-->
<!--                        </ul>-->
                        <!-- /.nav-second-level -->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>-->
<!--                        <ul class="nav nav-second-level">-->
<!--                            <li>-->
<!--                                <a href="blank.html">Blank Page</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="login.html">Login Page</a>-->
<!--                            </li>-->
<!--                        </ul>-->
                        <!-- /.nav-second-level -->
<!--                    </li>-->
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav> <!-- /.Navigation -->