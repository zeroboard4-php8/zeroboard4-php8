<?php
	include "lib.php";
	include "schema.sql";

	if(file_exists("config.php")) error("이미 config.php가 생성되어 있습니다.<br><br>재설치하려면 해당 파일을 지우세요");

// 호스트네임, 아이디, DB네임, 비밀번호의 공백여부 검사
	$hostname = $_POST['hostname'];
	$user_id = $_POST['user_id'];
	$password = $_POST['password'];
	$dbname = $_POST['dbname'];
	
	if(isBlank($hostname)) Error("HostName을 입력하세요","");
	if(isBlank($user_id)) Error("User ID 를 입력하세요","");
	if(isBlank($dbname)) Error("DB NAME을 입력하세요","");

// DB에 커넥트 하고 DB NAME으로 select DB
	$connect = mysql_connect($hostname,$user_id,$password) or Error("MySQL-DB Connect<br>Error!!!","");
	if(zb_error()) Error(zb_error(),"");
	mysql_select_db($dbname, $connect ) or Error("MySQL-DB Select<br>Error!!!","");
	zb_query("set names 'utf8'");

// 관리자 테이블 생성
	if(!isTable($admin_table,$dbname)) zb_query($admin_table_schema, $connect) or Error("관리자 테이블 생성 실패","");
	else $admin_table_exist=1;
  
// 그룹테이블 생성
	if(!isTable($group_table,$dbname)) zb_query($group_table_schema, $connect) or Error("그룹 테이블 생성 실패","");
	else $group_table_exist=1;

// 회원관리 테이블 생성
	if(!istable($member_table,$dbname)) zb_query($member_table_schema, $connect) or Error("회원관리 테이블 생성 실패","");
	else $member_table_exist=1;

// 쪽지테이블
	if(!istable($get_memo_table,$dbname))  zb_query($get_memo_table_schema, $connect) or Error("받은 쪽지 테이블 생성 실패");
	else $get_memo_table_exists=1;
	if(!istable($send_memo_table,$dbname)) zb_query($send_memo_table_schema, $connect) or Error("보낸 쪽지 테이블 생성 실패");
	else $send_memo_table_exist=1;

// 파일로 DB 정보 저장
	$file=@fopen("config.php","w") or Error("config.php 파일 생성 실패<br><br>디렉토리의 퍼미션을 707로 주십시오","");
	@fwrite($file,"<?php /*\n$hostname\n$user_id\n$password\n$dbname\n*/ ?>\n") or Error("config.php 파일 생성 실패<br><br>디렉토리의 퍼미션을 707로 주십시오","");
	@fclose($file);
	@mkdir("data",0707);
	@mkdir("icon",0707);
	@mkdir("icon/member_image_box",0707);
	@mkdir("icon/private_icon",0707);
	@mkdir("icon/private_name",0707);
	@chmod("icon/member_image_box",0707);
	@chmod("icon/private_icon",0707);
	@chmod("icon/private_name",0707);
	@chmod("data",0707);
	@chmod("icon",0707);
	@chmod("config.php",0707);

	$temp=mysql_fetch_array(zb_query("select count(*) from $member_table where is_admin = '1'",$connect));

	if($temp[0]) {movepage("admin.php");}
	else {movepage("install2.php");} // 관리자 정보가 없을때 관리자 정보 입력
?>
