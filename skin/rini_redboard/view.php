<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td colspan=2 height=1 bgcolor=#F3F3F3></td>
</tr>

<tr height=26>
<td width=70 align=right class=rini_ver5>NAME</font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=left nowrap><?=$face_image?> <?=$name?>&nbsp;
<?php
  if($data['homepage']) {
?><a href="<?=$data['homepage']?>" target=_blank onfocus='this.blur()'><font class=rini_ver3>(homepage)</font></a>
<?php
    }
?></td>
</tr>

<tr>
<td colspan=2 height=1 bgcolor=#F3F3F3></td>
</tr>

<tr height=26>
<td width=70 align=right class=rini_ver5>SUBJECT&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=left nowrap><?=$subject?></td>
</tr>

<tr>
<td colspan=2 height=1 bgcolor=#F3F3F3></td>
</tr>

<tr>
<td colspan=2 height=6></td>
</tr>

<?=$hide_sitelink1_start?>
<tr height=20>
<td width=70 align=right class=rini_ver5>LINK 1&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=left><?=$sitelink1?></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=20>
<td width=70 align=right class=rini_ver5>LINK 2&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=left><?=$sitelink2?></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_download1_start?>
<tr height=20>
<td width=70 align=right class=rini_ver5>DOWN 1&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=left><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a>, Download : <?=$file_download1?></td>
</tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr height=20>
<td width=70 align=right class=rini_ver5>DOWN 2&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td align=left><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a>, Download : <?=$file_download2?></td>
</tr>
<?=$hide_download2_end?>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td style='word-break:break-all;padding:8'>
<?=$upload_image1?>
<table border=0 cellspacing=0 cellpadding=0>
<tr><td height=5></td></tr></table>
<?=$upload_image2?>
<?=$memo?>
</td>
</tr>
<tr><td height=2></td></tr>
<tr><td align=right class=rini_ver3><?=$ip?></td></tr>
<tr><td height=6></td></tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$hide_comment_end?>