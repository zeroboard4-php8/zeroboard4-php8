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
  if(!$setup['name']) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시오","");

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

  if(!$setup['use_alllist']) $view_file_link="view.php"; else $view_file_link="zboard.php";

  // 사용권한 체크
  if($setup['grant_comment']<$member['level']&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&file=$view_file_link");

  // 각종 변수 검사;;
  if(isblank($memo)) Error("내용을 입력하셔야 합니다");
  if(!$member['no'])
  {
   if(isblank($name)) Error("이름을 입력하셔야 합니다");
   if(isblank($password)) Error("비밀번호를 입력하셔야 합니다");
  }

  // 필터링;; 관리자가 아닐때;;
  if(!$is_admin&&$setup['use_filter'])
  {
   $filter=explode(",",$setup['filter']);
   $f_memo=eregi_replace("([\_\-\./~@?=%&! ]+)","",$memo);
   $f_name=eregi_replace("([\_\-\./~@?=%&! ]+)","",$name);
   $f_subject=eregi_replace("([\_\-\./~@?=%&! ]+)","",$subject);
   $f_email=eregi_replace("([\_\-\./~@?=%&! ]+)","",$email);
   $f_homepage=eregi_replace("([\_\-\./~@?=%&! ]+)","",$homepage);
   for($i=0;$i<count($filter);$i++) 
   if(!isblank($filter[$i]))
   {
    if(eregi($filter[$i],$f_memo)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
    if(eregi($filter[$i],$f_name)) Error("<b>$filter[$i]</b> 은(는) 등록하기에 적합한 단어가 아닙니다");
   }
  }

  //패스워드를 암호화
  if($password)
  {
   $temp=mysql_fetch_array(mysql_query("select password('$password')"));
   $password=$temp[0];   
  }

  // 관리자이거나 HTML허용레벨이 낮을때 태그의 금지유무를 체크
  if(!$is_admin&&$setup['grant_html']<$member['level']) 
  {
   $memo=del_html($memo);// 내용의 HTML 금지;;
  }

  // 회원등록이 되어 있을때 이름등을 가져옴;;
  if($member['no'])
  {
   if($mode=="modify"&&$member['no']!=$s_data['ismember'])
   {
    $name=$s_data['name'];
   }
   else
   {
    $name=$member['name'];
   }
  }

  // 각종 변수의 addslashes 시킨;;
  $name=addslashes(del_html($name));
	$memo=autolink($memo);
  $memo=addslashes($memo);

  $max_no=mysql_fetch_array(mysql_query("select max(no) from $t_comment"."_$id where parent='$no'"));

  // 같은 내용이 있는지 검사;;
  if(!$is_admin)
  {
   $temp=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where memo='$memo' and no='$max_no[0]'"));
   if($temp[0]>0) Error("같은 내용의 글은 등록할수가 없습니다");
  }

  // 쿠키 설정;;
  if($c_name) setcookie("zetyx[name]",$name,time()+60*60*24*365);

  // 각종 변수 설정
  $reg_date=time(); // 현재의 시간구함;;
  $parent=$no;

  mysql_query("insert into $t_comment"."_$id (parent,ismember,name,password,memo,reg_date,ip) values
                 ('$parent','$member['no']','$name','$password','$memo','$reg_date','$REMOTE_ADDR')") or error(mysql_error());


  $total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
  mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'") or error(mysql_error());

  // 회원일 경우 해당 해원의 점수 주기
  @mysql_query("update $member_table set point2=point2+1 where no='$member['no']'",$connect) or error(mysql_error());


  //////// MySQL 닫기 ///////////////////////////////////////////////
  if($connect) mysql_close($connect);
  $query_time=getmicrotime();
//  movepage("$view_file_link?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&cn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no");
movepage("$view_file_link?id=$id&page=$page&page_num=$page_num");
?>
