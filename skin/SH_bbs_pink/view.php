<?php include "$dir/value.php3"; ?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
   <td colspan=2><table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=FFC7D2 bordercolorlight=FFAFBF bordercolordark=#FFF2F4>
  <tr>
    <td style=font-family:Matchworks,Tahoma;font-size:8pt;color:#666666 align=center nowrap><img src=/images/t.gif height=3></td>
  </tr>
</table></td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> bgcolor=ffffff>
<tr>
  <td height=7 bgcolor=#ffffff></td>
  <td align=right bgcolor=#ffffff valign=bottom>
    <?=$a_modify?><img src=<?=$dir?>/i_modify.gif border=0 align=absmiddle></a>
    <?=$a_delete?><img src=<?=$dir?>/i_delete.gif border=0 align=absmiddle></a>
  </td>
</tr>
<tr height=1><td colspan=2 bgcolor=eeeeee><img src=images/t.gif height=1></td></tr>
<tr height=30>
 <td align=right class=thm8 width=80 bgcolor=#ffffff style=color:#CDB4DE><b>Name&nbsp;&nbsp;</b></td>
 <td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><img src=images/t.gif height=3></td></tr><tr><td>&nbsp;&nbsp;</td><td><?=$face_image?> <?=$name?>&nbsp;<?php if($data['email']) { ?> <font style=font-size:7pt;font-family:Tahoma;font-weight:normal>[<a href=mailto:<?=$data['email']?>><?=$data['email']?></a>]</font><?php } ?></td></tr></table></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_homepage_start?>
<tr height=30>
 <td align=right class=thm8 width=80 bgcolor=#ffffff style=color:#A3A1DC><b>Homepage&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$homepage?></font></td>
</tr>
<tr><td bgcolor=#eeeeee height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_homepage_end?>

<?=$hide_download1_start?>
<tr height=25>
 <td align=right class=thm8 width=80 bgcolor=#ffffff style=color:#999999><b>File #1&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> &nbsp; <font style=font-size:7pt;>Download : <b><?=$file_download1?></b></font></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>
<tr height=25>
 <td align=right class=thm8 width=80 bgcolor=#ffffff style=color:#999999><b>File #2&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> &nbsp; <font style=font-size:7pt;>Download : <b><?=$file_download2?></b></font></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>
<tr height=25>
 <td align=right class=thm8 width=80 bgcolor=#ffffff  style=color:#999999><b>Link #1&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$sitelink1?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=25>
 <td align=right class=thm8 width=80 bgcolor=#ffffff  style=color:#999999><b>Link #2&nbsp;&nbsp;</b></td>
 <td ><img src=images/t.gif height=3><br>&nbsp;&nbsp; <font class=thm8><?=$sitelink2?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_end?>

<tr height=30>
 <td align=right class=thm8 width=80 bgcolor=#ffffff style='word-break:break-all;color:#A3A1DC'><b>Subject&nbsp;&nbsp;</b></td>
 <td><img src=images/t.gif height=3><br>&nbsp;&nbsp; <b><?=$subject?></b></td>
</tr>
<tr><td bgcolor=f0f0f0 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr><td colspan=2 bgcolor=ffffff><img src=images/t.gif height=1></td></tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td style='word-break:break-all;padding:10px;' bgcolor=#ffffff height=100 valign=top>
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

<?=$hide_comment_start?> 
<table bgcolor="white" border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$hide_comment_end?>
