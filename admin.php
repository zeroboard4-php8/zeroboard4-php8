<?php
	include "lib.php";
	$connect=dbConn();
	$member=member_info();
	if((isset($member['no'])&&$member['is_admin']<3&&$member['is_admin']>=1)||(isset($member['no'])&&$member['board_name'])) movepage('admin_setup.php?globaldetect=a');
	else {
		if(isset($member['no'])) {
			destroyZBSessionID($member['no']);
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
			$_SESSION['zb_hash']='';
		}
	}

	head("  bgcolor=444444  onload=write.user_id.focus()");
?>

<script>
function check_submit() {
	if(!write.user_id.value) {
		alert("ID를 입력하여 주십시요");
		write.user_id.focus();
		return false;
	}
	if(!write.password.value) {
		alert("Password를 입력하여 주십시요");
		write.password.focus();
		return false;
	}
	return true;
}
</script>

<br><br><br>
<form name=write method=post action=login_check.php onsubmit="return check_submit();">
<input type=hidden name=s_url value="<?=$_SERVER['REQUEST_URI']?>">
<input type=hidden name=exec value=login>
<div align=center>
<table cellpadding=3 cellspacing=1 width=250 border=0 bgcolor="#000000">
<tr>
  <td height=25 align=center colspan=2 bgcolor=000000 style="font-weight:bold;color:#ffffff;font-family:Tahoma;font-size:8pt;">
  ZEROBOARD Administrator Login</td>
</tr>
<tr height=25>
  <td align=right bgcolor=#868686 style=font-family:Tahoma;font-size:8pt;padding:3px><b>User ID &nbsp;</b></td>
  <td  bgcolor=#e0e0e0 align=center><input type=text name=user_id value='' size=20 maxlength=20 class=input style=border-color:#b0b0b0></td>
</tr>
<tr height=25>
  <td align=right bgcolor=#868686 style=font-family:Tahoma;font-size:8pt;padding:3px><b>Password &nbsp;</b></td>
  <td align=center bgcolor=#e0e0e0><input type=password name=password size=20 maxlength=20 class=input style=border-color:#b0b0b0></td>
</tr>
<tr height=25>
  <td align=center align=center colspan=2 bgcolor=3d3d3d>
      <input type=submit value=" Administrator Login " style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:23px;>
  </td>
</tr>
</table>
<form>

<?php
	mysql_close($connect);
	foot();
?>
