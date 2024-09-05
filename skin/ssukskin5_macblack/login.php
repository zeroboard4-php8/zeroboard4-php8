<div align=center>
<br><br><br>
<table width=250 border=0 cellspacing=0 cellpadding=0>
<tr>
   <td width=10 height=10 background=<?=$dir?>/bg_1.gif></td>
   <td width=230 background=<?=$dir?>/bg_2.gif valign=BOTTOM><img src=<?=$dir?>/b_login.gif></td>
   <td width=10 height=10 background=<?=$dir?>/bg_3.gif></td>
</tr>
</table>

<table border=0 width=240 cellspacing=0 cellpadding=0>
<tr height=10><td colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=ssuk_num><b>ID &nbsp;&nbsp;</b></td>
  <td height=30 align=center><input type=text name=user_id size=<?php if($browser)echo"15";else echo"10";?> maxlength=20 class=ssuk_input2 style=height:18px;font-family:verdana,굴림;font-size:8pt;color:gray></td>
</tr>
<tr height=30>
  <td align=right class=ssuk_num><b>Password &nbsp;&nbsp;</b></td>
  <td align=center><input type=password name=password size=<?php if($browser)echo"15";else echo"10";?> maxlength=20 class=ssuk_input2 style=height:18px;font-family:verdana,굴림;font-size:8pt;color:gray></td>
</tr>
<tr height=1><td colspan=2 bgcolor=#484848><img src=images/t.gif height=1></td></tr>
<tr height=10><td colspan=2><img src=images/t.gif height=1></td></tr>
<tr><td colspan=2 align=right><input type=image border=0 src=<?=$dir?>/b_confirm.gif onfocus=blur()><a href=# onclick=history.go(-1) onfocus=blur()><img src=<?=$dir?>/b_back.gif border=0></a></td></tr>
</table>
<br>
