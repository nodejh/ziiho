<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'job-nav'); ?>

<!-- //work-data -->
<div class="com-w work-data clearfix" id="work-data">
	<ul class="dbox">
    	<?php //while($rs = _g('db')->result($cUserResult)){ ?>
        <?php $dd = array('汽车制造', '计算机/电子', '服务行业', '建筑行业'); ?>
		<?php $arr = array('金融分析师', '国际投资分析师', '管理人员', '内勤人员', '采购', '建筑设计人员', '计算机'); ?>
        <?php $bg = array('9f0000', '3d659e', '34cd95', '8cb55b', 'e67817', '895382', '8f7c3a', '2287a8', '072b5f', 'e75858', '258beb', '9a17e6', '000000', '76b889', '809646', '025a2f', '504a4a', '025a2f', 'e67817', '6e537d', '9f0000', '8cb55b', '7c4412', '059713', '134a4c', 'a61697', '6f3849', '05259a', '1a9a08', 'dbcf0e'); ?>
        <?php for($i = 0; $i < 4; $i++){ ?>
        <li class="clearfix">
        	<div class="ttt clearfix"><?php prt($dd[$i]); ?><a href="javascript:;">展开</a></div>
        	<div class="sss clearfix">
            	
            	<?php for($j = 0; $j < 30; $j++){ ?>
                <a href="<?php prt(_g('uri')->su('job/ac/work/op/list')); ?>" style="background:#<?php prt($bg[$j]); ?>;" class="<?php prt(($j + 1) % 5 != 0 ? 'mr' : '');?>"><?php prt($arr[rand(0, 6)]);?></a>
                <?php } ?>
                
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<!-- work-data// -->
<script language="javascript">
	$("#work-data").cjslip({mainEl: '.sss', mainState: '.ttt a', mainCur: true, curOff: true, defaultShow: false, eventType:"click", effect:'slideDown', speed:500, completeFunc: function(index, total, page, pageTotal, mainState, pageState, scrollEl, mainEl){ 
		mainState.not(":eq(" + index + ")").html("展开");
		mainState.eq(index).html(mainEl.eq(index).is(":hidden") ? "展开" : "关闭");
	 }
	});
</script>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>