<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.treat.php");
$C_Treat 	= new Treat;


switch($_POST['mode']){	


	case 'TREAT_IMGDEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tt_idx'] = $tt_idx;
		$rst = $C_Treat -> TREAT_ImgUpdate($args);

		@unlink($GP -> UP_TREAT . $file);

		echo "true";
		exit();

	break;

	case 'TREAT_CON_IMGDEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tti_idx'] = $tti_idx;
		$args['type'] = $type;
		$rst = $C_Treat -> TREAT_Con_ImgUpdate($args);

		@unlink($GP -> UP_TREAT . $file);

		echo "true";
		exit();
	break;

	case 'TREAT_CON_MODI' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;

		include_once($GP->CLS."class.fileup.php");
		
		//메인페이지 이미지 업로드
		$file_orName			= "tti_img1";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_TREAT;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_1 = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_1 = $before_image1;
		}

		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		//메인페이지 이미지 업로드
		$file_orName			= "tti_img2";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_TREAT;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_2 = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_2 = $before_image2;
		}

		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		//메인페이지 이미지 업로드
		$file_orName			= "tti_img3";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_TREAT;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_3 = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_3 = $before_image3;
		}

		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		$btn_type = "";
		$btn_value = "";
		$btn_link = "";
		
		if($btn_add > 0) {
			for($i=0;  $i < $btn_add; $i++) {
				$btn_type .= ${'btn_type_' . $i} . ";";
				$btn_value .= ${'btn_val_' . $i} . ";";
				$btn_link .= ${'btn_link_' . $i} . ";";
			}
			$btn_type = rtrim($btn_type, ";");
			$btn_value = rtrim($btn_value, ";");
			$btn_link = rtrim($btn_link, ";");
		}

		$ta_tit = "";
		$ta_con = "";
		
		if($tti_ta_cnt > 0) {
			for($i=0;  $i < $tti_ta_cnt; $i++) {
				$ta_tit .= ${'tti_ta_tit_' . $i} . ";";
				$ta_con .= ${'tti_ta_con_' . $i} . ";";
			}
			$ta_tit = rtrim($ta_tit, ";");
			$ta_con = rtrim($ta_con, ";");
		}
		

		$args = "";
		$args['tti_sub_tit_type'] = $tti_sub_tit_type;
		$args['tti_sub_tit']		= $tti_sub_tit;
		$args['tti_sub_text1']	= addslashes($tti_sub_text1);
		$args['tti_sub_text2']	= addslashes($tti_sub_text2);
		$args['tti_img1']			= $image_1;
		$args['tti_img_width']	= $tti_img_width;
		$args['tti_img2']			= $image_2;
		$args['tti_img3']			= $image_3;
		$args['tti_btn_cnt']		= $btn_add;
		$args['tti_btn_type']		= $btn_type;
		$args['tti_btn_value']	= $btn_value;
		$args['tti_btn_link']		= $btn_link;
		$args['tti_ta_cnt']			= $tti_ta_cnt;
		$args['tti_ta_tit']			= $ta_tit;
		$args['tti_ta_con']		= $ta_con;
		$args['tti_idx']			= $tti_idx;

		
		$rst = $C_Treat -> TREAT_CON_MODI($args);

		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");
		
	break;

	case 'TREAT_CON_DEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tti_idx'] 	= $tti_idx;
		$data = $C_Treat ->TREAT_Con_Info_Data_Detail($args);

		if($data) {
			@unlink($GP -> UP_TREAT.$tti_img1);
			@unlink($GP -> UP_TREAT.$tti_img2);
			@unlink($GP -> UP_TREAT.$tti_img3);
			
			$rst = $C_Treat -> TREAT_Con_Info_Del_Detail($args);
		}
		
		echo "true";
		exit();
	break;

	case 'DT_AUTO_CH':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";		
		$args['tmp_id'] = $tmp_id;
		$args['max_desc'] = $max_desc;
		$rst = $C_Treat->DT_AUTO_CHAGE($args);
		
		echo "true";
		exit();
	break;

	case 'TREAT_CON_REG' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;

		include_once($GP->CLS."class.fileup.php");
		
		//메인페이지 이미지 업로드
		$file_orName			= "tti_img1";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_TREAT;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_1 = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_1 = $before_image1;
		}

		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		//메인페이지 이미지 업로드
		$file_orName			= "tti_img2";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_TREAT;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_2 = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_2 = $before_image2;
		}

		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		//메인페이지 이미지 업로드
		$file_orName			= "tti_img3";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 					= $GP -> UP_TREAT;
			$args_f['files'] 						= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_3 = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_3 = $before_image3;
		}

		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		$btn_type = "";
		$btn_value = "";
		$btn_link = "";
		
		if($btn_add > 0) {
			for($i=0;  $i < $btn_add; $i++) {
				$btn_type .= ${'btn_type_' . $i} . ";";
				$btn_value .= ${'btn_val_' . $i} . ";";
				$btn_link .= ${'btn_link_' . $i} . ";";
			}
			$btn_type = rtrim($btn_type, ";");
			$btn_value = rtrim($btn_value, ";");
			$btn_link = rtrim($btn_link, ";");
		}

		$ta_tit = "";
		$ta_con = "";
		
		if($tti_ta_cnt > 0) {
			for($i=0;  $i < $tti_ta_cnt; $i++) {
				$ta_tit .= ${'tti_ta_tit_' . $i} . ";";
				$ta_con .= ${'tti_ta_con_' . $i} . ";";
			}
			$ta_tit = rtrim($ta_tit, ";");
			$ta_con = rtrim($ta_con, ";");
		}

		

		$args = "";
		$args['tt_idx']				= $tt_idx;
		$args['tti_sub_tit_type'] = $tti_sub_tit_type;
		$args['tti_sub_tit']		= $tti_sub_tit;
		$args['tti_sub_text1']	= addslashes($tti_sub_text1);
		$args['tti_sub_text2']	= addslashes($tti_sub_text2);
		$args['tti_item']			= $tti_item;
		$args['tti_img1']			= $image_1;
		$args['tti_img_width']	= $tti_img_width;
		$args['tti_img2']			= $image_2;
		$args['tti_img3']			= $image_3;
		$args['tti_btn_cnt']		= $btn_add;
		$args['tti_btn_type']		= $btn_type;
		$args['tti_btn_value']	= $btn_value;
		$args['tti_btn_link']		= $btn_link;
		$args['tti_ta_cnt']			= $tti_ta_cnt;
		$args['tti_ta_tit']			= $ta_tit;
		$args['tti_ta_con']		= $ta_con;

		
		$rst = $C_Treat -> TREAT_CON_REG($args);

		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;


	
	case 'TREAT_MODI':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;

		include_once($GP->CLS."class.fileup.php");

		//메인페이지 이미지 업로드
		$file_orName			= "tt_file_code";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 				= $GP -> UP_TREAT;
			$args_f['files'] 				= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_main = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_main = $before_image;
		}
		
		$args = "";
		$args['tt_idx'] 			= $tt_idx;
		$args['tt_cate1'] 			= $tt_cate1;
		$args['tt_cate2'] 			= $tt_cate2;
		$args['tt_main_view'] 	= $tt_main_view;
		$args['tt_title'] 			= addslashes($tt_title);
		$args['tt_img']			= $image_main;
		$args['tt_summary'] 	= addslashes($tt_summary);
		$rst = $C_Treat -> TREAT_Info_Modify($args);

		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;
	
	
	
	case 'TREAT_DEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";
		$args['tt_idx'] 	= $tt_idx;
		$data1 = $C_Treat -> TREAT_Info($args);
		$data = $C_Treat ->TREAT_Con_Info_Data($args);

		@unlink($GP -> UP_TREAT.$data1['tt_img']);

		if($data) {
			if(count($data) > 0) {
				for($i=0; $i<count($data); $i++){
					$img1 = $data[$i]['tti_img1'];
					$img2 = $data[$i]['tti_img2'];
					$img3 = $data[$i]['tti_img3'];

					@unlink($GP -> UP_TREAT.$img1);
					@unlink($GP -> UP_TREAT.$img2);
					@unlink($GP -> UP_TREAT.$img3);
				}
			}
			$rst1 = $C_Treat -> TREAT_Con_Info_Del($args);
		}

		$rst = $C_Treat -> TREAT_Info_Del($args);
		
		echo "true";
		exit();
	
	break;
	
	
	case 'TREAT_REG':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		

		include_once($GP->CLS."class.fileup.php");

		//메인페이지 이미지 업로드
		$file_orName			= "tt_file_code";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = "";
			$args_f['forder'] 				= $GP -> UP_TREAT;
			$args_f['files'] 				= $_FILES[$file_orName];
			$args_f['max_file_size'] 		= 1024 * 5000;// 500kb 이하
			$args_f['able_file'] 				= array("jpg","gif","png","bmp");

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
			$image_main = $updata['new_file_name'];	//변경된 파일명
		}
			
		$args = "";
		$args['tt_cate1'] 			= $tt_cate1;
		$args['tt_cate2'] 			= $tt_cate2;
		$args['tt_main_view'] 	= $tt_main_view;
		$args['tt_title'] 			= addslashes($tt_title);
		$args['tt_img']			= $image_main;
		$args['tt_summary'] 	= addslashes($tt_summary);
		

		$rst = $C_Treat -> TREAT_Reg($args);

		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
		exit();
	break;
	
}
?>