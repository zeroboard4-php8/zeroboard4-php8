<?php
// 라이브러리 함수 파일 인크루드
	include "lib.php";

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 글쓴이의 정보를 갖고옴;;
	$data=mysql_fetch_array(zb_query("select * from $member_table where no='$member_no'"));

// 멤버정보 구하기
	$member=member_info();

	if(!$member['no']) Error("회원만이 쪽지보내기가 가능합니다","window.close");

// 그룹데이타 읽어오기;;
	$group_data=mysql_fetch_array(zb_query("select * from $group_table where no='$data[group_no]'"));


// 쪽지 보내기일때;;
	if($kind==1&&$member['no']&&$data['no']) {
		if(isblank($subject)) Error("제목이 없습니다. 제목을 입력해 주십시오.");
		if(isblank($memo)) Error("내용이 없습니다. 내용을 입력해 주십시오.");

		$subject=addslashes($subject);
		$memo=addslashes($memo);
		$reg_date=time();
		zb_query("insert into $get_memo_table (member_no,member_from,subject,memo,readed,reg_date) values ('$data[no]','$member[no]','$subject','$memo',1,'$reg_date')") or error(zb_error());
		zb_query("insert into $send_memo_table (member_to,member_no,subject,memo,readed,reg_date) values ('$data[no]','$member[no]','$subject','$memo',1,'$reg_date')") or error(zb_error());
		zb_query("update $member_table set new_memo=1 where no='$data[no]'") or error(zb_error());
		echo"<script language=\"javascript\">alert(\"$data[name] 님께 쪽지를 보냈습니다\");window.close();</script>";
	}

	mysql_close($connect);
?>
