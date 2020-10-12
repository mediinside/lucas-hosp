<?php
	include_once  '../_init.php';
	include_once $GP -> CLS . 'class.member.php';
	$C_Member = new Member();

	$args['mb_code'] = $_POST['mb_code'];
	$args['mb_password'] = md5(trim($_POST['mb_pwd']));	
	//$args['mb_password'] = $C_Member->sql_password(trim($_POST['mb_pwd']));
	$rst = $C_Member->Mem_Pass_Check($args);

	if($rst['cnt'] > 0)
	{
		echo "true";
		exit();
	}
	else
	{
		echo "false";
		exit();
	}

?>