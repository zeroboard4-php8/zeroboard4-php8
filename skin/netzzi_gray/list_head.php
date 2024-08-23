<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected><input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<col width=6></col>
<?=$hide_cart_start?><col width=10></col><?=$hide_cart_end?>
<col width=40></col>
<col width=></col>
<col width=90></col>
<col width=60></col>
<col width=40></col>
<col width=6></col>
<tr align=center>
	<td height=22 widht=6 background=<?=$dir?>/top_left.gif>
	<?=$hide_cart_start?>
	<td height=22 background=<?=$dir?>/robinweb_topbar.gif><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_cart?><img src=<?=$dir?>/h_cart.gif border=0></a></td></tr></table></td><?=$hide_cart_end?>
	<td background=<?=$dir?>/robinweb_topbar.gif><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_no?><img src=<?=$dir?>/h_num.gif border=0></a></td></tr></table></td>
	<td background=<?=$dir?>/robinweb_topbar.gif><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_subject?><img src=<?=$dir?>/h_subject.gif border=0></a></td></tr></table></td>
	<td background=<?=$dir?>/robinweb_topbar.gif><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_name?><img src=<?=$dir?>/h_writer.gif border=0></a></td></tr></table></td>
	<td background=<?=$dir?>/robinweb_topbar.gif><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_date?><img src=<?=$dir?>/h_date.gif border=0></a></td></tr></table></td>
	<td background=<?=$dir?>/robinweb_topbar.gif><table cellspacing=0 cellpadding=0><tr><td align=center><?=$a_hit?><img src=<?=$dir?>/h_read.gif border=0></a></td></tr></table></td>
	<td widht=6 background=<?=$dir?>/top_right.gif>
</tr>

