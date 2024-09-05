<?=$hide_comment_start?> 
</tr>
</table>

<table border=0 cellspacing=0 width=<?=$width?>>
<tr>
<td width=1>
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
<td align=right>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td height=10></td></tr></table>
<table border=0 cellspacing=0 cellpadding=0>
<tr><td colspan=2 align=right><textarea name=memo cols=39 rows=4 class=textarea></textarea></td></tr>
<tr><td><img src=<?=$dir?>/name.gif border=0><?=$c_name?>&nbsp;<?=$hide_c_password_start?><img src=<?=$dir?>/password.gif border=0><input type=password name=password <?=size(8)?> maxlength=20 class=input><?=$hide_c_password_end?></td><td align=right><input type=image src=<?=$dir?>/comment.gif border=0 align=absmiddle onfocus=blur() accesskey="s"></td></tr>
<tr><td height=10></td></tr>
</form></table></td></tr></table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td colspan=10 background=<?=$dir?>/dot.gif><img src=<?=$dir?>/dot.gif border=0 height=1></td></tr></table>
<?=$hide_comment_end?>