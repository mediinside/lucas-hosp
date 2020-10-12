<div class="bbsList">
<style type="text/css">
.num {width:13%;}
.subject {width:35%;}
.job {width:11%;}
.pos {width:11%;}
.status {width:11%;}
.date {width:19%;}
</style>
  <ul>
  	<?php include $GP -> INC_PATH . "/action/recruit_list.inc.php"; ?>		
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
        //echo "<a class='btnM btnWrite' href=\"javascript:alert('글쓰기 권한이 없습니다.');\" title='글쓰기'>글쓰기</a>";
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