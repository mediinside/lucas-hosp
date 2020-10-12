<?
	$now_url = $_SERVER['PHP_SELF'];	
	$folder = explode('/', $now_url);
	$fl_cnt = count($folder);
	
	
	//print_r($folder);
	

	//$folder[1]  = pediatrics
	//$folder[2]  = special
	//$folder[3]  = special04.html
	// $fl_cnt  == 4  3depth
	// $fl_cnt  == 3  2depth
	

	if($fl_cnt == 3) { //3depth
		//intro > 공지사항
		if($folder[2] == "intro06.html") {
			echo "<div class=\"subDepth\">
				<p class=\"mobSubDepth\"><button type=\"button\"></button></p>
				<div class=\"subDepthTab\">
					<ul>
			";
			
			foreach($GP -> NOTICE_TYPE  as $key => $val) {
				echo "<li "; if($key == $_GET['jb_type']) { echo "class='on'";}; echo "><a href=\"?jb_type=" . $key . "\"><span>" . $val . "</span></a></li>";
			}
			
			echo "
					</ul>
				</div>
			</div>
			";
		}
		
		
		//community > faq
		if($folder[2] == "comm02.html") {
			echo "<div class=\"subDepth\">
				<p class=\"mobSubDepth\"><button type=\"button\"></button></p>
				<div class=\"subDepthTab\">
					<ul>
			";
			
			foreach($GP -> FAQ_TYPE  as $key => $val) {
				echo "<li "; if($key == $_GET['jb_type']) { echo "class='on'";}; echo "><a href=\"?jb_type=" . $key . "\"><span>" . $val . "</span></a></li>";
			}
			
			echo "
					</ul>
				</div>
			</div>
			";
		}
		
		
		//community > faq
		if($folder[2] == "women04.html" || $folder[2] == "culture03.html" || $folder[2] == "comm06.html" || $folder[2] == "hwc_review.html") {
			echo "<div class=\"subDepth\">
				<p class=\"mobSubDepth\"><button type=\"button\"></button></p>
				<div class=\"subDepthTab\">
					<ul>
			";
			
			foreach($GP -> HUGI_TYPE  as $key => $val) {
				echo "<li "; if($key == $_GET['jb_type']) { echo "class='on'";}; echo "><a href=\"?jb_type=" . $key . "\"><span>" . $val . "</span></a></li>";
			}
			
			echo "
					</ul>
				</div>
			</div>
			";
		}



		
	}
?>

