<?php include "$dir/value.php3"; ?>
<div align=center>
<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=400>
<tr>
※ 입장하시려면 아이디와 비밀번호 입력후, 완료버튼을 누르세요 ※
</tr>
<tr>
 <td background=<?=$dir?>/images/list_t01_bg.gif align=left><img src=<?=$dir?>/images/list_t01_f.gif border=0></td>
 <td background=<?=$dir?>/images/list_t01_bg.gif align=right><img src=<?=$dir?>/images/list_t03.gif border=0></td>
</tr>
<tr>
 <td colspan=2 align=left height=10><img src=<?=$dir?>/images/blank.gif border=0></td>
</tr>
</table>


<table border=0 width=250 cellspacing=0 cellpadding=0>
<tr height=20 valign=bottom>
  <td width=130 align=right class=write><b>&nbsp;&nbsp;아이디</b></td>
  <td align=center class=write><input type=text name=user_id size=15 maxlength=20 class=input></td>
</tr>
<tr height=25>
  <td align=right class=write><b>&nbsp;&nbsp;비밀번호</b></td>
  <td align=center><input type=password name=password size=15 maxlength=20 class=input></td>
</tr>
<tr height=1><td colspan=2 bgcolor=666666><img src=images/t.gif height=1></td></tr>
<tr height=30>
  <td align=right align=center colspan=2 >
      <input type=image border=0 align=absmiddle src=<?=$dir?>/images/i_confirm.gif> 
      <img src=<?=$dir?>/images/i_wback.gif align=absmiddle border=0 onclick=history.go(-1) style=cursor:hand>
  </td>
</tr>
</table>
