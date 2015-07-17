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
                            <a <?php prt($spid == 'a' ? 'class="zh-active zh-list-tips-right"' : 'class="zh-font-grey zh-list-tips-right"'); ?> href="<?php prt(_g('uri')->su('job/ac/companys/')); ?>">全部</a>
                        <!-- </div>  -->
                        <!-- <div class="row"> -->
                            <?php foreach($parentResult as $value){ ?>
                            <!-- <div class="col-xs-2 zh-list-tips-div"> -->
                                <a <?php prt($spid == $value['sortid'] ? 'class="zh-active zh-list-tips"' : 'class="zh-font-grey zh-list-tips"'); ?> href="<?php prt(_g('uri')->su('job/ac/companys/spid/' . $value['sortid'])); ?>"><?php prt($value['sname']); ?></a>
                            <!-- </div> -->
                            <?php } ?>  
                        <!-- </div>  -->                    
                    </div>
                </div>
            </div>

            <br/>
            <?php if($pageData['total'] >= 1){ ?>
                <table class="table table-striped table-hover zh-table">
                   <thead>
                      <tr>
                         <th>公司</th>
                         <th>简介</th>
                         <th>行业</th>
                         <th>地址</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($rs = _g('db')->result($compayResult)){ ?>
                        <tr>
                            <td>
                                <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" target="_blank"><?php prt($rs['cname']); ?></a>
                            </td>
                            <td>
                                <?php prt(my_substr($rs['cdescription'], 0, 40)); ?>...
                            </td>
                            <td>
                                <?php prt($JMODEL->sortShow($rs['csortid'], 'sname')); ?>
                            </td>
                            <td>
                                <?php prt($JMODEL->areaPos($rs['area'], $rs['area_detail'])); ?>
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