<?php	
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	include_once($GP -> CLS .'/class.list.php');		
	include_once($GP -> CLS."/class.treat.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Treat 	= new Treat;
	$C_Button 		= new Button;
	
	$args = array();
	$args['show_row'] = 50;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_Treat->Treat_Con_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	
	$cate1_select = $C_Func -> makeSelect_Normal('tti_item', $GP -> CON_TYPE, $tti_item, '', '::선택::');
	$cate2_select = $C_Func -> makeSelect_Normal('tti_ta_cnt', $GP -> CON_CNT, $tti_ta_cnt, '', '::선택::');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer boxSearchMember">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>치료법 컨텐츠 리스트</strong></span>
		</div>
		<form id="frm_find" name="frm_find" method="post">
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">
				<div class="btnWrap">
					<p class="txtLeft">순번 변경시 해당 행을 드래그하여 원하시는 위치에 놓으시면 됩니다.</p>
					<button id="img_reg" class="btnSearch btnRight">치료법 컨텐츠 등록</button>
					<span class='btnRight'>
						<?=$cate1_select?>
						<?=$cate2_select?>
					</span>
				</div>
				
				<div id="BoardHead" class="boxBoardHead">				
					<div class="boxMemberBoard">
							<table>						
								<thead>
									<tr>
										<th>No</th>
										<th>타입</th>
										<th>제목</th>
										<th>텍스트/동영상/주요문구</th>
										<th>이미지</th>
										<th>버튼</th>
										<th>탭/아코디언</th>
										<th>등록일</th>
										<th>수정/삭제</th>
									</tr>
								</thead>
								<tbody>
									<input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['tti_desc']?>" />
									<?
										$dummy = 1;
										for($i=0; $i<$data_list_cnt; $i++) {
											$tti_idx 			= $data_list[$i]['tti_idx'];
											$tti_item 			= $data_list[$i]['tti_item'];
											$tti_sub_tit 		= $data_list[$i]['tti_sub_tit'];
											$tti_sub_text1 	= stripslashes($data_list[$i]['tti_sub_text1']);

											if($tti_item != 9) { //동영상이 아닐경우
												$tti_sub_text1	= $C_Func->strcut_utf8($tti_sub_text1, 30, true, "...");
											}
											$tti_sub_text2 	= stripslashes($data_list[$i]['tti_sub_text2']);

											if($tti_item != 9) { //동영상이 아닐경우
												$tti_sub_text2	= $C_Func->strcut_utf8($tti_sub_text2, 30, true, "...");
											}

											$tti_img1 			= $data_list[$i]['tti_img1'];
											$tti_img_width	= $data_list[$i]['tti_img_width'];
											$tti_img2 			= $data_list[$i]['tti_img2'];
											$tti_img3 			= $data_list[$i]['tti_img3'];
											$tti_btn_cnt 		= $data_list[$i]['tti_btn_cnt'];
											$tti_btn_type		= $data_list[$i]['tti_btn_type'];
											$tti_btn_value 	= $data_list[$i]['tti_btn_value'];
											$tti_btn_link 		= $data_list[$i]['tti_btn_link'];
											$tti_ta_cnt 		= $data_list[$i]['tti_ta_cnt'];
											$tti_ta_tit 			= $data_list[$i]['tti_ta_tit'];
											$tti_ta_con 		= $data_list[$i]['tti_ta_con'];
											$tti_desc 			= $data_list[$i]['tti_desc'];
											$tti_regdate 		= date("Y.m.d", strtotime($data_list[$i]['tti_regdate']));
											
											$arr_btn_val = "";
											$arr_btn_link = "";
											$arr_btn_type = "";
											if($tti_btn_value != '') {
												$arr_btn_val = explode(';', $tti_btn_value);
												$arr_btn_link = explode(';', $tti_btn_link);
												$arr_btn_type = explode(';', $tti_btn_type);
											}

											$arr_ta_tit = "";
											$arr_ta_con = "";
											if($tti_ta_tit != '') {
												$arr_ta_tit = explode(';', $tti_ta_tit);
												$arr_ta_con = explode(';', $tti_ta_con);
											}

											$t_img1 = '';
											if($tti_img1 !=  '') {
												$t_img1 = "<img src='" . $GP -> UP_TREAT_URL . $tti_img1 . "' width='100px' />";
											}

											$t_img2 = '';
											if($tti_img2 !=  '') {
												$t_img2 = "<img src='" . $GP -> UP_TREAT_URL . $tti_img2 . "' width='100px' />";
											}

											$t_img3 = '';
											if($tti_img3 !=  '') {
												$t_img3 = "<img src='" . $GP -> UP_TREAT_URL . $tti_img3 . "' width='100px' />";
											}										
											
											$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./con_edit.php?tti_idx=" . $tti_idx. "', '100%', 600)", 50,'');	
											$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"con_delete('" . $tti_idx. "')", 50,'');
										?>
										<tr id="<?=$tti_idx?>">
											<td><?=$data['page_info']['start_num']--?></td>
											<td><?=$GP -> CON_TYPE[$tti_item]?></td>
											<td><?=$tti_sub_tit?></td>
											<td>
												<?
													if($tti_sub_text1 != '') { echo "일반/좌/동영상/주요문구 : " . $tti_sub_text1 ." <br/>"; }
													if($tti_sub_text2 != '') { echo "우 : " . $tti_sub_text2; }
												?>
											</td>
											<td>
												<?
													if($t_img1 != '') { echo "이미지1 : " . $t_img1 ." <br/>"; }
													if($tti_img_width != '') { echo "가로 사이즈 : " . $tti_img_width ." <br/>"; }
													if($t_img2 != '') { echo "이미지2 : " . $t_img2 ." <br/>"; }
													if($t_img3 != '') { echo "이미지3 : " . $t_img3; }
												?>
											</td>
											<td>
												<?
													if($arr_btn_val != '' ){
														for($k=0; $k<count($arr_btn_val); $k++) {
												?>
													<p>버튼_<?=$k?>
														<p>TYPE : <?=$arr_btn_type[$k]?></p>
														<p>VALUE : <?=$arr_btn_val[$k]?></p>
														<p>LINK : <?=$arr_btn_link[$k]?></p>
													</p>
												<?
														}
													}
												?>
											</td>
											<td>
												<?
													if($arr_ta_tit != '' ){
														for($j=0; $j<count($arr_ta_tit); $j++) {
												?>
													<p><?=$GP -> CON_TYPE[$tti_item]?>_<?=$j?>
														<p>TITLE : <?=$arr_ta_tit[$j]?></p>
														<p>CONTENT : <?=$arr_ta_con[$j]?></p>
													</p>
												<?
														}
													}
												?>
											</td>

											<td><?=$tti_regdate?></td>
											<td><?=$edit_btn?></td>
										</tr>
										 <?
												$dummy++;
											}
										?>						
								</tbody>
							</table>
						</div>			
					</div>
					<!--ul class="boxBoardPaging">
						<?=$page_link?>
					</ul-->
				</div>
				<div class="btnWrap ">
					<span class="btnRight">
						<button id="img_cancel" class="btnM btnGray ">닫기</button>
					</span>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	
	$(document).ready(function(){

		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	

		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};

		var cl_id = "";
		var ch_id = "";
		$(".boxMemberBoard tbody").sortable({
			helper: fixHelper,
			start: function( event, ui ) {
				cl_id = ui.item.attr('id');
			},	
			stop: function( event, ui ) {
				/*
				var tot_num = ui.item.parent().find('tr').length - 1;
				var now_num = ui.item.index();				
				
				if(now_num == tot_num) {
					fd_num = now_num - 1;					
					ch_id = ui.item.parent().find("tr:eq(" + fd_num + ")").attr('id');					
				}else {
					fd_num = now_num + 1;					
					ch_id = ui.item.parent().find("tr:eq(" + fd_num + ")").attr('id');					
				}
				*/
				
				var tot_num = ui.item.parent().find('tr').length;
				var tmp_id = "";
				for(i=0;  i< tot_num; i++){
					var val = ui.item.parent().find("tr:eq(" + i + ")").attr('id');
					tmp_id += val + ",";
				 }
				 tmp_id = tmp_id.slice(0,-1);

				 var max_desc = $('#max_desc').val();
				 console.log(tmp_id);
				 console.log(max_desc);
				
				
				$.ajax({
					type: "POST",
					url: "./proc/treat_proc.php",
					data: "mode=DT_AUTO_CH&tmp_id=" + tmp_id + "&max_desc=" + max_desc,
					dataType: "text",
					success: function(msg) {
		
						if($.trim(msg) == "true") {
							alert("변경되었습니다.");
							window.location.reload();
							return false;
						}else{
							alert('변경에 실패하였습니다.');
							return;
						}
					},
					error: function(xhr, status, error) { alert(error); }
				});
				
			},	
			
			
		}).disableSelection();

		$('#tti_ta_cnt').hide();

		$('#tti_item').change(function(){
			var val = $(this).val();

			if(val == 7 || val == 8) {
				$('#tti_ta_cnt').show();
			}else{
				$('#tti_ta_cnt').hide();
			}
		});

		$('#img_reg').click(function(){
				
				var item = $('#tti_item option:selected').val();
				var cnt = $('#tti_ta_cnt option:selected').val();

				if(item == '') {
					alert("등록하실 타입을 선택해주세요");
					return false;
				}

				if(item == 7 || item == 8) {
					if(cnt == '') {
						alert("생성하실 수량을 선택해주세요");
						return false;
					}
				}
				
				layerPop('ifm_reg','./con_reg.php?tt_idx=<?=$_GET['tt_idx']?>&item=' + item + '&cnt=' + cnt, '100%', 600)																 	
				return false;
		});
		
	});
	
	function con_delete(tti_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/treat_proc.php",
			data: "mode=TREAT_CON_DEL&tti_idx=" + tti_idx,
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
	
</script>
</body>
</html>
