<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php 
	$navDataArr = array(
		'profile'=> array('uri'=>'user/ac/profile', 'name'=>'个人资料'),
		'avatar'=> array('uri'=>'user/ac/avatar', 'name'=>'上传头像'),
		'password'=> array('uri'=>'user/ac/password', 'name'=>'密码修改'),
		'answer'=> array('uri'=>'user/ac/answer', 'name'=>'我的答卷'),
		'myauth'=> array('uri'=>'user/ac/myauth', 'name'=>'我的认证书')
	);
 ?>
	<div class="ul-item">
    	<ul>
        	<?php foreach($navDataArr as $ndaK => $ndaV): ?>
        		<li><a href="<?php prt(_g('uri')->su($ndaV['uri'])); ?>" <?php prt(_get('t') == $ndaK ? 'class="on"' : '');?> ><?php prt($ndaV['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>