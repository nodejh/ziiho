<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>

<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/assess_zhezhao.css" />


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
            <?php
            $a = ms_JobList(null, 1);
            var_dump($a);
            ?>
            <div class="row" id="assess">
                <?php $list = ms_JobList(); ?>
                <?php if (count($list) > 0) { ?>

                    <?php foreach($list as $key => $v) { ?>

                        <div class="col-sm-6 col-md-3">
                            <div class="pbBox">
                                <div class="imgArea">
                                    <a href="#" ><span class="blackBg">公司名称</span><span class="likeIcon"></span></a>

                                    <h3 class="title">
                                        <a href="<?php prt($v['detailUrl']); ?>">
                                            <?php prt($v['cuser']['cname']); ?>
                                        </a>
                                    </h3>

                                    <h4 class="txtArea">
                                        <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>" target="_blank"><?php prt($val['jname']); ?></a>
                                        <p class="zh-learn-tips"><?php prt($JMODEL->sortValue($val['sortid'], 'sname')); ?></p>
                                    </h4>
                                    <div class="zh-learn-desription zh-assess-description">
                                        工作地点:<?php foreach(_g('value')->s2pnsplit2($val['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;<?php } ?><br>
                                        薪资:20万<br>
                                        招聘人数:10<br>
                                        工作年限:2年以上<br>
                                        学历要求:本科及以上<br>
                                    </div>
                                </div>

                                <!--遮罩层开始-->
                                <div class="shadeArea">
                                    <div class="shade"></div>
                                    <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>" class="zh-home-zz-a">
                                        <div class="cont">
                                            我要评测
                                        </div>
                                    </a>
                                </div>
                                <!--遮罩层结束-->
                            </div>

                        </div>

                    <?php } ?>

                <?php } else { ?>

                    <br>
                    <div class="container-fluid">
                        <div class="alert alert-warning" role="alert">>_< 拼了命也没有找到相关信息！</div>
                    </div>
                <?php } ?>
            </div>


            <div class="row" id="assess">
                <?php //if($pageData['total'] >= 1){ ?>
                <?php $index = 0; ?>
                    <?php while($val = _g('db')->result($JJOBResult)){ ?>

                        <?php
                        var_dump($val);
                        ?>

                        <div class="col-sm-6 col-md-3">
                            <div class="pbBox">
                                <div class="imgArea">
                                    <a href="#" ><span class="blackBg">公司名称</span><span class="likeIcon"></span></a>

                                        <h3 class="title"><a href=""<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $val['cuid'])); ?>">公司名称</a></h3>

                                    <h4 class="txtArea">
                                        <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>" target="_blank"><?php prt($val['jname']); ?></a>
                                        <p class="zh-learn-tips"><?php prt($JMODEL->sortValue($val['sortid'], 'sname')); ?></p>
                                    </h4>
                                    <div class="zh-learn-desription zh-assess-description">
                                        工作地点:<?php foreach(_g('value')->s2pnsplit2($val['areaid']) as $v){ ?><?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;<?php } ?><br>
                                        薪资:20万<br>
                                        招聘人数:10<br>
                                        工作年限:2年以上<br>
                                        学历要求:本科及以上<br>
                                    </div>
                                </div>

                                <!--遮罩层开始-->
                                <div class="shadeArea">
                                    <div class="shade"></div>
                                    <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $val['cuid'] . '/jobid/' . $val['jobid'])); ?>" class="zh-home-zz-a">
                                        <div class="cont">
                                            我要评测
                                        </div>
                                    </a>
                                </div>
                                <!--遮罩层结束-->
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

<script>

    // 遮罩
    var tt=null;
    $('#assess').cjslip({
        type: 'menu',
        speed: 100,
        mainState: '.pbBox',
        mainEl: ".shadeArea",
        defaultShow: false,
        startFunc: function(i,t,p,pc,o){
            if(o.eq(i).css("position") == "relative" || o.eq(i).css("position") == "absolute"){
            }else{
                o.eq(i).css("position", "relative");
            }
            /*设置遮罩包裹层*/
            o.eq(i).find('.shadeArea').css({
                position: "absolute",
                top: "0px",
                left: "0px",
                width: (o.eq(i).find('.imgArea').outerWidth()) + "px",
                height: (o.eq(i).find('.imgArea').outerHeight()) + "px"
            }).children().css({position: "absolute"});
            o.eq(i).find('.shadeArea').find(".shade").css({
                top: "0px",
                left: "0px",
                width: "100%",
                height: "100%",
                opacity: 0.3
            });
        }
    });
</script>

</html>