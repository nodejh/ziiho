<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('common')); ?>/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/jianli.css" />
<?php include _g('template')->name('job', 'nav-muban-where', true); ?>


    <!-- //muban-area -->
    <div class="muban-area clearfix">
        <!-- //pos -->
        <div class="pos clearfix"><a href="#" class="home-icon">首页</a><em>></em><a href="#">简历中心</a><em>></em><a href="#">农艺师（销售推广）英文简历模板（应届生初级岗位）</a></div>
        <!-- pos// -->

        <!-- //cc-box -->
        <div class="cc-box clearfix">
            <!-- //view -->
            <div class="view clearfix">
                <div class="use">
                    <div class="use-title">
                        <div class="use-title-left">
                            <input type="text" class="use-ipt use-title-left-1" placeholder="乔小堂" autofocus="true"/></br>
                            <input type="text" class="use-ipt use-title-left-2" placeholder="求职意向：农艺师（销售推广）"/></br>
                            <input type="text" class="use-ipt use-title-left-3" placeholder="上海乔布区乔东路123弄67号"/></br>
                            <input type="text" class="use-ipt use-title-left-3" placeholder="service@qiaobutang.com"/></br>
                            <input type="text" class="use-ipt use-title-left-3" placeholder="(+86)138-0013-8000"/></br>
                        </div>
                        <div class="use-title-right">
                            <label for="use-img">请上传1寸证件照</label>
                            <input type="file" class="jianli-ipt" id="use-img">
                        </div>
                    </div>
                    <!-- //use-content -->
                    <div class="use-content">
                        <div class="use-content-div">
                            <input type="text" class="use-content-title" placeholder="教育背景"/>
                            <div class="use-content-with">
                                <div class="use-content-1">
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-1" placeholder="2011.09-2014.06"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="乔布大学"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="园林专业"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="大专"/>
                                </div>
                                <div class="use-content-2">
                                    <textarea class="use-text" rows="5" cols="20">- 大学课程奖学金三等奖（2013.11）
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="use-content-div">
                            <input type="text" class="use-content-title" placeholder="销售经历"/>
                            <div class="use-content-with">
                                <div class="use-content-1">
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-1" placeholder="2012.06-2013.09"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="乔布农业技术公司"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder=""/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="销售推广员"/>
                                </div>
                                <div class="use-content-2">
                                        <textarea class="use-text" rows="5" cols="20" wrap="hard">- 下乡到农户家中调查水稻病毒，并推广公司产品（肥料)
                                        </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="use-content-div">
                            <input type="text" class="use-content-title" placeholder="农业相关经历"/>
                            <!-- 含有标题即 input 框-->
                            <div class="use-content-with">
                                <div class="use-content-1">
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-1" placeholder="2011.11-2011.12"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="乔布群芳园艺铺有限公司"/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder=""/>
                                    <input type="text" class="use-ipt use-content-ipt use-content-ipt-2" placeholder="培育技术员助理"/>
                                </div>
                                <div class="use-content-2">
                                        <textarea class="use-text" rows="3" cols="20">- 协助技术员进行植物组织培养工作，主要关于花药培养和报春器官培养，报春已实现用叶柄培养出植物
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="use-content-div">
                            <input type="text" class="use-content-title" placeholder="技能证书"/>
                            <div class="use-content-nowith">
                                <div class="use-content-2">
                                        <textarea class="use-text" rows="3" cols="20">中级植保工证书
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="use-content-div">
                            <input type="text" class="use-content-title" placeholder="兴趣爱好"/>
                            <!-- 不含有标题即 input 框-->
                            <div class="use-content-nowith">
                                <div class="use-content-2">
                                        <textarea class="use-text" rows="3" cols="20">阅读，浏览新闻                                        </textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- use-content// -->
                </div>

            </div>
            <!-- view// -->

            <!-- //vd -->
            <div class="vd clearfix">
                <div class="bb1"><a href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban_use')); ?>"><button type="button">保存简历</button></a></div>

                <div class="ctxt clearfix"><em>100</em>人使用</div>

                <div class="fx clearfix">
                    <div class="fx-nn">分享到：</div>
                    <div class="fx-icon">
                        <a href="#" class="fx-c fx-weixin"></a>
                        <a href="#" class="fx-c fx-weibo"></a>
                        <a href="#" class="fx-c fx-renren"></a>
                        <a href="#" class="fx-c fx-douban"></a>
                    </div>
                </div>
            </div>
            <!-- vd// -->

        </div>
        <!-- cc-box// -->

    </div>
    <div class="clear"></div>
    <!-- muban-area// -->


<?php include _g('template')->name('job', 'footer', true); ?>


    <script language="javascript">
        $(document).ready(function(e) {
            var _ms = {"w": 1920, "h": 900};
            var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight")};
            var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};

        });
    </script>

<?php include _g('template')->name('@', 'footer', true); ?>