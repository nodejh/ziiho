<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/exam.css" />

<?php include _g('template')->name('user', 'nav', true); ?>

<!-- //answers-area -->
<div class="answers-area clearfix" id="answers-area">
	<!-- //txm -->
    <div class="txm clearfix">
    	<span>共100题/总分100分/90分及格;</span>&nbsp;&nbsp;<span>限时<em class="ut">30</em>分钟,</span><span>已用时<em class="ut">10:05</em></span>
    </div>
    <!-- //txm -->
    	
    <!-- //pos-box -->
    <div class="pos-box clearfix">
    	<em class="f1">当前位置:</em>
    	<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>">首页</a>
        <em class="f2">&raquo;</em>
        <a href="<?php prt(_g('uri')->su('job/ac/company/id/' . $id)); ?>"><?php prt($cUserData['cname']); ?></a>
        <em class="f2">&raquo;</em>
        <a href="<?php prt(_g('uri')->su('job/ac/work/jtypeid/' . $jobData['jtypeid'])); ?>"><?php prt($JTYPE->getValue($jobData['jtypeid'], 'jtname')); ?></a>
        <em class="f2">&raquo;</em>
        <em class="f3"><?php prt($jobData['jname']); ?></em>
    </div>
    <!-- pos-box// -->
    
    <!-- //des-box -->
    <div class="des-box clearfix">
    	<p class="ln">温馨提示:</p>
        <p class="tx">您的答卷成功提交后，我们将会在24小时内仔细阅读。阅读后会立即通知你的答卷结果，请耐心等待...</p>
        <p class="tx">谢谢你的合作！</p>
    </div>
    <!-- des-box// -->
    
    <!-- //item-box -->
    <div class="item-box clearfix">
    	<ul class="is">
        	<li>
            	<div class="tit clearfix">
                	<div class="hh"><?php prt($i + 1); ?>.</div>
                    <div class="tt">1+1=?</div>
                </div>
                <div class="opts clearfix">
                	<input class="single-text" type="text" name="stxt" />
                </div>
            </li>
            
            <li>
            	<div class="tit clearfix">
                	<div class="hh">2.</div>
                    <div class="tt">2+2=?</div>
                </div>
                <div class="opts clearfix">
                	<textarea class="multi-text" name="multitxt"></textarea>
                </div>
            </li>
            
			<?php for($i = 0; $i < 2; $i++): ?>
        	<li>
            	<div class="tit clearfix">
                	<div class="hh"><?php prt($i + 3); ?>.</div>
                    <div class="tt">客户发放了的健康撒的是</div>
                </div>
                <div class="opts clearfix">
                	<p class="h"><input type="radio" name="goty[1]" />A.客户数</p>
                    <p class="h"><input type="radio" name="goty[1]" />B.多个</p>
                    <p class="h"><input type="radio" name="goty[1]" />C.方法</p>
                    <p class="h"><input type="radio" name="goty[1]" />D.精加工</p>
                </div>
            </li>
            <?php endfor; ?>
        </ul>
    </div>
    <!-- item-box// -->
    
    <!-- //btn-box -->
    <div class="btn-box clearfix">
    	<button type="button" class="ok">提交答卷</button>
    </div>
    <!-- btn-box// -->
    
</div>
<div class="clear"></div>
<!-- answers-area// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
<script language="javascript">
var _areaBox = $("#answers-area");
var _areaBoxTxm = _areaBox.find(".txm");
$(window).scroll(function(e) {
	var _st = $(this).scrollTop();
    if(_st >= 35){
		_areaBoxTxm.css("top", "0px");
	}else{
		_areaBoxTxm.css("top", "35px");
	}
});
</script>

<?php include _g('template')->name('@', 'footer', true); ?>