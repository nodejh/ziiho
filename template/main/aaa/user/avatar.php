<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
<link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />

<link rel="stylesheet" type="text/css" href="<?php prt(sdir('static')); ?>/css/jquery-ui-1.7.2.custom.css" />
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery-ui-1.8.custom.min.js"></script>
<script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/jquery.cropzoom.js"></script>

<!-- //cuser_center -->
<div class="cuser_center clearfix" id="cuser_center">
    <!-- //cuser_z -->
    <div class="cuser_z clearfix">
        <?php include _g('template')->name('user', 'center_nav', true); ?>
    </div>
    <!-- cuser_z// -->

    <!-- //cuser_y -->
    <div class="cuser_y clearfix">
        <!-- //txt-message -->
        <div class="txt-message clearfix">
        	<p class="fsb">提示:</p>
            <p class="fc">1.上传文件支持格式：*.jpg; *.gif; *.png</p>
            <p class="fc">2.上传文件小于4MB</p>
            <p class="fc">3.请勿上传广告，及不雅照，注意照片的是否清晰</p>
        </div>
        <!-- txt-message// -->
        
        <!-- //company-tab-avatar -->
        <div class="company-tab-avatar clearfix">
        	<form method="post" enctype="multiparac/form-data" onsubmit="return false;" id="form_avatar">
            <div class="clearfix isbox">
                <div class="clearfix uploadbox">
                	<span id="uploadbox01"></span>
                    <input type="text" name="avatarname" id="avatarname" class="name" />
                    <button type="button" class="up">选择文件</button>
				</div>
                <div class="clear"></div>
                
                <div class="clearfix preview01" id="preview01">
                	<div class="isrc01" id="isrc01">
                    	<p><img src="" width="300" id="sourcesrc" /></p>
                    </div>
                    <div class="clear"></div>
                    <div class="clearfix s_btn_box">
                        <button type="button" class="s_btn">提交并保存</button>
                    </div>
                </div>
                
                <!-- //view01 -->
                <div class="clearfix view01" id="view01">
                    <p><img src="<?php prt($__avatarSrc); ?>" width="200" height="200" /></p>
                </div>
                <!-- view01// -->
                
            </div>
            </form>
        </div>
        <!-- company-tab-avatar// -->
        
        
    </div>
    <!-- cuser_y// -->

</div>
<div class="clear"></div>
<!-- cuser_center// -->


<?php include _g('template')->name('job', 'footer', true); ?>


<script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/user.js"></script>
<script language="javascript">
function avatarSelectHtml(){
	$("#avatarname").val("未选择文件");
	$("#uploadbox01").html("<input type=\"file\" name=\"avatarfile\" class=\"file\" onchange=\"avatarSelectFile(this);\" />");
};
function avatarSelectFile(_this){
	_this.form.avatarname.value = _this.value;
	if(_this.value.length >= 1){
		userUploadAvatar("<?php prt(_g('uri')->su('user/ac/avatar/op/upload')); ?>");
	}else{
		
	}
};

function avatarCropInit(__param){
	$("#preview01").show();
	$("#view01").hide();
	
	var cropzoom = $('#isrc01').cropzoom({
		  width: 500,
		  height: 400,
		  bgColor: '#ccc',
		  enableRotation: false,
		  enableZoom: false,
		  enableResize: true,
		  selector: {
			   w: 200,
			   h: 200,
			   showPositionsOnDrag: false,
			   showDimetionsOnDrag: false,
			   aspectRatio: true,
			   centered: true,
			   bgInfoLayer:'#fff',
			   borderColor: 'blue',
			   animated: true,
			   maxWidth: 400,
			   maxHeight: 400,
			   borderColorHover: '#000'
		   },
		   image: {
			   source: __param.src,
			   width: __param.w,
			   height: __param.h,
			   minZoom: 0,
			   maxZoom: 0
			},
		onSelectorDrag: function(){
			
		},
		onSelectorResize: function(){
			
		}
	  });
	 $(".s_btn").click(function(){
		  cropzoom.send(function(data){
			  if($("input[name='isdataflag']").length < 1){
				  $("#form_avatar").append('<input type="hidden" name="isdataflag" value="true" />');
				  for(var k in data){
					$("#form_avatar").append('<input type="hidden" name="' + k + '" value="' + data[k] + '" />');
				  }
			  }else{
				  for(var k in data){
					  $("input[name='" + k + "']").val(data[k]);
				  }
			  }
			  userAvatarSave("<?php prt(_g('uri')->su('user/ac/avatar/op/save')); ?>");
		  });			   
	 });
};
avatarSelectHtml();
<?php if(!empty($tmpData)){ ?>
avatarCropInit(<?php prt($tmpData); ?>);
<?php }else{ ?>
$("#preview01").hide();
$("#view01").show();
<?php } ?>
</script>

<?php include _g('template')->name('@', 'footer', true); ?>