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


###代码

+ 引入静态文件

 ```<?php  prt(_g('template')->dir('bootstrapUI')); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css```

+ 跳转页面

```

	<?php prt(_g('uri')->su('user/ac/login')); ?>
	<?php prt(_g('uri')->su('user')); ?>
	<?php prt(_g('uri')->su('job/ac/home')); ?>


```

+ 引入公共文件

```

	_g('template')->name('newUI', 'common/footer', true); 


```

---

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



主题配置 ./data/cache/common/option.php