<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
<?php include _g('template')->name('@', 'header', true); ?>
<link rel="stylesheet" type="text/css"
	href="<?php prt(_g('template')->dir('job')); ?>/css/style.css" />
<?php include _g('template')->name('job', 'nav', true); ?>

<!-- //wrap-bg -->
<div class="wrap-bg clearfix">
	<div class="box clearfix">
		<div class="s clearfix"></div>
		<img
			src="<?php prt(_g('template')->dir('job')); ?>/image/f/company-bg2.jpg"
			width="100%" height="100%" />
	</div>
</div>
<!-- wrap-bg// -->

<!-- //company-jobrz -->
<div class="company-jobrz clearfix" id="company-jobrz">
	<!-- //tt -->
	<div class="tt clearfix">
    	<div class="ta clearfix">认证介绍：</div>
        <div class="tb clearfix">
        	<p>此处的认证包括体系认证和产品认证两大类，体系认证一般的企业都可以做，也是一个让客户对自己的企业或公司放心的认证，比如说ISO9001质量体系认证，一般价格以企业或公司人数的多少来决定；产品认证相对来说比较广泛，各种不同规格的产品和不同的产品认证价格都不一样，当然他们的用途也不一样，比如说CCC国家强制性认证和CE欧盟安全认证。另外，同一类产品做不同的产品认证价格也不相同，比如说空调，如果出口的话就要做国外的相关产品认证。</p>
            <p>包括中国强制性产品认证（CCC）和官方认证。CCC认证是中国国家强制要求的对在中国大陆市场销售的产品实行的一种认证制度，无论国内生产还是国外进口，凡列入CCC目录内且在国内销售的产品均需获得CCC认证，除特殊用途的产品外（符合免于CCC认证的产品）。CCC认证是由国家认可的认证机构实施的产品认证。官方认证即市场准入性的行政许可，是国家行政机关依法对列入行政许可目录的项目所实施的许可管理，凡是需经官方认证的项目，必须获得行政许可方可准予生产、经营、仓储或销售。行政许可针对的是产品，但考核的是管理体系。行政许可包括内销产品（国内生产国内销售和国外进口国内销售）和外销产品（国内生产出口产品）。食品质量安全（QS）认证和药品生产质量管理规范（GMP）认证均属于官方认证。</p>
            <p>按照国家《认证认可条例》和《认证证书和认证标志管理办法》，获得认证的组织不得以任何方式误导消费者，包括在产品第一包装上加施管理体系认证标志以误导消费者认为其获得产品认证。获得管理体系认证，只能说明一个组织已经按照某个认证标准或规范通过了认证机构的最低评价和认可，并不表示该组织的管理体系是优秀模式，也不表示该组织生产、销售的产品具有优良的品质。各类组织在决策进行认证后，选择具有品牌、有价值的认证机构十分重要，兴原认证中心、方圆认证中心、新世纪认证中心、新时代认证中心、船级社认证中心、中质协认证中心被认为是价值感较高的认证机构。我国认证认可行业门户网站为中国认证认可信息网，简称中认网。是经国家认证认可监督管理委员会授权，由国家认证认可监督管理委员会信息中心主办的认证认可行业门户网站。中认网作为认证认可行业内专业性、权威性极强的大型门户型网站，力争面向社会，努力为社会大众、大中小型企业、行业各机构和质检系统相关单位提供全面、快捷的服务和信息欧盟新版机械指令2006/42/EC 将于2009年12 月29 日起生效执行（例外：唯有可携带式匣带加工机械或具有挤压功能的加工机匣，可以到2011年6月29日才实施），取代现行的机械指令98/37/EC，且无缓冲过渡期。据官方的文件，只有在12月29日之后，才能建立一份根据指令2006/42/EC的声明。</p>
            <p>由于不合法的CE证书或宣告太多，许多带有CE标志的机械产品并没有达到相关欧盟指令的要求，新版机械指令加强市场监督力度。不论是欧盟各国的制造商，还是外国所制造而销往欧盟境内的机械制造商，为了方便欧盟CE监督机构的监督工作有效进行，新版机械指令规定：在制造商的宣告文件中必须要有制造商授权编制整套TCF技术文件的负责人名称及联络地址，并且此人必须被确定在欧盟境内。（原文：The EC declaration of conformity must contain the following particulars: name and address of the person authorised to compile the technical file,who must be established in the Community。） 也就是说，一但欧盟CE监督机构发现CE证书或宣告存在虚假迹象，机械产品没有达到相关欧盟指令的要求或机械产品出现了安全事故时，他们能够立即在欧盟境内联系到此负责人，此人代表制造商与欧盟当局处理CE相关事宜。</p>
        </div>
    </div>
    <!-- tt// -->
    
	<!-- //btns -->
	<div class="rr clearfix">
        <span class="tf"><input type="checkbox" name="cb_agree" value="1" />我已阅读此条款<button type="button" class="ok ok-off">确 定</button></span>
	</div>
	<!-- btns// -->
</div>
<!-- company-jobrz// -->

<script language="javascript">
$(document).ready(function(e){
	var _ms = {"w": 1920, "h": 930};
	var _cs = {"w": _GESHAI.clientsize("clientWidth"), "h": _GESHAI.clientsize("clientHeight"), "sh": _GESHAI.clientsize("scrollHeight")};
	var _ss = {"w": Math.min(_ms.w, _cs.w), "h": Math.min(_ms.h, _cs.h)};
	
	var _mObj = $("#company-jobrz");
		_mObj.height(_ss.h - 66);
	
	_mObj.find("input[name=\"cb_agree\"]").click(function(e) {
        if($(this).is(":checked")){
			_mObj.find(".ok").removeClass("ok-off");
		}else{
			_mObj.find(".ok").addClass("ok-off");
		}
    });
	_mObj.find(".ok").click(function(e) {
        if(!_mObj.find("input[name=\"cb_agree\"]").is(":checked")){
			return null;
		}else{
			_GESHAI.redirect({url: '<?php prt(_g('uri')->su('job/ac/company/op/exam/id/' . _get('id') . '/jobid/' . $jobid)); ?>'});
		}
    });
});


</script>

<?php include _g('template')->name('@', 'footer', true); ?>