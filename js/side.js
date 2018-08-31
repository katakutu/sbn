if ( navigator.appName == "Netscape" )
{
      document.captureEvents(Event.MOUSEUP)
      document.captureEvents(Event.KEYPRESS)
}
      
document.onmouseup = reset;
document.onkeypress = reset;

function reset ( e )
{
   parent.reset( e );
}

function toggle_caret(id) {	
	$('.panel-collapse').collapse('hide');
	if (document.getElementById(id).classList.contains("glyphicon-chevron-down")){
		$("#"+id).removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
	} else{
		$('.glyphicon-chevron-down').removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");	
		$("#"+id).removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
	}
}