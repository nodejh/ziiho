<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<?php include _g('template')->name('user', 'nav', true); ?>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
    <!-- //cuser_z -->
    <div class="cuser_z clearfix">
        <?php $UModel->userCenterNav(); ?>
    </div>
    <!-- cuser_z// -->

    <!-- //cuser_y -->
    <div class="cuser_y clearfix">
        <!-- //txt-message -->
        <div class="txt-message clearfix">
        	<p class="fsb">提示:</p>
            <p class="fc">1.上传文件支持*.jpg;*.gif,*.png</p>
            <p class="fc">2.上传文件小于4MB</p>
            <p class="fc">3.请勿上传广告，及不雅照</p>
        </div>
        <!-- txt-message// -->
        <!-- //company-tab-bd -->
        <div class="company-tab-bd clearfix">
            <div class="bd-box clearfix">
                <form method="post" onsubmit="return false;">
                <ul>
                    
                    <li class="bline clearfix">
                        
                    </li>
                </ul>
                </form>
            </div>
        </div>
        <!-- company-tab-bd// -->
        
        
    </div>
    <!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
<script language="javascript">
	
</script>

<?php include _g('template')->name('@', 'footer', true); ?>