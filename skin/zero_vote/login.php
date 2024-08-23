<?php 
$sC_dark0 = "#9F9F9F";
 $sC_dark1 = "#404040";
 $sC_light0 = "#FEFEFE";
 $sC_light01 = "FCFCFC";
 $sC_light1 = "#E2E2E2";
 $sC_search0 = "#5E5E5E";
?>
<div align=center>
<br><br><br>
<table border=0 width=250 cellspacing=0 cellpadding=0>
<tr>
  <td colspan=2 height=15 background=<?=$dir?>/images/lh_bg.gif><img src=images/t.gif height=1></td>
</tr>
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<span style="font-family:Arial;font-size:8pt;font-weight:bold;"><font color=#333333>Member</font> <span style=font-size:15px;letter-spacing:-1px;>Log!n</span></span></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
<tr height=20 valign=bottom bgcolor=<?=$sC_light1?>>
  <td align=right class=thm8><b>ID &nbsp;&nbsp;&nbsp;</b></td>
  <td align=right class=thm8><b>Password &nbsp;&nbsp;&nbsp;</b></td>
</tr>
<tr height=25 bgcolor=<?=$sC_light1?>>
  <td align=center><input type=text name=user_id size=15 maxlength=20 class=input style=height:18px;font-family:Arial;font-size:8pt;font-weight:bold;color:<?=$sC_dark1?>></td>
  <td align=center><input type=password name=password size=15 maxlength=20 class=input style=height:18px;font-family:Arial;font-size:8pt;font-weight:bold;color:<?=$sC_dark1?>></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_dark1?>><img src=images/t.gif height=1></td></tr>
<tr height=30>
  <td align=right align=center colspan=2 >
      <input type=image border=0 align=absmiddle src=<?=$dir?>/images/btn_confirm.gif> 
      <img src=<?=$dir?>/images/btn_back.gif align=absmiddle border=0 onclick=history.go(-1) style=cursor:hand>
  </td>
</tr>
</table>
