<tr align=center class=zv3_listBox onMouseOver=this.style.backgroundColor='#FBFBFB' onMouseOut=this.style.backgroundColor=''>
	<?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data['no']?>"></td><?=$hide_cart_end?>
	<td height=20>공지</td>
	<td align=left style='word-break:break-all;'>&nbsp;<?=$insert?><?=$icon?><?=$hide_category_start?>[<?=$category_name?>]<?=$hide_category_end?><?=$subject?> <font class=zv3_comment><?=$comment_num?></font></td> 
	<td nowrap><?=$face_image?>&nbsp;<?=$name?>&nbsp;</div></td>
	<td nowrap class=zv3_small><?=$reg_date?></td>
	<td nowrap class=zv3_small><?=$hit?></td>
	<td nowrap class=zv3_small><?=$vote?></td>
</tr>
<tr>
	<td colspan=<?=$colspanNum?>><img src=<?=$dir?>/line.gif width=100% height=2></td>
</tr>
