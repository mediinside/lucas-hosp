<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

switch ($jb_code)
{		
	case "90" :
		$index_page = "clinic04.html";  	//추가메뉴(숨김)D4

	case "100" :
		$index_page = "clinic05.html";  	//추가메뉴(숨김)D5

	case "110" :
		$index_page = "clinic06.html";  	//추가메뉴(숨김)D6

	default :
		$index_page = "clinic04.html";	//추가메뉴(숨김)D4
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>