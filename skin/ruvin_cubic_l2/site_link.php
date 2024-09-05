<?php 
  // 라이브러리 함수 파일 인크루드
  require "../../lib.php";

  // 게시판 이름 지정이 안되어 있으면 경고;;;
  if(!$id) Error("게시판 이름을 지정해 주셔야 합니다.<br><br>예) zboard.php?id=이름","");

  // DB 연결
  if(!$connect) $connect=dbConn();

  // 현재 게시판 설정 읽어 오기
  $setup=get_table_attrib($id);
  
  // 설정되지 않은 게시판일때 에러 표시
  if(!$setup['name']) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","");

  // 현재 게시판의 그룹의 설정 읽어 오기
  $group=group_info($setup['group_no']);

  // 멤버 정보 구해오기;;; 멤버가 있을때
  $member=member_info();

  // 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
  if($member['is_admin']==1||$member['is_admin']==2&&$member['group_no']==$setup['group_no']) $is_admin=1; else $is_admin="";

  // 접근 금지 아이피인 경우 금지하기;;;
  $avoid_ip=explode(",",$setup['avoid_ip']);
  for($i=0;$i<count($avoid_ip);$i++)
  { 
   if(!isblank($avoid_ip[$i])&&eregi($avoid_ip[$i],$REMOTE_ADDR)&&!$is_admin)
    Error(" Access Denied ");
  }

  // 현재 그룹이 폐쇄그룹이고 로그인한 멤버가 비멤버일때 에러표시
  if($group['is_open']==0&&!$is_admin&&$member['group_no']!=$setup['group_no']) Error("공개 되어 있지 않습니다");

  // 사용권한 체크
  if($setup['grant_view']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=zboard.php");

  // 스킨 디렉토리 : $dir 이라는 변수는 계속해서 스킨경로 파일로 ////
  $dir="skin/".$setup['skinname'];

  // 홈페이지 클리시 hit+1 하여줌..
  mysql_query("update $t_board"."_$id set hit=hit+1 where no='$no'");

  //////// MySQL 닫기 ///////////////////////////////////////////////
  if($connect) mysql_close($connect);
  $query_time=getmicrotime();

  header("location:$sitelink");

?>
