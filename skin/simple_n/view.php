<?php include "$dir/value.php3"; ?>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
  <td height=2 colspan=2 bgcolor=444444></td>
</tr>
<tr>
<td colspan=2>

<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=100 align=center valign=bottom>
<?=$face_image?><?=$name?>&nbsp;<?php if($data['email']) { ?> <font class=thm8>[<a href=mailto:<?=$data['email']?>><?=$data['email']?></a>]</font><?php } ?>
</td>
<td width=1 valign=top><img src=<?=$dir?>/image/v_line.gif border=0></td>
<td valign=bottom style='word-break:break-all;'>
&nbsp;&nbsp;<?=$subject?></td>
<td width=1 valign=top><img src=<?=$dir?>/image/v_line.gif border=0></td>
<td align=center width=70 class=yeinsfont valign=bottom><?=$reg_date?></td>
<?=$hide_homepage_start?>
<td width=1 valign=top><img src=<?=$dir?>/image/v_line.gif border=0></td>
<td align=center width=40 valign=bottom><?=$a_homepage?><img src=<?=$dir?>/image/icon_home.gif border=0 title='홈페이지'></a></td><?=$hide_homepage_end?>
</tr>
</table>

 </td>
</tr>
<tr>
  <td height=5 colspan=2></td>
</tr>
<tr>
  <td colspan=2 height=4 background=<?=$dir?>/image/v_bg1.gif></td>
</tr>
<tr>
  <td height=3 colspan=2></td>
</tr>
</table>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>

<?=$hide_download1_start?>
<tr height=25>
 <td width=100 align=center><img src=<?=$dir?>/image/file1.gif border=0></td>
 <td class=yeinsfont>&nbsp;&nbsp;<?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> &nbsp; DOWNLOAD : <b><?=$file_download1?></b></font></font></td>
</tr>
<tr>
  <td height=1 colspan=2 bgcolor=f2f2f2></td>
</tr>

<?=$hide_download1_end?>



<?=$hide_download2_start?>
<tr height=25>
 <td width=100 align=center><img src=<?=$dir?>/image/file2.gif border=0></td>
<td class=yeinsfont>&nbsp;&nbsp;<?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> &nbsp; DOWNLOAD : <b><?=$file_download2?></b></font></font></td>
</tr>
<tr>
  <td height=1 colspan=2 bgcolor=f2f2f2></td>
</tr>
<?=$hide_download2_end?>


<?=$hide_sitelink1_start?>
<tr height=25>
 <td width=100 align=center><img src=<?=$dir?>/image/link1.gif border=0></td>
<td class=yeinsfont>&nbsp;&nbsp;<?=$sitelink1?></font></td>
</tr>
<tr>
  <td height=1 colspan=2 bgcolor=f2f2f2></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>
<tr height=25>
 <td width=100 align=center><img src=<?=$dir?>/image/w_link2.gif border=0></td>
 <td class=yeinsfont>&nbsp;&nbsp;<?=$sitelink2?></font></td>
</tr>
<tr>
  <td height=1 colspan=2 bgcolor=f2f2f2></td>
</tr>
<?=$hide_sitelink2_end?>

</table>


<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td style='word-break:break-all;padding:10px;' bgcolor=#ffffff height=100 valign=top>
     <span style=line-height:160%>
     <?=$upload_image1?>
     <?=$upload_image2?>
     <?=$memo?>
     <br>
     <div align=right class=yeinsfont>
     <?=$a_modify?><img src=<?=$dir?>/image/i_modify.gif border=0 align=absmiddle></a>
     <?=$a_delete?><img src=<?=$dir?>/image/i_delete.gif border=0 align=absmiddle></a><br>
     <?=$ip?></div>
     </span>
 </td>
</tr>
</table>

<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> >
<tr>
  <td colspan=4 height=1 bgcolor=f2f2f2></td>
</tr>
<?=$hide_comment_end?>