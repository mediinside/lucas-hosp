<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	include_once($GP -> CLS."/class.treat.php");
	$C_Treat 	= new Treat;
	
	$args = "";
	$args['tt_idx'] 	= $_GET['tt_idx'];
	$rst = $C_Treat ->TREAT_Info($args);
	
	if($rst) {
		extract($rst);
		$tt_content1  = $C_Func->dec_contents_edit($tt_content);		
		
		$cate1_select = $C_Func -> makeSelect_Normal('tt_cate1', $GP -> CATE1, $tt_cate1, '', '::선택::');
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>치료법 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="TREAT_MODI" />
		<input type="hidden" name="tt_idx" id="tt_idx" value="<?=$_GET['tt_idx']?>" />
		<input type="hidden" name="before_image" id="before_image" value="<?=$tt_img?>" />

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
							<th width="15%"><span>*</span>CATE2</th>
							<td width="85%">
								<select name="tt_cate2" id="tt_cate2">
									<option value="">:::선택:::</option>
								</select>
							</td>
						</tr>          
						<tr>
							<th><span>*</span>제목</th>
							<td>
								<input type="text" class="input_text" size="70" name="tt_title" id="tt_title" value="<?=$tt_title?>" />
						  </td>
						</tr>
						<tr>
							<th><span>*</span>대표 이미지</th>
							<td>
								<input type="file" name="tt_file_code" id="tt_file_code" size="30" class="input_text">
								<?
									if($tt_img != "") {
										echo  "<br>" . $tt_img;
								?>
									<a href="#" onClick="img_del('<?=$tt_img;?>','<?=$_GET['tt_idx']?>')">(X)</a>
								<? } ?>
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
								<input type="radio" name="tt_main_view" value="Y" <? if($tt_main_view == "Y") { echo "checked"; }?> />노출
								<input type="radio" name="tt_main_view" value="N" <? if($tt_main_view == "N") { echo "checked"; }?> />비노출
							</td>
						</tr>
					</tbody>
				</table>
				</div>				
				<div class="btnWrap">
				<button id="img_submit" class="btnSearch ">수정</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
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

	function img_del(image, idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/treat_proc.php",
			data: "mode=TREAT_IMGDEL&tti_idx=" + idx + "&file=" + image,
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
														 
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		$.ajax({
			type: "POST",
			url: "cate1.php",
			data: "tt_cate1=<?=$tt_cate1?>&tt_cate2=<?=$tt_cate2?>",
			dataType: "text",
			success: function(data) {
				$('#tt_cate2').empty();
				$('#tt_cate2').append(data);
			},
			error: function(xhr, status, error) { alert(error); }
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