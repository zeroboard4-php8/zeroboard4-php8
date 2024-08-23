<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td colspan=2 height=1 bgcolor=#F3F3F3></td>
</tr>

<tr height=30>
  <td align=left>
<?=$a_list?><img src=<?=$dir?>/images/list.gif border=0></a><?=$a_write?><img src=<?=$dir?>/images/write.gif border=0></a>
  </td>
  <td align=right>
    <?=$a_reply?><img src=<?=$dir?>/images/reply.gif border=0></a><?=$a_modify?><img src=<?=$dir?>/images/modify.gif border=0></a><?=$a_delete?><img src=<?=$dir?>/images/delete.gif border=0></a>
  </td>
</tr>
<tr>
<td colspan=2 height=10></td>
</tr>
</table>

<!-- 이전 / 다음글 출력 -->

<?=$hide_prev_start?>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
  <td height=1 colspan=4 bgcolor=#F3F3F3></td>
</tr>
<tr height=23  style="padding:2 0 0 0;">
  <td width=50 align=left class=rini_ver>&nbsp;&nbsp;Prev</td>
  <td align=left style='word-break:break-all;'>&nbsp;<?=$a_prev?><?=$prev_subject?></a></td>
  <td width=75 align=right style='word-break:break-all;'><?=$prev_face_image?> <?=$prev_name?>&nbsp;</td>
  <td width=70 align=right class=rini_ver3>&nbsp;<?=$prev_reg_date?>&nbsp;</td>
</tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>
<table border=0 cellspacing=0 cellpadding=0  width=<?=$width?>>
<tr height=23  style="padding:0 0 2 0;">
  <td width=50 align=left class=rini_ver>&nbsp;&nbsp;Next</td>
  <td align=left style='word-break:break-all;'>&nbsp;<?=$a_next?><?=$next_subject?></a></td>
  <td width=75 align=right style='word-break:break-all;'><?=$next_face_image?> <?=$next_name?>&nbsp;</td>
  <td width=70 align=right class=rini_ver3>&nbsp;<?=$next_reg_date?>&nbsp;</td>
</tr>

<tr>
  <td height=1 colspan=4 bgcolor=#F3F3F3></td>
</tr>
<tr><td colspan=4 height=6></td></tr>
</table>
<?=$hide_next_end?>