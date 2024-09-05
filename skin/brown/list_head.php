<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td>
<!--테이블 시작-->
<table border=0 cellspacing=0 cellpadding=0 width=100% style='table-layout:fixed' align=center>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">

<?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?>
<col width=30 align=center></col>
<?=$hide_category_start?><col width=80 align=center></col><?=$hide_category_end?>
<col width=100% align=left></col>
<col width=90 align=center></col>
<col width=70 align=center></col>
<col width=40 align=center></col>
	<tr>
	  <td colspan=7 background=<?=$dir?>/s_top_bg.gif><img src=<?=$dir?>/s_top_bg.gif border=0></td>
	</tr>
	<tr height=30>
		<td align=center><?=$a_no?><img src="<?=$dir?>/head_no.gif" border=0></a></td>
		<?=$hide_cart_start?>
		<td align=center><?=$a_cart?><img src="<?=$dir?>/head_c.gif" border=0></a></td>
		<?=$hide_cart_end?>
		<?=$hide_category_start?>
		<td align=center><?=$a_category?></td>
		<?=$hide_category_end?>
		<td align=center><form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><?=$a_subject?><img src=<?=$dir?>/head_subject.gif border=0></a></td>
		<td align=center><?=$a_name?><img src=<?=$dir?>/head_name.gif border=0></a></td>
		<td align=center><?=$a_date?><img src=<?=$dir?>/head_date.gif border=0></a></td>
		<td align=center><?=$a_hit?><img src=<?=$dir?>/head_hit.gif border=0></a></td>
	</tr>
	<tr>
	  <td colspan=7 background=<?=$dir?>/s_bottom_bg.gif><img src=<?=$dir?>/s_bottom_bg.gif border=0></td>
	</tr>