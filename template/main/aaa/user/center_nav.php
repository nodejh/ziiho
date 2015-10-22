<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php 
	$navDataArr = array(
		'profile'=> array('uri'=>'user/ac/profile', 'name'=>'个人资料'),
		'avatar'=> array('uri'=>'user/ac/avatar', 'name'=>'上传头像'),
		'password'=> array('uri'=>'user/ac/password', 'name'=>'密码修改'),
		'manager'=> array('uri'=>'resume/ac/manager', 'name'=>'我的简历'),
		'examrec'=> array('uri'=>'user/ac/examrec', 'name'=>'职位测评录'),
		'jobrec'=> array('uri'=>'user/ac/jobrec', 'name'=>'工作申请录')
		
	);
 ?>
	<div class="ul-item">
    	<ul>
        	<?php foreach($navDataArr as $ndaK => $ndaV): ?>
        		<li><a href="<?php prt(_g('uri')->su($ndaV['uri'])); ?>" <?php prt(_get('ac') == $ndaK ? 'class="on"' : '');?> ><?php prt($ndaV['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>