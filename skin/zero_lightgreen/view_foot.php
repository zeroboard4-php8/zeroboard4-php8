<?=$hide_prev_start?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0><tr><td width=11><img src=image/t.gif border=0 width=1 height=1></td><td bgcolor=aaaaaa><img src=images/t.gif height=1></td><td width=11><img src=image/t.gif border=0 width=1 height=1></td></tr></table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=11></col><col width=50></col><col width=></col><col width=80></col><col width=11></col>
<tr align=center>
  <td width=11>&nbsp;</td>
  <td width=50 style='word-break:break-all;font-family:tahoma;font-size:8pt'><font color=aaaaaa><b>윗 &nbsp; 글</td>
  <td align=left style='word-break:break-all;'>&nbsp; <?=$a_prev?><?=$prev_subject?></a></td>
  <td width=80 nowrap><?=$prev_face_image?> <?=$prev_name?></td>
  <td width=11>&nbsp;</td>
</tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0><tr><td width=11><img src=image/t.gif border=0 width=1 height=1></td><td bgcolor=aaaaaa><img src=images/t.gif height=1></td><td width=11><img src=image/t.gif border=0 width=1 height=1></td></tr></table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=11></col><col width=50></col><col width=></col><col width=80></col><col width=11></col>
<tr align=center>
  <td width=11>&nbsp;</td>
  <td width=50 style='word-break:break-all;font-family:tahoma;font-size:8pt'><font color=aaaaaa><b>아랫글</td>
  <td align=left style='word-break:break-all;'>&nbsp; <?=$a_next?><?=$next_subject?></a></td>
  <td width=80 nowrap><?=$next_face_image?> <?=$next_name?></td>
  <td width=11>&nbsp;</td>
</tr>
</table>

<?=$hide_next_end?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0><tr><td width=11><img src=image/t.gif border=0 width=1 height=1></td><td bgcolor=aaaaaa><img src=images/t.gif height=1></td><td width=11><img src=image/t.gif border=0 width=1 height=1></td></tr></table>

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

