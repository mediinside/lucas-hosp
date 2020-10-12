<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	include_once($GP->CLS."class.recruit.php");	
	$C_Recruit 	= new Recruit;
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>입사지원 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="RECRUIT_REG" />
		<div class="boxContentBody">
			<div class="boxMemberInfoTable_layer">
				<div class="layerTable"> 
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th><span>*</span>제목</th>
								<td>
								  <input type="text" class="input_text" size="50" name="rc_title" id="rc_title" value="<?=$rc_title?>" />
								</td>
							</tr>
							<tr>
								<th width="30%"><span>*</span>성명</th>
								<td width="70%">
									<input type="text" class="input_text" size="25" name="rc_name" id="rc_name" value="<?=$rc_name?>" />
								</td>
							</tr>
							<tr>
								<th><span>*</span>이메일</th>
								<td>
								  <input type="text" class="input_text" size="50" name="rc_email" id="rc_email" value="<?=$rc_email?>" />
								</td>
							</tr>
							<tr>
								<th><span>*</span>연락처</th>
								<td>
								  <input type="text" class="input_text" size="25" name="rc_mobile" id="rc_mobile" value="<?=$rc_mobile?>" />
								</td>
							</tr>              
							<tr>
								<th><span>*</span>생년월일</th>
								<td>
								  <input type="text" class="input_text" size="25" name="rc_birth" id="rc_birth" value="<?=$rc_birth?>" />
								</td>
							</tr>	
							<tr>
								<th><span>*</span>성별</th>
								<td>
									<label><input type="radio" class="chk" name="rc_sex" value="M" <? if($rc_sex == "M") { echo "checked";}?> > 남</label>
									<label><input type="radio" class="chk" name="rc_sex" value="F" <? if($rc_sex == "F") { echo "checked";}?>  > 여</label>
								</td>
							</tr>	
							<tr>
								<th><span>*</span>연령</th>
								<td>
								<input type="text" class="input_text" size="25" name="rc_age" id="rc_age" value="<?=$rc_age?>" />
								</td>
							</tr>
							<tr>
							<th><span>*</span>주소</th>
							<td>	
								<div style="margin-top:3px;">
									<input type="text" name="rc_post1" id="rc_post1" value="<?=$rc_post1?>" size="10" class="input_text" /> - 
									<input type="text" name="rc_post2" id="rc_post2" value="<?=$rc_post2?>" size="10" class="input_text" />
									<button class="btnSearch" id="search_btn">우편번호</button>
								</div>
								<div style="margin-top:3px;">
									<input type="text" name="rc_addr1" id="rc_addr1" value="<?=$rc_addr1?>" placeholder=" * 주소가 자동입력됩니다." size="60" class="input_text" />
								</div>
								<div style="margin-top:3px;">
									<input type="text" name="rc_addr2" id="rc_addr2" value="<?=$rc_addr2?>"  placeholder=" * 상세주소를 입력하십시오." size="60" class="input_text" />
								</div>
							</td>
						</tr>
						<tr>
							<th><span>*</span>사진</th>
							<td>
								<input type="file" title="파일선택" name="rc_picture" id="rc_picture" />
							</td>
						</tr>
						<tr>
						  <th><span>*</span>첨부파일</th>
						  <td>
							<input type="file" title="파일선택" name="rc_doc" id="rc_doc" />
						  </td>
						</tr>
						<tr>
							<th><span>*</span>합격여부</th>
							<td>
								<label>
									<input type="radio" class="chk" name="rc_pass" value="Y" <? if($rc_pass == "Y") { echo "checked";}?> > 합격
								</label>
								<label>
									<input type="radio" class="chk" name="rc_pass" value="N" <? if($rc_pass == "N") { echo "checked";}?>  > 불합격
								</label>
							</td>
						</tr>	
						</tbody>
					</table>
				</div>
				<div class="btnWrap">
				<button id="img_submit" class="btnSearch ">등록</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
</body>
</html>
<script src="/admin/js/jquery.alphanumeric.js" type="text/javascript"></script>
<script type="text/javascript" src="/admin/js/jquery.validate.js"></script>
<script type="text/javascript">

	$(document).ready(function(){	
														 
		$('#search_btn').click(function(){
				layerPop('ifm_addr','/admin/common/address_pop.html?obj=rc_post1&obj1=rc_post2&obj2=rc_addr1&obj3=rc_addr2&obj4=rc_addr1&obj5=rc_addr2', '100%', 500);
				return false;
		});														 
		
		$('#img_submit').click(function(){					
			$('#base_form').submit();
			return false;
		});
		
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});		
		
		
		$('#base_form').validate({
			rules: {	
				rc_name: { required: true },
				rc_email: { required: true },
				rc_mobile: { required: true },
				rc_bith: { required: true },
				rc_sex: { required: true },
				rc_age: { required: true }
			},
			messages: {	
				rc_name: { required: "성명을 입력하세요" },
				rc_email: { required: "이메일을 입력하세요" },
				rc_mobile: { required: "연락처를 입력하세요" },
				rc_bith: { required: "생년월일을 입력하세요" },
				rc_sex: { required: "성별을 입력하세요" },
				rc_age: { required: "나이를 입력하세요" },
			},
			errorPlacement: function(error, element) {
				var er = element.attr("name");
				error.insertAfter(element);
			},
			submitHandler: function(frm) {
			if (!confirm("등록하시겠습니까?")) return false;                
				frm.action = './proc/recruit_proc.php';
				frm.submit(); //통과시 전송
				return true;
			},

			success: function(element) {
			//
			}
		
		});
		
	});
</script>
