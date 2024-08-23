<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>">
<?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?><col width=20></col><col width=100></col><col width=></col><col width=80></col><col width=60></col><col width=30></col>
<tr align=center>
        <td height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26 align=center><?=$a_no?><img src=<?=$dir?>/h_no.gif border=0></a></td></tr></table></td>
         <?=$hide_cart_start?><td width=34 height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26 align=center><?=$a_cart?><img src=<?=$dir?>/h_c.gif width=34 heigtht=26 border=0></a></td></tr></table></td><?=$hide_cart_end?>
	<td height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26 align=center></td></tr></table></td>
	<td height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26 align=center><?=$a_subject?><img src=<?=$dir?>/h_subject.gif border=0></a></td></tr></table></td>
	<td height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26 align=center><?=$a_name?><img src=<?=$dir?>/h_name.gif border=0></a></td></tr></table></td>
	<td height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26 align=center><?=$a_date?><img src=<?=$dir?>/h_date.gif border=0></a></td></tr></table></td>
	<td height=26><table width=100% cellspacing=0 cellpadding=0><tr><td background=<?=$dir?>/h_bg.gif height=26  align=center><?=$a_hit?><img src=<?=$dir?>/h_hit.gif border=0></a></td></tr></table></td>

</tr>
<tr><td colspan=7 height=5></td></tr>
