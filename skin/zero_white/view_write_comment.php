</table>
<div align=center>
<table border=0 cellspacing=0>
<col width=11></col><col width=></col><col width=11></col>
<tr align=center>
<td width=11>
<form method=post name=write action=comment_ok.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
</td>
<td>

  <img src=images/t.gif border=0 height=20><Br>

  <table border=0 cellspacing=1 cellpadding=0 bgcolor=666666>
  <tr>
  <td  bgcolor=eeeeee>

  <table border=0 cellpadding=5 cellspacing=1>
  <tr align=center style=font-size:9pt;font-family:굴림>
    <td width=80><font color=444444><b>이 &nbsp;&nbsp; 름</td>
    <td><font color=444444><b>내 &nbsp;&nbsp; 용</td>
    <?=$hide_c_password_start?><td><font color=444444><B>비밀번호</td><?=$hide_c_password_end?>
    <td rowspan=2 valign=bottom><input type=image src=<?=$dir?>/btn_comment_ok.gif border=0 onfocus=blur() accesskey="s"></td>
  </tr>
  <tr align=center>
    <td><?=$c_name?></td>
    <td><input type=text name=memo <?=size(50)?> maxlength=400 class=input>&nbsp;&nbsp;</td>
    <?=$hide_c_password_start?><td><input type=password name=password <?=size(10)?> maxlength=20 class=input>&nbsp;&nbsp;</td><?=$hide_c_password_end?>
  </tr>
  </table>

  </td>
  </tr>
  </table>

  </td>
  <td width=11>&nbsp;</td>
</tr>
</form>
</table>
<img src=images/t.gif border=0 height=20><br>
</div>

<?=$hide_comment_end?>
