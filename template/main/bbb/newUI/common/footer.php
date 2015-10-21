<!-- //footer -->
<div class="footer-center">
    <div class="fcc clearfix">
        <!--<p>-->
        <!--    <a href="#" class="footer-font-black"> 关于我们 </a><a href="#" class="footer-font-black"> 合作洽谈 </a><a-->
        <!--        href="--><?php //prt(_g('uri')->su('job/ac/zhichangdaren')); ?><!--" class="footer-font-black">职场达人</a><a href="--><?php //prt(_g('uri')->su('job/ac/jianligonglue')); ?><!--" class="footer-font-black"> 简历中心 </a><a-->
        <!--        href="--><?php //prt(_g('uri')->su('job/ac/jianligonglue/op/muban')); ?><!--" class="footer-font-black"> 简历模板 </a>-->
        <!--</p>-->
        <p>
            <!--Powered by <i><a href="#" class="mr1 tl1">geshai</a></i>-->
            <a href="http://www.miibeian.gov.cn/" class="footer-font-black" target="_blank"> 蜀ICP备15009857号 </a>
        </p>
        <p>
            Copyright ©2015 <a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="tl1">罗比雷尔</a>. All Rights Reserved
        </p>
    </div>
</div>
<!-- footer// -->


</body>

<!-- jQuery -->
<script src="<?php  prt(_g('template')->dir('newUI')); ?>/utils/jquery-1.11.3/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php  prt(_g('template')->dir('newUI')); ?>/utils/bootstrap-3.3.4/js/bootstrap.min.js"></script>

<script src="<?php  prt(_g('template')->dir('newUI')); ?>/assets/js/common.js"></script>


<!--the js for navbar-->
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/geshai.common.min.js"></script>
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.cjslip-v1.0.3.min.js"></script>
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.cjslip-v1.0.3.min.js"></script>
<script type="text/javascript">
    _GESHAI.setting("path", "<?php prt(sdir()); ?>");
    _GESHAI.setting("fsubmitKey_get", "<?php prt(_g('cfg>fmkey>get')); ?>");
    _GESHAI.setting("fsubmitKey_post", "<?php prt(_g('cfg>fmkey>post')); ?>");
    _GESHAI.setting("fsubmitKey_ajax", "<?php prt(_g('cfg>fmkey>ajax')); ?>");
    _GESHAI.setting("fsubmitKey_onlybody", "<?php prt(_g('cfg>fmkey>onlybody')); ?>");

</script>