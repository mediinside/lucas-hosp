<?
//로그인 확인
if (!$C_Func -> is_login()) {
	$C_Func -> put_msg_and_go ('로그인 해 주세요' , '/member/login.html?reurl=' . urlencode($GP -> NOWPAGE));
}
?>
