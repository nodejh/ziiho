<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<style type="text/css">
	.mt101 a { color:#069; }
	.mt101 a:hover { text-decoration:underline; }
</style>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
<!-- //cuser_z -->
<div class="cuser_z clearfix">
	<?php include _g('template')->name('cuser', 'center_nav', true); ?>
</div>
<!-- cuser_z// -->

<!-- //cuser_y -->
<div class="cuser_y clearfix">
    
    <div class="tttc">共<em><?php prt($jobRecordData['total']); ?></em>工作申请记录</div>
    
    <div class="">
    	<form method="get">
        	<input type="hidden" name="ac" value="jobrec" />
        	<p>
            	职位分类：<select name="sortid" def="<?php prt(my_array_value('sortid',$__where)); ?>"><option value="">-</option></select>
            	<button type="submit">提交查询</button>
            <p>
            <p>工作年龄：<select name="workyear">
            	<option value="">-</option>
                <?php foreach($JMODEL->workyear() as $k => $v){ ?>
                	<option value="<?php prt($k); ?>" <?php prt(my_array_value('workyear', $__where) == $k ? 'selected="selected"' : null); ?>><?php prt($v['sname']); ?></option>
                <?php } ?>
            </select>
            </p>
            <p>测试评分：<select name="score">
            	<option value="">-</option>
                <?php foreach($JMODEL->scoreBL() as $k => $v){ ?>
                	<option value="<?php prt($k); ?>" <?php prt(my_array_value('workyear', $__where) == $k ? 'selected="selected"' : null); ?>><?php prt($v); ?></option>
                <?php } ?>
            </select>
            </p>
        </form>
    </div>
    
    <div class="datas">
    	<form method="post" onsubmit="return false;" id="form101">
        <input type="hidden" name="delurl" value="<?php prt(_g('uri')->su('user/ac/jobrec/op/delete')); ?>" />
        <input type="hidden" name="delid" value="" />
        
        </form>
    	<table class="tbox">
            <tr class="trow-fw trow-bg" >
                <td width="20%">职位名称</td>
                <td width="12%">发布时间</td>
                <td width="16%">工作地点</td>
                <td width="12%">申请时间</td>
                <td width="10%">申请状况</td>
                <td width="10%">申请者</td>
                <td width="10%">查看简历</td>
                <td width="10%">操作</td>
            </tr>
            
            <?php if($jobRecordData['total'] >= 1){ ?>
            <?php while($jRecordRs = _g('db')->result($jobRecordData['result'])): ?>
            <?php $job = $JJOB->find('jobid', $jRecordRs['jobid']); ?>
            <tr class="trow-bline trow-hover" >
                <td width="20%"><?php prt(my_array_value('jname', $job)); ?></td>
                <td width="12%"><?php prt(person_time(my_array_value('ctime', $job))); ?></td>
                <td width="16%">
                	<?php foreach(_g('value')->s2pnsplit2($job['areaid']) as $v){ ?>
					<?php prt($JMODEL->areaValue($v, 'aname')); ?>&nbsp;
                    <?php } ?>
                </td>
                <td width="12%"><?php prt(person_time($jRecordRs['ctime'])); ?></td>
                <td width="10%">成功</td>
                <td width="10%"><?php prt($RMODEL->profile($jRecordRs['uid'], 'chname')); ?></td>
                <td width="10%"><a href="<?php prt(_g('uri')->su('resume/ac/view/rid/'.$jRecordRs['resumeid'])); ?>" target="_blank">查看</a></td>
                <td width="10%"><a href="#" onclick="return cUserJobRecordDel(this);" _id="<?php prt($jRecordRs['jobrecid']); ?>">删除</a></td>
            </tr>
            <?php endwhile; ?>
            <?php }else{ ?>
            <tr class="trow-bline trow-hover" >
            	<td width="100%" colspan="8">对不起，暂无工作申请记录</td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="page-tab"><?php prt($JModel->page($jobRecordData)); ?></div>
</div>
<!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('cuser')); ?>/js/d.js"></script>
<script language="javascript">
	selectSortsHtml($("select[name=\"sortid\"]"));
</script>

<?php include _g('template')->name('@', 'footer', true); ?>