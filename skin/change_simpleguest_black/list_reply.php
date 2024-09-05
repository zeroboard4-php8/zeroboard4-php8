<?php  include "$dir/value.php3";?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td>

<div align=right>
<table border=0 bgcolor=<?=$bg_color?> cellspacing=0 cellpadding=0 width=90%>

<td width=50% class=change_tahoma_8pt><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$reply_data['no']?>"><?=$hide_cart_end?>&nbsp;<?=$face_image?><b><?=$name?></b>
</td>
<td align=right bgcolor=<?=$bg_color?> class=change_tahoma_8pt nowrap><?=$a_modify?>Modify</a> <?=$a_delete?>Del</a> (<?=$reg_date?>)
</td>
</tr>
<tr>
<td style='word-break:break-all;padding:5,5,5,5' colspan=2><?=$memo?></td>
</tr>
</table>
</div>

</td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0><tr><td height=10></td></tr></table> 