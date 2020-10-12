<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	include_once($GP -> CLS."/class.treat.php");
	$C_Treat 	= new Treat;

	$args = '';
	$args['tti_idx'] = $_GET['tti_idx'];
	$data = $C_Treat -> TREAT_Con_Info_Data_Detail($args);

	if($data) {
		extract($data);
		$tti_sub_text1 =  stripslashes($tti_sub_text1);
		$tti_sub_text2 =  stripslashes($tti_sub_text2);

		if($tti_btn_value != '') {
			$arr_btn_val = explode(';', $tti_btn_value);
			$arr_btn_link = explode(';', $tti_btn_link);
			$arr_btn_type = explode(';', $tti_btn_type);
		}

		if($tti_ta_tit != '') {
			$arr_ta_tit = explode(';', $tti_ta_tit);
			$arr_ta_con = explode(';', $tti_ta_con);
		}
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContentBody">		
		<div class="contentsAdd">
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="TREAT_CON_MODI" />
		<input type="hidden" name="tti_idx"  id="tti_idx" value="<?=$_GET['tti_idx'];?>" />
		<input type="hidden" name="tti_item"  id="tti_item" value="<?=$tti_item?>" />
		<input type="hidden" name="tti_ta_cnt"  id="tti_ta_cnt" value="<?=$tti_ta_cnt?>" />
		<input type="hidden" name="before_image1"  id="before_image1" value="<?=$tti_img1?>" />
		<input type="hidden" name="before_image2"  id="before_image2" value="<?=$tti_img2?>" />
		<input type="hidden" name="before_image3"  id="before_image3" value="<?=$tti_img3?>" />
			<div class="section">
				<?
					//일반 타입
					if($tti_item == "1") {
						include_once 'con_general.php';
					}

					//좌우배치 타입
					if($tti_item == "2") {
						include_once 'con_lr_type.php';
					}

					//왼쪽 이미지
					if($tti_item == "3") {
						include_once 'con_l_image.php';
					}

					//오른쪽 이미지
					if($tti_item == "4") {
						include_once 'con_r_image.php';
					}

					//이미지 타입
					if($tti_item == "5") {
						include_once 'con_image.php';
					}

					//리스트 타입
					if($tti_item == "6") {
						include_once 'con_ul_li.php';
					}

					//탭 타입
					if($tti_item == "7") {
						include_once 'con_tab.php';
					}

					//아코디언 타입
					if($tti_item == "8") {
						include_once 'con_acc.php';
					}

					//동영상 타입
					if($tti_item == "9") {
						include_once 'con_movie.php';
					}

					//주요문구 타입
					if($tti_item == "10") {
						include_once 'con_mungu.php';
					}

					//최종버튼 타입
					if($tti_item == "11") {
						include_once 'con_last.php';
					}
				?>
			</div>
		</div>
		<div class="btnWrap ">
			<span class="btnRight">
				<button id="img_submit" class="btnM btnIdt ">수정</button>
				<button id="img_cancel" class="btnM btnGray ">취소</button>
			</span>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.alphanumeric.js"></script>
<script type="text/javascript">

	$(document).ready(function(){	
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	

		$('#img_submit').click(function(){
		

			<?
				//좌우배치, 리스트  형태
				if($tti_item == "2" || $tti_item == "6" || $tti_item == "9" || $tti_item == "10") {
			?>
				if($('#tti_sub_text1').val() == '') {
					alert("텍스트를 입력하세요");
					return false;
				}
			<?
				}
			?>

			<?
				//탭, 아코디언  형태
				if($tti_item == "8" || $tti_item == "9") {
			?>
				if($('#tti_ta_tit_0').val() == '') {
					alert("제목을 입력하세요");
					return false;
				}
			<?
				}
			?>

			<?
				//이미지 형태
				if($tti_item == "11") {
			?>
				if($('#btn_view').text() == '') {
					alert("버튼을 생성하세요");
					return false;
				}
			<?
				}
			?>
		
			
			$('#base_form').attr('action','./proc/treat_proc.php');
			$('#base_form').submit();
			return false;
		});					 
	});

	function img_del(image, idx, type)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/treat_proc.php",
			data: "mode=TREAT_CON_IMGDEL&tti_idx=" + idx + "&file=" + image + "&type=" + type,
			dataType: "text",
			success: function(msg) {

				if($.trim(msg) == "true") {
					alert("삭제되었습니다");
					window.location.reload();
					return false;
				}else{
					alert('삭제에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});
	}
</script>