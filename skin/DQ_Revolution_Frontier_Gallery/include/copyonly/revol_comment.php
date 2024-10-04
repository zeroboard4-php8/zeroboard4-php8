<?php 
	if(!file_exists(getcwd().'/zboard.php')) die('정상적인 접근이 아닙니다.');

// 공통파일 include
	include "_head.php";
	if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 글을 작성하여 주시기 바랍니다.");

// DB 연결
	if(!$connect) $connect = dbConn();  

//게시판 설정 읽어오기
	$setup = get_table_attrib($id); 
	$group = group_info($setup['group_no']);
	$dir = "skin/{$setup['skinname']}";

	include $dir.'/include/vote_ex_run.php';
?>
