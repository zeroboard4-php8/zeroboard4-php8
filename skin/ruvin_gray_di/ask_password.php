<br><br><br>
<table border=0 width=200 cellspacing=0 cellpadding=0>
<tr><td align=center><img src=<?=$dir?>/ruvin_fine.gif border=0 height=33></td></tr>
<tr><td height=3></td></tr>
<tr height=2><td colspan=6 background=<?=$dir?>/line_dot.gif height=2></td></tr>

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
<tr><td height=15></td></tr>

<tr><td align=center><font class=fine><?=$title?></font></td></tr>

<tr><td align=center><?=$input_password?></td></tr>

<tr><td height=15></td></tr>

<tr height=2><td colspan=6 background=<?=$dir?>/line_dot.gif height=2></td></tr>
<tr><td height=10></td></tr>

<tr><td align=center>
<input type=image src=<?=$dir?>/confirm.gif border=0 onfocus=blur()>
<a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/back.gif border=0></a></td></tr>
</table>
</form>
<br>