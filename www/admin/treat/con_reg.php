<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContentBody">		
		<div class="contentsAdd">
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="TREAT_CON_REG" />
		<input type="hidden" name="tt_idx"  id="tt_idx" value="<?=$_GET['tt_idx'];?>" />
		<input type="hidden" name="tti_item"  id="tti_item" value="<?=$_GET['item'];?>" />
		<input type="hidden" name="tti_ta_cnt"  id="tti_ta_cnt" value="<?=$_GET['cnt'];?>" />
			<div class="section">
				<?
					//일반 타입
					if($_GET['item'] == "1") {
						include_once 'con_general.php';
					}

					//좌우배치 타입
					if($_GET['item'] == "2") {
						include_once 'con_lr_type.php';
					}

					//왼쪽 이미지
					if($_GET['item'] == "3") {
						include_once 'con_l_image.php';
					}

					//오른쪽 이미지
					if($_GET['item'] == "4") {
						include_once 'con_r_image.php';
					}

					//이미지 타입
					if($_GET['item'] == "5") {
						include_once 'con_image.php';
					}

					//리스트 타입
					if($_GET['item'] == "6") {
						include_once 'con_ul_li.php';
					}

					//탭 타입
					if($_GET['item'] == "7") {
						include_once 'con_tab.php';
					}

					//아코디언 타입
					if($_GET['item'] == "8") {
						include_once 'con_acc.php';
					}

					//동영상 타입
					if($_GET['item'] == "9") {
						include_once 'con_movie.php';
					}

					//주요문구 타입
					if($_GET['item'] == "10") {
						include_once 'con_mungu.php';
					}

					//최종버튼 타입
					if($_GET['item'] == "11") {
						include_once 'con_last.php';
					}
				?>
			</div>
		</div>
		<div class="btnWrap ">
			<span class="btnRight">
				<button id="img_submit" class="btnM btnIdt ">등록</button>
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
				//이미지 형태
				if($_GET['item'] == "3" || $_GET['item'] == "4" || $_GET['item'] == "5") {
			?>
			if($('#tti_img1').val() == '') {
				alert("이미지를 선택하세요");
				$('#tti_img1').focus();
				return false;
			}
			<?
				}
			?>

			<?
				//좌우배치, 리스트  형태
				if($_GET['item'] == "2" || $_GET['item'] == "6" || $_GET['item'] == "9" || $_GET['item'] == "10") {
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
				if($_GET['item'] == "8" || $_GET['item'] == "9") {
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
				if($_GET['item'] == "11") {
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
</script>