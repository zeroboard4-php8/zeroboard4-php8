<?php
	if(isset($_POST['exec'])&&$_POST['exec']=="uninstall"&&$_POST['uninstall']=="ok") {
		if(!$u_hostname) Error("Hostname을 입력하세요");
		if(!$u_userid) Error("User ID를 입력하세요");
		if(!$u_password) Error("Password를 입력하세요");
		if(!$u_dbname) Error("DB Name을 입력하세요");

		mysql_close($connect);

		$connect = mysql_connect($u_hostname,$u_userid,$u_password) or error(zb_error());
		mysql_select_db($u_dbname) or Error(zb_error());
		
		$result = zb_query("show table status from $u_dbname like 'zetyx%'",$connect) or error(zb_error());
		while($data=mysql_fetch_array($result)) {
			zb_query("drop table $data[Name]");
		}

		zRmDir("./data");
		zRmDir("./icon");
		z_unlink("./config.php");

		error("제로보드가 서버에서 완전히 제거되었습니다","install.php"); 
		exit();
	}
?>


<table border=0 cellspacing=0 cellpadding=10 bgcolor=eeeeee width=100% height=100%>
<form name=uninstall method=post onsubmit="return confirm('제거하시겠습니까?')">
<input type=hidden name=exec value="uninstall">
<input type=hidden name=uninstall value="ok">
<input type=hidden name=csrf_token value=<?=generate_csrf_token()?>>
<tr>
	<td valign=top style=line-height:160% align=center>
	<br>
	<font size=4 color=black><b>제로보드 제거</b><br></font>
	<br>
	<font color=black>
	<table border=0>
	<tr>
		<td style=line-height:160%;color=black>
			제로보드를 제거하시기 전에 꼭 DB 백업을 하시기 바랍니다.<br>
			상단의 <b>DB 백업</b> 버튼을 누르면 현재 제로보드의 모든 테이블을 백업 받으실수 있습니다.<br>
			백업을 받으셨다면 아래의 DB 정보를 입력하시고 확인 버튼을 누르시면 제로보드는 제거가 됩니다.<br>
			제로보드 제거시 DB의 정보와 data, icon, config.php 등의 파일까지 모두 삭제가 됩니다.<br>
		</td>
	</tr>
	</table>
	<br>
	<table border=0 cellspacing=1 cellpadding=3 bgcolor=777777>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>Hostname&nbsp;</td>
		<td bgcolor=f3f3f3><input type=input name=u_hostname value="" class=input size=20></td>
	</tr>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>User ID&nbsp;</td>
		<td bgcolor=f3f3f3><input type=input name=u_userid value="" class=input size=20></td>
	</tr>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>Password&nbsp;</td>
		<td bgcolor=f3f3f3><input type=password name=u_password value="" class=input size=20></td>
	</tr>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>DB Name&nbsp;</td>
		<td bgcolor=f3f3f3><input type=input name=u_dbname value="" class=input size=20></td>
	</tr>
	<tr>
		<td colspan=2 bgcolor=555555 align=center><input type=submit value="    확        인    " style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;></td>
	</tr>
	</table>
	</td>
</tr>
</form>
</table>
