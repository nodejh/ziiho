<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

    <script type="text/javascript" src="<?php prt(_g('template')->dir('resume')); ?>/js/resume.js"></script>

    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('user', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->

        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">
            <h1 class="o-title">预览简历</h1>
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


<?php include _g('template')->name('job', 'footer', true); ?>


    <script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
    <script language="javascript">

    </script>

<?php include _g('template')->name('@', 'footer', true); ?>