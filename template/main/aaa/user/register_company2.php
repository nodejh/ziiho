<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/register.css" />
<?php include _g('template')->name('job', 'nav', true); ?>


<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/register-index-bg2.png"
			width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //register-iarea -->
<div class="register-iarea register-iarea-mt clearfix" id="register_s2">
	<!-- //steps -->
	<div class="step step-2 clearfix">
    	<div class="acc a1 clearfix"><strong>第一步：填写注册信息</strong></div>
        <div class="acc a2 clearfix"><strong>第二步：完善公司信息</strong></div>
        <div class="acc a3 clearfix">第三步：注册成功</div>
    </div>
	<!-- steps// -->
    
    <!-- //ib -->
    <form method="post" onsubmit="return false;">
    <input type="hidden" name="cuid" value="<?php prt($CUser->sess_cuser('cuid')); ?>" />
    <div class="z ib clearfix">
        
        <div class="ibs clearfix">
            <div class="nt clearfix">行业类别</div>
            <div class="sel-area clearfix" id="sort-data-box"></div>

            <div class="sel-btn ml5 clearfix">
            	<p class="sb-aa sb-mt">>></p>
            </div>

            <div class="sel-area ml5 clearfix" id="sort-data-selected"></div>
        </div>
        <div class="clear"></div>

        <div class="ibs clearfix">
            <div class="nt clearfix">公司性质</div>
            <select class="sel2" name="cnatureid" id="nature-data">
            	<option value="">==请选择==</option>
            </select>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">公司规模</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="csize" value="" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">公司介绍</div>
            <div class="tt-area clearfix">sssss</div>
        </div>
        <div class="clear"></div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">招聘联系人</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="recruitment" value="" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">联系电话</div>
            <div class="ii clearfix"><input type="text" class="text" name="rtelephone[]" value="" placeholder="区号" /></div>
            <div class="ii2 ml5 clearfix"><input type="text" class="text2" name="rtelephone[]" value="" placeholder="固定电话" /></div>
            <div class="ii ml5 clearfix"><input type="text" class="text" name="rtelephone[]" value="" placeholder="分机号" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">联系手机</div>
            <div class="inp-area clearfix"><input type="text" class="itext" name="rmobilephone" value="" /></div>
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">认证状态</div>
            <div class="ift clearfix">未认证</div>
        </div>
        <div class="ibt clearfix">
            <div class="text clearfix">上传营业执照：</div>
        </div>
        <div class="ibs clearfix">
            <div class="nt clearfix">&nbsp;</div>
            <div class="inp-area clearfix"><input type="text" class="itext" value="" readonly="readonly" /></div>
            <div class="inp-up clearfix">上&nbsp;传</div>
            <input type="file" class="inp-up-file" name="licence" />
        </div>
        
        <div class="ibs clearfix">
            <div class="nt clearfix">&nbsp;</div>
            <div class="ibtn clearfix"><button type="button" class="reg" name="disabled-buttons" onclick="cRegister_s2(this, '<?php prt(_g('uri')->su('user/ac/register/op/company2_do')); ?>');">保存</button></div>
        </div>
    </div>
    </form>
    <!-- ib// -->
    
</div>
<!-- register-iarea// -->

<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
<script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/nature.js"></script>
<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#register_s2");
		_mObj.height(_ss.h - 66);
	
	/* select */
	var _selectValue = "";
	var _selectObjItems = _mObj.find(".box .n .c");
	_selectObjItems.click(function(e){
		var _index = _selectObjItems.index(this);
        if($(this).find(".icon-checkbox").attr("flag") != "true"){
			_selectValue = parseInt($(this).find(".icon-checkbox").attr("data"));
			_selectObjItems.not(":eq(" + _index + ")").find(".icon-checkbox").removeClass("icon-checkboxed").attr("flag", "");
			$(this).find(".icon-checkbox").addClass("icon-checkboxed").attr("flag", "true");
		}
    });
	/* btn */
	_mObj.find(".box .btn").click(function(e){
        if(_selectValue < 1){
			alert("对不起，请先选择注册类型！");
			return false;
		}
		if(_selectValue == 1){
			alert("页面制作中...");
			return false;
		}else{
			_GESHAI.redirect({"url": "<?php prt(_g('uri')->su('user/ac/register/op/company')); ?>"});
		}
    });
	
	cRegister_sort();
	cRegister_nature("#nature-data");
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>