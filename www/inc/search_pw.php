<?php
	include_once  '../_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();
	
	
	$refer = $_SERVER['HTTP_REFERER'];
	$server = $_SERVER['HTTP_HOST'];	

	if(!ereg($server, $refer)){
		exit();
	}	
	
	$mb_id = $_POST['mb_id'];	
	$mb_mobile = str_replace("-","",$_POST['mb_mobile']);	
	
	$args = array();		
	$args['mb_id'] = $mb_id;
	$args['mb_mobile'] = $mb_mobile;
	$rst = $C_Member->membersFindInfo($args);

	if(!$rst['mb_code']){
		$C_Func->put_msg_and_go("존재하지 않는 아이디 입니다.", "/member/idpw.html");
	}
	
	//sender_email, sender_name, receive_email, receive_name, email_subject , contents
	$args = '';
	$args['sender_email'] = $GP -> Admin_Email;
	$args['sender_name'] = $GP -> Admin_HP_NAME;
	$args['receive_email'] = $rst['mb_email'];
	$args['receive_name'] = $rst['mb_name'];
	$args['email_subject'] = '고객님께서 요청하신 정보입니다.';
	$args['new_pw'] = $rst['new_pw'];

	$send_rst = $C_Member->sendMail($args);
	
	
	//echo $rst['new_pw'] ."<br>";
	//echo md5($rst['new_pw']) ."<br>";
	echo $rst['mb_email'] ."로<br /> 임시비밀번호를 발급하였습니다. <br />확인후 <a href='/member/login.html'>로그인</a>하세요.";
	//$send_msg = $rst['mb_email'] ."로 임시비밀번호를 발급하였습니다";
	//$C_Func->put_msg_and_go($send_msg , "/member/login.html");
?>