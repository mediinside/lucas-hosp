<?php
	include_once("../../../_init.php");
	include_once $GP -> CLS . 'class.online.php';
	$C_Online = new Online();

	switch($_POST['mode']){		
		
		//전화 상담 삭제
		case "Phone_DEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			$args = "";
			$args['tfc_idx'] = $tfc_idx;
			$rst = $C_Online -> Phone_Consel_Del($args);
			
			echo "true";
			exit();
		break;
		
		//전화 상담 처리
		case "Phone_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
			
			$arg = "";
			$args['tfc_idx'] 				= $tfc_idx;
			$args['tfc_result'] 			= $tfc_result;
			$args['tfc_rt_date'] 		= $tfc_rt_date;		
			
			$safe = new HTML_Safe; // xss filter 객체 생성
			$input = base64_decode($tfc_result_con); 
			$output = $safe->parse($input); // html 태그를 필터링 하여 $output에 대입			
			$tfc_result_con = $C_Func->enc_contents($output);			
			$args['tfc_result_con'] = $tfc_result_con;
			$rst = $C_Online -> Phone_Consel_Result($args);		

			$C_Func->put_msg_and_modalclose("처리 되었습니다");		
			exit();
		break;
	}
?>