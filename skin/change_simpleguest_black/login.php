<?php include "$dir/value.php3";?>

<br>
<br>
<br>
<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=250>

<tr>
<td bgcolor=<?=$line_color?> align=center colspan=2></td>
</tr>

<tr>
<td bgcolor=<?=$bg_color?> align=center colspan=2 class=change_tahoma_8pt><b>Member Login</b></td>
</tr>

<tr height=30>
<td align=right class=change_tahoma_8pt>ID &nbsp;</td>
<td align=center><input type=text name=user_id size=20 maxlength=20 class=input></td>
</tr>

<tr>
<td align=right class=change_tahoma_8pt>Password &nbsp;</td>
<td align=center><input type=password name=password size=20 maxlength=20 class=input></td>
</tr>

<tr height=30>
<td align=center align=center colspan=2 >
<input type=submit value="Login" class=submit>&nbsp;&nbsp;<input type=button value="Back" onclick=history.go(-1) class=submit>
</td>
</tr>

<tr>
<td align=center colspan=2 bgcolor=<?=$line_color?>></td>
</tr>
</table>