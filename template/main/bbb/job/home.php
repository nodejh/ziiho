<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'home_nav2', true); ?>


    <!-- fontawsome -->
    <link href="<?php  prt(_g('template')->dir('newUI')); ?>/utils/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- custom css -->
    <link href="<?php  prt(_g('template')->dir('newUI')); ?>/assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('@')); ?>/css/over.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home_search.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home_zhezhao.css" />


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


    <div class="zh-home-title-div clearfix">
        <button class="btn btn-default btn-lg zh-home-title" type="button">
            欢迎评测
        </button>
        <h4 class="zh-home-subtitle">
            向超过20000位求职者提供专业的评测。
        </h4>
    </div>

    <div class="cbox clearfix">
        <div id="nav">
            <form id="i_search" action="#" method="post" autocomplete="off">
                <ul>
                    <li>
                        <s><i></i><u></u>行业</s>
                        <div>
                            <input type="hidden" name="room"/>
                            <span><a data-val="" href="javascript:void(0)">全部</a></span>
                            <span><a data-val="1" href="javascript:" >计算机</a></span>
                            <span><a data-val="2" href="javascript:" >互联网</a></span>
                            <span><a data-val="3" href="javascript:" >互联网</a></span>
                            <span><a data-val="4" href="javascript:" >互联网</a></span>
                            <span><a data-val="5" href="javascript:" >互联网</a></span>
                        </div>
                    </li>
                    <li id="wy">
                        <s><i></i><u></u>职位</s>
                        <div class="m_sp">
                            <input type="hidden" name="area" value=""/>
                            <span><a data-val="" href="javascript:">全部</a></span>
                            <span><a data-val="1" href="javascript:">Web前端</a></span>
                            <span><a data-val="3" href="javascript:">PHP开发</a></span>
                            <span><a data-val="4" href="javascript:">Java开发</a></span>
                            <span><a data-val="5" href="javascript:">Python开发</a></span>
                            <span><a data-val="6" href="javascript:">IOS开发</a></span>
                            <span><a data-val="7" href="javascript:">Andriod开发</a></span>
                            <span><a data-val="8" href="javascript:">服务器运维</a></span>
                        </div>
                    </li>
                    <li id="jg">
                        <s><i></i><u></u>年薪</s>
                        <div class="l_sp">
                            <input type="hidden" name="price" value=""/>
                            <span><a data-val="" href="javascript:">全部</a></span>
                            <span><a data-val="1" href="javascript:">10万以下</a></span>
                            <span><a data-val="2" href="javascript:">10-20万</a></span>
                            <span><a data-val="3" href="javascript:">20-30万</a></span>
                            <span><a data-val="4" href="javascript:">30-40万</a></span>
                            <span><a data-val="5" href="javascript:">40-50万</a></span>
                            <span><a data-val="6" href="javascript:">50-60万</a></span>
                            <span><a data-val="7" href="javascript:">60-70万</a></span>
                            <span><a data-val="8" href="javascript:">70-100万</a></span>
                            <span><a data-val="9" href="javascript:">100万以上</a></span>
                        </div>
                    </li>
                    <li>
                        <s><i></i><u></u>地点</s>
                        <div>
                            <input type="hidden" name="place" value="" />
                            <span><a data-val="" href="javascript:">全部区县</a></span>
                            <span><a data-val="qiaodong" href="javascript:">桥东区</a></span>
                            <span><a data-val="qiaoxi" href="javascript:">桥西区</a></span>
                            <span><a data-val="xinhua" href="javascript:">新华区</a></span>
                            <span><a data-val="changan" href="javascript:">长安区</a></span>
                            <span><a data-val="yuhua" href="javascript:">裕华区</a></span>
                            <span><a data-val="kaifa" href="javascript:">开发区</a></span>
                            <span><a data-val="luquanshi" href="javascript:">鹿泉市</a></span>
                            <span><a data-val="zhengdingxian" href="javascript:">正定县</a></span>
                            <span><a data-val="zhengdingxinqu" href="javascript:">正定新区</a></span>
                            <span><a data-val="gaochengshi" href="javascript:">藁城市</a></span>
                            <span><a data-val="luanchengxian" href="javascript:">栾城县</a></span>
                            <span><a data-val="pingshanxian" href="javascript:">平山县</a></span>
                            <span><a data-val="zhaoxian" href="javascript:">赵县</a></span>
                            <span><a data-val="jingxingxian" href="javascript:">井陉县</a></span>
                            <span><a data-val="lingshouxian" href="javascript:">灵寿县</a></span>
                            <span><a data-val="yuanshixian" href="javascript:">元氏县</a></span>
                            <span><a data-val="jinzhoushi" href="javascript:">晋州市</a></span>
                            <span><a data-val="xinjishi" href="javascript:">辛集市</a></span>
                            <span><a data-val="xinleshi" href="javascript:">新乐市</a></span>
                            <span><a data-val="shenzexian" href="javascript:">深泽县</a></span>
                            <span><a data-val="xingtangxian" href="javascript:">行唐县</a></span>
                            <span><a data-val="qita" href="javascript:">其它区域</a></span>
                        </div>
                    </li>
                </ul>
                <input type="search" name="keyword" placeholder="请输入行业/职位/年薪/地点" value="">
                <button type="submit" title="搜索">搜索</button>
            </form>
        </div>
    </div>

</div>
<!-- banner// -->


    <div class="container">
<!-- //main -->
<div class="main clearfix">
    <!-- //i-area -->
    <div class="i-area clearfix">

        <div class="i-box i-box-bline zh-home-box clearfix">
            <div class="z i-box-bd zh-home-div zh-home-div-one-text clearfix">
                <div class="i-box-bd-a clearfix">职业测评</div>
                <div class="i-box-bd-b clearfix">(Assessment Center)</div>
                <div class="i-box-bd-c zh-i-box-c clearfix">
                    <p>专业的职业技能、罗辑思维、职业素养和职业性格测评系统。不仅能根据测评结果智能推荐求职，还能帮助您更好地帮助您了解自己的职业优劣势。</p>
                </div>
                <div class="i-box-bd-d clearfix"></div>
            </div>
            <div class="z i-box-hd zh-home-div zh-home-div-one-picture clearfix">
                <div class="icons icon-rz clearfix"></div>
            </div>
        </div>
        <div class="clear"></div>


        <div class="i-box i-box-bline zh-home-box clearfix">
            <div class="z i-box-hd zh-home-div zh-home-div-two-picture clearfix">
                <div class="icons icon-job clearfix"></div>
            </div>

            <div class="z i-box-bd zh-home-div zh-home-div-two-text clearfix">
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



    <div id="pbMain">
        <div class="zh-pbBox-one">
            <div class="pbBox zh-pbBox">
                <div class="imgArea">
                    <a href="" >
                        <img src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/img/home/1.jpg" />
                        <span class="blackBg"></span><span class="likeIcon"></span>
                    </a>
                </div>
                <!--遮罩层开始-->
                <div class="shadeArea">
                    <div class="shade"></div>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="zh-home-zz-a">
                        <div class="cont">
                            WEB前端开发工程师
                        </div>
                    </a>
                </div>
                <!--遮罩层结束-->
            </div>

            <div class="pbBox zh-pbBox">
                <div class="imgArea">
                    <a href="" >
                        <img src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/img/home/2.jpg" />
                        <span class="blackBg"></span><span class="likeIcon"></span>
                    </a>
                </div>
                <!--遮罩层开始-->
                <div class="shadeArea">
                    <div class="shade"></div>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="zh-home-zz-a">
                        <div class="cont">
                            PHP网页开发工程师
                        </div>
                    </a>
                </div>
                <!--遮罩层结束-->
            </div>

            <div class="pbBox zh-pbBox">
                <div class="imgArea">
                    <a href="" >
                        <img src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/img/home/3.jpg" />
                        <span class="blackBg"></span><span class="likeIcon"></span>
                    </a>
                </div>
                <!--遮罩层开始-->
                <div class="shadeArea">
                    <div class="shade"></div>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="zh-home-zz-a">
                        <div class="cont">
                            JAVA网页开发工程师
                        </div>
                    </a>
                </div>
                <!--遮罩层结束-->
            </div>

            <div class="pbBox zh-pbBox">
                <div class="imgArea">
                    <a href="" >
                        <img src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/img/home/4.jpg" />
                        <span class="blackBg"></span><span class="likeIcon"></span>
                    </a>
                </div>
                <!--遮罩层开始-->
                <div class="shadeArea">
                    <div class="shade"></div>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="zh-home-zz-a">
                        <div class="cont">
                            Python网页开发工程师
                        </div>
                    </a>
                </div>
                <!--遮罩层结束-->
            </div>
        </div>

        <div class="zh-pbBox-two">
            <div class="pbBox zh-pbBox">
                <div class="imgArea">
                    <a href="" >
                        <img src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/img/home/5.jpg" />
                        <span class="blackBg"></span><span class="likeIcon"></span>
                    </a>
                </div>
                <!--遮罩层开始-->
                <div class="shadeArea">
                    <div class="shade"></div>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="zh-home-zz-a">
                        <div class="cont">
                            iOS开发工程师
                        </div>
                    </a>
                </div>
                <!--遮罩层结束-->
            </div>

            <div class="pbBox zh-pbBox">
                <div class="imgArea">
                    <a href="" >
                        <img src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/img/home/6.jpg" />
                        <span class="blackBg"></span><span class="likeIcon"></span>
                    </a>
                </div>
                <!--遮罩层开始-->
                <div class="shadeArea">
                    <div class="shade"></div>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>" class="zh-home-zz-a">
                        <div class="cont">
                            Android开发工程师
                        </div>
                    </a>
                </div>
                <!--遮罩层结束-->
            </div>
        </div>


        <!--<div class="pbBox">-->
        <!--    <div class="imgArea"><a href="#" ><img src="images/2.jpg" /><span class="blackBg"></span><span class="likeIcon"></span></a></div>-->
        <!--    <div class="txtArea">-->
        <!--        <h3 class="title"><a href="#">2、非常富创意的404页面欣赏</a></h3>-->
        <!--        <p class="text">每当人们打错了网址，熟悉的404页面就会映入眼帘。多数网站的404页面很让人扫兴，一味的跳转 ... <a href="#" class="ys">[阅读]</a></p>-->
        <!--    </div>-->
        <!---->
        <!--    <!--遮罩层开始-->
        <!--    <div class="shadeArea">-->
        <!--        <div class="shade"></div>-->
        <!--        <div class="cont">-->
        <!--            <a href="#" class="m">喜欢2</a>-->
        <!--            <a href="#">收藏2</a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <!--遮罩层结束-->
        <!---->
        <!--</div>-->
        <!---->
        <!---->
        <!--<div class="pbBox">-->
        <!--    <div class="imgArea"><a href="#" ><img src="images/3.jpg" /><span class="blackBg"></span><span class="likeIcon"></span></a></div>-->
        <!--    <div class="txtArea">-->
        <!--        <h3 class="title"><a href="#">3、非常富创意的404页面欣赏</a></h3>-->
        <!--        <p class="text">每当人们打错了网址，熟悉的404页面就会映入眼帘。多数网站的404页面很让人扫兴，一味的跳转 ... <a href="#" class="ys">[阅读]</a></p>-->
        <!--    </div>-->
        <!---->
        <!--    <!--遮罩层开始-->
        <!--    <div class="shadeArea">-->
        <!--        <div class="shade"></div>-->
        <!--        <div class="cont">-->
        <!--            <a href="#" class="m">喜欢3</a>-->
        <!--            <a href="#">收藏3</a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <!--遮罩层结束-->
        <!---->
        <!--</div>-->
        <!---->
        <!---->
        <!--<div class="pbBox">-->
        <!--    <div class="imgArea"><a href="#" ><img src="images/4.jpg" /><span class="blackBg"></span><span class="likeIcon"></span></a></div>-->
        <!--    <div class="txtArea">-->
        <!--        <h3 class="title"><a href="#">4、非常富创意的404页面欣赏</a></h3>-->
        <!--        <p class="text">每当人们打错了网址，熟悉的404页面就会映入眼帘。多数网站的404页面很让人扫兴，一味的跳转 ... <a href="#" class="ys">[阅读]</a></p>-->
        <!--    </div>-->
        <!---->
        <!--    <!--遮罩层开始-->
        <!--    <div class="shadeArea">-->
        <!--        <div class="shade"></div>-->
        <!--        <div class="cont">-->
        <!--            <a href="#" class="m">喜欢4</a>-->
        <!--            <a href="#">收藏4</a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <!--遮罩层结束-->
        <!---->
        <!--</div>-->


    </div>



    <!-- i-area// -->
</div>
<div class="clear"></div>
<!-- main// -->



<!--职位部分-->

    </div>

    <br><br>







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

    // 搜索部分
    $("#nav").cjslip({
        type: "box",
        effect: "slideDown",
        curOff: true,
        mainState: "s",
        mainEl: "div",
        eventType: "click"
    });


    // 遮罩
    var tt=null;
    $('#pbMain').cjslip({
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

<?php include _g('template')->name('@', 'footer', true); ?>