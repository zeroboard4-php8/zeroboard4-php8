<?php
// 라이브러리 함수 파일 인크루드
	include "lib.php";

	if(!eregi("member_modify.php",$HTTP_REFERER)) Error("제대로 된 접근을 하여 주시기 바랍니다");

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 회원 정보를 얻어옴
	$member=member_info();
	$group_no = $member['group_no'];

// 멤버 정보 삭제
	zb_query("delete from $member_table where no='$member[no]'") or error(zb_error());

  
// 쪽지 테이블에서 멤버 정보 삭제
	zb_query("delete from $get_memo_table where member_no='$member[no]'") or error(zb_error());
	zb_query("delete from $send_memo_table where member_no='$member[no]'") or error(zb_error());
	
// 각종 게시판에서 현재 탈퇴한 멤버의 모든 정보를 삭제 (부하 문제로 인해서 주석 처리)
	/*
	$result=zb_query("select name from $admin_table");
	while($data=mysql_fetch_array($result)) {
		// 게시판 테이블에서 삭제
		$d_time = get_password($time);
		zb_query("update $t_board"."_$data['name'] set ismember='0', password='$d_time' where ismember='$member[no]'") or error(zb_error());
		// 코멘트 테이블에서 삭제
		zb_query("update $t_comment"."_$data['name'] set ismember='0', password='$d_time' where ismember='$member[no]'") or error(zb_error());
	}
	*/

// 그룹테이블에서 회원수 -1
	zb_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(zb_error());

// 로그아웃 시킴
	destroyZBSessionID($member['no']);

	// 기존 세션 처리 (4.0x용 세션 처리로 인하여 주석 처리)
	//$HTTP_SESSION_VARS['zb_logged_no']='';
	//$HTTP_SESSION_VARS['zb_logged_id']='';
	//$HTTP_SESSION_VARS['zb_logged_time']='';
	//$HTTP_SESSION_VARS['zb_logged_ip']='';
	//$HTTP_SESSION_VARS['zb_secret']='';
	//$HTTP_SESSION_VARS['zb_last_connect_check'] = '0';

	// 4.0x 용 세션 처리
	$zb_logged_no='';
	$zb_logged_time='';
	$zb_logged_ip='';
	$zb_secret='';
	$zb_last_connect_check = '0';
	session_register("zb_logged_no");
	session_register("zb_logged_time");
	session_register("zb_logged_ip");
	session_register("zb_secret");
	session_register("zb_last_connect_check");


	mysql_close($connect);
?>
<script>
alert("정상적으로 탈퇴가 되었습니다.");
opener.window.history.go(0);
window.close();
</script>
