<?php 
/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
	include "_head.php";

	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");

/***************************************************************************
 * 코멘트 삭제 페이지 처리
 **************************************************************************/

// 계층형 코멘트 검사
	include $dir."/get_config.php";
	if(!empty($_SS['using_cReplyMode'])) {
		$result = zb_query("select no from $t_comment"."_$id where mother='$c_no'");
		if(mysql_num_rows($result)) error("답글이 있는 코멘트는 삭제할 수 없습니다.");
	}


// 원본글을 가져옴
	$s_data=mysql_fetch_array(zb_query("select * from $t_comment"."_$id where no='$c_no'"));

	if($s_data['ismember']||$is_admin||$member['level']<=$setup['grant_delete']) {
		if(!$is_admin&&$s_data['ismember']!=$member['no']) Error("삭제할 권한이 없습니다");
		$title="글을 삭제하시겠습니까?";
	} else {
		$title="글을 삭제합니다.<br>비밀번호를 입력하여 주십시요";
		$input_password='<input type="password" name="password" size="20" class="input">';
	}

	$target="del_comment_ok.php";

	$a_list="<a href=zboard.php?$href$sort>";
  
	$a_view="<a href=view.php?$href$sort&no=$no>";

	head();

	include $dir."/ask_password.php";

	foot();

	include "_foot.php";
?>
