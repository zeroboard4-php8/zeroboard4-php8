<?php include "$dir/value.php3"; ?>

<table><td height=30></td></table>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
  <td width=1 bgcolor='<?=$head_border?>'><img width=1 height=33></td>
  <td width=248 height=13 background=<?=$dir?>/images/head_bg.gif><img width=10 height=1><font color=white>&nbsp;멤버 로그인</td>
  <td width=1 bgcolor='<?=$head_border?>'><img width=1 height=33></td>
</tr>
<tr>
  <td height=7></td>
</tr>
<tr>
  <td colspan=3>
  <table border=0 width=250>
  <tr align=right>
    <td><span style="font-size:9pt;">아이디</span></td>
    <td><input type=text name=user_id size=20 maxlength=20 class=input></td>
  </tr>
  <tr align=right>
    <td><span style="font-size:9pt;">비밀번호</span></td>
    <td width=135><input type=password name=password size=20 maxlength=20 class=input></td>
  </tr>
  <tr>
    <td height=7></td>
  </tr>
  </table>  
  </td>
</tr>
<tr>
  <td colspan=3 height=1 bgcolor='<?=$all_foot_line?>' colspan=2></td>
</tr>
<tr height=30>
  <td align=right colspan=2>
      <input type=image src=<?=$dir?>/images/i_confirm.gif><img width=10 height=1><a href=javascript:history.go(-1)><img src=<?=$dir?>/images/i_back.gif border=0 ></a></td>
</tr>
</table>
