<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>

<div class="clearfix ul-box">
	<form method="post" onsubmit="return false;">
		<input type="hidden" name="menuid"
			value="<?php prt(my_array_value('menuid', $menuSub, 0)); ?>" />

	<ul class="ubox">
		<li class="clearfix is">
        	<?php _g('cp')->menu->include_cpos(my_array_value('parentid', $menuSub)); ?>
            <?php if(my_array_key_exist('menuid', $menuSub)){ ?><span class="pos-sp">-</span><span class="tc-a t-fw"><?php prt(my_array_value('title', $menuSub)); ?></span><?php } ?>
        </li>
        
        <li class="clearfix is">
				<div class="clearfix tit">排序:</div>
				<div class="clearfix inp">
					<input type="text" class="fs-ts-200" name="listorder"
						value="<?php prt(my_array_value('listorder', $menuSub, 0)); ?>" />
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">名称:</div>
				<div class="clearfix inp">
					<input type="text" class="fs-ts-200" name="title"
						value="<?php prt(my_array_value('title', $menuSub)); ?>" />
				</div> <!--<div class="clearfix des">
            	<p class="ds">dsads</p>
            </div>-->
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">所属分类:</div>
				<div class="clearfix inp">
					<select name="parentid" class="fs-ts-200">
						<option value="0">无分类(作为顶级)</option>
                    <?php _g('cp')->menu->option($menuSub, 0, 0); ?>
                </select>
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">链接类型:</div>
				<div class="clearfix inp">
					<select name="urltype" class="fs-ts-200">
                	<?php foreach(_g('value')->ra(_g('module')->dv(':', 100001)) as $v){ ?>
                	<option value="<?php prt($v['v']); ?>"
							<?php if($v['v'] == my_array_value('urltype', $menuSub)){ ?>
							selected="selected" <?php } ?>><?php prt($v['name']); ?></option>
                    <?php } ?>
                </select>
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">打开方式:</div>
				<div class="clearfix inp">
					<select name="target" class="fs-ts-200">
                	<?php foreach(_g('value')->ra(_g('module')->dv('@', 100001)) as $v){ ?>
                	<option value="<?php prt($v['v']); ?>"
							<?php if($v['v'] == my_array_value('target', $menuSub)){ ?>
							selected="selected" <?php } ?>><?php prt($v['name']); ?></option>
                    <?php } ?>
                </select>
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">url:</div>
				<div class="clearfix inp">
					<input type="text" class="fs-ts-200" name="url"
						value="<?php prt(my_array_value('url', $menuSub)); ?>" />
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">键名:</div>
				<div class="clearfix inp">
					<input type="text" class="fs-ts-200" name="keys"
						value="<?php prt(my_array_value('keys', $menuSub)); ?>" />
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">键名值:</div>
				<div class="clearfix inp">
					<input type="text" class="fs-ts-200" name="vals"
						value="<?php prt(my_array_value('vals', $menuSub)); ?>" />
				</div>
			</li>

			<li class="clearfix is">
				<div class="clearfix tit">模块:</div>
				<div class="clearfix inp">
                	<?php $arr = array('admin'=>'admin', 'common'=>'公共模块', 'content'=>'内容模块', 'user'=>'用户模块', 'cuser'=>'企业模块', 'job'=>'求职模块'); ?>
                	<select name="module" class="fs-ts-200">
                    	<option value="">==请选择==</option>
                        <?php foreach($arr as $k=>$v){ ?>
                        <option value="<?php prt($k); ?>" <?php prt(_g('validate')->v2eq(my_array_value('module', $menuSub), $k) ? 'selected="selected"' : '');?>><?php prt($v); ?></option>
                        <?php } ?>
                    </select>
				</div>
			</li>

			<li class="clearfix is-def">
				<button type="button" name="disabled-buttons" class="fbtn-ds"
					onclick="fsdo(this);">提交</button>
				<button type="button" name="disabled-buttons" class="fbtn-ds"
					onclick="_GESHAI.redirect({'url':'<?php prt($gobackUrl); ?>'});">返回</button>
			</li>
		</ul>
	</form>
</div>

<!-- //javascript -->
<script language="javascript">
function fsdo(_this){
	return _GESHAI.fsubmit(_this, "<?php prt(_g('cp')->uri('ac/menu/op/write_save')); ?>", {
		"goback": "<?php prt($gobackUrl); ?>",
		"start": function(){
			_GESHAI.disbtn("", true);
			window.top._GESHAI.dialog({isBg: false, isHeader: false, isFooter: false, data: "Loading..."});
		},
		"success": function(d){
			_GESHAI.disbtn("", false);
			if(d.status != 1){
				d.isCloseBtn = false;
				d.clickBgClose = true;
				d.title = "操作失败";
				window.top._GESHAI.dialog(d);
			}else if(d.status == 1){
				window.top._GESHAI.dialog.close();
				_GESHAI.redirect(d);
			}
		}
	});
};
</script>
<!-- javascript// -->