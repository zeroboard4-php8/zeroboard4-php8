<img src=<?=$dir?>/t.gif border=0 height=5><br>
<table cellspacing=0 cellpadding=0 width=<?=$width?> class=zv3_viewform>
<col width=80></col><col width=></col>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_name.gif></td></tr></table></td>
	<td bgcolor=white><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td>&nbsp;<?=$face_image?>&nbsp;<?=$name?></td><td align=right class=zv3_small>(<?=$date?>, Hit : <b><?=$hit?></b>, Vote : <b><?=$vote?></b>)&nbsp;</td></tr></table></td>
</tr>

<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>

<?=$hide_homepage_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_homepage.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$homepage?></td>
</tr>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_homepage_end?>

<?=$hide_download1_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_upload1.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></td>
</tr>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_upload2.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></td>
</tr>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_link1.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$sitelink1?></td>
</tr>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_link2.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$sitelink2?></td>
</tr>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_sitelink2_end?>

<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/w_subject.gif></td></tr></table></td>
	<td bgcolor=white style='word-break:break-all;'>&nbsp;<?=$subject?></td>
</tr>

<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>

</table>
<img src=<?=$dir?>/t.gif border=0 height=2><br>
<table cellspacing=0 cellpadding=3 width=<?=$width?> bgcolor=efefef height=100 style="table-layout:fixed;">
<tr bgcolor=white>
	<td style='word-break:break-all;padding:10'>
		<?=$upload_image1?>
		<?=$upload_image2?>
		<?=$memo?>
		<br>
		<br>
		<div align=right style=font-family:tahoma;font-size=8pt><?=$ip?></div>
	</td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=2><br>
<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?> 
<table class=zv3_table width=<?=$width?> cellspacing=0 cellpadding=0>
