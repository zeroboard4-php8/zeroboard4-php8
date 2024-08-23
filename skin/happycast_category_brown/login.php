<?php include "$dir/value.php3"; ?>
<div align=center>
<br><br><br>
<table width=250 border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>><tr><td><img src=images/t.gif height=3></td></tr></table>
<table border=0 width=250 cellspacing=0 cellpadding=0>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<font class=view_title1>Member</font> <font class=view_title2>Log!n</font></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>
<tr height=20 valign=bottom bgcolor=<?=$view_left_header_color?>>
  <td align=right class=listnum><b>ID &nbsp;&nbsp;&nbsp;</b></td>
  <td align=right class=listnum><b>Password &nbsp;&nbsp;&nbsp;</b></td>
</tr>
<tr height=25 bgcolor=<?=$view_left_header_color?>>
  <td height=50 align=center><input type=text name=user_id size=<?php if($browser)echo"15";else echo"10";?> maxlength=20 class=input style=height:18px;font-family:Arial;font-size:8pt;font-weight:bold;color:gray style="border-width:1px; border-color:rgb(153,153,153); border-style:solid;"></td>
  <td align=center><input type=password name=password size=<?php if($browser)echo"15";else echo"10";?> maxlength=20 class=input style=height:18px;font-family:Arial;font-size:8pt;font-weight:bold;color:<?=$sC_dark1?> style="border-width:1px; border-color:rgb(153,153,153); border-style:solid;"> </td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>
</table>
<br>
<center>
<input type=image border=0 src=<?=$dir?>/btn_confirm.gif onfocus=blur()> 
<a href=# onclick=history.go(-1) onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0></a>
</center>
