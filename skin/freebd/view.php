<img src=<?=$dir?>/t.gif border=0 height=5><br>
<table cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td colspan=2 bgcolor=white height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
      <tr>
        <td height=28 width="15"><img border="0" src="<?=$dir?>/img/foot_left.gif" width="15" height="28"></td>
        <td height=28 background="<?=$dir?>/img/foot_bg.gif">&nbsp;&nbsp;<?=$face_image?><?=$name?><font style='font-weight:normal;color:#000000'>&nbsp;님의 글입니다.</font><?=$hide_homepage_start?><?=$a_homepage?><font style='font-family:tahoma;font-size:8pt;color:#000000'>&nbsp;[homepage]</font><?=$hide_homepage_end?></td>
        <td background="<?=$dir?>/img/foot_bg.gif" height="28">
          <p align="right" class=pj_small>(<?=$date?>, Hit : <b><?=$hit?></b>)&nbsp;</td>
        <td width="15" height="28">
          <img border="0" src="<?=$dir?>/img/foot_right.gif" width="15" height="28"></td></tr></table></td>
</tr>
<table cellspacing=0 cellpadding=0 width=<?=$width?> class=zv3_viewform>
<col width=80><col width=>
          <?=$hide_download1_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/img/w_upload1.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> <font style='font-family:Arial;font-size:8pt;color:#999999'><b>Download : <?=$file_download1?></b></td>
</tr>
<tr><td colspan=2 bgcolor=#ededed height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/img/w_upload2.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> <font style='font-family:Arial;font-size:8pt;color:#999999'><b>Download : <?=$file_download2?></b></td>
</tr>
<tr><td colspan=2 bgcolor=#ededed height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/img/w_link1.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$sitelink1?></td>
</tr>
<tr><td colspan=2 bgcolor=#ededed height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=center><img src=<?=$dir?>/img/w_link2.gif></td></tr></table></td>
	<td bgcolor=white>&nbsp;<?=$sitelink2?></td>
</tr>
<tr><td colspan=2 bgcolor=#ededed height=1><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<?=$hide_sitelink2_end?>
<tr>
	<td height=22><table border=0 cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><font style='font-family:Arial;font-size:9pt;color:#999999'><b>Subject&nbsp;</b></td></tr></table></td>
	<td bgcolor=white style='word-break:break-all;'>&nbsp;<?=$subject?></td>

</table>
<img src=<?=$dir?>/t.gif border=0 height=2><br>
<table cellspacing=0 cellpadding=3 width=<?=$width?> bgcolor=efefef height=100 style="table-layout:fixed;">
<tr bgcolor=white>
	<td style='word-break:break-all;padding:10'>
		<?=$upload_image1?>
		<?=$upload_image2?>
		<?=$memo?>
		<br>
		<div align=right style=font-family:tahoma;font-size=8pt><?=$ip?></div>
	</td>
</tr>
</table>
<img src=<?=$dir?>/t.gif border=0 height=2><br>
<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
  <td colspan=5 height=1 bgcolor='<?=$comment_line?>'></td>
</tr>
<?=$hide_comment_end?>