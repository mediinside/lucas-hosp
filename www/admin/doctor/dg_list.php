<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	if($_SESSION['adminid'] != "adm_medi") {
		$C_Func -> go_url ('/admin/login/?reurl=' . urlencode($GP -> NOWPAGE));
		exit();
	}
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.doctor.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_Doctor 	= new Doctor;
	$C_Button 		= new Button;
	
	//error_reporting(E_ALL);
	//@ini_set("display_errors", 1);
	
	$args = array();
	$args['show_row'] = 50;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_Doctor->Doctor_Group_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	
	//$cn_select = $C_Func -> makeSelect_Normal('dr_clinic', $GP -> DOCTOR_GR_CLINIC, $dr_clinic, '', '::선택::');	
	//$cn_select2 = $C_Func -> makeSelect_Normal('dr_center', $GP -> CENTER_TYPE, $dr_center, '', '::선택::');	
	$cn_select2 = $C_Func -> makeSelect_Normal('dtg_type', $GP -> DOCTOR_TYPE, $dtg_type, '', '::선택::');		
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
					<strong class="tit">분류</strong>
					<span><?=$cn_select2?></span>
				</li>				
				<li>
					<strong class="tit">검색조건</strong>
					<span>
					<select name="search_key" id="search_key">
						<option value="">:: 선택 ::</option>
						<option value="dr_name" <? if($_GET['search_key'] == "mb_name"){ echo "selected";}?> >이름</option>
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
			<p class="txtLeft">순번 변경시 해당 행을 드래그하여 원하시는 위치에 놓으시면 됩니다.</p>
			<button onClick="layerPop('ifm_reg','./dg_reg.php', '100%', 400)"; class="btnSearch btnRight">단체사진 등록</button>
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
							<col />
							<col style="width:101px;" />
						</colgroup>
						<thead>
							<tr>
								<th>No</th>
								<th>분류</th>
								<th>진료과/부서</th>
								<th>사진</th>
								<th>등록일</th>
								<th>수정/삭제</th>
							</tr>
						</thead>
						<tbody>
							<input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['dtg_desc']?>" />
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$dtg_idx 			= $data_list[$i]['dtg_idx'];
									$dtg_type		= $data_list[$i]['dtg_type'];
									$dtg_clinic		= $data_list[$i]['dtg_clinic'];
									$dtg_image		= $data_list[$i]['dtg_image'];
									$dtg_regdate 	= $data_list[$i]['dtg_regdate'];
									$dtg_desc 		= $data_list[$i]['dtg_desc'];	
									
									$dr_img = '';
									if($dtg_image !=  '') {
										$dr_img = "<img src='" . $GP -> UP_DOCTOR_URL . $dtg_image . "' width='100px' />";
									}

									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./dg_edit.php?dtg_idx=" . $dtg_idx. "', '100%', 350)", 50,'');	
									$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"dtg_delete('" . $dtg_idx. "')", 50,'');									
								?>
										<tr id="<?=$dtg_idx?>">
											<td><?=$data['page_info']['start_num']--?></td>
											<td><?=$GP -> DOCTOR_TYPE[$dtg_type]?></td>
											<td><?=$GP -> DOCTOR_GR_CLINIC[$dtg_clinic]?></td>
											<td><?=$dr_img?></td>
											<td><?=$dtg_regdate?></td>
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

	
		
	$(document).ready(function(){

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
					url: "./proc/dt_proc.php",
					data: "mode=DTG_AUTO_CH&tmp_id=" + tmp_id + "&max_desc=" + max_desc,
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

	});

	function dtg_delete(dtg_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/dt_proc.php",
			data: "mode=DOCTOR_GR_DEL&dtg_idx=" + dtg_idx,
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