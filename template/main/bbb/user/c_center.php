<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    
<?php include _g('template')->name('user', 'nav', true); ?>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php $UModel->cUserCenterNav(); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
	您好，欢迎进入企业用户中心！
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script language="javascript">

</script>

<?php include _g('template')->name('@', 'footer', true); ?>