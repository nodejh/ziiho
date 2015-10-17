##配置

    /data/config.php
    
+ 配置数据库
    
    - *16* $_G ['dns'] ['host'] = 'localhost';
    - *18* $_G ['dns'] ['user'] = 'root';
    - *20* $_G ['dns'] ['password'] = 'root';
    - *22* $_G ['dns'] ['database'] = 'zh';

+ 网站根目录

    - *41* $_G ['dir'] ['root'] = 'http://lziiho.com';
    - *70* $_G ['cfg'] ['url'] = 'http://lziiho.com';

##New UI

###文件目录

    mina/aaa/
    
    |--- bootstrapUI  bootstrap 文件目录
    
    |--- newUI 
        |
        |--- common
        |	|
        |	|--- head.php  ```<!doctype html>...<![endif]-->```
        |	|
        |	|--- footer.php ```<script>...</html>```
        |	|
        |	|--- navbar.php ```<nav>...</nav>```
        |	|
        |	|--- ( custome.php ```</head>...**<?php include footer.php ?>**...</html>``` )
        |
        |--- assets 自定义css/js
        |	|
        |	|--- css (公共CSS)
        |	|
        |	|--- js  (公共javascript)
        |
        |--- utils 第三方工具/库
        |	|
        |	|--- bootstrap-3.3.4-dist


    common/bt
     bootsttrap
        |
        |---head.php  ```<!doctype html>...<![endif]-->```
        |
        |--- custome.php ```</head>...</body>```
        |
        |---footer.php ```<script>...</html>```
        |
        |--- navbar.php ```<nav>...</nav>```

###代码

+ 引入静态文件


    <?php  prt(_g('template')->dir('bootstrapUI')); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css
    

+ 跳转页面


    <?php prt(_g('uri')->su('user/ac/login')); ?>
    <?php prt(_g('uri')->su('user')); ?>
    <?php prt(_g('uri')->su('job/ac/home')); ?>
    

+ 引入公共文件


	_g('template')->name('newUI', 'common/footer', true); 



###主题配置文件
 
    ./data/cache/common/option.php
 
 
 
 
##浏览器兼容代码

1.over.css

    *571* /*height:34px;*/  /*兼容firefox*/
   

##公共代码

2.导航搜索框
  
    <div class="style_1">
        <form method="get" id="searchform" action="/">
            <fieldset>
                <input id="s" name="s" type="text" value="输入搜索内容" class="text_input" onblur="if(this.value==''){this.value='输入搜索内容';}" onfocus="if(this.value =='输入搜索内容') {this.value=''; }" />
                <input name="submit" type="submit" value="" /> </fieldset>
        </form>
    </div>
    
3.header

    <!DOCTYPE html>
    <html lang="zh-CN">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>




##IE8

.box {
-moz-border-radius: 15px; /* Firefox */
 -webkit-border-radius: 15px; /* Safari and Chrome */ 
 border-radius: 15px; /* Opera 10.5+, future browsers, and now also Internet Explorer 6+ using IE-CSS3 */ 
 -moz-box-shadow: 10px 10px 20px #000; /* Firefox */
  -webkit-box-shadow: 10px 10px 20px #000; /* Safari and Chrome */
   box-shadow: 10px 10px 20px #000; /* Opera 10.5+, future browsers and IE6+ using IE-CSS3 */
    behavior: url(ie-css3.htc);
     }
