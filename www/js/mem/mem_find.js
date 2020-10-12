
$(document).ready(function(){
	
	$('#id_find').click(function() {
			if($("#find-id-form #mb_name").val() == '') {
				alert("이름은 필수사항 입니다.");
				$("#mb_name").focus();
				return false;
			} else if( $("#find-id-form #mb_mobile").val() == '') {
				alert("핸드폰 번호를 입력해 주세요");
				$("#find-id-form #mb_mobile").focus();
				return false;
			} else {
				var data = $('#find-id-form').serialize();
				fnWinPopup('id_find_pop.html?' + data,'',400, 340);
			}
			return false;		
	});
	
	
	$('#pwd_find').click(function() {
			if($("#find-pw-form #mb_id").val() == '') {
				alert("이메일을 입력해주세요.");
				$("#find-pw-form #mb_id").focus();
				return false;
			} else if( $("#find-pw-form #mb_mobile").val() == '') {
				alert("핸드폰 번호를 입력해 주세요");
				$("#find-pw-form #mb_mobile").focus();
				return false;
			}else {
				if( confirm(" 비밀번호 확인 요청을 하시면, \n\n 임시비밀번호가 발급됩니다. \n\n 임시비밀번호를 회원님의 이메일로 \n\n 전달 받으시겠습니까?") ) {
					var data = $('#find-pw-form').serialize();
					
					$.ajax({
						url: "/inc/search_pw.php",
						type: 'POST',
						data: data,
						contentTypeString : "text/xml; charset=utf-8",				
						error: function(){
							alert('데이터 전송중 에러가 발생하였습니다.');
						},
						success: function(msg){							
							//$('#pwresult').html(msg);
							
							var data = "msg=" + msg;							
							fnWinPopup('pw_find_pop.html?' + data,'',400, 340);
						}			  			
					});					
				}
			}	
			return false;			
	});
});