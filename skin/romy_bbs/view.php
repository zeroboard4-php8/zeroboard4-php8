<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td height=1 class=line></td></tr>


<tr><td align=center height=50 style="padding:3px 10px 0 14px; word-wrap:break-word; word-break:break-all;"><font class=bat7><?=$subject?></font></td></tr>
<tr><td align=center height=10 style="padding:1px 1px 0 1px; word-wrap:break-word; word-break:break-all;"><font class=tim6><?=$date=date("Y · m · d",$data['reg_date'])?></font></td></tr>
<tr><td align=center height=10 style="padding:1px 1px 0 1px; word-wrap:break-word; word-break:break-all;"><font class=tim6><?=$a_modify?>M</a>&nbsp;<font color=#b2b2b2>&nbsp;&nbsp;&nbsp;</font>&nbsp;<font class=tim6><?=$a_delete?>D</a>&nbsp;</td></tr>

<?=$hide_download1_start?>
	<tr>
		<td height=22 class=thm7>&nbsp;&nbsp;<?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a></td>
	</tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
	<tr>
		<td height=22 class=thm7>&nbsp;&nbsp;<?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a></td>
	</tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
	<tr>
		<td height=22 class=thm7>&nbsp;&nbsp;<?=$sitelink1?></td>
	</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
	<tr>
		<td height=22 class=thm7>&nbsp;&nbsp;<?=$sitelink2?></td>
	</tr>
<?=$hide_sitelink2_end?>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
	<tr>
		<td style='padding:15 10 15 10;'>
		<?=$upload_image1?>
		<?=$upload_image2?>
		<p><font class=bat7><?=$memo?></p>
		</td>
	</tr>
</table>

<?=$hide_comment_start?> 
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>> 
<?=$hide_comment_end?>