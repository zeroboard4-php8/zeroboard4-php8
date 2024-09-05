<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=10></td><col width=></col><col width=10></td>
<tr align=center>
<tr>
  <td><img src=<?=$dir?>/bg_1.gif border=0></td>
  <td class=ssuk_lh valign=top><img src=<?=$dir?>/l_view.gif align=left><?=$a_modify?><img src=<?=$dir?>/s_modify.gif border=0 align=right></a><?=$a_delete?><img src=<?=$dir?>/s_delete.gif border=0 align=right></a></td>
  <td><img src=<?=$dir?>/bg_3.gif border=0></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<col width=80 class=ssuk_view></col><col width=></col>
<tr>
 <td height=23 align=right><img src=images/t.gif border=0 width=80 height=1><br><img src=<?=$dir?>/l_name.gif border=0></td>
 <td align=left><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td align=left nowrap>&nbsp;&nbsp; <?=$face_image?> <?=$name?>&nbsp;<?=$hide_homepage_start?><font style=font-size:8pt;font-family:verdana>(<?=$homepage?>)</font><?=$hide_homepage_end?></td><td align=right nowrap><font style=font-size:7pt;font-family:tahoma>(<?=$reg_date?>, H:<?=$hit?>)</font></td></tr></table></td>
</tr>
<tr><td bgcolor=#383838 height=1 colspan=2><img src=images/t.gif height=1></td></tr>

<?=$hide_download1_start?>
<tr>
 <td height=23 align=right><img src=images/t.gif border=0 width=80 height=1><br><img src=<?=$dir?>/l_upload1.gif border=0></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=ssuk_num><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> &nbsp; Download : <?=$file_download1?></font></td>
</tr>
<tr><td bgcolor=#383838 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr>
 <td height=23 align=right><img src=images/t.gif border=0 width=80 height=1><br><img src=<?=$dir?>/l_upload2.gif border=0></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=ssuk_num><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> &nbsp; Download : <?=$file_download2?></font></td>
</tr>
<tr><td bgcolor=#383838 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr>
 <td height=23 align=right><img src=images/t.gif border=0 width=80 height=1><br><img src=<?=$dir?>/l_link1.gif border=0></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=ssuk_num><?=$sitelink1?></font></td>
</tr>
<tr><td bgcolor=#383838 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr>
 <td height=23 align=right><img src=images/t.gif border=0 width=80 height=1><br><img src=<?=$dir?>/l_link2.gif border=0></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=ssuk_num><?=$sitelink2?></font></td>
</tr>
<tr><td bgcolor=#383838 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_end?>

<tr>
 <td height=23 align=right><img src=images/t.gif border=0 width=80 height=1><br><img src=<?=$dir?>/l_subject.gif border=0></td>
 <td><img src=images/t.gif height=3><br>&nbsp;&nbsp; <b><?=$subject?></b></td>
</tr>

<tr><td bgcolor=383838 height=2 colspan=2><img src=images/t.gif height=1></td></tr>

<tr><td colspan=2><img src=images/t.gif height=1></td></tr>

</table>

<table border=0 cellspacing=0 cellpadding=10 width=<?=$width?>>
<tr>
 <td style='word-break:break-all;' height=100 valign=top>
     <span style=line-height:160%>
     <?=$upload_image1?>
     <?=$upload_image2?>
     <?=$memo?>
     <br>
     <div align=right style=font-family:verdana;font-size:7pt;><?=$ip?></div>
     </span>
 </td>
</tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?> 
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr><td bgcolor=#484848 height=1></td></tr>
<?=$hide_comment_end?>
