<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td colspan=8 background=<?=$dir?>/image/list_back.gif></td>
</tr>
<tr height=15>
  <td colspan=2 bgcolor=ffffff class=t8_4a4d4a align=center>View Article </td>
  <td colspan=2 bgcolor=ffffff class=t7_4a4d4a align=right><?=$a_modify?><img src=<?=$dir?>/image/btn_modify.gif border=0 align=absmiddle>&nbsp;&nbsp;</a></td>
  <td colspan=2 bgcolor=ffffff class=t7_4a4d4a align=right><?=$a_delete?><img src=<?=$dir?>/image/btn_delete.gif border=0 align=absmiddle>&nbsp;</a></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
<tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>Name</td>
 <td bgcolor=c4c4c4 ></td>
<td style='word-break:break-all;' colspan=8 width=100% class=t8_gray>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<td align=left class=g8_gray >
&nbsp;&nbsp;<?=$face_image?><?=$name?>
</td>
<td align=right class=t7_gray >
<?=$date?>, Hit : <b><?=$hit?></b>
</td>
</table>
</td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
<?=$hide_homepage_start?>
<tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>Homepage</td>
 <td bgcolor=c4c4c4></td>
<td style='word-break:break-all;' width=100% class=t8_gray>&nbsp;&nbsp;<?=$homepage?></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
<?=$hide_homepage_end?>
  <?=$hide_download1_start?>
    <tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>File #1</td>
 <td bgcolor=c4c4c4></td>
<td width=100% class=t7_gray>&nbsp;&nbsp; <?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> &nbsp; <font style=font-size:7pt;>Download : <?=$file_download1?></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
  <?=$hide_download1_end?>
  <?=$hide_download2_start?> 
      <tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>File #2</td>
 <td bgcolor=c4c4c4></td>
<td width=100% class=t7_gray>&nbsp;&nbsp; <?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> &nbsp; <font style=font-size:7pt;>Download : <?=$file_download2?></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
  <?=$hide_download2_end?>
  <?=$hide_sitelink1_start?>
<tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>Link #1</td>
 <td bgcolor=c4c4c4></td>
<td width=100% class=t7_gray>&nbsp;&nbsp; <?=$sitelink1?></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
  <?=$hide_sitelink1_end?>
  <?=$hide_sitelink2_start?>
  <tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>Link #2</td>
 <td bgcolor=c4c4c4></td>
<td width=100% class=t7_gray>&nbsp;&nbsp; <?=$sitelink2?></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
  <?=$hide_sitelink2_end?>
<tr height=23>
 <td align=center width=100 bgcolor=f7f7f7 class=t7_4a4d4a nowrap>Subject</td>
 <td bgcolor=c4c4c4></td>
<td style='word-break:break-all;' width=100% class=t8_gray>&nbsp;&nbsp;<b><?=$subject?></b></td>
</tr>
<tr>
 <td colspan=8 bgcolor=c4c4c4 height=1></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td style='word-break:break-all;padding:10px;' bgcolor=f7f7f7 height=100 valign=top>
     <span style=line-height:160%>
     <?=$upload_image1?>
     <?=$upload_image2?>
     <?=$memo?>
     <br>
     <div align=right style=font-family:Tahoma;font-size:7pt;><?=$ip?></div>
     </span>
 </td>
</tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?> 
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$hide_comment_end?>
