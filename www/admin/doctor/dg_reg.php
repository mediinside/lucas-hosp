<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	$cn_select = $C_Func -> makeSelect_Normal('dtg_type', $GP -> DOCTOR_TYPE, $dtg_type, '', '::선택::');		
	$cn_select1 = $C_Func -> makeSelect_Normal('dtg_clinic', $GP -> DOCTOR_GR_CLINIC, $dtg_clinic, '', '::선택::');		
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>단체사진 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="DOCTOR_GR_REG" />
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
								</td>
							</tr>
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
				<button id="img_submit" class="btnSearch ">등록</button>
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
