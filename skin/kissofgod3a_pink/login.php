<?php include "$dir/value.php3"; ?>
<br><br><br>
<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=300>
<tr>
  <td valign=bottom class=kissofgod-head-td><img src=images/t.gif width=1 height=1></td>
</tr>
<tr>
  <td style='padding:10 0 0 5'><font class=kissofgod-large-font>회원으로 로그인합니다.</font></td>
</tr>
<tr height=1><td class=kissofgod-line3><img src=images/t.gif width=1 height=1></td></tr>
<tr height=20><td><img src=images/t.gif width=1 height=1></td></tr>
<tr>
  <td align=right><b>아이디</b>　<input type=text name=user_id size=<?php if($browser)echo"15";else echo"10";?> maxlength=20 class=kissofgod-input></td>
</tr>
<tr height=20><td><img src=images/t.gif width=1 height=1></td></tr>
<tr>
  <td align=right><b>비밀번호</b>　<input type=password name=password size=<?php if($browser)echo"15";else echo"10";?> maxlength=20 class=kissofgod-input> </td>
</tr>
<tr height=20><td><img src=images/t.gif width=1 height=1></td></tr>
<tr><td height=1 class='kissofgod-line2'><img src=images/t.gif border=0 width=1 height=1></td></tr>
<tr>
  <td align=right style='padding:15 0 0 0'><input type=image border=0 src=<?=$dir?>/btn_confirm.gif onfocus=blur()>　　　<a href=# onclick=history.go(-1) onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0></a></td>
</tr>
</table>
<br>
