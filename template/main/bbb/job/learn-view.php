<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<!-- include header  -->
<?php include $a = _g('template')->name('newUI', 'common/header', true); ?>

</head>

<!-- include navbar  -->
<?php include $a = _g('template')->name('newUI', 'common/navbar', true); ?>

<!-- 学习方案 -->
<div class="container-fluid zh-mian">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <!-- 路径导航 -->
            <ol class="breadcrumb">
                <li><a href="<?php prt(_g('uri')->su('job/ac/home')); ?>">首页</a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/learn')); ?>">学习方案</a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . my_array_value('sortid', $sortParentData))); ?>"><?php prt(my_array_value('sname', $sortParentData)); ?></a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/learn/spid/' . my_array_value('sortid', $sortParentData) . '/scid/' . my_array_value('sortid', $sortData))); ?>"><?php prt(my_array_value('sname', $sortData));?></a></li>
                <li class="active"><?php prt($jobData['jname']); ?></li>
            </ol>

            <div class="well zh-well-white">
                培训方案：<strong><?php prt(my_array_value('sname', $sortData));?></strong>
            </div>
            <?php $fflag = false; ?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php while($skRs = _g('db')->result($skillResult)){  ?>
                <div class="panel panel-info">
                    <div class="panel-heading" role="tab" id="heading<?php prt($skRs['skillid']);?>">
                      <h4 class="panel-title">
                        <a class="collapsed title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php prt($skRs['skillid']);?>" aria-expanded="false" aria-controls="collapse<?php prt($skRs['skillid']);?>">
                         <?php prt($skRs['sname']); ?><span class="pull-right">展开</span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse<?php prt($skRs['skillid']);?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php prt($skRs['skillid']);?>">
                      <div class="panel-body zh-collapse-panel-body">
                        <?php prt($skRs['content']); ?>
                      </div>
                    </div>
                </div>

            <?php $fflag = true; ?>
            <?php } ?>
            </div>
            <?php if(!$fflag){ ?>
                <div class="alert alert-warning" role="alert">对不起，该职位暂未添加学习方案。</div>
            <?php } ?>

            <nav>
                <ul class="pager">
                    <li class="previous"><a href="<?php prt($goBack); ?>"><span aria-hidden="true">&larr;</span> 返回</a></li>
                    <li class="next"><a href="<?php prt(_g('uri')->su('job/ac/material/spid/' . my_array_value('sortid', $sortParentData) . '/scid/' . my_array_value('sortid', $sortData))); ?>">学习资料 <span aria-hidden="true">&rarr;</span></a></li>
                </ul>
            </nav>
    </div>
</div>



<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->
<?php if($fflag){ ?>
<script language="javascript">
//var $firstTitle = $("#accordion").find("a.title").first();
//$firstTitle.attr('aria-expanded', 'true');
//$firstTitle.find('span').text('关闭');


var $title = $('a.title');
$title.click(function () {
    var expanded = $(this).find('span').text();   
    console.log(expanded);
    if (expanded == '关闭') {
        $(this).find('span').text('展开');
    } else if (expanded == '展开') {
        $(this).find('span').text('关闭');
    }
});

</script>
<?php } ?>



</html>


