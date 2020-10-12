<?
	include_once  '../../_init.php';
	
	$args = '';
	$tt_cate1 = $_POST['tt_cate1'];	
	$tt_cate2 = $_POST['tt_cate2'];
	
	echo "<option value=''>:::선택:::</option>";
	
	$arr_tmp = $GP->CATE2[$tt_cate1];	
	foreach ($arr_tmp as $key => $val) {
		if($key == $tt_cate2) {
			echo "<option value='" . $key . "' selected>" . $val . "</option>";
		}else{
			echo "<option value='" . $key . "'>" . $val . "</option>";
		}
	}	
	exit();
?>