<?php
	include "lib.php";

	$connect=dbConn();

// 관리자가 1명이상 있을경우 바로 로그인 페이지로...
	$temp=mysql_fetch_array(zb_query("select count(*) from $member_table where is_admin='1'",$connect));
	if($temp[0]) {
		header("location:admin.php"); 
		mysql_close($connect);
		exit;
	}

// 빈문자열인지를 검사
	$user_id = $_POST['user_id'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$name = $_POST['name'];
	if(isBlank($user_id)) Error("아이디를 입력하셔야 합니다","");
	if(isBlank($password1)) Error("비밀번호를 입력하셔야 합니다","");
	if(isBlank($password2)) Error("비밀번호 확인을 입력하셔야 합니다","");
	if($password1!=$password2) Error("비밀번호와 비밀번호 확인이 일치하지 않습니다","");
	if(isBlank($name)) Error("이름을 입력하셔야 합니다","");

// 관리자 정보 입력
    $password1=get_password($password1);
	zb_query("insert into $member_table (user_id,password,name,is_admin,reg_date,level) values ('$user_id','$password1','$name','1','".time()."','1')",$connect) or Error(zb_error(),"");

	mysql_close($connect);

	header("location:admin.php");
?>
