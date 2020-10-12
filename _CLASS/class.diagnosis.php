<?
CLASS Diagnosis extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}
	
	
		// desc	 : 자가진단 양식 내용 리스xm
	// auth  : JH 2013-09-16 월요일
	// param
	function Diagnosis_Result($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblSelfDiagnosis where tsd_type = '$tsd_type' and tsd_idx = '$tsd_idx'
		";
		$rst = $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
		
	// desc	 : 자가진단 양식 내용 리스xm
	// auth  : JH 2013-09-16 월요일
	// param
	function Diagnosis_Content($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblSelfDiagnosis where tsd_type = '$tsd_type'
		";
		$rst = $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 자가진단 양식 삭제
	// auth  : JH 2013-09-16 월요일
	// param
	function Diagnosis_Del($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			delete from tblSelfDiagnosis where tsd_idx = '$tsd_idx'
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 자가진단 양식 수정
	// auth  : JH 2013-09-16 월요일
	// param
	function Diagnosis_Modi($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update
				tblSelfDiagnosis
			set
				tsd_type = '$tsd_type',
				tsd_diagnosis= '$tsd_diagnosis',
				tsd_content = '$tsd_content',
				tsd_url = '$tsd_url'
			where
				tsd_idx = '$tsd_idx'
		";
		$rst = $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	// desc	 : 자가진단 양식 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function Diagnosis_Info($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblSelfDiagnosis where tsd_idx = '$tsd_idx'
		";
		$rst = $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	
	// desc	 : 자가진단 양식 리스트
	// auth  : JH 2013-09-16 월요일
	// param
	function getDiagnosisList ($args = '') {
		global $C_Func;
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;

		global $C_ListClass;

		$tail = "";
		
		$addQry = " 1=1 ";

		if (($s_date && $e_date) && ($s_date < $e_date)) {
			if ($addQry)
			$addQry .= " AND ";

			$addQry .= " tsd_regdate BETWEEN '$s_date 00:00:00' AND '$e_date 00:00:00'";
		}

		if ($search_key && $search_content) {
			if (!empty($addQry)) {
				$addQry .= " AND ";
				$addQry .= " $search_key LIKE ('%$search_content%')";
			}
		}

		$args['show_row'] = $show_row;
		$args['show_page'] = 5;
		$args['q_idx'] = "tsd_idx";
		$args['q_col'] = "*";
		$args['q_table'] = "tblSelfDiagnosis";
		$args['q_where'] = $addQry;
		$args['q_order'] = "tsd_idx desc";
		$args['q_group'] = "";

		$args['tail'] = "s_date=" . $s_date . "&e_date=" . $e_date ."&serach_key=" . $search_key . "&search_content=" . $search_cotent;
		$args['q_see'] = "";
		return $C_ListClass -> listInfo($args);
	}
	
	// desc	 : 자가진단 양식 등록
	// auth  : JH 2013-09-16 월요일
	// param
	function Diagnosis_Reg($args = '') {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			INSERT INTO
			 tblSelfDiagnosis
			(
			tsd_idx,
			tsd_type,
			tsd_diagnosis,
			tsd_content,
			tsd_url,
			tsd_regdate
			)
			VALUES
			(
			''
			, '$tsd_type'
			, '$tsd_diagnosis'
			, '$tsd_content'
			, '$tsd_url'
			, NOW()
			)
		";

		$rst = $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	
	
	
}
?>