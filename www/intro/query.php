<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

switch ($jb_code)
{		
	case "50" :
		$index_page = "intro08.html";  	//추가메뉴(숨김)A8

	default :
		$index_page = "intro08.html";	// 
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>