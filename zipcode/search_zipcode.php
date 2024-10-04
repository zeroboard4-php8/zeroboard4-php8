<html>
<head>
<title>Search ZipCode</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link rel="stylesheet" href="style.css" type="text/css">
<script>
 function move()
 {
  write2.address.focus()
 }
</script>
</head>
<body bgcolor=white leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload=move()>
<script>
function check_submit()
{
 if(!write2.address.value)
 {
  alert('주소를 입력하여 주세요');
  write2.address.focus();
  return false;
 }
 return true;
}
</script>

<table border=0 cellspacing=1 cellpadding=4 width=100% bgcolor=black height=100%>
<form name=write2 method=post action=search_zipcode2.php onsubmit='return check_submit()'>
<input type=hidden name=num value=<?=isset($num)?$num:''?>>
<tr bgcolor=777777>
  <td align=center><b><font color=white>우편번호 검색 </b>(Search Zipcode)</td>
</tr>
<tr bgcolor=white>
  <td align=center height=100%>
  우편번호를 검색합니다.<br>
  찾고자 하는 동의 이름을 입력하여 주십시요.<br>
  ( 예: <b>대연동</b>    또는    <b>대연1동</b> )<br><br>
  <input type=text name=address value="" size=20 class=input><input type=submit value="Search" class=submit><input type=button value="Close" class=close onclick=window.close()>

<br><br><br>
   </td>
</tr>
</form>
</table>
</body>
</html>

