<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>

<?php _g('module')->trigger('job', 'model', null, 'nav', 'learn-nav'); ?>

<!-- //material-view -->
<div class="com-w material-view clearfix" id="material-view">
    <!--//nn-->
    <div class="nn clearfix">
    	<a href="<?php prt(_g('uri')->su('job/ac/home')); ?>" class="h">首页</a>
        <em>></em>
        <a href="<?php prt(_g('uri')->su('job/ac/material')); ?>">学习资料</a>
        <em>></em>
        <a href="<?php prt(_g('uri')->su('job/ac/material/spid/' . my_array_value('sortid', $sortParentData))); ?>">[<?php prt(my_array_value('sname', $sortParentData)); ?>]</a>
        <span> - </span>
        <a href="<?php prt(_g('uri')->su('job/ac/material/spid/' . my_array_value('sortid', $sortParentData) . '/scid/' . my_array_value('sortid', $sortData))); ?>"><?php prt(my_array_value('sname', $sortData));?></a>
        <!--<em>></em>
        <span class="l"><?php prt($materialData['title']); ?></span>-->
    </div>
    <!--nn//-->
    
    <!--//mms-->
    <div class="mms clearfix">
    	<!--//ml-->
    	<div class="clearfix ml">
        	<div class="tit"><?php prt($materialData['title']); ?></div>
            <div class="info clearfix">
            	<div class="pic clearfix"><img src="<?php prt($JMODEL->src($materialData['src'])); ?>" /></div>
                <div class="is clearfix">
                	<ul class="ubs">
                    	<li class="clearfix">
                        	<!--<div class="s100">作者：小明</div>-->
                            <div class="s101">作者：<?php prt($materialData['author']); ?></div>
                            <div class="s101" id="readAddress">阅读地址：</div>
                        </li>
                        <li class="clearfix">
                        	<div class="s101">副标题：<?php prt($materialData['subtitle']); ?></div>
                            <div class="s101">录入时间：<?php prt(person_time($materialData['ctime'])); ?></div>
                        </li>
                        <li class="clearfix">
                        	<div class="s101">出版社：<?php prt($materialData['publish']); ?></div>
                            <div class="s101">出版时间：<?php prt($materialData['publishdate']); ?></div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!--//ops-->
            <div class="clearfix ops">
                <div class="clearfix y">
                	<em class="ops200">这个资料对我</em>
                	<a href="javascript:;" class="ops100">有用</a>
                	<a href="javascript:;" class="ops100">没用</a>
                </div>
            </div>
            <!--ops//-->
            
            <!--//cl-->
            <div class="clearfix cl">内容介绍</div>
            <div class="clearfix cd"><?php prt($materialData['description']); ?></div>
            <!--cl//-->
            
            
            <!--//pl-->
            <div class="clearfix pl">大家在说...
                <!--高速版-->
                <div id="SOHUCS"></div>
                <script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
                <script type="text/javascript">
                    window.changyan.api.config({
                        appid: 'cyrO3idHG',
                        conf: 'prod_e4c50199345d897e8ff5079de538d49b'
                    });
                </script>
            </div>
            <!--//pl-->
            
        </div>
        <!--ml//-->
        
        <!--//mr-->
        <div class="clearfix mr">
        
        	<!--//c101-->
        	<!--<div class="clearfix c100">
            	<div class="label">推荐</div>
                <div class="clearfix box">
                	<ul class="bs clearfix">
                    	<li><a href="#">如何理财</a></li>
                    </ul>
                </div>
            </div>-->
            <!--c101//-->
        
        	<!--//c100-->
        	<div class="clearfix c101">
            	<div class="label">相关</div>
                <div class="clearfix box">
                	<ul class="bs">
                    	<?php while($rs = _g('db')->result($relateResult)){ ?>
                    	<li><a href="<?php prt(_g('uri')->su('job/ac/material/op/view/id/' . $rs['materialid'])); ?>"><?php prt($rs['title']); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!--c100//-->
            
        </div>
        <!--mr//-->
    </div>
    <!--mms//-->
    
</div>
<!-- material-view// -->

<script language="javascript">
	$(document).ready(function(e) {
        $("#readAddress").append("<a class=\"s200\" href=\"<?php prt($materialData['viewurl']); ?>\" target=\"_blank\">查看</a>");
    });
</script>

<?php include _g('template')->name('job', 'footer', true); ?>
<?php include _g('template')->name('@', 'footer', true); ?>