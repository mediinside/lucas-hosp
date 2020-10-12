<?
CLASS Treat extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}

	


	// desc  : 치료법 순조회수 
	// auth  : 
	// param
	function Con_Ori_Hit($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update tblTreat set tt_ori_hit = tt_ori_hit +1  where tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc  : 치료법 조회수 
	// auth  : 
	// param
	function Con_Hit($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update tblTreat set tt_hit = tt_hit +1  where tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc  : 치료법 이미지 
	// auth  : 
	// param
	function TREAT_ImgUpdate($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$addQry = " tt_img  = '' ";	
		
		$qry = "
			update 
				tblTreat
			set
				$addQry
			where 
				tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}


	// desc  : 치료법 컨텐츠 이미지 
	// auth  : 
	// param
	function TREAT_Con_ImgUpdate($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		if($type == "IMG1") {
			$addQry = " tt_img  = '' ";
		}
		
		if($type == "IMG2") {
			$addQry = " tti_img2  = '' ";
		}

		if($type == "IMG3") {
			$addQry = " tti_img3  = '' ";
		}
		
		$qry = "
			update 
				tblTreatItem 
			set
				$addQry
			where 
				tti_idx = '$tti_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc  : 치료법 컨텐츠 내용 삭제
	// auth  : 
	// param
	function TREAT_Con_Info_Del_Detail($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			delete from tblTreatItem where tti_idx = '$tti_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc  : 치료법 컨텐츠 내용 삭제위해 가져오기
	// auth  : 
	// param
	function TREAT_Con_Info_Data_Detail($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			select * from tblTreatItem where tti_idx = '$tti_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 치료법 컨텐츠 가져오기
	// auth  : 
	// param
	function Treat_Con_Data($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;	

		$qry = "
			select * from tblTreatItem where tt_idx = '$tt_idx' order by tti_desc desc
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}

	// desc	 : 순위변경
	// auth  : 
	// param
	function DT_AUTO_CHAGE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		

		$arr_tmp = explode(',',$tmp_id);
		
		//$max_desc = 22;
		for($i=0; $i<count($arr_tmp); $i++) {
			$idx = $arr_tmp[$i];			
			$qry = " update tblTreatItem set tti_desc = '$max_desc' where tti_idx = '$idx'	";
			$rst =  $this -> DB -> execSqlUpdate($qry);
			$max_desc--; 
		}
		
	}

	// desc  : 치료법 컨텐츠 수정
	// auth  : 
	// param
	function TREAT_CON_MODI($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			update
				tblTreatItem
			set
				tti_sub_tit_type = '$tti_sub_tit_type',
				tti_sub_tit = '$tti_sub_tit',
				tti_sub_text1 = '$tti_sub_text1',
				tti_sub_text2 = '$tti_sub_text2',
				tti_btn_cnt = '$tti_btn_cnt',
				tti_btn_type = '$tti_btn_type',
				tti_btn_value = '$tti_btn_value',
				tti_btn_link = '$tti_btn_link',
				tti_img1 = '$tti_img1',
				tti_img2 = '$tti_img2',
				tti_img3 = '$tti_img3',
				tti_img_width = '$tti_img_width',
				tti_ta_cnt = '$tti_ta_cnt',
				tti_ta_tit = '$tti_ta_tit',
				tti_ta_con = '$tti_ta_con'
			where
				tti_idx = '$tti_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc  : 치료법 컨텐츠 등록
	// auth  : 
	// param
	function TREAT_CON_REG($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "select tti_desc  from tblTreatItem where tt_idx='$tt_idx' order by tti_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$tti_desc = $rst['tti_desc'] + 1;
		}else{
			$tti_desc = 1;
		}

		$qry = "
			INSERT INTO
				tblTreatItem
				(
					tti_idx,
					tt_idx,
					tti_item,
					tti_sub_tit_type,
					tti_sub_tit,
					tti_sub_text1,
					tti_sub_text2,
					tti_btn_cnt,
					tti_btn_type,
					tti_btn_value,
					tti_btn_link,
					tti_img1,
					tti_img2,
					tti_img3,
					tti_img_width,
					tti_ta_cnt,
					tti_ta_tit,
					tti_ta_con,
					tti_desc,
					tti_regdate
				)
				VALUES
				(
					''
					, '$tt_idx'
					, '$tti_item'
					, '$tti_sub_tit_type'
					, '$tti_sub_tit'
					, '$tti_sub_text1'
					, '$tti_sub_text2'
					, '$tti_btn_cnt'
					, '$tti_btn_type'
					, '$tti_btn_value'
					, '$tti_btn_link'
					, '$tti_img1'
					, '$tti_img2'
					, '$tti_img3'
					, '$tti_img_width'
					, '$tti_ta_cnt'
					, '$tti_ta_tit'
					, '$tti_ta_con'
					, '$tti_desc'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}

	// desc  : 치료법 컨텐츠 내용 삭제
	// auth  : 
	// param
	function TREAT_Con_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			delete from tblTreatItem where tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc  : 치료법 삭제
	// auth  : 
	// param
	function TREAT_Info_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			delete from tblTreat where tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}



	// desc  : 치료법 컨텐츠 내용 삭제위해 가져오기
	// auth  : 
	// param
	function TREAT_Con_Info_Data($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			select * from tblTreatItem where tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}

	// desc	 : 치료법 컨텐츠
	// auth  : 
	// param
	function Treat_Con_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 and tt_idx='$tt_idx' ";
		

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "tti_idx";
		$args['q_col'] = "*";
		$args['q_table'] = " tblTreatItem";
		$args['q_where'] = $addQry;
		$args['q_order'] = "tti_desc desc";
		$args['q_group'] = "";

		$args['tail'] = "tt_idx=$tt_idx&s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}


	// desc	 : 치료법 수정
	// auth  : JH 2013-09-16 월요일
	// param
	function TREAT_Info_Modify($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			update
				tblTreat
			set
				tt_cate1 = '$tt_cate1',
				tt_cate2 = '$tt_cate2',
				tt_title = '$tt_title',
				tt_img = '$tt_img',
				tt_main_view = '$tt_main_view',
				tt_summary = '$tt_summary'
			where 
				tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	
	}

	// desc	 : 치료법 상세
	// auth  : JH 2013-09-16 월요일
	// param
	function TREAT_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			select * from tblTreat where tt_idx = '$tt_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}

	// desc	 : 치료법 등록
	// auth  : JH 2013-09-16 월요일
	// param
	function TREAT_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		$qry = "
			INSERT INTO
				tblTreat
				(
					tt_idx,
					tt_cate1,
					tt_cate2,
					tt_title,
					tt_img,
					tt_summary,
					tt_main_view,
					tt_regdate
				)
				VALUES
				(
					''
					, '$tt_cate1'
					, '$tt_cate2'
					, '$tt_title'
					, '$tt_img'
					, '$tt_summary'
					, '$tt_main_view'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	

	
	
	// desc	 : 치료법 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Treat_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " tt_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}
		
		if(!empty($tt_cate1)) {
			$addQry .= " AND ";
			$addQry .= " tt_cate1 = '$tt_cate1' ";
		}
		
		if(!empty($tt_cate2)) {
			$addQry .= " AND ";
			$addQry .= " tt_cate2 = '$tt_cate2' ";
		}		
		
		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "tt_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblTreat";
		$args['q_where'] = $addQry;
		$args['q_order'] = "tt_regdate desc";
		$args['q_group'] = "";

		$args['tail'] = "tt_cate1=" . $tt_cate1 . "&tt_cate2=" . $tt_cate2 . "&s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}


	function Treat_Main_list($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$qry = "
			select * from tblTreat where tt_cate1 = '$tt_cate1' and tt_main_view ='Y'
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;

	}
	
	
}
?>