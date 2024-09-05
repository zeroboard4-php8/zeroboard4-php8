 <tr><td  height=1 bgcolor=eeeeee></td></tr>
</table>

<form method=post name=write action=comment_ok.php>
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

<div align=center>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> >
<tr>
  <td>
	
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		<tr><td height=20 colspan=2></td></tr>

		<tr>
		<td class=ver7 colspan=2><img src=<?=$dir?>/images/w_name.gif border=0 align=absmiddle>&nbsp; <?=$c_name?>&nbsp;&nbsp;
		<?=$hide_c_password_start?><img src=<?=$dir?>/images/w_pass.gif border=0 align=absmiddle>&nbsp; 
		<input type=password name=password <?=size(8)?> maxlength=20 class=input>
		<?=$hide_c_password_end?></b>
		</td>
		</tr>

		<tr>
		<td width=100%><textarea name=memo style='width:100%; height:60px' class=textarea></textarea></td>
		<td width=61 align=right><input type=image src=<?=$dir?>/images/i_comment.gif border=0 onfocus=blur() accesskey="s" style="cursor:hand"></td>
		</tr>
		</table>


  </td>
</tr>
</table>
</form>
</div>