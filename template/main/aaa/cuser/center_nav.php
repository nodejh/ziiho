<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<?php 
	$navDataArr = array(
		'company'=> array('uri'=>'user/ac/company', 'name'=>'公司信息'),
		'zplx'=> array('uri'=>'user/ac/zplx', 'name'=>'招聘联系人'),
		'job'=> array('uri'=>'user/ac/job', 'name'=>'职位管理'),
		'examrecord'=> array('uri'=>'user/ac/examrecord', 'name'=>'职位认证录'),
		'jobrec'=> array('uri'=>'user/ac/jobrec', 'name'=>'工作申请录'),
		'find'=> array('uri'=>'user/ac/find', 'name'=>'我要找人'),
		'password'=> array('uri'=>'user/ac/password', 'name'=>'密码修改')
	);
 ?>
	<div class="ul-item">
    	<ul>
        	<?php foreach($navDataArr as $ndaK => $ndaV): ?>
        		<li><a href="<?php prt(_g('uri')->su($ndaV['uri'])); ?>" <?php prt(_get('ac') == $ndaK ? 'class="on"' : '');?> ><?php prt($ndaV['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>