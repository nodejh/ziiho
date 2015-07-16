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
            <h1 class="o-title">密码修改</h1>
            <div class="o-content">
                <!-- //txt-message -->
                <div class="txt-message clearfix">
                    <p class="fsb">提示:</p>
                    <p class="fc">为了您的账户安全，密码修改成功后，请返回重新登陆。</p>
                </div>
                <!-- txt-message// -->
                <!-- //company-tab-bd -->
                <div class="company-tab-bd clearfix">
                    <div class="bd-box clearfix">
                        <form method="post" onsubmit="return false;">
                            <ul>

                                <li class="bline clearfix">
                                    <div class="nn">原密码:</div>
                                    <div class="ii"><input type="password" class="o-input" name="password" /></div>
                                </li>

                                <li class="bline clearfix">
                                    <div class="nn">新密码:</div>
                                    <div class="ii"><input type="password" class="o-input" name="new_password" /></div>
                                </li>

                                <li class="bline clearfix">
                                    <div class="nn">确认新密码:</div>
                                    <div class="ii"><input type="password" class="o-input" name="new_password2" /></div>
                                </li>

                                <li class="clearfix">
                                    <div class="nn">&nbsp;</div>
                                    <button type="button" class="btn-ok" name="disabled-buttons" onclick="updatePassword(this, '<?php prt(_g('uri')->su('user/ac/password/op/do')); ?>');">修改密码</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <!-- company-tab-bd// -->
            </div>
        </div>
        <!-- cuser_y// -->

    </div>
    <div class="clear"></div>
    <!-- cuser_center// -->


<?php include _g('template')->name('user', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
<script language="javascript">
	
</script>

<?php include _g('template')->name('@', 'footer', true); ?>