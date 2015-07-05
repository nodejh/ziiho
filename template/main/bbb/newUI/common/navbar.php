<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<nav class="navbar navbar-zh navbar-fixed-top zh-noradius">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php prt(_g('uri')->su('job/ac/home')); ?>"> 职乎 </a>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control zh-nav-search-ipt" placeholder="搜索">
        </div>
        <button type="submit" class="btn btn-default zh-nav-search-btn"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
      <ul class="nav navbar-nav navbar-right nav-zh">
        <li><a class="zh-font-h3" href="<?php prt(_g('uri')->su('job/ac/job')); ?>">首页</a></li>
        <li><a class="zh-font-h3" href="<?php prt(_g('uri')->su('job/ac/learn')); ?>">学习中心</a></li>
        <li><a class="zh-font-h3" href="<?php prt(_g('uri')->su('job/ac/company')); ?>">求职中心</a></li>

        <?php $UM = _g('module')->trigger('user', 'model');?>
        <?php if(my_is_array($UM->suser())){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php prt($UM->suser('username')); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php prt(_g('uri')->su('user')); ?>">个人中心</a></li>
            <li><a href="<?php prt(_g('uri')->su('user/ac/myauth')); ?>"></i>我的认证书</a></li>
            <li><a href="<?php prt(_g('uri')->su('user/ac/answer')); ?>">我的认证书</a></li>
            <li class="divider"></li>
            <li><a href="<?php prt(_g('uri')->su('user/ac/logout')); ?>">退出</a></li>
          </ul>
        </li>
        <?php }else{ ?>
        <li><a href="<?php prt(_g('uri')->su('user/ac/login')); ?>"> <i class="fa fa-user"></i> 登录</a></li>
        <li><a href="<?php prt(_g('uri')->su('user/ac/register')); ?>"> <i class="fa fa-user-plus"></i> 注册</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>