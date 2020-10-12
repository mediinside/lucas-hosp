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
	$rst = $C_Treat -> Treat_Con_view_1($args);	
?>
<div class="cureList">
  <ul>
  	<?
    	if(count($rst) > 0) {
				for($i=0; $i<count($rst); $i++) {
					$tc_idx = $rst[$i]['tc_idx'];
					$tc_img = $rst[$i]['tc_img'];
					$tc_title = $rst[$i]['tc_title'];
					$tc_summary	 = $rst[$i]['tc_summary'];
					$tc_content	 = $C_Func->dec_contents_view($rst[$i]['tc_content']);
					
					$tc_v_con = base64_encode($tc_content);
					
					$img_src = "";
					if($tc_img != '') {
						$img_src = "<img src='" . $GP -> UP_TREAT_URL . $tc_img . "' alt='' />";
					}else{
						$img_src = "<img src='/images/no_image.jpg' alt='' />";
					}
		?>
    <li>
      <a href="#" id="con_<?=$tc_idx?>">
      	<input type="hidden" id="v_con_<?=$tc_idx?>" value="<?=$tc_v_con?>" />
        <input type="hidden" id="v_tit_<?=$tc_idx?>" value="<?=$tc_title?>" />
        <span class="thumb"><?=$img_src?></span>
        <strong class="tit"><?=$tc_title?></strong>
        <span class="txt"><?=$tc_summary?></span>
      </a>
    </li>
    <?					
				}
			}
		?>
  </ul>
	<div class="cureLayer">
		<div class="cureWrap">
			<h2 class="cureTitle">약물치료</h2>
			<div class="cureContent">
				<!-- iframe src="" width='100%' height='100%' frameborder="0" title="치료법"></iframe -->
			</div>
			<button type="button" class="closeBtn">닫기</button>
		</div>
	</div>
</div>