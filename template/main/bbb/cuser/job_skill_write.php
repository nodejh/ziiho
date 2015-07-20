<?php if (!defined('IN_GESHAI')) {
    exit('no direct access allowed');
} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"/>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/user.js"/>


    <style type="text/css">
        .qs-item {
            line-height: 32px;
            margin-top: 5px;
        }

        .qs-item .qs-create {
            margin: 0px 5px;
            color: #0263ad;
        }

        .qs-item .qs-create:hover {
            text-decoration: underline;
            color: #F00;
        }

        .qs-item .qs-remove {
            margin: 0px 5px;
            color: #F00;
        }

        .qs-item .qs-remove:hover {
            text-decoration: underline;
            color: #F00;
        }

        .qs-html {
            position: absolute;
            left: 0px;
            top: -100px;
            width: 0px;
            height: 0px;
            overflow: hidden;
        }
    </style>

    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('cuser', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->

        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">


            <h1 class="o-title">添加学习方案<a href="<?php prt(_g('uri')->referer()); ?>"">
                <button class="o-button o-button-info o-title-tips">&laquo;返回</button>
                </a></h1>
            <div class="form-item clearfix">
                <form method="post" onsubmit="return false;">
                    <input type="hidden" name="jobid" value="<?php prt($jobid); ?>"/>
                    <input type="hidden" name="skillid" value="<?php prt(my_array_value('skillid', $skillsub, 0)); ?>"/>
                    <ul class="form-box">
                        <li class="clearfix">
                            <div class="lab">职位名称：</div>
                            <div class="inp"><input class="o-input o-input-default"
                                                    value="<?php prt($jobData['jname']); ?>" disabled></div>
                        </li>

                        <li class="clearfix">
                            <div class="lab">标题：</div>
                            <div class="inp"><input type="text" name="sname" class="o-input o-input-default"
                                                    value="<?php prt(my_array_value('sname', $skillsub)); ?>"/></div>
                        </li>

                        <li class="clearfix">
                            <div class="lab">说明内容：</div>
                            <div class="inp"><textarea name="content"
                                                       style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('content', $skillsub)); ?></textarea>
                            </div>
                        </li>

                        <li class="clearfix">
                            <div class="lab">&nbsp;</div>
                            <div class="btns">
                                <button type="button" class="btn" name="disabled-buttons"
                                        onclick="cUserSKillWrite(this, '<?php prt(_g('uri')->su('user/ac/job/op/skill_write_save')); ?>', '<?php prt(_g('uri')->referer()); ?>');">
                                    提交并保存
                                </button>
                            </div>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <!-- cuser_y// -->

    </div>
    <div class="clear"></div>
    <!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
    <script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
    <script language="javascript">
        var _keditor_b;
        KindEditor.ready(function (K) {
            _keditor_b = K.create('textarea[name="content"]', {
                themeType: 'simple',
                cssData: 'body{font-size:14px;}',
                resizeType: 1,
                pasteType: 1,
                allowFileManager: false,
                allowImageUpload: false,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileUpload: false,
                afterCreate: function () {
                    this.sync();
                },
                afterBlur: function () {
                    this.sync();
                },
                items: [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'image', 'link']
            });
        });

        _GESHAI.placeholder({name: "input[name=\"sname\"]", text: "如: 熟练Excel"});
    </script>

<?php include _g('template')->name('@', 'footer', true); ?>