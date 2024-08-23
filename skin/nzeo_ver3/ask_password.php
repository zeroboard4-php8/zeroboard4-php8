<br><br><br>
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
<table border=0 width=250 class=zv3_writeform>
<tr>
   <td align=center bgcolor=aaaaaa style=padding:2px><b><?=$title?></b></td>
</tr>
<?php 
	if(!$member['no']) {
?>
<tr height=40>
   <td align=center>
     <img src=<?=$dir?>/w_password.gif border=0 valign=absmiddle><?=$input_password?> 
   </td>
</tr>
<?php 
	}
?>
<tr bgcolor=white height=30>
	<td align=center>
	    <input type=image src=<?=$dir?>/btn_ok.gif border=0 accesskey="s" onfocus=blur()>
     	<?=$a_list?><img src=<?=$dir?>/btn_list.gif border=0></a>
     	<a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/btn_back.gif border=0></a>
   </td>
</tr>
</table>
</form>

