// JavaScript Document
/*焦点插入值*/
(function($){
  $.fn.extend({
  insertAtCaret: function(myValue){
  var $t=$(this)[0];
  if (document.selection) {
  this.focus();
  sel = document.selection.createRange();
  sel.text = myValue;
  this.focus();
  }
  else
  if ($t.selectionStart || $t.selectionStart == '0') {
  var startPos = $t.selectionStart;
  var endPos = $t.selectionEnd;
  var scrollTop = $t.scrollTop;
  $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
  this.focus();
  $t.selectionStart = startPos + myValue.length;
  $t.selectionEnd = startPos + myValue.length;
  $t.scrollTop = scrollTop;
  }
  else {
  this.value += myValue;
  this.focus();
  }
  }
  })
})(jQuery);

/*文本框自动增高*/
$.fn.extend({
    textareaheightauto: function (options) {
        this._options = {
            minHeight: 0,
            maxHeight: 500
        }
        this.init = function () {
            for (var p in options) {
                this._options[p] = options[p];
            }
            if (this._options.minHeight == 0) {
                this._options.minHeight=parseFloat($(this).height());
            }
            for (var p in this._options) {
                if ($(this).attr(p) == null) {
                    $(this).attr(p, this._options[p]);
                }
            }
            $(this).keyup(this.resetHeight).change(this.resetHeight).focus(this.resetHeight);
        }
        this.resetHeight = function () {
            var _minHeight = parseFloat($(this).attr("minHeight"));
            var _maxHeight = parseFloat($(this).attr("maxHeight"));
            if (!$.browser.msie) {
                $(this).height(0);
            }
            var h = parseFloat(this.scrollHeight);
            h = h < _minHeight ? _minHeight : h > _maxHeight ? _maxHeight : h;
            $(this).height(h).scrollTop(h);
            if (h >= _maxHeight) {
                $(this).css("overflow-y", "scroll");
            }else{
				var s=(options.minHeight<1)?"hidden":(options.minHeight<$(this).height())?"hidden":"scroll";
                $(this).css("overflow-y", s);
            }
        }
        this.init();
    }
});