<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<a class="fa-cd icon-page-goback" onclick="_GESHAI.redirect({'url':'<?php prt(_g('cp')->uri('mod/content/ac/channel')); ?>'});">返回列表</a>
<?php foreach($data as $v){ ?>
<span class="pos-sp">-</span><a class="fa-cd" onclick="_GESHAI.redirect({'url':'<?php prt($urlb . $v['channelid']); ?>'});"><?php prt($v['cname']); ?></a>
<?php } ?>