<?php
	include_once  '../_init.php';
	include_once $GP -> CLS . 'class.zipcode.php';
	$C_Zipcode = new Zipcode();

	$args['zc_sido'] = $_POST['sido'];
	$rst = $C_Zipcode->Gugun_list($args);
	
	if($rst) {
		$arr = array('msg'=>'true', 'result'=>$rst);
		echo json_encode($arr);
		exit();
	}else{
		$arr = array('msg'=>'true', 'result'=>'');
		echo json_encode($arr);
		exit();
	}

?>