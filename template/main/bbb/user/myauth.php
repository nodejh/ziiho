<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<!-- //cuser_center -->
<div class="cuser_center clearfix o-main" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix o-left">
	<?php include _g('template')->name('user', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix o-right">
    
    <div class="tttc">共<em><?php prt($pageData['total']); ?></em>个认证书</div>
    
    <?php if($pageData['total'] >=1 ){ ?>
    <!-- //auth_log -->
    <div class="clearfix auth_log">
        <?php while($rs = _g('db')->result($dataResult)){ ?>
    	<div class="clearfix log_is">
        	<div class="icon"><img src="<?php prt(_g('template')->dir('job')); ?>/image/myauthicon/a.png" /></div>
            <div class="tdc">
            	<p class="tdc1"><?php prt(my_array_value('cname', $CUSER->find_jion('a.cuid', $rs['cuid']), $rs['cname'])); ?></p>
                <p class="tdc2"><?php prt($JMODEL->sortValue($rs['sortid'], 'sname')); ?></p>
                <p class="tdc3"><?php prt(my_array_value('jname', $CJOB->find('jobid', $rs['jobid']), $rs['jname'])); ?></p>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- auth_log// -->
    <?php }else{ ?>
    <div class="clearfix yes_empty">对不起，你还没有认证任何企业哦~</div>
    <?php } ?>
    
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('user', 'footer', true); ?>


<?php include _g('template')->name('@', 'footer', true); ?>