<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php 
	$navDataArr = array(
        //'center' =>　array('uri'=>'user/ac/center', 'name'=>'<i class="fa fa-dashboard fa-fw o-fa-right"></i> &nbsp;个人中心'),
        'center'=> array('uri'=>'user/ac/center', 'name'=>'<i class="fa fa-dashboard fa-fw o-fa-right"></i> &nbsp;个人中心'),
		'profile'=> array('uri'=>'user/ac/profile', 'name'=>'<i class="fa fa-user fa-fw o-fa-right"></i> &nbsp;个人资料'),
		'avatar'=> array('uri'=>'user/ac/avatar', 'name'=>'<i class="fa fa-upload fa-fw o-fa-right"></i> &nbsp;上传头像'),
		'password'=> array('uri'=>'user/ac/password', 'name'=>'<i class="fa fa-wrench fa-fw o-fa-right"></i> &nbsp;密码修改'),
		'manager'=> array('uri'=>'resume/ac/manager', 'name'=>'<i class="fa fa-file-text fa-fw o-fa-right"></i>&nbsp;&nbsp;我的简历'),
		'examrec'=> array('uri'=>'user/ac/examrec', 'name'=>'<i class="fa fa-certificate fa-fw o-fa-right"></i> &nbsp;职位测评录'),
		'jobrec'=> array('uri'=>'user/ac/jobrec', 'name'=>'<i class="fa fa-file fa-fw o-fa-right"></i>&nbsp;&nbsp;工作申请录')

	);
 ?>
	<div class="ul-item">
    	<ul>
        	<?php foreach($navDataArr as $ndaK => $ndaV): ?>
        		<li><a href="<?php prt(_g('uri')->su($ndaV['uri'])); ?>" <?php prt(_get('ac') == $ndaK ? 'class="on"' : '');?> ><?php prt($ndaV['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>