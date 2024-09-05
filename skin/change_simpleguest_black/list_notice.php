<?php  include "$dir/value.php3";?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td>

<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=90%>
<tr>
<td bgcolor=<?=$line_color?> height=1 colspan=2></td></tr>
<tr>
<td width=50% bgcolor=<?=$bg_color?> class=change_tahoma_8pt>
<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data['no']?>"><?=$hide_cart_end?><b>+ Notice +</b>
</td>
<td align=right bgcolor=<?=$bg_color?> class=change_tahoma_8pt nowrap><?=$a_modify?>Modify</a> <?=$a_delete?>Del</a> (<?=$reg_date?>)
</td>
</tr>
<tr>
<td bgcolor=<?=$bg_color?> style='word-break:break-all;padding:10,10,10,10' colspan=2><?=$memo?></td>
</tr>
<tr>
<td bgcolor=<?=$line_color?> height=1 colspan=2></td></tr>
<tr>
</table>
</div>

<td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 height=5><tr><td>&nbsp;</td></tr></table> 