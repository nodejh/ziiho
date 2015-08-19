<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- //footer -->
<div class="footer clearfix">
	<div class="fcc clearfix">
		<p>
			<a href="#" class="mr1">关于我们</a><a href="#" class="mr1">合作洽谈</a><a
				href="<?php prt(_g('uri')->su('job/ac/zhichangdaren')); ?>" class="mr1">职场达人</a><a href="<?php prt(_g('uri')->su('job/ac/jianligonglue')); ?>" class="mr1">简历中心</a><a
				href="<?php prt(_g('uri')->su('job/ac/jianligonglue/op/muban')); ?>" class="mr1">简历模板</a>
		</p>
		<p>
			<!--Powered by <i><a href="#" class="mr1 tl1">geshai</a></i>-->
			<a href="http://www.miibeian.gov.cn/" target="_blank">蜀ICP备15009857号</a>
		</p>
		<p>
			Copyright ©2015 <a href="#" class="tl1">罗比雷尔</a>. All Rights Reserved
		</p>
	</div>
</div>
<!-- footer// -->
<script>
    $(document).ready(function () {
        var urlVars = $.getUrlVars();
        if (urlVars.iid) {
            $('#iid0').removeClass('current');
            $('#' + urlVars.iid + 'iid').addClass('current');
        } else if (urlVars.tid) {
            $('#tid0').removeClass('current');
            $('#' + urlVars.tid + 'tid').addClass('current');
        } else if (urlVars.lid) {
            $('#lid0').removeClass('current');
            $('#' + urlVars.lid + 'lid').addClass('current');
        }

        if (urlVars.order == 1) {
            $('#order-time').removeClass('def').addClass('on');
            $('#order-count').removeClass('on').addClass('def');
            $('#order-link').removeClass('on').addClass('def');
        } else if (urlVars.order == 2) {
            $('#order-time').removeClass('on').addClass('def');
            $('#order-count').removeClass('def').addClass('on');
            $('#order-link').removeClass('on').addClass('def');
        } else if (urlVars.order == 3) {
            $('#order-time').removeClass('on').addClass('def');
            $('#order-count').removeClass('on').addClass('def');
            $('#order-link').removeClass('def').addClass('on');
        }

        //未登录的时候提示登陆
        $('#not-login-button').click(function () {
            var url = $(this).attr('url');
            alert('您还未登陆，请登陆后使用！');
            location.href = url;
        })


    });

    $.extend({
        getUrlVars: function(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },
        getUrlVar: function(name){
            return $.getUrlVars()[name];
        }
    });
</script>