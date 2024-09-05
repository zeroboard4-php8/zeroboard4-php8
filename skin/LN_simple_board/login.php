<?php include "$dir/value.php3"; ?>
<div align=center>
<br><br><br>
<table width=250 border=0 cellpadding=0 cellspacing=0>

<tr>
  <td height=20  colspan=2  nowrap class=ver8><img src=<?=$dir?>/images/member_login.gif border=0 align=absmidlle></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>
<tr>
<td colspan=2 height=6 bgcolor=<?=$sC_color?>></td>
</tr>
<tr>
  <td bgcolor=<?=$sC_color?> align=center nowrap class=ver7><img src=<?=$dir?>/images/w_id.gif border=0 align=absmidlle></td>
  <td bgcolor=<?=$sC_color?>><input type=text name=user_id size=15 maxlength=20 class=input></td>
</tr>
<tr>
  <td bgcolor=<?=$sC_color?> align=center nowrap class=ver7><img src=<?=$dir?>/images/w_pass.gif border=0 align=absmidlle></td>
  <td bgcolor=<?=$sC_color?>><input type=password name=password size=15 maxlength=20 class=input></td>
</tr>
<tr>
<td colspan=2 height=6 bgcolor=<?=$sC_color?>></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>
<tr>
<td height=5></td>
</tr>
<tr>
  <td align=center colspan=2 >
     <input type=submit value="Go" class=submit>
     <input type=button value="Back" onclick=history.go(-1) class=submit>
  </td>
</tr>
</table>
