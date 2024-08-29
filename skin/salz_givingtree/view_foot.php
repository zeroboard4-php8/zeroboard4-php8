<?=$hide_prev_start?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0><tr><td width=11 background=<?php echo $dir?>/dot.gif></td><td background=<?php echo $dir?>/dot.gif></td><td width=11 background=<?php echo $dir?>/dot.gif></td></tr></table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=11></col><col width=50></col><col width=></col><col width=80></col><col width=11></col>
<tr align=center>
  <td width=11>&nbsp;</td>
  <td width=50><font color=4F3A16><b>윗 &nbsp; 글</td>
  <td align=left>&nbsp; <?=$a_prev?><?=$prev_subject?></a></td>
  <td width=80><?=$prev_face_image?> <?=$prev_name?></td>
  <td width=11>&nbsp;</td>
</tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<tr><td width=11 background=<?php echo $dir?>/dot.gif></td><td background=<?php echo $dir?>/dot.gif></td><td width=11 background=<?php echo $dir?>/dot.gif></td></tr></table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=11></col><col width=50></col><col width=></col><col width=80></col><col width=11></col>
<tr align=center>
  <td width=11>&nbsp;</td>
  <td width=50><font color=4F3A16><b>아랫글</td>
  <td align=left>&nbsp; <?=$a_next?><?=$next_subject?></a></td>
  <td width=80 nowrap><?=$next_face_image?> <?=$next_name?></td>
  <td width=11>&nbsp;</td>
</tr>
</table>
<?=$hide_next_end?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0><tr><td width=11 background=<?php echo $dir?>/dot.gif></td><td background=<?php echo $dir?>/dot.gif></td><td width=11 background=<?php echo $dir?>/dot.gif></td></tr></table>

<!-- 버튼 관련 출력 -->
<br>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
 <td>
    <?=$a_list?><img src=<?=$dir?>/btn_list.gif border=0></a>
    <?=$a_write?><img src=<?=$dir?>/btn_write.gif border=0></a>
 </td>
 <td align=right>
    <?=$a_reply?><img src=<?=$dir?>/btn_reply.gif border=0></a>
    <?=$a_modify?><img src=<?=$dir?>/btn_modify.gif border=0></a>
    <?=$a_delete?><img src=<?=$dir?>/btn_delete.gif border=0></a>
 </td>
</tr>
</table>
<br><br>

