<div class="roundBox subSection2">
	<p class="iconTitle">주의사항</p>
	<ul class="listUl">
		<li>온누리 병원에 입원하시고자 하는 분들을 위한 상담 게시판입니다.</li>
		<li>본 게시판은 비공개형 게시판입니다.</li>
		<li>본 게시판의 운영 의도와 상관없는 글은 사전 동의 없이 삭제 또는 이동 될 수 있습니다.</li>
	</ul>
</div>
<fieldset class="bbsSearch subSection2">
	<form id="search_form" name="search_form" method="get" action="?">
  <legend>게시물 검색</legend>
  <select title="검색어 분류" name="search_key" id="search_key">
    <option value="jb_name" <?php if($_GET['search_key']=="jb_name") echo " selected";?>>이름</option>
    <option value="jb_title" <?php if($_GET['search_key']=="jb_title") echo " selected";?>>제목</option>
    <option value="jb_content" <?php if($_GET['search_key']=="jb_content") echo " selected";?>>내용</option>
  </select>
  <input type="text" class="txt" title="검색어 입력" name="search_keyword" id="search_keyword" value="<?=$_GET['search_keyword']?>" />
  <a href="#;" class="btnM btnSearch" id="search_submit">검색</a>
  </form>
</fieldset>
<div class="bbsList">
	<style type="text/css">
	.num {width:8%;}
	.date {width:10%;}
	.name {width:12%;}
	.subject {width:70%;}
	</style>
  <ul>
  	<?php include $GP -> INC_PATH . "/action/list.inc.php"; ?>		
  </ul>
</div>
<div class="btnWrap">
  <span class="btnLeft">
		<?
    if($_GET['search_key'] && $_GET['search_keyword']) {
      echo "<a href=\"javascript:;\" class=\"btnM btnList\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}'\" title='목록'>목록</a>";
    }
    ?>
  </span>  
  <span class="btnRight">
		<?
      //쓰기권한
      if($check_level >= $db_config_data['jba_write_level']) {
        echo "<a class='btnM btnWrite' href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&jb_mode=twrite'\" title='글쓰기'>글쓰기</a>";
      } else {
        echo "<a class='btnM btnWrite' href=\"javascript:alert('글쓰기 권한이 없습니다.');\" title='글쓰기'>글쓰기</a>";
      }
    ?>
  </span>
</div>
<div class="pagination"> 
  <?=$page_link?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#search_submit').click(function(){										
		$('#search_form').submit();
		return false;
	});

	$('#page_row').change(function(){
		var val = $(this).val();																	 			
		location.href="?dep1=<?=$_GET['dep1']?>&dep2=<?=$_GET['dep2']?>&search_key=<?=$_GET['search_key']?>&search_keyword=<?=$_GET['search_keyword']?>&page=<?=$_GET['page']?>&page_row=" + val;				
	});
});
</script>
