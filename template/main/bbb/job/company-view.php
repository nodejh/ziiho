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

            <div class="well zh-company-view-well">
                <span><img class="zh-company-view-pic" src="<?php prt($CUSER->logo($detailData['logo'])); ?>" /></span>
                <em><?php prt($detailData['cname']); ?></em>
            </div>


            <ul id="myTab" class="nav nav-tabs">
               <li class="active">
                  <a href="#home" data-toggle="tab">
                     公司简介
                  </a>
               </li>
               <li><a href="#ios" data-toggle="tab">公司职位</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
               <div class="tab-pane fade in active" id="home">
                    <div class="zh-list container-fluid">
                        <p>
                          <?php prt($detailData['cdescription']); ?>
                        </p>
                    </div>               
                </div>
               <div class="tab-pane fade" id="ios">
                    <div class="zh-list container-fluid">
                        <?php while($rs = _g('db')->result($jobResult)){ ?>
                        <a class="zh-company-view-a" href="<?php prt(_g('uri')->su('job/ac/company/op/job/id/' . $rs['cuid'] . '/jobid/' . $rs['jobid'])); ?>">
                            <button type="button" class="btn btn-default"><?php prt($JMODEL->sortValue($rs['sortid'], 'sname')); ?></button>
                        </a>
                        <?php } ?>
                    </div>
               </div>
            </div>

        </div>
    </div>
</div>

    

<!-- include footer  -->
<?php include $a = _g('template')->name('newUI', 'common/footer', true); ?>


<!-- custom javascript  -->


</html>