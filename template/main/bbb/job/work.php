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
            <?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>
            <!-- 引入nav-tips// -->

            <div class="zh-list container-fluid">
                <div class="row zh-row">
                    <div class="col-xs-1">
                        <div class="zh-list-title">行业分类：</div>
                    </div>
                    <div class="col-xs-11">
                        <!-- <div class="col-xs-2"> -->
                            <a <?php prt($spid == 'a' ? 'class="zh-active zh-list-tips-right"' : 'class="zh-font-grey zh-list-tips-right"'); ?> href="<?php prt(_g('uri')->su('job/ac/work/')); ?>">全部</a>
                        <!-- </div>  -->
                        <!-- <div class="row"> -->
                            <?php foreach($parentResult as $value){ ?>
                            <!-- <div class="col-xs-2 zh-list-tips-div"> -->
                                <a <?php prt($spid == $value['sortid'] ? 'class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/work/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                            <!-- </div> -->
                            <?php } ?>  
                        <!-- </div>  -->                    
                    </div>
                </div>
                <hr class="zh-hr" />
                <div class="row">
                    <div class="col-xs-1">
                        <div class="zh-list-title">职位分类：</div>
                    </div>
                    <div class="col-xs-11">
                        <a <?php prt($scid == 'a' ? 'class="zh-active zh-list-tips-right"' : 'class="zh-font-grey zh-list-tips-right"'); ?> href="<?php prt(_g('uri')->su('job/ac/work/spid/' . $spid . '/scid/a')); ?>">全部</a>
                        <?php foreach($childResult as $child){ ?>
                            <a <?php prt($scid == $child['sortid'] ? 'class="class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/work/spid/' . $spid . '/scid/' . $child['sortid'])); ?>"><?php prt($child['sname']); ?></a>
                        <?php } ?>              
                    </div>
                </div>
            </div>

            <div class="well zh-list-well">
                <span class="zh-list-icon"><a href="<?php prt(_g('uri')->su('job/ac/work')); ?>" class="zh-active"><i class="fa fa-list"></i> 所有职位</a></span>
                <span class="zh-list-icon"><a href="<?php prt(_g('uri')->su('job/ac/work/t/new')); ?>"><i class="fa fa-clock-o"></i> 最新职位</a></span>
            </div>

            <?php if($pageData['total'] >= 1){ ?>
                <table class="table table-striped table-hover zh-table">
                    <thead>
                      <tr>
                         <th>职位</th>
                         <th>公司</th>
                         <th>地址</th>
                         <th>日期</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($rs = _g('db')->result($JJOBResult)){ ?>
                        <tr>
                            <td>
                                <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $rs['cuid'] . '/jobid/' . $rs['jobid'])); ?>" target="_blank"><?php prt($rs['jname']); ?></a>
                            </td>
                            <td>
                                <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" target="_blank"><?php prt($rs['cname']); ?></a>
                            </td>
                            <td>
                                <?php prt($JMODEL->areaPos($rs['area'], $rs['area_detail'])); ?>
                            </td>
                            <td>
                                <?php prt(person_time($rs['ctime'])); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            <?php }else{ ?>
                <div class="alert alert-warning" role="alert">对不起，暂无该内容信息！</div>
            <?php } ?>
    


    
        </div>
    </div>
</div>



<!-- data of page  -->
<?php _g('module')->trigger('job', 'model', null, 'page', $pageData); ?>

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->

</html>