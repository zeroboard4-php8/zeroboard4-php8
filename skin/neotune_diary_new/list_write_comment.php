
<!-- 간단한 답변글 쓰기 -->
<tr align=center>
<td width=0>
<form method=get name=write action="comment_ok.php">
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$data['no']?>>
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
 <table width=400 border=0 cellpadding=2 cellspacing=0>
 <tr>
  <td width=20 class=com-h><b>Name:</b></td>
  <td width=80><img src=images/t.gif height=3><br><?=$c_name?></td>
  <td width=250 rowspan=2><img src=images/t.gif height=3><br><textarea name=memo rows=3 cols=38 style="border-width:1; border-color:#EBEBEB; border-style:solid;"></textarea></td>

  <td width=50 rowspan=2><img src=images/t.gif height=3><br> <input type=submit value="write"  rows=18 class=submit onfocus=this.blur()></td>
  </tr>
 <tr>
<?=$hide_c_password_start?>
  <td width=20 class=com-h><b>Pass:</b></td>
  <td width=80><img src=images/t.gif height=3><br><input type=password name=password <?=size(8)?> maxlength=20 class=input></td>
<?=$hide_c_password_end?>
 </tr>
  </table>
 </td>
</tr>
</form>
</table>
