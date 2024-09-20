<?php
// 라이브러리 함수 파일 인크루드
	include "lib.php";

// DB 연결
	if(!isset($connect)) $connect=dbConn();

// 회원 정보를 얻어옴
	$member=member_info();
	if(!$member['no']) error('회원 정보가 존재하지 않습니다','window.close');
	$group_no = $member['group_no'];
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
		$isold = false;
		if(strlen($member['password'])<=16&&strlen(get_password("a"))>=41) $isold = true;
		if($member['password'] !== get_password($_POST['password'], $isold)) {
			error('올바른 비밀번호를 입력하십시오.');
		}
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
<?php
		exit;
	}
	$referer=$_SERVER['HTTP_REFERER'];
	head();
?>
<div align=center><br>
<table border=0 cellspacing=1 cellpadding=0 width=540>
<form name=write method=post action=member_out.php>
<input type=hidden name=referer value="<?=isset($referer)?$referer:''?>">

  <tr><td colspan=2><img src=images/member_modify.gif></td></tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="3"></td>
        </tr>
  <tr height=28 align=right>
     <td width=28% style=font-family:Tahoma;font-size:8pt;><b>ID&nbsp;</td>
     <td align=left>&nbsp;<?=$member['user_id']?></td>
  </tr>
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
  <tr height=28 align=right>
     <td style=font-family:Tahoma;font-size:8pt;><b>Password 확인&nbsp;</td>
     <td align=left>&nbsp;<input type=password name=password size=20 maxlength=20 style=border-color:#d8b3b3 class=input></td>
  </tr> 
        <tr>
          <td colspan="5" bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
        </tr>
<tr height=30 bgcolor=#ffffff>
   <td align=center></td>
   <td align=right ><img src=images/t.gif height=5><br>
   <?php if($member['no']>1) {?><input type=image border=0 onclick="return confirm('탈퇴하시겠습니까?\n\n탈퇴를 하시면 모든 정보가 DB에서 사라집니다.\n\n탈퇴후 언제라도 재 가입가능합니다\n')" src=images/button_out.gif><?php }?> &nbsp;
   <img src=images/memo_close.gif border=0 onClick=window.close() style=cursor:hand>&nbsp;&nbsp;&nbsp;
   </td>
</tr>
  </form>
</table>

<?php
	mysql_close($connect);
	foot();
?>