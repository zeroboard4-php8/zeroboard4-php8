<br><br><br>
<div align=center>
<table width=250 border=0 cellspacing=0 cellpadding=0>
<tr>
   <td width=10 height=10 background=<?=$dir?>/bg_1.gif></td>
   <td width=230 background=<?=$dir?>/bg_2.gif valign=BOTTOM><img src=<?=$dir?>/b_password.gif></td>
   <td width=10 height=10 background=<?=$dir?>/bg_3.gif></td>
</tr>
</table>
<table border=0 width=240 cellpadding=0 cellspacing=0>
<form method=post name=delete action=<?=$target?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<tr>
  <td height=10></td>
</tr>
<tr>
   <td style='padding:10 0 0 0;' align=center><?=$title?><br></td>
</tr>
<tr>
   <td align=center height=40><?=$input_password?></td>
</tr>
<tr height=1><td bgcolor=#484848><img src=images/t.gif height=1></td></tr>
<tr height=10><td colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td colspan=2 align=right>
     <input type=image border=0 src=<?=$dir?>/b_confirm.gif onfocus=blur()><?=$a_list?><img src=<?=$dir?>/s_list.gif border=0></a><?=$a_view?><img src=<?=$dir?>/b_back.gif border=0></a>
  </td>
</tr>
</table>
<br><br>
