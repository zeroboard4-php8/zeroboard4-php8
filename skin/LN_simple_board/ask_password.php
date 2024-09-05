<?php include "$dir/value.php3"; ?>
<br><br><br>
<table width=250 border=0 cellpadding=0 cellspacing=0>

<tr>
 <td height=20 align=LEFTr class=ver8><img src=<?=$dir?>/images/message.gif border=0 align=absmidlle></td>
 <tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>
</tr>
</table>
<table width=250 border=0 cellpadding=0 cellspacing=0>
<form method=post name=delete action=<?=$target?>>
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
<input type=hidden name=c_no value=<?=$c_no?>>
<tr>
<td height=10 bgcolor=<?=$sC_color?>></td>
</tr>
<tr>
   <td height=40 bgcolor=<?=$sC_color?> align=center class=ver8><?=$title?></td>
</tr>
<tr>
<td height=10 bgcolor=<?=$sC_color?>></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>
<tr>
<td height=10></td>
</tr>
<tr>
    <td align=center height=50>
     <?=$input_password?>
     <input type=submit value="OK" class=submit>　
     <input type=button value="Back" onclick=history.go(-1) class=submit>
   </td>
</tr>
<tr>
<td height=10></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$sC_line02?>><img src=images/t.gif height=1></td></tr>

</table>
</form>

