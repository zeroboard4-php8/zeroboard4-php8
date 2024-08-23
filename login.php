<?php
	include "lib.php";

	if(!isset($id)&&!isset($group_no)) Error("게시판 이름이나 그룹번호를 지정하여 주셔야 합니다.<br><br>(login.php?id=게시판이름   또는  login.php?group_no=번호)","");

	$connect=dbConn();

// 현재 게시판 설정 읽어 오기
	if($id) {
		$setup=get_table_attrib($id);

// 설정되지 않은 게시판일때 에러 표시
  		if(!$setup['name']) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시오","");

// 현재 게시판의 그룹의 설정 읽어 오기
  		$group=group_info($setup['group_no']);
  		$dir="skin/".$setup['skinname'];
  		$file="skin/".$setup['skinname']."/login.php";

	} else {

		if($group_no) $group=mysql_fetch_array(zb_query("select * from $group_table where no='$group_no'"));
		if(!$group['no']) Error("지정된 그룹이 존재하지 않습니다");
	}

	head();
?>

<script>
 function check_submit()
 {
  if(!login.user_id.value)
  {
   alert("아이디를 입력하여 주세요");
   login.user_id.focus();
   return false;
  }
  if(!login.password.value)
  {
   alert("비밀번호를 입력하여 주세요");
   login.password.focus();
   return false;
  }
  check=confirm("자동 로그인 기능을 사용하시겠습니까?\n\n자동 로그인 사용시 다음 접속부터는 로그인을 하실필요가 없습니다.\n\n단, 게임방, 학교등 공공장소에서 이용시 개인정보가 유출될수 있으니 조심하여 주십시오");
  if(check) {login.auto_login.value=1;}
  return true;
 }
</script>

<form method=post action=login_check.php onsubmit="return check_submit();" name=login>
<input type=hidden name=auto_login value=<?php if(!isset($autologin['ok']))echo"0";else echo"1"?>>
<input type=hidden name=page value=<?=isset($page)?$page:''?>>
<input type=hidden name=id value=<?=isset($id)?$id:''?>>
<input type=hidden name=no value=<?=isset($no)?$no:''?>>
<input type=hidden name=select_arrange value=<?=isset($select_arrange)?$select_arrange:''?>>
<input type=hidden name=desc value=<?=isset($desc)?$desc:''?>>
<input type=hidden name=page_num value=<?=isset($page_num)?$page_num:''?>>
<input type=hidden name=keyword value="<?=isset($keyword)?$keyword:''?>">
<input type=hidden name=category value="<?=isset($category)?$category:''?>">
<input type=hidden name=sn value="<?=isset($sn)?$sn:''?>">
<input type=hidden name=ss value="<?=isset($ss)?$ss:''?>">
<input type=hidden name=sc value="<?=isset($sc)?$sc:''?>">
<input type=hidden name=mode value="<?=isset($mode)?$mode:''?>">
<input type=hidden name=s_url value="<?=isset($s_url)?$s_url:''?>">
<input type=hidden name=referer value="<?=isset($referer)?$referer:''?>">

<?php
	if($id) include $file;
?>

</form>

<?php
	foot();
	mysql_close($connect);
?>

