<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>
<?php include $a = _g('template')->name('newUI', 'common/fix-header', true); ?>


<script type="text/javascript" src="<?php  prt(_g('template')->dir('newUI')); ?>/utils/chartjs/Chart.js"></script>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/exam.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/exam_new.css" />

</head>


<!-- include navbar  -->
<?php include $a = _g('template')->name('newUI', 'common/navbar', true); ?>



<div class="container-fluid zh-exam-container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="row">
                <div class="col-xs-12 zh-exam-title-div">
                    <span class="zh-exam-title">能力评估</span>
                    <span class="zh-exam-title-number">26</span>
                    <span class="zh-exam-title-tips">超越56%的评测者</span>
                    <span class="zh-exam-title-type">
                        <span class="zh-exam-title-type-mine"><i class="fa fa-square"></i> 我的成绩</span>
                        <span class="zh-exam-title-type-average"><i class="fa fa-square"></i> 平均成绩</span>
                    </span>
                </div>

                <div class="col-xs-12 zh-exam-subtitle-div">
                    <div class="row">
                        <div class="col-xs-4 zh-exam-text-align-center">
                           <span class="zh-exam-subtitle">逻辑思维</span> <span class="zh-exam-subtitle-number">5</span>
                            <p class="zh-exam-subtitle-tips">超越26%的评测者</p>
                            <div class="zh-exam-canvas-bar">
                                <canvas id="canvas-1" height="100%" width="100%"></canvas>
                            </div>
                        </div>
                        <div class="col-xs-4 zh-exam-text-align-center">
                            <span class="zh-exam-subtitle">专业知识</span> <span class="zh-exam-subtitle-number">18</span>
                            <p class="zh-exam-subtitle-tips">超越56%的评测者</p>
                            <div>
                                <canvas id="canvas-2" height="100%" width="100%"></canvas>
                            </div>

                        </div>
                        <div class="col-xs-4 zh-exam-text-align-center">
                            <span class="zh-exam-subtitle">企业文化</span> <span class="zh-exam-subtitle-number">3</span>
                            <p class="zh-exam-subtitle-tips">超越26%的评测者</p>
                            <div class="zh-exam-canvas-bar">
                                <canvas id="canvas-3" height="100%" width="100%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 zh-exam-bottom-div">
                    <span class="zh-exam-bottom-title">职业性格</span> <span class="zh-exam-bottom-title-tips">想象型</span>
                    <p class="zh-exam-bottom-content">
                        想象力丰富，憧憬未来。喜欢思考问题，在 生活中不注意小节，对那些不能立即了解其想法价值的人往往很不耐烦。有时行为刻板，不宜合群，难以相处。这类人不多，大约只占10%，在科学家、发明家、 研究人员和艺术家、作家中居多。
                    </p>
                </div>


            </div>
        </div>
    </div>
</div>




<!--简历部分-->
<!-- //cuser_center -->
<div class="cuser_center clearfix o-main" id="cuser_center">

    <!-- //cuser_y -->
    <div class="cuser_y clearfix o-right">
        <h1 class="o-title">简历</h1>
        <div class="zh-resume-box">
            <div class="zh-resume-title-box">
                <div class="zh-resume-title-left">
                    <p class="zh-resume-title">乔小堂</p>
                    <p class="zh-resume-title-small">求职意向：农艺师（销售推广）</p>
                    <p>上海乔布区乔东路123弄67号</p>
                    <p>service@qiaobutang.com</p>
                    <p>(+86)138-0013-8000</p>
                </div>
                <div class="zh-resume-title-right">
                    <img src="<?php  prt(_g('template')->dir('resume')); ?>/img/1.png" alt="..." class="zh-resume-title-img">
                </div>
            </div>

            <div class="zh-resume-content-box-1">
                <div class="zh-resume-content-title"><span>教育背景</span></div>
                <div>
                    <div class="zh-resume-content-item-box">
                        <p>2011.09-2014.06</p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p class="zh-resume-font-900">乔布大学</p>
                        <p class="zh-resume-content-tips-small">- 大学课程奖学金三等奖（2013.11）</p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p class="zh-resume-font-900">园林专业</p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p class="zh-resume-font-900">大专</p>
                    </div>
                </div>
            </div>
            <div class="zh-resume-content-box-2">
                <div class="zh-resume-content-title"><span>销售经历</span></div>
                <div class="zh-resume-content-box-2-item-1">
                    <div class="zh-resume-content-2-nav">
                        <span>2012.06-2013.09</span>
                        <span class="zh-resume-font-900">乔布农业技术公司</span>
                        <span class="zh-resume-font-900"></span>
                        <span class="zh-resume-font-900">销售推广员</span>
                    </div>
                    <div class="zh-resume-content-2-tips">
                        <p class="zh-resume-content-tips-small">- 下乡到农户家中调查水稻病毒，并推广公司产品（肥料)</p>
                        <p class="zh-resume-content-tips-small">- 纪录客户信息，及时回访获取反馈，并定期整理上交</p>
                    </div>
                </div>
                <br/>
                <div class="zh-resume-content-box-2-item-2">
                    <div class="zh-resume-content-2-nav">
                        <span>2012.01-2013.05</span>
                        <span class="zh-resume-font-900">乔布大学外联部</span>
                        <span class="zh-resume-font-900"></span>
                        <span class="zh-resume-font-900">干事</span>
                    </div>
                    <div class="zh-resume-content-2-tips">
                        <p class="zh-resume-content-tips-small">- 参与多次拉赞助工作，协调商家利益</p>
                        <p class="zh-resume-content-tips-small">- 拜访公司</p>
                    </div>
                </div>
            </div>
            <div class="zh-resume-content-box-3">
                <div class="zh-resume-content-title"><span>农业相关经历</span></div>
                <div>
                    <div class="zh-resume-content-2-nav">
                        <span>2012.01-2013.09</span>
                        <span class="zh-resume-font-900">乔布群芳园艺有限公司</span>
                        <span class="zh-resume-font-900">培育技术员助理</span>
                    </div>
                    <div class="zh-resume-content-2-tips">
                        <p class="zh-resume-content-tips-small">- 协助技术员进行植物组织培养工作，主要关于花药培养和报春器官培养，报春已实现用叶柄培养出植物</p>
                    </div>
                </div>
            </div>
            <div class="zh-resume-content-box-4">
                <div class="zh-resume-content-title"><span>技能证书</span></div>
                <div>
                    <div class="zh-resume-content-item-box">
                        <p>2011.11-2011.12</p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p>中级植保工证书</p>
                        <p>英语 CET-4</p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p></p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="zh-resume-content-box-5">
                <div class="zh-resume-content-title"><span>兴趣爱好</span></div>
                <div>
                    <div class="zh-resume-content-item-box">
                        <p></p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p>阅读，浏览新闻</p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p></p>
                    </div>
                    <div class="zh-resume-content-item-box">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cuser_y// -->
</div>
<div class="clear"></div>
<!-- cuser_center// -->

<div class="zh-company-job-btn text-center">
    <a class="btn btn-info" href="#">修改简历</a>
    <a class="btn btn-info" href="#" onclick="return _requestJobReady(this);" role="button">投递简历</a>

</div>







<?php //include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
    var _areaBox = $("#answers-area");
    var _areaBoxTxm = _areaBox.find(".txm");
    $(window).scroll(function(e) {
        var _st = $(this).scrollTop();
        if(_st >= 62){
            _areaBoxTxm.css("top", "0px");
        }else{
            _areaBoxTxm.css("top", (62 - _st) + "px");
        }
    });

    var __examListBox = $("#answers-area .item-box ul.is");
    __examListBox.find("li").click(function(e){
        $(this).removeClass("light");
    });
    function rzExamDo(_this){
        return _GESHAI.fsubmit(_this, "<?php prt(_g('uri')->su('job/ac/company/op/exam_do/id/' . $id . '/jobid/' . $jobid)); ?>", {
            /*"goback": "",*/
            "start": function(){
                _GESHAI.disbtn("", true);
                window.top._GESHAI.dialog({isBg: true, isHeader: false, isFooter: false, data: "答题提交中..."});
            },
            "success": function(d){
                _GESHAI.disbtn("", false);
                if(d.status != 1){
                    d.isCloseBtn = false;
                    d.clickBgClose = true;
                    d.title = "错误：";
                    window.top._GESHAI.dialog(d);

                    /* 未填写的题目 */
                    if(d.emptyData){
                        var __isFalg = false;
                        for(var i = 0; i < d.emptyData.length; i++){
                            __examListBox.find("li[dataid=\"" + d.emptyData[i] + "\"]").addClass("light");
                            __isFalg = true;
                        }
                        if(__isFalg){
                            var _st = Math.max(parseInt(__examListBox.find("li[dataid=\"" + d.emptyData[0] + "\"]").offset().top) - 20, 0);
                            $('body,html').stop(true, true).animate({"scrollTop": _st}, 500);
                        }
                    }
                }else if(d.status == 1){
                    window.top._GESHAI.dialog.close();
                    _GESHAI.redirect(d);
                }
            }
        });
    };
</script>


<script>
    var radarChartData = {
        labels: ["HTML5", "So on", "jQuery", "Ajax", "JavaScript", "CSS3"],
        datasets: [
            {
                label: "平均水平",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65,59,90,81,56,55]
            },
            {
                label: "我的成绩",
                fillColor: "rgba(97,144,225,.9)",
                strokeColor: "rgba(97,144,225,1)",
                pointColor: "rgba(97,144,225,1)",
                pointStrokeColor: "rgba(97,144,225,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(97,144,225,1)",
                data: [28,48,40,19,96,27]
            }
        ]
    };

    // 97 144 225
    // 253 248 90

    window.onload = function(){
        window.myRadar = new Chart(document.getElementById("canvas-2").getContext("2d")).Radar(radarChartData, {
            responsive: true
        });

        window.myBar = new Chart(document.getElementById("canvas-1").getContext("2d")).Bar(barChartData1, {
            responsive : true,
            scaleShowGridLines : false,
            scaleOverlay : true
        });

        window.myBar = new Chart(document.getElementById("canvas-3").getContext("2d")).Bar(barChartData2, {
            responsive : true,
            scaleShowGridLines : false,
            scaleOverlay : true
        });
    };


    //var barChartData1 = {
    //
    //}



    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

    var barChartData1 = {
        labels : ["逻辑思维"],
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data : [randomScalingFactor()]
            },
            {
                fillColor : "rgba(97,144,225,0.5)",
                strokeColor : "rgba(97,144,225,0.8)",
                highlightFill : "rgba(97,144,225,0.75)",
                highlightStroke : "rgba(97,144,225,1)",
                data : [randomScalingFactor()]
            }
        ]

    };

    var barChartData2 = {
        labels : ["企业文化"],
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data : [randomScalingFactor()]
            },
            {
                fillColor : "rgba(97,144,225,0.5)",
                strokeColor : "rgba(97,144,225,0.8)",
                highlightFill : "rgba(97,144,225,0.75)",
                highlightStroke : "rgba(97,144,225,1)",
                data : [randomScalingFactor()]
            }
        ]

    };


    //window.onload = function(){
    //    var ctx = document.getElementById("canvas-2").getContext("2d");
    //    window.myBar = new Chart(ctx).Bar(barChartData, {
    //        responsive : true
    //    });
    //}


</script>

<?php //include _g('template')->name('@', 'footer', true); ?>

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>



</html>
