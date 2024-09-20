</table>

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

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
<td style='padding-left:10;padding-right:10;'>

<table border=0 align=center cellpadding=0 cellspacing=0 width=100%>
<tr>
<td>

<table border=0 align=right cellpadding=0 cellspacing=0 width=100%>
<tr>
<td colspan=2><textarea name=memo style="width:100%;height:74" class=input></textarea></tr>
</tr>
<tr>
<td nowrap align=left><?=$hide_c_password_start?><font class=ver7>NAME</font> <input type=name name=name class=input2 style="width:30%;height:21;">　
<font class=ver7>PW</font> <input type=password name=password class=input2 style="width:32%;height:21;"><?=$hide_c_password_end?>
</td>
<td align=right><input type=submit <?php if($browser){?>class=button<?php }?> value='COMMENT' accesskey="s"></td>
</tr>
</table>

</td>
</tr>
</table>

</td>
</tr>
</table>
</form>