<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	include_once($GP -> CLS."/class.doctor.php");
	$C_Doctor 	= new Doctor;
	
	$args = "";
	$args['dtg_idx'] 	= $_GET['dtg_idx'];
	$rst = $C_Doctor ->Doctor_GR_Info($args);
	
	if($rst) {
		extract($rst);

		$cn_select = $C_Func -> makeSelect_Normal('dtg_type', $GP -> DOCTOR_TYPE, $dtg_type, '', '::선택::');		
		$cn_select1 = $C_Func -> makeSelect_Normal('dtg_clinic', $GP -> DOCTOR_GR_CLINIC, $dtg_clinic, '', '::선택::');		
	}
	

?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>단체사진 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="DOCTOR_GR_MODI" />
		<input type="hidden" name="dtg_idx" id="dtg_idx" value="<?=$_GET['dtg_idx']?>" />
		<input type="hidden" name="before_image_main" id="before_image_main" value="<?=$dtg_image?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th><span>*</span>분류</th>
								<td>
									<?=$cn_select?>
								</td>
							</tr>
							<tr>
								<th><span>*</span>진료과/부서</th>
								<td>
									<?=$cn_select1?>
								</td>
							</tr>
							<tr>
								<th><span>*</span>대표이미지</th>
								<td>
									<input type="file" name="dr_face_img" id="dr_face_img" size="30">
									<?
									if($dtg_image != "") {
										echo  "<br>" . $dtg_image;
									?>
										<a href="#" onClick="img_del('<?=$dtg_image;?>','<?=$_GET['dtg_idx']?>')">(X)</a>
									<? } ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
				<button id="img_submit" class="btnSearch ">수정</button>
				<button id="img_cancel" class="btnSearch " onClick="javascript:parent.modalclose();">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.alphanumeric.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.base64.js"></script>
<script type="text/javascript">

	function img_del(image, idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/dt_proc.php",
			data: "mode=DOCTOR_GR_IMGDEL&dtg_idx=" + idx + "&file=" + image,
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

	$(document).ready(function(){	
		
		$('#img_submit').click(function(){
				
				if($('#dtg_type option:selected').val() == '') {
					alert('분류를 선택하세요');
					return false;
				}			
				
				if($('#dtg_clinic option:selected').val() == '') {
					alert('진료과/부서를 선택하세요');
					return false;
				}
				
				$('#base_form').attr('action','./proc/dt_proc.php');
				$('#base_form').submit();
				return false;							
		});
	});
</script>
