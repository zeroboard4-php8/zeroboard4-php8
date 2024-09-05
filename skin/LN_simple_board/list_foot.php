</table>

<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr><td height=12 colspan=2></td></tr>
<tr valign=top>
	
	<td>		
		<?=$a_list?><img src=<?=$dir?>/images/i_list.gif border=0 align=absmiddle></a>
		<?=$a_delete_all?><img src=<?=$dir?>/images/i_deleteall.gif border=0  align=absmiddle></a>
		<?=$a_write?><img src=<?=$dir?>/images/i_write.gif border=0 align=absmiddle></a>
		<font class=thm7><?=$a_prev_page?><img src=<?=$dir?>/images/i_prev.gif border=0 align=absmiddle></a></font><font class=thm7> <?=$print_page?> </font><font class=thm7><?=$a_next_page?><img src=<?=$dir?>/images/i_next.gif border=0 align=absmiddle></font></a>
	</td>

	
	
	<td align=right width=230>	
		<table border=0 cellspacing=0 cellpadding=0>
		</form>
		<form method=post name=search action=<?=$PHP_SELF?>>
		<input type=hidden name=page value=<?=$page?>>
		<input type=hidden name=id value=<?=$id?>>
		<input type=hidden name=select_arrange value=<?=$select_arrange?>>
		<input type=hidden name=desc value=<?=$desc?>>
		<input type=hidden name=page_num value=<?=$page_num?>>
		<input type=hidden name=selected><input type=hidden name=exec>
		<input type=hidden name=sn value="<?=$sn?>">
		<input type=hidden name=ss value="<?=$ss?>">
		<input type=hidden name=sc value="<?=$sc?>">
		<input type=hidden name=category value="<?=$category?>">
		<tr>
			<td>
				<a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn align=absmiddle></a>
				<a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss align=absmiddle></a>
				<a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc align=absmiddle></a>&nbsp;
			</td>
			<td><input type=text name=keyword value="<?=$keyword?>" class=input_search size=15>&nbsp;</td>
			<td><input type=image src=<?=$dir?>/images/i_search.gif border=0 onfocus=blur()></td>
			<td><?=$a_cancel?><img src=<?=$dir?>/images/i_search_cancel.gif border=0></a></td>
		</tr>
		</form>
	</table>
	</td>
	
	
</tr>
<tr><td height=10 colspan=2></td></tr>
<tr><td height=1 bgcolor=eeeeee colspan=2></td></tr>
</table>