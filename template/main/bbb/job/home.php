<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'home_nav2', true); ?>




    <link href="<?php  prt(_g('template')->dir('newUI')); ?>/utils/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!-- fontawsome -->
    <link href="<?php  prt(_g('template')->dir('newUI')); ?>/utils/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="<?php  prt(_g('template')->dir('newUI')); ?>/assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/over.css" />


    <!-- //banner -->
<div class="banner clearfix" id="banner">

    <div class="bd clearfix">
        <div class="shadow clearfix"></div>
        <ul class="box clearfix">
            <li class="clearfix"><img
                   class="zh-home-img" src="<?php prt(_g('template')->dir('job')); ?>/image/f/index-header-bg2.jpg" /></li>
            <li class="clearfix"><img
                   class="zh-home-img" src="<?php prt(_g('template')->dir('job')); ?>/image/f/index-header-bg3.jpg" /></li>
        </ul>
    </div>

    <div class="cbox clearfix">

        <div class="col-xs-10 zh-home-search">
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle zh-home-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    行业 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Web前段</a></li>
                    <li><a href="#">后端</a></li>
                    <li><a href="#">IOS</a></li>
                    <li><a href="#">安卓</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle zh-home-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    职位 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Web前段</a></li>
                    <li><a href="#">后端</a></li>
                    <li><a href="#">IOS</a></li>
                    <li><a href="#">安卓</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle zh-home-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    地点 <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">成都</a></li>
                    <li><a href="#">北京</a></li>
                </ul>
            </div>

            <div class="input-group zh-home-search-input">
                <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon2">
                <span class="input-group-addon" id="basic-addon2">搜索</span>
            </div>
        </div>

        <!--<div class="z bi clearfix">-->
        <!--    <a href="--><?php //prt(_g('uri')->su('job/ac/assess')); ?><!--" class="color-white"><div class="aa clearfix color-background">职业测评</div></a>-->
        <!--    <div class="bb clearfix">Assessment Center</div>-->
        <!--    <div class="cc clearfix">职位技能、素养在线测试和评估</div>-->
        <!--</div>-->
        <!---->
        <!--<div class="y bi clearfix">-->
        <!--    <a href="--><?php //prt(_g('uri')->su('job/ac/work')); ?><!--" class="color-white"><div class="aa clearfix color-background">推荐求职</div></a>-->
        <!--    <div class="bb clearfix">JOB CENTER</div>-->
        <!--    <div class="cc clearfix">大数据智能推荐求职系统</div>-->
        <!--</div>-->
    </div>

</div>
<!-- banner// -->



    <div class="container">
<!-- //main -->
<div class="main clearfix">
    <!-- //i-area -->
    <div class="i-area clearfix">

        <div class="i-box i-box-bline clearfix">
            <div class="z i-box-bd o-home-div clearfix">
                <div class="i-box-bd-a clearfix">职业测评</div>
                <div class="i-box-bd-b clearfix">(Assessment Center)</div>
                <div class="i-box-bd-c zh-i-box-c clearfix">
                    <p>专业的职业技能、罗辑思维、职业素养和职业性格测评系统。不仅能根据测评结果智能推荐求职，还能帮助您更好地帮助您了解自己的职业优劣势。</p>
                </div>
                <div class="i-box-bd-d clearfix"></div>
            </div>
            <div class="z i-box-hd o-home-div clearfix">
                <div class="icons icon-rz clearfix"></div>
            </div>
        </div>
        <div class="clear"></div>


        <div class="i-box i-box-bline clearfix">
            <div class="z i-box-hd o-home-div clearfix">
                <div class="icons icon-job clearfix"></div>
            </div>

            <div class="z i-box-bd o-home-div clearfix">
                <div class="i-box-bd-a clearfix">推荐求职</div>
                <div class="i-box-bd-b clearfix">(JOB CENTER)</div>
                <div class="i-box-bd-c zh-i-box-c clearfix">
                    <p>大数据推荐系统，根据测评结果和简历内容，智能化的将求职责推荐给招聘企业。</p>
                </div>
                <div class="i-box-bd-d clearfix"></div>
            </div>
        </div>
        <div class="clear"></div>

        <!---->
        <!--<div class="i-box i-box-bline clearfix">-->
        <!--    <div class="z i-box-hd clearfix">-->
        <!--        <div class="icons icon-us clearfix"></div>-->
        <!--    </div>-->
        <!---->
        <!--    <div class="z i-box-bd clearfix">-->
        <!--        <div class="i-box-bd-a clearfix">关于我们</div>-->
        <!--        <div class="i-box-bd-b clearfix">(ABOUT US)</div>-->
        <!--        <div class="i-box-bd-c clearfix">-->
        <!--            <p>“职乎”是成都罗比雷尔科技有限公司为求职者和招聘企业量身打造的智能化推荐求职平台。</p>-->
        <!--            <p>“职乎”为求职者做出职业能力的评估，根据评估结果和简历内容，智能地向招聘企业推荐求职者。减少筛选简历、笔试的复杂程序。</p>-->
        <!--        </div>-->
        <!--        <div class="i-box-bd-d clearfix">-->
        <!--            <div class="us-info clearfix">-->
        <!--                <p>-->
        <!--                    <em class="ns-c1">E-mail:</em><em class="ns-c2"> rbb@rubyrare.com</em>-->
        <!--                    <em class="ns-c1 ns-ml1">Tel:</em><em class="ns-c2"> 028 --->
        <!--                        00000000</em>-->
        <!--                </p>-->
        <!--                <p>-->
        <!--                    <em class="ns-c1">Address:</em><em class="ns-c2"> 四川 - 成都</em>-->
        <!--                </p>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="clear"></div>-->
        <!---->
        <!---->
        <!--<div class="i-box i-box-bline clearfix">-->
        <!--    <div class="z i-box-hd clearfix">-->
        <!--        <div class="icons icon-us clearfix"></div>-->
        <!--    </div>-->
        <!---->
        <!--    <div class="z i-box-bd clearfix">-->
        <!--        <div class="i-box-bd-a clearfix">联系我们</div>-->
        <!--        <div class="i-box-bd-b clearfix">(CONTACT US)</div>-->
        <!--        <div class="i-box-bd-c clearfix">-->
        <!--            <p>欢迎希望合作的企事业单位、愿意加入公司团队的求职者联系我们。</p>-->
        <!--        </div>-->
        <!--        <div class="i-box-bd-d clearfix">-->
        <!--            <div class="us-info clearfix">-->
        <!--                <p>-->
        <!--                    <em class="ns-c1">邮箱:</em><em class="ns-c2"> rbb@rubyrare.com</em>-->
        <!--                    <em class="ns-c1 ns-ml1">电话:</em><em class="ns-c2"> 028-65273344</em>-->
        <!--                </p>-->
        <!--                <p>-->
        <!--                    <em class="ns-c1">地址:</em><em class="ns-c2"> 四川 - 成都</em>-->
        <!--                </p>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="clear"></div>-->



    </div>
    <!-- i-area// -->
</div>
<div class="clear"></div>
<!-- main// -->



<!--职位部分-->
    <div class="row">
        <?php $index = 0; ?>
        <?php while($val = _g('db')->result($JJOBResult)){ ?>
            <div class="col-sm-6 col-md-3">
                <div class="zh-learn-div">
                    <div class="media">
                        <div class="media-left media-middle zh-learn-imgbox">
                            <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $val['cuid'])); ?>" target="_blank">
                                <span class="zh-assess-company-name">公司名称</span>
                                <!--<img class="zh-learn-img" src="--><?php //prt($CUSER->getLogo($val['cuid'])); ?><!--" alt="--><?php //prt($rs['jname']); ?><!--" style="width: 100px;">-->
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
                        薪资:20万<br>
                        招聘人数:10<br>
                        工作年限:2年以上<br>
                        学历要求:本科及以上<br>
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
    </div>

    <br><br>
    <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="zh-learn-div">
                    <div class="media">
                        <div class="media-left media-middle zh-learn-imgbox">
                            <a href="#" target="_blank">
                                <span class="zh-assess-company-name">公司名称</span>
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="#" target="_blank">职位标题</a>
                                <p class="zh-learn-tips">职位标题副</p>
                            </h4>
                        </div>
                    </div>
                    <div class="zh-learn-desription zh-assess-description">
                        工作地点:
                        成都市武侯区
                        <br>
                        薪资:20万<br>
                        招聘人数:10<br>
                        工作年限:2年以上<br>
                        学历要求:本科及以上<br>
                    </div>

                    <a href="#" target="_blank" class="zh-learn-view-a">
                        <div class="zh-learn-view">
                            <span>我要测评</span><i class="fa fa-arrow-circle-o-right fa-lg"></i>
                        </div>
                    </a>
                </div>
            </div>

        <div class="col-sm-6 col-md-3">
            <div class="zh-learn-div">
                <div class="media">
                    <div class="media-left media-middle zh-learn-imgbox">
                        <a href="#" target="_blank">
                            <span class="zh-assess-company-name">公司名称</span>
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="#" target="_blank">职位标题</a>
                            <p class="zh-learn-tips">职位标题副</p>
                        </h4>
                    </div>
                </div>
                <div class="zh-learn-desription zh-assess-description">
                    工作地点:
                    成都市武侯区
                    <br>
                    薪资:20万<br>
                    招聘人数:10<br>
                    工作年限:2年以上<br>
                    学历要求:本科及以上<br>
                </div>

                <a href="#" target="_blank" class="zh-learn-view-a">
                    <div class="zh-learn-view">
                        <span>我要测评</span><i class="fa fa-arrow-circle-o-right fa-lg"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="zh-learn-div">
                <div class="media">
                    <div class="media-left media-middle zh-learn-imgbox">
                        <a href="#" target="_blank">
                            <span class="zh-assess-company-name">公司名称</span>
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="#" target="_blank">职位标题</a>
                            <p class="zh-learn-tips">职位标题副</p>
                        </h4>
                    </div>
                </div>
                <div class="zh-learn-desription zh-assess-description">
                    工作地点:
                    成都市武侯区
                    <br>
                    薪资:20万<br>
                    招聘人数:10<br>
                    工作年限:2年以上<br>
                    学历要求:本科及以上<br>
                </div>

                <a href="#" target="_blank" class="zh-learn-view-a">
                    <div class="zh-learn-view">
                        <span>我要测评</span><i class="fa fa-arrow-circle-o-right fa-lg"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="zh-learn-div">
                <div class="media">
                    <div class="media-left media-middle zh-learn-imgbox">
                        <a href="#" target="_blank">
                            <span class="zh-assess-company-name">公司名称</span>
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="#" target="_blank">职位标题</a>
                            <p class="zh-learn-tips">职位标题副</p>
                        </h4>
                    </div>
                </div>
                <div class="zh-learn-desription zh-assess-description">
                    工作地点:
                    成都市武侯区
                    <br>
                    薪资:20万<br>
                    招聘人数:10<br>
                    工作年限:2年以上<br>
                    学历要求:本科及以上<br>
                </div>

                <a href="#" target="_blank" class="zh-learn-view-a">
                    <div class="zh-learn-view">
                        <span>我要测评</span><i class="fa fa-arrow-circle-o-right fa-lg"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>

<?php include _g('template')->name('job', 'footer', true); ?>


<script language="javascript">
    $(document).ready(function(e) {
        var _ms = {"w": 1920, "h": 900};
        var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight")};
        //var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
        var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h) * 0.7};

        var _bannero = $("#banner");
        _bannero.width(_ss.w).height(_ss.h);
        _bannero.find(".bd .box li img").width(_ss.w).height(_ss.h);
        _bannero.find(".cbox").css({"left": (((_cs.w - 1200) / 2) + "px"), "top": ((_ss.h / 2) - 150) + "px"}).show();
    });

    var _bannerContItem = $("#banner").find(".cbox").find(".bi");
    /* 头部切换 */
    $("#banner").cjslip({
        autoPlay: true,
        loop: true,
        effect: 'left',
        mainEl: '.bd .box',
        mPrev: ".prev",
        delayTime: 5000,
        mNext: ".next",
        mainState: '.hd .box li',
        startFunc: function(i){

        },
        completeFunc: function(i, total, page, pageTotal, mainState, pageState, scrollEl, mainEl){
            _bannerContItem.stop(true, true);
            _bannerContItem.not(":eq(" + i + ")").hide();
            _bannerContItem.eq(i).show();

            mainState.not(":eq(" + i + ")").css("opacity", 0.5);
            mainState.eq(i).css("opacity", "");
        }
    });
</script>
    <script src="<?php  prt(_g('template')->dir('newUI')); ?>/utils/bootstrap-3.3.4/js/bootstrap.min.js"></script>

<?php include _g('template')->name('@', 'footer', true); ?>