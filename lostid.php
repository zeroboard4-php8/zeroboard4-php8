<?php
	include "lib.php";

	// 웹마스터 E-mail
	$_from = $_zbDefaultSetup['email'];

	// 사이트 주소
	$_homepage = $_zbDefaultSetup['url'];

	// 사이트 이름
	$_sitename = $_zbDefaultSetup['sitename'];

	if(!$_from||!$_homepage||!$_sitename) error("관리자 정보가 입력되어 있지 않습니다.<br>setup.php 파일을 관리자가 수정하여야 합니다");

	head();
?>

<div align=center>

<script>
function check_submit()
{
 if(!lostid.email.value) {alert("E-Mail을 입력하여 주십시요"); lostid.email.focus(); return false; }
 if(!lostid.jumin1.value) {alert("주민등록번호를 입력하여 주십시요"); lostid.jumin1.focus(); return false; }
 if(!lostid.jumin2.value) {alert("주민등록번호를 입력하여 주십시요"); lostid.jumin2.focus(); return false; }
 return confirm("ID/Password를 E-Mail로 받아보시겠습니까?");
}
</script>
<form method=post action=lostid_search.php onsubmit="return check_submit()" name=lostid>
<table border=0 cellpadding=3>
<tr>
	<td>
	<table border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=white>
	<tr>
		<td><img src=images/lo_title.gif borrder=0 height=32></td>
		<td width=100% background=images/lo_back.gif><img src=images/lo_back.gif height=32 border=0></td>
		<td><img src=images/lo_right.gif height=32 border=0></td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=white>
	<col width=7></col><col width=></col><col width=7>
	<tr> 
		<td><img src=images/t.gif border=0 width=7></td>
		<td>
			<table border=0 cellspacing=0 cellpadding=3>
			<tr>
				<td style=line-height:160% colspan=2 style=padding:5px>
					회원님들께서 아이디나 비밀번호를 분실하였을때 회원님의 E-MAIL로 아이디와 비밀번호를 보내드립니다.<br>
					이때 비밀번호는 DB에 암호화 되어 저장이 되기 때문에 알수가 없어, 임의로 비밀번호를 바꾸어서 보내드립니다<br>
					<img src=images/t.gif border=0 height=4><br>
					<center>
					<img src=images/lo_email.gif border=0 align=absmiddle>&nbsp;<input type=text name=email size=17 class=input><br>
					<img src=images/lo_jumin.gif border=0 align=absmiddle>&nbsp;<input type=text name=jumin1 size=6 class=input maxlength=6> - <input type=password name=jumin2 size=7 class=input maxlength=7></td>
			</tr>
			<tr>
				<td colspan=2 align=right>
					<input type=image src=images/lo_ok.gif border=0>
					<a href=# onclick=window.close()><img src=images/lo_close.gif border=0>
				</td>
			</tr>
			</table>
		</td>
		<td><img src=images/t.gif border=0 width=7></td>
	</tr>
</form>
	</table>
	</td>
</tr>
</table>
<img src=images/t.gif border=0 height=5><br>
<?php
	if(isset($connect)) mysql_close($connect);
	foot();
?>
