<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //job-company-data -->
<div class="com-w job-company-data clearfix" id="job-company-data">
	<ul class="dbox">
    	<?php $i = 0; ?>
    	<?php while($rs = _g('db')->result($cUserResult)){ ?>
        <?php $i = $i + 1; ?>
        <li class="<?php prt($i % 4 != 0 ? 'mrpx' : '');?>" >
        	<a class="pic" href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" ><img src="<?php prt($CUSER->logo($rs['logo'])); ?>" /></a>
            <div class="info">
            	<div class="di">
                    <p class="tt"><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>"><img class="s-logo" src="<?php prt($CUSER->logo($rs['logo'])); ?>" width="20" height="20" /><?php prt($rs['cname']); ?></a></p>
                    <p class="dd">
                        <?php $jobResult = $CJOB->finds('cuid', $rs['cuid']); ?>
                        <?php while($jRs = _g('db')->result($jobResult[1])){ ?>
                        <a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $jRs['cuid'] . '/jobid/' . $jRs['jobid'])); ?>" ><?php prt($JMODEL->sortValue($jRs['sortid'], 'sname')); ?></a>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<!-- job-company-data// -->

<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/rotate3di.js"></script>
<script type="text/javascript">
/*$(document).ready(function () {
    function mySideChange(front) {
        if (front) {
            $(this).parent().find('a.pic').show();
            $(this).parent().find('div.info').hide();
            
        } else {
            $(this).parent().find('a.pic').hide();
            $(this).parent().find('div.info').show();
        }
    }
    $('#job-company-data ul.dbox li').hover(
        function () {
            $(this).find('div').stop().rotate3Di('flip', 250, {direction: 'clockwise', sideChange: mySideChange, easing: "easeOutExpo"});
        },
        function () {
            $(this).find('div').stop().rotate3Di('unflip', 600, {sideChange: mySideChange});
        }
    );
});*/

 $('#job-company-data ul.dbox').cjslip({
		type: 'menu',
		speed: 500,
		effect: "slideDown",
		mainState: 'li',
		mainEl: ".info",
		defaultShow: false,
		startFunc: function(i,t,p,pc,o){
		}
	});

</script>

<?php _g('module')->trigger('job', 'model', null, 'page', $cUserPage); ?>


<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>