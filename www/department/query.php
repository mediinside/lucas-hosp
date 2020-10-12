<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

switch ($jb_code)
{		
	case "60" :
		$index_page = "department08.html";  	//추가메뉴(숨김)B8

	case "70" :
		$index_page = "department09.html";  	//추가메뉴(숨김)B9

	case "80" :
		$index_page = "department10.html";  	//추가메뉴(숨김)B10

	default :
		$index_page = "department08.html";	//추가메뉴(숨김)B8
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>