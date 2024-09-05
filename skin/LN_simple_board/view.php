<img src=<?=$dir?>/images/t.gif border=0 height=5><br>
<table cellspacing=0 cellpadding=0 width=<?=$width?> >
<col width=80></col><col width=></col>
<tr><td colspan=2  height=1 bgcolor=eeeeee></td></tr>
<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_name.gif></td></tr></table></td>
	<td bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td>&nbsp;<?=$face_image?>&nbsp;<?=$name?></td><td align=right class=thm7></td></tr></table></td>
</tr>



<?=$hide_homepage_start?>
<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_homepage.gif></td></tr></table></td>
	<td class=ver7 bgcolor=fafafa>&nbsp;<?=$homepage?></td>
</tr>

<?=$hide_homepage_end?>

<?=$hide_download1_start?>
<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_upload1.gif></td></tr></table></td>
	<td class=ver7 bgcolor=fafafa>&nbsp;<?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></td>
</tr>

<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_upload2.gif></td></tr></table></td>
	<td class=ver7 bgcolor=fafafa>&nbsp;<?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></td>
</tr>

<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_link1.gif></td></tr></table></td>
	<td class=ver7 bgcolor=fafafa>&nbsp;<?=$sitelink1?></td>
</tr>

<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_link2.gif></td></tr></table></td>
	<td class=ver7 bgcolor=fafafa>&nbsp;<?=$sitelink2?></td>
</tr>

<?=$hide_sitelink2_end?>

<tr>
	<td height=25 bgcolor=fafafa><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/images/w_subject.gif></td></tr></table></td>
	<td  style='word-break:break-all;' bgcolor=fafafa>&nbsp;<?=$subject?></td>
</tr>

<tr><td colspan=2  height=1 bgcolor=eeeeee></td></tr>

</table>

<table cellspacing=0 cellpadding=3 width=<?=$width?>  height=100 >
	<?=$upload_image1_start?>
	<tr>
		 <td class=margin  align=center >
		     <?=$upload_image1?>
		</td>
	</tr>
	<?=$upload_image1_end?>

	<?=$upload_image2_start?>
	<tr>
		<td class=margin align=center>
		     <?=$upload_image2?>
		 </td>
	</tr>
	<?=$upload_image2_end?>

	<tr>
		 <td class=margin_comment >
		      <?=$memo?><br>
		</td>     
	</tr>
	
</table>
<img src=<?=$dir?>/images/t.gif border=0 height=2><br>
<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?> 
<table width=<?=$width?> cellspacing=0 cellpadding=0>
