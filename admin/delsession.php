<?php
	set_time_limit (0);

	$_zb_path="../";

	include "../lib.php";

	$connect=dbconn();

	$member=member_info();

	if(!isset($member['no'])||$member['is_admin']>1||$member['level']>1) Error("최고 관리자만이 사용할수 있습니다");

	// 세션 삭제
	if(isset($exec)&&$exec=="delete") {
		$i=0;
		$path = "../".$_zbDefaultSetup['session_path'];
		$directory = dir($path);
		while($entry = $directory->read()) {
			if ($entry !== "." && $entry !== "..") {
				if(!eregi(session_id(), $entry)) {
					z_unlink($path."/".$entry);
					$i++;
					if($i%100==0) print(".");
					flush();
				}
			}
		}
        head();
		print("\n\n<script>\nalert('세션 디렉토리를 정리하였습니다');\nwindow.close();\n</script>");
        foot();
		exit();
	}

	head(" bgcolor=white");
?>
<div align=center>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=98%>
<tr>
  <td><img src=../images/session_title.gif border=0></td>
  <td width=100% background=../images/trace_back.gif><img src=../images/trace_back.gif border=0></td>
  <td><img src=../images/trace_right.gif border=0></td>
</tr>
<tr>
  <td colspan=3 style=padding:15px;line-height:160%>
  	이 페이지는 회원 로그인등에 필요한 세션 디렉토리를 정리하는 곳입니다.<br>
	세션을 모두 제거하면 현재 로그인한 회원이 로그아웃이 되며, 자동 로그인을 지정한 회원들의 경우<br>
	자동로그인이 취소가 됩니다<br>
	하지만  세션 디렉토리의 파일이 많아지면 전체적인 시스템 효율성을 떨어뜨리므로,<br>
	아래 현황을 파악해 보시고 한번씩 비워주시는 것이 좋습니다<br>
  </td>
</tr>
</table>
</div>
<?php flush()?>

	<div align=center>
	<form name=sdc action=<?=$PHP_SELF?> method=post>
	<input type=hidden name=exec value=delete>
	<table border=0 cellspacing=1 cellpadding=4 width=300 bgcolor=bbbbbb>
	<col width=40></col><col width=></col>
	<tr bgcolor=eeeeee>
		<td colspan=2 align=center><b>Session diectory checking...</b></td>
	</tr>
	<tr bgcolor=white>
		<td align=center>갯수</td><td><input type=input name=num value="" size=30 style=border:0;height:18px></td>
	</tr>
	<tr bgcolor=white>
		<td align=center>용량</td><td><input type=input name=size value="" size=30 style=border:0;height:18px></td>
	</tr>
	<tr bgcolor=cccccc>
		<td align=center colspan=2><input type=submit value="세션 파일 삭제" class=submit></td>
	</tr>
	</table>
	</form>
	<script>
<?php
	
	// 전체 파일 목록을 구함
	unset($list);
	$path = "../".$_zbDefaultSetup['session_path'];
	$directory = dir($path);
	$i=0;
	$totalsize = 0;
	while($entry = $directory->read()) {
		if ($entry != "." && $entry != "..") {
			$list[] = $entry;
			$i++;
			$totalsize += filesize($path."/".$entry);
			if($i%100==0) {
				print "document.sdc.num.value='".$i." 개';\n";
				print "document.sdc.size.value='".getfilesize($totalsize)."';\n";
			}
			flush();
		}
	}
	$directory->close();
	print "document.sdc.num.value='".number_format($i)." 개';\n";
	print "document.sdc.size.value='".getfilesize($totalsize)."';\n";

	$totallist = count($list);
?>
	</script>
	</div>
<?php
 mysql_close($connect);
 $connect="";
?>

<br><Br><Br>

<?php
 foot();
?>
