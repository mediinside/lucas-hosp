<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

switch ($jb_code)
{		
	case "150" :
		$index_page = "welfare04.html";  	//추가메뉴(숨김)F4

	case "160" :
		$index_page = "welfare05.html";  	//추가메뉴(숨김)F5

	case "170" :
		$index_page = "welfare06.html";  	//추가메뉴(숨김)F6

	default :
		$index_page = "welfare04.html";	//추가메뉴(숨김)F4
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>