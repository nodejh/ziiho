<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/user.js" />


    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('cuser', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->


        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">
            <h1 class="o-title">招聘联系人<a href="javascript:;" onclick="cuserInfo_zplxWrite();" class="o-title-tips"><button class="o-button o-button-info">+新增联系人</button></a></h1>
            <div class="o-content">
                <!-- //招聘联系人 -->
                <div class="clearfix bd-box clearfix">
                    <div class="clearfix datas zplx_wrap">
                        <form method="post" onsubmit="return false;" id="form_zplx">
                            <input type="hidden" name="zplxid" value="" />
                            <table class="tbox">
<!--                                <tr class="trow-blinetrow-bg" >-->
<!--                                    <td width="15%" colspan="5"><a href="javascript:;" onclick="cuserInfo_zplxWrite();">+新增联系人</a></td>-->
<!--                                </tr>-->
                                <tr class="trow-fw trow-bg" >
                                    <td width="15%">联系人</td>
                                    <td width="20%">区号/座机/转机</td>
                                    <td width="20%">手机</td>
                                    <td width="20%">邮箱</td>
                                    <td width="25%">操作</td>
                                </tr>

                                <?php while($zpRs = _g('db')->result($zplxResult)): ?>
                                    <tr class="trow-bline trow-hover" >
                                        <td width="15%"><em id="zname_<?php prt($zpRs['zplxid']); ?>"><?php prt($zpRs['zname']); ?></em></td>
                                        <td width="20%"><em id="mp0_<?php prt($zpRs['zplxid']); ?>"><?php prt($zpRs['mp0']); ?></em>-<em id="mp1_<?php prt($zpRs['zplxid']); ?>"><?php prt($zpRs['mp1']); ?></em>-<em id="mp2_<?php prt($zpRs['zplxid']); ?>"><?php prt($zpRs['mp2']); ?></em></td>
                                        <td width="20%"><em id="tp_<?php prt($zpRs['zplxid']); ?>"><?php prt($zpRs['tp']); ?></em></td>
                                        <td width="20%"><em id="email_<?php prt($zpRs['zplxid']); ?>"><?php prt($zpRs['email']); ?></em></td>
                                        <td width="25%" class="ops"><a href="javascript:;" onclick="cuserInfo_zplxWrite(<?php prt($zpRs['zplxid']); ?>);">修改</a><a href="javascript:;" onclick="cuserInfo_zplx(this, 'del');" data-id="<?php prt($zpRs['zplxid']); ?>">删除</a></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </form>
                    </div>

                    <div class="page-tab"><?php prt($JModel->page($zplxPageData)); ?></div>

                </div>
                <!-- 招聘联系人// -->
            </div>

        </div>
        <!-- cuser_y// -->

    </div>


    <div class="clear"></div>
    <!-- cuser_center// -->


    <!-- //zplx_write_wrap -->
    <div class="zplx_write_wrap" id="zplx_write_wrap">
        <div class="clearfix zplx_write">
            <form method="post" onsubmit="return false;" id="{form}">
                <input type="hidden" name="tabtype" value="zplx" />
                <input type="hidden" name="act_type" value="write" />
                <input type="hidden" name="zplxid" v="{zplxid}" />
                <ul class="zplx_box">
                    <li class="clearfix">
                        <div class="tit">联系人:</div>
                        <div class="inp"><input type="text" class="ft" name="zname" v="{zname}" /></div>
                    </li>
                    <li class="clearfix">
                        <div class="tit">区号/座机/转机:</div>
                        <div class="inp"><input type="text" class="ft2" name="mp0" v="{mp0}" /><em class="split">-</em><input type="text" class="ft" name="mp1" v="{mp1}" /><em class="split">-</em><input type="text" class="ft2" name="mp2" v="{mp2}" /></div>
                    </li>
                    <li class="clearfix">
                        <div class="tit">手机:</div>
                        <div class="inp"><input type="text" class="ft" name="tp" v="{tp}" /></div>
                    </li>
                    <li class="clearfix nb">
                        <div class="tit">邮箱:</div>
                        <div class="inp"><input type="text" class="ft" name="email" v="{email}" /></div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <!-- zplx_write_wrap// -->

<?php include _g('template')->name('user', 'footer', true); ?>

    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/nature.js"></script>
    <script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
    <script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
    <script language="javascript">
        var __actUrl = "<?php prt(_g('uri')->su('user/ac/zplx/op/do')); ?>";
        var __actDel = "<?php prt(_g('uri')->su('user/ac/zplx/op/delete')); ?>";

    </script>

<?php include _g('template')->name('@', 'footer', true); ?>