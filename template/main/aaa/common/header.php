<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header-no', true); ?>

<!-- //com-header -->
<div class="clearfix com-header-wrap com-header-wrap-def" id="com-header-wrap">
	<div class="clearfix box">
    	<div class="clearfix logo"><a href="<?php prt(_g('uri')->su('job/ac/home')); ?>"></a></div>
        
        <div class="clearfix mn">
            <div class="clearfix navs">
            	<div class="y clearfix">
                    <a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>">学习中心</a>
                    <a href="<?php prt(_g('uri')->su('job/ac/company')); ?>">求职中心</a>
                    <a href="<?php prt(_g('uri')->su('job/ac/assess')); ?>">测评中心</a>
                </div>
            </div>
            
            <!-- //login status -->
            <div class="clearfix lo_box" id="lo_box"></div>
            <!-- login status// -->
            
        </div>
    </div>
</div>

<!-- com-header// -->
<script language="javascript">
$.get("<?php prt(_g('uri')->su('user/ac/g/op/status')); ?>", function(data){
	$("#lo_box").html(data);
	$("#login0").show();
	$("#login1").fadeIn(80);
});
</script>