// JavaScript Document
(function($){
	$.fn.draglayer=function(){
		var ismove=false;
		var mx=0,my=0;
		var th=$(this);
		var explorer_str=get_explorer();

		th.mousedown(function(event){
			document.onselectstart=new Function("event.returnValue=false;");
			if(explorer_str=='ie'){
				this.setCapture && this.setCapture();
			}else{
				window.captureEvents(Event.MOUSEMOVE|Event.MOUSEUP);
			}
			mx = event.pageX - (parseInt(th.css("left")) || 0);
			my = event.pageY - (parseInt(th.css("top")) || 0);
			th.css("position", "absolute").css("cursor", "move").fadeTo(20, 0.5);
			ismove=true;
		}).mouseup(function(event){
			ismove=false;
			th.fadeTo(20, 1);
			th.unbind('onmouseover');
			th.unbind('mousemove');
			th.unbind('mouseup');
			event.cancelBubble = true;
			event.stopPropagation=true;
			if(explorer_str=='ie'){
				this.releaseCapture();
			}else{
				window.releaseEvents(Event.MOUSEMOVE|Event.MOUSEUP);
				th.onmousemove=null;
				th.onmouseup=null;
			}
		});
		th.mousemove(function(event){
			if(ismove==true){
				th.css({ top: event.pageY - my, left: event.pageX - mx });
			}
		});
		return false;
    }
})(jQuery);

function dlayer(drag_id){
	$(drag_id).draglayer();
}