<table border=1 cellspacing=0 cellpadding=0 width=100%>
<tr>
<td align=right>

<table border=1 cellspacing=0 cellpadding=2 width=96%>
<tr>
  <td colspan=3 style='word-break:break-all;'>
    <?=$hide_cart_start?><input type=checkbox name=cart value="<?=$reply_data['no']?>"><?=$hide_cart_end?>
    <?=$reply_data['subject']?>
  </td>
  <td align=right nowrap>&nbsp;
     <?=$a_reply?>r</a>
     <?=$a_modify?>m</a>
     <?=$a_delete?>x</a>
  </td>
</tr>
<tr>
  <td width=10% align=center><b>Name</b></td>
  <td width=65%><?=$face_image?> <?=$name?> &nbsp;&nbsp; <?=$homepage?></td>
  <td width=10% align=center><b>Date</b></td>
  <td width=15% nowrap align=center><?=$reg_date?></td>
</tr>
<tr>
  <td colspan=4>
    <table border=0 width=100% cellspacing=4 cellpadding=0>
    <tr>
     <td  style='word-break:break-all;'><?=$memo?></td>
    </tr>
    </table>
  </td>
</tr>
</table>

</td>
</tr>
</table>
