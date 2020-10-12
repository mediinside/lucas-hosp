<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

switch ($jb_code)
{		
	case "120" :
		$index_page = "herb04.html";  	//추가메뉴(숨김)E4

	case "130" :
		$index_page = "herb05.html";  	//추가메뉴(숨김)E5

	case "140" :
		$index_page = "herb06.html";  	//추가메뉴(숨김)E6

	default :
		$index_page = "herb04.html";	//추가메뉴(숨김)E4
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>