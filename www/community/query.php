<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

switch ($jb_code)
{		
	case "10" :
		$index_page = "community01.html";  	//루카스 소식

	case "20" :
		$index_page = "community02.html";  	//클리닉 스케치

	case "30" :
		$index_page = "community03.html";  	//열린재활 갤러리

	case "40" :
		$index_page = "community04.html";  	//재활회복 리포트


	
	default :
		$index_page = "community01.html";	// 루카스 소식
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>