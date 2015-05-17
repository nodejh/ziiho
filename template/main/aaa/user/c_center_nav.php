<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php 
	$navDataArr = array(
		'c_company'=> array('uri'=>'user/t/c_company', 'name'=>'公司信息'),
		'c_job'=> array('uri'=>'user/t/c_job', 'name'=>'职位管理'),
		'c_password'=> array('uri'=>'user/t/c_password', 'name'=>'密码修改')
	);
 ?>
	<div class="ul-item">
    	<ul>
        	<?php foreach($navDataArr as $ndaK => $ndaV): ?>
        		<li><a href="<?php prt(_g('uri')->su($ndaV['uri'])); ?>" <?php prt(_get('t') == $ndaK ? 'class="on"' : '');?> ><?php prt($ndaV['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>