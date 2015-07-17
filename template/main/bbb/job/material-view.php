<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>

</head>

<!-- include navbar  -->
<?php include $a = _g('template')->name('newUI', 'common/navbar', true); ?>

<div class="container-fluid zh-mian">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <!-- 路径导航 -->
            <ol class="breadcrumb">
                <li><a href="<?php prt(_g('uri')->su('job/ac/home')); ?>">首页</a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/material')); ?>">学习资料</a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/material/spid/' . my_array_value('sortid', $sortParentData))); ?>"><?php prt(my_array_value('sname', $sortParentData)); ?></a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/material/spid/' . my_array_value('sortid', $sortParentData) . '/scid/' . my_array_value('sortid', $sortData))); ?>"><?php prt(my_array_value('sname', $sortData));?></a></li>
            </ol>

            <div class="row">
                <div class="col-xs-12 col-md-8">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="zh-material-view-title"><i class="fa fa-bookmark-o"></i> <?php prt($materialData['title']); ?></span>
                        </div>
                        <div class="panel-body">
                            <div class="row zh-material-view-survey">
                                <div class="col-xs-6">
                                    <img src="<?php prt($JMODEL->src($materialData['src'])); ?>" class="zh-material-view-img" />
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <p>
                                                作者：<?php prt($materialData['author']); ?>
                                            </p>
                                            <p>
                                                副标题：<?php prt($materialData['subtitle']); ?>
                                            </p>
                                            <p>
                                                出版社：<?php prt($materialData['publish']); ?>
                                            </p>
                                        </div>
                                        <div class="col-xs-6">
                                            <p>
                                                阅读地址：<a href="<?php prt($materialData['viewurl']); ?>" target="_blank">查看</a>
                                            </p>
                                            <p>
                                                录入时间：<?php prt(person_time($materialData['ctime'])); ?>
                                            </p>
                                            <p>
                                                出版时间：<?php prt($materialData['publishdate']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="zh-material-viewbtn">
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#classModal">去上课<i class="fa fa-external-link"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default zh-material-view-content">
                        <div class="panel-heading">
                            <h3 class="panel-title">内容介绍</h3>
                        </div>
                        <div class="panel-body">
                            <?php prt($materialData['description']); ?>
                        </div>
                    </div>
                    <!--高速版-->
                    <div id="SOHUCS"></div>
                    <script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
                    <script type="text/javascript">
                        window.changyan.api.config({
                            appid: 'cyrO3idHG',
                            conf: 'prod_e4c50199345d897e8ff5079de538d49b'
                        });
                    </script>

                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">相关课程</h3>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <?php while($rs = _g('db')->result($relateResult)){ ?>
                                    <li><a href="<?php prt(_g('uri')->su('job/ac/material/op/view/id/' . $rs['materialid'])); ?>"><?php prt($rs['title']); ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

</div>



<div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php prt($materialData['title']); ?></h4>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>




<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->

</html>