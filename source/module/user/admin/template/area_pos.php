<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<a class="fa-cd icon-page-goback" onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri('mod/user/ac/area')); ?>'});">返回列表</a>
<?php foreach($data as $v){ ?>
<span class="pos-sp">-</span><a class="fa-cd" onclick="_GESHAI.redirect({'url':'<?php prt($urlb . $v['areaid']); ?>'});"><?php prt($v['aname']); ?></a>
<?php } ?>