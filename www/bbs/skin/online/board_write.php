<script type="text/javascript" src="<?=$GP -> JS_SMART_PATH?>/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/admin/jquery.base64.js"></script>
<form name="frm_Board" id="frm_Board" action="<?=$get_par;?>" method="post" enctype="multipart/form-data">
	<input type="hidden" value="Y" id="jb_secret_check" name="jb_secret_check" />

	<h2 class="subTitle2">개인정보수집 방침</h2>
	<div class="privacyBox" tabindex="0">
		'온누리요양병원' 은 (이하 '회사'는) 고객님의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 있습니다.<br />
		회사는 개인정보취급방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다.<br />
		회사는 개인정보취급방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.<br /><br />

		ο 본 방침은 : 2010 년 12 월 01 일 부터 시행됩니다.<br /><br />

		■ 수집하는 개인정보 항목<br /><br />

		- 수집하는 개인정보의 항목<br />
		회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다.<br />
		ο 수집항목 : 이름 , 로그인ID , 비밀번호 , 자택 전화번호 , 자택 주소 , 휴대전화번호 , 이메일 , 주민등록번호, 서비스 이용기록 , 접속 로그 , 쿠키 , 접속 IP 정보ο 개인정보 수집방법 : 홈페이지(회원가입)<br /><br />

		- 개인정보의 수집 및 이용목적<br />
		회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br />
		ο  서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산<br />
		ο  콘텐츠 제공<br /><br />

		- 회원 관리<br />
		회원제 서비스 이용에 따른 본인확인, 개인 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 연령확인 , 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인 , 불만처리 등 민원처리, 고지사항 전달<br /><br />
		- 마케팅 및 광고에 활용<br />
		이벤트 등 광고성 정보 전달, 인구통계학적 특성에 따른 서비스 제공 및 광고 게재 , 접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계<br /><br />
		- 개인정보의 보유 및 이용기간<br />
		원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다.<br />
		단, 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 아래와 같이 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.<br /><br />
		- 보존 항목 : 이름, 로그인ID, 비밀번호, 자택 전화번호, 자택 주소, 휴대전화번호, 이메일, 주민등록번호, 서비스 이용기록, 접속 로그, 쿠키, 접속 IP 정보<br /><br />
		- 보존 근거 : 신용정보의 이용 및 보호에 관한 법률<br /><br />
		- 보존 기간 : 3년<br /><br />
		표시/광고에 관한 기록 : 6개월 (전자상거래등에서의 소비자보호에 관한 법률)<br />
		소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률)<br />
		신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년 (신용정보의 이용 및 보호에 관한 법률)
	</div>
	<p class="privacyAgree">
		<label><input type="radio" class="chk" name="privacyAgree" /> 동의합니다.</label>
		<label><input type="radio" class="chk" name="privacyAgree" onclick="alert('개인정보수집 방침에 동의하셔야 상담글을 남기실 수 있습니다.')" /> 동의하지 않습니다.</label>
	</p>
	<h2 class="subTitle2">정보입력</h2>
  <div class="bbsWrite">
    <table>
      <caption>게시물 작성</caption>
      <colgroup>
        <col />
        <col />
      </colgroup>
      <tbody>
		 <tr>
          <th scope="row">제목</th>
          <td><input type="text" class="txt w100" title="제목 입력" placeholder="제목을 입력해 주세요." id="jb_title" name="jb_title" /></td>
        </tr>
        <tr>
          <th scope="row">작성자</th>
          <td><input type="text" class="txt w100" title="작성자 입력" placeholder="작성자를 입력해 주세요."id="jb_name" name="jb_name" value="<?=$check_name?>" /></td>
        </tr>
        <tr>
          <th scope="row">이메일</th>
          <td><input type="text" class="txt w100" title="이메일 입력" placeholder="이메일을 입력해 주세요." id="jb_email" name="jb_email" value="<?=$_SESSION['suseremail']?>" /></td>
        </tr>
		<tr>
          <th scope="row">연락처</th>
          <td><input type="text" class="txt w100" title="연락처 입력" placeholder="연락처를 입력해 주세요." id="jb_mobile" name="jb_mobile" value="<?=$_SESSION['suserphone']?>" /></td>
        </tr>
        <?php
        //회원일 경우 비밀번호를 입력할 필요가 없다.
        if(empty($check_id)) {
        ?>
        <tr>
          <th scope="row">비밀번호</th>
          <td><input type="text" class="txt w100" title="비밀번호 입력" placeholder="비밀번호를 입력해 주세요." id="jb_password" name="jb_password" /></td>
        </tr>
        <?php
        } else {
          $password_key=md5($check_id);	
          $tm=explode(" ",microtime());
          $jb_password=$password_key . $tm[1];
          echo ("<input type=\"hidden\" name=\"jb_password\" value=\"${jb_password}\">");
        }
        ?>
		<?
			 if(isset($check_id) && $check_level>=9){
		?>
        <tr>
          <th scope="row">공개여부</th>
          <td>            
            <?            
              echo "<label><input type=\"checkbox\" value=\"Y\" id=\"jb_notice_check\" name=\"jb_notice_check\" class='chk'>공지</label>";            
            ?>
          </td>
        </tr>
		<? } ?>

        <tr>
          <th scope="row">첨부파일</th>
          <td class="files">
           <?php
						//첨부파일의 숫자는 $i의 범위로 조정하면 된다.
						for($i=0; $i<1; $i++) {
						?>
						<span class="inputFile">
              <input type="text" class="txt" placeholder="첨부파일" readonly />
              <span class="fileBtn">
                <input type="file" title="파일선택" name="jb_file[]" />
                <span class="btnT btnFile">파일선택</span>
              </span>
            </span>
						<? } ?>
          </td>
        </tr>
        <tr>
          <th scope="row">본문</th>
          <td>
            <textarea name="jb_content" id="jb_content" style="display:none"></textarea>
            <textarea name="ir1" id="ir1" style="width:100%; height:300px; min-width:280px; display:none;"></textarea>
          </td>
        </tr>      
        <tr>
          <th scope="row">링크</th>
          <td><input type="text" class="txt w100" title="링크 입력" placeholder="링크" id="jb_homepage" name="jb_homepage" /></td>
        </tr>
        <tr>
          <th scope="row">자동입력방지</th>
          <td>
            <strong class="mobTh">자동입력방지</strong>
            <img src="<?=$GP -> IMG_PATH?>/zmSpamFree/zmSpamFree.php?zsfimg=<?php echo time();?>" id="zsfImg" alt="아래 새로고침을 클릭해 주세요." style="vertical-align:middle;" />
            <input type="text" class="txt" title="자동입력방지 숫자 입력" style="width:60px;" name="zsfCode" id="zsfCode" />
            <a href="#;" class="btnT btnReplace" onclick="document.getElementById('zsfImg').src='<?=$GP -> IMG_PATH?>/zmSpamFree/zmSpamFree.php?re&zsfimg=' + new Date().getTime(); return false;">새로고침</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="btnWrap">
    <a href="#;" id="img_submit" class="btnM btnConfirm">글쓰기</a>
    <a href="javascript:history.go(-1);" class="btnM btnCancel">취소</a>
  </div>
  <input type="hidden" name="jb_bruse_check" value="Y" checked>
  <input type="hidden" name="img_full_name" id="img_full_name" />
  <input type="hidden" name="upfolder" id="upfolder" value="jb_<?=$jb_code?>" />
</form>
<script type="text/javascript">
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir1",
		sSkinURI: "/bbs/smarteditor/SmartEditor2Skin.html",
		htParams : {
			bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
			fOnBeforeUnload : function(){
				//alert("완료!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

	$('#img_submit').click(function(){
		
		if($('#jb_title').val() == '')	{
			alert('제목을 입력하세요');
			$('#jb_title').focus();
			return false;
		}		
		
		if($('#jb_name').val() == '')	{
			alert('이름을 입력하세요');
			$('#jb_name').focus();
			return false;
		}
		
		if($('#jb_password').val() == '')	{
			alert('비밀번호를 입력하세요');
			$('#jb_password').focus();
			return false;
		}
		
		if($('#jb_email').val() == '' || !CheckEmail($('#jb_email').val()))	{
			alert('이메일을 정확히 입력하세요');
			$('#jb_email').focus();
			return false;
		}
	
		oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
	
		var con	= $('#ir1').val();
		
		
		$('#jb_content').val(con);		

		if($('#jb_content').val() == '' || $('#jb_content').val() == '<br> ')
		{
			alert('내용을 입력하세요');
			return false;
		}	
		var t = $.base64Encode($('#ir1').val());		
		$('#jb_content').val(t);
		
			
		if($('#zsfCode').val() == '')	{
			alert('자동방지 입력키를 입력하세요');
			$('#zsfCode').focus();
			return false;
		}		
		

		$('#frm_Board').submit();
		return false;
		
	});
	

	function CheckEmail(str)
	{
		 var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		 if (filter.test(str)) { return true; }
		 else { return false; }
	}

	function insertIMG(filename){
		var tname = document.getElementById('img_full_name').value;

		if(tname != "")
		{
			document.getElementById('img_full_name').value = tname + "," + filename;
		}
		else
		{
			document.getElementById('img_full_name').value = filename;
		}
	}
</script>
