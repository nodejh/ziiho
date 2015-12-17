<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php if($isHomeUrl){ ?>
<a class="fa-cd icon-page-goback" onclick="_GESHAI.redirect({'url':'<?php prt($urla); ?>'});">返回列表</a>
<?php } ?>

<?php $index = 0; ?>
<?php foreach($data as $v){ ?>
<span class="pos-sp">-</span><a class="fa-cd" onclick="_GESHAI.redirect({'url':'<?php prt($urlb . $v['menuid']); ?>'});"><?php prt($v['title']); ?></a>
<?php $index++; ?>
<?php } ?>