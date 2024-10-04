<?php
/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
	include_once "_head.php";

	if(!eregi($_SERVER['HTTP_HOST'],$_SERVER['HTTP_REFERER'])) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");

/***************************************************************************
 * 코멘트 삭제 페이지 처리
 **************************************************************************/

// 원본글을 가져옴
	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
	$no = isset($_REQUEST['no']) && is_numeric($_REQUEST['no']) ? $_REQUEST['no'] : null;
	$c_no = isset($_REQUEST['c_no']) && is_numeric($_REQUEST['c_no']) ? $_REQUEST['c_no'] : null;
	if(!isset($member['no'])) $member['no'] = null;
	$s_data=mysql_fetch_array(zb_query("select * from $t_comment"."_$id where no='$c_no'"));

	if($s_data['ismember']||$is_admin||$member['level']<=$setup['grant_delete']) {
		if(!$is_admin&&$s_data['ismember']!=$member['no']) Error("삭제할 권한이 없습니다");
		$title='글을 삭제하시겠습니까?';
		$input_password='';
	} else {
		$title='글을 삭제합니다.<br>비밀번호를 입력하여 주십시요';
		$input_password='<input type=password name=password size=20 class=input>';
	}

	$target="del_comment_ok.php";

	$a_list="<a href=zboard.php?$href$sort>";
  
	$a_view="<a href=view.php?$href$sort&no=$no>";
	if(!isset($mode)) $mode='';

	head();

	include $dir."/ask_password.php";

	foot();

	include "_foot.php";
?>
