<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header_center', true); ?>
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('job')); ?>/css/home.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/css/c_center.css" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js" />
    <link rel="stylesheet" type="text/css" href="<?php prt(_g('template')->dir('user')); ?>/js/user.js" />

    <!-- //cuser_center -->
    <div class="cuser_center clearfix o-main" id="cuser_center">
        <!-- //cuser_z -->
        <div class="cuser_z clearfix o-left">
            <?php include _g('template')->name('cuser', 'center_nav', true); ?>
        </div>
        <!-- cuser_z// -->

        <!-- //cuser_y -->
        <div class="cuser_y clearfix o-right">
            <h1 id="company-center-title" class="o-title">基本信息</h1>

            <div class="company-tab-bd clearfix">
                <!-- //基本信息 -->
                <div class="bd-box bd-box-none clearfix">
                    <form method="post" onsubmit="return false;">
                        <input type="hidden" name="tabtype" value="base" />
                        <ul>
                            <li class="bline clearfix">
                                <div class="nn">用户名:</div>
                                <div class="ii"><input class="o-input" value="<?php prt(my_array_value('username', $cUserData)); ?>" disabled="disabled"></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">电子邮箱:</div>
                                <div class="ii"><input class="o-input" value="<?php prt(my_array_value('email', $cUserData)); ?>" disabled="disabled"></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">公司名称:</div>
                                <div class="ii"><input type="text" class="o-input" name="cname" value="<?php prt(my_array_value('cname', $cUserData)); ?>" /></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">行业类型:</div>
                                <div class="select-sort select-c clearfix" id="sort-data-box"></div>
                                <div class="s-to clearfix">>></div>
                                <div class="selected-sort select-c clearfix" id="sort-data-selected"></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">公司性质:</div>
                                <div class="ii"><select class="sel o-input o-fix-select" name="cnatureid" id="nature-data"><option value="0">==请选择==</option></select></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">公司规模:</div>
                                <div class="ii"><input type="text" class="o-input" name="csize" value="<?php prt(my_array_value('csize', $cUserData)); ?>" /></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">公司地址:</div>
                                <div class="ii"><span class="holder-box" id="select-area"></span><span class="holder-box"><input type="hidden" name="area" /><input type="text" class="o-input" name="area_detail" value="<?php prt(my_array_value('area_detail', $cUserData)); ?>" /></span></div>
                            </li>

                            <li class="bline clearfix">
                                <div class="nn">联系人:</div>
                                <div class="ii"><input type="text" class="o-input" name="contacts" value="<?php prt(my_array_value('contacts', $cUserData)); ?>" /></div>
                            </li>
                            <li class="bline clearfix">
                                <div class="nn">联系电话:</div>
                                <div class="ii"><span class="holder-box"><input type="text" class="ii-inp2 o-input" name="telephone[]" telephone="1" value="<?php prt($CUSER->telephone(my_array_value('telephone', $cUserData), 0)); ?>" /></span><span class="split">-</span><span class="holder-box"><input type="text" class="ii-inp3 o-input" name="telephone[]" telephone="2" value="<?php prt($CUSER->telephone(my_array_value('telephone', $cUserData), 1)); ?>" /></span><span class="split">-</span><span class="holder-box"><input type="text" class="ii-inp2 o-input" name="telephone[]" telephone="3" value="<?php prt($CUSER->telephone(my_array_value('telephone', $cUserData), 2)); ?>" /></span></div>
                            </li>
                            <li class="bline clearfix">
                                <div class="nn">手机号码:</div>
                                <div class="ii"><input type="text" class="o-input" name="mobilephone" value="<?php prt(my_array_value('mobilephone', $cUserData)); ?>" /></div>
                            </li>

                            <li class="clearfix">
                                <div class="nn">&nbsp;</div>
                                <button type="button" class="btn-ok" name="disabled-buttons" onclick="cuserInfo_base(this);">保存</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <!-- 基本信息// -->

                <!-- //公司简介 -->
                <div class="bd-box bd-box-none clearfix">
                    <form method="post" onsubmit="return false;">
                        <input type="hidden" name="tabtype" value="des" />
                        <ul>
                            <li class="clearfix">
                                <textarea name="cdescription" style="width:540px; height:400px; visibility:hidden;"><?php prt(my_array_value('cdescription', $cUserData)); ?></textarea>
                            </li>
                            <li class="clearfix">
                                <button type="button" class="btn-ok" name="disabled-buttons" onclick="cuserInfo_des(this);">保存</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <!-- 公司简介// -->

                <!-- //公司logo -->
                <div class="bd-box bd-box-none clearfix">
                    <form method="post" enctype="multipart/form-data" onsubmit="return false;" id="form_logo">
                        <input type="hidden" name="tabtype" value="logo" />
                        <input type="hidden" name="act_type" value="" />
                        <ul>
                            <?php if($CUSER->isf(my_array_value('logo', $cUserData))){ ?>
                                <li class="bline clearfix">
                                    <div class="file-area mt8 clearfix"><img src="<?php prt(sdir('uploadfile') . '/' . $cUserData['logo']); ?>" class="o-cuser-infologo"/></div>
                                    <div class="clear"></div>
                                    <div class="ii"><a href="javascript:;" flag="del" onclick="cuserInfo_logo(this);"><button class="o-button o-button-default">重新上传</button></a></div>
                                </li>
                            <?php }else{ ?>
                                <li class="bline clearfix">
                                    <div class="file-area clearfix o-company-file-fxied">
                                        <span flag="file"><input type="file" class="z f-file" name="ufile" onchange="cuserInfo_logo(this);" /></span>
                                        <input type="text" name="fname" class="z f-txt o-input" />
                                        <button type="button" class="o-button o-button-blue">上传</button>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </form>
                </div>
                <!-- 公司logo// -->

                <!-- //营业执照 -->
                <div class="bd-box bd-box-none clearfix">
                    <form method="post" enctype="multipart/form-data" onsubmit="return false;" id="form_licence">
                        <input type="hidden" name="tabtype" value="licence" />
                        <input type="hidden" name="act_type" value="" />
                        <ul>
                            <li class="bline clearfix"><strong>认证状态：</strong>
                                <?php if(_g('validate')->v2eq(my_array_value('authlicence', $cUserData), 1)){ ?>
                                    <span class="icon-14 color103"><i class="fa fa-check"></i> 已认证</span>
                                <?php }else{ ?>
                                    <span class="icon-13 color101"><i class="fa fa-times"></i> 未认证</span>
                                <?php } ?>
                            </li>

                            <?php if($CUSER->isf(my_array_value('licence', $cUserData))){ ?>
                                <li class="bline clearfix">
                                    <div class="file-area mt8 clearfix"><img src="<?php prt(sdir('uploadfile') . '/' . $cUserData['licence']); ?>"  class="o-cuser-infologo"/></div>
                                    <div class="clear"></div>
                                    <div class="ii"><a href="javascript:;" flag="del" onclick="cuserInfo_licence(this);"><button class="o-button o-button-default">重新上传</button></a></div>
                                </li>
                            <?php }else{ ?>
                                <li class="bline clearfix">
                                    <div class="file-area clearfix o-company-file-fxied">
                                        <span flag="file"><input type="file" class="z f-file" name="ufile" onchange="cuserInfo_licence(this);" /></span>
                                        <input type="text" name="fname" class="z f-txt o-input" />
                                        <button type="button" class="o-button o-button-blue">上传</button>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </form>
                </div>
                <!-- 营业执照// -->

            </div>
        </div>
        <!-- cuser_y// -->

    </div>
    <div class="clear"></div>
    <!-- cuser_center// -->

<?php include _g('template')->name('user', 'footer', true); ?>


    <script type="text/javascript" src="<?php prt(sdir('static')); ?>/js/editor/kindeditor.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/area.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/sort.js"></script>
    <script type="text/javascript" src="<?php prt(sdir('data')); ?>/cache/job/nature.js"></script>
    <script type="text/javascript" src="<?php prt(_g('template')->dir('job')); ?>/js/job_job.js"></script>
    <script type="text/javascript" src="<?php prt(_g('template')->dir('user')); ?>/js/cuser.js"></script>
    <script language="javascript">
        var __actUrl = "<?php prt(_g('uri')->su('user/ac/company/op/do')); ?>";
        var __curHref = "";
        var __tabIndex = "";
        $("#cuser_center").cjslip({
            speed: 0,
            eventType: "click",
            mainEl: '.company-tab-bd',
            mainState: '.company-tab-hd a',
            completeFunc: function(i){
                __tabIndex = i;
                __curHref = (window.location.href.replace(/\&tab\=[0-9]+/g, "")) + "&tab=" + i;
            },
            index: <?php prt(intval(_get('tab'))); ?>
        });

        var _keditor_b;
        KindEditor.ready(function(K) {
            _keditor_b = K.create('textarea[name="cdescription"]', {
                themeType : 'simple',
                cssData:'body{font-size:14px;}',
                resizeType: 1,
                pasteType : 1,
                allowFileManager : false,
                allowImageUpload : false,
                allowFlashUpload : false,
                allowMediaUpload : false,
                allowFileUpload : false,
                afterCreate: function(){ this.sync(); },
                afterBlur: function(){ this.sync(); },
                items : [
                    'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'image', 'link']
            });
        });

        _GESHAI.levelselect({
            data: _CACHE_job_area,
            selected: "<?php prt(my_array_value('area', $cUserData)); ?>".split(","),
            container: "#select-area",
            name: "",
            selectClass: "sel o-input o-fix-select mr8",
            optionFunc: function(d){
                return {"id": d.id, "parentid": d.parentid, "text": d.aname};
            },
            callback: function(_selObj){
                var _changeData = [];
                _selObj.each(function(index, element) {
                    var _cdVal =  $(this).find("option:selected").val();
                    if(parseInt(_cdVal) >= 1){
                        _changeData.push(_cdVal);
                    }
                });
                document.getElementsByName("area").item(0).value = _changeData.join(",");
            }
        });

        cRegister_sort("<?php prt(my_array_value('csortid', $cUserData)); ?>");
        cRegister_nature("#nature-data", "<?php prt(my_array_value('cnatureid', $cUserData)); ?>");

        var _placeholderData = [
            {n: "name=\"csize\"", t: "如:1~20人"},
            {n: "name=\"area_detail\"", t: "详细地址..."},

            {n: "telephone=\"1\"", t: "区号"},
            {n: "telephone=\"2\"", t: "电话号码"},
            {n: "telephone=\"3\"", t: "转机"}
        ];
        for(var i = 0; i < _placeholderData.length; i++){
            _GESHAI.placeholder({name: "input[" + _placeholderData[i].n + "]", text: _placeholderData[i].t});
        }


    </script>

<?php include _g('template')->name('@', 'footer', true); ?>