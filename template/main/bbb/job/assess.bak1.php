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



            <!-- //com-bar -->
            <ul class="nav nav-tabs">
                <li role="presentation"  class="active">
                    <a href="#" class="zh-font-h3 zh-bgcolor-whitegrey"  >认证中心</a>
                </li>
            </ul>
            <!-- com-bar// -->

            <div class="zh-list container-fluid">
                <div class="row zh-row">
                    <div class="col-xs-1">
                        <div class="zh-list-title">行业分类：</div>
                    </div>
                    <div class="col-xs-11">
                        <!-- <div class="col-xs-2"> -->
                        <?php foreach($parentResult as $value){ ?>
                            <a <?php prt($spid == $value['sortid'] ? 'class="on zh-active zh-list-tips-right"' : 'class="zh-font-grey zh-list-tips-right"'); ?> href="<?php prt(_g('uri')->su('job/ac/assess/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                        <?php } ?>
                    </div>
                </div>
                <hr class="zh-hr" />
                <div class="row">
                    <div class="col-xs-1">
                        <div class="zh-list-title">职位分类：</div>
                    </div>
                    <div class="col-xs-11">
                        <a <?php prt($scid == 'a' ? 'class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/assess/spid/' . $spid . '/scid/a')); ?>">全部</a>
                        <?php foreach($childResult as $child){ ?>
                            <a <?php prt($scid == $child['sortid'] ? 'class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/assess/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <br>
            <!-- 职位详情 -->
            <div class="row">
                <?php //if($pageData['total'] >= 1){ ?>
                <?php $index = 0; ?>
                    <?php while($val = _g('db')->result($JJOBResult)){ ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="zh-learn-div">
                                <div class="media">
                                    <div class="media-left media-middle zh-learn-imgbox">
                                        <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $val['cuid'])); ?>" target="_blank">
                                            <img class="zh-learn-img" src="<?php prt($CUSER->getLogo($val['cuid'])); ?>" alt="<?php prt($rs['jname']); ?>" style="width: 100px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>" target="_blank"><?php prt($val['jname']); ?></a>
                                            <p class="zh-learn-tips"><?php prt($JMODEL->sortValue($val['sortid'], 'sname')); ?></p>
                                            </h4>
                                    </div>
                                </div>
                                <div class="zh-learn-desription zh-assess-description">
                                    工作地点:
                                    <?php foreach(_g('value')->s2pnsplit2($val['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;<?php } ?>
                                    <br>

                                    <?php foreach(_g('value')->s2pnsplit2($val['benefit']) as $v){ ?>
                                        <span class="label label-success"><?php prt(_g('cache')->selectitem('121>'.$v.'>sname')); ?></span>
                                    <?php } ?>
                                </div>

                                <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>" target="_blank" class="zh-learn-view-a">
                                    <div class="zh-learn-view">
                                        <span>我要测评</span><i class="fa fa-arrow-circle-o-right fa-lg"></i>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <?php $index = $index + 1; ?>
                    <?php } ?>
                <?php //}else{ ?>
                <!--    <div class="container-fluid">-->
                <!--        <div class="alert alert-warning" role="alert">对不起，暂无该内容信息！</div>-->
                <!--    </div>-->
                <?php //} ?>



                <?php if($index < 1){ ?>
                    <br>
                    <div class="container-fluid">
                        <div class="alert alert-warning" role="alert">>_< 拼了命也没有找到相关信息！</div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</div>

<!-- data of page  -->
<?php _g('module')->trigger('job', 'model', null, 'page', $pageData); ?>

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->

</html>