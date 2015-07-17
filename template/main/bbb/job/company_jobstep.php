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
                <li><a href="<?php prt(_g('uri')->su('job/ac/company')); ?>">首页</a></li>
                <li><a href="<?php prt(_g('uri')->su('job/ac/company/op/detail/id/' . _get('id'))); ?>"><?php prt($cUserData['cname']); ?></a></li>
                <li><?php prt($jobData['jname']); ?></li>
            </ol>

            <div class="well zh-well-white">
                培训方案：<strong><?php prt($JMODEL->sortValue($jobData['sortid'], 'sname')); ?></strong>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php $fflag = false; ?>
                <?php while($skRs = _g('db')->result($skillResult)){ ?>
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
                    <li class="previous"><a href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . _get('id') . '/jobid/' . $jobid)); ?>"><span aria-hidden="true">&larr;</span> 返回</a></li>
                    <li class="next"><a href="<?php prt(_g('uri')->su('job/ac/company/op/jobrz/id/' . _get('id') . '/jobid/' . $jobid)); ?>"> 提递简历 <span aria-hidden="true">&rarr;</span></a></li>
                    <li class="next"><a href="<?php prt(_g('uri')->su('job/ac/material')); ?>"> 学习资料 <span aria-hidden="true">&rarr;</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

    





<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->
<?php if($fflag){ ?>
<script language="javascript">
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
