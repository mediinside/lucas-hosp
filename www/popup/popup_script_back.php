<?php
	include_once  '../_init.php';	
	include_once($GP -> CLS."/class.popup.php");
	$C_Popup 	= new Popup;
	
	$rst = $C_Popup->PopUp_Show();
?>
<script type="text/javascript">
<!--//
function getCookie( name )
{
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
				endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 )
		break;
	}
	return;
}

<?php    
for($i=0; $i<count($rst); $i++) {
	$le=$rst[$i]['pop_x_position'];
	$to=$rst[$i]['pop_y_position'];
	$wi=$rst[$i]['pop_width'];
	$he=$rst[$i]['pop_height'] + 25;
	
	if($wi < 150) $wi=150;
	if($he < 150) $he=150;

	if($rst[$i]['pop_scroll']=="Y")	{
		$scrollbars="yes";
		$wi += 16;
	}else{
		$scrollbars="no";
	}
?>
	if ( getCookie( "popup_<?=$rst[$i]['pop_idx'];?>" ) != "done" )	{
	window.open('/popup/popup_window.php?pop_idx=<?=$rst[$i]['pop_idx'];?>', 'popup_<?=$rst[$i]['pop_idx'];?>','left=<?=$le;?>,top=<?=$to;?>,width=<?=$wi;?>,height=<?=$he;?>,marginwidth=0,marginheight=0,resizable=1,scrollbars=<?=$scrollbars;?>');		
	}            
<?php
}
?>
//-->
</script>