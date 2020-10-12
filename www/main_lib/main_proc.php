<?
	include_once($GP -> CLS."class.jhboard.php");
	$C_JHBoard = new JHBoard();	

	//메인 공지사항
	function Main_Notice() {
		global $GP, $C_JHBoard, $C_Func;

		$args = '';
		$args['jb_code'] = "10";
		$args['limit']  = " limit 0,3 ";
		$rst = $C_JHBoard->Board_Main_Data($args);

		$str = "";
		for($i=0; $i<count($rst); $i++) {
			$jb_idx					= $rst[$i]['jb_idx'];
			$jb_file_name		= $rst[$i]['jb_file_name'];
			$jb_file_code		= $rst[$i]['jb_file_code'];
			$jb_code				= $rst[$i]['jb_code'];
			$jb_name 				= $rst[$i]['jb_name'];
			$jb_title 			= $C_Func->strcut_utf8($rst[$i]['jb_title'], 50, true, "...");
			$jb_reg_date 		= date("Y.m.d", strtotime($rst[$i]['jb_reg_date']));
			$jb_mb_id				= $C_Func->blindInfo($rst[$i]['jb_mb_id'],3);
			$jb_content			= $C_Func->dec_contents_edit($rst[$i]['jb_content']);
			$jb_content			= trim(strip_tags($jb_content));
			$jb_content 		= $C_Func->strcut_utf8($jb_content, 180, true, "...");	//제목 (길이, HTML TAG제한여부 처리)

			//타이틀이미지
			$new_image = " <img src=\"" . $GP -> IMG_PATH . "/skin/basic/image/ticon_new.gif\" border='0' align='middle'>";
			$new_icon = $C_Func->new_icon(1, $rst[$i]['jb_reg_date'], $new_image);

			$jb_title = $jb_title . $new_icon;
			
			$str .= "
				<li><a href=\"/community/community01.html?jb_code=$jb_code&jb_idx=$jb_idx\">
					<strong class='tit'>" . $jb_title . "</strong>
					<span class='txt'>" . $jb_content. "</span>
					<span class='date'>" . $jb_reg_date ."</span>
				</a></li>
			";
		}
		return $str;
	}

	//메인 루카스 인사이드
	function Main_Inside($jb_code) {
		global $GP, $C_JHBoard, $C_Func;

		$args = '';
		$args['jb_code'] = $jb_code;
		$args['limit']  = " limit 0,4 ";
		$rst = $C_JHBoard->Board_Main_Data($args);

		$str = "";
		$k = 1;
		for($i=0; $i<count($rst); $i++) {
			$jb_idx				= $rst[$i]['jb_idx'];
			$jb_code				= $rst[$i]['jb_code'];
			$jb_name 			= $rst[$i]['jb_name'];
			$jb_title 				= $C_Func->strcut_utf8($rst[$i]['jb_title'], 50, true, "...");
			$jb_reg_date 		= date("Y.m.d", strtotime($rst[$i]['jb_reg_date']));
			$jb_mb_id			= $C_Func->blindInfo($rst[$i]['jb_mb_id'],3);
			$jb_content			= $C_Func->dec_contents_edit($rst[$i]['jb_content']);
			$jb_content			= trim(strip_tags($jb_content));
			$jb_content 			= $C_Func->strcut_utf8($jb_content, 260, true, "...");	//제목 (길이, HTML TAG제한여부 처리)
			$jb_front_image	= $rst[$i]['jb_front_image'];

			$img_src = '';
			if($jb_front_image != '') {
				$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "/jb_${jb_code}/${jb_front_image}";
				$img_src = "<img src='" . $code_file. "' alt='" . $jb_title_ori . "' >";	
			}else{			
				$img_src = "<img src='/images/main/img_sample.jpg' alt='이미지 없음' >";	
			}

			$url = "";
			if($jb_code == "20") { $url = "/community/community02.html?jb_code=" . $jb_code . "&jb_idx=" . $jb_idx; }
			if($jb_code == "30") { $url = "/community/community03.html?jb_code=" . $jb_code . "&jb_idx=" . $jb_idx; }
			if($jb_code == "40") { $url = "/community/community04.html?jb_code=" . $jb_code . "&jb_idx=" . $jb_idx; }

			$str .= "
				<li class='item" . $k . "'>
					<a href=\"" . $url . "\">
						" . $img_src . "
						<span class='cont'>
							<strong>" . $jb_title . "</strong>
							<span class='go'>go</span>
						</span>
					</a>
				</li>
			";
			$k++;
		}
		return $str;
	}


	//메인 루카스 인사이드
	function Main_Inside_ALL($jb_code) {
		global $GP, $C_JHBoard, $C_Func;

		$args = '';
		$args['jb_code'] = $jb_code;
		$args['limit']  = " limit 0,1 ";
		$rst = $C_JHBoard->Board_Main_Data($args);

		$str = "";		
		for($i=0; $i<count($rst); $i++) {
			$jb_idx				= $rst[$i]['jb_idx'];
			$jb_code				= $rst[$i]['jb_code'];
			$jb_name 			= $rst[$i]['jb_name'];
			$jb_title 				= $C_Func->strcut_utf8($rst[$i]['jb_title'], 50, true, "...");
			$jb_reg_date 		= date("Y.m.d", strtotime($rst[$i]['jb_reg_date']));
			$jb_mb_id			= $C_Func->blindInfo($rst[$i]['jb_mb_id'],3);
			$jb_content			= $C_Func->dec_contents_edit($rst[$i]['jb_content']);
			$jb_content			= trim(strip_tags($jb_content));
			$jb_content 			= $C_Func->strcut_utf8($jb_content, 260, true, "...");	//제목 (길이, HTML TAG제한여부 처리)
			$jb_front_image	= $rst[$i]['jb_front_image'];

			$img_src = '';
			if($jb_front_image != '') {
				$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "/jb_${jb_code}/${jb_front_image}";
				$img_src = "<img src='" . $code_file. "' alt='" . $jb_title_ori . "' >";	
			}else{			
				$img_src = "<img src='/images/main/img_sample.jpg' alt='이미지 없음' >";	
			}

			$url = "";
			$num = "";
			if($jb_code == "20") { 
				$url = "/community/community02.html?jb_code=" . $jb_code . "&jb_idx=" . $jb_idx; 
				$num = 3;
				$s_tit = "클리닉 스케치";
			}
			if($jb_code == "30") { 
				$url = "/community/community03.html?jb_code=" . $jb_code . "&jb_idx=" . $jb_idx; 
				$num = 2;
				$s_tit = "열린재활 갤러리";
			}

			if($jb_code == "40") { 
				$url = "/community/community04.html?jb_code=" . $jb_code . "&jb_idx=" . $jb_idx; 
				$num = 4;
				$s_tit = "재활회복 리포트";
			}
			
			$str .= "
				<li class='item" . $num . "'>
					<a href=\"" . $url . "\">
						" . $img_src . "
						<span class='cont'>
							<strong>" . $jb_title . "</strong>
							<span class='sort'>" . $s_tit . "</span>
							<span class='go'>go</span>
						</span>
					</a>
				</li>
			";
		}
		return $str;
	}
	
	
	


	




?>