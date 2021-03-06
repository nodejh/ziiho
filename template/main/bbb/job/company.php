<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>


</head>

<!-- include navbar  -->
<?php include $a = _g('template')->name('newUI', 'common/navbar', true); ?>



<!-- custom html  -->
<div class="container-fluid zh-mian">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">

            <!-- //引入nav-tips  template/job/job-nav.php -->
            <?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>
            <!-- 引入nav-tips// -->

            <div class="zh-list container-fluid">
                <!-- //job-company-data -->
                <div class="job-company-data" id="job-company-data">
                    <ul class="dbox row zh-company-box">
                        <?php while($rs = _g('db')->result($cUserResult)){ ?>
                            <div class="col-xs-2 col-sm-3">
                                <li class="<?php prt(($i + 1) % 5 != 0 ? 'mrpx' : '');?>" >
                                    <a class="pic" href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" target="_blank"><img src="<?php prt($CUSER->logo($rs['logo'])); ?>" /></a>
                                    <div class="info">
                                        <div class="di">
                                            <p class="tt zh-company-element-center zh-company-vertical">
                                                <a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . $rs['cuid'])); ?>" class="zh-font-white zh-company-imgfont">
                                                    <img class="s-logo" src="<?php prt($CUSER->logo($rs['logo'])); ?>" width="40" height="40" />
                                                    <p class="zh-company-element-center zh-hover-white"><?php prt($rs['cname']); ?>
                                                    </p>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        <?php } ?>
                    </ul>
                </div>

            </div>


      
        </div>
    </div>
</div>




<!-- data of page  -->
<?php _g('module')->trigger('job', 'model', null, 'page', $cUserPage); ?>

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/rotate3di.js"></script>
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.cjslip-v1.0.3.min.js"></script>

<script type="text/javascript">

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

</html>


