<?
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
 </HEAD>
 
 <BODY>
<!-- dialog window markup -->
<div id="dialog" style="display:none" >
	<!--<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
		You will be logged off in <span id="dialog-countdown" style="font-weight:bold"></span> seconds.
	</p>
	<p>Do you want to continue your session?</p>-->
</div>

<script src="js/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/jquery.idletimer.js" type="text/javascript"></script>
<script src="js/jquery.idletimeout.js" type="text/javascript"></script>

<script type="text/javascript">
// setup the dialog
$("#dialog").dialog({
	autoOpen: false,
	modal: true,
	width: 400,
	height: 200,
	closeOnEscape: false,
	draggable: false,
	resizable: false,
	buttons: {
		'Yes, Keep Working': function(){
			$(this).dialog('close');
		},
		'No, Logoff': function(){
			// fire whatever the configured onTimeout callback is.
			// using .call(this) keeps the default behavior of "this" being the warning
			// element (the dialog in this case) inside the callback.
			$.idleTimeout.options.onTimeout.call(this);
		}
	}
});

// cache a reference to the countdown element so we don't have to query the DOM for it on each ping.
//var $countdown = $("#dialog-countdown");

// start the idle timer
$.idleTimeout('#dialog', 'div.ui-dialog-buttonpane button:first', {
	idleAfter: 900, // seconds
	pollingInterval: 1,
	keepAliveURL: 'keepalive.php',
	serverResponseEquals: 'OK',
	onTimeout: function(){
		window.location='libraries/session_idledestroy.php';
		
	},
	onIdle: function(){
	}
});

</script>
 </BODY>
</HTML>
