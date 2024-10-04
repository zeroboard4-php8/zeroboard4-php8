<?php 
if($mode != "modify") {
	$_limit_pass = false;

  // 레볼류션이 호출한게 아닐때 변수처리
	if($skin_setup['config_id']!= $id) {
	  // 제한 없는 회원레벨
		$upLimit_Pass_Level = 5;

	  // 관리자는 제한없음
		$admin_upLimit_Pass = 0;

	  // 제한 설정
		$using_writeLimit = true;
		$upload_limit1 = 60*24; //갯수 제한시간, 하루
		$upload_limit2 = 2; //갯수 제한
		$upload_limit3 = 10; //재등록 허가시간,10분 안에는 재등록 불가
	}
	else {
	  // 스킨설정 변수를 짧게 다시 정의
		$using_writeLimit   = &$skin_setup['using_writeLimit'];
		$upLimit_Pass_Level = &$skin_setup['upLimit_Pass_Level'];
		$admin_upLimit_Pass = &$skin_setup['admin_upLimit_Pass'];
		$upload_limit1 = &$skin_setup['upload_limit1'];
		$upload_limit2 = &$skin_setup['upload_limit2'];
		$upload_limit3 = &$skin_setup['upload_limit3'];
	}

  // 제한 설정이 있고 회원이 아니라면 에러
	if(!$member['no'] && $using_writeLimit) error ("\"게시물 등록 제한\"이 설정되어 있습니다.<br><br>비회원은 업로드 하실 수 없습니다.");

  // 패스할수 있는 회원 레벨인지 검사
	if($member['level'] <= $upLimit_Pass_Level) $_limit_pass = true;
  // 관리자의 패스 권한을 검사
	if($is_admin && $admin_upLimit_Pass) $_limit_pass = true;

  // 패스할수 있는 권한이 없고, 글 수정 모드가 아니라면 등록제한 처리
	if($using_writeLimit && !$_limit_pass) {

	  // 제한 *분을 알아보기 쉬운 단위로 정의
		$_text1 = $upload_limit1."분";
		if($upload_limit1 >= 60)       $_text1 = ceil($upload_limit1 / 60)."시간";
		if($upload_limit1 >= 60*24)    $_text1 = ceil($upload_limit1 / (60*24))."일";
		if($upload_limit1 >= 60*24*7)  $_text1 = ceil($upload_limit1 / (60*24))."주일";
		if($upload_limit1 >= 60*24*30) $_text1 = ceil($upload_limit1 / (60*24))."개월";

	  // 분 단위로 설정된 값에 60초를 곱해서 분으로 만들어줌
		$time1 = time() - ($upload_limit1*60);
		$time3 = time() - ($upload_limit3*60);

	  // 업로드 횟수제한 검사
		if($upload_limit1 >= 1440) {
			$day  = date("Ymd",(time() - (86400*($upload_limit1/1440))));
			$day_limit = $upload_limit2 -1;
			$_write = mysql_num_rows(zb_query("select no from $t_board"."_$id where from_unixtime(reg_date,'%Y%m%d')>'$day' and ismember='{$member['no']}' order by reg_date desc"));
			if($_write >= $upload_limit2) error ("포스팅 횟수를 초과 하였습니다.<br>$_text1"."에 $upload_limit2"."회 포스팅 할수 있습니다.");
		} else {
			$_write = mysql_num_rows(zb_query("select no from $t_board"."_$id where reg_date>$time1 and ismember='{$member['no']}'"));
			if($_write >= $upload_limit2) error ("포스팅 횟수를 초과 하였습니다.<br>$_text1"."에 $upload_limit2"."회 포스팅 할수 있습니다.");
		}

	  // 재등록 시간차이 검사 
		$_write = mysql_fetch_array(zb_query("select reg_date from $t_board"."_$id where reg_date>$time3 and ismember='{$member['no']}'"));
		if(count($_write)>1) {
			$_text2 = $upload_limit3 - date("i",time()-$_write[0]);
			Error("포스팅 후 <b>$upload_limit3"."분</b>이 지나야 다음 게시물을 포스팅 할수 있습니다.<br><br>현재 서버시간: ".date("Y-m-d H:i:s",time())."<br>이전 등록시간: ".date("Y-m-d H:i:s",$_write[0])."<br><br><b>$_text2"."분 후에 포스팅 하실 수 있습니다.</b>");
		}

	} //패스
} // $mode != "modify"
?>
