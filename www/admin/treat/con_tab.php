
<table>
	<colgroup>
		<col style="width:12%;" />
		<col />
		<col style="width:400px;" />
	</colgroup>
	<tr>		
		<td>
			탭 형태
		</td>
		<td>
			<p>
				<select name="tti_sub_tit_type">
					<option value="subTitle" <?if($tti_sub_tit_type == "subTitle"){ echo "selected";}?> >서브타이틀 없음</option>
					<option value="subTitle2" <?if($tti_sub_tit_type == "subTitle2"){ echo "selected";}?>>서브타이틀2</option>
					<option value="subTitle3" <?if($tti_sub_tit_type == "subTitle3"){ echo "selected";}?>>서브타이틀3</option>
				</select>
				<input type="text" class="txt" placeholder="서브타이틀 입력" name="tti_sub_tit" id="tti_sub_tit" value="<?=$tti_sub_tit?>" />
			</p>
			<?
				if($_GET['tti_idx'] != '') {
					if($arr_ta_tit != '' ){
						for($j=0; $j<count($arr_ta_tit); $j++) {
			?>
				<p>
					<input type="text" class="txt" placeholder="탭 제목 입력" style="width:98%;margin:0 0 5px;" name="tti_ta_tit_<?=$j?>" id="tti_ta_tit_<?=$j?>" value="<?=$arr_ta_tit[$j]?>" />
					<textarea rows="3" cols="20" placeholder="탭 내용 입력" name="tti_ta_con_<?=$j?>" id="tti_ta_con_<?=$j?>"><?=$arr_ta_con[$j]?></textarea>
				</p>
			<?
						}
					}
				}else{
					for($j=0; $j<$_GET['cnt']; $j++) {
			?>
				<p>
					<input type="text" class="txt" placeholder="탭 제목 입력" style="width:98%;margin:0 0 5px;" name="tti_ta_tit_<?=$j?>" id="tti_ta_tit_<?=$j?>" value="<?=$arr_ta_tit[$j]?>" />
					<textarea rows="3" cols="20" placeholder="탭 내용 입력" name="tti_ta_con_<?=$j?>" id="tti_ta_con_<?=$j?>"><?=$arr_ta_con[$j]?></textarea>
				</p>
			<?
					}
				}
			?>
		</td>
		<td>
			<select name="btn_add" id="btn_add">
				<option value=''>버튼추가</option>
				<option value='1' <?if($tti_btn_cnt == "1"){ echo "selected";}?>>버튼 1개</option>
				<option value='2' <?if($tti_btn_cnt == "2"){ echo "selected";}?>>버튼 2개</option>
				<option value='3' <?if($tti_btn_cnt == "3"){ echo "selected";}?>>버튼 3개</option>
			</select>
			<div id="btn_view">
				<?
					for($k=0; $k<count($arr_btn_val); $k++) {
				?>
					<p>
						<select name="btn_type_<?=$k?>" id="btn_type_<?=$k?>">
							<option value="btnLType1" <?if($arr_btn_type[$k] == "btnLType1"){ echo "selected";}?>>type1</option>
							<option value="btnLType2" <?if($arr_btn_type[$k] == "btnLType2"){ echo "selected";}?>>type2</option>
							<option value="btnLType3" <?if($arr_btn_type[$k]== "btnLType3"){ echo "selected";}?>>type3</option>
						</select>
						<input type="text" class="txt" placeholder="버튼명 입력" style="width:90px;" name="btn_val_<?=$k?>" id="btn_val_<?=$k?>" value="<?=$arr_btn_val[$k]?>" />
						<input type="text" class="txt" placeholder="url 입력" style="width:180px;" name="btn_link_<?=$k?>" id="btn_link_<?=$k?>" value="<?=$arr_btn_link[$k]?>" />
					</p>
				<?
					}
				?>
			</div>
		</td>
	</tr>
</table>
<script type="text/javascript">

	$(document).ready(function(){	
		$('#btn_add').change(function(){
			var val = $(this).val();

			if(val != '') {
				$('#btn_view').empty();
				for(var i=0; i<val; i++) {
					$('#btn_view').append('<p><select name="btn_type_' + i + '" id="btn_type_' + i + '"><option value="btnLType1">type1</option><option value="btnLType2">type2</option><option value="btnLType3">type3</option></select><input type="text" class="txt" placeholder="버튼명 입력" style="width:90px;" name="btn_val_' + i + '" id="btn_val_' + i + '" /><input type="text" class="txt" placeholder="url 입력" style="width:180px;" name="btn_link_' + i + '" id="btn_link_' + i + '" /></p>');
				}
			}
		});
	});
</script>