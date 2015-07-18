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

            <!-- //引入nav-tips  template/job/job-nav.php -->
            <?php _g('module')->trigger('job', 'model', null, 'nav', 'learn-nav'); ?>
            <!-- 引入nav-tips// -->

            <div class="zh-list container-fluid">
                <div class="row zh-row">
                    <div class="col-xs-1">
                        <div class="zh-list-title">行业分类：</div>
                    </div>
                    <div class="col-xs-11">
                        <!-- <div class="col-xs-2"> -->
                        <a <?php prt($spid == 'a' ? 'class="zh-active zh-list-tips-right"' : 'class="zh-font-grey zh-list-tips-right"'); ?> href="<?php prt(_g('uri')->su('job/ac/learn/')); ?>">全部</a>
                        <!-- </div>	 -->
                        <!-- <div class="row"> -->
                        <?php foreach($parentResult as $value){ ?>
                            <!-- <div class="col-xs-2 zh-list-tips-div"> -->
                            <a <?php prt($spid == $value['sortid'] ? 'class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                            <!-- </div> -->
                        <?php } ?>
                        <!-- </div>	 -->
                    </div>
                </div>
                <hr class="zh-hr" />
                <div class="row">
                    <div class="col-xs-1">
                        <div class="zh-list-title">职位分类：</div>
                    </div>
                    <div class="col-xs-11">
                        <a <?php prt($scid == 'a' ? 'class="zh-active zh-list-tips-right"' : 'class="zh-font-grey zh-list-tips-right"'); ?> href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . $spid . '/scid/a')); ?>">全部</a>
                        <?php foreach($childResult as $child){ ?>
                            <a <?php prt($scid == $child['sortid'] ? 'class="class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="well zh-list-well">
                <span class="zh-list-icon"><a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" class="zh-active"><i class="fa fa-clock-o"></i> 最新</a></span>
                <span class="zh-list-icon"><a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>"><i class="fa  fa-fire"></i> 人气</a></span>
                <span class="zh-list-icon"><a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>" ><i class="fa fa-link"></i> 相关</a></span>
            </div>


            <!-- 职位详情 -->
            <div class="row">
                <?php if($pageData['total'] >= 1){ ?>
                    <?php while($rs = _g('db')->result($dataResult)){ ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="zh-learn-div">
                                <div class="media">
                                    <div class="media-left media-middle zh-learn-imgbox">
                                        <a href="<?php prt(_g('uri')->su('job/ac/learn/op/view/jobid/' . $rs['jobid'])); ?>" target="_blank">
                                            <img class="zh-learn-img" src="<?php prt($CUSER->logo(my_array_value('logo', $CUSER->find_jion('a.cuid', $rs['cuid'])))); ?>" alt="<?php prt($rs['jname']); ?>" style="width: 100px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="<?php prt(_g('uri')->su('job/ac/learn/op/view/jobid/' . $rs['jobid'])); ?>" target="_blank"><?php prt($rs['jname']); ?></a><span class="zh-learn-tips">(共有<em><?php prt($JSKILL->count('jobid', $rs['jobid'])); ?></em>项)</span></h4>
                                    </div>
                                </div>
                                <div class="zh-learn-desription">
                                    <?php prt(my_substr(strip_tags($rs['content']), 0, 60)); ?>...
                                </div>
                                <a href="<?php prt(_g('uri')->su('job/ac/learn/op/view/jobid/' . $rs['jobid'])); ?>" target="_blank" class="zh-learn-view-a">
                                    <div class="zh-learn-view">
                                        <span>我要认证</span><i class="fa fa-arrow-circle-o-right fa-lg"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{ ?>
                    <div class="container-fluid">
                        <div class="alert alert-warning" role="alert">对不起，暂无该内容信息！</div>
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