<?php 
if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');

// 공통 파일 include
	include "_head.php";

	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");

// 게시물 삭제 처리

// 원본글을 가져옴
	$s_data=mysql_fetch_array(zb_query("select * from $t_board"."_$id where no='$no'"));
	if(empty($s_data['no'])) Error("선택하신 게시물이 존재하지 않습니다");
	if($s_data['ismember']||$is_admin||$member['level']<=$setup['grant_delete']) {
		if($s_data['ismember']!=$member['no']&&!$is_admin&&$member['level']>$setup['grant_delete']) Error("삭제할 권한이 없습니다");
		$title="글을 삭제하시겠습니까?";
  	} else {
		$title=stripslashes($s_data['name'])."님의 글을 삭제합니다.<br>비밀번호를 입력하여 주십시요";
		$input_password="<input type=\"password\" name=\"password\" size=\"20\" maxlength=\"20\" class=\"input\">";
	}

	$target=$dir."/include/revol_delete_ok.php";

	$a_list="<a href=\"zboard.php?$href$sort\">";
  
	$a_view="<a href=# onclick=history.back()>";

	head();

	include $dir."/ask_password.php";

	foot();
 
 	include "_foot.php";
?>
