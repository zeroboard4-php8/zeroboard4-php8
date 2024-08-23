</table>


<!-- 간단한 답변글 쓰기 -->
<table border=0 cellspacing=0 width=<?=$width?>>
<tr>
<td height=1 bgcolor=#F3F3F3></td>
</tr>
</tr>
<td>
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
<tr>
<td align=right>
  <table border=0 cellpadding=0 cellspacing=0>
  <tr>
   <td colspan=2 style='padding-top:10'>
   <textarea name=memo style='width:350px; height:62px' class=rini_textarea></textarea></td>
  </tr>
  <tr height=22>
   <td><font class=rini_ver3>name :&nbsp;&nbsp;</font><?=$c_name?>&nbsp;&nbsp;
   <?=$hide_c_password_start?><font class=rini_ver3>pass :&nbsp;&nbsp;</font><input type=password name=password <?=size(8)?> maxlength=20 class=rini_input><?=$hide_c_password_end?>
   </td>

   <td align=right>
   <input type=submit value="comment" class=rini_submit2 onfocus=blur() accesskey="s" style="cursor:hand">
   </td>

  </tr>
  </table>
<br>
</td>
</tr>
</form>
</table>