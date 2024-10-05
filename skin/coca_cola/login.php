<?php include "$dir/value.php3"; ?>
<div align=center>
<br><br><br>

<table border=0 width=250 cellspacing=0 cellpadding=0>
	<tr>
	  <td colspan=2 height=110>
	  <img src=<?=$dir?>/images/login1.gif></td>
	</tr>
	<tr>
	  <td colspan=2 height=16>
	  <img src=<?=$dir?>/images/login2.gif></td>
	</tr>
	<tr>
	  <td colspan=2 height=30 background=<?=$dir?>/images/login3.gif align=left><span style="font-family:Arial;font-size:8pt;font-weight:bold;">&nbsp;&nbsp;<font color=#333333>Member</font> <span style=font-size:15px;letter-spacing:-1px;><font color=<?=$sC_dark0?>>Log!n</font></span></span></td>
	</tr>
	<tr height=1><td colspan=2 bgcolor=<?=$sC_dark0?>><img src=images/t.gif height=1></td></tr>
	<tr height=20 valign=bottom>
	  <td align=right class=thm8 background=<?=$dir?>/images/login4.gif><b>ID &nbsp;&nbsp;&nbsp;</b></td>
	  <td align=right class=thm8 background=<?=$dir?>/images/login5.gif><b>Password &nbsp;&nbsp;&nbsp;</b></td>
	</tr>
	<tr height=25>
	  <td align=center background=<?=$dir?>/images/login6.gif><input type=text name=user_id size=15 maxlength=20 class=input style=height:18px;font-family:Arial;font-size:8pt;font-weight:bold;color:<?=$sC_dark1?>></td>
	  <td align=center background=<?=$dir?>/images/login7.gif><input type=password name=password size=15 maxlength=20 class=input style=height:18px;font-family:Arial;font-size:8pt;font-weight:bold;color:<?=$sC_dark1?>></td>
	</tr>
	<tr height=1><td colspan=2 bgcolor=<?=$sC_dark1?>><img src=images/t.gif height=1></td></tr>
	<tr height=30>
	  <td align=right align=center colspan=2 >
	      <input type=image border=0 align=absmiddle src=<?=$dir?>/images/btn_confirm.gif> 
	      <img src=<?=$dir?>/images/btn_back.gif align=absmiddle border=0 onclick=history.go(-1) style=cursor:hand>
	  </td>
	</tr>
</table>



