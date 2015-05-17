<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<div class="clearfix page-nav">
    <span class="pn-t">共<em class="light"><?php prt($data['total']); ?></em>条,每页<em class="light"><?php prt($data['size']); ?></em>条,第<em class="light"><?php prt($data['page']); ?></em>/<?php prt($data['last']); ?>页</span>
    
    <?php if($data['first'] < $data['last']){ ?>
    <span class="pn-ns">
    	<!-- //prev -->
		<?php if(!_g('validate')->v2eq($data['page'], $data['first'])){ ?><a href="<?php prt(_g('uri')->su($data['uri'] . $data['prev'])); ?>">&laquo;上一页</a><?php }else{ ?><em class="dis">&laquo;上一页</em><?php } ?>
    	<!-- prev// -->
    
        <!-- //nav -->
        <?php foreach(_g('value')->ra(my_array_value('data', $data)) as $v){ ?><?php if($v !== null){ ?><?php if(!_g('validate')->v2eq($data['page'], $v)){ ?><a href="<?php prt(_g('uri')->su($data['uri'] . $v)); ?>"><?php prt($v);?></a><?php }else{ ?><em class="on"><?php prt($v);?></em><?php } ?><?php }else{ ?><em class="dis">...</em><?php } ?><?php } ?>
        <!-- nav// -->
    
    	<!-- //next -->
		<?php if(!_g('validate')->v2eq($data['page'], $data['last'])){ ?><a href="<?php prt(_g('uri')->su($data['uri'] . $data['next'])); ?>">下一页&raquo;</a><?php }else{ ?><em class="dis">下一页&raquo;</em><?php } ?>
        <!-- next// -->
	</span>
    <?php } ?>
</div>