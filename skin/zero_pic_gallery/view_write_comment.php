</table>
<div align=center>

<table border=0 cellspacing=0 width=<?=$width?> bgcolor=<?=$_color2?>>
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

  <table border=0 cellspacing=1 cellpadding=0 width=100%>
  <tr>
  <td  bgcolor=<?=$_color2?>>

  <table border=0 cellpadding=5 cellspacing=1 width=100%>
  <tr align=center>
		<?=$hide_c_password_start?><col width=80><?=$hide_c_password_end?></col><col width=></col><?=$hide_c_password_start?><col width=100></col><?=$hide_c_password_end?><col width=90></col>
    <?=$hide_c_password_start?><td>이름 :<br><?=$c_name?></td><?=$hide_c_password_end?>
    <td><textarea name=memo cols=50 rows=4 style=width:100% class=textarea></textarea></td>
    <?=$hide_c_password_start?><td>비밀번호 :<br><input type=password name=password <?=size(10)?> maxlength=20 class=input>&nbsp;&nbsp;</td><?=$hide_c_password_end?>
    <td><input type=submit value="코멘트쓰기" accesskey="s" style=width=80;height=60 class=textarea></td>
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
</div>
<?=$hide_comment_end?>
