<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.treat.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Treat 	= new Treat;
	$C_Button 		= new Button;
	
	$args = array();
	$args['show_row'] = 15;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_Treat->Treat_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	
	$cate1_select = $C_Func -> makeSelect_Normal('tt_cate1', $GP -> CATE1, $tt_cate1, '', '::선택::');
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
			<? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?>										
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				<li>
					<strong class="tit">등록일</strong>
					<span><input type="text" name="s_date" id="s_date" value="<?=$_GET['s_date']?>" class="input_text" size="13"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$_GET['e_date']?>" class="input_text" size="13" /></span>
				</li>	
				<li>
					<strong class="tit">구분</strong>
					<span>
						<?=$cate1_select?>
						<select name="tt_cate2" id="tt_cate2">
							<option value="">:::선택:::</option>
						</select>            
					</span>					
				</li>				
				<li>
					<strong class="tit">검색조건</strong>
					<span>
					<select name="search_key" id="search_key">
						<option value="">:: 선택 ::</option>
						<option value="tt_title" <? if($_GET['search_key'] == "tt_title"){ echo "selected";}?> >제목</option>
					</select>
					</span>
					<span><input type="text" name="search_content" id="search_content" value="<?=$_GET['search_content']?>" class="input_text" size="16" /></span>
					<span><button id="search_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>	

		<div class="btnWrap">
		<button onClick="layerPop('ifm_reg','./treat_reg.php', '100%', 550)"; class="btnSearch btnRight">치료법 등록</button>
		</div>

		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<colgroup>
							<col />
							<col />
							<col />
							<col />
							<col />
							<col />
							<col style="width:101px;"/>
						</colgroup>
						<thead>
							<tr>
								<th>No</th>
								<th>CATE1</th>
								<th>CATE2</th>
								<th>TITLE</th>
								<th>이미지</th>
								<th>요약글</th>
								<th>조회수</th>
								<th>순조회수</th>
								<th>메인노출</th>
								<th>등록일</th>
								<th>컨텐츠</th>
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$tt_idx 		= $data_list[$i]['tt_idx'];
									$tt_cate1		= $data_list[$i]['tt_cate1'];
									$tt_cate2		= $data_list[$i]['tt_cate2'];
									$tt_title		= $data_list[$i]['tt_title'];	
									$tt_img		= $data_list[$i]['tt_img'];	
									$tt_hit			= $data_list[$i]['tt_hit'];	
									$tt_ori_hit	= $data_list[$i]['tt_ori_hit'];	
									$tt_summary		= $data_list[$i]['tt_summary'];	
									$tt_summary	= $C_Func->strcut_utf8($tt_summary, 30, true, "...");
									$tt_regdate	= date("Y.m.d", strtotime($data_list[$i]['tt_regdate']));
									$tt_main_view 	= $data_list[$i]['tt_main_view'];	

									$t_img = '';
									if($tt_img !=  '') {
										$t_img = "<img src='" . $GP -> UP_TREAT_URL . $tt_img . "' width='100px' />";
									}

									$con_btn = $C_Button -> getButtonDesign('type2','컨텐츠',0,"layerPop('ifm_reg','./con_list.php?tt_idx=" . $tt_idx. "', '100%', 800)", 50,'');
									$con_btn .= $C_Button -> getButtonDesign('type2','미리보기',0,"show_view('" . $tt_idx. "')", 50,'');
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./treat_edit.php?tt_idx=" . $tt_idx. "', '100%', 550)", 50,'');	
									$edit_btn .= "" . $C_Button -> getButtonDesign('type2','삭제',0,"treat_delete('" . $tt_idx. "')", 50,'');							
								?>
										<tr>
											<td><?=$data['page_info']['start_num']--?></td>
											<td><?=$GP->CATE1[$tt_cate1]?></td>
											<td><?=$GP->CATE2[$tt_cate1][$tt_cate2]?></td>
											<td><?=$tt_title;?></td>
											<td><?=$t_img;?></td>
											<td><?=$tt_summary;?></td>
											<td><?=$tt_hit;?></td>
											<td><?=$tt_ori_hit;?></td>
											<td><?=($tt_main_view == "Y") ? "노출" : "비노출";?></td>
											<td><?=$tt_regdate;?></td>
											<td>
												<?=$con_btn?>
											</td>
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
			<ul class="boxBoardPaging">
				<?=$page_link?>
			</ul>
		</div>
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->
</body>
</html>
<script type="text/javascript">

	function show_view(tt_idx) {
		var w_url = "/contents/contents_view_new.html?tt_idx=" + tt_idx;
		fnWinPopup(w_url, '미리보기', 1600, 1200);
	}
	$(document).ready(function(){														 
	
		callDatePick('s_date');
		callDatePick('e_date');

		$('#search_submit').click(function(){																			 

			if($.trim($('#search_content').val()) != '')
			{
				if($('#search_key option:selected').val() == '')
				{
					alert('검색조건을 선택하세요');
					return false;
				}
			}

			if($('#search_key option:selected').val() != '')
			{
				if($.trim($('#search_content').val()) == '')
				{
					alert('검색내용을 입력하세요');
					$('#search_content').focus();
					return false;
				}
			}


			$('#base_form').submit();
			return false;
		});
		
		
		<?
			if($_GET['tt_cate1'] != '' && $_GET['tt_cate2'] != '') {
		?>
		$.ajax({
			type: "POST",
			url: "cate1.php",
			data: "tt_cate1=<?=$_GET['tt_cate1']?>&tt_cate2=<?=$_GET['tt_cate2']?>",
			dataType: "text",
			success: function(data) {
				$('#tt_cate2').empty();
				$('#tt_cate2').append(data);
			},
			error: function(xhr, status, error) { alert(error); }
		});	
		<? } ?>		
	
		
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
	});

	function treat_delete(tt_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/treat_proc.php",
			data: "mode=TREAT_DEL&tt_idx=" + tt_idx,
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