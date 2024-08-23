<tr align=center class=zv3_listBox onMouseOver=this.style.backgroundColor='#FBFBFB' onMouseOut=this.style.backgroundColor=''>
	<td></td>
	<?=$hide_cart_start?><td width=30><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>
	<td class=zv3_small height=20 width=50><?=$number?></td>
	<td align=left style='word-break:break-all;'>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?> <font class=zv3_comment><?=$comment_num?></font></td> 
	<td nowrap><?=$face_image?>&nbsp;<?=$name?></td>
	<td nowrap class=zv3_small><?=$reg_date?></td>
	<td nowrap class=zv3_small><?=$hit?></td>
	<td></td>
</tr>
<tr>
	<td colspan=<?=$colspanNum?> background=<?=$dir?>/dot.gif><img src=<?=$dir?>/dot.gif width=1 border=0></td>
</tr>