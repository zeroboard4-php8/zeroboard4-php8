<?php
  include "lib.php";

  $user_id = htmlspecialchars(trim($user_id));
  $user_id = trim($user_id);
  $connect=dbconn();
  $check=mysql_fetch_array(zb_query("select count(*) from $member_table where user_id='$user_id'"));
  mysql_close($connect);
  head();
?>
<table border=0 width=100% height=100%>
<tr>
  <td align=center>
<?php
  if($check[0]) echo "$user_id 는 이미 등록된<br> 아이디입니다";
  else echo"$user_id 는 사용하실수 있습니다";
?>

</td>
</tr>
<form>
<tr>
  <td align=center><input type=button value='Close window' onclick=window.close(); class=submit></td>
</tr>
</form>
</table>

<?php 
	 foot(); 
?>
