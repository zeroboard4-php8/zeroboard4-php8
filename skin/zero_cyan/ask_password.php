<br><br><br>
<table border=0 cellspacing=0 cellpadding=0 width=250>
<tr>
 <td><img src=<?=$dir?>/list_left.gif border=0></td>
 <td align=center background=<?=$dir?>/list_back.gif width=100%><font color=888888>Message</td>
 <td><img src=<?=$dir?>/list_right.gif border=0></td>
</tr>
</table>
<table border=0 width=250>
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
   <td align=center><Br><b><?=$title?></b><br></td>
</tr>
<tr height=50>
   <td align=center>
     <?=$input_password?> 
     <br><br><input type=image src=<?=$dir?>/btn_ok.gif border=0 onfocus=blur()>
     <?=$a_list?><img src=<?=$dir?>/btn_list.gif border=0></a>
     <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0></a>
   </td>
</tr>
</table>
</form>

