<?
CLASS Machine extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}


	// desc	 : 장비 리스트
	// auth  : 
	// param
	function MC_Depth_All($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		$qry = "
			select * from tblMachine where tmc_type='$tmc_type' order by tmc_desc desc
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}


	// desc	 : 장비 삭제
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function MC_Del($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			delete from tblMachine where tmc_idx = '$tmc_idx'	
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	

	
	// desc	 : 장비 정보
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function MC_ImgUpdate($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblMachine
			set				
				tmc_img = ''
			where
				tmc_idx = '$tmc_idx'			
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc	 : 장비 정보
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function MC_Info($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblMachine where tmc_idx = '$tmc_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}

	// desc	 : 순위변경
	// auth  : 
	// param
	function MC_AUTO_CHAGE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		

		$arr_tmp = explode(',',$tmp_id);
		//$max_desc = 29;
		for($i=0; $i<count($arr_tmp); $i++) {
			$idx = $arr_tmp[$i];			
			$qry = " update tblMachine set tmc_desc = '$max_desc' where tmc_idx = '$idx'	";
			$rst =  $this -> DB -> execSqlUpdate($qry);
			$max_desc--; 
		}
	}
	
	// desc	 : 장비 수정
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function MC_Modi($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblMachine
			set
				tmc_type = '$tmc_type',
				tmc_title = '$tmc_title',
				tmc_model = '$tmc_model',
				tmc_content = '$tmc_content',
				tmc_img = '$tmc_img'			
			where
				tmc_idx = '$tmc_idx'			
		";

		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	// desc	 : 장비 등록
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function MC_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select tmc_desc  from tblMachine where tmc_type='$tmc_type' order by tmc_desc desc limit 0, 1";	
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$tmc_desc = $rst['tmc_desc'] + 1;
		}else{
			$tmc_desc = 1;
		}
		
		$qry = "
			INSERT INTO
				tblMachine
				(
					tmc_idx,
					tmc_type,
					tmc_title,
					tmc_model,
					tmc_content,
					tmc_img,
					tmc_desc,
					tmc_regdate
				)
				VALUES
				(
					''		
					, '$tmc_type'
					, '$tmc_title'
					, '$tmc_model'
					, '$tmc_content'
					, '$tmc_img'
					, '$tmc_desc'
					,  NOW()
				)
			";
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}

	// desc	 : 장비 리스트
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function Machine_List_All($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		$addQry = " 1=1 ";
		
		if(!empty($tmc_type)) {
			$addQry .= " AND ";
			$addQry .= " tmc_type = '$tmc_type' ";
		}	
		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$qry = "
			select * from tblMachine where $addQry order by tmc_desc desc
		";
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	

	// desc	 : 장비 리스트
	// auth  : JH 2012-12-05 2012-11-06
	// param
	function Machine_List ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		$addQry = " 1=1 ";
		
		if(!empty($tmc_type)) {
			$addQry .= " AND ";
			$addQry .= " tmc_type = '$tmc_type' ";
		}	
		
		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}
		
		$args['show_row'] = $show_row;
		$args['show_page'] = 10;
		$args['q_idx'] = "tmc_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblMachine";
		$args['q_where'] = $addQry;
		$args['q_order'] = "tmc_desc desc";
		$args['q_group'] = "";
		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent . "&tt_cate=" . $tt_cate;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
}
?>