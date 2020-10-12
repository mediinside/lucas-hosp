<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	$cate1_select = $C_Func -> makeSelect_Normal('tt_cate1', $GP -> CATE1, $tt_cate1, '', '::선택::');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>치료법 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="TREAT_REG" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th width="15%"><span>*</span>CATE1</th>
								<td width="85%">
									<?=$cate1_select?>
								</td>
							</tr> 
							<tr>
								<th><span>*</span>CATE2</th>
								<td>
									<select name="tt_cate2" id="tt_cate2">
										<option value="">:::선택:::</option>
									</select>
								</td>
							</tr> 
							<tr>
								<th><span>*</span>TITLE</th>
								<td>
									<input type="text" class="input_text" size="70" name="tt_title" id="tt_title" />
								</td>
							</tr>
							<tr>
								<th><span>*</span>대표 이미지</th>
								<td>
									<input type="file" name="tt_file_code" id="tt_file_code" size="30" class="input_text">
								</td>
							</tr>	
							<tr>
								<th><span>*</span>요약글</th>
								<td>
									<input type="text" class="input_text" size="70" name="tt_summary" id="tt_summary" />
								</td>
							</tr>
							<tr>
								<th><span>*</span>메인노출여부</th>
								<td>
									<input type="radio" name="tt_main_view" value="Y"  />노출
									<input type="radio" name="tt_main_view" value="N" checked />비노출
								</td>
							</tr>	
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
					<span class="btnRight">
						<button id="img_submit" class="btnSearch ">등록</button>
						<button id="img_cancel" class="btnSearch ">취소</button>
					</span>
				</div>
			</div>
		</div>    
		</form>
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
		
		$('#tt_cate1').change(function(){
				var val = $(this).val();
				
				$('#tt_cate2').empty();	
				$('#tt_cate2').append("<option value=''>:::선택:::</option>");				
				
				if(val != '') {
						$.ajax({
							type: "POST",
							url: "cate1.php",
							data: "tt_cate1=" + val,
							dataType: "text",
							success: function(data) {
								$('#tt_cate2').empty();											
								$('#tt_cate2').append(data);
							},
							error: function(xhr, status, error) { alert(error); }
						});	
				}
		});
		
		
		$('#img_submit').click(function(){
			
			if($('#tt_cate1 option:selected').val() == '') {
				alert("카테고리를 선택하세요");
				return false;
			}

			if($('#tt_cate2 option:selected').val() == '') {
				alert("카테고리를 선택하세요");
				return false;
			}

			if($('#tt_title').val() == '') {
				alert("제목을 입력하세요");
				$('#tt_title').focus();
				return false;
			}
			
			
			$('#base_form').attr('action','./proc/treat_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>