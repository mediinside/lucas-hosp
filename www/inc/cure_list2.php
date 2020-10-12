<?
	include_once  $_SERVER[DOCUMENT_ROOT].'./_init.php';
	include_once($GP -> CLS."/class.treat.php");
	$C_Treat 	= new Treat;
	
	$tcs_cate3 = "A-1-1";
	if($_GET['tcs_cate3'] != '') {
		$tcs_cate3 = $_GET['tcs_cate3'];
	}
	
	$args = '';
	$args['tcs_cate3'] = $tcs_cate3;
	$rst2 = $C_Treat -> Treat_Con_view_2($args);
?>
<div class="cureList">
  <ul>
  	<?
    	if(count($rst2) > 0) {
				for($i=0; $i<count($rst2); $i++) {
					$tc_idx2 = $rst2[$i]['tc_idx'];
					$tc_img2 = $rst2[$i]['tc_img'];
					$tc_title2 = $rst2[$i]['tc_title'];
					$tc_summary2	 = $rst2[$i]['tc_summary'];
					$tc_content2	 = $C_Func->dec_contents_view($rst2[$i]['tc_content']);
					
					$tc_v_con2 = base64_encode($tc_content2);
					
					$img_src2 = "";
					if($tc_img2 != '') {
						$img_src2 = "<img src='" . $GP -> UP_TREAT_URL . $tc_img2 . "' alt='' />";
					}else{
						$img_src2 = "<img src='/images/no_image.jpg' alt='' />";
					}
		?>
    <li>
      <a href="#" id="con_<?=$tc_idx2?>">
      	<input type="hidden" id="v_con_<?=$tc_idx2?>" value="<?=$tc_v_con2?>" />
        <input type="hidden" id="v_tit_<?=$tc_idx2?>" value="<?=$tc_title2?>" />
        <span class="thumb"><?=$img_src2?></span>
        <strong class="tit"><?=$tc_title2?></strong>
        <span class="txt"><?=$tc_summary2?></span>
      </a>
    </li>
    <?					
				}
			}
		?>
  </ul>
	<div class="cureLayer">
		<div class="cureWrap">
			<h2 class="cureTitle">수술치료</h2>
			<div class="cureContent">
				<!-- iframe src="" width='100%' height='100%' frameborder="0" title="치료법"></iframe -->
			</div>
			<button type="button" class="closeBtn">닫기</button>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	var listMenu = $('.cureList a')
		,closeLayer = $('.closeBtn');
	listMenu.click(function(){															
		var _this = $(this)
			,layer = _this.parent().parent().parent().find('.cureLayer');
		
		var id = _this.attr('id');
		var arr_tmp = id.split('con_');
		var num = arr_tmp[1];		
		var con = $('#v_con_' + num).val();
		var tit = $('#v_tit_' + num).val();
		
		con = $.base64Decode(con);
		$('.cureTitle').html(tit);
		$('.cureContent').html(con);		
		layer.fadeIn();				
		return false;
	});
	closeLayer.click(function(){
		$('.cureLayer').fadeOut();
	});
})
</script>