<?php if(!defined('IN_GESHAI')){exit('no direct access allowed');} ?>
    
<form method="post" onsubmit="return false;">
<input type="hidden" name="flag" value="<?php prt($MN); ?>"/>
<ul class="ubox">
  <li class="clearfix is bg-a">
      <div class="clearfix tit"><?php prt(_g('module')->get($MN . '>subname')); ?>列表</div>
  </li>
  
  <li class="clearfix is">
      <div class="clearfix tit">title:</div>
      <div class="clearfix inp">
          <input type="text" class="fs-ts-480" name="<?php prt($MN); ?>[list][title]" value="<?php prt(my_array_value($MN . '>list>title', $seoData)); ?>" />
      </div>
  </li>
  
  <li class="clearfix is">
      <div class="clearfix tit">keywords:</div>
      <div class="clearfix inp">
          <input type="text" class="fs-ts-480" name="<?php prt($MN); ?>[list][keywords]" value="<?php prt(my_array_value($MN . '>list>keywords', $seoData)); ?>" />
      </div>
  </li>
  
  <li class="clearfix is">
      <div class="clearfix tit">description:</div>
      <div class="clearfix inp">
          <input type="text" class="fs-ts-480" name="<?php prt($MN); ?>[list][description]" value="<?php prt(my_array_value($MN . '>list>description', $seoData)); ?>" />
      </div>
  </li>
  
  <li class="clearfix is bg-a">
      <div class="clearfix tit"><?php prt(_g('module')->get($MN . '>subname')); ?>详细</div>
  </li>
  
  <li class="clearfix is">
      <div class="clearfix tit">title:</div>
      <div class="clearfix inp">
          <input type="text" class="fs-ts-480" name="<?php prt($MN); ?>[detail][title]" value="<?php prt(my_array_value($MN . '>detail>title', $seoData)); ?>" />
      </div>
  </li>
  
  <li class="clearfix is">
      <div class="clearfix tit">keywords:</div>
      <div class="clearfix inp">
          <input type="text" class="fs-ts-480" name="<?php prt($MN); ?>[detail][keywords]" value="<?php prt(my_array_value($MN . '>detail>keywords', $seoData)); ?>" />
      </div>
  </li>
  
  <li class="clearfix is">
      <div class="clearfix tit">description:</div>
      <div class="clearfix inp">
          <input type="text" class="fs-ts-480" name="<?php prt($MN); ?>[detail][description]" value="<?php prt(my_array_value($MN . '>detail>description', $seoData)); ?>" />
      </div>
  </li>
  
  <li class="clearfix is-def">
      <button type="button" name="disabled-buttons" class="fbtn-ds" onclick="fsdo(this);">提交</button>
  </li>
</ul>
</form>